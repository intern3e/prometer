<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FLUKE | Multimeters</title>
  <link rel="icon" type="image/png" href="https://img5.pic.in.th/file/secure-sv1/ChatGPT_Image_18_.._2568_12_03_57-removebg-preview.png">

</head>
<body>
  
  <?php echo $__env->make('test.header-nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  
  <main>
    <?php echo $__env->yieldContent('content'); ?>
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
        <li><a href="/ClampMeter1" class="px-3 py-2" data-i18n="left_c1">แคลมป์มิเตอร์</a></li>
        <li><a href="Multimeters" class="px-3 py-2" data-i18n="left_c2">มัลติมิเตอร์</a></li>
        <li><a href="ElectricalTesters" class="px-3 py-2" data-i18n="left_c3">เครื่องตรวจไฟ/ทดสอบไฟฟ้า</a></li>
        <li><a href="Thermography" class="px-3 py-2" data-i18n="left_c4">กล้องถ่ายภาพความร้อน</a></li>
        <li><a href="InsulationTesters" class="px-3 py-2" data-i18n="left_c5">เครื่องวัดฉนวน</a></li>
        <li><a href="PowerQuality" class="px-3 py-2" data-i18n="left_c6">คุณภาพไฟฟ้า</a></li>
        <li><a href="LoopCalibrators" class="px-3 py-2" data-i18n="left_c7">เครื่องสอบเทียบ</a></li>
        <li><a href="Accessories" class="px-3 py-2" data-i18n="left_c8">อุปกรณ์เสริม</a></li>
      </ul>
    </aside>

    <!-- hero slider -->
    <div class="md:col-span-6">
      <div class="swiper mySwiper swiper-pro card">
        <div class="swiper-wrapper">
          <div class="swiper-slide bg-white flex items-center justify-center">
            <img src="<?php echo e(asset('storage/logo.jpg')); ?>" alt="hero1" class="max-w-full max-h-full object-contain" loading="eager" decoding="async" />
          </div>
          <div class="swiper-slide bg-white flex items-center justify-center">
            <img src="<?php echo e(asset('storage/logo1.jpg')); ?>" alt="hero2" class="max-w-full max-h-full object-contain" loading="eager" decoding="async" />
          </div>
          <div class="swiper-slide bg-white flex items-center justify-center">
            <img src="<?php echo e(asset('storage/logo2.jpg')); ?>" alt="hero3" class="max-w-full max-h-full object-contain" loading="eager" decoding="async" />
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
          <p class="text-sm text-gray-600 truncate" data-i18n="promo1_sub">ประหยัดกว่าเดิม</p>
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
<!-- ===== Clamp Meter List (NEW) ===== -->
<section class="container-outer mx-auto section-pad mt-6">
  <div class="flex items-center justify-between mb-3">
    <h3 class="text-lg md:text-xl font-bold" data-i18n="clamp_title">แคลมป์มิเตอร์</h3>

    <select id="clampSort" class="border rounded-md text-sm px-2 py-1">
      <option value="price_desc" data-i18n="sort_price_desc">ราคาสูง → ต่ำ</option>
      <option value="price_asc" data-i18n="sort_price_asc">ราคาต่ำ → สูง</option>
      <option value="name_asc" data-i18n="sort_name_asc">A → Z</option>
      <option value="name_desc" data-i18n="sort_name_desc">Z → A</option>
    </select>
  </div>

  <div id="clampGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
    <template id="clampTileTemplate">
      <a class="block hover:shadow transition-fast">
        <div class="border rounded-lg overflow-hidden bg-white">
          <div class="aspect-square bg-gray-50">
            <img class="clamp-img block w-full h-full object-cover object-center" alt="">
          </div>
        </div>
        <div class="p-2">
          <p class="clamp-name text-xs text-gray-700 line-clamp-2">ชื่อสินค้า</p>
          <p class="clamp-price text-[var(--brand)] font-semibold mt-1">฿—</p>
        </div>
      </a>
    </template>
  </div>

  <!-- Pagination (NEW) -->
  <div id="clampPager"
       class="flex items-center justify-center gap-1 mt-4 select-none"
       aria-label="Pagination">
  </div>

  <div id="clampEmpty" class="hidden text-center text-sm text-gray-600 py-6" data-i18n="clamp_empty">
    Product not found
  </div>
</section>



   
  <?php echo $__env->make('test.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

 <!-- ===== Scripts: Swiper + I18N (FIXED) ===== -->
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

  // ===== I18N DICTIONARY (FIXED) =====
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
      copyright:'© 2024 FLUKE. สงวนลิขสิทธิ์ทั้งหมด',
      clamp_title:'มัลติมิเตอร์',
      sort_price_desc:'ราคาสูง → ต่ำ',
      sort_price_asc:'ราคาต่ำ → สูง',
      sort_name_asc:'A → Z',
      sort_name_desc:'Z → A',
      top_user:'ผู้ใช้',top_logout:'ออกจากระบบ', 
      clamp_empty:'ไม่พบสินค้าที่ค้นหา'
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
      copyright:'© 2024 FLUKE. All rights reserved',
      clamp_title:'Multimeters',
      sort_price_desc:'Price High → Low',
      sort_price_asc:'Price Low → High',
      sort_name_asc:'A → Z',
      sort_name_desc:'Z → A',
      top_user:'user',top_logout:'Sign out',
      clamp_empty:'No Clamp Meter products found'
    }
  };

  // ===== I18N ENGINE =====
  function applyI18n(lang){
    const dict = I18N[lang] || I18N['ไทย'];
    document.documentElement.lang = (lang === 'ไทย') ? 'th' : 'en';
    document.title = (lang === 'ไทย')
      ? 'FLUKE | มัลติมิเตอร์'
      : 'FLUKE | Multimeters';

    document.querySelectorAll('[data-i18n]').forEach(el=>{
      const key = el.getAttribute('data-i18n');
      const val = dict[key];
      if (val == null) return;
      const attr = el.getAttribute('data-i18n-attr');
      if (attr){ el.setAttribute(attr, val); } else { el.textContent = val; }
    });

    const label = document.getElementById('currentLangLabel');
    if (label) label.textContent = (lang === 'ไทย') ? 'ไทย' : 'English';

    // save & broadcast
    localStorage.setItem('preferredLanguage', lang);
    localStorage.setItem('site_lang', lang);

    // แจ้งส่วนอื่น ๆ (เช่น Clamp Grid) ให้ re-render
    window.dispatchEvent(new CustomEvent('site_lang_changed', { detail:{ lang } }));
  }

  document.addEventListener('DOMContentLoaded', () => {
    // Language UI wiring (with null-safety)
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

    // Init language (safe default)
    const saved = localStorage.getItem('preferredLanguage') || 'ไทย';
    localStorage.setItem('site_lang', saved);
    applyI18n(saved);
  });
