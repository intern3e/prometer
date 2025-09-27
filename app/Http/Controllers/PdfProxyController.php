<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PdfProxyController extends Controller
{
    // โดเมนที่อนุญาต (กัน open proxy)
    private array $allowHosts = [
        'www.myflukestore.com','myflukestore.com',
        'www.es.co.th','es.co.th',
    ];

    // ปิด/เปิด SSL verify (ชั่วคราวเพื่อ debug)
    private const VERIFY_SSL = false; // เปลี่ยนเป็น true เมื่อใช้จริง

    public function fetch(Request $req)
    {
        // CORS preflight
        if ($req->isMethod('OPTIONS')) {
            return response('OK', 200)->withHeaders($this->cors());
        }

        $url = $req->query('url');
        if (!$url) {
            return response('Missing url', 400)->withHeaders($this->cors());
        }

        // ตรวจ url + allowlist
        $p = parse_url($url);
        if (!isset($p['scheme'], $p['host'])) {
            return response('Invalid url', 400)->withHeaders($this->cors());
        }
        $host = strtolower($p['host']);
        if (!in_array($host, $this->allowHosts, true)) {
            return response('Host not allowed', 403)->withHeaders($this->cors());
        }
        if (!preg_match('/\.pdf(\?|#|$)/i', $url)) {
            return response('Only PDF is allowed', 400)->withHeaders($this->cors());
        }

        try {
            // ส่งต่อ Range (ให้ upstream ตอบ 206)
            $forwardHeaders = [
                'User-Agent'      => $req->header('User-Agent', 'Mozilla/5.0'),
                'Referer'         => ($p['scheme'] ?? 'https').'://'.$host.'/',
                'Accept'          => 'application/pdf,*/*;q=0.8',
                'Accept-Language' => 'en-US,en;q=0.9',
            ];
            if ($req->headers->has('Range')) {
                $forwardHeaders['Range'] = $req->header('Range');
            }

            // ใช้ Laravel Http (stream)
            $response = Http::withHeaders($forwardHeaders)
                ->withOptions([
                    'stream'        => true,
                    'verify'        => self::VERIFY_SSL, // false ช่วย debug SSL
                    'allow_redirects' => ['max' => 5, 'referer' => true],
                    'http_errors'   => false, // อย่า throw exception อัตโนมัติ
                ])
                ->get($url);

            $status = $response->status();
            if ($status < 200 || $status >= 400) {
                return response("Upstream error ($status)", 502)->withHeaders($this->cors());
            }

            // ดึง header สำคัญจาก upstream
            $h = $response->headers();
            $contentType  = $h['Content-Type'][0]  ?? 'application/pdf';
            $contentLen   = $h['Content-Length'][0] ?? null;
            $acceptRanges = $h['Accept-Ranges'][0] ?? 'bytes';
            $contentRange = $h['Content-Range'][0] ?? null;
            $etag         = $h['ETag'][0]          ?? null;
            $lastModified = $h['Last-Modified'][0] ?? null;

            $outHeaders = [
                'Content-Type'                  => $contentType,
                'Content-Disposition'           => 'inline; filename="document.pdf"',
                'Accept-Ranges'                 => $acceptRanges,
                'Access-Control-Expose-Headers' => 'Content-Length, Content-Type, Accept-Ranges, Content-Range, ETag, Last-Modified',
                'Cache-Control'                 => 'public, max-age=86400',
            ] + $this->cors();

            if ($contentLen)   $outHeaders['Content-Length'] = $contentLen;
            if ($contentRange) $outHeaders['Content-Range']  = $contentRange;
            if ($etag)         $outHeaders['ETag']           = $etag;
            if ($lastModified) $outHeaders['Last-Modified']  = $lastModified;

            // สตรีมเนื้อหาออกไป
            $stream = $response->toPsrResponse()->getBody();

            return new StreamedResponse(function () use ($stream) {
                while (!$stream->eof()) {
                    echo $stream->read(8192);
                    flush();
                }
            }, $status, $outHeaders);

        } catch (\Throwable $e) {
            // log แล้วตอบข้อความอ่านง่าย (หลีกเลี่ยง 500 เงียบ)
            \Log::error('PDF proxy error: '.$e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response('Proxy exception: '.$e->getMessage(), 502)->withHeaders($this->cors());
        }
    }

    private function cors(): array
    {
        return [
            'Access-Control-Allow-Origin'  => '*',
            'Access-Control-Allow-Methods' => 'GET,OPTIONS',
            'Access-Control-Allow-Headers' => 'Range,Accept,Origin,Referer,User-Agent',
            'Cross-Origin-Resource-Policy' => 'cross-origin',
        ];
    }
}
