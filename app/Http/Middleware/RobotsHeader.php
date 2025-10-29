<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RobotsHeader
{
    /**
     * กำหนด X-Robots-Tag สำหรับแต่ละหน้า:
     * - allow index: หน้า public ปกติ (/, fluke-marketplace, products, product/{slug}, category/*)
     * - noindex: หน้า private/admin/login/checkout/api ฯลฯ
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // ✅ 1) ข้ามถ้าไม่ใช่ HTML (เช่น JSON, CSS, JS, รูป)
        $contentType = (string) $response->headers->get('Content-Type');
        if (strpos($contentType, 'html') === false) {
            return $response;
        }

        // ✅ 2) ถ้ามี X-Robots-Tag อยู่แล้ว (จาก middleware อื่น) ไม่ทับ
        if ($response->headers->has('X-Robots-Tag')) {
            return $response;
        }

        // ✅ 3) ตรวจ path ปัจจุบันแบบ lowercase
        $path = trim($request->path(), '/');
        $pathLower = strtolower($path);

        // ✅ 4) หน้า allow index เสมอ
        $alwaysAllow = [
            '',              // /
            'robots.txt',
            'sitemap.xml',
            'fluke-marketplace',
            'products',
        ];
        if (in_array($pathLower, $alwaysAllow, true)) {
            $response->headers->set('X-Robots-Tag', 'index, follow');
            return $response;
        }

        // ✅ 5) หน้าที่ "ไม่ควร" ให้ติดดัชนี
        $noindexPatterns = [
            'login*', 'sign_up*', 'register*', 'password/*',
            'cart*', 'checkout*', 'payment*',
            'account*', 'profile*', 'orders*', 'order/*',
            'admin*', 'dashboard*', 'telescope*', 'horizon*', '_debugbar*',
            'api/*', 'storage/*', 'preview*', 'system*',
            'search*', 'test*',
        ];

        // ✅ 6) สรุปผล
        if (Str::is($noindexPatterns, $pathLower)) {
            $response->headers->set('X-Robots-Tag', 'noindex, nofollow, noarchive');
        } else {
            $response->headers->set('X-Robots-Tag', 'index, follow');
        }
        \Log::info('🧭 RobotsHeader active', [
            'path' => $request->path(),
            'contentType' => $response->headers->get('Content-Type'),
        ]);

        return $response;
    }
    
}
