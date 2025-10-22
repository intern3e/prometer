<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- 🔹 TITLE & DESCRIPTION -->
  <title>myFlukeTH — เครื่องมือวัดไฟฟ้า Fluke ของแท้ | ศูนย์ไทย</title>
  <meta name="description" content="ซื้อเครื่องมือวัดไฟฟ้า Fluke ของแท้ มัลติมิเตอร์ แคลมป์มิเตอร์ กล้องถ่ายภาพความร้อน พร้อมบริการคาลิเบรตตามมาตรฐาน มั่นใจศูนย์ไทย myFlukeTH">
  <meta name="keywords" content="Fluke, ฟลุค, เครื่องมือวัดไฟฟ้า, มัลติมิเตอร์, แคลมป์มิเตอร์, กล้องถ่ายภาพความร้อน, เครื่องวัดฉนวน, เครื่องตรวจไฟ">

  <!-- 🔹 SEO SETTINGS -->
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="https://myfluketh.com/">

  <!-- 🔹 GOOGLE SITE VERIFICATION -->
  <meta name="google-site-verification" content="tpmhTAxPUzD7bh4163L-tqG21SpSCOJC_N0nNxfNt3k" />

  <!-- 🔹 OPEN GRAPH (Facebook / LINE / etc.) -->
  <meta property="og:type" content="website">
  <meta property="og:title" content="myFlukeTH — เครื่องมือวัดไฟฟ้า Fluke ของแท้ | ศูนย์ไทย">
  <meta property="og:description" content="ศูนย์รวมเครื่องมือวัด Fluke ของแท้ในไทย พร้อมบริการคาลิเบรต และทีมวิศวกรมืออาชีพ">
  <meta property="og:url" content="https://myfluketh.com/">
  <meta property="og:image" content="https://img5.pic.in.th/file/secure-sv1/ChatGPT_Image_18_.._2568_12_03_57-removebg-preview.png">
  <meta property="og:locale" content="th_TH">

  <!-- 🔹 TWITTER CARD -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="myFlukeTH — เครื่องมือวัดไฟฟ้า Fluke ของแท้">
  <meta name="twitter:description" content="ศูนย์รวมเครื่องมือวัด Fluke ของแท้จากศูนย์ไทย พร้อมบริการคาลิเบรตและจัดส่งทั่วประเทศ">
  <meta name="twitter:image" content="https://img5.pic.in.th/file/secure-sv1/ChatGPT_Image_18_.._2568_12_03_57-removebg-preview.png">

  <!-- 🔹 ICON -->
  <link rel="icon" type="image/png" href="https://img5.pic.in.th/file/secure-sv1/ChatGPT_Image_18_.._2568_12_03_57-removebg-preview.png">
</head>

<body>
  {{-- Header --}}
  @include('test.header-nav')

  {{-- Content --}}
  <main>
    @yield('content')
  </main>
<br>
<script>
  // ปิด search bar อัตโนมัติถ้าเปิดเมนู
  document.addEventListener("DOMContentLoaded", () => {
    const menuBtn = document.querySelector('[data-drawer-toggle="#mobileMenu"]');
    const mobileSearch = document.getElementById("mobileSearch");
    const mobileMenu = document.getElementById("mobileMenu");

    if (menuBtn && mobileSearch && mobileMenu) {
      menuBtn.addEventListener("click", () => {
        mobileSearch.classList.add("hidden"); // ซ่อน search ทุกครั้งที่กดเมนู
      });
    }
  });
