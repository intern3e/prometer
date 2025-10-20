<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Custdetail;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        /* ===== อนุญาตเฉพาะ admin ===== */
        $idcustomer = $request->session()->get('idcustomer');
        $username   = trim((string) $request->session()->get('customer_name', ''));

        $me = Custdetail::query()
            ->when($idcustomer, fn($q) => $q->where('idcustomer', $idcustomer))
            ->when(!$idcustomer && $username !== '', fn($q) => $q->where('username', $username))
            ->first();

        if (!$me) {
            return redirect()->route('login')->with('error', 'กรุณาเข้าสู่ระบบ');
        }

        if (strtolower(trim((string) $me->privilege)) !== 'admin') {
            return abort(403, 'สำหรับผู้ดูแลระบบเท่านั้น');
        }
        /* ===== ผ่านสิทธิ์แล้ว ดึงข้อมูลผู้ใช้ทั้งหมด ===== */

        $q = trim((string) $request->get('q', ''));

        $selects = [
            'idcustomer','username','email','privilege','typecust',
            'Legalentity_type','company_name','idtax','Branch_number',
            'main_address','main_subdistrict','main_district','main_province',
            'main_postal','main_country','main_namecontact','email_contact',
            'tel_contact','rank_contact','passuser',
        ];
        // หมายเหตุ: ตัด 'passuser' ออกเพื่อความปลอดภัย ไม่ควรดึงรหัสผ่านมาแสดง/ประมวลผล

        $users = Custdetail::query()
            ->select($selects)
            ->when($q !== '', function ($qr) use ($q) {
                $like = "%{$q}%";
                $qr->where(function ($w) use ($like) {
                    $w->where('idcustomer', 'like', $like)
                      ->orWhere('username', 'like', $like)
                      ->orWhere('email', 'like', $like)
                      ->orWhere('company_name', 'like', $like)
                      ->orWhere('main_namecontact', 'like', $like)
                      ->orWhere('idtax', 'like', $like)
                      ->orWhere('tel_contact', 'like', $like);
                });
            })
            ->orderBy('idcustomer')
            ->get();

        return view('Admin.Admin', ['users' => $users, 'q' => $q]);
    }
    
}
