<!DOCTYPE html>
<html lang="th">
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FLUKE Marketplace | Sign Up (Corporate)</title>
  <link rel="icon" type="image/png" href="https://img5.pic.in.th/file/secure-sv1/ChatGPT_Image_18_.._2568_12_03_57-removebg-preview.png">

  <!-- Fonts & Icons -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root{
      --brand:#ff6a00;
      --ink:#111827;
      --card:#ffffff;
      --bg:#f3f4f6; 
      --muted:#6b7280;
      --ring: rgba(255,122,24,.28);
      --radius:16px;
    }
    html, body {
  height: 100%;
  margin: 0;
  overscroll-behavior: none; /* ป้องกัน scroll เกิน */
}

    html, body { height:100%; }
    body{ font-family:'Prompt',sans-serif; background:var(--bg); color:var(--ink); }

    .container-max{ max-width:1200px; }
    .section-pad{ padding-left:1rem; padding-right:1rem; }

    .card{
      background:var(--card);
      border:1px solid rgba(17,24,39,.08);
      border-radius:var(--radius);
      box-shadow:0 4px 24px rgba(0,0,0,.05);
      transition:box-shadow .2s ease, border-color .2s ease, transform .2s ease;
    }
    .card:hover{ box-shadow:0 16px 40px rgba(0,0,0,.08); transform:translateY(-1px); }
    .input{
      width:100%; border:1px solid rgb(209 213 219); background:#fff;
      padding:.7rem .95rem; border-radius:.8rem; outline:none;
      transition: box-shadow .2s ease, border-color .2s ease, background .2s ease;
    }
    .input:focus{ border-color:#fb923c; box-shadow:0 0 0 6px var(--ring); }
    .btn-primary{
      background:linear-gradient(90deg,#ff7a18 0%, #ff6a00 100%); color:#fff; border-radius:9999px; height:3rem;
      font-weight:700; width:100%;
      box-shadow:0 6px 20px rgba(255,122,24,.35);
      transition: filter .15s ease, transform .08s ease, box-shadow .2s ease;
    }
    .btn-primary:hover{ filter:brightness(.98); box-shadow:0 10px 26px rgba(255,122,24,.45); }
    .btn-primary:active{ transform:translateY(1px) scale(.998); }
    .help{ font-size:.8rem; color:var(--muted); }
    .section-title{ font-weight:700; font-size:1rem; color:#111827; }
    .grid-gap{ display:grid; gap:1rem; }
    .err{ font-size:.85rem; color:#dc2626; }
    .divider{ height:1px; background:rgb(229 231 235); }
    .badge{ font-size:.75rem; padding:.25rem .5rem; border-radius:9999px; background:#fff7ed; color:#9a3412; border:1px solid #fed7aa; }

    /* === Custom file input (i18n-able) === */
    .filebox{display:flex;align-items:center;gap:.75rem}
    .file-trigger{
      display:inline-flex;align-items:center;gap:.5rem;
      padding:.55rem .9rem;border:1px solid #e5e7eb;border-radius:.8rem;background:#fff;
      cursor:pointer;transition:background .15s ease, box-shadow .2s ease
    }
    .file-trigger:hover{background:#f9fafb;box-shadow:0 4px 12px rgba(0,0,0,.06)}
    .file-name{font-size:.9rem;color:var(--muted);max-width:100%;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
    .sr-only{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0}
  </style>
</head>
<body>

<div class="min-h-screen flex flex-col">
  <!-- ===== Top Nav ===== -->
  <nav class="sticky top-0 z-40 bg-white border-b border-gray-200">
    <div class="mx-auto container-max px-4 py-3 md:py-4 flex items-center justify-between">
      <a href="/" class="flex items-center gap-3 group">
        <div class="h-11 w-11 rounded-full bg-white border flex items-center justify-center shadow-sm">
          <i class="bi bi-tools text-[var(--brand)] text-xl"></i>
        </div>
        <span class="text-xl md:text-2xl font-bold tracking-wide text-gray-900 group-hover:text-orange-600 transition" data-i18n="brand_name">FLUKE</span>
      </a>

      <!-- Language switch -->
      <div class="relative">
        <button id="currentLangBtn" class="flex items-center gap-2 px-3 py-1.5 rounded-lg border border-gray-200 hover:bg-orange-50 text-gray-700">
          <span id="currentLangLabel">ไทย</span>
          <i class="bi bi-caret-down-fill text-xs"></i>
        </button>

        <div id="langDropdown" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg hidden z-50">
          <div class="border-b px-3 py-2 text-xs text-gray-400" data-i18n="lang_label">Language</div>
          <div class="border-t">
            <div class="lang-item px-4 py-2 hover:bg-orange-50 cursor-pointer" data-lang="ไทย">ไทย</div>
            <div class="lang-item px-4 py-2 hover:bg-orange-50 cursor-pointer" data-lang="English">English</div>
          </div>
        </div>
      </div>
      <!-- /Language switch -->
    </div>
  </nav>

  <!-- ===== Page content ===== -->
  <main class="mx-auto container-max px-4 py-10 w-full">
    <div class="max-w-5xl mx-auto grid md:grid-cols-5 gap-6">
      <!-- Left intro -->
      <section class="md:col-span-2 card p-6">
        <div class="flex items-center gap-2 mb-3">
          <span class="badge" data-i18n="badge_signup">ลูกค้าองค์กร</span>
        </div>
        <h1 class="text-2xl font-extrabold mb-2" data-i18n="signup_title">สมัครใช้งานสำหรับบริษัท</h1>
        <p class="text-gray-600 mb-4" data-i18n="signup_sub">
          สร้างบัญชีบริษัทเพื่อใช้งานใบเสนอราคา ออกใบกำกับภาษี และติดตามคำสั่งซื้อแบบมืออาชีพ
        </p>
        <ul class="space-y-2 text-sm text-gray-700">
          <li class="flex gap-2"><i class="bi bi-receipt text-orange-500 mt-0.5"></i><span data-i18n="feature_tax">ออกเอกสารภาษี: ใบกำกับ/ใบส่งของ/ใบเสร็จ</span></li>
          <li class="flex gap-2"><i class="bi bi-translate text-orange-500 mt-0.5"></i><span data-i18n="feature_lang">รองรับภาษาเอกสาร: ไทย/อังกฤษ/สองภาษา</span></li>
          <li class="flex gap-2"><i class="bi bi-building text-orange-500 mt-0.5"></i><span data-i18n="feature_branch">รองรับเลขสาขา/สำนักงานใหญ่</span></li>
          <li class="flex gap-2"><i class="bi bi-shield-check text-orange-500 mt-0.5"></i><span data-i18n="feature_compliance">ข้อมูลถูกเข้ารหัสตามมาตรฐาน</span></li>
        </ul>
        <div class="mt-6 text-xs text-gray-500" data-i18n="security_note">
          เราจะใช้ข้อมูลเพื่อออกเอกสารภาษีและให้บริการหลังการขายเท่านั้น
        </div>
      </section>

      <!-- Right form -->
      <section class="md:col-span-3 card p-6">
        <form id="signupForm" class="grid-gap" novalidate>
          <!-- Company info -->
          @csrf
          <div class="section-title" data-i18n="sec_company">ข้อมูลบริษัท</div>
          <div class="grid md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm mb-1" for="companyName" data-i18n="label_company">ชื่อบริษัท (ตามจดทะเบียน)</label>
              <input name= "company_name" id="company_name" class="input" required placeholder="เช่น บริษัท เอ บี ซี จำกัด"
                     data-i18n="ph_company" data-i18n-attr="placeholder" />
              <div id="err_companyName" class="err hidden"></div>
            </div>
            <div>
              <label class="block text-sm mb-1" for="companyType" data-i18n="label_company_type">ประเภทนิติบุคคล</label>
              <select name="Legalentity_type"id="Legalentity_type" class="input">
                <option value="limited" data-i18n="opt_ltd">บริษัทจำกัด</option>
                <option value="public" data-i18n="opt_public">บริษัทมหาชน</option>
                <option value="partnership" data-i18n="opt_partnership">ห้างหุ้นส่วน</option>
                <option value="other" data-i18n="opt_other">อื่นๆ</option>
              </select>
            </div>

            <div>
              <label class="block text-sm mb-1" for="taxId" data-i18n="label_taxid">เลขประจำตัวผู้เสียภาษี (13 หลัก)</label>
              <input name = "idtax" id="idtax" class="input" maxlength="13" type="text"  placeholder="0123456789012" required
                     data-i18n="ph_taxid" data-i18n-attr="placeholder" />
              <div class="help" data-i18n="help_taxid">ถ้าจด VAT ให้กรอกเลขผู้เสียภาษี 13 หลัก</div>
              <div id="err_taxId" class="err hidden"></div>
            </div>

            <div>
              <label class="block text-sm mb-1" for="branchCode" data-i18n="label_branch">เลขที่สาขา</label>
              <input name ="Branch_number"id="Branch_number" class="input" placeholder="00000 = สำนักงานใหญ่"
                     data-i18n="ph_branch" data-i18n-attr="placeholder" />
              <div class="help" data-i18n="help_branch">“00000” คือสำนักงานใหญ่</div>
            </div>
          </div>
            <div>
            <label class="block text-sm mb-1" for="email">Email (บริษัท)</label>
            <input name= "email" id="email" class="input" required placeholder="you@company.com">
            <div id="err_companyName" class="err hidden"></div>
          </div>

          <!-- Billing address -->
          <div class="divider my-4"></div>
          <div class="section-title" data-i18n="sec_billing">ที่อยู่สำหรับออกใบกำกับภาษี</div>
          <div class="grid md:grid-cols-2 gap-4">
            <div class="md:col-span-2">
              <label class="block text-sm mb-1" for="billAddress1" data-i18n="label_addr1">ที่อยู่ บรรทัดที่ 1</label>
              <input name = "main_address"id="main_address" class="input" required placeholder="เลขที่, อาคาร, หมู่บ้าน, ถนน"
                     data-i18n="ph_addr1" data-i18n-attr="placeholder" />
              <div id="err_billAddress1" class="err hidden"></div>
            </div>
            <div>
              <label class="block text-sm mb-1" for="billDistrict" data-i18n="label_district">แขวง/ตำบล</label>
              <input name ="main_subdistrict"id="main_subdistrict" class="input" required placeholder="แขวง/ตำบล"
                     data-i18n="ph_district" data-i18n-attr="placeholder" />
              <div id="err_billDistrict" class="err hidden"></div>
            </div>
            <div>
              <label class="block text-sm mb-1" for="billAmphoe" data-i18n="label_amphoe">เขต/อำเภอ</label>
              <input name= "main_district"id="main_district" class="input" required placeholder="เขต/อำเภอ"
                     data-i18n="ph_amphoe" data-i18n-attr="placeholder" />
              <div id="err_billAmphoe" class="err hidden"></div>
            </div>
            <div>
              <label class="block text-sm mb-1" for="billProv" data-i18n="label_prov">จังหวัด</label>
              <input name ="main_province"id="main_province" class="input" required placeholder="จังหวัด"
                     data-i18n="ph_prov" data-i18n-attr="placeholder" />
              <div id="err_billProv" class="err hidden"></div>
            </div>
            <div>
              <label class="block text-sm mb-1" for="billZip" data-i18n="label_zip">รหัสไปรษณีย์</label>
              <input name = "main_postal"id="main_postal" class="input" inputmode="numeric" maxlength="10" required placeholder="รหัสไปรษณีย์"
                     data-i18n="ph_zip" data-i18n-attr="placeholder" />
              <div id="err_billZip" class="err hidden"></div>
            </div>
            <div>
              <label class="block text-sm mb-1" for="billCountry" data-i18n="label_country">ประเทศ</label>
              <input name="main_country" id="main_country" class="input" value="Thailand"
                     data-i18n="ph_country" data-i18n-attr="value" />
            </div>
          </div>

          {{-- <!-- Shipping address -->
          <div class="flex items-center gap-2 mt-2">
            <input id="sameShip" type="checkbox" class="h-4 w-4" checked />
            <label for="sameShip" class="text-sm" data-i18n="label_same_ship">ที่อยู่จัดส่งเหมือนใบกำกับภาษี</label>
          </div>

          <div id="shipBlock" class="grid md:grid-cols-2 gap-4 mt-3 hidden">
            <div class="md:col-span-2">
              <label class="block text-sm mb-1" for="shipAddress1" data-i18n="label_ship_addr1">ที่อยู่จัดส่ง บรรทัดที่ 1</label>
              <input id="shipAddress1" class="input" placeholder="เลขที่, อาคาร, หมู่บ้าน, ถนน"
                     data-i18n="ph_ship_addr1" data-i18n-attr="placeholder" />
            </div>
            <div>
              <label class="block text-sm mb-1" for="shipDistrict" data-i18n="label_district">แขวง/ตำบล</label>
              <input id="shipDistrict" class="input" placeholder="แขวง/ตำบล"
                     data-i18n="ph_district" data-i18n-attr="placeholder" />
            </div>
            <div>
              <label class="block text-sm mb-1" for="shipAmphoe" data-i18n="label_amphoe">เขต/อำเภอ</label>
              <input id="shipAmphoe" class="input" placeholder="เขต/อำเภอ"
                     data-i18n="ph_amphoe" data-i18n-attr="placeholder" />
            </div>
            <div>
              <label class="block text-sm mb-1" for="shipProv" data-i18n="label_prov">จังหวัด</label>
              <input id="shipProv" class="input" placeholder="จังหวัด"
                     data-i18n="ph_prov" data-i18n-attr="placeholder" />
            </div>
            <div>
              <label class="block text-sm mb-1" for="shipZip" data-i18n="label_zip">รหัสไปรษณีย์</label>
              <input id="shipZip" class="input" inputmode="numeric" maxlength="10" placeholder="รหัสไปรษณีย์"
                     data-i18n="ph_zip" data-i18n-attr="placeholder" />
            </div>
            <div>
              <label class="block text-sm mb-1" for="shipCountry" data-i18n="label_country">ประเทศ</label>
              <input id="shipCountry" class="input" value="Thailand"
                     data-i18n="ph_country" data-i18n-attr="value" />
            </div>
          </div> --}}

          <!-- Contact person -->
          <div class="divider my-4"></div>
          <div class="section-title" data-i18n="sec_contact">ผู้ติดต่อหลัก</div>
          <div class="grid md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm mb-1" for="contactName" data-i18n="label_contact_name">ชื่อ–นามสกุล</label>
              <input name = "main_namecontact"id="main_namecontact" class="input" required placeholder="ชื่อ–นามสกุล"
                     data-i18n="ph_contact_name" data-i18n-attr="placeholder" />
              <div id="err_contactName" class="err hidden"></div>
            </div>
            <div>
              <label class="block text-sm mb-1" for="contactRole" data-i18n="label_contact_role">ตำแหน่ง</label>
              <input name = "rank_contact"id="rank_contact" class="input" placeholder="เช่น จัดซื้อ/บัญชี/วิศวกร"
                     data-i18n="ph_contact_role" data-i18n-attr="placeholder" />
            </div>
            <div>
              <label class="block text-sm mb-1" for="email" data-i18n="label_email">อีเมล</label>
              <input name= "email_contact"id="email_contact" class="input" required placeholder="you@company.com"
                     data-i18n="ph_email" data-i18n-attr="placeholder" />
              <div id="err_email" class="err hidden"></div>
            </div>
            <div>
              <label class="block text-sm mb-1" for="phone" data-i18n="label_phone">โทรศัพท์</label>
              <input name ="tel_contact"id="tel_contact" class="input" required placeholder="+66XXXXXXXXX"
                     data-i18n="ph_phone" data-i18n-attr="placeholder" />
              <div id="err_phone" class="err hidden"></div>
            </div>
          </div>

          <!-- Account security -->
          <div class="divider my-4"></div>
          <div class="section-title" data-i18n="sec_account">ความปลอดภัยบัญชี</div>
          <div class="grid md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm mb-1" for="password" data-i18n="label_username">username</label>
              <input name = "username"id="username" type="text" class="input" required 
                     data-i18n="ph_pw" data-i18n-attr="placeholder" />
            </div>
            <div>
              <label class="block text-sm mb-1" for="password" data-i18n="label_password">รหัสผ่าน</label>
              <input name="passuser"id="passuser" type="password" class="input" required placeholder="••••••••"
                     data-i18n="ph_pw" data-i18n-attr="placeholder" />
              <div id="err_password" class="err hidden"></div>
            </div>
            <div>
              <label class="block text-sm mb-1" for="confirmPassword" data-i18n="label_confirm">ยืนยันรหัสผ่าน</label>
              <input id="confirmPassword" type="password" class="input" required placeholder="••••••••"
                     data-i18n="ph_pw2" data-i18n-attr="placeholder" />
              <div id="err_confirmPassword" class="err hidden"></div>
            </div>
          </div>

          <!-- Upload (optional) – custom component -->
          {{-- <div>
            <label class="block text-sm mb-1" data-i18n="label_upload">อัปโหลดเอกสารยืนยัน (ภพ.20/หนังสือรับรอง) — ไม่บังคับ</label>

            <div class="filebox">
              <input id="regDoc" type="file" class="sr-only" accept=".pdf,.jpg,.jpeg,.png" />
              <label for="regDoc" class="file-trigger">
                <i class="bi bi-upload"></i>
                <span id="regDocBtnText" data-i18n="btn_choose_file">เลือกไฟล์</span>
              </label>
              <span id="regDocText" class="file-name" data-i18n="file_none">ยังไม่ได้เลือกไฟล์</span>
            </div>

            <div class="help" data-i18n="help_upload">ช่วยให้ยืนยันตัวตนได้เร็วขึ้น</div>
          </div> --}}

          <!-- Consent -->
          <div class="flex items-start gap-3">
            <input name = "agree" id="agree" type="checkbox" value="1" class="mt-1 h-4 w-4" />
            <label for="agree" class="text-sm">
              <span data-i18n="label_agree">ฉันยอมรับ</span>
              <a href="#" class="text-orange-600 underline" data-i18n="label_terms">ข้อกำหนดการใช้งาน</a>
              <span data-i18n="label_and">และ</span>
              <a href="#" class="text-orange-600 underline" data-i18n="label_privacy">นโยบายความเป็นส่วนตัว</a>
            </label>
          </div>
          <div id="err_agree" class="err hidden"></div>
          <button id ='sub_information'class="btn-primary mt-2" type="submit" data-i18n="btn_create">สร้างบัญชีบริษัท</button>
          <div class="text-center text-sm text-gray-600 mt-2">
            <span data-i18n="have_account">มีบัญชีอยู่แล้ว?</span>
            <a href="/login" class="text-orange-600 font-semibold" data-i18n="goto_login">เข้าสู่ระบบ</a>
          </div>
        </form>
      </section>
    </div>
  </main>

  <!-- ===== Footer ===== -->
  <footer class="bg-gray-900 text-white mt-10">
    <div class="container-max mx-auto section-pad py-10">
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
</div>
<script>
(function(){
    const form = document.getElementById('signupForm');
    const btn  = document.getElementById('sub_information');
    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const agreeEl = form.querySelector('#agree');
    const errAgree = document.getElementById('err_agree');

    form.addEventListener('submit', async function (event) {
      event.preventDefault();
      btn.disabled = true;
      if (!agreeEl?.checked) {
            if (errAgree) {
              errAgree.textContent = 'กรุณายอมรับเงื่อนไขก่อนสร้างบัญชี';
              errAgree.classList.remove('hidden');
            } else {
              alert('กรุณายอมรับเงื่อนไขก่อนสร้างบัญชี');
            }
            agreeEl?.focus();
            btn.disabled = false;
            return;
          } else if (errAgree) {
            errAgree.textContent = '';
            errAgree.classList.add('hidden');
          }
      try {
        const formData = new FormData(form);

        const res = await fetch('{{ route("register.post") }}', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': csrf,
            'Accept': 'application/json'
          },
          body: formData
        });
        
        // รองรับ validation error 422
        if (res.status === 422) {
          const e = await res.json();
          const first = Object.values(e.errors || {})[0]?.[0] || 'กรุณาตรวจสอบข้อมูล';
          alert(first);
          return;
        }

        if (!res.ok) {
          const t = await res.text();
          throw new Error(t || ('HTTP ' + res.status));
        }

        const data = await res.json();

        if (data.success) {
          alert(data.success);
          window.location.href = 'login';
        } else if (data.error) {
          alert(data.error);
        } else {
          alert('ไม่สามารถประมวลผลคำตอบจากเซิร์ฟเวอร์');
        }
      } catch (error) {
        console.error('❌ เกิดข้อผิดพลาด:', error);
        alert('เกิดข้อผิดพลาดในการตรวจสอบหรือส่งข้อมูล');
      } finally {
        btn.disabled = false;
      }
    });
  })();
</script>

<script>
const I18N = {
  'ไทย':{
    brand_name:'FLUKE',
    lang_label:'เลือกภาษา',
    badge_signup:'ลูกค้าองค์กร',
    signup_title:'สมัครใช้งานสำหรับบริษัท',
    signup_sub:'สร้างบัญชีบริษัทเพื่อใช้งานใบเสนอราคา ออกใบกำกับภาษี และติดตามคำสั่งซื้อแบบมืออาชีพ',
    feature_tax:'ออกเอกสารภาษี: ใบกำกับ/ใบส่งของ/ใบเสร็จ',
    feature_lang:'รองรับภาษาเอกสาร: ไทย/อังกฤษ/สองภาษา',
    feature_branch:'รองรับเลขสาขา/สำนักงานใหญ่',
    feature_compliance:'ข้อมูลถูกเข้ารหัสตามมาตรฐาน',
    security_note:'เราจะใช้ข้อมูลเพื่อออกเอกสารภาษีและให้บริการหลังการขายเท่านั้น',

    sec_company:'ข้อมูลบริษัท',
    label_company:'ชื่อบริษัท (ตามจดทะเบียน)',
    label_company_type:'ประเภทนิติบุคคล',
    opt_ltd:'บริษัทจำกัด',
    opt_public:'บริษัทมหาชน',
    opt_partnership:'ห้างหุ้นส่วน',
    opt_other:'อื่นๆ',
    label_taxid:'เลขประจำตัวผู้เสียภาษี (13 หลัก)',
    help_taxid:'ถ้าจด VAT ให้กรอกเลขผู้เสียภาษี 13 หลัก',
    label_branch:'เลขที่สาขา',
    help_branch:'“00000” คือสำนักงานใหญ่',
    label_vat:'สถานะ VAT',
    opt_vat_reg:'จดภาษีมูลค่าเพิ่ม (VAT)',
    opt_non_vat:'ไม่จด VAT',
    label_doc_lang:'ภาษาบนเอกสารภาษี',
    opt_th:'ไทย',
    opt_en:'อังกฤษ',
    opt_bi:'สองภาษา (ไทย/อังกฤษ)',

    sec_billing:'ที่อยู่สำหรับออกใบกำกับภาษี',
    label_addr1:'ที่อยู่ บรรทัดที่ 1',
    label_district:'แขวง/ตำบล',
    label_amphoe:'เขต/อำเภอ',
    label_prov:'จังหวัด',
    label_zip:'รหัสไปรษณีย์',
    label_country:'ประเทศ',

    label_same_ship:'ที่อยู่จัดส่งเหมือนใบกำกับภาษี',
    label_ship_addr1:'ที่อยู่จัดส่ง บรรทัดที่ 1',

    sec_contact:'ผู้ติดต่อหลัก',
    label_contact_name:'ชื่อ–นามสกุล',
    label_contact_role:'ตำแหน่ง',
    label_email:'อีเมล',
    label_phone:'โทรศัพท์',

    sec_account:'ความปลอดภัยบัญชี',
    label_password:'รหัสผ่าน',
    label_confirm:'ยืนยันรหัสผ่าน',

    sec_pref:'การตั้งค่าการออกเอกสาร',
    label_invoice_type:'ประเภทเอกสารภาษีเริ่มต้น',
    opt_taxinv:'ใบกำกับภาษี/ใบเสร็จรับเงิน',
    opt_dn:'ใบส่งของ',
    opt_quo:'ใบเสนอราคา',
    label_currency:'สกุลเงินหลัก',

    label_upload:'อัปโหลดเอกสารยืนยัน (ภพ.20/หนังสือรับรอง) — ไม่บังคับ',
    help_upload:'ช่วยให้ยืนยันตัวตนได้เร็วขึ้น',

    label_agree:'ฉันยอมรับ',
    label_terms:'ข้อกำหนดการใช้งาน',
    label_and:'และ',
    label_privacy:'นโยบายความเป็นส่วนตัว',

    btn_create:'สร้างบัญชีบริษัท',
    have_account:'มีบัญชีอยู่แล้ว?',
    goto_login:'เข้าสู่ระบบ',

    // Placeholders
    ph_company:'เช่น บริษัท เอ บี ซี จำกัด',
    ph_taxid:'0123456789012',
    ph_branch:'00000 = สำนักงานใหญ่',
    ph_addr1:'เลขที่, อาคาร, หมู่บ้าน, ถนน',
    ph_ship_addr1:'เลขที่, อาคาร, หมู่บ้าน, ถนน',
    ph_district:'แขวง/ตำบล',
    ph_amphoe:'เขต/อำเภอ',
    ph_prov:'จังหวัด',
    ph_zip:'รหัสไปรษณีย์',
    ph_country:'ประเทศไทย',
    ph_contact_name:'ชื่อ–นามสกุล',
    ph_contact_role:'เช่น จัดซื้อ/บัญชี/วิศวกร',
    ph_email:'you@company.com',
    ph_phone:'+66XXXXXXXXX',
    ph_pw:'••••••••',
    ph_pw2:'••••••••',

    // Upload custom button texts
    btn_choose_file:'เลือกไฟล์',
    file_none:'ยังไม่ได้เลือกไฟล์',

    // Validation messages
    v_company:'กรุณากรอกชื่อบริษัท',
    v_taxid:'เลขผู้เสียภาษีต้องเป็นตัวเลข 13 หลัก',
    v_addr:'กรุณากรอกที่อยู่สำหรับออกใบกำกับ',
    v_district:'กรุณากรอกแขวง/ตำบล',
    v_amphoe:'กรุณากรอกเขต/อำเภอ',
    v_prov:'กรุณากรอกจังหวัด',
    v_zip:'กรุณากรอกรหัสไปรษณีย์',
    v_contact:'กรุณากรอกชื่อผู้ติดต่อ',
    v_email:'กรุณากรอกอีเมลให้ถูกต้อง',
    v_phone:'กรุณากรอกเบอร์โทรศัพท์',
    v_pw:'รหัสผ่านต้องมีอย่างน้อย 8 อักขระ',
    v_pw_match:'รหัสผ่านไม่ตรงกัน',
    v_agree:'กรุณายอมรับข้อกำหนดและนโยบาย',

    success:'สมัครสมาชิกสำเร็จ (demo) — จะนำไปยืนยันอีเมล'
  },
  'English':{
    brand_name:'FLUKE',
    lang_label:'Choose language',
    badge_signup:'Corporate',
    signup_title:'Create a corporate account',
    signup_sub:'Register your company to request quotations, issue tax invoices, and track orders like a pro.',
    feature_tax:'Tax documents: Tax invoice / Delivery note / Receipt',
    feature_lang:'Document languages: TH/EN/Bilingual',
    feature_branch:'Head office/Branch number supported',
    feature_compliance:'Data encrypted to industry standards',
    security_note:'We only use your data for tax documents and after-sales service.',

    sec_company:'Company Information',
    label_company:'Registered company name',
    label_company_type:'Entity type',
    opt_ltd:'Limited company',
    opt_public:'Public company',
    opt_partnership:'Partnership',
    opt_other:'Other',
    label_taxid:'Taxpayer ID (13 digits)',
    help_taxid:'If VAT-registered, fill 13-digit TIN',
    label_branch:'Branch code',
    help_branch:'“00000” = Head office',
    label_vat:'VAT status',
    opt_vat_reg:'VAT-registered',
    opt_non_vat:'Non-VAT',
    label_doc_lang:'Document language',
    opt_th:'Thai', opt_en:'English', opt_bi:'Bilingual (TH/EN)',

    sec_billing:'Billing Address (for tax invoice)',
    label_addr1:'Address line 1',
    label_district:'Subdistrict',
    label_amphoe:'District',
    label_prov:'Province',
    label_zip:'Postal code',
    label_country:'Country',

    label_same_ship:'Shipping address same as billing',
    label_ship_addr1:'Shipping address line 1',

    sec_contact:'Primary Contact',
    label_contact_name:'Full name',
    label_contact_role:'Position',
    label_email:'Email',
    label_phone:'Phone',

    sec_account:'Account Security',
    label_password:'Password',
    label_confirm:'Confirm password',

    sec_pref:'Document Preferences',
    label_invoice_type:'Default tax document',
    opt_taxinv:'Tax invoice / Receipt',
    opt_dn:'Delivery note',
    opt_quo:'Quotation',
    label_currency:'Primary currency',

    label_upload:'Upload verification (PP.20/Cert.) — Optional',
    help_upload:'Speeds up verification',

    label_agree:'I accept the',
    label_terms:'Terms of Use',
    label_and:'and',
    label_privacy:'Privacy Policy',

    btn_create:'Create corporate account',
    have_account:'Already have an account?',
    goto_login:'Sign in',

    // Placeholders
    ph_company:'e.g., ABC Co., Ltd.',
    ph_taxid:'0123456789012',
    ph_branch:'00000 = Head office',
    ph_addr1:'No., Building, Village, Street',
    ph_ship_addr1:'No., Building, Village, Street',
    ph_district:'Subdistrict',
    ph_amphoe:'District',
    ph_prov:'Province/State',
    ph_zip:'Postal code',
    ph_country:'Thailand',
    ph_contact_name:'Full name',
    ph_contact_role:'e.g., Purchasing/Accounting/Engineer',
    ph_email:'you@company.com',
    ph_phone:'+66XXXXXXXXX',
    ph_pw:'••••••••',
    ph_pw2:'••••••••',

    // Upload custom button texts
    btn_choose_file:'Choose file',
    file_none:'No file chosen',

    // Validation
    v_company:'Please enter company name',
    v_taxid:'Tax ID must be 13 digits',
    v_addr:'Please fill billing address',
    v_district:'Please fill subdistrict',
    v_amphoe:'Please fill district',
    v_prov:'Please fill province',
    v_zip:'Please fill postal code',
    v_contact:'Please enter contact name',
    v_email:'Please enter a valid email',
    v_phone:'Please enter phone number',
    v_pw:'Password must be at least 8 characters',
    v_pw_match:'Passwords do not match',
    v_agree:'Please accept Terms and Privacy',

    success:'Registration successful (demo) — proceed to email verification'
  }
};

// Language engine
function applyI18n(lang){
  const dict = I18N[lang] || I18N['ไทย'];
  document.documentElement.lang = (lang === 'ไทย') ? 'th' : 'en';
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

  // แจ้งคอมโพเนนต์อื่น ๆ ให้รีเฟรชข้อความตามภาษา
  window.dispatchEvent(new CustomEvent('site_lang_changed', { detail:{ lang } }));
}

document.addEventListener('DOMContentLoaded', ()=>{
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
  applyI18n(saved);

  // Shipping toggle
  const sameShip = document.getElementById('sameShip');
  const shipBlock = document.getElementById('shipBlock');
  if(sameShip){
    const toggleShip = ()=>{ shipBlock.classList.toggle('hidden', sameShip.checked); };
    sameShip.addEventListener('change', toggleShip);
    toggleShip();
  }

  // Submit handler
  document.getElementById('signupForm').addEventListener('submit', handleSubmit);

  // === File input display (i18n-aware) ===
  const regInput = document.getElementById('regDoc');
  const regText  = document.getElementById('regDocText');
  const regBtn   = document.getElementById('regDocBtnText');
  function updateFileText(){
    const t = T();
    if(regInput && regInput.files && regInput.files.length > 0){
      regText.textContent = Array.from(regInput.files).map(f=>f.name).join(', ');
    }else{
      regText.textContent = t.file_none;
    }
    if(regBtn) regBtn.textContent = t.btn_choose_file;
  }
  if(regInput){
    regInput.addEventListener('change', updateFileText);
    updateFileText(); // initial
  }
  window.addEventListener('site_lang_changed', updateFileText);
});

function T(){ 
  const lang = localStorage.getItem('preferredLanguage') || 'ไทย';
  return I18N[lang] || I18N['ไทย'];
}

function showErr(id, msg){
  const el = document.getElementById(id);
  if(!el) return;
  el.textContent = msg;
  el.classList.remove('hidden');
}
function hideErr(id){
  const el = document.getElementById(id);
  if(!el) return;
  el.classList.add('hidden');
  el.textContent = '';
}

function isEmail(v){ return /^\S+@\S+\.\S+$/.test((v||'').trim()); }
function isDigits(v){ return /^\d+$/.test(v||''); }

function handleSubmit(e){
  e.preventDefault();
  const t = T();

  const requiredMap = [
    ['companyName','v_company','err_companyName'],
    ['taxId','v_taxid','err_taxId','tax'],
    ['billAddress1','v_addr','err_billAddress1'],
    ['billDistrict','v_district','err_billDistrict'],
    ['billAmphoe','v_amphoe','err_billAmphoe'],
    ['billProv','v_prov','err_billProv'],
    ['billZip','v_zip','err_billZip'],
    ['contactName','v_contact','err_contactName'],
    ['email','v_email','err_email','email'],
    ['phone','v_phone','err_phone'],
    ['password','v_pw','err_password','pw'],
    ['confirmPassword','v_pw_match','err_confirmPassword','pw2']
  ];

  let ok = true;
  document.querySelectorAll('.err').forEach(el=>{ el.classList.add('hidden'); el.textContent=''; });

  requiredMap.forEach(([id, key, errId, type])=>{
    const el = document.getElementById(id);
    if(!el) return;
    const val = el.value;
    if(type === 'email'){
      if(!isEmail(val)){ showErr(errId, t[key]); ok=false; }
    }else if(type === 'tax'){
      if(!(isDigits(val) && val.length===13)){ showErr(errId, t[key]); ok=false; }
    }else if(type === 'pw'){
      if((val||'').length < 8){ showErr(errId, t[key]); ok=false; }
    }else if(type === 'pw2'){
      const pw = document.getElementById('password').value;
      if(val !== pw){ showErr(errId, t[key]); ok=false; }
    }else{
      if(!val || !val.trim()){ showErr(errId, t[key]); ok=false; }
    }
  });

  const agree = document.getElementById('agree');
  if(!agree.checked){ showErr('err_agree', t['v_agree']); ok=false; } else { hideErr('err_agree'); }

  if(!ok) return;

  const payload = {
    company:{
      name: document.getElementById('companyName').value.trim(),
      type: document.getElementById('companyType').value,
      taxId: document.getElementById('taxId').value.trim(),
      branchCode: document.getElementById('branchCode').value.trim() || '00000',
      vatType: document.getElementById('vatType').value,
      docLang: document.getElementById('docLang').value
    },
    billing:{
      address1: document.getElementById('billAddress1').value.trim(),
      district: document.getElementById('billDistrict').value.trim(),
      amphoe: document.getElementById('billAmphoe').value.trim(),
      province: document.getElementById('billProv').value.trim(),
      zip: document.getElementById('billZip').value.trim(),
      country: document.getElementById('billCountry').value.trim(),
    },
    shipping: (document.getElementById('sameShip').checked ? 'same' : {
      address1: document.getElementById('shipAddress1').value.trim(),
      district: document.getElementById('shipDistrict').value.trim(),
      amphoe: document.getElementById('shipAmphoe').value.trim(),
      province: document.getElementById('shipProv').value.trim(),
      zip: document.getElementById('shipZip').value.trim(),
      country: document.getElementById('shipCountry').value.trim(),
    }),
    contact:{
      name: document.getElementById('contactName').value.trim(),
      role: document.getElementById('contactRole').value.trim(),
      email: document.getElementById('email').value.trim(),
      phone: document.getElementById('phone').value.trim(),
    },
    account:{ password: document.getElementById('password').value, },
    prefs:{
      invoiceType: document.getElementById('invoiceType').value,
      currency: document.getElementById('currency').value,
    }
  };

  console.log('SIGNUP_PAYLOAD', payload); // ส่งไป API ของคุณแทนจุดนี้
  alert(t['success']);
}
</script>
</body>
</html>
