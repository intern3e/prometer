<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Custdetail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash; 
use Throwable;
class LoginController extends Controller
{
    /* ===================== Provider Config (ฮาร์ดโค้ด) ===================== */
    private array $googleConfig = [];
    private array $lineConfig = [
        'client_id'     => '2008050920',                      
        'client_secret' => '7355eeaa67feb39c15eec4f49e3ef513', 
    ];

    /* -------------------- helper เติม config runtime -------------------- */
    private function bootProvider(string $provider, array $config, string $callbackPath): void
    {
        $redirect = 'http://myfluketh.com' . $callbackPath;
        \Log::info("OAuth redirect for {$provider} => {$redirect}");
        config(["services.$provider" => array_merge($config, ['redirect' => $redirect])]);
    }
    private function applyGoogleConfig(): void
    {
      
        $cfg = [
            'client_id'     => config('services.google.client_id'),
            'client_secret' => config('services.google.client_secret'),
            'redirect'      => 'http://myfluketh.com/auth/google/callback',
            
        ];
        config(['services.google' => $cfg]);
        \Log::info("OAuth redirect for google => {$cfg['redirect']}");
    }

    public function googleRedirect()
    {
        $this->applyGoogleConfig(); // ใช้ redirect ที่ฮาร์ดโค้ด
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback(Request $request)
    {
        $this->applyGoogleConfig();

        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (\Throwable $e) {
            return redirect()->route('login')->with('alert', 'ล็อกอิน Google ไม่สำเร็จ');
        }

        $email = strtolower(trim((string) ($googleUser->getEmail() ?? '')));
        if ($email === '') {
            return redirect()->route('login')->with('alert', 'บัญชี Google ไม่มีอีเมล');
        }

        $displayName = (string) ($googleUser->getName()
            ?: (str_contains($email, '@') ? Str::before($email, '@') : $email));

        // รองรับชื่อคอลัมน์ email หรือ e-mail
        $emailCol = Schema::hasColumn('custdetail', 'email') ? 'email'
                : (Schema::hasColumn('custdetail', 'e-mail') ? 'e-mail' : null);

        if (!$emailCol) {
            return redirect()->route('login')->with('alert', 'ไม่พบคอลัมน์ email/e-mail ในตาราง custdetail');
        }

        // ✅ ทำงานในทรานแซกชัน และ "คืนค่า idcustomer" ออกมา
        $idcustomer = DB::transaction(function () use ($email, $emailCol, $displayName) {
            $existing = DB::table('custdetail')
                ->whereRaw("`$emailCol` = ?", [$email])
                ->lockForUpdate()
                ->first();

            if (!$existing) {
                // หา id ถัดไปแบบปลอดภัย (เรียงตามเลขจริง)
                $last = DB::table('custdetail')
                    ->where('idcustomer', 'like', 'cust-%')
                    ->lockForUpdate()
                    ->orderByRaw("CAST(SUBSTRING(idcustomer, 6) AS UNSIGNED) DESC")
                    ->value('idcustomer');

                $n = 1;
                if ($last && preg_match('/^cust-(\d{4,})$/', $last, $m)) {
                    $n = (int)$m[1] + 1;
                }
                $nextId = 'cust-' . str_pad((string)$n, 4, '0', STR_PAD_LEFT);

                $insert = ['idcustomer' => $nextId, $emailCol => $email];
                if (Schema::hasColumn('custdetail', 'username')) {
                    $insert['username'] = $displayName;
                }
                DB::table('custdetail')->insert($insert);

                return $nextId; // ← คืนรหัสลูกค้าใหม่
            } else {
                // อัปเดตชื่อถ้าว่าง
                if (Schema::hasColumn('custdetail', 'username') && empty($existing->username)) {
                    DB::table('custdetail')
                        ->where('idcustomer', $existing->idcustomer)
                        ->update(['username' => $displayName]);
                }
                return $existing->idcustomer; // ← คืนรหัสลูกค้าเดิม
            }
        });

        // ดึงโมเดล Eloquent มาใช้งาน (จะได้มี username แน่ ๆ)
        $cust = Custdetail::find($idcustomer);

        // ล็อกอิน (ไม่ใช้ remember เพื่อเลี่ยงคอลัมน์ remember_token)
        if ($cust) {
            Auth::login($cust);
        } else {
            // fallback ถ้าหาโมเดลไม่เจอ (กรณี schema แปลก)
            return redirect()->route('login')->with('alert', 'ไม่พบผู้ใช้หลังสร้างบัญชี');
        }

        // ✅ เก็บ session (เหมือน flow Google เดิม)
        $request->session()->put([
            'customer_email' => $email,
            'customer_name'  => $cust->username ?? $displayName,
        ]);
        $request->session()->regenerate();

        return redirect('/');
    }

    /* ===================== LINE ===================== */
    public function lineRedirect()
     {
       $this->bootProvider('line', $this->lineConfig, '/auth/line/callback');
        return Socialite::driver('line')
            ->scopes(['openid','profile','email'])
            ->redirect();
    }

    public function lineCallback(Request $request)
    {
        $this->bootProvider('line', $this->lineConfig, '/auth/line/callback');

        try {
            $oauth = Socialite::driver('line')->user(); // stateful
        } catch (\Throwable $e) {
            return redirect()->route('login')->with('error', 'LINE login failed: '.$e->getMessage());
        }

        // ชื่อจาก LINE → ใช้เป็น username
        $displayName =
            $oauth->getName()
            ?: ($oauth->user['displayName'] ?? null)
            ?: $oauth->getNickname()
            ?: 'LINE User';

        // อีเมล (normalize; ถ้า LINE ไม่ส่งมาให้ใช้ placeholder ที่มีโดเมน)
        $email = strtolower(trim((string)($oauth->getEmail() ?? '')));
        if ($email === '') {
            $email = 'line_'.$oauth->getId();
        }

        // upsert ผู้ใช้ (โมเดล custdetail มี booted() เติมค่าอื่นๆ ให้อยู่แล้ว)
        $customer = DB::transaction(function () use ($email, $displayName) {
            $row = Custdetail::firstOrCreate(
                ['email' => $email],
                ['username' => $displayName]
            );

            // sync ชื่อให้ตรงกับ LINE หากเปลี่ยนไป
            if ($row->username !== $displayName) {
                $row->username = $displayName;
                $row->save();
            }
            return $row;
        });

        // ล็อกอิน (ไม่ remember → ไม่แตะ remember_token)
        Auth::login($customer);

        // เก็บลง session เหมือน Google flow
        $user = Auth::user(); // instance ของ custdetail
        $request->session()->put([
            'customer_email' => $email,
            'customer_name'  => $user?->username ?? $displayName,
        ]);
        $request->session()->regenerate();

        return redirect('/');
    }

    /* ===================== Web logout ===================== */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    /* ===================== Mini API ===================== */
    public function apiMe()
    {
        if (Auth::check()) {
            $u = Auth::user();
            return response()->json([
                'authenticated' => true,
                'user' => ['name' => $u->name, 'email' => $u->email],
            ]);
        }
        return response()->json(['authenticated' => false]);
    }

    public function apiLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(['ok' => true]);
    }
    public function login(Request $request)
    {
        $email    = strtolower(trim((string)$request->input('email', '')));
        $password = (string)$request->input('password', '');

        if ($email === '' || $password === '') {
            return back()->with('alert', 'Please enter your email and password.')->withInput();
        }

        // รองรับคอลัมน์ email หรือ e-mail
        $emailCol = Schema::hasColumn('custdetail', 'email') ? 'email'
                : (Schema::hasColumn('custdetail', 'e-mail') ? 'e-mail' : null);

        if (!$emailCol) {
            return back()->with('alert', 'ไม่พบคอลัมน์ email / e-mail ในตาราง custdetail');
        }

        $row = DB::table('custdetail')->where($emailCol, $email)->first();

        if (!$row) {
            return back()->with('alert', 'This account was not found.')->withInput();
        }


        $stored = (string)($row->passuser ?? '');
        if ($stored === '') {
            return back()->with('alert', 'Email error')->withInput();
        }

        $isHashed = Str::startsWith($stored, ['$2y$', '$argon2', '$argon2id$']);
        $valid = $isHashed ? Hash::check($password, $stored) : hash_equals($stored, $password);

        if (!$valid) {
            return back()->with('alert', 'The password is incorrect.')->withInput();
        }

        // โหลดโมเดล Eloquent เพื่อใช้กับ Auth
        $cust = Custdetail::where($emailCol, $email)->first();
        if (!$cust && !empty($row->idcustomer)) {
            $cust = Custdetail::find($row->idcustomer);
        }
        if (!$cust) {
            return back()->with('alert', 'ไม่พบผู้ใช้หลังตรวจสอบรหัสผ่าน');
        }

        // ล็อกอิน (ไม่ remember → ไม่ไปแตะ remember_token)
        Auth::login($cust);

        // เก็บ session สำหรับโชว์หัวเว็บ
        $request->session()->put([
            'customer_email' => $email,
            'customer_name'  => $cust->username ?? 'ผู้ใช้',   
        ]);
        $request->session()->regenerate();

        return redirect('/');
    }
        public function register(Request $request)
    {
        $validated = $request->validate([
            'company_name'     => 'required|string|max:255',
            'Legalentity_type' => 'required|string|max:255',
            'email'            => 'required|string|max:255',
            'idtax'            => 'required|digits:13|unique:custdetail,idtax',
            'Branch_number'    => 'nullable|string|max:255',
            'main_address'     => 'required|string|max:255',
            'main_subdistrict' => 'required|string|max:255',
            'main_district'    => 'required|string|max:255',
            'main_province'    => 'required|string|max:255',
            'main_postal'      => 'required|string|max:20',
            'main_country'     => 'required|string|max:100',
            'main_namecontact' => 'required|string|max:255',
            'rank_contact'     => 'required|string|max:255',
            'email_contact'    => 'required|string|max:255',
            'tel_contact'      => 'required|string|max:50',
            'username'         => 'required|string|max:255|unique:custdetail,username',
            'passuser'         => 'required|string|min:8',
        ]);

        try {
            $user = DB::transaction(function () use ($validated) {
                $user = new Custdetail();
                $user->company_name     = $validated['company_name'];
                $user->Legalentity_type = $validated['Legalentity_type'];
                $user->idtax            = $validated['idtax'];
                $user->email            = $validated['email'];
                $user->Branch_number    = $validated['Branch_number'] ?? null;
                $user->main_address     = $validated['main_address'];
                $user->main_subdistrict = $validated['main_subdistrict'];
                $user->main_district    = $validated['main_district'] ;
                $user->main_province    = $validated['main_province'];
                $user->main_postal      = $validated['main_postal'] ;
                $user->main_country     = $validated['main_country'];
                $user->main_namecontact = $validated['main_namecontact'];
                $user->rank_contact     = $validated['rank_contact'] ;
                $user->email_contact    = $validated['email_contact'];
                $user->tel_contact      = $validated['tel_contact'];
                $user->username         = $validated['username'];
                $user->passuser         = $validated['passuser']; 
                $user->save();

                return $user;
            });

            Log::info('created idcustomer: '.$user->idcustomer);

            return response()->json([
                'success' => 'Register สำเร็จ',
                'id'      => $user->idcustomer,
            ], 201);

        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return response()->json([
                'error' => 'เกิดข้อผิดพลาด: '.$e->getMessage(),
            ], 500);
        }
    }
}