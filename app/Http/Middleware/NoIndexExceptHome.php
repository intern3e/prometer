<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NoIndexExceptHome
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // ไม่ยุ่งกับไฟล์ที่ไม่ใช่ HTML และ endpoint พิเศษ
        $path = ltrim($request->path(), '/');
        $ct   = $response->headers->get('Content-Type') ?? '';
        $isHtml = stripos($ct, 'text/html') !== false;

        if (!$isHtml) {
            return $response;
        }
        if ($path === '' || $path === '/') {
            // หน้าแรก: อนุญาตให้ index ชัดเจน (จะมีหรือไม่มีก็ได้)
            $response->headers->set('X-Robots-Tag', 'index, follow');
            return $response;
        }
        if (in_array($path, ['sitemap.xml','robots.txt'])) {
            return $response;
        }

        // หน้าที่เหลือทั้งหมด: ไม่ให้ index
        $response->headers->set('X-Robots-Tag', 'noindex, nofollow, noarchive');
        return $response;
    }
}
