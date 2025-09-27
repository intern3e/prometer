<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- CSRF (เผื่อคุณมีเอ็นด์พอยต์เพิ่มตะกร้า จะได้ใช้ได้ทันที) -->
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
  html, body { height: 100%; margin: 0; overscroll-behavior: none; }
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

<!-- ===== Top utility bar ===== -->
<header class="bg-gray-100 text-[13px] text-gray-700 border-b">
  <div class="container-outer mx-auto section-pad py-2 flex items-center justify-between gap-2 flex-wrap md:flex-nowrap">
    <!-- ซ้าย -->
    <div class="flex items-center gap-4 whitespace-nowrap">
      <a class="hover:text-[var(--brand)]" data-i18n="top_buyer_central">Buyer Central</a>
      <a class="hover:text-[var(--brand)]" data-i18n="top_help">Help</a>
    </div>

    <!-- ขวา -->
    <div class="flex items-center gap-4 min-w-0 whitespace-nowrap">
      <div class="relative shrink-0">
        <button id="currentLangBtn" class="flex items-center gap-1 hover:text-[var(--brand)]">
          <span id="currentLangLabel">ไทย</span> <i class="bi bi-chevron-down text-xs"></i>
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
    : (Route::has('profile.edit') ? route('profile.edit') : url('/profile'));
@endphp

@if (!$email)
  <a href="{{ route('login') }}" class="hover:text-[var(--brand)]" data-i18n="top_login">เข้าสู่ระบบ</a>
  <a href="{{ route('Sign_up') }}" class="hover:text-[var(--brand)]" data-i18n="top_join_free">สมัครสมาชิกฟรี</a>
@else
  <!-- Desktop -->
  <div class="hidden md:flex items-center gap-3 min-w-0 whitespace-nowrap">
    <span class="text-sm text-gray-700 truncate max-w-[360px]">
      <span data-i18n="top_user">ผู้ใช้</span>:
      <span class="font-medium text-gray-900">{{ $username }}</span>
      <span class="text-xs text-gray-500 ml-1" title="{{ $email }}">
        ({{ \Illuminate\Support\Str::limit($email, 25, '…') }})
      </span>
    </span>


      <a href="/profile"
        class="px-3 py-1.5 rounded-lg border border-gray-200 hover:bg-orange-50 text-gray-700 inline-flex items-center gap-2"
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

