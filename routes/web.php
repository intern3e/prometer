<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Fluke;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\AccountController;
use GuzzleHttp\Client;
use App\Models\Custdetail;

/* -------------------- Public pages (ไม่ต้องล็อกอิน) -------------------- */
Route::get('/', fn () => view('test.FLUKE_Marketplace'))->name('home');
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
use App\Http\Controllers\DashboardController;

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
use App\Http\Controllers\PdfProxyController;
Route::match(['GET', 'OPTIONS'], '/pdf-proxy', [PdfProxyController::class, 'fetch'])->name('pdf.proxy');

/* -------------------- Admin -------------------- */
use App\Http\Controllers\AdminUserController;
Route::get('Admin', [AdminUserController::class, 'index'])->name('Admin');

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;

Route::get('/sitemap.xml', function () {
    try {
        $urls = [
            url('/'),
            url('/products'),
            url('/contact'),
        ];

        // ✅ สร้าง XML ด้วย SimpleXML
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset/>');
        $xml->addAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        foreach ($urls as $u) {
            $url = $xml->addChild('url');
            $url->addChild('loc', htmlspecialchars($u));
            $url->addChild('changefreq', 'weekly');
            $url->addChild('priority', '0.8');
        }

        // ✅ ส่งกลับเป็น XML พร้อม header ที่ถูกต้อง
        return response($xml->asXML(), 200)
            ->header('Content-Type', 'application/xml');

    } catch (\Throwable $e) {
        Log::error('Sitemap Error: ' . $e->getMessage());
        return response('Error generating sitemap: ' . $e->getMessage(), 500);
    }
});
