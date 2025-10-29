<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PdfProxyController;
use App\Http\Controllers\AdminUserController;

// อย่า use App\Models\Fluke;  เพื่อเลี่ยงชนชื่อ (จะอ้าง FQCN ตอนใช้เท่านั้น)


/* -------------------- Public pages (ไม่ต้องล็อกอิน) -------------------- */
// routes/web.php
Route::get('/', fn () => view('test.FLUKE_Marketplace'))->name('home');
Route::get('/fluke-marketplace', fn () => view('test.FLUKE_Marketplace'))->name('fluke.marketplace');
Route::get('/products', fn () => view('test.product'))->name('products');


Route::get('/login', fn () => view('login.Login'))->name('login');
Route::get('/Sign_up', fn () => view('login.Sign_up'))->name('Sign_up');
Route::post('/register', [LoginController::class, 'register'])->name('register.post');

Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.show');          
Route::post('/profile/update', [ProfileController::class, 'update'])->name('updateprofile.post');             
Route::delete('/profile/subaddress/{idsubaddress}', [ProfileController::class, 'delsub'])->name('delsub');
Route::get('/profile/fetchaddress', [ProfileController::class, 'fetchaddress'])->name('profile.fetchaddress'); 
Route::get('/account/edit', [ProfileController::class, 'editprofile'])->name('profile.edit'); 
Route::put('/subaddress/{idsubaddress}', [ProfileController::class, 'updatesub'])->name('subaddress.update');

Route::get('cart', fn () => view('test.cart'));
Route::get('/expend', fn () => view('test.expend'))->name('expend');
Route::get('header-nav', fn () => view('test.header-nav'));
Route::get('footer', fn () => view('test.footer'));

/* -------------------- Google OAuth (สาธารณะ) -------------------- */
Route::get('/auth/line/redirect', [LoginController::class, 'lineRedirect'])->name('line.redirect');
Route::get('/auth/line/callback', [LoginController::class, 'lineCallback'])->name('line.callback');

Route::get('/auth/google/redirect', [LoginController::class, 'googleRedirect'])->name('google.redirect');
Route::get('/auth/google/callback', [LoginController::class, 'googleCallback'])->name('google.callback');

// Mini API (ใช้จากหน้าเว็บได้เลย)
Route::get('/api/auth/me', [LoginController::class, 'apiMe'])->name('api.auth.me');
Route::post('/api/auth/logout', [LoginController::class, 'apiLogout'])->name('api.auth.logout');
Route::post('/auth/login', [LoginController::class, 'login'])->name('auth.login');

/* -------------------- Protected pages (ต้องล็อกอิน) -------------------- */
Route::post('/logout', function (Request $request) {
    // 1) ออกจากระบบทุก guard
    foreach (array_keys(config('auth.guards')) as $guard) {
        if (Auth::guard($guard)->check()) {
            Auth::guard($guard)->logout();
        }
    }

    // 2) ลบ remember-me cookie
    $defaultGuard = Auth::guard();
    if (method_exists($defaultGuard, 'getRecallerName')) {
        Cookie::queue(Cookie::forget($defaultGuard->getRecallerName()));
    }

    // 3) ล้าง session ทั้งหมด
    $request->session()->flush();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // 4) เด้งกลับหน้าแรก
    return redirect('/');
})->name('logout');

/* -------------------- Dashboard / Products -------------------- */
Route::get('/', [DashboardController::class, 'Home'])->name('test.FLUKE_Marketplace');
Route::get('/products', [DashboardController::class, 'showproduct'])->name('product.index');
Route::redirect('/products/category/cart', '/cart')->name('product.category.cart');
Route::redirect('/product/cart', '/cart')->name('product.cart');
Route::redirect('/account/cart', '/cart')->name('profile.cart');

Route::get('/products/category/{slug}', [DashboardController::class, 'byCategory'])
    ->where('slug', '^(?!cart$).+')
    ->name('product.category');    