</script>

<script>
(function(){
  const API = '/api/monkeybusiness'; 
  const grid   = document.getElementById('clampGrid');
  const pager  = document.getElementById('clampPager');
  const tpl    = document.getElementById('clampTileTemplate');
  const empty  = document.getElementById('clampEmpty');
  const sortEl = document.getElementById('clampSort');
  const EXCHANGE = 30;

  if (!grid || !tpl) return;

  // ===== state =====
  let ALL = [];
  let SORTED = [];
  let PER_PAGE = 15;
  let CURRENT_PAGE = 1;
  let CURRENT_SORT = 'default';

  // ===== helpers =====
  const metaBase = document.querySelector('meta[name="base-url"]')?.content;
  const BASE = (metaBase && metaBase.trim()) ? metaBase : (location.origin + '/');

  const getLang = () => localStorage.getItem('site_lang') || localStorage.getItem('preferredLanguage') || 'ไทย';
  const fmtTHB = v => new Intl.NumberFormat('th-TH',{style:'currency',currency:'THB',maximumFractionDigits:0}).format(v);
  const fmtUSD = v => new Intl.NumberFormat('en-US',{style:'currency',currency:'USD',maximumFractionDigits:2}).format(v);

  const slugify = (name)=> String(name||'').toLowerCase().trim()
    .replace(/[\/\s]+/g,'-').replace(/[^\u0E00-\u0E7Fa-z0-9\-]+/gi,'')
    .replace(/-+/g,'-').replace(/^-|-$/g,'');

function isClampCategory(cat) {
  const c = String(cat || '').toLowerCase();
  const targets = [
    'Multimeter',
  ];
  return targets.some(t => c.includes(t.toLowerCase()));
}


  function createCard(item){
    const node  = tpl.content.cloneNode(true);
    const a     = node.querySelector('a');
    const imgEl = node.querySelector('.clamp-img');
    const nameEl= node.querySelector('.clamp-name');
    const priceEl=node.querySelector('.clamp-price');

    const name = (item.name || '').trim() || '—';
    const slug = slugify(name);

    const urlParams = new URLSearchParams({
      slug: slug,
      name: name,
      image: item.image || '',
      columnJ: item.columnJ || '',
      price: (typeof item.price === 'number' && !isNaN(item.price)) ? String(item.price) : ''
    });
    a.href  = BASE.replace(/\/+$/,'/') + 'product?' + urlParams.toString();
    a.title = name;

    if (item.image){
      imgEl.src = item.image;
      imgEl.alt = name;
      imgEl.loading = 'lazy';
      imgEl.decoding = 'async';
    } else {
      imgEl.remove();
    }

    nameEl.textContent = name;

    if (typeof item.price === 'number' && !isNaN(item.price)){
      const lang = getLang();
      priceEl.textContent = (lang === 'English') ? fmtUSD(item.price/EXCHANGE) : fmtTHB(item.price);
    } else {
      priceEl.textContent = (getLang()==='English') ? '$0.00' : '฿—';
    }
    return node;
  }

  // ===== sort =====
  const makeCollator = () => new Intl.Collator((getLang()==='English') ? 'en' : 'th', { numeric:true, sensitivity:'base' });
  let collator = makeCollator();

  function applySort(type, goFirstPage=true){
    CURRENT_SORT = type || 'default';
    switch(CURRENT_SORT){
      case 'price_desc': SORTED = [...ALL].sort((a,b) => ((b.price||0) - (a.price||0))); break;
      case 'price_asc' : SORTED = [...ALL].sort((a,b) => ((a.price||0) - (b.price||0))); break;
      case 'name_asc'  : SORTED = [...ALL].sort((a,b) => collator.compare(String(a.name||''), String(b.name||''))); break;
      case 'name_desc' : SORTED = [...ALL].sort((a,b) => collator.compare(String(b.name||''), String(a.name||''))); break;
      default          : SORTED = [...ALL];
    }
    renderPage(goFirstPage ? 1 : CURRENT_PAGE);
  }

  // ===== progressive render =====
  function progressiveAppend(list){
    const cols = Math.max(1, getComputedStyle(grid).gridTemplateColumns.split(' ').length);
    let i = 0;
    let batch = Math.max(cols * 3, 8);

    function frame(){
      const start = performance.now();
      const frag = document.createDocumentFragment();
      let count = 0;

      while (i < list.length && count < batch && (performance.now() - start) < 12){
        frag.appendChild(createCard(list[i++]));
        count++;
      }
      grid.appendChild(frag);

      if (i < list.length){
        if (count < batch/2) batch = Math.max(8, Math.floor(batch*0.9));
        else if ((performance.now() - start) < 6) batch = Math.min(batch + cols, 64);
        requestAnimationFrame(frame);
      }
    }
    requestAnimationFrame(frame);
  }

  // ===== render page =====
  function renderPage(page){
    const total = SORTED.length;
    const totalPages = Math.max(1, Math.ceil(total / PER_PAGE));
    CURRENT_PAGE = Math.min(Math.max(1, page), totalPages);

    grid.innerHTML = '';
    if (total === 0){
      empty.classList.remove('hidden');
      pager.innerHTML = '';
      return;
    }
    empty.classList.add('hidden');

    const start = (CURRENT_PAGE - 1) * PER_PAGE;
    const end   = start + PER_PAGE;
    const pageItems = SORTED.slice(start, end);

    progressiveAppend(pageItems);
    renderPager(totalPages);
    scrollIntoViewIfMobile();
  }

  function renderPager(totalPages){
    if (!pager) return;
    pager.innerHTML = '';

    const mkBtn = (label, page, {active=false, disabled=false, ariaLabel=null}={})=>{
      const btn = document.createElement('button');
      btn.type = 'button';
      btn.textContent = label;
      btn.className = [
        'px-3','py-1.5','rounded-md','border','text-sm','transition-fast',
        active ? 'bg-[var(--brand)] text-white border-[var(--brand)]'
               : 'bg-white text-gray-700 border-gray-300 hover:border-[var(--brand)] hover:text-[var(--brand)]',
        disabled ? 'opacity-50 cursor-not-allowed' : ''
      ].join(' ');
      if (ariaLabel) btn.setAttribute('aria-label', ariaLabel);
      if (!disabled){ btn.addEventListener('click', ()=> renderPage(page)); }
      return btn;
    };

    const total = totalPages;
    const cur = CURRENT_PAGE;

    pager.appendChild(mkBtn('«', cur-1, {disabled: cur<=1, ariaLabel:'Previous page'}));

    const windowSize = 2;
    const pages = [];
    for (let p=1; p<=total; p++){
      if (p===1 || p===total || (p>=cur-windowSize && p<=cur+windowSize)) pages.push(p);
      else if (pages[pages.length-1] !== '...') pages.push('...');
    }

    pages.forEach(p=>{
      if (p === '...'){
        const span = document.createElement('span');
        span.textContent = '…';
        span.className = 'px-2 text-gray-500';
        pager.appendChild(span);
      }else{
        pager.appendChild(mkBtn(String(p), p, {active: p===cur}));
      }
    });

    pager.appendChild(mkBtn('»', cur+1, {disabled: cur>=total, ariaLabel:'Next page'}));
  }

  function reRenderCurrentPage(){
    if (CURRENT_SORT === 'name_asc' || CURRENT_SORT === 'name_desc'){
      applySort(CURRENT_SORT, false);
    } else {
      renderPage(CURRENT_PAGE);
    }
  }

  function scrollIntoViewIfMobile(){
    if (window.matchMedia('(max-width: 767px)').matches){
      grid.scrollIntoView({behavior:'smooth', block:'start'});
    }
  }

  const SIG = (arr) => {
    if (!Array.isArray(arr)) return '0|';
    const n = arr.length;
    const head = arr.slice(0, 5).map(x => (x?.name||'') + '|' + (x?.price??'')).join('~');
    return n + '|' + head;
  };

  async function fetchClamps(){
    const res = await fetch(API + '?nocache=' + Date.now(), { cache:'no-store' });
    const data = await res.json();

    // ✅ map field จาก API fluke
    const pool = Array.isArray(data) ? data.map(x => ({
      name: x.name || '',
      category: x.category || '',
      image: x.pic || '',
      price: x.priceTHB ? Number(String(x.priceTHB).replace(/,/g,'')) : null,
      columnJ: x.columnJ || ''
    })) : [];

    return pool.filter(x => isClampCategory(x.category));
  }

  async function loadClamp(initial=false){
    if (initial){
      grid.innerHTML = '';
      pager.innerHTML = '';
      for (let i=0;i<Math.min(6, PER_PAGE);i++){
        const sk = document.createElement('div');
        sk.className = 'animate-pulse';
        sk.innerHTML = `
          <div class="border rounded-lg overflow-hidden bg-white">
            <div class="aspect-square bg-gray-100"></div>
          </div>
          <div class="p-2 space-y-2">
            <div class="h-3 bg-gray-200 rounded"></div>
            <div class="h-4 w-16 bg-gray-200 rounded"></div>
          </div>`;
        grid.appendChild(sk);
      }
    }

    try{
      const clamps = await fetchClamps();
      const changed = SIG(clamps) !== SIG(ALL);
      if (changed){
        ALL = clamps;
        applySort(CURRENT_SORT, true);
      }else if (initial && !ALL.length){
        empty.classList.remove('hidden');
        pager.innerHTML = '';
        grid.innerHTML = '';
      }
    }catch(err){
      console.warn('clamp fetch error:', err);
      if (initial){
        empty.classList.remove('hidden');
        pager.innerHTML = '';
        grid.innerHTML = '';
      }
    }
  }

  let refreshTimer = null;
  function startAutoRefresh(){
    stopAutoRefresh();
    refreshTimer = setInterval(()=>{
      if (document.hidden) return;
      loadClamp(false);
    }, 30000);
  }
  function stopAutoRefresh(){
    if (refreshTimer){ clearInterval(refreshTimer); refreshTimer = null; }
  }
  document.addEventListener('visibilitychange', ()=>{
    if (document.hidden) stopAutoRefresh(); else startAutoRefresh();
  });

  window.addEventListener('storage', (e)=>{
    if (e.key === 'site_lang' && Array.isArray(ALL)){
      collator = makeCollator();
      reRenderCurrentPage();
    }
  });
  window.addEventListener('site_lang_changed', ()=>{
    if (Array.isArray(ALL)){
      collator = makeCollator();
      reRenderCurrentPage();
    }
  });

  if (sortEl){
    sortEl.addEventListener('change', ()=>{
      applySort(sortEl.value, true);
    });
  }

  try{ grid.style.contentVisibility = 'auto'; }catch{}

  document.addEventListener('DOMContentLoaded', async ()=>{
    await loadClamp(true);
    startAutoRefresh();
  });
})();
</script>


 <!-- ===== Global Search Autocomplete (คอลัมน์ C/D, เริ่มที่ 3 ตัว) ===== -->
