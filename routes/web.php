<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
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

use GuzzleHttp\Client;
use App\Models\Custdetail;
// ❗️อย่า import App\Models\Fluke ซ้ำ เพื่อเลี่ยงชื่อชนกัน (จะใช้ FQCN ตรง ๆ แทน)
Route::redirect('/showproduct', '/products', 301);
/* -------------------- Public pages (ไม่ต้องล็อกอิน) -------------------- */
Route::get('/', [DashboardController::class, 'Home'])->name('home'); // หน้าแรก (ตัวเดียวเท่านั้น)
Route::get('/login', fn () => view('login.Login'))->name('login');
Route::get('/Sign_up', fn () => view('login.Sign_up'))->name('Sign_up');
Route::post('/register', [LoginController::class, 'register'])->name('register.post');

Route::get('/expend', fn () => view('test.expend'))->name('expend');
Route::get('header-nav', fn () => view('test.header-nav'));
Route::get('footer', fn () => view('test.footer'));

/* -------------------- OAuth -------------------- */
Route::get('/auth/line/redirect', [LoginController::class, 'lineRedirect'])->name('line.redirect');
Route::get('/auth/line/callback', [LoginController::class, 'lineCallback'])->name('line.callback');

Route::get('/auth/google/redirect', [LoginController::class, 'googleRedirect'])->name('google.redirect');
Route::get('/auth/google/callback', [LoginController::class, 'googleCallback'])->name('google.callback');

/* -------------------- Mini API (auth) -------------------- */
Route::get('/api/auth/me', [LoginController::class, 'apiMe'])->name('api.auth.me');
Route::post('/api/auth/logout', [LoginController::class, 'apiLogout'])->name('api.auth.logout');
Route::post('/auth/login',[LoginController::class, 'login'])->name('auth.login');

/* -------------------- Profile -------------------- */
Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.show');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('updateprofile.post');
Route::delete('/profile/subaddress/{idsubaddress}',[ProfileController::class, 'delsub'])->name('delsub');
Route::get('/profile/fetchaddress', [ProfileController::class, 'fetchaddress'])->name('profile.fetchaddress');
Route::get('/account/edit', [ProfileController::class, 'editprofile'])->name('profile.edit');
Route::put('/subaddress/{idsubaddress}', [ProfileController::class, 'updatesub'])->name('subaddress.update');
Route::post('/profile/subaddress', [ProfileController::class, 'store'])->name('subaddress.address');
Route::get('/profile/addresses', [ProfileController::class, 'addresses'])->name('profile.addresses');

/* -------------------- Logout (ทุก guard) -------------------- */
Route::post('/logout', function (Request $request) {
    foreach (array_keys(config('auth.guards')) as $guard) {
        if (Auth::guard($guard)->check()) {
            Auth::guard($guard)->logout();
        }
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

/* -------------------- Products & Search -------------------- */
Route::get('/products', [DashboardController::class, 'showproduct'])->name('product.index');
Route::get('/products/category/{slug}', [DashboardController::class, 'byCategory'])
    ->where('slug', '^(?!cart$).+')
    ->name('product.category');
Route::get('/product/{iditem}', [DashboardController::class, 'showItem'])->name('product.detail');
Route::get('/search/products', [DashboardController::class, 'searchByName'])->name('search.products');

/* -------------------- Cart -------------------- */
Route::get('/cart', [CartController::class, 'showcart'])->name('cart.show');
Route::get('/cart/json', [DashboardController::class, 'cartJson'])->name('cart.json');
Route::post('/cart/add', [DashboardController::class, 'add'])->name('cart.add');
Route::post('/cart/qty', [DashboardController::class, 'cartQty'])->name('cart.qty');
Route::delete('/cart/remove', [DashboardController::class, 'cartRemove'])->name('cart.remove');
Route::post('/cart/remove-many', [DashboardController::class, 'cartRemoveMany'])->name('cart.removeMany');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout'); // ✅ เลือกตัวเดียว

/* -------------------- Redirect helper -------------------- */
Route::redirect('/products/category/cart', '/cart')->name('product.category.cart');
Route::redirect('/product/cart', '/cart')->name('product.cart');
Route::redirect('/account/cart', '/cart')->name('profile.cart');

/* -------------------- PDF Proxy -------------------- */
Route::match(['GET','OPTIONS'], '/pdf-proxy', [PdfProxyController::class, 'fetch'])->name('pdf.proxy');

/* -------------------- Admin -------------------- */
Route::get('Admin', [AdminUserController::class, 'index'])->name('Admin');


Route::get('/sitemap.xml', function () {
    $urls = [
        ['loc' => url('/'),        'changefreq' => 'weekly',  'priority' => '1.0'],
        // ไม่ใส่ /products และ /showproduct
        // ใส่หน้าอื่นที่อยาก index เพิ่มได้ เช่น /contact
    ];

    // รวมหน้าสินค้าเดี่ยว (ถ้าอยากให้ติดดัชนี)
    if (class_exists(\App\Models\Fluke::class)) {
        try {
            \App\Models\Fluke::query()
                ->select(['iditem','updated_at'])
                ->orderBy('iditem')
                ->chunk(1000, function ($rows) use (&$urls) {
                    foreach ($rows as $item) {
                        $urls[] = [
                            'loc'        => url('/product/' . $item->iditem),
                            'lastmod'    => optional($item->updated_at)->toAtomString(),
                            'changefreq' => 'weekly',
                            'priority'   => '0.5',
                        ];
                    }
                });
        } catch (\Throwable $e) {}
    }

    $xml = new \SimpleXMLElement('<urlset/>');
    $xml->addAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
    foreach ($urls as $u) {
        $url = $xml->addChild('url');
        $url->addChild('loc', htmlspecialchars($u['loc'], ENT_XML1));
        if (!empty($u['lastmod'])) $url->addChild('lastmod', $u['lastmod']);
        $url->addChild('changefreq', $u['changefreq'] ?? 'weekly');
        $url->addChild('priority',   $u['priority']   ?? '0.8');
    }
    return response($xml->asXML(), 200)->header('Content-Type', 'application/xml');
});
