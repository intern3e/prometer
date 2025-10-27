<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\PdfProxyController;

use App\Models\Fluke;

/* -------------------- Public pages (ไม่ต้องล็อกอิน) -------------------- */
Route::get('/login', fn () => view('login.Login'))->name('login');
Route::get('/Sign_up', fn () => view('login.Sign_up'))->name('Sign_up');
Route::post('/register', [LoginController::class, 'register'])->name('register.post');

Route::get('/expend', fn () => view('test.expend'))->name('expend');
Route::get('header-nav', fn () => view('test.header-nav'));
Route::get('footer', fn () => view('test.footer'));

/* -------------------- Google/LINE OAuth (สาธารณะ) -------------------- */
Route::get('/auth/line/redirect',   [LoginController::class, 'lineRedirect'])->name('line.redirect');
Route::get('/auth/line/callback',   [LoginController::class, 'lineCallback'])->name('line.callback');

Route::get('/auth/google/redirect', [LoginController::class, 'googleRedirect'])->name('google.redirect');
Route::get('/auth/google/callback', [LoginController::class, 'googleCallback'])->name('google.callback');

/* -------------------- Mini API -------------------- */
Route::get('/api/auth/me',      [LoginController::class, 'apiMe'])->name('api.auth.me');
Route::post('/api/auth/logout', [LoginController::class, 'apiLogout'])->name('api.auth.logout');
Route::post('/auth/login',      [LoginController::class, 'login'])->name('auth.login');