<script>
(function(){
  const API = '/api/monkeybusiness'; 
  const EXCHANGE = 30;

  // ดึง input ทั้ง 2 (desktop + mobile)
  const inputs = [
    { el: document.getElementById('globalSearch'), results: document.getElementById('searchResultsDesktop') },
    { el: document.getElementById('mobileSearchInput'), results: document.getElementById('searchResultsMobile') }
  ].filter(x => x.el && x.results);

  if (!inputs.length) return;

  let ALL = [];
  let loading = false;
  const BASE = location.origin + '/';

  const getLang = () => localStorage.getItem('site_lang') || localStorage.getItem('preferredLanguage') || 'ไทย';
  const fmtTHB = v => new Intl.NumberFormat('th-TH',{style:'currency',currency:'THB',maximumFractionDigits:0}).format(v);
  const fmtUSD = v => new Intl.NumberFormat('en-US',{style:'currency',currency:'USD',maximumFractionDigits:2}).format(v);
  const priceText = (p)=>{
    if (typeof p === 'number' && !isNaN(p)){
      return (getLang()==='English') ? fmtUSD(p/EXCHANGE) : fmtTHB(p);
    }
    return (getLang()==='English') ? '$0.00' : '฿—';
  };

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

  async function ensureData(){
    if (ALL.length || loading) return;
    loading = true;
    try{
      const res = await fetch(API + '?nocache=' + Date.now(), { cache:'no-store' });
      const data = await res.json();

      // ✅ map field จาก API fluke → image/price
      ALL = (Array.isArray(data) ? data : []).map(x => ({
        name: x.name || '',
        category: x.category || '',
        image: x.pic || '', // ใช้ pic ของ API
        price: x.priceTHB ? Number(String(x.priceTHB).replace(/,/g,'')) : null,
        columnJ: x.columnJ || ''
      })).filter(x => x.name && (x.image || x.price));
    }catch(e){ console.warn('search fetch error', e); }
    loading = false;
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

  function renderDropdown(target, list, q){
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
      timer = setTimeout(async ()=>{
        if (q.trim().length < 3){ target.results.classList.add('hidden'); return; }
        await ensureData();
        const results = searchLocal(q);
        renderDropdown(target, results, q);
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
<?php /**PATH C:\xampp\htdocs\tool\resources\views/Product/Multimeters.blade.php ENDPATH**/ ?>