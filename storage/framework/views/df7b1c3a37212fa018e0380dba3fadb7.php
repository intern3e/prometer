<!DOCTYPE html>
<html lang="th">
<head>
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FLUKE Marketplace Style — Contact</title>
  <link rel="icon" type="image/png" href="https://img5.pic.in.th/file/secure-sv1/ChatGPT_Image_18_.._2568_12_03_57-removebg-preview.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    :root{ --brand:#f59e0b; --ink:#0f172a; }
    .soft{ box-shadow:0 1px 2px rgba(0,0,0,.04), 0 1px 1px -1px rgba(0,0,0,.06) }
    .ring-brand:focus{ outline:none; box-shadow:0 0 0 4px rgba(245,158,11,.2); border-color:#fbbf24 }
    .card{ border:1px solid #e2e8f0; background:#fff; border-radius:1rem }
    .grad-head{ background:linear-gradient(135deg,#fff7ed 0%,#fffbeb 50%,#fefce8 100%) }
    .tab-active{ background:#f59e0b; color:#fff; }
    .tab-inactive{ border:1px solid #f59e0b; color:#b45309; }
    .chip{display:inline-flex;align-items:center;border:1px solid #e5e7eb;background:#f8fafc;border-radius:999px;font-size:.75rem;padding:.2rem .5rem}
    .btn-lg-touch{ min-height:42px }
    .input-icon{ position:absolute; left:.75rem; top:50%; transform:translateY(-50%); color:#94a3b8 }
    @media (prefers-color-scheme:dark){
      body{ background:#0b1220; color:#e5e7eb }
      .card{ background:#0f172a; border-color:#334155 }
      .grad-head{ background:linear-gradient(135deg,#1f2937 0%,#0f172a 60%,#0b1220 100%) }
    }
  </style>
</head>
<body class="bg-slate-50 text-slate-800">
  <?php echo $__env->make('test.header-nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <main class="max-w-4xl mx-auto px-4 md:px-6 py-10">
    <!-- Page header -->
    <header class="mb-6">
      <div class="card soft grad-head p-6 md:p-8">
        <div class="flex items-start md:items-center gap-4 justify-between flex-wrap">
          <div class="min-w-0">
            <h1 id="i18n_page_title" class="text-2xl md:text-3xl lg:text-3xl font-bold tracking-tight" data-i18n="page_title_contact">ข้อมูลติดต่อ</h1>
            <p id="i18n_page_desc" class="text-slate-600 mt-1" data-i18n="page_desc_contact">ปรับปรุงข้อมูลติดต่อของคุณ</p>
          </div>

          <!-- ปุ่มสลับส่วน (responsive: wrap บนมือถือ) -->
          <div class="flex items-center gap-2 flex-wrap sm:flex-nowrap w-full sm:w-auto mt-3 sm:mt-0" role="tablist" aria-label="สลับส่วนฟอร์ม">
            <button type="button" id="tabBtnContact" role="tab" aria-controls="tabContact" aria-selected="true"
              class="btn-lg-touch inline-flex items-center gap-2 px-3.5 py-2 rounded-xl shadow-sm tab-active w-full sm:w-auto whitespace-nowrap">
              <i class="bi bi-person-lines-fill"></i>
              <span data-i18n="tab_contact">ข้อมูลติดต่อ</span>
            </button>
            <button type="button" id="tabBtnAddress" role="tab" aria-controls="tabAddress" aria-selected="false"
              class="btn-lg-touch inline-flex items-center gap-2 px-3.5 py-2 rounded-xl tab-inactive hover:bg-amber-50 w-full sm:w-auto whitespace-nowrap">
              <i class="bi bi-geo-alt"></i>
              <span data-i18n="tab_address">ที่อยู่ของฉัน</span>
            </button>
          </div>
        </div>
      </div>
    </header>

    <div class="card soft p-6">
      <form id="contactForm" class="space-y-6" novalidate>
        <?php echo csrf_field(); ?>
        <input type="hidden" name="active_tab" id="active_tab" value="<?php echo e(old('active_tab','contact')); ?>">
        <input type="hidden" id="shipping_address" name="shipping_address" value="<?php echo e(old('shipping_address')); ?>">

        <!-- ===== Tab: ข้อมูลติดต่อ ===== -->
        <section id="tabContact" class="space-y-5" role="tabpanel" aria-labelledby="tabBtnContact" tabindex="-1">
          <div>
            <label class="block text-sm font-medium text-slate-700" data-i18n="contact_type">ประเภทผู้ติดต่อ</label>
            <div class="relative mt-1">
              <i class="bi bi-people input-icon"></i>
              <select id="customer_type" name="customer_type"
                      class="w-full rounded-xl border border-slate-300 pl-10 pr-3 py-2 ring-brand focus:border-amber-400">
                <?php
                  $typecust = old('customer_type', $custdetail->typecust ?? 'person');
                ?>
                <option value="person"  <?php echo e($typecust === 'person'  ? 'selected' : ''); ?> data-i18n="type_person">บุคคล</option>
                <option value="company" <?php echo e($typecust === 'company' ? 'selected' : ''); ?> data-i18n="type_company">บริษัท/หน่วยงาน</option>
              </select>
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium text-slate-700">
              <span data-i18n="full_name">ชื่อ-สกุล</span> <span class="text-rose-600">*</span>
            </label>
            <div class="relative mt-1">
              <i class="bi bi-person-badge input-icon"></i>
              <input type="text" id="main_namecontact" name="main_namecontact" required
                     class="w-full rounded-xl border border-slate-300 pl-10 pr-3 py-2 ring-brand focus:border-amber-400"
                     data-i18n-attr="placeholder" placeholder="เช่น สมชาย ใจดี"
                     value="<?php echo e(old('main_namecontact', $custdetail->main_namecontact ?? '')); ?>">
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div>
              <label class="block text-sm font-medium text-slate-700" data-i18n="email">อีเมล</label>
              <div class="relative mt-1">
                <i class="bi bi-at input-icon"></i>
                <input type="email" id="email_contact" name="email_contact" autocomplete="email"
                       class="w-full rounded-xl border border-slate-300 pl-10 pr-3 py-2 ring-brand focus:border-amber-400"
                       data-i18n-attr="placeholder" placeholder="name@example.com"
                       value="<?php echo e(old('email_contact', $custdetail->email_contact ?? $custdetail->email ?? '')); ?>">
              </div>
            </div>
            <div>
              <label class="block text-sm font-medium text-slate-700" data-i18n="phone">เบอร์โทร</label>
              <div class="relative mt-1">
                <i class="bi bi-telephone input-icon"></i>
                <input type="tel" id="tel_contact" name="tel_contact" autocomplete="tel" inputmode="tel"
                       class="w-full rounded-xl border border-slate-300 pl-10 pr-3 py-2 ring-brand focus:border-amber-400"
                       data-i18n-attr="placeholder" placeholder="เช่น 0812345678"
                       value="<?php echo e(old('tel_contact', $custdetail->tel_contact ?? '')); ?>">
              </div>
            </div>
          </div>

          <?php $isCompany = ($typecust === 'company'); ?>
          <div id="companyWrap" class="<?php echo e($isCompany ? '' : 'hidden'); ?>">
            <label class="block text-sm font-medium text-slate-700" data-i18n="company_name_hint">ชื่อบริษัท (ถ้ามี)</label>
            <div class="relative mt-1">
              <i class="bi bi-building input-icon"></i>
              <input type="text" id="company_name" name="company_name" <?php echo e($isCompany ? 'required' : ''); ?>

                     class="w-full rounded-xl border border-slate-300 pl-10 pr-3 py-2 ring-brand focus:border-amber-400"
                     data-i18n-attr="placeholder" placeholder="เช่น Prometer Co., Ltd" autocomplete="organization"
                     value="<?php echo e(old('company_name', $custdetail->company_name ?? '')); ?>">
            </div>
            <p class="text-xs text-slate-500 mt-1" data-i18n="company_required_note">จำเป็นต้องระบุเมื่อเลือกประเภท "บริษัท/หน่วยงาน"</p>
          </div>
        </section>

        <!-- ===== Tab: ที่อยู่ของฉัน ===== -->
        <section id="tabAddress" class="space-y-6 hidden" role="tabpanel" aria-labelledby="tabBtnAddress" tabindex="-1">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div class="relative">
              <i class="bi bi-geo-alt input-icon"></i>
              <input id="main_address" name="main_address" type="text" data-addr required
                     class="w-full rounded-xl border border-slate-300 pl-10 pr-3 py-2 ring-brand focus:border-amber-400"
                     data-i18n-attr="placeholder" placeholder="บ้านเลขที่ ถนน"
                     value="<?php echo e(old('main_address', $custdetail->main_address ?? '')); ?>">
            </div>
            <div class="relative">
              <i class="bi bi-signpost-2 input-icon"></i>
              <input id="main_subdistrict" name="main_subdistrict" type="text" data-addr
                     class="w-full rounded-xl border border-slate-300 pl-10 pr-3 py-2 ring-brand focus:border-amber-400"
                     data-i18n-attr="placeholder" placeholder="ตำบล/แขวง"
                     value="<?php echo e(old('main_subdistrict', $custdetail->main_subdistrict ?? '')); ?>">
            </div>
            <div class="relative">
              <i class="bi bi-geo-fill input-icon"></i>
              <input id="main_district" name="main_district" type="text" data-addr required
                     class="w-full rounded-xl border border-slate-300 pl-10 pr-3 py-2 ring-brand focus:border-amber-400"
                     data-i18n-attr="placeholder" placeholder="อำเภอ/เขต"
                     value="<?php echo e(old('main_district', $custdetail->main_district ?? '')); ?>">
            </div>
            <div class="relative">
              <i class="bi bi-geo-alt-fill input-icon"></i>
              <input id="main_province" name="main_province" type="text" data-addr required
                     class="w-full rounded-xl border border-slate-300 pl-10 pr-3 py-2 ring-brand focus:border-amber-400"
                     data-i18n-attr="placeholder" placeholder="จังหวัด"
                     value="<?php echo e(old('main_province', $custdetail->main_province ?? '')); ?>">
            </div>
            <div class="relative">
              <i class="bi bi-mailbox input-icon"></i>
              <input id="main_postal" name="main_postal" type="text" inputmode="numeric" pattern="\d{5}" data-addr required
                     class="w-full rounded-xl border border-slate-300 pl-10 pr-3 py-2 ring-brand focus:border-amber-400"
                     data-i18n-attr="placeholder" placeholder="รหัสไปรษณีย์"
                     value="<?php echo e(old('main_postal', $custdetail->main_postal ?? '')); ?>">
            </div>
            <div class="relative">
              <i class="bi bi-globe-asia-australia input-icon"></i>
              <input id="main_country" name="main_country" type="text" data-addr required
                     class="w-full rounded-xl border border-slate-300 pl-10 pr-3 py-2 ring-brand focus:border-amber-400"
                     data-i18n-attr="placeholder" placeholder="ประเทศ"
                     value="<?php echo e(old('main_country', $custdetail->main_country ?? 'ไทย')); ?>">
            </div>
          </div>

          <!-- พรีวิวที่อยู่รอง -->
          <div>
            <div class="flex items-center justify-between mb-2">
              <h3 class="text-lg font-semibold" data-i18n="secondary_all_header">ที่อยู่รองทั้งหมด</h3>
              <span class="chip"><span class="tabular-nums"><?php echo e(count($subaddresses ?? [])); ?></span> <span data-i18n="items_suffix">รายการ</span></span>
            </div>

            <div id="subPreviewWrap" class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <?php $__empty_1 = true; $__currentLoopData = $subaddresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="card p-4">
                  <div class="flex items-center justify-between">
                    <div class="font-semibold"><span data-i18n="secondary_address">ที่อยู่รอง</span> <?php echo e($idx+1); ?></div>
                    <i class="bi bi-eye text-slate-400" data-i18n-attr="title" title="พีวิวอย่างเดียว"></i>
                  </div>

                  <div class="mt-2 text-slate-700 leading-relaxed">
                    <?php echo e(e(trim(
                      ($sub->sub_address ?? '') . ' ' .
                      ($sub->sub_subdistrict ?? '') . ' ' .
                      ($sub->sub_district ?? '') . ' ' .
                      ($sub->sub_province ?? '') . ' ' .
                      ($sub->sub_postal ?? '') . ' ' .
                      ($sub->sub_country ?? '')
                    ))); ?>

                  </div>

                  <?php
                    $contact = array_filter([
                      $sub->sub_namecontact ?? null,
                      $sub->sub_rank_contact ?? null,
                      $sub->sub_tel_contact ?? null,
                      $sub->sub_email_contact ?? null,
                    ]);
                  ?>
                  <?php if($contact): ?>
                    <div class="mt-3 text-xs text-slate-500">
                      <?php echo e(e(implode(' • ', $contact))); ?>

                    </div>
                  <?php endif; ?>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="text-slate-500" data-i18n="no_secondary_addresses">ยังไม่มีที่อยู่รอง</div>
              <?php endif; ?>
            </div>
          </div>

          <!-- เพิ่มที่อยู่รอง -->
          <div class="pt-2">
            <button type="button" id="btnAddSubAddr"
                    class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-slate-300 hover:bg-slate-50">
              <i class="bi bi-plus-lg"></i> <span data-i18n="add_address">เพิ่มที่อยู่</span>
            </button>
          </div>
          <div id="subAddrList" class="mt-3 space-y-3"></div>

          <script id="initSubAddrJSON" type="application/json">
            <?php echo json_encode($subaddresses ?? [], 15, 512) ?>
          </script>
        </section>

        <!-- Actions -->
        <div class="pt-2 flex items-center gap-3 flex-wrap">
          <button type="submit" id="save_btn"
                  class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-amber-500 text-white font-semibold hover:bg-amber-600 shadow-sm">
            <i class="bi bi-save"></i> <span data-i18n="save_btn">บันทึก</span>
          </button>
        </div>
      </form>
    </div>
  </main>

  <!-- ===== I18N: Dictionary + Engine (ครบถ้วน) ===== -->
  <script id="i18n-bundle">
    const I18N = {
      'ไทย': {
        title_contact:'FLUKE Marketplace Style — ข้อมูลติดต่อ',
        page_title_contact:'ข้อมูลติดต่อ',
        page_desc_contact:'ปรับปรุงข้อมูลติดต่อของคุณ',
        tab_contact:'ข้อมูลติดต่อ',
        tab_address:'ที่อยู่ของฉัน',
        contact_type:'ประเภทผู้ติดต่อ',
        type_person:'บุคคล',
        type_company:'บริษัท/หน่วยงาน',
        full_name:'ชื่อ-สกุล',
        placeholder_fullname:'เช่น สมชาย ใจดี',
        email:'อีเมล',
        placeholder_email:'name@example.com',
        phone:'เบอร์โทร',
        placeholder_phone:'เช่น 0812345678',
        company_name_hint:'ชื่อบริษัท (ถ้ามี)',
        placeholder_company:'เช่น Prometer Co., Ltd',
        company_required_note:'จำเป็นต้องระบุเมื่อเลือกประเภท "บริษัท/หน่วยงาน"',
        placeholder_addr1:'บ้านเลขที่ ถนน',
        placeholder_subdistrict:'ตำบล/แขวง',
        placeholder_district:'อำเภอ/เขต',
        placeholder_province:'จังหวัด',
        placeholder_postal:'รหัสไปรษณีย์',
        placeholder_country:'ประเทศ',
        secondary_all_header:'ที่อยู่รองทั้งหมด',
        items_suffix:'รายการ',
        secondary_address:'ที่อยู่รอง',
        secondary_address_new:'ที่อยู่รองใหม่',
        preview_only:'พรีวิวอย่างเดียว',
        no_secondary_addresses:'ยังไม่มีที่อยู่รอง',
        sub_name_label:'ชื่อ-สกุล (รอง)',
        sub_email_label:'อีเมล (รอง)',
        sub_phone_label:'เบอร์โทร (รอง)',
        sub_role_label:'ตำแหน่ง/ความเกี่ยวข้อง',
        sub_addr_label:'ที่อยู่ (รอง)',
        sub_subdistrict_label:'ตำบล/แขวง',
        sub_district_label:'อำเภอ/เขต',
        sub_province_label:'จังหวัด',
        sub_postal_label:'รหัสไปรษณีย์',
        sub_country_label:'ประเทศ',
        sub_placeholder_role:'ผู้ติดต่อ/ผู้รับของ ฯลฯ',
        sub_placeholder_postal:'10110',
        sub_default_country:'ไทย',
        add_address:'เพิ่มที่อยู่',
        save_this_address:'บันทึกที่อยู่นี้',
        cancel:'ยกเลิก',
        save_btn:'บันทึก',
        saving:'กำลังบันทึก...',
        save_failed:'บันทึกไม่สำเร็จ:',
        error_occurred:'เกิดข้อผิดพลาด',
        network_js_error:'Network/JS Error',
        please_check_data:'กรุณาตรวจสอบข้อมูล',
        cannot_parse_server:'ไม่สามารถประมวลผลคำตอบจากเซิร์ฟเวอร์'
      },
      'English': {
        title_contact:'FLUKE Marketplace Style — Contact',
        page_title_contact:'Contact Information',
        page_desc_contact:'Update your contact details',
        tab_contact:'Contact',
        tab_address:'My Addresses',
        contact_type:'Contact type',
        type_person:'Person',
        type_company:'Company/Organization',
        full_name:'Full name',
        placeholder_fullname:'e.g., Somchai Jaidee',
        email:'Email',
        placeholder_email:'name@example.com',
        phone:'Phone',
        placeholder_phone:'e.g., 0812345678',
        company_name_hint:'Company name (if any)',
        placeholder_company:'e.g., Prometer Co., Ltd',
        company_required_note:'Required when selecting "Company/Organization"',
        placeholder_addr1:'House no., Street',
        placeholder_subdistrict:'Subdistrict',
        placeholder_district:'District',
        placeholder_province:'Province',
        placeholder_postal:'Postal code',
        placeholder_country:'Country',
        secondary_all_header:'All secondary addresses',
        items_suffix:'items',
        secondary_address:'Secondary address',
        secondary_address_new:'New secondary address',
        preview_only:'Preview only',
        no_secondary_addresses:'No secondary addresses yet',
        sub_name_label:'Name (secondary)',
        sub_email_label:'Email (secondary)',
        sub_phone_label:'Phone (secondary)',
        sub_role_label:'Role/Relation',
        sub_addr_label:'Address (secondary)',
        sub_subdistrict_label:'Subdistrict',
        sub_district_label:'District',
        sub_province_label:'Province',
        sub_postal_label:'Postal code',
        sub_country_label:'Country',
        sub_placeholder_role:'Contact/Receiver, etc.',
        sub_placeholder_postal:'10110',
        sub_default_country:'Thailand',
        add_address:'Add address',
        save_this_address:'Save this address',
        cancel:'Cancel',
        save_btn:'Save',
        saving:'Saving...',
        save_failed:'Save failed:',
        error_occurred:'An error occurred',
        network_js_error:'Network/JS Error',
        please_check_data:'Please check your inputs',
        cannot_parse_server:'Cannot parse server response'
      }
    };

    function normLang(v){
      v=String(v||'').toLowerCase();
      if(v==='th'||v==='ไทย') return 'ไทย';
      if(v==='en'||v==='english') return 'English';
      return I18N[v] ? v : 'ไทย';
    }
    function getCurrentLang(){
      return normLang(localStorage.getItem('preferredLanguage') || 'ไทย');
    }
    function tKey(key, fallback){
      const dict=I18N[getCurrentLang()] || I18N['ไทย'];
      return (dict[key] != null) ? dict[key] : (fallback ?? key);
    }

    function applyI18n(lang){
      lang = normLang(lang);
      const dict = I18N[lang] || I18N['ไทย'];
      // lang & title
      document.documentElement.lang = (lang==='ไทย') ? 'th' : 'en';
      if (dict.title_contact) document.title = dict.title_contact;

      // text & placeholders
      document.querySelectorAll('[data-i18n]').forEach(el=>{
        const key = el.getAttribute('data-i18n');
        const val = dict[key];
        if (val == null) return;
        const attr = el.getAttribute('data-i18n-attr');
        if (attr) el.setAttribute(attr, val);
        else el.textContent = val;
      });

      // อัปเดต label/ชิปภาษาใน header (ถ้ามี)
      const label=document.getElementById('currentLangLabel');
      if(label) label.textContent = (lang==='ไทย') ? 'ไทย' : 'English';

      localStorage.setItem('preferredLanguage', lang);
      localStorage.setItem('site_lang', lang);
      window.dispatchEvent(new CustomEvent('site_lang_changed',{detail:{lang}}));
    }

    // Boot + bind dropdown/header toggles
    document.addEventListener('DOMContentLoaded',()=>{
      const langDropdown = document.getElementById('langDropdown');
      const currentLangBtn = document.getElementById('currentLangBtn');

      if(currentLangBtn && langDropdown){
        currentLangBtn.addEventListener('click',(e)=>{
          e.stopPropagation();
          langDropdown.classList.toggle('hidden');
        });
        document.addEventListener('click',(e)=>{
          const hit = e.target.closest('#langDropdown, #currentLangBtn');
          if(!hit) langDropdown.classList.add('hidden');
        });
      }

      // รองรับทั้ง .lang-item, [data-lang], [data-set-lang]
      document.addEventListener('click',(e)=>{
        const trg = e.target.closest('.lang-item,[data-lang],[data-set-lang]');
        if(!trg) return;
        e.preventDefault();
        const raw = trg.getAttribute('data-lang') || trg.getAttribute('data-set-lang') || trg.textContent.trim();
        applyI18n(raw);
        if (langDropdown) langDropdown.classList.add('hidden');
      });

      applyI18n(getCurrentLang());
    });

    // export
    window.tKey = tKey;
    window.applyI18n = applyI18n;
    window.getCurrentLang = getCurrentLang;
  </script>

  <!-- ===== Add Sub-Address (เพิ่มใหม่) + Render Preview ===== -->
  <script>
  (function () {
    const list   = document.getElementById('subAddrList');
    const btnAdd = document.getElementById('btnAddSubAddr');
    const wrap   = document.getElementById('subPreviewWrap');
    const csrf   = document.querySelector('meta[name="csrf-token"]')?.content || '';

    function htmlToNode(html){ const t=document.createElement('template'); t.innerHTML=html.trim(); return t.content.firstElementChild; }
    function x(str){ return String(str??'').replace(/[&<>"']/g,s=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[s])); }
    function composeThaiAddress(addr,subdistrict,district,province,postal,country){
      const isBkk=/กรุงเทพ|bangkok/i.test(String(province||'')); const p=[];
      if(addr)p.push(String(addr).trim());
      if(subdistrict)p.push((isBkk?'แขวง ':'ตำบล ')+String(subdistrict).trim());
      if(district)p.push((isBkk?'เขต ':'อำเภอ ')+String(district).trim());
      if(province)p.push((isBkk?'':'จังหวัด ')+String(province).trim());
      if(postal)p.push(String(postal).trim());
      if(country)p.push(String(country).trim());
      return p.join(' ').replace(/\s+/g,' ').trim();
    }

    function createSubAddrBlock(){
      const node=htmlToNode(`
        <div class="p-4 border border-slate-200 rounded-xl bg-white subaddr-card">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div>
              <label class="text-sm font-medium" data-i18n="sub_name_label">${x(tKey('sub_name_label'))}</label>
              <input name="sub_namecontact" type="text" class="w-full rounded-lg border px-3 py-2">
            </div>
            <div>
              <label class="text-sm font-medium" data-i18n="sub_email_label">${x(tKey('sub_email_label'))}</label>
              <input name="sub_email_contact" type="email" class="w-full rounded-lg border px-3 py-2" placeholder="name@domain.com">
            </div>
            <div>
              <label class="text-sm font-medium" data-i18n="sub_phone_label">${x(tKey('sub_phone_label'))}</label>
              <input name="sub_tel_contact" type="tel" inputmode="tel" class="w-full rounded-lg border px-3 py-2">
            </div>
            <div>
              <label class="text-sm font-medium" data-i18n="sub_role_label">${x(tKey('sub_role_label'))}</label>
              <input name="sub_rank_contact" type="text" class="w-full rounded-lg border px-3 py-2" placeholder="${x(tKey('sub_placeholder_role'))}">
            </div>
            <div class="md:col-span-2">
              <label class="text-sm font-medium" data-i18n="sub_addr_label">${x(tKey('sub_addr_label'))}</label>
              <input name="sub_address" type="text" class="w-full rounded-lg border px-3 py-2" placeholder="${x(tKey('placeholder_addr1'))}">
            </div>
            <div>
              <label class="text-sm font-medium" data-i18n="sub_subdistrict_label">${x(tKey('sub_subdistrict_label'))}</label>
              <input name="sub_subdistrict" type="text" class="w-full rounded-lg border px-3 py-2" placeholder="${x(tKey('placeholder_subdistrict'))}">
            </div>
            <div>
              <label class="text-sm font-medium" data-i18n="sub_district_label">${x(tKey('sub_district_label'))}</label>
              <input name="sub_district" type="text" class="w-full rounded-lg border px-3 py-2" placeholder="${x(tKey('placeholder_district'))}">
            </div>
            <div>
              <label class="text-sm font-medium" data-i18n="sub_province_label">${x(tKey('sub_province_label'))}</label>
              <input name="sub_province" type="text" class="w-full rounded-lg border px-3 py-2" placeholder="${x(tKey('placeholder_province'))}">
            </div>
            <div>
              <label class="text-sm font-medium" data-i18n="sub_postal_label">${x(tKey('sub_postal_label'))}</label>
              <input name="sub_postal" type="text" class="w-full rounded-lg border px-3 py-2" placeholder="${x(tKey('sub_placeholder_postal'))}" inputmode="numeric" pattern="[0-9]{5}">
            </div>
            <div>
              <label class="text-sm font-medium" data-i18n="sub_country_label">${x(tKey('sub_country_label'))}</label>
              <input name="sub_country" type="text" class="w-full rounded-lg border px-3 py-2" placeholder="${x(tKey('placeholder_country'))}" value="${x(tKey('sub_default_country'))}">
            </div>
          </div>
          <div class="mt-3 flex items-center gap-2 flex-wrap">
            <button type="button" class="btn-save-subaddr inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-amber-500 text-white hover:bg-amber-600">
              <i class="bi bi-save"></i> <span data-i18n="save_this_address">${x(tKey('save_this_address'))}</span>
            </button>
            <button type="button" class="btn-remove-subaddr inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border hover:bg-rose-50 text-rose-600">
              <i class="bi bi-x-lg"></i> <span data-i18n="cancel">${x(tKey('cancel'))}</span>
            </button>
            <span class="text-xs text-slate-500 status"></span>
          </div>
        </div>
      `);

      // sync กับภาษา ณ ปัจจุบัน
      window.applyI18n && window.applyI18n(window.getCurrentLang && window.getCurrentLang());
      node.querySelector('.btn-remove-subaddr').addEventListener('click',()=>node.remove());
      node.querySelector('.btn-save-subaddr').addEventListener('click',async()=>{
        const get=n=>node.querySelector(`[name="${n}"]`)?.value?.trim()||'';
        const payload={
          sub_namecontact:get('sub_namecontact'),
          sub_email_contact:get('sub_email_contact'),
          sub_tel_contact:get('sub_tel_contact'),
          sub_rank_contact:get('sub_rank_contact'),
          sub_address:get('sub_address'),
          sub_subdistrict:get('sub_subdistrict'),
          sub_district:get('sub_district'),
          sub_province:get('sub_province'),
          sub_postal:get('sub_postal'),
          sub_country:get('sub_country'),
        };
        const statusEl=node.querySelector('.status'); statusEl.textContent=tKey('saving','Saving...');
        try{
          const res=await fetch('<?php echo e(route("subaddress.address")); ?>',{method:'POST',headers:{'X-CSRF-TOKEN':csrf,'Accept':'application/json','Content-Type':'application/json'},body:JSON.stringify(payload)});
          const raw=await res.text(); let data={}; try{data=JSON.parse(raw)}catch(_){}
          if(!res.ok){ statusEl.textContent=tKey('save_failed','Save failed:')+' '+(data.hint||data.error||('HTTP '+res.status)); return; }
          if(data.redirect){ location.href=data.redirect; return; }
          const pretty=composeThaiAddress(payload.sub_address,payload.sub_subdistrict,payload.sub_district,payload.sub_province,payload.sub_postal,payload.sub_country||tKey('sub_default_country','ไทย'));
          const contact=[payload.sub_namecontact,payload.sub_rank_contact,payload.sub_tel_contact,payload.sub_email_contact].filter(Boolean).join(' • ');
          const card=htmlToNode(`
            <div class="card p-4">
              <div class="flex items-center justify-between">
                <div class="font-semibold" data-i18n="secondary_address_new">${x(tKey('secondary_address_new'))}</div>
                <i class="bi bi-eye text-slate-400" data-i18n-attr="title" title="${x(tKey('preview_only'))}"></i>
              </div>
              <div class="mt-2 text-slate-700 leading-relaxed">${x(pretty||'-')}</div>
              ${contact?`<div class="mt-3 text-xs text-slate-500">${x(contact)}</div>`:''}
            </div>
          `);
          wrap?.appendChild(card);
          window.applyI18n && window.applyI18n(window.getCurrentLang && window.getCurrentLang());
          node.remove();
        }catch(err){ console.error(err); statusEl.textContent=tKey('save_failed','Save failed:')+' '+tKey('network_js_error','Network/JS Error'); }
      });
      return node;
    }

    btnAdd?.addEventListener('click',()=>{ const n=createSubAddrBlock(); list.appendChild(n); window.applyI18n && window.applyI18n(window.getCurrentLang && window.getCurrentLang()); });
  })();
  </script>

  <!-- ===== Tabs / Compose main shipping / Company toggle / Submit profile ===== -->
  <script>
  (function () {
    const form=document.getElementById('contactForm');
    const btn=document.getElementById('save_btn');

    const tabBtnContact=document.getElementById('tabBtnContact');
    const tabBtnAddress=document.getElementById('tabBtnAddress');
    const tabContact=document.getElementById('tabContact');
    const tabAddress=document.getElementById('tabAddress');
    const activeTabInp=document.getElementById('active_tab');

    const addrIds=['main_address','main_subdistrict','main_district','main_province','main_postal','main_country'];
    const addrEls=Object.fromEntries(addrIds.map(id=>[id,document.getElementById(id)]));
    const shipEl=document.getElementById('shipping_address');

    const typeEl=document.getElementById('customer_type');
    const companyWrap=document.getElementById('companyWrap');
    const companyName=document.getElementById('company_name');

    const csrf=document.querySelector('meta[name="csrf-token"]')?.content||document.querySelector('input[name="_token"]')?.value||'';

    function composeThaiAddress(addr,subdistrict,district,province,postal,country){
      const isBkk=/กรุงเทพ|bangkok/i.test(String(province||'')); const parts=[];
      if(addr)parts.push(String(addr).trim());
      if(subdistrict)parts.push((isBkk?'แขวง ':'ตำบล ')+String(subdistrict).trim());
      if(district)parts.push((isBkk?'เขต ':'อำเภอ ')+String(district).trim());
      if(province)parts.push((isBkk?'':'จังหวัด ')+String(province).trim());
      if(postal)parts.push(String(postal).trim());
      if(country)parts.push(String(country).trim());
      return parts.join(' ').replace(/\s+/g,' ').trim();
    }

    function updateShippingPreview(){
      const line=composeThaiAddress(
        addrEls.main_address?.value, addrEls.main_subdistrict?.value,
        addrEls.main_district?.value, addrEls.main_province?.value,
        addrEls.main_postal?.value, addrEls.main_country?.value
      )||'-';
      if(shipEl) shipEl.value=line;
    }

    function syncCompanyField(){
      const isCompany=typeEl && typeEl.value==='company';
      if(companyWrap) companyWrap.classList.toggle('hidden',!isCompany);
      if(companyName){ if(isCompany) companyName.setAttribute('required','required'); else companyName.removeAttribute('required'); }
    }

    const addrRequiredIds=['main_address','main_district','main_province','main_postal','main_country'];
    function setAddressRequired(on){
      addrRequiredIds.forEach(id=>{
        const el=document.getElementById(id); if(!el) return;
        if(on){ el.removeAttribute('disabled'); el.setAttribute('required','required'); }
        else { el.removeAttribute('required'); el.setAttribute('disabled','disabled'); }
      });
    }

    function setActiveTab(which){
      const contactActive=which==='contact';
      tabContact?.classList.toggle('hidden',!contactActive);
      tabAddress?.classList.toggle('hidden',contactActive);
      tabBtnContact?.classList.toggle('tab-active',contactActive);
      tabBtnContact?.classList.toggle('tab-inactive',!contactActive);
      tabBtnAddress?.classList.toggle('tab-active',!contactActive);
      tabBtnAddress?.classList.toggle('tab-inactive',contactActive);
      tabBtnContact?.setAttribute('aria-selected',contactActive?'true':'false');
      tabBtnAddress?.setAttribute('aria-selected',!contactActive?'true':'false');
      if(activeTabInp) activeTabInp.value=contactActive?'contact':'address';
      setAddressRequired(!contactActive);
    }

    addrIds.forEach(id=>addrEls[id]?.addEventListener('input',updateShippingPreview));
    updateShippingPreview();

    typeEl?.addEventListener('change',syncCompanyField);
    syncCompanyField();

    tabBtnContact?.addEventListener('click',()=>setActiveTab('contact'));
    tabBtnAddress?.addEventListener('click',()=>setActiveTab('address'));
    const initialTab=activeTabInp?.value||'contact';
    setActiveTab(initialTab);

    form.addEventListener('submit',async(e)=>{
      e.preventDefault();
      Array.from(form.querySelectorAll('[required]')).forEach(el=>{ if(el.offsetParent===null) el.removeAttribute('required'); });
      updateShippingPreview();

      btn && (btn.disabled=true);
      try{
        const formData=new FormData(form);
        const res=await fetch('<?php echo e(route("updateprofile.post")); ?>',{method:'POST',headers:{'X-CSRF-TOKEN':csrf,'X-Requested-With':'XMLHttpRequest','Accept':'application/json'},body:formData});

        if(res.status===422){
          const e=await res.json();
          const first=Object.values(e.errors||{})[0]?.[0]||tKey('please_check_data','Please check your inputs');
          alert(first); return;
        }
        if(!res.ok){
          const t=await res.text(); console.error('HTTP',res.status,t);
          alert(`${tKey('error_occurred','An error occurred')} (${res.status})`); return;
        }

        const data=await res.json();
        if(data.success){ alert(data.success); window.location.assign('<?php echo e(route("profile.show")); ?>'); }
        else{ alert(data.error||tKey('cannot_parse_server','Cannot parse server response')); }
      }catch(err){ console.error('❌ Error:',err); alert(tKey('error_occurred','An error occurred')); }
      finally{ btn && (btn.disabled=false); }
    });
  })();
  </script>

  <?php echo $__env->make('test.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\tool\resources\views/login/edit.blade.php ENDPATH**/ ?>