</script>
  <!-- ===== Hero area ===== -->
  <section class="container-outer mx-auto section-pad mt-3 md:mt-5 grid grid-cols-1 md:grid-cols-12 gap-4">
    <!-- left categories (desktop) -->
    <aside class="hidden md:block md:col-span-3 card p-2 left-cat">
      <ul class="text-sm divide-y">
        <li><a href="{{ route('product.category', ['slug' => 'ClampMeter1']) }}" class="px-3 py-2" data-i18n="left_c1">แคลมป์มิเตอร์</a></li>
        <li><a href="{{ route('product.category', ['slug' => 'Multimeters']) }}"  class="px-3 py-2" data-i18n="left_c2">มัลติมิเตอร์</a></li>
        <li><a href="{{ route('product.category', ['slug' => 'ElectricalTesters']) }}"  class="px-3 py-2" data-i18n="left_c3">เครื่องตรวจไฟ/ทดสอบไฟฟ้า</a></li>
        <li><a href="{{ route('product.category', ['slug' => 'Thermography']) }}"  class="px-3 py-2" data-i18n="left_c4">กล้องถ่ายภาพความร้อน</a></li>
        <li><a href="{{ route('product.category', ['slug' => 'InsulationTesters']) }}"  class="px-3 py-2" data-i18n="left_c5">เครื่องวัดฉนวน</a></li>
        <li><a href="{{ route('product.category', ['slug' => 'PowerQuality']) }}"  class="px-3 py-2" data-i18n="left_c6">คุณภาพไฟฟ้า</a></li>
        <li><a href="{{ route('product.category', ['slug' => 'LoopCalibrators']) }}"  class="px-3 py-2" data-i18n="left_c7">เครื่องสอบเทียบ</a></li>
        <li><a href="{{ route('product.category', ['slug' => 'Accessories']) }}"  class="px-3 py-2" data-i18n="left_c8">อุปกรณ์เสริม</a></li>
      </ul>
    </aside>

    <!-- hero slider -->
    <div class="md:col-span-6">
      <div class="swiper mySwiper swiper-pro card">
        <div class="swiper-wrapper">
          <div class="swiper-slide bg-white flex items-center justify-center">
            <img src="{{ asset('storage/logo.jpg') }}" alt="hero1" class="max-w-full max-h-full object-contain" loading="eager" decoding="async" />
          </div>
          <div class="swiper-slide bg-white flex items-center justify-center">
            <img src="{{ asset('storage/logo1.jpg') }}" alt="hero2" class="max-w-full max-h-full object-contain" loading="eager" decoding="async" />
          </div>
          <div class="swiper-slide bg-white flex items-center justify-center">
            <img src="{{ asset('storage/logo2.jpg') }}" alt="hero3" class="max-w-full max-h-full object-contain" loading="eager" decoding="async" />
          </div>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>

    <!-- right promos -->
    <aside class="md:col-span-3 promo-col">
      <a href="/SpecialOffers" class="promo-pro group focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--brand)]">
        <div class="promo-icon bg-gradient-to-br from-amber-100 to-yellow-200 relative z-10">
          <i class="bi bi-lightning-charge text-[var(--brand)] text-2xl"></i>
        </div>
        <div class="min-w-0 relative z-10">
          <p class="text-base font-semibold text-gray-900 truncate" data-i18n="promo1_title">ข้อเสนอพิเศษ</p>
          <p class="text-sm text-gray-600 truncate" data-i18n="promo1_sub"> ประหยัดกว่าเดิม</p>
          
        </div>
        <i class="bi bi-arrow-right-short text-gray-400 text-3xl transition-transform duration-300 group-hover:translate-x-1 relative z-10"></i>
        <span aria-hidden="true" class="pointer-events-none absolute -right-10 -bottom-10 h-28 w-28 rounded-full bg-amber-100/70 z-0"></span>
      </a>

      <a href="/LatestProducts" class="promo-pro group focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-500">
        <div class="promo-icon bg-gradient-to-br from-orange-100 to-orange-200 relative z-10">
          <i class="bi bi-stars text-orange-500 text-2xl"></i>
        </div>
        <div class="min-w-0 relative z-10">
          <p class="text-base font-semibold text-gray-900 truncate" data-i18n="promo2_title">สินค้าใหม่ล่าสุด</p>
          <p class="text-sm text-gray-600 truncate" data-i18n="promo2_sub">อัปเดตทุกสัปดาห์</p>
        </div>
        <i class="bi bi-arrow-right-short text-gray-400 text-3xl transition-transform duration-300 group-hover:translate-x-1 relative z-10"></i>
        <span aria-hidden="true" class="pointer-events-none absolute -left-10 -bottom-10 h-28 w-28 rounded-full bg-orange-100/70 z-0"></span>
      </a>
    </aside>
  </section>
<br>
<!-- ===== Flash Deals ===== -->
<section class="container-outer mx-auto section-pad mt-6">
  <div class="card p-3 md:p-4">
    <div class="flex items-center justify-between mb-3">
      <h3 class="text-lg md:text-xl font-bold" data-i18n="flash_title">Flash Deals</h3>
      <a href="{{ route('product.index') }}">ดูทั้งหมด</a>
    </div>

    <div id="flashGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-3"></div>
  </div>
</section>

<!-- template แยกออกมาอยู่นอก flashGrid -->
<template id="dealTileTemplate">
  <a class="block hover:shadow transition-fast">
    <div class="border rounded-lg overflow-hidden bg-white">
      <div class="aspect-square bg-gray-50">
        <img class="deal-img block w-full h-full object-cover object-center" alt="">
      </div>
    </div>
    <div class="p-2">
      <p class="deal-name text-xs text-gray-700 line-clamp-2">ชื่อสินค้า</p>
      <p class="deal-price text-[var(--brand)] font-semibold mt-1">฿—</p>
    </div>
  </a>