Route::get('/product/{iditem}', [DashboardController::class, 'showItem'])->name('product.detail');
Route::get('/search/products', [DashboardController::class, 'searchByName'])->name('search.products');
Route::post('/cart/add', [DashboardController::class, 'add'])->name('cart.add');
Route::get('/cart', [DashboardController::class, 'showcart'])->name('cart.show');
Route::get('/cart/json', [DashboardController::class, 'cartJson'])->name('cart.json');
Route::post('/cart/qty', [DashboardController::class, 'cartQty'])->name('cart.qty');
Route::delete('/cart/remove', [DashboardController::class, 'cartRemove'])->name('cart.remove');
Route::post('/cart/remove-many', [DashboardController::class, 'cartRemoveMany'])->name('cart.removeMany');
Route::post('/cart/checkout', [DashboardController::class, 'checkout'])->name('cart.checkout');
Route::post('/profile/subaddress', [ProfileController::class, 'store'])->name('subaddress.address');
Route::get('/profile/addresses', [ProfileController::class, 'addresses'])->name('profile.addresses');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

/* -------------------- PDF Proxy -------------------- */
Route::match(['GET', 'OPTIONS'], '/pdf-proxy', [PdfProxyController::class, 'fetch'])->name('pdf.proxy');

/* -------------------- Admin -------------------- */
Route::get('Admin', [AdminUserController::class, 'index'])->name('Admin');

// ==================== robots.txt ====================

Route::get('/robots.txt', function () {
    // ใช้ host จริงของโปรเจกต์เพื่อตัดสินใจ allow/disallow
    $host   = parse_url(config('app.url'), PHP_URL_HOST) ?: request()->getHost();
    $isProd = in_array($host, ['myfluketh.com', 'www.myfluketh.com'], true);

    $content = $isProd
        ? "User-agent: *\nAllow: /\n\nSitemap: " . url('/sitemap.xml') . "\n"
        : "User-agent: *\nDisallow: /\n"; // กันบอทบน dev/staging

    return response($content, 200)->header('Content-Type', 'text/plain');
});


// ==================== sitemap.xml ====================

Route::get('/sitemap.xml', function () {
    $home = rtrim(url('/'), '/') . '/'; // ให้ตรงกับ canonical มี "/" ปิดท้าย

    // เพจหลักที่แน่ใจว่ามีจริง
    $urls = [
        [
            'loc'        => $home,
            'changefreq' => 'weekly',
            'priority'   => '1.0',
            'lastmod'    => now()->toIso8601String(),
        ],
        [
            'loc'        => url('/products'),
            'changefreq' => 'weekly',
            'priority'   => '0.9',
            // จะไม่ใส่ lastmod เพื่อเลี่ยง time เดียวกันทุกครั้งหากไม่มีแหล่งอ้างอิง
        ],
        // ถ้ามีหมวดหลัก สามารถเติมได้ (เฉพาะหน้าที่มีคอนเทนต์จริง)
        // ['loc' => url('/category/multimeter'),  'changefreq' => 'weekly', 'priority' => '0.8'],
        // ['loc' => url('/category/clamp-meter'), 'changefreq' => 'weekly', 'priority' => '0.8'],
    ];

    // (ทางเลือก) ใส่สินค้าเดี่ยวแบบอัตโนมัติ—เฉพาะที่พร้อมจริง ๆ
    try {
        // ปรับเงื่อนไขตาม schema DB ของคุณ
        $items = Fluke::select('slug', 'updated_at')
            ->where('is_active', 1)
            ->orderByDesc('updated_at')
            ->limit(2000)
            ->get();

        foreach ($items as $it) {
            if (!empty($it->slug)) {
                $urls[] = [
                    'loc'        => url('/product/' . ltrim($it->slug, '/')),
                    'changefreq' => 'monthly',
                    'priority'   => '0.5',
                    'lastmod'    => optional($it->updated_at)->toIso8601String(),
                ];
            }
        }
    } catch (\Throwable $e) {
        // ถ้าโมเดล/ตารางยังไม่พร้อม ให้ข้ามส่วนนี้ไปเฉย ๆ
    }

    // สร้าง XML (application/xml + UTF-8)
    $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset/>');
    $xml->addAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

    foreach ($urls as $u) {
        $url = $xml->addChild('url');
        $url->addChild('loc', htmlspecialchars($u['loc'], ENT_XML1));
        if (!empty($u['lastmod'])) {
            // ใช้ ISO 8601 (เช่น 2025-10-29T09:05:00+07:00)
            $url->addChild('lastmod', $u['lastmod']);
        }
        if (!empty($u['changefreq'])) $url->addChild('changefreq', $u['changefreq']);
        if (!empty($u['priority']))   $url->addChild('priority', $u['priority']);
    }

    return Response::make($xml->asXML(), 200)
        ->header('Content-Type', 'application/xml; charset=UTF-8');
});
