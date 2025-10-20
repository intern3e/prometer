<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- CSRF -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Fonts & Icons -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Swiper -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

  <style>
  :root{
    --brand:#ff6a00;
    --ink:#111827;
    --card:#ffffff;
    --bg:#f3f4f6;
    --radius:16px;
  }

  /* ✅ เปิด pull-to-refresh ของเบราว์เซอร์ + ยอมให้ pan แนวตั้ง */
  html, body{
    height:100%;
    margin:0;
    overscroll-behavior-y:auto;
    touch-action:pan-y;
  }

  body{ font-family:'Prompt',sans-serif; background:var(--bg); color:var(--ink); }
  .container-outer{ max-width:1200px; margin:0 auto; }
  .section-pad{ padding-left:.75rem; padding-right:.75rem; }
  @media (min-width:768px){ .section-pad{ padding-left:1rem; padding-right:1rem; } }

  .lift{ transition:transform .2s ease, box-shadow .2s ease; }
  .lift:hover{ transform:translateY(-2px); box-shadow:0 6px 18px rgba(0,0,0,.08); }
  .transition-fast{ transition:all .2s ease; }
  .fade-in{ opacity:0; transform:translateY(6px); transition:all .18s ease; }
  .group:hover .fade-in{ opacity:1; transform:translateY(0); }
  .left-cat a{ display:block; border-radius:10px; padding:6px 8px; transition:background .2s ease,color .2s ease; }
  .left-cat li{ padding:2px 0; }
  .left-cat a:hover{ background:#fff5ef; color:var(--brand); }
  .card{
    background:var(--card);
    border:1px solid rgba(17,24,39,.08);
    border-radius:var(--radius);
    box-shadow:0 1px 2px rgba(0,0,0,.04);
    transition:box-shadow .2s ease, border-color .2s ease;
  }
  .card:hover{ box-shadow:0 4px 14px rgba(0,0,0,.07); }
  .btn-brand{ background:#facc15; color:#fff; border-radius:8px; padding:.5rem 1rem; font-weight:600; }
  .btn-brand:hover{ filter:brightness(0.95); }
  .promo-pro{
    display:grid; grid-template-columns:64px 1fr 28px; align-items:center;
    min-height:110px; padding:14px 16px; gap:16px; border-radius:var(--radius);
    border:1px solid rgba(17,24,39,.08); background:#fff; position:relative; overflow:hidden;
    box-shadow:0 1px 2px rgba(0,0,0,.04);
    transition:box-shadow .2s ease, transform .2s ease, border-color .2s ease;
  }
  .promo-pro:hover{ box-shadow:0 6px 18px rgba(0,0,0,.08); transform:translateY(-1px); border-color:rgba(17,24,39,.12); }
  .promo-icon{ width:56px; height:56px; border-radius:14px; display:flex; align-items:center; justify-content:center; }
  .promo-col{ display:grid; grid-template-rows:repeat(2,minmax(0,1fr)); height:100%; gap:16px; }
  .cat-card img{ width:100%; height:auto; object-fit:cover; object-position:center; display:block; }
  .cat-caption{ background:#fff; text-align:center; padding:.6rem 0; color:#374151; font-weight:600; }
  .lang-item{ cursor:pointer; }

  /* ปิด badge ปลอมที่ธีมบางตัวเติม "::after: '0'" */
  .nav-cart .bi-cart::after { content: none !important; }

  /* เอฟเฟกต์เด้งเบา ๆ ตอนจำนวนเปลี่ยน */
  @keyframes cartPop { 0% { transform: scale(1); } 30% { transform: scale(1.2); } 100% { transform: scale(1); } }
  #cartCountDb.cart-pop { animation: cartPop .25s ease-out; }
  </style>

  <style>
  @media (max-width: 767px){
    #mobileSearch .tt-menu,
    #mobileSearch .autocomplete-suggestions,
    #mobileSearch .awesomplete ul,
    #mobileSearch .ais-SearchBox-suggestions,
    #mobileSearch #searchResultsMobile{
      position: absolute;
      top: calc(100% + 8px);
      left: 0; right: 0;
      max-height: 65vh;
      overflow: auto;
      z-index: 90;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0,0,0,.12);
    }
  }
  </style>
</head>
<body>

<!-- ===== Top utility bar (one-line on mobile) ===== -->
<style>
  .utilbar{ font-size:12px; }
  @media (min-width:768px){ .utilbar{ font-size:13px; } }
  .inline-clip{
    display:inline-block; max-width:100%;
    white-space:nowrap; overflow:hidden; text-overflow:ellipsis;
    vertical-align:bottom;
  }
</style>

<header class="bg-gray-100 text-gray-700 border-b utilbar">
  <div class="container-outer mx-auto section-pad py-1.5 flex items-center justify-between gap-2 flex-nowrap min-w-0">
    <!-- ซ้าย -->
    <div class="flex items-center gap-3 whitespace-nowrap shrink-0">
      <a href="tel:+66660975697"
         class="hover:text-[var(--brand)]"
         data-i18n="[aria-label]top_buyer_central"
         aria-label="Buyer Central">
        <i class="bi bi-telephone"></i> 066-097-5697
      </a>

      <a id="lineBtn"
         href="line://ti/p/@543ubjtx"
         class="hover:text-[var(--brand)]"
         data-i18n="[aria-label]top_help"
         aria-label="Help (LINE @543ubjtx)">
         LINE
      </a>
      <noscript>
        <a href="https://line.me/R/ti/p/@543ubjtx">@543ubjtx</a>
      </noscript>
    </div>

    <!-- ขวา -->
    <div class="flex items-center gap-2 min-w-0 whitespace-nowrap flex-1 justify-end">
      <!-- ภาษา -->
      <div class="relative shrink-0">
        <button id="currentLangBtn" class="flex items-center gap-1 px-2 py-1 rounded border border-gray-200 hover:bg-orange-50">
          <span id="currentLangLabel" class="inline-clip" style="max-width:64px">ไทย</span>
          <i class="bi bi-chevron-down text-[10px]"></i>
        </button>
        <div id="langDropdown" class="absolute right-0 top-full mt-2 w-36 bg-white rounded shadow hidden z-50">
          <div class="px-3 py-2 text-xs text-gray-500" data-i18n="top_choose_lang">เลือกภาษา</div>
          <div class="border-t">
            <div class="lang-item px-4 py-2 hover:bg-orange-50" data-lang="ไทย">ไทย</div>
            <div class="lang-item px-4 py-2 hover:bg-orange-50" data-lang="English">English</div>
          </div>
        </div>
      </div>

@php
  use Illuminate\Support\Facades\Route;

  $email    = session('customer_email');
  $username = session('customer_name');

  $profileUrl = Route::has('profile')
    ? route('profile')
    : (Route::has('profile.show') ? route('profile.show') : url('/profile'));
@endphp

@if (!$email)
      <a href="{{ route('login') }}" class="hover:text-[var(--brand)] shrink-0" data-i18n="top_login">เข้าสู่ระบบ</a>
      <a href="{{ route('Sign_up') }}" class="hover:text-[var(--brand)] shrink-0" data-i18n="top_join_free">สมัครสมาชิกฟรี</a>
@else
      <!-- Desktop -->
      <div class="hidden md:flex items-center gap-2 min-w-0 whitespace-nowrap">
        <span class="text-sm text-gray-700 truncate max-w-[360px] inline-clip" style="max-width:360px">
          <span data-i18n="top_user">ผู้ใช้</span>:
          <span class="font-medium text-gray-900 inline-clip" style="max-width:180px">{{ $username }}</span>
          <span class="text-xs text-gray-500 ml-1" title="{{ $email }}">
            ({{ \Illuminate\Support\Str::limit($email, 25, '…') }})
          </span>
        </span>

        <a href="{{ $profileUrl }}"
           class="px-3 py-1.5 rounded-lg border border-gray-200 hover:bg-orange-50 text-gray-700 inline-flex items-center gap-2 shrink-0"
           data-i18n="top_profile">
          <i class="bi bi-person-gear" data-i18n="icon_profile"></i>
          <span data-i18n="label_profile">โปรไฟล์</span>
        </a>

        <form method="POST" action="{{ route('logout') }}" class="shrink-0">
          @csrf
          <button type="submit"
                  class="px-3 py-1.5 rounded-lg border border-gray-200 hover:bg-orange-50 text-gray-700">
            <span data-i18n="top_logout">ออกจากระบบ</span>
          </button>
        </form>
      </div>

      <!-- Mobile (ชิปเดียว) -->
      <div class="relative md:hidden min-w-0">
        <button id="userMenuBtn"
                class="flex items-center gap-1.5 px-2 py-1 rounded-lg border hover:bg-gray-50 text-gray-700 min-w-0"
                aria-haspopup="true" aria-expanded="false" aria-controls="userMenuDropdown">
          <i class="bi bi-person-circle text-sm shrink-0"></i>
          <span class="text-[12px] inline-clip" style="max-width:110px">
            {{ \Illuminate\Support\Str::limit($username, 18, '…') }}
          </span>
          <i class="bi bi-caret-down-fill text-[9px] shrink-0"></i>
          <span class="sr-only">({{ $email }})</span>
        </button>

        <div id="userMenuDropdown"
             class="hidden absolute right-0 mt-2 w-56 bg-white border rounded-lg shadow-lg z-50">
          <div class="px-3 py-2 text-xs text-gray-500 break-all">
            <span data-i18n="top_user">ผู้ใช้</span>:
            <span class="font-medium text-gray-800">{{ $username }}</span>
          </div>
          <div class="px-3 pb-2 text-[11px] text-gray-500 break-all">
            {{ $email }}
          </div>

          <div class="border-t"></div>

          <a href="{{ $profileUrl }}"
             class="block w-full px-4 py-2 text-sm hover:bg-orange-50 flex items-center gap-2"
             data-i18n="top_profile">
            <i class="bi bi-person-gear"></i>
            <span data-i18n="label_profile">โปรไฟล์</span>
          </a>

          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="w-full text-left px-4 py-2 text-sm hover:bg-orange-50 flex items-center gap-2">
              <i class="bi bi-box-arrow-right"></i>
              <span data-i18n="top_logout">ออกจากระบบ</span>
            </button>
          </form>
        </div>
      </div>
@endif
    </div>
  </div>
</header>

<!-- User menu dropdown -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    // LINE deep link → เว็บ fallback
    (function () {
      const deep = 'line://ti/p/@543ubjtx';
      const web  = 'https://line.me/R/ti/p/@543ubjtx';
      const btn = document.getElementById('lineBtn');
      if (!btn) return;
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        const start = Date.now();
        window.location.href = deep;
        setTimeout(function () {
          if (Date.now() - start < 1500) window.location.href = web;
        }, 1200);
      }, { passive: false });
    })();

    // User dropdown
    const btn = document.getElementById('userMenuBtn');
    const dd  = document.getElementById('userMenuDropdown');
    if (btn && dd){
      btn.addEventListener('click', (e) => {
        e.stopPropagation();
        dd.classList.toggle('hidden');
        btn.setAttribute('aria-expanded', dd.classList.contains('hidden') ? 'false' : 'true');
      });
      document.addEventListener('click', (e) => {
        if (!dd.contains(e.target) && !btn.contains(e.target)) {
          dd.classList.add('hidden');
          btn.setAttribute('aria-expanded', 'false');
        }
      });
    }

    // Language dropdown + persist
    (function(){
      const btn = document.getElementById('currentLangBtn');
      const dd  = document.getElementById('langDropdown');
      const label = document.getElementById('currentLangLabel');
      const key = 'site_lang';
      const emit = () => window.dispatchEvent(new CustomEvent('site_lang_changed'));
      function setLang(lang){
        localStorage.setItem(key, lang);
        if (label) label.textContent = lang;
        dd?.classList.add('hidden');
        emit();
      }
      // init
      const saved = localStorage.getItem(key);
      if (saved && label) label.textContent = saved;
      btn?.addEventListener('click', (e)=>{ e.stopPropagation(); dd?.classList.toggle('hidden'); });
      document.addEventListener('click', ()=> dd?.classList.add('hidden'));
      dd?.querySelectorAll('.lang-item').forEach(x => {
        x.addEventListener('click', ()=> setLang(x.dataset.lang));
      });
    })();
  });