<!-- Mobile -->
<div class="relative md:hidden">
  <button id="userMenuBtn"
          class="flex items-center gap-2 px-2 py-1.5 rounded-lg border hover:bg-gray-50 text-gray-700"
          aria-haspopup="true" aria-expanded="false" aria-controls="userMenuDropdown">
    <i class="bi bi-person-circle text-base"></i>
    <span class="text-sm">
      {{ \Illuminate\Support\Str::limit($username, 15, '...') }}
    </span>
    <i class="bi bi-caret-down-fill text-[10px]"></i>
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

            {{-- ลิงก์โปรไฟล์ (Mobile) --}}
      <a href="/profile"
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

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('userMenuBtn');
    const dd  = document.getElementById('userMenuDropdown');
    if (!btn || !dd) return;

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
              alt="FLUKE" 
              class="h-8 md:h-10 w-auto" 
              data-i18n="brand_name">
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

      // 1) หา uid (Auth -> session('idcustomer') -> map จาก customer_name)
      $uid = Auth::id() ?? session('idcustomer');
      if (!$uid && ($name = session('customer_name'))) {
          try {
              $uid = DB::table('custdetail')
                  ->where('username', $name)
                  ->orWhere('idcustomer', $name)
                  ->value('idcustomer');
              if ($uid) {
                  session(['idcustomer' => $uid]); // cache กลับ
              }
          } catch (\Throwable $e) {
              // เงียบ
          }
      }

      // 2) นับจาก DB ตาม idcustomer (รองรับ cart/carts และ quantity/count)
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
      } catch (\Throwable $e) {
          // ปล่อยให้ fallback ต่อไป
      }

      // 3) Fallback: ถ้า 0 หรือยังไม่รู้ uid → ใช้ session('cart') เพื่อให้ตอน "ออกจากระบบ" ก็ยังเห็นจำนวน
      if ($cartCount === 0) {
          $sessionCart = session('cart', []);
          if (is_array($sessionCart)) {
              foreach ($sessionCart as $item) {
                  $cartCount += (int) ($item['quantity'] ?? 1);
              }
          }
      }
    @endphp

    <a href="{{ url('cart') }}" class="nav-cart relative text-gray-700 hover:text-[var(--brand)] ml-1" aria-label="cart">
      <i class="bi bi-cart text-2xl"></i>
      <span id="cartCountDb"
            data-count="{{ $cartCount }}"
            class="absolute -top-2 -right-2 bg-[var(--brand)] text-white text-xs rounded-full min-w-5 h-5 px-1
                   flex items-center justify-center"
            style="z-index:60">
        {{ $cartCount }}
      </span>
    </a>

    <!-- ========== Cart Badge: อัปเดตทันทีแบบหน้าเดียว (ไม่พึ่งหน้าอื่น) ========== -->
    <script>
    (function(){
      const badge = document.getElementById('cartCountDb');
      if (!badge) return;

      const toInt = (v, d=0) => {
        const n = parseInt(v, 10);
        return Number.isFinite(n) ? n : d;
      };

      const get = () => toInt(badge.dataset.count ?? badge.textContent ?? '0', 0);

      const pop = () => { badge.classList.remove('cart-pop'); void badge.offsetWidth; badge.classList.add('cart-pop'); };

      const sync = () => {
        const v = String(badge.dataset.count ?? '0');
        if (badge.textContent !== v) { badge.textContent = v; pop(); }
      };

      const dispatchCount = () => {
        window.dispatchEvent(new CustomEvent('cart:count', { detail: { count: get() } }));
      };

      window.setCartCount = (n) => {
        badge.dataset.count = String(Math.max(0, toInt(n, 0)));
        sync();
        dispatchCount();
      };

      window.bumpCartCount = (delta = 1) => {
        const next = Math.max(0, get() + toInt(delta, 0));
        window.setCartCount(next);
      };

      // ฟังก์ชันเพิ่มตะกร้าแบบ Optimistic (เด้งเลขทันที)
      // ถ้ามี data-api บนปุ่ม จะยิงไปที่ API นั้น (POST JSON: {iditem, quantity})
      window.cartAdd = async function(iditem, qty = 1, options = {}) {
        const q = Math.max(1, toInt(qty, 1));
        // เด้งเลขก่อน (หน้าเดียว ไม่ต้องพึ่งผลลัพธ์)
        window.bumpCartCount(q);

        const api    = options.api || null;
        const method = (options.method || 'POST').toUpperCase();
        if (!api) {
          // ไม่มี API ก็จบที่การเด้งเลข (ตามคำขอให้จบหน้าเดียว)
          window.dispatchEvent(new CustomEvent('cart:added', { detail: { iditem, qty: q, optimistic:true } }));
          return;
        }
        try {
          const token  = document.querySelector('meta[name="csrf-token"]')?.content;
          const res = await fetch(api, {
            method,
            headers: {
              'Content-Type': 'application/json',
              'X-Requested-With': 'XMLHttpRequest',
              ...(token ? { 'X-CSRF-TOKEN': token } : {})
            },
            body: method === 'GET' ? undefined : JSON.stringify({ iditem, quantity: q })
          });
          let data = null;
          try { data = await res.json(); } catch(_) {}
          if (data && typeof data.count !== 'undefined') {
            window.setCartCount(data.count); // sync กับค่าจริง ถ้ามี
          }
          window.dispatchEvent(new CustomEvent('cart:added', { detail: { iditem, qty: q, optimistic:false, response:data } }));
        } catch (e) {
          // ถ้าล้มเหลว เราก็ยังมีเลขแบบ optimistic อยู่แล้ว
          window.dispatchEvent(new CustomEvent('cart:added:error', { detail: { iditem, qty: q, error: String(e) } }));
        }
      };

      // เริ่มต้น: sync จากค่า data-count
      sync();

      // ถ้า script อื่นพยายามเขียนทับ badge → เราซิงก์คืนจาก data-count เสมอ
      new MutationObserver(sync).observe(badge, { childList: true, characterData: true, subtree: true });

      // รองรับการตั้งค่าผ่านอีเวนต์สาธารณะ
      window.addEventListener('cart:count', (e) => {
        if (e?.detail && typeof e.detail.count !== 'undefined') {
          window.setCartCount(e.detail.count);
        }
      });

      // Auto-bind ปุ่ม/ลิงก์ที่มี data-add-to-cart (หน้าเดียวจบ)
      document.addEventListener('click', async (e) => {
        const btn = e.target.closest('[data-add-to-cart]');
        if (!btn) return;

        e.preventDefault();

        // iditem
        const id = btn.getAttribute('data-iditem') ?? btn.dataset.id ?? btn.value ?? null;

        // qty: data-qty > input ใกล้ ๆ > 1
        let qty = btn.getAttribute('data-qty');
        if (!qty) {
          const scope = btn.closest('[data-product], .product, .card, .item, form') || document;
          const qtyInput =
            scope.querySelector('[data-qty-input]') ||
            scope.querySelector('input[name="quantity"]') ||
            scope.querySelector('input.qty') ||
            scope.querySelector('.qty input');
          qty = qtyInput ? qtyInput.value : '1';
        }

        // ถ้ามี data-api ก็ยิงไปด้วย (แต่ว่า "จบหน้าเดียว" อยู่แล้วเพราะเราบวกเลขแบบ optimistic)
        const api    = btn.getAttribute('data-api');       // ex: "/cart/add"
        const method = (btn.getAttribute('data-method') || 'POST').toUpperCase();

        await window.cartAdd(id, qty, api ? { api, method } : {});
      });
    })();
    </script>

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

</body>
</html>