</template>
<br>
  <!-- ===== หมวดหมู่สินค้า ===== -->
  <section class="container-outer mx-auto section-pad mt-10">
    <div class="max-w-6xl mx-auto">
      <h3 class="text-3xl font-bold mb-6 text-center text-gray-700" data-i18n="cat_title">หมวดหมู่สินค้า</h3>

      <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
          <a href="{{ route('product.category', ['slug' => 'ClampMeter1']) }}"class="block lift">
          <div class="card overflow-hidden cat-card">
            <img src="{{ asset('storage/clamp-meters.jpg') }}" alt="Clamp Meter" class="w-full h-40 md:h-44 object-cover">
            <div class="cat-caption"><p data-i18n="cat_g_1">แคลมป์มิเตอร์</p></div>
          </div>
        </a>
        <a href="{{ route('product.category', ['slug' => 'ElectricalTesters']) }}"class="block lift">
          <div class="card overflow-hidden cat-card">
            <img src="{{ asset('storage/electrical-testers.jpg') }}" alt="Electrical Testers" class="w-full h-40 md:h-44 object-cover">
            <div class="cat-caption"><p data-i18n="cat_g_2">เครื่องทดสอบไฟฟ้า</p></div>
          </div>
        </a>
        <a href="{{ route('product.category', ['slug' => 'GroundResistance']) }}" class="block lift">
          <div class="card overflow-hidden cat-card">
            <img src="{{ asset('storage/ground-resistance.jpg') }}" alt="Ground Resistance" class="w-full h-40 md:h-44 object-cover">
            <div class="cat-caption"><p data-i18n="cat_g_3">เครื่องทดสอบสายดิน</p></div>
          </div>
        </a>
        <a href="{{ route('product.category', ['slug' => 'InsulationTesters']) }}" class="block lift">
          <div class="card overflow-hidden cat-card">
            <img src="{{ asset('storage/insulation-testers.jpg') }}" alt="Insulation Testers" class="w-full h-40 md:h-44 object-cover">
            <div class="cat-caption"><p data-i18n="cat_g_4">เครื่องวัดฉนวน</p></div>
          </div>
        </a>
        <a href="{{ route('product.category', ['slug' => 'Multimeters']) }}" class="block lift">
          <div class="card overflow-hidden cat-card">
            <img src="{{ asset('storage/multimeters.jpg') }}" alt="Multimeters" class="w-full h-40 md:h-44 object-cover">
            <div class="cat-caption"><p data-i18n="cat_g_5">มัลติมิเตอร์</p></div>
          </div>
        </a>
        <a href="{{ route('product.category', ['slug' => 'PowerQuality']) }}" class="block lift">
          <div class="card overflow-hidden cat-card">
            <img src="{{ asset('storage/power-quality.jpg') }}" alt="Power Quality" class="w-full h-40 md:h-44 object-cover">
            <div class="cat-caption"><p data-i18n="cat_g_6">คุณภาพไฟฟ้า</p></div>
          </div>
        </a>
        <a href="{{ route('product.category', ['slug' => 'PreventativeMaintenance']) }}" class="block lift">
          <div class="card overflow-hidden cat-card">
            <img src="{{ asset('storage/preventative-maintenance.jpg') }}" alt="Preventative Maintenance" class="w-full h-40 md:h-44 object-cover">
            <div class="cat-caption"><p data-i18n="cat_g_7">การบำรุงรักษา</p></div>
          </div>
        </a>
        <a href="{{ route('product.category', ['slug' => 'ProcessTools']) }}" class="block lift">
          <div class="card overflow-hidden cat-card">
            <img src="{{ asset('storage/process-tools.jpg') }}" alt="Process Tools" class="w-full h-40 md:h-44 object-cover">
            <div class="cat-caption"><p data-i18n="cat_g_8">เทอร์โมกราฟี</p></div>
          </div>
        </a>
        <a href="{{ route('product.category', ['slug' => 'ScopeMeters']) }}" class="block lift">
          <div class="card overflow-hidden cat-card">
            <img src="{{ asset('storage/scope-meters.jpg') }}" alt="Scope Meters" class="w-full h-40 md:h-44 object-cover">
            <div class="cat-caption"><p data-i18n="cat_g_9">เครื่องวัดสโคป</p></div>
          </div>
        </a>
        <a href="{{ route('product.category', ['slug' => 'Temperature']) }}" class="block lift">
          <div class="card overflow-hidden cat-card">
            <img src="{{ asset('storage/temperature.jpg') }}" alt="Temperature Tools" class="w-full h-40 md:h-44 object-cover">
            <div class="cat-caption"><p data-i18n="cat_g_10">เครื่องมือวัดอุณหภูมิ</p></div>
          </div>
        </a>
        <a href="{{ route('product.category', ['slug' => 'Thermography']) }}" class="block lift">
          <div class="card overflow-hidden cat-card">
            <img src="{{ asset('storage/thermography.jpg') }}" alt="Thermography" class="w-full h-40 md:h-44 object-cover">
            <div class="cat-caption"><p data-i18n="cat_g_11">กล้องถ่ายภาพความร้อน</p></div>
          </div>
        </a>
        <a href="{{ route('product.category', ['slug' => 'MiscTools']) }}" class="block lift">
          <div class="card overflow-hidden cat-card">
            <img src="{{ asset('storage/misc-tools.jpg') }}" alt="Misc Tools" class="w-full h-40 md:h-44 object-cover">
            <div class="cat-caption"><p data-i18n="cat_g_12">เครื่องมืออื่น ๆ</p></div>
          </div>
        </a>
      </div>
    </div>
  </section>

  {{-- footer --}}
  @include('test.footer')


  <!-- ===== Scripts: Swiper + I18N ===== -->
  <script>
    // Swiper
    document.addEventListener('DOMContentLoaded', function(){
      if (document.querySelector('.mySwiper')) {
        new Swiper('.mySwiper', {
          loop:true,
          pagination:{ el:'.swiper-pagination', clickable:true },
          autoplay:{ delay:3500, disableOnInteraction:false },
          effect:'fade',
          fadeEffect:{ crossFade:true },
          speed:700
        });
      }
    });

    // ===== I18N DICTIONARY =====
    const I18N = {
      'ไทย': {
        brand_name:'FLUKE',
        top_buyer_central:'Buyer Central', top_help:'Help', top_get_app:'Get the App', top_choose_lang:'เลือกภาษา',
        top_login:'เข้าสู่ระบบ', top_join_free:'สมัครสมาชิกฟรี',
        nav_all_categories:'หมวดหมู่ทั้งหมด',
        mega_measure:'เครื่องมือวัด', mega_process:'กระบวนการ/สอบเทียบ', mega_accessories:'อุปกรณ์เสริม',
        cat_left_1:'แคลมป์มิเตอร์', cat_left_2:'มัลติมิเตอร์', cat_left_3:'เครื่องทดสอบไฟฟ้า', cat_left_4:'เครื่องวัดฉนวน', cat_left_5:'กล้องถ่ายภาพความร้อน',
        cat_left_p1:'เครื่องสอบเทียบลูป', cat_left_p2:'เครื่องสอบเทียบความดัน', cat_left_p3:'เครื่องสอบเทียบอุณหภูมิ', cat_left_p4:'เครื่องสอบเทียบกระบวนการ',
        cat_left_a1:'สายวัดและโพรบ', cat_left_a2:'แบตเตอรี่และชาร์จ', cat_left_a3:'กล่องเก็บเครื่องมือ', cat_left_a4:'อะไหล่สำรอง',
        search_placeholder:'คุณต้องการให้เราช่วยค้นหาอะไร', search_btn:'ค้นหา',
        left_c1:'แคลมป์มิเตอร์', left_c2:'มัลติมิเตอร์', left_c3:'เครื่องตรวจไฟ/ทดสอบไฟฟ้า', left_c4:'กล้องถ่ายภาพความร้อน',
        left_c5:'เครื่องวัดฉนวน', left_c6:'คุณภาพไฟฟ้า', left_c7:'เครื่องสอบเทียบ', left_c8:'อุปกรณ์เสริม',
        promo1_title:'ข้อเสนอพิเศษ', promo1_sub:'ประหยัดกว่าเดิม',
        promo2_title:'สินค้าใหม่ล่าสุด', promo2_sub:'อัปเดตทุกสัปดาห์',
        flash_title:'Flash Deals', flash_view_all:'ดูทั้งหมด', deal_name:'ชื่อสินค้า',
        cat_title:'หมวดหมู่สินค้า',
        cat_g_1:'แคลมป์มิเตอร์', cat_g_2:'เครื่องทดสอบไฟฟ้า', cat_g_3:'เครื่องทดสอบสายดิน', cat_g_4:'เครื่องวัดฉนวน',
        cat_g_5:'มัลติมิเตอร์', cat_g_6:'คุณภาพไฟฟ้า', cat_g_7:'การบำรุงรักษา', cat_g_8:'เทอร์โมกราฟี',
        cat_g_9:'เครื่องวัดสโคป', cat_g_10:'เครื่องมือวัดอุณหภูมิ', cat_g_11:'กล้องถ่ายภาพความร้อน', cat_g_12:'เครื่องมืออื่น ๆ',
        footer_contact:'ติดต่อเรา', footer_branch:'สาขาของเรา', footer_social:'Facebook / YouTube',
        footer_service:'บริการของเรา', footer_calib:'ห้องปฏิบัติการสอบเทียบ', footer_promo:'สินค้าโปรโมชั่น',
        footer_warranty:'การรับประกันสินค้า', footer_repair:'บริการซ่อมแซม',
        footer_info:'ข้อมูล', footer_ship:'ค่าขนส่ง', footer_terms:'ข้อกำหนด / ความเป็นส่วนตัว',
        footer_order:'วิธีการสั่งซื้อ', footer_faq:'คำถามที่พบบ่อย',
        footer_payment:'วิธีชำระเงิน', footer_cards:'Visa / Mastercard / โอนเงิน',
        footer_transfer:'รองรับการโอนผ่านบัญชีบริษัท', footer_cod:'เงินสดปลายทาง',
        copyright:'© 2024 FLUKE. สงวนลิขสิทธิ์ทั้งหมด',top_user:'ผู้ใช้',top_logout:'ออกจากระบบ',label_profile:'โปรไฟล์'
      },
      'English': {
        brand_name:'FLUKE',
        top_buyer_central:'Buyer Central', top_help:'Help', top_get_app:'Get the App', top_choose_lang:'Choose language',
        top_login:'Login', top_join_free:'Join Free',
        nav_all_categories:'All categories',
        mega_measure:'Measuring Tools', mega_process:'Process / Calibration', mega_accessories:'Accessories',
        cat_left_1:'Clamp Meters', cat_left_2:'Multimeters', cat_left_3:'Electrical Testers', cat_left_4:'Insulation Testers', cat_left_5:'Thermal Cameras',
        cat_left_p1:'Loop Calibrators', cat_left_p2:'Pressure Calibrators', cat_left_p3:'Temperature Calibrators', cat_left_p4:'Process Calibrators',
        cat_left_a1:'Test Leads & Probes', cat_left_a2:'Batteries & Chargers', cat_left_a3:'Tool Cases', cat_left_a4:'Spare Parts',
        search_placeholder:'What can we help you find?', search_btn:'Search',
        left_c1:'Clamp Meters', left_c2:'Multimeters', left_c3:'Electrical Testers', left_c4:'Thermal Cameras',
        left_c5:'Insulation Testers', left_c6:'Power Quality', left_c7:'Loop Calibrators', left_c8:'Accessories',
        promo1_title:'Special Offers', promo1_sub:'More worthwhile',
        promo2_title:'Latest Products', promo2_sub:'Updated weekly',
        flash_title:'Flash Deals', flash_view_all:'View all', deal_name:'Product name',
        cat_title:'Categories',
        cat_g_1:'Clamp Meters', cat_g_2:'Electrical Testers', cat_g_3:'Ground Resistance', cat_g_4:'Insulation Testers',
        cat_g_5:'Multimeters', cat_g_6:'Power Quality', cat_g_7:'Preventative Maintenance', cat_g_8:'Thermography',
        cat_g_9:'Scope Meters', cat_g_10:'Temperature Tools', cat_g_11:'Thermal Imaging', cat_g_12:'Misc Tools',
        footer_contact:'Contact Us', footer_branch:'Our Branches', footer_social:'Facebook / YouTube',
        footer_service:'Our Services', footer_calib:'Calibration Laboratory', footer_promo:'Promotion Products',
        footer_warranty:'Warranty', footer_repair:'Repair Service',
        footer_info:'Information', footer_ship:'Shipping Cost', footer_terms:'Terms / Privacy Policy',
        footer_order:'How to Order', footer_faq:'FAQ',
        footer_payment:'Payment Methods', footer_cards:'Visa / Mastercard / Bank Transfer',
        footer_transfer:'Support company account transfer', footer_cod:'Cash on Delivery',
        copyright:'© 2024 FLUKE. All rights reserved',top_user:'user',top_logout:'Sign out',label_profile:'Profile'
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
  </script>

<script>
(function () {
  const grid = document.getElementById('flashGrid');
  const tpl  = document.getElementById('dealTileTemplate');
  const CACHE_KEY = 'flashDealsCacheV1';
  const CACHE_TTL_MIN = 360;
  const MAX_ITEMS = 100;
  const EXCHANGE = 38;

  if (!grid || !tpl) return;

  ['grid','grid-cols-2','sm:grid-cols-3','md:grid-cols-6'].forEach(c => grid.classList.remove(c));
  grid.classList.add('relative','overflow-hidden','w-full');

  const track = document.createElement('div');
  track.id = 'flashTrack';
  track.className = 'flex items-stretch gap-3 will-change-transform';
  grid.innerHTML = '';
  grid.appendChild(track);

  window.allItems = [];

  const getLang = () => localStorage.getItem('site_lang') || localStorage.getItem('preferredLanguage') || 'ไทย';
  const fmtTHB = v => new Intl.NumberFormat('th-TH', { style:'currency', currency:'THB', minimumFractionDigits:0, maximumFractionDigits:2 }).format(v);
  const fmtUSD = v => new Intl.NumberFormat('en-US', { style:'currency', currency:'USD', minimumFractionDigits:0, maximumFractionDigits:2 }).format(v);

  const I18N = { th: { quote: 'ขอใบเสนอราคา' }, en: { quote: 'Request a quote' } };
  const normalizeLang = (s) => {
    s = (s || '').toLowerCase();
    if (['ไทย','thai','th','th-th'].includes(s)) return 'th';
    if (['english','en','en-us','en-gb'].includes(s)) return 'en';
    return 'th';
  };
  const t = (key) => I18N[normalizeLang(getLang())]?.[key] ?? I18N.en[key] ?? key;

  const toUSD = (thb) => {
    if (!Number.isFinite(thb) || thb <= 0) return null;
    const satang = Math.round(thb * 100);
    const cents  = Math.ceil(satang / EXCHANGE);
    return cents / 100;
  };

  function renderPriceText(price){
    if (price == null || !Number.isFinite(price) || price <= 0) return t('quote');
    return (normalizeLang(getLang()) === 'en') ? fmtUSD(toUSD(price)) : fmtTHB(price);
  }

  function parseTHB(raw){
    if (raw == null) return null;
    const s = String(raw).replace(/[^\d.]/g,'');
    if (!s) return null;
    const n = parseFloat(s);
    return Number.isFinite(n) ? n : null;
  }

  const slugify = (name)=> String(name||'').toLowerCase().trim()
    .replace(/[\/\s]+/g,'-').replace(/[^\u0E00-\u0E7Fa-z0-9\-]+/gi,'')
    .replace(/-+/g,'-').replace(/^-|-$/g,'');

  function readCache(){
    try{
      const raw = localStorage.getItem(CACHE_KEY);
      if(!raw) return null;
      const obj = JSON.parse(raw);
      if(!obj || !Array.isArray(obj.items)) return null;
      if (obj.ts && (Date.now() - obj.ts) > CACHE_TTL_MIN*60*1000) return null;
      return obj.items;
    }catch{ return null; }
  }
  function writeCache(items){
    try{ localStorage.setItem(CACHE_KEY, JSON.stringify({ ts: Date.now(), items })); }catch{}
  }

  function createCard(item){
    const node = tpl.content.cloneNode(true);
    const a    = node.querySelector('a');
    const img  = node.querySelector('img.deal-img');
    const name = node.querySelector('.deal-name');
    const price= node.querySelector('.deal-price');

    a.classList.add('w-32','md:w-36','shrink-0');

    const n = (item.name || '').trim() || '—';
    const valTHB = parseTHB(item.webpriceTHB);

    a.href = '/product/' + encodeURIComponent(item.iditem);
    a.title = n;

    if (img){
      if (item.pic){
        img.src = item.pic;
        img.alt = n;
        img.loading = 'lazy';
        img.decoding = 'async';
      } else {
        img.remove();
      }
    }

    if (name){
      name.textContent = n;
      name.classList.add('text-[11px]','md:text-[12px]','leading-tight');
    }

    if (price){
      price.textContent = renderPriceText(valTHB);
      price.classList.add('text-[12px]','md:text-[13px]','leading-tight','font-medium');
    }

    return node;
  }

  // ===== Infinite marquee (ไม่บล็อกรอรูป) =====
  let rafId=null, paused=false, offsetX=0, pxPerSec=50; // ทำให้ขยับแน่นอน
  let cycleWidth=0, lastTs=0;

  function measureCycle(){
    cycleWidth = Math.floor(track.scrollWidth / 2) || 0;
  }

  function step(ts){
    if (!lastTs) lastTs = ts;
    const dt = (ts - lastTs) / 1000;
    lastTs = ts;

    if (!paused && pxPerSec > 0 && cycleWidth > 0){
      offsetX -= pxPerSec * dt;
      if (offsetX <= -cycleWidth){
        offsetX += cycleWidth;
      }
      track.style.transform = `translate3d(${offsetX}px,0,0)`;
    }
    rafId = requestAnimationFrame(step);
  }

  function startMarquee(){
    if (rafId) cancelAnimationFrame(rafId);
    measureCycle();
    offsetX = 0; lastTs = 0;
    rafId = requestAnimationFrame(step);
  }

  function renderAll(items){
    track.innerHTML = '';
    const base = items.concat(items);
    base.forEach(it => track.appendChild(createCard(it)));

    // เติมให้พอความกว้างอย่างน้อย 2× viewport
    const minWidth = grid.clientWidth * 2;
    while (track.scrollWidth < minWidth) {
      base.forEach(it => track.appendChild(createCard(it)));
      // กัน loop ค้างถ้าความกว้างยัง 0 เพราะไม่มีไอเท็ม
      if (!track.childElementCount) break;
    }

    // เริ่มเลย ไม่รอรูป
    startMarquee();

    // หลังรูปโหลดค่อยวัดใหม่ (ไม่บล็อค)
    track.querySelectorAll('img').forEach(img=>{
      if (!img.complete){
        img.addEventListener('load', ()=>{ measureCycle(); }, { once:true });
        img.addEventListener('error', ()=>{ measureCycle(); }, { once:true });
      }
    });
  }

  function shuffleAndPick(arr, max){
    const copy = arr.slice();
    for (let i = copy.length - 1; i > 0; i--){
      const j = Math.floor(Math.random() * (i + 1));
      [copy[i], copy[j]] = [copy[j], copy[i]];
    }
    return copy.slice(0, max);
  }

  function loadDeals(){
    let pool = Array.isArray(window.FLASH_DEALS)
      ? window.FLASH_DEALS.filter(x => x && x.pic && parseTHB(x.webpriceTHB) != null)
      : [];

    if (!pool.length){
      const cached = readCache();
      if (cached && cached.length) pool = cached;
    }

    if (pool.length){
      window.allItems = shuffleAndPick(pool, MAX_ITEMS);
      writeCache(pool);
      renderAll(window.allItems);
    } else {
      track.innerHTML = '<div class="p-3 text-sm text-gray-500">No deals</div>';
      startMarquee(); // ให้ระบบยังทำงานแม้ไม่มีรูป
    }
  }

  // ✅ ถ้า DOM โหลดไปแล้วให้เรียกทันที มิฉะนั้นรอ event
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', loadDeals);
  } else {
    loadDeals();
  }

  function rerenderCurrency(){
    if (window.allItems && window.allItems.length){
      renderAll(window.allItems);
    }
  }
  window.addEventListener('storage', (e)=>{
    if (e.key === 'site_lang' || e.key === 'preferredLanguage'){
      rerenderCurrency();
    }
  });
  window.addEventListener('site_lang_changed', rerenderCurrency);
  window.rerenderCurrency = rerenderCurrency;

  // QoL
  grid.addEventListener('mouseenter', ()=> paused=true);
  grid.addEventListener('mouseleave', ()=> paused=false);
  document.addEventListener('visibilitychange', ()=>{ paused = document.hidden; });

  let resizeTimer=null;
  window.addEventListener('resize', ()=>{
    clearTimeout(resizeTimer);
    resizeTimer=setTimeout(()=>{
      const wasPaused = paused;
      paused = true;
      const prevCycle = cycleWidth;
      measureCycle();
      if (prevCycle && cycleWidth) {
        // รักษาตำแหน่งสัมพัทธ์
        offsetX = ((offsetX % cycleWidth) + cycleWidth) % cycleWidth * -1;
      }
      paused = wasPaused;
    },150);
  });

  // ❗️ยกเลิกการปิดแอนิเมชันอัตโนมัติจาก prefers-reduced-motion
  // ถ้าต้องการให้เคารพ PRM ให้ปลดคอมเมนต์ด้านล่าง
  // const mediaPRM = window.matchMedia('(prefers-reduced-motion: reduce)');
  // if (mediaPRM.matches) pxPerSec = 0;
  // mediaPRM.addEventListener?.('change', (e)=>{ pxPerSec = e.matches ? 0 : 50; });

})();
</script>



<script>
(function(){
const EXCHANGE = 38;

  // ดึง input ทั้ง 2 (desktop + mobile)
  const inputs = [
    { el: document.getElementById('globalSearch'), results: document.getElementById('searchResultsDesktop') },
    { el: document.getElementById('mobileSearchInput'), results: document.getElementById('searchResultsMobile') }
  ].filter(x => x.el && x.results);

  if (!inputs.length) return;

  let ALL = [];
  const BASE = location.origin + '/';

  const getLang = () => localStorage.getItem('site_lang') || localStorage.getItem('preferredLanguage') || 'ไทย';
  const fmtTHB = v => new Intl.NumberFormat('th-TH',{
    style:'currency', currency:'THB', minimumFractionDigits:0, maximumFractionDigits:2
  }).format(v);
  const fmtUSD = v => new Intl.NumberFormat('en-US',{
    style:'currency', currency:'USD', minimumFractionDigits:0, maximumFractionDigits:2
  }).format(v);

  // ✅ แปลงบาท → ดอลลาร์ โดยปัดขึ้นเป็นเซนต์
  const toUSD = (thb) => {
    if (!Number.isFinite(thb)) return null;
    const satang = Math.round(thb * 100);
    const cents  = Math.ceil(satang / EXCHANGE);
    return cents / 100;
  };

  const priceText = (p)=>{
    if (typeof p === 'number' && !isNaN(p)){
      return (getLang()==='English') ? fmtUSD(toUSD(p)) : fmtTHB(p);
    }
    return (getLang()==='English') ? '$0.00' : '฿—';
  };

  // ✅ parser ราคา (ทศนิยมได้)
  function parseTHB(raw){
    if (raw == null) return null;
    const s = String(raw).replace(/[^\d.]/g,'');
    if (!s) return null;
    const n = parseFloat(s);
    return Number.isFinite(n) ? n : null;
  }

  const slugify = (name)=> String(name||'').toLowerCase().trim()
    .replace(/[\/\s]+/g,'-').replace(/[^\u0E00-\u0E7Fa-z0-9\-]+/gi,'')
    .replace(/-+/g,'-').replace(/^-|-$/g,'');

  function buildHref(item){
    const name = (item.name || '').trim();
    const urlParams = new URLSearchParams({
      slug: slugify(name),
      name: name,
      image: item.image || '',
      columnJ: item.columnJ || '',
      price: (typeof item.price === 'number' && !isNaN(item.price)) ? String(item.price) : ''
    });
    return BASE.replace(/\/+$/,'/') + 'product?' + urlParams.toString();
  }

  // ✅ ไม่ดึง API — ใช้ข้อมูล preload จาก DB → window.PRODUCTS (ใช้ webpriceTHB อย่างเดียว)
  function ensureData(){
    if (ALL.length) return;
    const src = Array.isArray(window.PRODUCTS) ? window.PRODUCTS : [];
    ALL = src.map(x => ({
      name: x.name || '',
      category: x.category || '',
      image: x.image || x.pic || '',
      price: parseTHB(x.webpriceTHB), // ← ใช้ webpriceTHB อย่างเดียว
      columnJ: x.columnJ || ''
    }))
    .filter(x => x.name && (x.image || x.price != null));
  }

  function searchLocal(q){
    const s = q.trim().toLowerCase();
    if (s.length < 3) return [];
    const tokens = s.split(/\s+/).filter(Boolean);
    const ok = (item)=>{
      const name = String(item.name || '').toLowerCase();
      const cat  = String(item.category || '').toLowerCase();
      return tokens.every(t => name.includes(t) || cat.includes(t));
    };
    return ALL.filter(ok).slice(0, 50);
  }

  function renderDropdown(target, list){
    const dd = target.results;
    dd.innerHTML = '';

    if (!list.length){
      dd.innerHTML = `<div class="px-3 py-2 text-sm text-gray-500">ไม่พบผลลัพธ์</div>`;
      dd.classList.remove('hidden');
      return;
    }

    list.slice(0, 10).forEach(it=>{
      const href = buildHref(it);
      const name = (it.name || '').trim() || '—';
      const cat  = (it.category || '').trim() || '';
      const img  = it.image || '';
      const price= priceText(it.price);

      const row = document.createElement('a');
      row.href = href;
      row.className = 'flex gap-3 items-center px-3 py-2 hover:bg-orange-50 transition-colors';
      row.innerHTML = `
        <div class="h-10 w-10 rounded border bg-gray-50 overflow-hidden flex-shrink-0">
          ${img ? `<img src="${img}" alt="" class="w-full h-full object-cover">` : ''}
        </div>
        <div class="min-w-0 flex-1">
          <div class="text-sm text-gray-800 truncate">${name}</div>
          <div class="text-xs text-gray-500 truncate">${cat}</div>
        </div>
        <div class="text-sm font-semibold text-[var(--brand)] ml-2">${price}</div>
      `;
      dd.appendChild(row);
    });

    dd.classList.remove('hidden');
  }

  // ใส่ event ให้ทั้ง desktop + mobile
  inputs.forEach(target=>{
    let timer=null;
    target.el.addEventListener('input', ()=>{
      const q = target.el.value;
      clearTimeout(timer);
      timer = setTimeout(()=>{
        if (q.trim().length < 3){ target.results.classList.add('hidden'); return; }
        ensureData();
        const results = searchLocal(q);
        renderDropdown(target, results);
      }, 220);
    });

    // click outside
    document.addEventListener('click', (e)=>{
      if (!e.target.closest(`#${target.results.id}, #${target.el.id}`)){
        target.results.classList.add('hidden');
      }
    });
  });

})();
</script>



<script>
  window.FLASH_DEALS = @json($flashDeals ?? []);
  window.PRODUCTS    = @json($products ?? []);
</script>



<!-- ===== Cart Badge Sync ===== -->
<script>
(function(){
  const LS_KEY = 'cartV1';   // เก็บข้อมูลตะกร้าใน localStorage

  // โหลดข้อมูลตะกร้า
  const load = () => { 
    try { return JSON.parse(localStorage.getItem(LS_KEY) || '[]'); } 
    catch { return []; } 
  };

  // รวมจำนวนสินค้าทั้งหมด
  const totalQty = () => load().reduce((s,it)=> s + (Number(it.qty)||1), 0);

  // อัปเดต badge ที่ไอคอนตะกร้า
  function updateCartBadge(){
    const badge = document.querySelector('a[aria-label="cart"] span');
    if(!badge) return;
    const n = totalQty();
    badge.textContent = String(n);
    badge.style.transform = 'scale(1.15)';
    setTimeout(()=> badge.style.transform = 'scale(1)', 130);
  }

  // ฟัง event เมื่อมีการเปลี่ยนตะกร้า
  window.addEventListener('storage', (e)=>{
    if (e.key === LS_KEY || e.key === '__cart_changed__'){
      updateCartBadge();
    }
  });

  document.addEventListener('DOMContentLoaded', updateCartBadge);
})();
</script>
<!-- ===== Minimal, accessible JS for toggles/drawer ===== -->
<script>
  (function () {
    // Collapse toggles (for mobile accordions & search)
    document.querySelectorAll('[data-collapse-toggle]').forEach(btn => {
      const targetSel = btn.getAttribute('data-collapse-toggle');
      const target = document.querySelector(targetSel);
      if (!target) return;
      btn.addEventListener('click', () => {
        const isHidden = target.classList.contains('hidden');
        target.classList.toggle('hidden');
        btn.setAttribute('aria-expanded', String(isHidden));
      });
    });

    // Drawer (mobile off-canvas)
    const openers = document.querySelectorAll('[data-drawer-toggle]');
    const closers = document.querySelectorAll('[data-drawer-close]');
    function openDrawer(sel) {
      const wrap = document.querySelector(sel);
      if (!wrap) return;
      const drawer = wrap.querySelector('aside');
      wrap.classList.remove('hidden');
      // next frame to allow transition
      requestAnimationFrame(() => drawer.classList.remove('translate-x-full'));
      // focus close button for accessibility
      const closeBtn = wrap.querySelector('[data-drawer-close]');
      if (closeBtn) closeBtn.focus();
      // esc to close
      function onEsc(e){ if (e.key === 'Escape') closeDrawer(sel, true); }
      wrap._escHandler = onEsc;
      document.addEventListener('keydown', onEsc);
    }
    function closeDrawer(sel, fromEsc=false) {
      const wrap = document.querySelector(sel);
      if (!wrap) return;
      const drawer = wrap.querySelector('aside');
      drawer.classList.add('translate-x-full');
      // wait for transition then hide
      drawer.addEventListener('transitionend', function onEnd() {
        wrap.classList.add('hidden');
        drawer.removeEventListener('transitionend', onEnd);
      }, { once: true });
      if (wrap._escHandler) {
        document.removeEventListener('keydown', wrap._escHandler);
        wrap._escHandler = null;
      }
      // restore focus to opener
      if (!fromEsc) {
        const opener = document.querySelector(`[data-drawer-toggle="${sel}"]`);
        if (opener) opener.focus();
      }
    }
    openers.forEach(btn => {
      const sel = btn.getAttribute('data-drawer-toggle');
      btn.addEventListener('click', () => {
        const wrap = document.querySelector(sel);
        const drawer = wrap && wrap.querySelector('aside');
        const isClosed = drawer && drawer.classList.contains('translate-x-full');
        if (isClosed) openDrawer(sel); else closeDrawer(sel);
        btn.setAttribute('aria-expanded', String(isClosed));
      });
    });
    closers.forEach(btn => {
      const sel = btn.getAttribute('data-drawer-close');
      btn.addEventListener('click', () => closeDrawer(sel));
    });
  })();
</script>
</body>
</html>