</script>

<nav class="bg-white border-b sticky top-0 z-[40]" role="navigation" aria-label="Primary">
  <div class="container-outer mx-auto section-pad py-3 md:py-4 flex items-center gap-2 md:gap-6">

    <!-- Mobile: hamburger -->
    <button class="md:hidden p-2 rounded-lg border text-gray-700"
            aria-label="Open menu" aria-controls="mobileMenu" aria-expanded="false"
            data-drawer-toggle="#mobileMenu">
      <i class="bi bi-list text-xl"></i>
    </button>

    <!-- Brand -->
    <a href="/" class="flex items-center gap-2 min-w-0">
      <img src="https://img2.pic.in.th/pic/image032196d0b157d229.png"
           alt="FLUKE" class="h-8 md:h-10 w-auto" data-i18n="brand_name">
    </a>

    <!-- Desktop: All Categories (mega menu) -->
    <div class="hidden md:block">
      <div class="relative" aria-haspopup="true">
        <button id="toggleMegaMenu"
                class="px-4 py-2 border rounded-lg text-sm font-medium flex items-center gap-2
                       hover:border-[var(--brand)] hover:bg-gray-50
                       focus:outline-none focus:ring-2 focus:ring-[var(--brand)] transition"
                aria-expanded="false">
          <i class="bi bi-list text-lg" aria-hidden="true"></i>
          <span data-i18n="nav_all_categories">หมวดหมู่ทั้งหมด</span>
        </button>

        <div id="megaMenu"
             class="hidden absolute mt-3 w-[760px] bg-white shadow-2xl rounded-xl p-6 grid grid-cols-3 gap-6 z-50"
             role="menu">
          <!-- Column 1 -->
          <div>
            <h4 class="text-gray-900 font-semibold mb-3 text-base border-b pb-1" data-i18n="mega_measure">เครื่องมือวัด</h4>
            <ul class="space-y-2 text-sm">
              <li><a href="{{ route('product.category', ['slug' => 'ClampMeter1']) }}" class="block hover:text-[var(--brand)] hover:pl-1 transition" data-i18n="cat_left_1">แคลมป์มิเตอร์</a></li>
              <li><a href="{{ route('product.category', ['slug' => 'Multimeters']) }}" class="block hover:text-[var(--brand)] hover:pl-1 transition" data-i18n="cat_left_2">มัลติมิเตอร์</a></li>
              <li><a href="{{ route('product.category', ['slug' => 'ElectricalTesters']) }}" class="block hover:text-[var(--brand)] hover:pl-1 transition" data-i18n="cat_left_3">เครื่องทดสอบไฟฟ้า</a></li>
              <li><a href="{{ route('product.category', ['slug' => 'InsulationTesters']) }}" class="block hover:text-[var(--brand)] hover:pl-1 transition" data-i18n="cat_left_4">เครื่องวัดฉนวน</a></li>
              <li><a href="{{ route('product.category', ['slug' => 'Thermography']) }}" class="block hover:text-[var(--brand)] hover:pl-1 transition" data-i18n="cat_left_5">กล้องถ่ายภาพความร้อน</a></li>
            </ul>
          </div>

          <!-- Column 2 -->
          <div>
            <h4 class="text-gray-900 font-semibold mb-3 text-base border-b pb-1" data-i18n="mega_process">กระบวนการ/สอบเทียบ</h4>
            <ul class="space-y-2 text-sm">
              <li><a href="{{ route('product.category', ['slug' => 'LoopCalibrators']) }}" class="block hover:text-[var(--brand)] hover:pl-1 transition" data-i18n="cat_left_p1">เครื่องสอบเทียบลูป</a></li>
              <li><a href="{{ route('product.category', ['slug' => 'CalibrationTools']) }}" class="block hover:text-[var(--brand)] hover:pl-1 transition" data-i18n="cat_left_p2">เครื่องสอบเทียบความดัน</a></li>
              <li><a href="{{ route('product.category', ['slug' => 'Temperature']) }}" class="block hover:text-[var(--brand)] hover:pl-1 transition" data-i18n="cat_left_p3">เครื่องสอบเทียบอุณหภูมิ</a></li>
              <li><a href="{{ route('product.category', ['slug' => 'ProcessCalibrators']) }}" class="block hover:text-[var(--brand)] hover:pl-1 transition" data-i18n="cat_left_p4">เครื่องสอบเทียบกระบวนการ</a></li>
            </ul>
          </div>

          <!-- Column 3 -->
          <div>
            <h4 class="text-gray-900 font-semibold mb-3 text-base border-b pb-1" data-i18n="mega_accessories">อุปกรณ์เสริม</h4>
            <ul class="space-y-2 text-sm">
              <li><a href="{{ route('product.category', ['slug' => 'TestLeadsProbes']) }}" class="block hover:text-[var(--brand)] hover:pl-1 transition" data-i18n="cat_left_a1">สายวัดและโพรบ</a></li>
              <li><a href="{{ route('product.category', ['slug' => 'BatteriesChargers']) }}" class="block hover:text-[var(--brand)] hover:pl-1 transition" data-i18n="cat_left_a2">แบตเตอรี่และชาร์จ</a></li>
              <li><a href="{{ route('product.category', ['slug' => 'ToolCases']) }}" class="block hover:text-[var(--brand)] hover:pl-1 transition" data-i18n="cat_left_a3">กล่องเก็บเครื่องมือ</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <script>
      // Desktop mega menu
      const toggleBtn = document.getElementById('toggleMegaMenu');
      const megaMenu = document.getElementById('megaMenu');
      if (toggleBtn && megaMenu) {
        toggleBtn.addEventListener('click', (e) => {
          e.stopPropagation();
          megaMenu.classList.toggle('hidden');
          toggleBtn.setAttribute('aria-expanded', megaMenu.classList.contains('hidden') ? 'false' : 'true');
        });
        document.addEventListener('click', (e) => {
          if (!megaMenu.contains(e.target) && !toggleBtn.contains(e.target)) {
            megaMenu.classList.add('hidden');
            toggleBtn.setAttribute('aria-expanded', 'false');
          }
        });
      }
    </script>

    <!-- Desktop: Search -->
    <div class="hidden md:flex flex-1">
      <label for="globalSearch" class="sr-only">Search</label>
      <div class="relative w-full">
        <div class="flex border rounded-md bg-white w-full focus-within:ring-2 focus-within:ring-[var(--brand)]">
          <input id="globalSearch" type="text" class="flex-1 px-3 py-2 outline-none"
                 data-i18n="search_placeholder" data-i18n-attr="placeholder"
                 placeholder="คุณต้องการให้เราช่วยค้นหาอะไร" />
          <button class="px-3" aria-label="Submit search">
            <i class="bi bi-search text-lg"></i>
          </button>
        </div>
        <div id="searchResultsDesktop"
             class="absolute left-0 right-0 top-[calc(100%+8px)] hidden bg-white rounded-xl shadow-xl z-[60]"></div>
      </div>
    </div>

    <!-- Mobile: Search icon -->
    <button class="md:hidden p-2 rounded-lg border text-gray-700 ml-auto"
            aria-controls="mobileSearch" aria-expanded="false" aria-label="Open search"
            data-collapse-toggle="#mobileSearch">
      <i class="bi bi-search text-lg"></i>
    </button>

