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

Route::get('/pdf-proxy', function (Request $req) {
    $url = $req->query('url');

    // validate เบื้องต้น
    if (!$url || !preg_match('~^https?://~i', $url) || !preg_match('~\.pdf(\?|#|$)~i', $url)) {
        abort(400, 'Invalid url');
    }

    // ป้องกัน SSRF: อนุญาตเฉพาะ host ที่ไว้ใจ (เติมได้เอง)
    $host = parse_url($url, PHP_URL_HOST) ?: '';
    $allowHosts = ['www.es.co.th', 'es.co.th'];
    if (!in_array(strtolower($host), array_map('strtolower', $allowHosts), true)) {
        abort(403, 'Host not allowed');
    }

    $client  = new Client([
        'timeout'         => 15,
        'allow_redirects' => true,
        'verify'          => false, // ถ้า TLS โอเคใช้ true
    ]);

    $headers = ['User-Agent' => 'Mozilla/5.0'];
    if ($range = $req->header('Range')) {
        $headers['Range'] = $range; // ส่งต่อ range เพื่อให้ PDF เลื่อนหน้าไว
    }

    try {
        $res  = $client->request('GET', $url, ['stream' => true, 'headers' => $headers]);
        $body = $res->getBody();
        $status = $res->getStatusCode();

        // เตรียมหัวข้อให้แสดง inline และกัน CORS/iframe
        $respHeaders = [
            'Content-Type'                => $res->getHeaderLine('Content-Type') ?: 'application/pdf',
            'Content-Disposition'         => 'inline; filename="' . basename(parse_url($url, PHP_URL_PATH)) . '"',
            'Cache-Control'               => 'public, max-age=86400',
            'Access-Control-Allow-Origin' => '*',
            // อย่าคืน X-Frame-Options/ CSP กลับไป (ปล่อยว่างไว้)
        ];
        foreach (['Content-Length','Content-Range','Accept-Ranges'] as $h) {
            $v = $res->getHeaderLine($h);
            if ($v) $respHeaders[$h] = $v;
        }

        return response()->stream(function () use ($body) {
            while (!$body->eof()) {
                echo $body->read(8192);
            }
        }, in_array($status, [200,206]) ? $status : 200, $respHeaders);

    } catch (\Throwable $e) {
        abort(404, 'File not found');
    }
})->name('pdf.proxy');

// routes/web.php


// Route::get('/api/monkeybusiness', function () {
//     try {
//         // 🔒 Backend ไปดึง API จริง
//         $response = Http::withoutVerifying()->get('http://127.0.0.1:8000/api/fluke');

//         if ($response->successful()) {
//             return response()->json($response->json());
//         } else {
//             return response()->json(['error' => 'Upstream error'], $response->status());
//         }
//     } catch (\Exception $e) {
//         return response()->json([
//             'error' => 'Proxy error',
//             'message' => $e->getMessage()
//         ], 500);
//     }
// });



// // หน้าแรก
// Route::get('/', function () {
//     return view('ToolMaster');
// });

// // หน้าแคลมป์มิเตอร์
// Route::get('ClampMeter', function () {
//     return view('ClampMeter');
// });


// // หน้าตะกร้า
// Route::get('cart', function () {
//     return view('cart');
// });

// Route::get('product-template', function () {
//     $slug = request('slug');
//     $name = request('name');
//     $image = request('image');
//     $columnJ = request('columnJ'); // ✅ รับค่า

//     return view('product-template', compact('slug','name','image','columnJ'));
// });

/* -------------------- Public pages (ไม่ต้องล็อกอิน) -------------------- */
Route::get('/', fn () => view('test.FLUKE_Marketplace'))->name('home');
Route::get('/login', fn () => view('login.Login'))->name('login');
Route::get('/Sign_up', fn () => view('login.Sign_up'))->name('Sign_up');
Route::post('/register', [LoginController::class, 'register'])->name('register.post');


Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.show');          // แสดงโปรไฟล์
Route::post('/profile/update', [ProfileController::class, 'update'])->name('updateprofile.post');             // บันทึกข้อมูลติดต่อ
Route::delete('/profile/subaddress/{idsubaddress}',[ProfileController::class, 'delsub'])->name('delsub');
Route::get('/profile/fetchaddress', [ProfileController::class, 'fetchaddress'])->name('profile.fetchaddress'); // ดึงที่อยู่รอง (JSON)
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
Route::post('/auth/login',[LoginController::class, 'login'])->name('auth.login');

/* -------------------- Protected pages (ต้องล็อกอิน) -------------------- */
Route::post('/logout', function (Request $request) {
    // 1) ออกจากระบบทุก guard (กันพลาดถ้าโปรเจกต์มีหลาย guard)
    foreach (array_keys(config('auth.guards')) as $guard) {
        if (Auth::guard($guard)->check()) {
            Auth::guard($guard)->logout();
        }
    }

    // 2) ลบ remember-me cookie (ถ้าเคยตั้งไว้)
    $defaultGuard = Auth::guard(); // SessionGuard ปัจจุบัน
    if (method_exists($defaultGuard, 'getRecallerName')) {
        Cookie::queue(Cookie::forget($defaultGuard->getRecallerName()));
    }

    // 3) ล้าง session ให้หมด + รีเซ็ต ID + ออก CSRF token ใหม่
    $request->session()->flush();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // 4) เด้งกลับหน้าแรก (เลี่ยง back() ที่อาจย้อนกลับไป POST page)
    return redirect('/');
})->name('logout');



use App\Http\Controllers\DashboardController;
Route::get('/', [DashboardController::class, 'Home'])->name('test.FLUKE_Marketplace');
Route::get('/products', [DashboardController::class, 'showproduct'])
    ->name('product.index');
Route::redirect('/products/category/cart', '/cart')->name('product.category.cart');
Route::redirect('/product/cart', '/cart')->name('product.cart');
Route::redirect('/account/cart', '/cart')->name('profile.cart');
Route::get('/products/category/{slug}', [DashboardController::class, 'byCategory'])
    ->where('slug', '^(?!cart$).+')
    ->name('product.category');    
Route::get('/product/{iditem}', [DashboardController::class, 'showItem'])->name('product.detail');
Route::get('/search/products', [DashboardController::class, 'searchByName'])
    ->name('search.products');
Route::post('/cart/add', [DashboardController::class, 'add'])->name('cart.add');
Route::get('/cart', [DashboardController::class, 'showcart'])->name('cart.show');
Route::get('/cart/json', [DashboardController::class, 'cartJson'])->name('cart.json');
Route::post('/cart/qty', [DashboardController::class, 'cartQty'])->name('cart.qty');
Route::delete('/cart/remove', [DashboardController::class, 'cartRemove'])->name('cart.remove');
Route::post('/cart/remove-many', [DashboardController::class, 'cartRemoveMany'])->name('cart.removeMany');
Route::post('/cart/checkout', [DashboardController::class, 'checkout'])->name('cart.checkout');
Route::post('/profile/subaddress', [ProfileController::class, 'store'])
    ->name('subaddress.address');
Route::get('/profile/addresses', [ProfileController::class, 'addresses'])
     ->name('profile.addresses');
Route::post('/cart/checkout', [CartController::class, 'checkout'])
    ->name('cart.checkout');


use App\Http\Controllers\PdfProxyController;
Route::match(['GET','OPTIONS'], '/pdf-proxy', [PdfProxyController::class, 'fetch']);