/* -------------------- Logout (ทุก guard) -------------------- */
Route::post('/logout', function (Request $request) {
    foreach (array_keys(config('auth.guards')) as $guard) {
        if (Auth::guard($guard)->check()) Auth::guard($guard)->logout();
    }
    $defaultGuard = Auth::guard();
    if (method_exists($defaultGuard, 'getRecallerName')) {
        Cookie::queue(Cookie::forget($defaultGuard->getRecallerName()));
    }
    $request->session()->flush();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

/* -------------------- หน้า Home / สินค้า -------------------- */
Route::get('/', [DashboardController::class, 'Home'])->name('home');

Route::get('/products', [DashboardController::class, 'showproduct'])->name('product.index');
Route::redirect('/products/category/cart', '/cart')->name('product.category.cart');
Route::redirect('/product/cart',           '/cart')->name('product.cart');
Route::redirect('/account/cart',           '/cart')->name('profile.cart');

Route::get('/products/category/{slug}', [DashboardController::class, 'byCategory'])
    ->where('slug', '^(?!cart$).+')
    ->name('product.category');

Route::get('/product/{iditem}',     [DashboardController::class, 'showItem'])->name('product.detail');
Route::get('/search/products',      [DashboardController::class, 'searchByName'])->name('search.products');

/* -------------------- Cart -------------------- */
Route::get('/cart',           [DashboardController::class, 'showcart'])->name('cart.show');
Route::get('/cart/json',      [DashboardController::class, 'cartJson'])->name('cart.json');
Route::post('/cart/qty',      [DashboardController::class, 'cartQty'])->name('cart.qty');
Route::delete('/cart/remove', [DashboardController::class, 'cartRemove'])->name('cart.remove');
Route::post('/cart/remove-many', [DashboardController::class, 'cartRemoveMany'])->name('cart.removeMany');

/* ✅ เพิ่ม route ที่หายไป: cart.add (รับทั้ง GET/POST เพื่อกันหน้าเด้งพัง)
   - ใช้ session เป็นตะกร้า: ['IDสินค้า' => จำนวน]
   - รองรับพารามิเตอร์ได้ทั้ง product_id และ iditem
*/
Route::match(['GET','POST'], '/cart/add', function (Request $request) {
    $id  = $request->input('product_id')
        ?? $request->input('iditem')
        ?? $request->query('product_id')
        ?? $request->query('iditem');

    $qty = (int) ($request->input('qty', $request->query('qty', 1)));
    $qty = max(1, $qty);

    if (!$id) {
        return back()->with('error', 'ไม่พบรหัสสินค้า (product_id / iditem)');
    }

    // ตรวจว่าสินค้ามีจริงในตาราง Fluke (ถ้ามีโมเดล)
    if (class_exists(Fluke::class)) {
        $exists = Fluke::where('iditem', $id)->exists();
        if (!$exists) {
            return back()->with('error', 'ไม่พบสินค้า iditem: '.$id);
        }
    }

    $cart = session()->get('cart', []);
    $cart[$id] = ($cart[$id] ?? 0) + $qty;
    session()->put('cart', $cart);

    if ($request->wantsJson() || $request->ajax()) {
        return response()->json(['ok' => true, 'cart' => $cart]);
    }
    return back()->with('success', 'เพิ่มสินค้าเข้าตะกร้าแล้ว');
})->name('cart.add');

/* ใช้อันนี้อันเดียวสำหรับชำระเงิน */
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

/* -------------------- โปรไฟล์ -------------------- */
Route::get('/profile',                     [ProfileController::class, 'showProfile'])->name('profile.show');
Route::post('/profile/update',             [ProfileController::class, 'update'])->name('updateprofile.post');
Route::delete('/profile/subaddress/{idsubaddress}', [ProfileController::class, 'delsub'])->name('delsub');
Route::get('/profile/fetchaddress',        [ProfileController::class, 'fetchaddress'])->name('profile.fetchaddress');
Route::get('/account/edit',                [ProfileController::class, 'editprofile'])->name('profile.edit');
Route::put('/subaddress/{idsubaddress}',   [ProfileController::class, 'updatesub'])->name('subaddress.update');
Route::post('/profile/subaddress',         [ProfileController::class, 'store'])->name('subaddress.address');
Route::get('/profile/addresses',           [ProfileController::class, 'addresses'])->name('profile.addresses');

/* -------------------- PDF Proxy -------------------- */
Route::match(['GET', 'OPTIONS'], '/pdf-proxy', [PdfProxyController::class, 'fetch'])->name('pdf.proxy');

/* -------------------- Admin -------------------- */
Route::get('Admin', [AdminUserController::class, 'index'])->name('Admin');

/* ---------- หน้า FLUKE Marketplace (ส่งข้อมูลเข้า Blade) ---------- */
/*  View: resources/views/test/FLUKE_Marketplace.blade.php
    ต้องการตัวแปร $flashDeals และ $products */
Route::get('/fluke-marketplace', function () {
    // ปรับ fields ให้ตรง schema จริงของ Fluke
    $flashDeals = Fluke::query()
        ->whereNotNull('webpriceTHB')
        ->where('webpriceTHB', '!=', '')
        ->where(function($q){
            $q->whereNotNull('pic')->orWhereNotNull('image');
        })
        ->orderByDesc('updated_at')
        ->take(80)
        ->get(['iditem','name','model','num_model','pic','image','webpriceTHB'])
        ->map(function($p){
            return [
                'iditem'      => $p->iditem,
                'name'        => trim($p->name ?? ''),
                'model'       => trim($p->model ?? ''),
                'num_model'   => trim($p->num_model ?? ''),
                'pic'         => $p->pic ?: $p->image,   // JS รองรับ pic/image
                'webpriceTHB' => $p->webpriceTHB,
            ];
        });

    $products = Fluke::query()
        ->orderBy('name')
        ->take(500)
        ->get(['name','category','pic','image','webpriceTHB','columnJ'])
        ->map(function($p){
            return [
                'name'        => trim($p->name ?? ''),
                'category'    => trim($p->category ?? ''),
                'image'       => $p->image ?: $p->pic,
                'webpriceTHB' => $p->webpriceTHB,
                'columnJ'     => $p->columnJ ?? '',
            ];
        });

    return view('test.FLUKE_Marketplace', compact('flashDeals','products'));
})->name('fluke.marketplace');

/* ---------- Sitemap (XML) ---------- */


Route::get('/sitemap.xml', function () {
    try {
        $tz  = 'Asia/Bangkok';
        $now = now($tz)->toAtomString();

        // หน้า static หลัก ๆ
        $home = rtrim(url('/'), '/') . '/';
        $urls = [
            [
                'loc'        => $home,
                'lastmod'    => $now,
                'changefreq' => 'daily',
                'priority'   => '1.0',
            ],
            [
                'loc'        => route('fluke.marketplace'),
                'lastmod'    => $now,
                'changefreq' => 'weekly',
                'priority'   => '0.8',
            ],
            [
                'loc'        => url('/products'),
                'lastmod'    => $now,
                'changefreq' => 'weekly',
                'priority'   => '0.8',
            ],
            [
                'loc'        => url('/products/category/ClampMeter1'),
                'lastmod'    => $now,
                'changefreq' => 'weekly',
                'priority'   => '0.8',
            ],
        ];

        // ✅ เพิ่มสินค้าเป็นรายตัว (สูงสุด 2000 รายการแรกที่อัปเดตล่าสุด)
        $products = Fluke::query()
            ->select(['iditem','name','updated_at'])
            ->whereNotNull('iditem')
            ->orderByDesc('updated_at')
            ->take(2000)
            ->get();

        foreach ($products as $p) {
            $slug = Str::slug($p->name ?? 'fluke', '-');
            $urls[] = [
                'loc'        => url('/product/'.$p->iditem.'/'.$slug),
                'lastmod'    => optional($p->updated_at)->timezone($tz)->toAtomString() ?: $now,
                'changefreq' => 'weekly',
                'priority'   => '0.6',
            ];
        }

        // สร้าง XML
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset/>');
        $xml->addAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        foreach ($urls as $item) {
            $url = $xml->addChild('url');
            $url->addChild('loc',        htmlspecialchars($item['loc'], ENT_XML1, 'UTF-8'));
            $url->addChild('lastmod',    $item['lastmod']);
            $url->addChild('changefreq', $item['changefreq']);
            $url->addChild('priority',   $item['priority']);
        }

        return response($xml->asXML(), 200, [
            'Content-Type'  => 'application/xml; charset=UTF-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    } catch (\Throwable $e) {
        \Log::error('Sitemap Error: '.$e->getMessage());
        return response('Error generating sitemap: '.$e->getMessage(), 500);
    }
})->name('sitemap.xml');
