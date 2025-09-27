<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Custdetail;
use App\Models\Subaddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\DB; 
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProfileController extends Controller
{
           public function index()
    {
        return view('product.index');
    }
public function showProfile(Request $request)
{
    $username = trim((string) $request->session()->get('customer_name', ''));
    if ($username === '') {
        return redirect()->route('login')->with('error', 'กรุณาเข้าสู่ระบบ');
    }

    $custdetail = Custdetail::query()
        ->select([
            'idcustomer','username','email','privilege','typecust',
            'Legalentity_type','company_name','idtax','Branch_number',
            'main_address','main_subdistrict','main_district','main_province',
            'main_postal','main_country','main_namecontact','email_contact',
            'tel_contact','rank_contact',
        ])
        ->where('username', $username)
        ->first();

    if (!$custdetail) {
        return redirect()->route('login')->with('error', 'ไม่พบข้อมูลลูกค้า');
    }

    // ── ดึงที่อยู่รอง
    $subaddresses = Subaddress::query()
        ->select([
            'idsubaddress','idcustomer','sub_address','sub_subdistrict',
            'sub_district','sub_province','sub_postal','sub_country',
            'sub_namecontact','sub_email_contact','sub_tel_contact','sub_rank_contact'
        ])
        ->where('idcustomer', $custdetail->idcustomer)
        ->orderBy('idsubaddress')
        ->get();

    // ── Orders: ฟิลเตอร์ + group ตาม id_order + เพจจิเนชัน
    $q       = trim((string)$request->query('q', ''));
    $status  = trim((string)$request->query('status', '')); // ตัวอย่าง: pending, paid, shipped, completed
    $fromStr = trim((string)$request->query('from', ''));   // YYYY-MM-DD
    $toStr   = trim((string)$request->query('to', ''));     // YYYY-MM-DD

    $ordersQuery = Order::query()
        ->where('idcustomer', $custdetail->idcustomer);

    if ($q !== '') {
        $ordersQuery->where(function($w) use ($q) {
            $w->where('id_order', 'like', "%{$q}%")
              ->orWhere('name', 'like', "%{$q}%");
        });
    }

    if ($status !== '') {
        $ordersQuery->where('status', $status);
    }

    // create_at เก็บเป็น string ⇒ สมมติรูปแบบ 'YYYY-MM-DD HH:MM:SS'
    // ถ้ารูปแบบของคุณต่างไป ปรับเงื่อนไขนี้ให้ตรง
    if ($fromStr !== '') {
        $ordersQuery->where('create_at', '>=', $fromStr.' 00:00:00');
    }
    if ($toStr !== '') {
        $ordersQuery->where('create_at', '<=', $toStr.' 23:59:59');
    }

    $rows = $ordersQuery->orderByDesc('create_at')->get();

    // group ตาม id_order แล้วสรุป
    $grouped = $rows->groupBy('id_order')->map(function (Collection $g) {
        // สรุปยอด/จำนวน/วันที่/สถานะ/ตัวอย่างรูป/ชื่อสินค้า (เอาอย่างละนิดให้ดูสวย)
        $totalQty = 0;
        $totalTHB = 0.0;
        $names    = [];
        $thumbs   = [];
        foreach ($g as $r) {
            $qty  = (int)($r->quantity ?? 0);
            $price= (float)($r->webpriceTHB ?? 0);
            $totalQty += $qty;
            $totalTHB += $price * $qty;

            if (!empty($r->name) && count($names) < 3) {
                $names[] = $r->name;
            }
            if (!empty($r->pic) && count($thumbs) < 3) {
                $thumbs[] = $r->pic;
            }
        }

        // ใช้แถวแรกเป็นตัวแทน order metadata
        $first = $g->first();
        return (object)[
            'id_order'   => $first->id_order,
            'status'     => $first->status,
            'create_at'  => $first->create_at,
            'items'      => $g,        // รายการเต็ม (ถ้าจะโชว์ modal รายการย่อย)
            'names'      => $names,
            'thumbs'     => $thumbs,
            'total_qty'  => $totalQty,
            'total_thb'  => $totalTHB,
            'lines'      => $g->count(),
        ];
    })->values();

    // เพจจิเนชัน (หลัง group)
    $page     = (int) max(1, (int)$request->query('page', 1));
    $perPage  = 8; // ปรับได้
    $offset   = ($page - 1) * $perPage;
    $sliced   = $grouped->slice($offset, $perPage)->values();
    $ordersPaged = new LengthAwarePaginator(
        $sliced,
        $grouped->count(),
        $perPage,
        $page,
        ['path' => url()->current(), 'query' => $request->query()]
    );

    // นับจำนวน Order ไม่ซ้ำ
    $ordersCount = $grouped->count();

    // นับ address: main ถ้าไม่ว่าง + จำนวน sub
    $addressesCount = (empty($custdetail->main_address) ? 0 : 1) + $subaddresses->count();

    $mainAddressStr = $this->composeMainAddress($custdetail);

    return view('test.profile', compact(
        'custdetail',
        'subaddresses',
        'mainAddressStr',
        'ordersCount',
        'addressesCount',
        'ordersPaged',   // ✅ ส่งไปใช้ใน View
        'q','status','fromStr','toStr' // เก็บค่า filter เดิมไว้เติม form
    ));
}


    // ใช้ในหน้าแก้ไขข้อมูลติดต่อ
    public function editprofile(Request $request)
    {
        $username = trim((string) $request->session()->get('customer_name', ''));
        if ($username === '') {
            return redirect()->route('login')->with('error', 'กรุณาเข้าสู่ระบบ');
        }

        $custdetail = Custdetail::query()
            ->select([
                'idcustomer','username','email','privilege','typecust',
                'Legalentity_type','company_name','idtax','Branch_number',
                'main_address','main_subdistrict','main_district','main_province',
                'main_postal','main_country','main_namecontact','email_contact',
                'tel_contact','rank_contact',
            ])
            ->where('username', $username)
            ->firstOrFail();

        $mainAddressStr = $this->composeMainAddress($custdetail);

        $subaddresses = Subaddress::query()
            ->where('idcustomer', $custdetail->idcustomer)
            ->orderBy('idsubaddress')
            ->get();

        return view('login.edit', compact('custdetail','mainAddressStr','subaddresses'));
    }
    public function updatesub(Request $request, $idsubaddress)
    {
        try {
            // auth
            $username = trim((string) $request->session()->get('customer_name', ''));
            if ($username === '') {
                return response()->json(['error' => 'unauthorized'], 401);
            }
            $cust = Custdetail::select(['idcustomer'])
                ->where('username', $username)->first();
            if (!$cust) {
                return response()->json(['error' => 'customer not found'], 404);
            }

            // validate
            $data = $request->validate([
                'sub_address'       => 'nullable|string',
                'sub_subdistrict'   => 'nullable|string',
                'sub_district'      => 'nullable|string',
                'sub_province'      => 'nullable|string',
                'sub_postal'        => 'nullable|string',
                'sub_country'       => 'nullable|string',
                'sub_namecontact'   => 'nullable|string',
                'sub_email_contact' => 'nullable|string',
                'sub_tel_contact'   => 'nullable|string',
                'sub_rank_contact'  => 'nullable|string',
            ]);

            // เตรียม payload (ค่า null → '' กันคอลัมน์ not null)
            $update = [
                'sub_address'       => $data['sub_address']       ?? '',
                'sub_subdistrict'   => $data['sub_subdistrict']   ?? '',
                'sub_district'      => $data['sub_district']      ?? '',
                'sub_province'      => $data['sub_province']      ?? '',
                'sub_postal'        => $data['sub_postal']        ?? '',
                'sub_country'       => $data['sub_country']       ?? '',
                'sub_namecontact'   => $data['sub_namecontact']   ?? '',
                'sub_email_contact' => $data['sub_email_contact'] ?? '',
                'sub_tel_contact'   => $data['sub_tel_contact']   ?? '',
                'sub_rank_contact'  => $data['sub_rank_contact']  ?? '',
            ];

            // ✅ อัปเดตเฉพาะเรคคอร์ดนี้เท่านั้น
            $affected = DB::table('subaddress')
                ->where('idcustomer', $cust->idcustomer)
                ->where('idsubaddress', $idsubaddress)
                ->limit(1)
                ->update($update);

            if ($affected === 0) {
                return response()->json(['error' => 'subaddress not found'], 404);
            }

            return response()->json([
                'success'      => true,
                'message'      => 'updated',
                'idsubaddress' => (int) $idsubaddress,
            ]);
        } catch (\Throwable $e) {
            \Log::error('subaddress.update failed', ['msg'=>$e->getMessage()]);
            return response()->json(['error'=>'server error','hint'=>$e->getMessage()], 500);
        }
    }
public function delsub(Request $request, $idsubaddress)
{
    try {
        // 1) auth
        $username = trim((string) $request->session()->get('customer_name', ''));
        if ($username === '') {
            return $request->expectsJson()
                ? response()->json(['error' => 'unauthorized'], 401)
                : redirect()->route('login')->with('error', 'กรุณาเข้าสู่ระบบ');
        }

        // 2) หา idcustomer
        $cust = \App\Models\Custdetail::select('idcustomer')
            ->where('username', $username)
            ->first();

        if (!$cust) {
            return $request->expectsJson()
                ? response()->json(['error' => 'customer not found'], 404)
                : redirect()->back()->with('error', 'ไม่พบลูกค้า');
        }

        // 3) ลบเฉพาะแถวนี้เท่านั้น
        $deleted = \DB::table('subaddress')
            ->where('idcustomer', $cust->idcustomer)
            ->where('idsubaddress', $idsubaddress)
            ->delete();

        if ($deleted === 0) {
            return $request->expectsJson()
                ? response()->json(['error' => 'subaddress not found'], 404)
                : redirect()->back()->with('error', 'ไม่พบที่อยู่นี้หรือถูกลบไปแล้ว');
        }

        // 4) สำเร็จ
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'idsubaddress' => (int) $idsubaddress], 200);
        }

        // กลับไปหน้าโปรไฟล์แท็บ "ที่อยู่"
        return redirect()->to(route('profile.show'));

    } catch (\Throwable $e) {
        \Log::error('delsub failed', ['msg' => $e->getMessage(), 'idsubaddress' => $idsubaddress]);
        return $request->expectsJson()
            ? response()->json(['error' => 'server error', 'hint' => $e->getMessage()], 500)
            : redirect()->back()->with('error', 'เกิดข้อผิดพลาดในการลบ');
    }
}

    private function composeMainAddress(?custdetail $cd): string
    {
        if (!$cd) return '';
        $parts = array_filter([
            $cd->main_address,
            $cd->main_subdistrict,
            $cd->main_district,
            $cd->main_province,
            $cd->main_postal,
            $cd->main_country,
        ]);
        return trim(implode(' ', $parts));
    }
    public function update(Request $request)
    {
        $username = trim((string) $request->session()->get('customer_name', ''));
        if ($username === '') {
            return response()->json(['error' => 'unauthorized'], 401);
        }

        $cd = Custdetail::where('username', $username)->first();
        if (!$cd) {
            return response()->json(['error' => 'not found'], 404);
        }

        $data = $request->only([
            'customer_type',
            'main_namecontact','email_contact','tel_contact','company_name',
            'main_address','main_subdistrict','main_district','main_province','main_postal','main_country',
        ]);

        if (array_key_exists('customer_type', $data)) {
            $data['typecust'] = $data['customer_type'];
            unset($data['customer_type']);
        }

        // ระวัง mass assignment → ตรวจให้แน่ใจว่า fillable ครบ
        $cd->update(array_filter($data, fn($v) => !is_null($v)));

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => 'รับทราบครับจ่ากองร้อย']);
        }
        return redirect('/');
    }
    public function store(Request $request)
        {
        try {
            $username = trim((string) $request->session()->get('customer_name', ''));
            if ($username === '') {
                return response()->json(['error' => 'unauthorized (no session customer_name)'], 401);
            }
            $cust = Custdetail::select(['idcustomer','username'])
                ->where('username', $username)->first();

            if (!$cust) {
                return response()->json(['error' => 'customer not found for username '.$username], 404);
            }
            $data = $request->validate([
                'sub_address'       => 'nullable|string',
                'sub_subdistrict'   => 'nullable|string',
                'sub_district'      => 'nullable|string',
                'sub_province'      => 'nullable|string',
                'sub_postal'        => 'nullable|string',
                'sub_country'       => 'nullable|string',
                'sub_namecontact'   => 'nullable|string',
                'sub_email_contact' => 'nullable|string',
                'sub_tel_contact'   => 'nullable|string',
                'sub_rank_contact'  => 'nullable|string',
            ]);

            // 4) next id
            $nextId = (int) (DB::table('subaddress')
                ->where('idcustomer', $cust->idcustomer)
                ->max('idsubaddress') ?? 0) + 1;

            // 5) insert (ใส่ timestamps เผื่อคอลัมน์ในตารางไม่ null)
            $now = now();
            DB::table('subaddress')->insert([
                'idcustomer'        => $cust->idcustomer,
                'idsubaddress'      => $nextId,
                'sub_address'       => $data['sub_address']       ?? '',
                'sub_subdistrict'   => $data['sub_subdistrict']   ?? '',
                'sub_district'      => $data['sub_district']      ?? '',
                'sub_province'      => $data['sub_province']      ?? '',
                'sub_postal'        => $data['sub_postal']        ?? '',
                'sub_country'       => $data['sub_country']       ?? '',
                'sub_namecontact'   => $data['sub_namecontact']   ?? '',
                'sub_email_contact' => $data['sub_email_contact'] ?? '',
                'sub_tel_contact'   => $data['sub_tel_contact']   ?? '',
                'sub_rank_contact'  => $data['sub_rank_contact']  ?? '',
            ]);

            return response()->json([
                'success'      => true,
                'message'      => 'subaddress created',
                'idsubaddress' => $nextId,
                'redirect' => url('/profile'),
            ]);

        } catch (\Throwable $e) {
            Log::error('subaddress.store failed', [
                'msg'  => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            return response()->json([
                'error' => 'server error',
                'hint'  => $e->getMessage(), 
            ], 500);
            }
    }
 public function addresses(Request $request)
    {
        $username = (string) $request->session()->get('customer_name', '');
        if ($username === '') {
            return response()->json(['error' => 'unauthorized'], 401);
        }

        $cust = Custdetail::select([
                'idcustomer', 'main_namecontact as name',
                'tel_contact as phone', 'email_contact as email',
                'main_address as line1', 'main_subdistrict as subdistrict',
                'main_district as district', 'main_province as province',
                'main_postal as zip', 'main_country as country'
            ])->where('username', $username)->first();

        if (!$cust) return response()->json(['error' => 'customer_not_found'], 404);

        $subs = Subaddress::where('idcustomer', $cust->idcustomer)
            ->get([
                'idsubaddress', 'sub_namecontact as name',
                'sub_tel_contact as phone', 'sub_email_contact as email',
                'sub_address as line1', 'sub_subdistrict as subdistrict',
                'sub_district as district', 'sub_province as province',
                'sub_postal as zip', 'sub_country as country'
            ]);

        return response()->json([
            'main' => [
                'name'       => $cust->name,
                'phone'      => $cust->phone,
                'email'      => $cust->email,
                'line1'      => $cust->line1,
                'subdistrict'=> $cust->subdistrict,
                'district'   => $cust->district,
                'province'   => $cust->province,
                'zip'        => $cust->zip,
                'country'    => $cust->country,
            ],
            'subs' => $subs,
        ]);
    }
}

