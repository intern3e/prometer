<!DOCTYPE html>
<html lang="th">
<head>
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FLUKE Marketplace | Sign In</title>
  <link rel="icon" type="image/png" href="https://img5.pic.in.th/file/secure-sv1/ChatGPT_Image_18_.._2568_12_03_57-removebg-preview.png">

  <!-- Fonts & Icons -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root{
      --brand:#ff6a00; --ink:#111827; --card:#ffffff; --bg:#f3f4f6;
      --muted:#6b7280; --ring: rgba(255,122,24,.28); --radius:16px;
    }
    html, body { height:100%; margin:0; overscroll-behavior:none; }
    body{ font-family:'Prompt',sans-serif; background:var(--bg); color:var(--ink); }
    .container-max{ max-width:1200px; } .container-outer{ max-width:1200px; } .section-pad{ padding:0 1rem; }
    .card{ background:var(--card); border:1px solid rgba(17,24,39,.08); border-radius:var(--radius);
           box-shadow:0 4px 24px rgba(0,0,0,.05); transition:box-shadow .2s ease, border-color .2s ease, transform .2s ease; }
    .card:hover{ box-shadow:0 16px 40px rgba(0,0,0,.08); transform:translateY(-1px); }
    .input{ width:100%; border:1px solid rgb(209 213 219); background:#fff; padding:.7rem .95rem; border-radius:.8rem; outline:none;
            transition: box-shadow .2s ease, border-color .2s ease, background .2s ease; }
    .input:focus{ border-color:#fb923c; box-shadow:0 0 0 6px var(--ring); }
    .btn-primary{ background:linear-gradient(90deg,#ff7a18 0%, #ff6a00 100%); color:#fff; border-radius:9999px; height:3rem; font-weight:700; width:100%;
                  box-shadow:0 6px 20px rgba(255,122,24,.35); transition: filter .15s ease, transform .08s ease, box-shadow .2s ease; }
    .btn-primary:hover{ filter:brightness(.98); box-shadow:0 10px 26px rgba(255,122,24,.45); }
    .btn-primary:active{ transform:translateY(1px) scale(.998); }
    .divider{ position:relative; margin:1.25rem 0; } .divider::before{ content:""; position:absolute; inset:0; height:1px; background:rgb(229 231 235); top:50%; }
    .divider span{ position:relative; display:inline-block; background:#fff; padding:0 .65rem; color:#6b7280; font-size:.9rem; left:50%; transform:translateX(-50%); }
    .glass{ background:#ffffff; border:1px solid rgba(0,0,0,.1); }
  </style>
</head>
<body>
<div class="min-h-screen flex flex-col">
  <!-- Top Nav -->
  <nav class="sticky top-0 z-40 bg-white border-b border-gray-200">
    <div class="mx-auto container-max px-4 py-3 md:py-4 flex items-center justify-between">
      <a href="/" class="flex items-center gap-3 group">
        <div class="h-11 w-11 rounded-full bg-white border flex items-center justify-center shadow-sm">
          <i class="bi bi-tools text-[var(--brand)] text-xl"></i>
        </div>
        <span class="text-xl md:text-2xl font-bold tracking-wide text-gray-900 group-hover:text-orange-600 transition" data-i18n="brand_name">FLUKE</span>
      </a>
      <div class="relative">
        <button id="currentLangBtn" class="flex items-center gap-2 px-3 py-1.5 rounded-lg border border-gray-200 hover:bg-orange-50 text-gray-700">
          <span id="currentLangLabel">ไทย</span>
          <i class="bi bi-caret-down-fill text-xs"></i>
        </button>
        <div id="langDropdown" class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg hidden z-50">
          <div class="border-b px-3 py-2 text-xs text-gray-400" data-i18n="lang_label">Language</div>
          <div class="border-t">
            <div class="lang-item px-4 py-2 hover:bg-orange-50 cursor-pointer" data-lang="ไทย">ไทย</div>
            <div class="lang-item px-4 py-2 hover:bg-orange-50 cursor-pointer" data-lang="English">English</div>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- Main -->
  <main class="flex-1 bg-[var(--bg)]">
    <div class="mx-auto container-max grid grid-cols-1 lg:grid-cols-2">
      <!-- LEFT -->
      <section class="relative hidden lg:flex items-stretch">
        <div class="relative w-full overflow-hidden rounded-none lg:rounded-r-[28px] bg-[#f3f4f6] shadow-sm">
          <div class="relative h-full px-10 py-12 flex flex-col">
            <div class="glass text-gray-900 inline-flex items-center gap-2 px-3 py-1 rounded-xl w-max">
              <i class="bi bi-shield-check text-orange-600"></i>
              <span class="text-sm" data-i18n="left_badge">ผู้แทนจำหน่าย FLUKE</span>
            </div>
            <h1 class="text-3xl xl:text-4xl font-bold text-gray-900 mt-5 leading-tight">
              <span data-i18n="left_h1_a">เครื่องมือวัดอุตสาหกรรมระดับโปร</span><br>
              <span class="text-orange-600"><span data-i18n="left_h1_b">พร้อมบริการครบวงจร</span></span>
            </h1>
            <p class="text-gray-600 mt-3 max-w-[520px]" data-i18n="left_p">
              เข้าถึงสินค้าแท้ การรับประกันมาตรฐาน และ ทีมซัพพอร์ตที่เชี่ยวชาญ—ในที่เดียว
            </p>
            <ul class="mt-6 space-y-3 text-gray-800">
              <li class="flex items-start gap-3"><i class="bi bi-check2-circle text-orange-600 text-xl leading-6"></i>
                <div><div class="font-semibold" data-i18n="left_li1_a">จัดส่งรวดเร็ว • Tracking ออนไลน์</div>
                  <div class="text-gray-500 text-sm" data-i18n="left_li1_b">ครอบคลุมทั่วประเทศ ภายใน 5–7 วันทำการ*</div></div></li>
              <li class="flex items-start gap-3"><i class="bi bi-check2-circle text-orange-600 text-xl leading-6"></i>
                <div><div class="font-semibold" data-i18n="left_li2_a">ชำระเงินหลายรูปแบบ</div>
                  <div class="text-gray-500 text-sm" data-i18n="left_li2_b">บัตร/โอน/วางบิลบริษัท/เก็บเงินปลายทาง</div></div></li>
              <li class="flex items-start gap-3"><i class="bi bi-check2-circle text-orange-600 text-xl leading-6"></i>
                <div><div class="font-semibold" data-i18n="left_li3_a">บริการหลังการขายครบวงจร</div>
                  <div class="text-gray-500 text-sm" data-i18n="left_li3_b">ดูแลซ่อมบำรุง อะไหล่แท้ พร้อมทีมผู้เชี่ยวชาญ</div></div></li>
              <li class="flex items-start gap-3"><i class="bi bi-check2-circle text-orange-600 text-xl leading-6"></i>
                <div><div class="font-semibold" data-i18n="left_li4_a">การรับประกันมาตรฐานสากล</div>
                  <div class="text-gray-500 text-sm" data-i18n="left_li4_b">สินค้ารับประกันตรงจากผู้ผลิต มั่นใจคุณภาพ</div></div></li>
              <li class="flex items-start gap-3"><i class="bi bi-check2-circle text-orange-600 text-xl leading-6"></i>
                <div><div class="font-semibold" data-i18n="left_li5_a">ที่ปรึกษาด้านเทคนิค</div>
                  <div class="text-gray-500 text-sm" data-i18n="left_li5_b">ให้คำแนะนำการใช้งานจริงจากทีมผู้เชี่ยวชาญ</div></div></li>
            </ul>
          </div>
        </div>
      </section>

      <!-- RIGHT: Login -->
      <section class="bg-[var(--bg)] flex items-center justify-center px-4 py-10 md:py-14">
        <div class="w-full max-w-[520px]">
          <div class="text-center mb-6">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-50 border border-orange-200 text-orange-600">
              <i class="bi bi-unlock"></i> <span class="text-sm" data-i18n="badge_login">ลงชื่อเข้าสู่ระบบ</span>
            </div>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mt-3" data-i18n="signin_title">ยินดีต้อนรับกลับมา</h2>
            <p class="text-gray-500 mt-1 text-sm" data-i18n="signin_sub">เข้าสู่ระบบเพื่อจัดการคำสั่งซื้อ ใบเสนอราคา และบริการหลังการขาย</p>
          </div>

          <div class="card p-5 md:p-6">
            
            <?php if(session('error')): ?>
              <div class="mb-4 p-3 rounded-lg bg-red-50 border border-red-200 text-red-700">
                <?php echo e(session('error')); ?>

              </div>
            <?php endif; ?>

            <form id="loginForm" class="space-y-4" method="POST" action="<?php echo e(route('auth.login')); ?>" novalidate>
                <?php echo csrf_field(); ?>

                
                <?php if($errors->any()): ?>
                  <div class="rounded-md bg-red-50 border border-red-200 p-3 text-sm text-red-700">
                    <?php echo e($errors->first()); ?>

                  </div>
                <?php endif; ?>

                <div>
                  <label for="email" class="block text-sm font-medium text-gray-700 mb-1" data-i18n="label_email">อีเมล</label>
                  <input id="email" name="email" type="email" inputmode="email" autocomplete="username"
                        class="input" data-i18n="ph_email" data-i18n-attr="placeholder"
                        placeholder="you@example.com" value="<?php echo e(old('email')); ?>" required>
                  <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                  <div class="flex items-center justify-between mb-1">
                    <label for="password" class="block text-sm font-medium text-gray-700" data-i18n="label_password">รหัสผ่าน</label>
                    <a href="#" class="text-sm text-orange-600 hover:underline" data-i18n="forgot_pw">ลืมรหัสผ่าน?</a>
                  </div>
                  <div class="relative">
                    <input id="password" name="password" type="password" autocomplete="current-password"
                          class="input pr-11" minlength="6" data-i18n="ph_password" data-i18n-attr="placeholder"
                          placeholder="••••••••" required>
                    <button type="button" class="absolute inset-y-0 right-0 px-3 text-gray-500" aria-label="Toggle password"
                            onclick="const p=document.getElementById('password'); p.type = p.type==='password'?'text':'password'; this.classList.toggle('text-orange-500')">
                      <i class="bi bi-eye"></i>
                    </button>
                  </div>
                  <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <button type="submit" class="btn-primary" data-i18n="btn_signin">เข้าสู่ระบบ</button>
              </form>
<?php if(session('alert')): ?>
  <script>
    alert(<?php echo json_encode(session('alert'), 15, 512) ?>);
  </script>
<?php endif; ?>
            <div class="divider"><span data-i18n="or_text">หรือ</span></div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
              <!-- ปุ่ม Google เป็นลิงก์ไป route -->
              <a href="<?php echo e(route('google.redirect')); ?>"
                 class="flex items-center justify-center gap-2 h-11 rounded-lg font-medium text-white bg-red-500 hover:bg-red-600 transition">
                <i class="bi bi-google"></i>
                <span class="text-sm" data-i18n="btn_google">Google</span>
              </a>
              <a href="<?php echo e(route('line.redirect')); ?>" 
                class="flex items-center justify-center gap-2 h-11 rounded-lg font-medium text-white bg-green-500 hover:bg-green-600 transition">
                <img src="https://upload.wikimedia.org/wikipedia/commons/4/41/LINE_logo.svg" alt="LINE" class="h-5 w-5">
                <span class="text-sm">LINE</span>
              </a>

            </div>

            <p class="text-center text-sm text-gray-600 mt-5">
              <span data-i18n="new_here">เพิ่งใช้ FLUKE Marketplace ใช่ไหม?</span>
              <a href="<?php echo e(route('Sign_up')); ?>" class="text-orange-600 font-semibold hover:underline" data-i18n="register_now">ลงทะเบียนตอนนี้</a>
            </p>
          </div>

          <div class="mt-5 flex items-center justify-center gap-2 text-gray-500 text-sm">
            <i class="bi bi-shield-lock"></i>
            <span data-i18n="security_note">ข้อมูลของคุณปลอดภัยด้วยการเข้ารหัสมาตรฐานอุตสาหกรรม</span>
          </div>
        </div>
      </section>
    </div>
  </main>
</div>



  <!-- ===== Footer ===== -->
  <footer class="bg-gray-900 text-white mt-10">
    <div class="container-outer mx-auto section-pad py-10">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-sm">
        <div>
          <h4 class="font-semibold text-orange-300 mb-3" data-i18n="footer_contact">ติดต่อเรา</h4>
          <p class="text-gray-300" data-i18n="footer_branch">สาขาของเรา</p>
          <p class="text-gray-300" data-i18n="footer_social">Facebook / YouTube</p>
          <p class="text-gray-300 flex items-center gap-2 mt-2">
            <i class="bi bi-telephone"></i> <span>1-800-561-8187</span>
          </p>
          <p class="text-gray-300 flex items-center gap-2">
            <i class="bi bi-envelope"></i> <span>info@toolshop.com</span>
          </p>
        </div>
        <div>
          <h4 class="font-semibold text-orange-300 mb-3" data-i18n="footer_service">บริการของเรา</h4>
          <ul class="space-y-1 text-gray-300">
            <li data-i18n="footer_calib">ห้องปฏิบัติการสอบเทียบ</li>
            <li data-i18n="footer_promo">สินค้าโปรโมชั่น</li>
            <li data-i18n="footer_warranty">การรับประกันสินค้า</li>
            <li data-i18n="footer_repair">บริการซ่อมแซม</li>
          </ul>
        </div>
        <div>
          <h4 class="font-semibold text-orange-300 mb-3" data-i18n="footer_info">ข้อมูล</h4>
          <ul class="space-y-1 text-gray-300">
            <li data-i18n="footer_ship">ค่าขนส่ง</li>
            <li data-i18n="footer_terms">ข้อกำหนด / ความเป็นส่วนตัว</li>
            <li data-i18n="footer_order">วิธีการสั่งซื้อ</li>
            <li data-i18n="footer_faq">คำถามที่พบบ่อย</li>
          </ul>
        </div>
        <div>
          <h4 class="font-semibold text-orange-300 mb-3" data-i18n="footer_payment">วิธีชำระเงิน</h4>
          <ul class="space-y-1 text-gray-300">
            <li data-i18n="footer_cards">Visa / Mastercard / โอนเงิน</li>
            <li data-i18n="footer_transfer">รองรับการโอนผ่านบัญชีบริษัท</li>
            <li data-i18n="footer_cod">เงินสดปลายทาง</li>
          </ul>
        </div>
      </div>
      <div class="mt-8 border-t border-gray-700 pt-6 text-center text-xs text-gray-400" data-i18n="copyright">
        © 2024 FLUKE. สงวนลิขสิทธิ์ทั้งหมด
      </div>
    </div>
  </footer>

<!-- ===== Scripts ===== -->
<script>
  // ===== I18N DICTIONARY =====
  const I18N = {
    'ไทย': {
      brand_name:'FLUKE',
      lang_label:'เลือกภาษา',
      // Left hero
      left_badge:'ผู้แทนจำหน่าย FLUKE',
      left_h1_a:'เครื่องมือวัดอุตสาหกรรมระดับโปร',
      left_h1_b:'พร้อมบริการครบวงจร',
      left_p:'เข้าถึงสินค้าแท้ การรับประกันมาตรฐาน และ ทีมซัพพอร์ตที่เชี่ยวชาญ—ในที่เดียว',
      left_li1_a:'จัดส่งรวดเร็ว • Tracking ออนไลน์',
      left_li1_b:'ครอบคลุมทั่วประเทศ ภายใน 5–7 วันทำการ*',
      left_li2_a:'ชำระเงินหลายรูปแบบ',
      left_li2_b:'บัตร/โอน/วางบิลบริษัท/เก็บเงินปลายทาง',
      left_li3_a:'บริการหลังการขายครบวงจร',
      left_li3_b:'ดูแลซ่อมบำรุง อะไหล่แท้ พร้อมทีมผู้เชี่ยวชาญ',
      left_li4_a:'การรับประกันมาตรฐานสากล',
      left_li4_b:'สินค้ารับประกันตรงจากผู้ผลิต มั่นใจคุณภาพ',
      left_li5_a:'ที่ปรึกษาด้านเทคนิค',
      left_li5_b:'ให้คำแนะนำการใช้งานจริงจากทีมผู้เชี่ยวชาญ',

      // Right: form
      badge_login:'ลงชื่อเข้าสู่ระบบ',
      signin_title:'ยินดีต้อนรับกลับมา',
      signin_sub:'เข้าสู่ระบบเพื่อจัดการคำสั่งซื้อ ใบเสนอราคา และบริการหลังการขาย',
      label_email:'อีเมล',
      label_password:'รหัสผ่าน',
      ph_email:'you@example.com',
      ph_password:'••••••••',
      forgot_pw:'ลืมรหัสผ่าน?',
      btn_signin:'เข้าสู่ระบบ',
      or_text:'หรือ',
      btn_google:'Google',
      btn_facebook:'Facebook',
      new_here:'เพิ่งใช้ FLUKE Marketplace ใช่ไหม?',
      register_now:'ลงทะเบียนตอนนี้',
      security_note:'ข้อมูลของคุณปลอดภัยด้วยการเข้ารหัสมาตรฐานอุตสาหกรรม',

      // Validation & alerts
      err_email:'กรุณากรอกอีเมลให้ถูกต้อง',
      err_password:'รหัสผ่านต้องมีอย่างน้อย 6 อักขระ',
      alert_success:'ล็อกอินสำเร็จ (demo)',

      // Footer
      footer_contact:'ติดต่อเรา', footer_branch:'สาขาของเรา', footer_social:'Facebook / YouTube',
      footer_service:'บริการของเรา', footer_calib:'ห้องปฏิบัติการสอบเทียบ', footer_promo:'สินค้าโปรโมชั่น',
      footer_warranty:'การรับประกันสินค้า', footer_repair:'บริการซ่อมแซม',
      footer_info:'ข้อมูล', footer_ship:'ค่าขนส่ง', footer_terms:'ข้อกำหนด / ความเป็นส่วนตัว',
      footer_order:'วิธีการสั่งซื้อ', footer_faq:'คำถามที่พบบ่อย',
      footer_payment:'วิธีชำระเงิน', footer_cards:'Visa / Mastercard / โอนเงิน',
      footer_transfer:'รองรับการโอนผ่านบัญชีบริษัท', footer_cod:'เงินสดปลายทาง',
      copyright:'© 2024 FLUKE. สงวนลิขสิทธิ์ทั้งหมด'
    },
    'English': {
      brand_name:'FLUKE',
      lang_label:'Choose language',
      // Left hero
      left_badge:'Authorized FLUKE Dealer',
      left_h1_a:'Pro-grade industrial measuring tools',
      left_h1_b:'with end-to-end services',
      left_p:'Access genuine products, standard warranty, and expert support — all in one place.',
      left_li1_a:'Fast shipping • Online tracking',
      left_li1_b:'Nationwide coverage within 5–7 business days*',
      left_li2_a:'Multiple payment options',
      left_li2_b:'Card/Transfer/Corporate invoice/COD',
      left_li3_a:'Full after-sales service',
      left_li3_b:'Maintenance with genuine parts and experts',
      left_li4_a:'International-standard warranty',
      left_li4_b:'Manufacturer-backed products you can trust',
      left_li5_a:'Technical consultation',
      left_li5_b:'Hands-on guidance from specialists',

      // Right: form
      badge_login:'Sign in',
      signin_title:'Welcome back',
      signin_sub:'Sign in to manage orders, quotations, and after-sales services.',
      label_email:'Email',
      label_password:'Password',
      ph_email:'you@example.com',
      ph_password:'••••••••',
      forgot_pw:'Forgot password?',
      btn_signin:'Sign in',
      or_text:'or',
      btn_google:'Google',
      btn_facebook:'Facebook',
      new_here:'New to FLUKE Marketplace?',
      register_now:'Register now',
      security_note:'Your data is protected with industry-standard encryption.',

      // Validation & alerts
      err_email:'Please enter a valid email.',
      err_password:'Password must be at least 6 characters.',
      alert_success:'Login successful (demo)',

      // Footer
      footer_contact:'Contact Us', footer_branch:'Our Branches', footer_social:'Facebook / YouTube',
      footer_service:'Our Services', footer_calib:'Calibration Laboratory', footer_promo:'Promotion Products',
      footer_warranty:'Warranty', footer_repair:'Repair Service',
      footer_info:'Information', footer_ship:'Shipping Cost', footer_terms:'Terms / Privacy Policy',
      footer_order:'How to Order', footer_faq:'FAQ',
      footer_payment:'Payment Methods', footer_cards:'Visa / Mastercard / Bank Transfer',
      footer_transfer:'Support company account transfer', footer_cod:'Cash on Delivery',
      copyright:'© 2024 FLUKE. All rights reserved'
    }
  };

  // ===== I18N ENGINE =====
  function applyI18n(lang){
    const dict = I18N[lang] || I18N['ไทย'];
    document.documentElement.lang = (lang === 'ไทย') ? 'th' : 'en';
    document.title = (lang === 'ไทย')
      ? 'เครื่องมืออุตสาหกรรม FLUKE'
      : 'FLUKE Industrial Tools';

    document.querySelectorAll('[data-i18n]').forEach(el=>{
      const key = el.getAttribute('data-i18n');
      const val = dict[key];
      if(val == null) return;
      const attr = el.getAttribute('data-i18n-attr');
      if(attr){ el.setAttribute(attr, val); } else { el.textContent = val; }
    });

    const label = document.getElementById('currentLangLabel');
    if(label) label.textContent = (lang === 'ไทย') ? 'ไทย' : 'English';

    localStorage.setItem('preferredLanguage', lang);
    localStorage.setItem('site_lang', lang);

    window.dispatchEvent(new CustomEvent('site_lang_changed', { detail:{ lang } }));
  }

  // ===== Init & Events =====
  document.addEventListener('DOMContentLoaded', () => {
    const langDropdown = document.getElementById('langDropdown');
    const currentLangBtn = document.getElementById('currentLangBtn');

    if (currentLangBtn && langDropdown){
      currentLangBtn.addEventListener('click', (e)=>{
        e.stopPropagation();
        langDropdown.classList.toggle('hidden');
      });
      document.addEventListener('click', (e)=>{
        const hit = e.target.closest('#langDropdown, #currentLangBtn');
        if(!hit){ langDropdown.classList.add('hidden'); }
      });
    }

    document.querySelectorAll('.lang-item').forEach(item=>{
      item.addEventListener('click', ()=>{
        const lang = item.getAttribute('data-lang') || 'ไทย';
        applyI18n(lang);
        if (langDropdown) langDropdown.classList.add('hidden');
      });
    });

    const saved = localStorage.getItem('preferredLanguage') || 'ไทย';
    localStorage.setItem('site_lang', saved);
    applyI18n(saved);
  });

  // ===== Simple Form Scripts (with i18n messages) =====
  function handleSubmit(e){
    e.preventDefault();
    const email = document.getElementById('email');
    const pass  = document.getElementById('password');
    const emailErr = document.getElementById('emailErr');
    const passErr  = document.getElementById('passErr');

    // ใช้ภาษาที่บันทึกไว้
    const lang = localStorage.getItem('preferredLanguage') || 'ไทย';
    const T = I18N[lang] || I18N['ไทย'];

    let ok = true;

    if(!/^\S+@\S+\.\S+$/.test(email.value.trim())){
      emailErr.textContent = T.err_email;
      emailErr.classList.remove('hidden');
      email.classList.add('ring-2','ring-red-300','border-red-400');
      ok = false;
    }else{
      emailErr.classList.add('hidden');
      email.classList.remove('ring-2','ring-red-300','border-red-400');
    }

    if((pass.value || '').length < 6){
      passErr.textContent = T.err_password;
      passErr.classList.remove('hidden');
      pass.classList.add('ring-2','ring-red-300','border-red-400');
      ok = false;
    }else{
      passErr.classList.add('hidden');
      pass.classList.remove('ring-2','ring-red-300','border-red-400');
    }

    if(ok){
      alert(T.alert_success);
    }
  }
</script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\tool\resources\views/login/Login.blade.php ENDPATH**/ ?>