<!-- Cart (robust: Auth + session + fallback + guard) -->
@php
  use Illuminate\Support\Facades\Auth;
  use Illuminate\Support\Facades\DB;
  use Illuminate\Support\Facades\Schema;

  $cartCount = 0;

  $uid = Auth::id() ?? session('idcustomer');
  if (!$uid && ($name = session('customer_name'))) {
      try {
          $uid = DB::table('custdetail')
              ->where('username', $name)
              ->orWhere('idcustomer', $name)
              ->value('idcustomer');
          if ($uid) session(['idcustomer' => $uid]);
      } catch (\Throwable $e) { /* เงียบ */ }
  }

  try {
      if ($uid) {
          $tbl = Schema::hasTable('cart') ? 'cart' : (Schema::hasTable('carts') ? 'carts' : null);
          if ($tbl) {
              if (Schema::hasColumn($tbl, 'quantity')) {
                  $cartCount = (int) DB::table($tbl)->where('idcustomer', $uid)->sum('quantity');
              } else {
                  $cartCount = (int) DB::table($tbl)->where('idcustomer', $uid)->count();
              }
          }
      }
  } catch (\Throwable $e) { /* เงียบ */ }

  if ($cartCount === 0) {
      $sessionCart = session('cart', []);
      if (is_array($sessionCart)) {
          foreach ($sessionCart as $item) $cartCount += (int)($item['quantity'] ?? 1);
      }
  }
