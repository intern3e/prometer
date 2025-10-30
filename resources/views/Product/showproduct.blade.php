<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FLUKE | Product</title>
  <link rel="icon" type="image/png" href="https://img5.pic.in.th/file/secure-sv1/ChatGPT_Image_18_.._2568_12_03_57-removebg-preview.png">
  <!-- (ถ้าใช้ Swiper ให้ include ไว้ที่ layout หลักตามเดิม) -->
</head>
<body>
  {{-- Header --}}
  @include('test.header-nav')

  {{-- Content --}}
  <main>
    @yield('content')
  </main>
  <br>

  <!-- ปิด search bar อัตโนมัติถ้าเปิดเมนู -->
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const menuBtn = document.querySelector('[data-drawer-toggle="#mobileMenu"]');
      const mobileSearch = document.getElementById("mobileSearch");
      const mobileMenu = document.getElementById("mobileMenu");

      if (menuBtn && mobileSearch && mobileMenu) {
        menuBtn.addEventListener("click", () => {
          mobileSearch.classList.add("hidden");
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
        <li><a href="{{ route('product.category', ['slug' => 'Multimeters']) }}" class="px-3 py-2" data-i18n="left_c2">มัลติมิเตอร์</a></li>
        <li><a href="{{ route('product.category', ['slug' => 'ElectricalTesters']) }}" class="px-3 py-2" data-i18n="left_c3">เครื่องตรวจไฟ/ทดสอบไฟฟ้า</a></li>
        <li><a href="{{ route('product.category', ['slug' => 'Thermography']) }}" class="px-3 py-2" data-i18n="left_c4">กล้องถ่ายภาพความร้อน</a></li>
        <li><a href="{{ route('product.category', ['slug' => 'InsulationTesters']) }}" class="px-3 py-2" data-i18n="left_c5">เครื่องวัดฉนวน</a></li>
        <li><a href="{{ route('product.category', ['slug' => 'PowerQuality']) }}" class="px-3 py-2" data-i18n="left_c6">คุณภาพไฟฟ้า</a></li>
        <li><a href="{{ route('product.category', ['slug' => 'LoopCalibrators']) }}" class="px-3 py-2" data-i18n="left_c7">เครื่องสอบเทียบ</a></li>
        <li><a href="{{ route('product.category', ['slug' => 'Accessories']) }}" class="px-3 py-2" data-i18n="left_c8">อุปกรณ์เสริม</a></li>
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

  <!-- ===== ส่วนหัว + ตัวเลือกเรียงสินค้า ===== -->
  <section class="container-outer mx-auto section-pad mt-6">
    <div class="flex items-center justify-between mb-3">
      <h3 class="text-lg md:text-xl font-bold">
        {{ $mode === 'grouped' ? ($groupLabelTh ?? 'หมวดหมู่') : 'สินค้าทั้งหมด' }}
      </h3>
      <select id="clampSort" class="border rounded-md text-sm px-2 py-1">
        <option value="price_desc" data-i18n="sort_price_desc">ราคาสูง → ต่ำ</option>
        <option value="price_asc"  data-i18n="sort_price_asc">ราคาต่ำ → สูง</option>
        <option value="name_asc"   data-i18n="sort_name_asc">A → Z</option>
        <option value="name_desc"  data-i18n="sort_name_desc">Z → A</option>
      </select>
    </div>

    @if ($mode === 'grouped')

      {{-- รวมไอเทมจากทุก bucket + others ให้เป็นลิสต์เดียว --}}
      @php
        $flat = [];
        foreach ($targets as $bucket) {
          if (!empty($grouped[$bucket])) {
            foreach ($grouped[$bucket] as $p) {
              $flat[] = $p;
            }
          }
        }
        if (!empty($others)) {
          foreach ($others as $p) {
            $flat[] = $p;
          }
        }
      @endphp

      {{-- แสดงเป็นกริดเดียว แถวละ 5 ช่อง --}}
      <div id="productGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
        @forelse ($flat as $p)
          @php
            $img = $p->pic;
            $src = \Illuminate\Support\Str::startsWith($img, ['http://','https://'])
                    ? $img
                    : ($img ? asset($img) : asset('images/placeholder.png'));
            // Fallback label กัน FOUC
            $valStr = is_string($p->webpriceTHB) ? preg_replace('/[^\d.]/','',$p->webpriceTHB) : $p->webpriceTHB;
            $valNum = (is_numeric($valStr) ? (float)$valStr : null);
            $fallback = ($valNum !== null && $valNum > 0) ? '฿'.number_format($valNum, 0) : 'ขอใบเสนอราคา';
          @endphp

          <a class="block hover:shadow transition-fast"
             href="{{ route('product.detail', $p->iditem) }}"
             data-name="{{ \Illuminate\Support\Str::lower($p->name) }}">
            <div class="border rounded-lg overflow-hidden bg-white">
              <div class="aspect-square bg-gray-50">
                <img class="block w-full h-full object-cover object-center"
                     src="{{ $src }}" alt="{{ $p->name }}"
                     loading="lazy" decoding="async">
              </div>
            </div>
            <div class="p-2">
              <p class="text-xs text-gray-700 line-clamp-2">{{ $p->name }}</p>
              <p class="text-[var(--brand)] font-semibold mt-1 price-i18n"
                 data-price-thb="{{ $p->webpriceTHB }}">{{ $fallback }}</p>
            </div>
          </a>
        @empty
          <div class="col-span-full text-center text-sm text-gray-600 py-6">ไม่พบสินค้า</div>
        @endforelse
      </div>

    @else
      {{-- โหมดทั้งหมด --}}
      @php $list = $items ?? collect(); @endphp
      <div id="productGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
        @forelse ($list as $p)
          @php
            $img = $p->pic;
            $src = \Illuminate\Support\Str::startsWith($img, ['http://','https://'])
                    ? $img
                    : ($img ? asset($img) : asset('images/placeholder.png'));
            // Fallback label กัน FOUC
            $valStr = is_string($p->webpriceTHB) ? preg_replace('/[^\d.]/','',$p->webpriceTHB) : $p->webpriceTHB;
            $valNum = (is_numeric($valStr) ? (float)$valStr : null);
            $fallback = ($valNum !== null && $valNum > 0) ? '฿'.number_format($valNum, 0) : 'ขอใบเสนอราคา';
          @endphp

          <a class="block hover:shadow transition-fast"
             href="{{ route('product.detail', $p->iditem) }}"
             data-name="{{ \Illuminate\Support\Str::lower($p->name) }}">
            <div class="border rounded-lg overflow-hidden bg-white">
              <div class="aspect-square bg-gray-50">
                <img class="block w-full h-full object-cover object-center"
                     src="{{ $src }}" alt="{{ $p->name }}"
                     loading="lazy" decoding="async">
              </div>
            </div>
            <div class="p-2">
              <p class="text-xs text-gray-700 line-clamp-2">{{ $p->name }}</p>
              <p class="text-[var(--brand)] font-semibold mt-1 price-i18n"
                 data-price-thb="{{ $p->webpriceTHB }}">{{ $fallback }}</p>
            </div>
          </a>
        @empty
          <div class="col-span-full text-center text-sm text-gray-600 py-6">ไม่พบสินค้า</div>
        @endforelse
      </div>
    @endif

    {{-- ===== Pagination ===== --}}
    @if ($items->hasPages())
      @php
        $current = $items->currentPage();
        $last    = $items->lastPage();

        // ปุ่มสไตล์ (ปรับสีหลักได้ที่ var(--brand))
        $chip       = 'h-10 min-w-10 px-3 rounded-full text-sm font-medium flex items-center justify-center border bg-white hover:bg-gray-50 active:scale-95 touch-manipulation';
        $chipActive = 'h-10 min-w-10 px-3 rounded-full text-sm font-semibold flex items-center justify-center border border-transparent bg-[var(--brand,#2563eb)] text-white';
      @endphp

      {{-- Desktop (≥ md): บล็อกละ 5 หน้า + … + First/Prev/Next/Last --}}
      @php
        $blockSize = 5;
        $block  = (int) ceil($current / $blockSize);
        $start  = ($block - 1) * $blockSize + 1;
        $end    = min($start + $blockSize - 1, $last);
      @endphp
      <nav class="hidden md:flex justify-center mt-6">
        <ul class="inline-flex items-center gap-1 text-sm">
          {{-- First / Prev --}}
          @if (!$items->onFirstPage())
            <li><a class="{{ $chip }}" href="{{ $items->url(1) }}" aria-label="First">«</a></li>
            <li><a class="{{ $chip }}" href="{{ $items->previousPageUrl() }}" aria-label="Previous">‹</a></li>
          @endif

          {{-- ซ้าย: 1 + … ถ้าไม่ได้เริ่มที่ 1 --}}
          @if ($start > 1)
            <li><a class="{{ $chip }}" href="{{ $items->url(1) }}">1</a></li>
            @if ($start > 2)
              <li><span class="px-2">…</span></li>
            @endif
          @endif

          {{-- หมายเลขในบล็อกปัจจุบัน --}}
          @for ($i = $start; $i <= $end; $i++)
            <li>
              @if ($i == $current)
                <span class="{{ $chipActive }}">{{ $i }}</span>
              @else
                <a class="{{ $chip }}" href="{{ $items->url($i) }}">{{ $i }}</a>
              @endif
            </li>
          @endfor

          {{-- ขวา: … + last --}}
          @if ($end < $last)
            @if ($end < $last - 1)
              <li><span class="px-2">…</span></li>
            @endif
            <li><a class="{{ $chip }}" href="{{ $items->url($last) }}">{{ $last }}</a></li>
          @endif

          {{-- Next / Last --}}
          @if ($items->hasMorePages())
            <li><a class="{{ $chip }}" href="{{ $items->nextPageUrl() }}" aria-label="Next">›</a></li>
            <li><a class="{{ $chip }}" href="{{ $items->url($last) }}" aria-label="Last">»</a></li>
          @endif
        </ul>
      </nav>

      {{-- Mobile (< md): ล็อคเลย์เอาต์ 5 ช่อง (‹ + 3 เลข + ›) --}}
      @php
        $window = 3;
        $half   = 1;
        $mStart = max(1, min($current - $half, max(1, $last - ($window - 1))));
        $mEnd   = min($last, $mStart + ($window - 1));
      @endphp
      <nav class="md:hidden mt-6">
        <div class="mx-auto w-full max-w-[360px] px-3">
          <ul class="grid grid-cols-5 items-center gap-1 p-1 rounded-full border bg-white shadow-sm select-none">

            {{-- Prev --}}
            <li>
              @if (!$items->onFirstPage())
                <a class="{{ $chip }}" href="{{ $items->previousPageUrl() }}" aria-label="Previous">‹</a>
              @else
                <span class="{{ $chip }} opacity-40 pointer-events-none cursor-default">‹</span>
              @endif
            </li>

            {{-- 3 ปุ่มตัวเลข --}}
            @for ($i = $mStart; $i <= $mEnd; $i++)
              <li>
                @if ($i == $current)
                  <span class="{{ $chipActive }}">{{ $i }}</span>
                @else
                  <a class="{{ $chip }}" href="{{ $items->url($i) }}">{{ $i }}</a>
                @endif
              </li>
            @endfor

            {{-- Next --}}
            <li>
              @if ($items->hasMorePages())
                <a class="{{ $chip }}" href="{{ $items->nextPageUrl() }}" aria-label="Next">›</a>
              @else
                <span class="{{ $chip }} opacity-40 pointer-events-none cursor-default">›</span>
              @endif
            </li>

          </ul>
        </div>
      </nav>
    @endif

  </section>

  {{-- footer --}}
  @include('test.footer')

  <!-- ===== Scripts: Swiper + I18N ===== -->
  <script>
    // Swiper init (ถ้าระบุไว้ใน layout)
    document.addEventListener('DOMContentLoaded', function(){
      if (document.querySelector('.mySwiper') && window.Swiper) {
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
        copyright:'© 2024 FLUKE. สงวนลิขสิทธิ์ทั้งหมด',
        clamp_title:'แคลมป์มิเตอร์',
        sort_price_desc:'ราคาสูง → ต่ำ',
        sort_price_asc:'ราคาต่ำ → สูง',
        sort_name_asc:'A → Z',
        sort_name_desc:'Z → A',
        top_user:'ผู้ใช้',top_logout:'ออกจากระบบ',
        clamp_empty:'ไม่พบสินค้าที่ค้นหา',label_profile:'โปรไฟล์'
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
        clamp_title:'Clamp Meter',
        sort_price_desc:'Price High → Low',
        sort_price_asc:'Price Low → High',
        sort_name_asc:'A → Z',
        sort_name_desc:'Z → A',
        top_user:'user',top_logout:'Sign out',
        clamp_empty:'No Clamp Meter products found',label_profile:'profile'
      }
    };

    // ===== I18N ENGINE =====
    function applyI18n(lang){
      const dict = I18N[lang] || I18N['ไทย'];
      document.documentElement.lang = (lang === 'ไทย') ? 'th' : 'en';
      document.title = (lang === 'ไทย') ? 'FLUKE | แคลมป์มิเตอร์' : 'FLUKE | ClampMeter';

      document.querySelectorAll('[data-i18n]').forEach(el=>{
        const key = el.getAttribute('data-i18n');
        const val = dict[key];
        if (val == null) return;
        const attr = el.getAttribute('data-i18n-attr');
        if (attr){ el.setAttribute(attr, val); } else { el.textContent = val; }
      });

      const label = document.getElementById('currentLangLabel');
      if (label) label.textContent = (lang === 'ไทย') ? 'ไทย' : 'English';

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

<!-- ===== Currency helper (floor to 2 decimals) ===== -->
<script>
  window.Currency = (function(){
    const EXCHANGE = 38; // THB per USD
    const getLang = () =>
      localStorage.getItem('site_lang') ||
      localStorage.getItem('preferredLanguage') || 'ไทย';

    const fmtTHB = v =>
      new Intl.NumberFormat('th-TH', {
        style:'currency', currency:'THB',
        minimumFractionDigits:0, maximumFractionDigits:2
      }).format(v || 0);

    // ✅ ให้แสดง 2 ตำแหน่งเสมอ เช่น $84.50
    const fmtUSD = v =>
      new Intl.NumberFormat('en-US', {
        style:'currency', currency:'USD',
        minimumFractionDigits:2, maximumFractionDigits:2
      }).format(v || 0);

    // ✅ แก้: ปัดลงเป็นหน่วยเซนต์เสมอ (ไม่ปัดขึ้น)
    const toUSD = (thb) => {
      if (!Number.isFinite(thb)) return null;
      const satang = Math.round(thb * 100);         // สตางค์ (จำนวนเต็ม)
      const cents  = Math.floor(satang / EXCHANGE); // แปลงเป็นเซนต์แล้ว 'ปัดลง'
      return cents / 100;                            // กลับเป็นดอลลาร์
    };

    const parseTHB = (raw)=>{
      if (raw == null) return null;
      const s = String(raw).replace(/[^\d.]/g,'');
      if (!s) return null;
      const n = parseFloat(s);
      return Number.isFinite(n) ? n : null;
    };

    const format = (thb) => {
      const lang = getLang();
      if (lang === 'English'){
        const usd = toUSD(thb);
        return (usd != null) ? fmtUSD(usd) : 'Request a quote';
      }
      return (thb != null) ? fmtTHB(thb) : 'ขอใบเสนอราคา';
    };

    const label = (thb) => {
      const lang = getLang();
      if (!Number.isFinite(thb) || thb <= 0) {
        return (lang === 'English') ? 'Request a quote' : 'ขอใบเสนอราคา';
      }
      return format(thb);
    };

    return { EXCHANGE, getLang, fmtTHB, fmtUSD, toUSD, parseTHB, format, label };
  })();

  // ===== ผูกกับ .price-i18n =====
  (function(){
    function renderPriceEl(el){
      const thb = Currency.parseTHB(el.getAttribute('data-price-thb'));
      el.textContent = Currency.label(thb);
    }
    function refreshAll(){
      document.querySelectorAll('.price-i18n').forEach(renderPriceEl);
    }
    document.addEventListener('DOMContentLoaded', refreshAll);
    window.addEventListener('site_lang_changed', refreshAll);
  })();
</script>

<!-- ===== Sort (ทำงานจริง ไม่ต้องรีเฟรช) ===== -->
<script>
  (function(){
    const select = document.getElementById('clampSort');
    const grid   = document.getElementById('productGrid');
    if (!select || !grid) return;

    function readCard(card){
      const name = (card.getAttribute('data-name') || '').trim();
      const priceEl  = card.querySelector('.price-i18n');
      const priceRaw = priceEl ? priceEl.getAttribute('data-price-thb') : null;
      const priceNum = (window.Currency && typeof window.Currency.parseTHB === 'function')
        ? window.Currency.parseTHB(priceRaw)
        : (priceRaw ? parseFloat(String(priceRaw).replace(/[^\d.]/g,'')) : NaN);
      const price = Number.isFinite(priceNum) ? priceNum : null;
      return { el: card, name, price };
    }

    const collator = new Intl.Collator('th', { numeric: true, sensitivity: 'base' });

    function sortNow(mode){
      const cards = Array.from(grid.children).filter(n => n.tagName === 'A');
      const rows  = cards.map(readCard);

      rows.sort((a, b) => {
        switch (mode) {
          case 'price_desc': {
            const ap=a.price, bp=b.price;
            if (ap == null && bp == null) return collator.compare(a.name, b.name);
            if (ap == null) return 1;
            if (bp == null) return -1;
            return bp - ap;
          }
          case 'price_asc': {
            const ap=a.price, bp=b.price;
            if (ap == null && bp == null) return collator.compare(a.name, b.name);
            if (ap == null) return 1;
            if (bp == null) return -1;
            return ap - bp;
          }
          case 'name_desc':
            return collator.compare(b.name, a.name);
          case 'name_asc':
          default:
            return collator.compare(a.name, b.name);
        }
      });

      rows.forEach(row => grid.appendChild(row.el));
    }

    const saved = localStorage.getItem('clampSort') || select.value || 'price_desc';
    select.value = saved;
    sortNow(saved);

    select.addEventListener('change', () => {
      const mode = select.value;
      localStorage.setItem('clampSort', mode);
      sortNow(mode);
    });

    // สลับภาษาแล้วต้องการเรียงใหม่เฉพาะโหมด name_*
    window.addEventListener('site_lang_changed', () => {
      const mode = select.value;
      if (mode.startsWith('name_')) sortNow(mode);
    });
  })();
</script>

<!-- ===== Cart Badge Sync ===== -->
<script>
  (function(){
    const LS_KEY = 'cartV1';
    const load = () => { try { return JSON.parse(localStorage.getItem(LS_KEY) || '[]'); } catch { return []; } };
    const totalQty = () => load().reduce((s,it)=> s + (Number(it.qty)||1), 0);
    function updateCartBadge(){
      const badge = document.querySelector('a[aria-label="cart"] span');
      if(!badge) return;
      const n = totalQty();
      badge.textContent = String(n);
      badge.style.transform = 'scale(1.15)';
      setTimeout(()=> badge.style.transform = 'scale(1)', 130);
    }
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

    const openers = document.querySelectorAll('[data-drawer-toggle]');
    const closers = document.querySelectorAll('[data-drawer-close]');
    function openDrawer(sel) {
      const wrap = document.querySelector(sel);
      if (!wrap) return;
      const drawer = wrap.querySelector('aside');
      wrap.classList.remove('hidden');
      requestAnimationFrame(() => drawer.classList.remove('translate-x-full'));
      const closeBtn = wrap.querySelector('[data-drawer-close]');
      if (closeBtn) closeBtn.focus();
      function onEsc(e){ if (e.key === 'Escape') closeDrawer(sel, true); }
      wrap._escHandler = onEsc;
      document.addEventListener('keydown', onEsc);
    }
    function closeDrawer(sel, fromEsc=false) {
      const wrap = document.querySelector(sel);
      if (!wrap) return;
      const drawer = wrap.querySelector('aside');
      drawer.classList.add('translate-x-full');
      drawer.addEventListener('transitionend', function onEnd() {
        wrap.classList.add('hidden');
        drawer.removeEventListener('transitionend', onEnd);
      }, { once: true });
      if (wrap._escHandler) {
        document.removeEventListener('keydown', wrap._escHandler);
        wrap._escHandler = null;
      }
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
