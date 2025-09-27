<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

Route::post('/translate', function (Request $req) {
    // รับ texts = อาร์เรย์ของ "ประโยค" ที่ต้องการแปล (ห้ามยาวเกินจำเป็น)
    // รับ target = 'en' | 'th' (ปรับเพิ่มได้)
    $texts = $req->input('texts', []);
    $target = $req->input('target', 'en');

    if (empty($texts) || !is_array($texts)) {
        return response()->json(['translations' => []]);
    }

    // แคชตามเนื้อหาและภาษาเป้าหมาย
    $cacheKey = 'mt:' . md5(json_encode([$texts, $target]));
    $ttl = now()->addDays(7);

    $payload = Cache::remember($cacheKey, $ttl, function () use ($texts, $target) {
        $apiKey = config('services.google_translate.key');
        if (!$apiKey) {
            return ['translations' => array_fill(0, count($texts), '')];
        }

        $endpoint = 'https://translation.googleapis.com/language/translate/v2';

        // เรียก API (ฟอร์ม-เอนโค้ด ส่ง q เป็น array ได้)
        $resp = Http::asForm()->post($endpoint, [
            'key'    => $apiKey,
            'q'      => $texts,
            'target' => $target,
            // 'source' => 'th', // ระบุถ้าต้องบังคับต้นทาง
            'format' => 'text',
        ]);

        if (!$resp->ok()) {
            return ['translations' => array_fill(0, count($texts), '')];
        }

        $data = $resp->json();
        $translated = collect(data_get($data, 'data.translations', []))
            ->pluck('translatedText')
            ->all();

        // เผื่อกรณี API ส่งกลับไม่ครบ
        if (count($translated) !== count($texts)) {
            $translated = array_pad($translated, count($texts), '');
        }

        return ['translations' => $translated];
    });

    return response()->json($payload);
});