@endphp

    <a href="{{ url('cart') }}" class="nav-cart relative text-gray-700 hover:text-[var(--brand,#ff6a00)] ml-1" aria-label="cart">
      <i class="bi bi-cart text-2xl"></i>
      <span
        id="cartCountDb"
        data-cart-badge
        data-count="{{ $cartCount }}"
        aria-live="polite" aria-atomic="true"
        class="absolute -top-2 -right-2 bg-[var(--brand,#ff6a00)] text-white text-xs rounded-full min-w-5 h-5 px-1 flex items-center justify-center"
        style="z-index:60">{{ $cartCount }}</span>
    </a>

  </div>

  <!-- Mobile: Search bar -->
  <div id="mobileSearch" class="md:hidden hidden border-t relative z-[80]">
    <div class="container-outer mx-auto section-pad py-3">
      <label for="mobileSearchInput" class="sr-only">Search</label>
      <div class="relative w-full">
        <div class="flex border rounded-md bg-white w-full focus-within:ring-2 focus-within:ring-[var(--brand)]">
          <input id="mobileSearchInput" type="text" class="flex-1 px-3 py-2 outline-none"
                 data-i18n="search_placeholder" data-i18n-attr="placeholder"
                 placeholder="คุณต้องการให้เราช่วยค้นหาอะไร" />
          <button class="px-3" aria-label="Submit search">
            <i class="bi bi-search text-lg"></i>
          </button>
        </div>
        <div id="searchResultsMobile"
             class="absolute left-0 right-0 top-[calc(100%+8px)] hidden bg-white rounded-xl shadow-xl z-[90]"></div>
      </div>
    </div>
  </div>

  <!-- Mobile: Off-canvas categories -->
  <div id="mobileMenu" class="md:hidden fixed inset-0 z-[100] hidden" aria-hidden="true">
    <div class="absolute inset-0 bg-black/40" data-drawer-close="#mobileMenu" aria-hidden="true"></div>
    <aside class="absolute right-0 top-0 h-full w-11/12 max-w-sm bg-white shadow-xl translate-x-full transition-transform"
           role="dialog" aria-modal="true" aria-label="Categories">
      <div class="flex items-center justify-between p-4 border-b">
        <div class="flex items-center gap-2">
          <i class="bi bi-list"></i>
          <span class="font-semibold" data-i18n="nav_all_categories">หมวดหมู่ทั้งหมด</span>
        </div>
        <button class="p-2 rounded-lg hover:bg-gray-100" aria-label="Close menu" data-drawer-close="#mobileMenu">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>

      {{-- ===== Search (DB) ===== --}}
      <script>
      (function(){
        const SEARCH_URL = "{{ route('search.products') }}";
        const EXCHANGE   = 38; // THB per USD

        const targets = [
          { input: document.getElementById('globalSearch'),       results: document.getElementById('searchResultsDesktop') },
          { input: document.getElementById('mobileSearchInput'),  results: document.getElementById('searchResultsMobile')  }
        ].filter(x => x.input && x.results);

        if (!targets.length) return;

        const getLang = () =>
          localStorage.getItem('site_lang') ||
          localStorage.getItem('preferredLanguage') || 'ไทย';

        const fmtTHB = v =>
          new Intl.NumberFormat('th-TH', { style:'currency', currency:'THB', maximumFractionDigits:0 }).format(v);

        const fmtUSD = v =>
          new Intl.NumberFormat('en-US', { style:'currency', currency:'USD', minimumFractionDigits:2, maximumFractionDigits:2 }).format(v);

        const toUSD = (thb) => {
          if (!Number.isFinite(thb)) return null;
          const satang = Math.round(thb * 100);
          const cents  = Math.floor(satang / EXCHANGE);
          return cents / 100;
        };

        function toNum(v){
          if (v === null || v === undefined) return null;
          if (typeof v === 'number') return Number.isFinite(v) ? v : null;
          const s = String(v).trim();
          if (!s) return null;
          const n = parseFloat(s.replace(/[^\d.-]/g, ''));
          return Number.isFinite(n) ? n : null;
        }

        function priceTextOrQuote(p){
          const lang = getLang();
          const quote = (lang === 'English') ? 'Request a quote' : 'ขอใบเสนอราคา';
          const n = toNum(p);
          if (n === null || n <= 0) return quote;
          return (lang === 'English') ? fmtUSD(toUSD(n)) : fmtTHB(n);
        }

        function closeDD(dd){ dd.classList.add('hidden'); dd.innerHTML=''; }
        function openDD(dd){ dd.classList.remove('hidden'); }

        function render(dd, items){
          dd.innerHTML = '';
          if (!items.length){
            dd.innerHTML = `<div class="px-3 py-2 text-sm text-gray-500">ไม่พบผลลัพธ์</div>`;
            openDD(dd); return;
          }
          items.forEach(it => {
            const name  = (it.name || '').trim() || '—';
            const cat   = (it.cat  || '').trim();
            const img   = it.pic   || '';
            const price = priceTextOrQuote(it.price);

            const row = document.createElement('a');
            row.href  = it.url;
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
          openDD(dd);
        }

        async function fetchDB(q){
          const url = new URL(SEARCH_URL, window.location.origin);
          url.searchParams.set('q', q);
          const res = await fetch(url.toString(), { headers: { 'Accept': 'application/json' } });
          if (!res.ok) return [];
          const data = await res.json();
          return Array.isArray(data) ? data : [];
        }

        targets.forEach(({input, results})=>{
          let timer=null, last='';
          input.addEventListener('input', ()=>{
            const q = input.value.trim();
            last = q;
            clearTimeout(timer);

            if (q.length < 3){ closeDD(results); return; }

            timer = setTimeout(async ()=>{
              try{
                const items = await fetchDB(q);
                render(results, items);
              }catch(e){
                console.warn('search error:', e);
                closeDD(results);
              }
            }, 220);
          });

          document.addEventListener('click', (e)=>{
            const hit = e.target.closest(`#${results.id}, #${input.id}`);
            if (!hit) closeDD(results);
          });

          window.addEventListener('site_lang_changed', async ()=>{
            if (!results.classList.contains('hidden') && last.length >= 3){
              const items = await fetchDB(last);
              render(results, items);
            }
          });
        });
      })();
      </script>

      <div class="p-2">
        <section class="border rounded-lg mb-2 overflow-hidden">
          <button class="w-full flex items-center justify-between px-4 py-3 text-left font-medium"
                  data-collapse-toggle="#mgrp1" aria-expanded="false">
            <span data-i18n="mega_measure">เครื่องมือวัด</span>
            <i class="bi bi-caret-down"></i>
          </button>
          <ul id="mgrp1" class="hidden px-4 pb-3 text-sm space-y-2">
            <li><a href="{{ route('product.category', ['slug' => 'ClampMeter1']) }}" class="block hover:text-[var(--brand)] hover:pl-1 transition" data-i18n="cat_left_1">แคลมป์มิเตอร์</a></li>
            <li><a href="{{ route('product.category', ['slug' => 'Multimeters']) }}" class="block hover:text-[var(--brand)] hover:pl-1 transition" data-i18n="cat_left_2">มัลติมิเตอร์</a></li>
            <li><a href="{{ route('product.category', ['slug' => 'ElectricalTesters']) }}" class="block hover:text-[var(--brand)] hover:pl-1 transition" data-i18n="cat_left_3">เครื่องทดสอบไฟฟ้า</a></li>
            <li><a href="{{ route('product.category', ['slug' => 'InsulationTesters']) }}" class="block hover:text-[var(--brand)] hover:pl-1 transition" data-i18n="cat_left_4">เครื่องวัดฉนวน</a></li>
            <li><a href="{{ route('product.category', ['slug' => 'Thermography']) }}" class="block hover:text-[var(--brand)] hover:pl-1 transition" data-i18n="cat_left_5">กล้องถ่ายภาพความร้อน</a></li>
          </ul>
        </section>

        <section class="border rounded-lg mb-2 overflow-hidden">
          <button class="w-full flex items-center justify-between px-4 py-3 text-left font-medium"
                  data-collapse-toggle="#mgrp2" aria-expanded="false">
            <span data-i18n="mega_process">กระบวนการ/สอบเทียบ</span>
            <i class="bi bi-caret-down"></i>
          </button>
          <ul id="mgrp2" class="hidden px-4 pb-3 text-sm space-y-2">
            <li><a href="{{ route('product.category', ['slug' => 'LoopCalibrators']) }}" class="block hover:text-[var(--brand)] hover:pl-1 transition" data-i18n="cat_left_p1">เครื่องสอบเทียบลูป</a></li>
            <li><a href="{{ route('product.category', ['slug' => 'CalibrationTools']) }}" class="block hover:text-[var(--brand)] hover:pl-1 transition" data-i18n="cat_left_p2">เครื่องสอบเทียบความดัน</a></li>
            <li><a href="{{ route('product.category', ['slug' => 'Temperature']) }}" class="block hover:text-[var(--brand)] hover:pl-1 transition" data-i18n="cat_left_p3">เครื่องสอบเทียบอุณหภูมิ</a></li>
            <li><a href="{{ route('product.category', ['slug' => 'ProcessCalibrators']) }}" class="block hover:text-[var(--brand)] hover:pl-1 transition" data-i18n="cat_left_p4">เครื่องสอบเทียบกระบวนการ</a></li>
          </ul>
        </section>

        <section class="border rounded-lg mb-2 overflow-hidden">
          <button class="w-full flex items-center justify-between px-4 py-3 text-left font-medium"
                  data-collapse-toggle="#mgrp3" aria-expanded="false">
            <span data-i18n="mega_accessories">อุปกรณ์เสริม</span>
            <i class="bi bi-caret-down"></i>
          </button>
          <ul id="mgrp3" class="hidden px-4 pb-3 text-sm space-y-2">
            <li><a href="{{ route('product.category', ['slug' => 'TestLeadsProbes']) }}" class="block hover:text-[var(--brand)] hover:pl-1 transition" data-i18n="cat_left_a1">สายวัดและโพรบ</a></li>
            <li><a href="{{ route('product.category', ['slug' => 'BatteriesChargers']) }}" class="block hover:text-[var(--brand)] hover:pl-1 transition" data-i18n="cat_left_a2">แบตเตอรี่และชาร์จ</a></li>
            <li><a href="{{ route('product.category', ['slug' => 'ToolCases']) }}" class="block hover:text-[var(--brand)] hover:pl-1 transition" data-i18n="cat_left_a3">กล่องเก็บเครื่องมือ</a></li>
          </ul>
        </section>
      </div>
    </aside>
  </div>
</nav>

<!-- ===== Core behaviors: Drawer / Collapse / Cart badge / PTR Fallback ===== -->
<script>
(function(){
  /* Drawer open/close */
  document.addEventListener('click', function(e){
    const opener = e.target.closest('[data-drawer-toggle]');
    if (opener){
      const sel = opener.getAttribute('data-drawer-toggle');
      const panel = document.querySelector(sel);
      if (!panel) return;
      panel.classList.remove('hidden');
      const aside = panel.querySelector('aside');
      aside && (aside.style.transform = 'translateX(0)');
      opener.setAttribute('aria-expanded', 'true');
    }
    const closer = e.target.closest('[data-drawer-close]');
    if (closer){
      const sel = closer.getAttribute('data-drawer-close');
      const panel = document.querySelector(sel);
      if (!panel) return;
      const aside = panel.querySelector('aside');
      if (aside) aside.style.transform = 'translateX(100%)';
      setTimeout(()=> panel.classList.add('hidden'), 180);
      const openerBtn = document.querySelector(`[data-drawer-toggle="${sel}"]`);
      openerBtn && openerBtn.setAttribute('aria-expanded','false');
    }
  });

  /* Collapse toggle (mobile search & accordions) */
  document.addEventListener('click', function(e){
    const btn = e.target.closest('[data-collapse-toggle]');
    if (!btn) return;
    const sel = btn.getAttribute('data-collapse-toggle');
    const el  = document.querySelector(sel);
    if (!el) return;
    const show = el.classList.contains('hidden');
    el.classList.toggle('hidden');
    btn.setAttribute('aria-expanded', show ? 'true' : 'false');
  });

  /* Cart badge utilities + auto-bind */
  (function(){
    const CART_MATCH = /(\/cart\/add|\/add-?to-?cart)/i;
    const BADGES = Array.from(document.querySelectorAll('[data-cart-badge], #cartCountDb'));
    if (!BADGES.length) return;

    const toInt = (v, d=0) => { const n = parseInt(v,10); return Number.isFinite(n) ? n : d; };
    const get = () =>
      BADGES.reduce((m, b) => Math.max(m, toInt(b.dataset.count ?? b.textContent ?? '0', 0)), 0);

    const setAll = (n, {pop=true} = {}) => {
      const v = String(Math.max(0, toInt(n, 0)));
      BADGES.forEach(b => {
        b.dataset.count = v;
        if (b.textContent !== v) {
          b.textContent = v;
          if (pop) { b.classList.remove('cart-pop'); void b.offsetWidth; b.classList.add('cart-pop'); }
        }
      });
      window.dispatchEvent(new CustomEvent('cart:count:changed', { detail: { count: toInt(v,0) } }));
    };

    window.setCartCount  = (n, opts={}) => setAll(n, opts);
    window.bumpCartCount = (delta=1) => setAll(Math.max(0, get() + toInt(delta,0)));
    window.cartAdded     = (qty=1) => window.bumpCartCount(qty);

    const findQtyNear = (btn) => {
      const scope = btn.closest('[data-product], [data-card], .product, .card, .item, form') || document;
      const qEl = btn.getAttribute('data-qty') ? null :
        scope.querySelector('[data-qty-input], input[name="quantity"], input.qty, .qty input');
      return toInt(btn.getAttribute('data-qty') ?? (qEl ? qEl.value : 1), 1);
    };

    const extractIdFrom = (el) => {
      const direct = el.getAttribute('data-iditem') ?? el.dataset.id ?? el.value ?? '';
      if (direct) return String(direct).trim();
      const scope = el.closest('[data-product], [data-card], .product, .card, .item, form') || document;
      const holder =
        scope.querySelector('[data-iditem], [data-product-id], [data-id]') ||
        scope.querySelector('input[name="iditem"], input[name="product_id"], input[name="id"]');
      if (holder) {
        const v = holder.getAttribute('data-iditem') ?? holder.getAttribute('data-product-id') ?? holder.getAttribute('data-id') ?? holder.value;
        if (v) return String(v).trim();
      }
      const a = el.closest('a[href]');
      if (a) {
        try {
          const u = new URL(a.href, location.origin);
          const q = u.searchParams.get('iditem') || u.searchParams.get('id');
          if (q) return String(q).trim();
        } catch {}
      }
      return '';
    };

    const extractApiFrom = (el) => {
      const api = el.getAttribute('data-api');
      if (api) return api;
      const a = el.closest('a[href]');
      if (a && CART_MATCH.test(a.getAttribute('href'))) return a.href;
      const form = el.closest('form[action]');
      if (form && CART_MATCH.test(form.getAttribute('action'))) return form.getAttribute('action');
      return null;
    };

    const extractMethodFrom = (el) => {
      const m = (el.getAttribute('data-method') || '').toUpperCase();
      if (m) return m;
      const form = el.closest('form');
      if (form && form.method) return form.method.toUpperCase();
      return 'POST';
    };

    document.addEventListener('click', async (e) => {
      const btn = e.target.closest('[data-add-to-cart], .add-to-cart, a[href*="/cart/add"], a[href*="add-to-cart"]');
      if (!btn) return;
      e.preventDefault();
      const id     = extractIdFrom(btn);
      const qty    = findQtyNear(btn);
      const api    = extractApiFrom(btn);
      const method = extractMethodFrom(btn);
      await window.cartAdd(id, qty, api ? { api, method } : {});
    }, true);

    document.addEventListener('submit', async (e) => {
      const form = e.target.closest('form');
      if (!form) return;
      const action = form.getAttribute('action') || '';
      const marked = form.matches('[data-add-to-cart-form]');
      if (!marked && !CART_MATCH.test(action)) return;
      e.preventDefault();
      const idInput = form.querySelector('input[name="iditem"], input[name="product_id"], input[name="id"]');
      const qtyInput= form.querySelector('[data-qty-input], input[name="quantity"], input.qty, .qty input');
      const id     = idInput?.value || '';
      const qty    = parseInt(qtyInput?.value ?? 1, 10) || 1;
      const api    = action || null;
      const method = (form.method || 'POST').toUpperCase();
      await window.cartAdd(id, qty, api ? { api, method } : {});
    }, true);

    if (!window.__cartFetchPatched) {
      window.__cartFetchPatched = true;
      const _fetch = window.fetch;
      window.fetch = async function(input, init={}) {
        const url = (typeof input === 'string') ? input : (input?.url || '');
        const method = (init?.method || (typeof input !== 'string' ? input.method : 'GET') || 'GET').toUpperCase();
        const isCartAdd = CART_MATCH.test(url);

        let guessedQty = 1;
        if (isCartAdd) {
          try {
            if (init && init.body && typeof init.body === 'string' && init.headers && /json/i.test(init.headers['Content-Type'] || init.headers['content-type'] || '')) {
              const j = JSON.parse(init.body); guessedQty = parseInt(j.quantity ?? j.qty ?? 1,10) || 1;
            }
          } catch {}
          window.cartAdded(guessedQty);
        }

        const res = await _fetch(input, init);
        if (isCartAdd) {
          try {
            const clone = res.clone();
            const type = clone.headers.get('content-type') || '';
            if (/application\/json/i.test(type)) {
              const data = await clone.json();
              if (typeof data?.count !== 'undefined') window.setCartCount(data.count);
            }
          } catch {}
        }
        return res;
      };
    }

    if (!window.__cartXHRPatched) {
      window.__cartXHRPatched = true;
      const _open = XMLHttpRequest.prototype.open;
      const _send = XMLHttpRequest.prototype.send;
      XMLHttpRequest.prototype.open = function(method, url, async, user, password) {
        this.__cart_isAdd = /(\/cart\/add|\/add-?to-?cart)/i.test(url || '');
        this.__cart_method = (method || 'GET').toUpperCase();
        return _open.apply(this, arguments);
      };
      XMLHttpRequest.prototype.send = function(body) {
        if (this.__cart_isAdd) {
          let guessedQty = 1;
          try {
            if (typeof body === 'string') {
              const j = JSON.parse(body);
              guessedQty = parseInt(j.quantity ?? j.qty ?? 1,10) || 1;
            }
          } catch {}
          window.cartAdded(guessedQty);
          this.addEventListener('load', () => {
            try {
              const type = this.getResponseHeader('content-type') || '';
              if (/application\/json/i.test(type)) {
                const data = JSON.parse(this.responseText);
                if (typeof data?.count !== 'undefined') window.setCartCount(data.count);
              }
            } catch {}
          });
        }
        return _send.apply(this, arguments);
      };
    }

    window.cartAdd = async function(iditem, qty=1, options={}) {
      const q  = Math.max(1, parseInt(qty,10) || 1);
      const id = (iditem ?? '').toString().trim();
      window.cartAdded(q);
      const api    = options.api || null;
      const method = (options.method || 'POST').toUpperCase();
      if (!api) return;
      try {
        const token  = document.querySelector('meta[name="csrf-token"]')?.content;
        const payload = method === 'GET' ? undefined : JSON.stringify({ iditem: id, quantity: q });
        const res = await fetch(api, {
          method,
          headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            ...(token ? { 'X-CSRF-TOKEN': token } : {})
          },
          body: payload
        });
        return res; // count sync ผ่าน fetch patch แล้ว
      } catch (e) {
        return null;
      }
    };

    // sync badge text กับ SSR ค่าแรก
    (function syncInit(){
      const BADGES = document.querySelectorAll('[data-cart-badge], #cartCountDb');
      let v = 0;
      BADGES.forEach(b => { v = Math.max(v, parseInt(b.dataset.count ?? b.textContent ?? '0',10) || 0); });
      window.setCartCount(v, {pop:false});
      BADGES.forEach(badge => {
        new MutationObserver(() => {
          const v = String(badge.dataset.count ?? '0');
          if (badge.textContent !== v) badge.textContent = v;
        }).observe(badge, { childList: true, characterData: true, subtree: true });
      });
    })();
  })();

  /* ✅ Pull-to-Refresh Fallback: ดึงลงจากขอบบน ≥ 70px → reload */
  (function () {
    var THRESHOLD = 70;
    var startY = 0, pulling = false, moved = 0;
    var root = document.documentElement;

    function atTop() {
      return (window.scrollY || root.scrollTop || document.body.scrollTop || 0) <= 0;
    }

    // === เปลี่ยนข้อความเป็น "รีโหลด" และเอาพื้นหลัง/เงาออก (ส่วนอื่นไม่ยุ่ง) ===
    var bar = document.createElement('div');
    bar.id = 'ptrBar';
    bar.style.cssText =
      'position:fixed;top:0;left:0;right:0;height:0;overflow:hidden;' +
      'display:flex;align-items:center;justify-content:center;' +
      'z-index:9999;transition:height .15s ease';
    bar.style.background = 'transparent';
    bar.style.boxShadow = 'none';
    bar.style.padding = '8px 0';
    bar.style.font = '500 12px system-ui';
    bar.style.color = '#555';

    document.addEventListener('DOMContentLoaded', function(){ document.body.appendChild(bar); });

    window.addEventListener('touchstart', function (e) {
      if (!atTop()) return;
      startY = e.touches[0].clientY;
      pulling = true;
      moved = 0;
    }, { passive: true });

    window.addEventListener('touchmove', function (e) {
      if (!pulling) return;
      moved = e.touches[0].clientY - startY;
      if (moved > 0) {
        bar.style.height = Math.min(moved, THRESHOLD) + 'px';
      }
    }, { passive: true });

    window.addEventListener('touchend', function () {
      if (!pulling) return;
      pulling = false;
      if (moved >= THRESHOLD) {
        location.reload();
      }
      bar.style.height = '0px';
    }, { passive: true });
  })();
})();
</script>

</body>
</html>
