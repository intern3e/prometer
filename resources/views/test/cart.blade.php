<!DOCTYPE html>
<html lang="th">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>FLUKE | Shopping Cart</title>
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
  --radius:16px;
}
html, body { height: 100%; margin: 0; overscroll-behavior: none; }
body{
  font-family:'Prompt',sans-serif;
  background:var(--bg);
  color:var(--ink);
  display:flex; flex-direction:column;
}
main { flex: 1; }

.container-outer{ max-width:1200px; margin:0 auto; }
.section-pad{ padding-left:.75rem; padding-right:.75rem; }
@media (min-width:768px){ .section-pad{ padding-left:1rem; padding-right:1rem; } }

.card{ background:var(--card); border:1px solid rgba(17,24,39,.08); border-radius:var(--radius); box-shadow:0 1px 2px rgba(0,0,0,.04); }
.brand-chip{ background:#111827; color:#fff; font-weight:700; padding:2px 8px; border-radius:9999px; font-size:11px; letter-spacing:.3px; }
.perk-badge{ display:inline-flex; gap:6px; align-items:center; padding:2px 8px; border-radius:9999px; background:#fff7ed; color:#b45309; border:1px solid #fed7aa; font-size:11px; }
.price-old{ color:#9ca3af; text-decoration:line-through; font-size:.9rem; }
.line-1{ display:-webkit-box; -webkit-line-clamp:1; -webkit-box-orient:vertical; overflow:hidden; }
.thumb{ width:64px; height:64px; border-radius:8px; overflow:hidden; background:#f3f4f6; border:1px solid #eee; }
.qty-btn{ width:28px; height:28px; border:1px solid #e5e7eb; border-radius:6px; display:inline-flex; align-items:center; justify-content:center; }

/* หัวร้าน (อยู่นอกกล่องเลื่อน) */
.shop-head{ display:flex; align-items:center; gap:10px; padding:14px 16px; background:#fff; border-top:1px solid #eee; }
.shop-coupon{ padding:12px 16px; color:#ef4444; display:flex; gap:8px; align-items:center; border-top:1px dashed #f0f0f0; background:#fff; }

/* ตารางคอลัมน์ */
.cart-head,
.cart-row{
  display:grid;
  grid-template-columns: 40px 1fr 140px 120px 140px 120px;
  align-items:center;
  gap: 1rem;
}
.cart-head{ padding:14px 16px; color:#fff; font-weight:700; }
.cart-row{ padding:16px; border-top:1px solid #f0f0f0; background:#fff; }

/* ราคา */
.price-cell{
  display:grid;
  grid-template-rows: 1fr auto 1fr;
  align-items:center;
}
.price-cell .now{ grid-row:2; }
.price-cell .old{ grid-row:1; align-self:end; line-height:1; }

/* แถบสรุป (sticky มือถือ) */
.cart-bar{ position:sticky; bottom:0; background:#fff; border-top:1px solid #e5e7eb; padding:14px 16px; display:flex; align-items:center; justify-content:space-between; gap:8px; }
.btn-orange{ background:var(--brand); color:#fff; padding:10px 18px; border-radius:10px; font-weight:700; }
.btn-orange[disabled]{ opacity:.5; cursor:not-allowed; }
.lang-item{ cursor:pointer; }

/* Checkbox สีส้ม */
input[type="checkbox"]{ accent-color: var(--brand); }

/* Safe area */
@supports (padding: max(0px)) {
  .mobile-sticky-safe { padding-bottom: max(12px, env(safe-area-inset-bottom)); }
}

/* กล่องเลื่อนรายการสินค้า (หัวร้าน/คูปองอยู่นอก) */
.cart-scroll{
  max-height: 70vh;
  overflow: auto;
  overscroll-behavior: contain;
  scrollbar-gutter: stable;
}
.cart-scroll::-webkit-scrollbar{ width:10px; }
.cart-scroll::-webkit-scrollbar-thumb{ background:#e5e7eb; border-radius:8px; }
.cart-scroll::-webkit-scrollbar-thumb:hover{ background:#d1d5db; }

/* มือถือ */
@media (max-width: 768px){
  .cart-head{ display:none; }

  .cart-row{
    grid-template-columns: 36px 1fr auto;
    grid-template-areas:
      "check product product"
      "price qty actions";
    row-gap: 12px;
    column-gap: 12px;
  }

  .cart-row > :nth-child(1){ grid-area: check; align-self: start; }
  .cart-row > :nth-child(2){
    grid-area: product; min-width:0;
    display:grid; grid-template-columns: 72px 1fr;
    gap:12px; align-items:center;
  }
  .cart-row > :nth-child(2) img{
    width:72px; aspect-ratio:1/1; object-fit:cover; border-radius:12px; display:block; background:#f3f4f6;
  }

  .cart-row > :nth-child(3){ grid-area: price; justify-self:start; text-align:left; }

  .cart-row > :nth-child(4){
    grid-area: qty; justify-self:center;
    display:inline-grid; grid-auto-flow:column; align-items:center;
    gap:12px; min-width:120px;
  }
  .cart-row > :nth-child(4) .qty-btn{ width:36px; height:36px; }
  .cart-row > :nth-child(4) .qty-btn + span{ min-width:2ch; text-align:center; }

  .cart-row > :nth-child(5){ display:none; } /* ซ่อน line total บนมือถือ */

  .cart-row > :nth-child(6){
    grid-area: actions; justify-self:end;
    display:flex; align-items:center; gap:12px; white-space:nowrap;
  }
}
</style>

</head>
<body>
<!-- ===== Top utility bar (one-line on mobile) ===== -->
<style>
  /* ปรับให้บาร์นี้บีบตัวเองบนจอเล็ก */
  .utilbar{ font-size:12px; }
  @media (min-width:768px){ .utilbar{ font-size:13px; } }

  /* ตัวช่วยตัดข้อความแบบ inline */
  .inline-clip{
    display:inline-block; max-width:100%;
    white-space:nowrap; overflow:hidden; text-overflow:ellipsis;
    vertical-align:bottom;
  }
</style>

<header class="bg-gray-100 text-gray-700 border-b utilbar">
  <!-- flex-nowrap บังคับบรรทัดเดียวบนมือถือ / min-w-0 ช่วย truncate -->
  <div class="container-outer mx-auto section-pad py-1.5 flex items-center justify-between gap-2 flex-nowrap min-w-0">
    <!-- ซ้าย -->
    <div class="flex items-center gap-3 whitespace-nowrap shrink-0">
      <a class="hover:text-[var(--brand)]" data-i18n="top_buyer_central">Buyer Central</a>
      <a class="hover:text-[var(--brand)]" data-i18n="top_help">Help</a>
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
      <!-- ปุ่ม Login/Register จะไม่ดันตกบรรทัด -->
      <a href="{{ route('login') }}" class="hover:text-[var(--brand)] shrink-0" data-i18n="top_login">เข้าสู่ระบบ</a>
      <a href="{{ route('Sign_up') }}" class="hover:text-[var(--brand)] shrink-0" data-i18n="top_join_free">สมัครสมาชิกฟรี</a>
@else
      <!-- Desktop -->
      <div class="hidden md:flex items-center gap-2 min-w-0 whitespace-nowrap">
        <!-- ส่วนนี้ยอมตัดชื่อ/อีเมลด้วย ... -->
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

      <!-- Mobile (บีบให้ชิพเดียว ไม่ตกบรรทัด) -->
      <div class="relative md:hidden min-w-0">
        <button id="userMenuBtn"
                class="flex items-center gap-1.5 px-2 py-1 rounded-lg border hover:bg-gray-50 text-gray-700 min-w-0"
                aria-haspopup="true" aria-expanded="false" aria-controls="userMenuDropdown">
          <i class="bi bi-person-circle text-sm shrink-0"></i>
          <!-- ชื่อจะถูกตัด ... และซ่อนอีเมล -->
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

<!-- ===== Main nav (logo) ===== -->
<nav class="bg-white">
  <div class="container-outer mx-auto section-pad py-3 md:py-4 flex items-center gap-3 md:gap-6">
    <a href="/" class="flex items-center gap-2 min-w-0">
      <img src="https://img2.pic.in.th/pic/image032196d0b157d229.png" 
           alt="FLUKE" 
           class="h-8 md:h-10 w-auto" 
           data-i18n="brand_name">
    </a>
    <div class="flex-1"></div>
  </div>
</nav>


<!-- ===== CART CONTENT ===== -->
<main class="container mx-auto px-4 sm:px-6 my-6 sm:my-10 pb-24 md:pb-0">
  <div class="bg-white shadow-lg rounded-2xl overflow-hidden">

    <!-- หัวคอลัมน์ (ซ่อนบนมือถือ) -->
    <div class="cart-head hidden md:grid bg-gray-700 text-white text-sm px-6 py-3">
      <div class="flex items-center">
        <input id="selectAllTop" type="checkbox" class="w-4 h-4" aria-label="select all (top)">
      </div>
      <div data-i18n="col_product">สินค้า</div>
      <div class="text-center" data-i18n="col_price_each">ราคาต่อชิ้น</div>
      <div class="text-center" data-i18n="col_qty">จำนวน</div>
      <div class="text-center" data-i18n="col_line_total">ราคารวม</div>
      <div class="text-center" data-i18n="col_actions">การจัดการ</div>
    </div>

    <!-- ⬇️ หัวร้าน (อยู่นอกกล่องเลื่อน) -->
    <div id="shopHeader" class="shop-head">
      <label class="inline-flex items-center gap-2">
        <input type="checkbox" id="shopSelect" class="w-4 h-4" aria-label="select shop">
      </label>
      <div class="flex items-center gap-2">
        <div class="brand-chip">FLUKE</div>
        <div class="font-semibold">FLUKE Marketplace Style</div>
      </div>
    </div>

    <!-- กล่องเลื่อนเฉพาะ “รายการสินค้า” -->
    <div id="cartScroll" class="cart-scroll">
      <div id="cartMount" class="divide-y divide-gray-200"><!-- Rendered by JS --></div>
    </div>

    <!-- ⬇️ คูปองร้าน (อยู่นอกกล่องเลื่อน) -->
    <div id="shopCoupon" class="shop-coupon">
      <i class="bi bi-ticket-perforated"></i>
      <span data-i18n="coupon_prefix">คูปองร้าน FLUKE:</span>
      <span class="text-gray-600 text-sm ml-1" data-i18n="coupon_text">ซื้อขั้นต่ำ ฿1,500 ส่งฟรี</span>
    </div>

    <!-- แถบสรุป -->
    <div id="summarySticky"
         class="sticky bottom-0 md:static z-30 bg-white border-t md:border-t-0 px-4 sm:px-6 py-3 md:px-6 md:py-4 mobile-sticky-safe">
      <div class="flex flex-col md:flex-row justify-between items-center gap-3 md:gap-4">
        <div class="flex items-center gap-4 text-sm w-full md:w-auto">
          <label class="inline-flex items-center gap-2">
            <input id="selectAllBottom" type="checkbox" class="w-4 h-4" aria-label="select all (bottom)">
            <span data-i18n="select_all">เลือกทั้งหมด</span>
            (<span id="allCount">0</span>)
          </label>
          <button id="removeSelected" class="text-red-500 hover:underline" type="button" data-i18n="remove_selected">ลบรายการที่เลือก</button>
        </div>

        <div class="flex items-center gap-3 md:gap-4 flex-wrap w-full md:w-auto justify-between md:justify-end">
          <div class="flex items-baseline gap-2 text-gray-600">
            <span class="text-sm"><span data-i18n="summary_subtotal">รวม</span> (<span id="selItems">0</span> <span data-i18n="items">รายการ</span>):</span>
            <span id="grandSubtotal" class="font-semibold text-gray-800">฿0</span>
          </div>

          <div id="shippingRow" class="hidden inline-flex items-baseline gap-1 text-gray-600 text-sm">
            <span>+</span>
            <span id="shippingLabel" data-i18n="shipping_label">ค่าส่ง</span>
            <span id="shippingAmount" class="font-medium">฿0</span>
            <span id="shipping_reason" data-i18n="shipping_reason" class="ml-1 text-[11px] text-gray-500">ยอดสั่งซื้อต่ำกว่า ฿1,500</span>
          </div>

          <div class="hidden md:block h-5 w-px bg-gray-300"></div>

          <div class="flex items-baseline gap-2">
            <span class="text-xs text-gray-500" data-i18n="summary_total">ยอดสุทธิ</span>
            <span id="grandTotal" class="text-2xl font-extrabold text-[var(--brand)]">฿0</span>
          </div>

          <button id="checkoutBtn" class="btn-orange rounded-xl px-5 py-3 hover:opacity-90 transition disabled:bg-gray-300 disabled:cursor-not-allowed w-full md:w-auto" disabled type="button" data-i18n="checkout_btn">
            ชำระเงิน
          </button>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- ====== CHECKOUT MODAL (Mobile bottom sheet 85vh, desktop dialog) ====== -->
<style>
  /* Mobile height fix (uses --vh set by JS) */
  @media (max-width: 767px){
    #checkoutModal [data-modal-panel]{
      height: calc(var(--vh, 1vh) * 85);
      max-height: calc(var(--vh, 1vh) * 85);
    }
  }
  /* Prevent horizontal overflow and allow wrapping */
  #checkoutModal, #checkoutModal *{ min-width: 0; }
  #checkoutModal [data-modal-panel]{ overflow-x: hidden; }
  .wrap{ overflow-wrap:anywhere; word-break:break-word; hyphens:auto; }
</style>

<div id="checkoutModal"
     class="fixed inset-0 z-[100] hidden"
     role="dialog" aria-modal="true" aria-labelledby="checkoutTitle"
     data-i18n-scope="checkout">
  <!-- Backdrop -->
  <div class="absolute inset-0 bg-black/50" data-close-modal aria-label="Close modal backdrop"></div>

  <!-- Panel wrapper -->
  <div class="absolute inset-x-0 bottom-0 md:inset-0 md:flex md:items-center md:justify-center
              px-[max(env(safe-area-inset-left),0px)] pb-[max(env(safe-area-inset-bottom),0px)]">
    <!-- Panel (FLEX COLUMN) -->
    <div class="bg-white w-full md:w-[980px]
                md:rounded-2xl md:shadow-2xl
                rounded-t-2xl md:rounded-b-2xl
                transition-transform duration-200 ease-out will-change-transform
                outline-none overflow-hidden flex flex-col"
         tabindex="-1"
         data-modal-panel>

      <!-- Drag handle (mobile only) -->
      <div class="md:hidden flex items-center justify-center pt-2">
        <div class="w-12 h-1.5 rounded-full bg-gray-300" data-drag-handle aria-hidden="true"></div>
      </div>

      <!-- Header -->
      <div class="flex items-center justify-between px-4 sm:px-6 py-3 border-b bg-gray-50 wrap">
        <h3 id="checkoutTitle" class="text-lg font-semibold" data-i18n="title">สรุปคำสั่งซื้อ</h3>
        <button class="text-gray-500 hover:text-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-400 rounded-md"
                id="closeCheckoutModal" title="ปิด" data-i18n-attr="title:close" data-close-modal>
          <i class="bi bi-x-lg" aria-hidden="true"></i>
          <span class="sr-only" data-i18n="close">ปิด</span>
        </button>
      </div>

      <!-- Body (SCROLL AREA) -->
      <div class="grid md:grid-cols-5 gap-0 md:gap-6 p-4 sm:p-6 flex-1 min-h-0 overflow-y-auto wrap"
           data-modal-body>
        <!-- สินค้าที่เลือก -->
        <section class="md:col-span-3 space-y-3">
          <div class="border rounded-xl overflow-hidden">
            <div class="px-4 py-3 bg-gray-50 border-b font-medium" data-i18n="selected_items">สินค้าที่เลือก</div>
            <div id="coItems" class="divide-y max-h-[40vh] md:max-h-[52vh] overflow-auto"></div>
          </div>

          <div class="border rounded-xl overflow-hidden">
            <div class="px-4 py-3 bg-gray-50 border-b font-medium" data-i18n="totals">ยอดรวม</div>
            <div class="p-4 space-y-2 text-sm">
              <div class="flex justify-between"><span data-i18n="subtotal">รวมสินค้า</span><span id="coSubtotal">฿0.00</span></div>
              <div class="flex justify-between"><span data-i18n="shipping">ค่าส่ง</span><span id="coShipping">฿0.00</span></div>
              <div class="border-t my-2"></div>
              <div class="flex justify-between text-base font-bold"><span data-i18n="grand_total">ยอดสุทธิ</span><span id="coGrand">฿0.00</span></div>
            </div>
          </div>
        </section>

        <!-- ที่อยู่ + วิธีชำระ -->
        <section class="md:col-span-2 space-y-3">
          <!-- Address -->
          <div class="border rounded-xl overflow-hidden">
            <div class="px-4 py-3 bg-gray-50 border-b font-medium" data-i18n="shipping_address">ที่อยู่จัดส่ง</div>
            <div class="p-4 grid grid-cols-1 gap-3" id="addrList"><!-- render by JS --></div>
          </div>
          <!-- Payment -->
          <div class="border rounded-xl overflow-hidden">
            <div class="px-4 py-3 bg-gray-50 border-b font-medium" data-i18n="payment_method">วิธีชำระเงิน</div>
            <div class="p-4 grid gap-2 text-sm">
              <label class="flex items-center gap-2">
                <input type="radio" name="paymethod" value="COD" class="w-4 h-4" checked>
                <span data-i18n="pay_cod">ชำระปลายทาง (COD)</span>
              </label>
              <label class="flex items-center gap-2">
                <input type="radio" name="paymethod" value="BANK" class="w-4 h-4">
                <span data-i18n="pay_bank">โอนผ่านบัญชีธนาคาร</span>
              </label>
              <label class="flex items-center gap-2">
                <input type="radio" name="paymethod" value="CARD" class="w-4 h-4">
                <span data-i18n="pay_card">บัตรเครดิต/เดบิต</span>
              </label>
            </div>
          </div>
        </section>
      </div>

      <!-- Footer (NOT sticky; panel is flex so footer stays visible while body scrolls) -->
      <div class="px-4 sm:px-6 py-4 border-t bg-white flex flex-col md:flex-row items-center justify-between gap-3"
           data-modal-footer>
        <div class="text-sm text-gray-500" data-i18n="review_note">ตรวจสอบข้อมูลให้ถูกต้องก่อนยืนยัน</div>
        <div class="flex items-center gap-3 w-full md:w-auto">
          <button class="px-4 py-2 rounded-lg border hover:bg-gray-50 w-full md:w-auto
                         focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-400"
                  data-close-modal data-i18n="cancel">ยกเลิก</button>
          <button id="confirmCheckoutBtn"
                  class="btn-orange px-5 py-2.5 rounded-lg w-full md:w-auto
                         focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500"
                  data-i18n="confirm_order">
            ยืนยันสั่งซื้อ
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
(function(){
  const modal = document.getElementById('checkoutModal');
  const panel = modal?.querySelector('[data-modal-panel]');
  const openBtn = document.getElementById('checkoutBtn'); // optional opener
  const closeBtns = modal?.querySelectorAll('[data-close-modal]');
  const handle = modal?.querySelector('[data-drag-handle]');

  // ---- mobile 100vh fix ----
  function setVH(){ document.documentElement.style.setProperty('--vh', (window.innerHeight*0.01)+'px'); }
  setVH();
  window.addEventListener('resize', setVH, { passive: true });

  let lastActive = null;
  const FOCUSABLE = [
    'a[href]', 'button:not([disabled])', 'input:not([disabled])',
    'select:not([disabled])', 'textarea:not([disabled])',
    '[tabindex]:not([tabindex="-1"])'
  ].join(',');

  function lockScroll(lock){
    document.documentElement.classList.toggle('overflow-hidden', lock);
    document.body.classList.toggle('overflow-hidden', lock);
    document.body.classList.toggle('touch-pan-y', !lock);
  }

  function trapFocus(e){
    if (!modal || modal.classList.contains('hidden')) return;
    if (e.key !== 'Tab') return;
    const els = modal.querySelectorAll(FOCUSABLE);
    if (!els.length) return;
    const first = els[0], last = els[els.length - 1];
    if (e.shiftKey && document.activeElement === first){ e.preventDefault(); last.focus(); }
    else if (!e.shiftKey && document.activeElement === last){ e.preventDefault(); first.focus(); }
  }

  function openModal(triggerEl){
    if (!modal) return;
    lastActive = triggerEl || document.activeElement;
    modal.classList.remove('hidden');
    lockScroll(true);

    const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (!reduce && panel){
      panel.style.transform = 'translateY(20px)';
      requestAnimationFrame(()=>{ panel.style.transform = 'translateY(0)'; });
    }
    setTimeout(()=>{ (modal.querySelector(FOCUSABLE) || panel)?.focus?.(); }, 0);

    document.addEventListener('keydown', onKey);
    document.addEventListener('keydown', trapFocus, true);
  }

  function closeModal(){
    if (!modal) return;
    const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (!reduce && panel){
      panel.style.transform = 'translateY(20px)';
      setTimeout(hideNow, 140);
    } else hideNow();

    function hideNow(){
      modal.classList.add('hidden');
      panel && (panel.style.transform = '');
      lockScroll(false);
      document.removeEventListener('keydown', onKey);
      document.removeEventListener('keydown', trapFocus, true);
      if (lastActive && typeof lastActive.focus === 'function') lastActive.focus();
    }
  }

  function onKey(e){ if (e.key === 'Escape') closeModal(); }

  // Open & close hooks
  if (openBtn) openBtn.addEventListener('click', (e)=>openModal(e.currentTarget));
  closeBtns?.forEach(btn => btn.addEventListener('click', closeModal));
  modal?.addEventListener('click', (e)=>{ if (e.target && e.target.hasAttribute('data-close-modal')) closeModal(); });

  // ---- Drag-to-close (mobile) ----
  (function enableDragToClose(){
    const area = handle || panel; if (!area || !panel) return;
    let startY = 0, currentY = 0, dragging = false, startTime = 0;
    const maxTranslate = 120; // px
    const threshold = 60;     // px

    function onStart(ev){
      const t = ev.touches ? ev.touches[0] : ev;
      dragging = true; startY = t.clientY; currentY = startY; startTime = Date.now();
      panel.style.transition = 'none';
      window.addEventListener('mousemove', onMove, { passive: false });
      window.addEventListener('touchmove', onMove, { passive: false });
      window.addEventListener('mouseup', onEnd);
      window.addEventListener('touchend', onEnd);
    }
    function onMove(ev){
      if (!dragging) return;
      const t = ev.touches ? ev.touches[0] : ev;
      currentY = t.clientY;
      const dy = Math.max(0, currentY - startY);
      if (dy > 0) ev.preventDefault();
      const translate = Math.min(maxTranslate, dy);
      panel.style.transform = `translateY(${translate}px)`;
    }
    function onEnd(){
      if (!dragging) return;
      const dy = Math.max(0, currentY - startY);
      const dt = Math.max(1, Date.now() - startTime);
      const velocity = dy / dt; // px/ms
      dragging = false;
      panel.style.transition = '';
      panel.style.transform = '';
      if (dy >= threshold || velocity > 0.8){ closeModal(); }
      window.removeEventListener('mousemove', onMove);
      window.removeEventListener('touchmove', onMove);
      window.removeEventListener('mouseup', onEnd);
      window.removeEventListener('touchend', onEnd);
    }

    area.addEventListener('mousedown', onStart);
    area.addEventListener('touchstart', onStart, { passive: true });
  })();

  // Expose programmatic API (single definition)
  window.checkoutModal = { open: openModal, close: closeModal };
})();
</script>

<!-- ====== /CHECKOUT MODAL ====== -->

<!-- ====== CHECKOUT MODAL (Mobile bottom sheet 85vh, Desktop dialog) ====== -->
<style>
  /* Mobile height fix (uses --vh set by JS) */
  @media (max-width: 767px){
    #checkoutModal [data-modal-panel]{
      height: calc(var(--vh, 1vh) * 85);
      max-height: calc(var(--vh, 1vh) * 85);
    }
  }
  /* Prevent horizontal overflow & allow wrapping */
  #checkoutModal, #checkoutModal *{ min-width: 0; }
  #checkoutModal [data-modal-panel]{ overflow-x: hidden; }
  .wrap{ overflow-wrap:anywhere; word-break:break-word; hyphens:auto; }
</style>

<div id="checkoutModal"
     class="fixed inset-0 z-[100] hidden"
     role="dialog" aria-modal="true" aria-labelledby="checkoutTitle"
     data-i18n-scope="checkout">
  <!-- Backdrop -->
  <div class="absolute inset-0 bg-black/50" data-close-modal aria-label="Close modal backdrop"></div>

  <!-- Panel wrapper -->
  <div class="absolute inset-x-0 bottom-0 md:inset-0 md:flex md:items-center md:justify-center
              px-[max(env(safe-area-inset-left),0px)] pb-[max(env(safe-area-inset-bottom),0px)]">
    <!-- Panel (FLEX COLUMN) -->
    <div class="bg-white w-full md:w-[980px]
                md:rounded-2xl md:shadow-2xl
                rounded-t-2xl md:rounded-b-2xl
                transition-transform duration-200 ease-out will-change-transform
                outline-none overflow-hidden flex flex-col"
         tabindex="-1"
         data-modal-panel>

      <!-- Drag handle (mobile only) -->
      <div class="md:hidden flex items-center justify-center pt-2">
        <div class="w-12 h-1.5 rounded-full bg-gray-300" data-drag-handle aria-hidden="true"></div>
      </div>

      <!-- Header -->
      <div class="flex items-center justify-between px-4 sm:px-6 py-3 border-b bg-gray-50 wrap">
        <h3 id="checkoutTitle" class="text-lg font-semibold" data-i18n="title">สรุปคำสั่งซื้อ</h3>
        <button class="text-gray-500 hover:text-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-400 rounded-md"
                id="closeCheckoutModal" title="ปิด" data-i18n-attr="title:close" data-close-modal>
          <i class="bi bi-x-lg" aria-hidden="true"></i>
          <span class="sr-only" data-i18n="close">ปิด</span>
        </button>
      </div>

      <!-- Body (SCROLL AREA) -->
      <div class="grid md:grid-cols-5 gap-0 md:gap-6 p-4 sm:p-6 flex-1 min-h-0 overflow-y-auto wrap"
           data-modal-body>
        <!-- สินค้าที่เลือก -->
        <section class="md:col-span-3 space-y-3">
          <div class="border rounded-xl overflow-hidden">
            <div class="px-4 py-3 bg-gray-50 border-b font-medium" data-i18n="selected_items">สินค้าที่เลือก</div>
            <div id="coItems" class="divide-y max-h-[40vh] md:max-h-[52vh] overflow-auto"></div>
          </div>

          <div class="border rounded-xl overflow-hidden">
            <div class="px-4 py-3 bg-gray-50 border-b font-medium" data-i18n="totals">ยอดรวม</div>
            <div class="p-4 space-y-2 text-sm">
              <div class="flex justify-between"><span data-i18n="subtotal">รวมสินค้า</span><span id="coSubtotal">฿0.00</span></div>
              <div class="flex justify-between"><span data-i18n="shipping">ค่าส่ง</span><span id="coShipping">฿0.00</span></div>
              <div class="border-t my-2"></div>
              <div class="flex justify-between text-base font-bold"><span data-i18n="grand_total">ยอดสุทธิ</span><span id="coGrand">฿0.00</span></div>
            </div>
          </div>
        </section>

        <!-- ที่อยู่ + วิธีชำระ -->
        <section class="md:col-span-2 space-y-3">
          <!-- Address -->
          <div class="border rounded-xl overflow-hidden">
            <div class="px-4 py-3 bg-gray-50 border-b font-medium" data-i18n="shipping_address">ที่อยู่จัดส่ง</div>
            <div class="p-4 grid grid-cols-1 gap-3" id="addrList"><!-- render by JS --></div>
          </div>
          <!-- Payment -->
          <div class="border rounded-xl overflow-hidden">
            <div class="px-4 py-3 bg-gray-50 border-b font-medium" data-i18n="payment_method">วิธีชำระเงิน</div>
            <div class="p-4 grid gap-2 text-sm">
              <label class="flex items-center gap-2">
                <input type="radio" name="paymethod" value="COD" class="form-radio w-5 h-5 text-blue-500">
                <span data-i18n="pay_cod">ชำระปลายทาง (COD)</span>
              </label>
              <label class="flex items-center gap-2">
                <input type="radio" name="paymethod" value="BANK" class="w-4 h-4">
                <span data-i18n="pay_bank">โอนผ่านบัญชีธนาคาร</span>
              </label>
              <label class="flex items-center gap-2">
                <input type="radio" name="paymethod" value="CARD" class="w-4 h-4">
                <span data-i18n="pay_card">บัตรเครดิต/เดบิต</span>
              </label>
            </div>
          </div>
        </section>
      </div>

      <!-- Footer -->
      <div class="px-4 sm:px-6 py-4 border-t bg-white flex flex-col md:flex-row items-center justify-between gap-3"
           data-modal-footer>
        <div class="text-sm text-gray-500" data-i18n="review_note">ตรวจสอบข้อมูลให้ถูกต้องก่อนยืนยัน</div>
        <div class="flex items-center gap-3 w-full md:w-auto">
          <button class="px-4 py-2 rounded-lg border hover:bg-gray-50 w-full md:w-auto
                         focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-400"
                  data-close-modal data-i18n="cancel">ยกเลิก</button>
          <button id="confirmCheckoutBtn"
                  class="btn-orange px-5 py-2.5 rounded-lg w-full md:w-auto
                         focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500"
                  data-i18n="confirm_order">
            ยืนยันสั่งซื้อ
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
/* ================== MODAL OPEN/CLOSE (accessibility + drag-to-close + --vh fix) ================== */
(function(){
  const modal = document.getElementById('checkoutModal');
  const panel = modal?.querySelector('[data-modal-panel]');
  const openBtn = document.getElementById('checkoutBtn'); // ปุ่มเปิด (ถ้ามี)
  const closeBtns = modal?.querySelectorAll('[data-close-modal]');
  const handle = modal?.querySelector('[data-drag-handle]');

  // mobile 100vh fix
  function setVH(){ document.documentElement.style.setProperty('--vh', (window.innerHeight*0.01)+'px'); }
  setVH(); window.addEventListener('resize', setVH, { passive:true });

  let lastActive = null;
  const FOCUSABLE = [
    'a[href]','button:not([disabled])','input:not([disabled])',
    'select:not([disabled])','textarea:not([disabled])',
    '[tabindex]:not([tabindex="-1"])'
  ].join(',');

  function lockScroll(lock){
    document.documentElement.classList.toggle('overflow-hidden', lock);
    document.body.classList.toggle('overflow-hidden', lock);
    document.body.classList.toggle('touch-pan-y', !lock);
  }

  function trapFocus(e){
    if (!modal || modal.classList.contains('hidden')) return;
    if (e.key !== 'Tab') return;
    const els = modal.querySelectorAll(FOCUSABLE);
    if (!els.length) return;
    const first = els[0], last = els[els.length - 1];
    if (e.shiftKey && document.activeElement === first){ e.preventDefault(); last.focus(); }
    else if (!e.shiftKey && document.activeElement === last){ e.preventDefault(); first.focus(); }
  }

  function openModal(triggerEl){
    if (!modal) return;
    lastActive = triggerEl || document.activeElement;
    modal.classList.remove('hidden');
    lockScroll(true);

    const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (!reduce && panel){
      panel.style.transform = 'translateY(20px)';
      requestAnimationFrame(()=>{ panel.style.transform = 'translateY(0)'; });
    }
    setTimeout(()=>{ (modal.querySelector(FOCUSABLE) || panel)?.focus?.(); }, 0);

    document.addEventListener('keydown', onKey);
    document.addEventListener('keydown', trapFocus, true);
  }

  function closeModal(){
    if (!modal) return;
    const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (!reduce && panel){
      panel.style.transform = 'translateY(20px)';
      setTimeout(hideNow, 140);
    } else hideNow();

    function hideNow(){
      modal.classList.add('hidden');
      panel && (panel.style.transform = '');
      lockScroll(false);
      document.removeEventListener('keydown', onKey);
      document.removeEventListener('keydown', trapFocus, true);
      if (lastActive && typeof lastActive.focus === 'function') lastActive.focus();
    }
  }
  function onKey(e){ if (e.key === 'Escape') closeModal(); }

  // hooks
  if (openBtn) openBtn.addEventListener('click', (e)=>openModal(e.currentTarget));
  closeBtns?.forEach(btn => btn.addEventListener('click', closeModal));
  modal?.addEventListener('click', (e)=>{ if (e.target && e.target.hasAttribute('data-close-modal')) closeModal(); });

  // Drag-to-close (mobile)
  (function enableDragToClose(){
    const area = handle || panel; if (!area || !panel) return;
    let startY = 0, currentY = 0, dragging = false, startTime = 0;
    const maxTranslate = 120; const threshold = 60;
    function onStart(ev){
      const t = ev.touches ? ev.touches[0] : ev;
      dragging = true; startY = t.clientY; currentY = startY; startTime = Date.now();
      panel.style.transition = 'none';
      window.addEventListener('mousemove', onMove, { passive:false });
      window.addEventListener('touchmove', onMove, { passive:false });
      window.addEventListener('mouseup', onEnd);
      window.addEventListener('touchend', onEnd);
    }
    function onMove(ev){
      if (!dragging) return;
      const t = ev.touches ? ev.touches[0] : ev;
      currentY = t.clientY;
      const dy = Math.max(0, currentY - startY);
      if (dy > 0) ev.preventDefault();
      panel.style.transform = `translateY(${Math.min(maxTranslate, dy)}px)`;
    }
    function onEnd(){
      if (!dragging) return;
      const dy = Math.max(0, currentY - startY);
      const dt = Math.max(1, Date.now() - startTime);
      const velocity = dy / dt;
      dragging = false;
      panel.style.transition = '';
      panel.style.transform = '';
      if (dy >= threshold || velocity > 0.8){ closeModal(); }
      window.removeEventListener('mousemove', onMove);
      window.removeEventListener('touchmove', onMove);
      window.removeEventListener('mouseup', onEnd);
      window.removeEventListener('touchend', onEnd);
    }
    area.addEventListener('mousedown', onStart);
    area.addEventListener('touchstart', onStart, { passive:true });
  })();

  // Expose API
  window.checkoutModal = { open: openModal, close: closeModal };
})();
</script>

<script>
/* ================== CART CHECKOUT SCRIPT (addresses + confirm guard) ================== */
(function () {
  /* ---- ROUTES (Blade) ---- */
  const ROUTES = {
    addresses: '{{ route("profile.addresses") }}', // returns: { main:{...}? or main_address:{...}?, subs:[...] }
    checkout : '{{ route("cart.checkout") }}'      // expects: { iditems[], address_key, paymethod }
  };
  const EDIT_ADDR_URL = '{{ route("profile.edit") }}';

  /* ---- Elements ---- */
  const addrListEl  = document.getElementById('addrList');
  const checkoutBtn = document.getElementById('checkoutBtn');
  const confirmBtn  = document.getElementById('confirmCheckoutBtn');
  const cartMount   = document.getElementById('cartMount');
  const csrfToken   = document.querySelector('meta[name="csrf-token"]')?.content || '';

  /* ---- STATE (from cart) ---- */
  window.STATE = window.STATE || { idcustomer:null, items:[], totalQty:0, subtotal:0 };

  let HAS_ANY_ADDRESS = false;

  /* ===== Helpers ===== */
  const esc = (s) => String(s ?? '').replace(/[&<>"']/g, m => ({
    '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'
  }[m]));
  const truthy = (v) => String(v ?? '').trim() !== '';
  const isAddressUsable = (a) => {
    if (!a || typeof a !== 'object') return false;
    return truthy(a.line1) || truthy(a.subdistrict) || truthy(a.district) ||
           truthy(a.province) || truthy(a.zip) || truthy(a.country) ||
           truthy(a.phone) || truthy(a.name);
  };
  const fmtAddr = (a) => {
    const p = [];
    if (a?.line1)       p.push(esc(a.line1));
    if (a?.subdistrict) p.push('ต.' + esc(a.subdistrict));
    if (a?.district)    p.push('อ.' + esc(a.district));
    if (a?.province)    p.push('จ.' + esc(a.province));
    if (a?.zip)         p.push(esc(a.zip));
    if (a?.country)     p.push(esc(a.country));
    return p.join(' ');
  };
  function setConfirmEnabled(enabled){
    if (!confirmBtn) return;
    confirmBtn.disabled = !enabled;
    confirmBtn.classList.toggle('opacity-50', !enabled);
    confirmBtn.classList.toggle('cursor-not-allowed', !enabled);
    confirmBtn.setAttribute('aria-disabled', String(!enabled));
  }
  function getSelectedIdxs(){
    if (!cartMount) return [];
    return [...cartMount.querySelectorAll('.item-chk:checked')].map(c => +c.dataset.index);
  }
  function getSelectedItemIds(){
    const idxs = getSelectedIdxs();
    return idxs.map(i => window.STATE.items?.[i]?.iditem).filter(Boolean);
  }
  function getSelectedAddressKey(){
    const rb = document.querySelector('#addrList input[name="shipaddr"]:checked');
    return rb ? rb.value : null;
  }
  function requireAddressOrRedirect(){
    if (!HAS_ANY_ADDRESS){
      alert('กรุณาเพิ่มที่อยู่จัดส่งก่อนทำรายการ');
      if (EDIT_ADDR_URL) window.location.assign(EDIT_ADDR_URL);
      return false;
    }
    const key = getSelectedAddressKey();
    if (!key){ alert('กรุณาเลือกที่อยู่จัดส่ง'); return false; }
    return true;
  }

  /* ===== Address Loading / Rendering ===== */
  async function fetchAddresses(){
    const res = await fetch(ROUTES.addresses, {
      headers: { 'Accept': 'application/json' },
      credentials: 'same-origin'
    });
    if (!res.ok) throw new Error('HTTP ' + res.status);
    return res.json();
  }

  const addAddressCardHTML = `
    <button id="addAddrCard" type="button"
      class="border rounded-xl p-3 w-full text-left hover:bg-orange-50 flex items-center gap-3">
      <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg border">
        <i class="bi bi-plus-lg"></i>
      </span>
      <div>
        <div class="font-semibold">Add an address</div>
        <div class="text-sm text-gray-600">Go to the address settings page to add new information.</div>
      </div>
    </button>`;

  function renderAddresses(data){
    if (!addrListEl) return;

    const mainRaw = data?.main ?? data?.main_address ?? null;
    const hasMain = isAddressUsable(mainRaw);

    const subsRaw = Array.isArray(data?.subs) ? data.subs : [];
    const subs = subsRaw.filter(isAddressUsable);

    const list = [];
    if (hasMain) list.push({ key:'main', ...mainRaw, tag:'ค่าเริ่มต้น' });
    subs.forEach(s => list.push({ key:String(s.idsubaddress ?? s.key ?? ''), ...s }));

    HAS_ANY_ADDRESS = list.length > 0;

    if (!HAS_ANY_ADDRESS){
      addrListEl.innerHTML = addAddressCardHTML;
    } else {
      const itemsHTML = list.map((a, i) => `
        <label class="border rounded-xl p-3 flex gap-3 items-start hover:bg-orange-50 cursor-pointer">
          <input type="radio" name="shipaddr" class="mt-1.5" value="${esc(a.key)}" ${i===0 ? 'checked' : ''}>
          <div class="min-w-0">
            <div class="flex items-center gap-2 flex-wrap">
              <span class="font-semibold">${esc(a.name || '-')}</span>
              ${a.phone ? `<span class="text-sm text-gray-600">(${esc(a.phone)})</span>` : ''}
              ${a.tag ? `<span class="text-[11px] px-2 py-0.5 rounded-full bg-gray-100 text-gray-600 border">${esc(a.tag)}</span>` : ''}
            </div>
            <div class="text-sm text-gray-700 break-words">${fmtAddr(a) || '-'}</div>
            ${a.email ? `<div class="text-xs text-gray-500 mt-0.5">${esc(a.email)}</div>` : ''}
          </div>
        </label>
      `).join('');
      const addMoreHTML = `
        <button id="addAddrCard" type="button"
          class="mt-2 text-[13px] text-orange-600 hover:text-orange-700 underline underline-offset-2">
          + Add another address
        </button>`;
      addrListEl.innerHTML = itemsHTML + addMoreHTML;
    }

    const addBtn = document.getElementById('addAddrCard');
    if (addBtn){
      addBtn.addEventListener('click', () => {
        sessionStorage.setItem('after_addr_edit', '1');
        window.location.assign(EDIT_ADDR_URL);
      });
    }

    setConfirmEnabled(HAS_ANY_ADDRESS);
  }

  async function ensureAddressListLoaded(){
    if (!addrListEl) return;
    try{
      const data = await fetchAddresses();
      renderAddresses(data);
    }catch(e){
      console.error(e);
      addrListEl.innerHTML = `<div class="text-sm text-red-600">โหลดที่อยู่ไม่สำเร็จ</div>`;
      HAS_ANY_ADDRESS = false;
      setConfirmEnabled(false);
    }
  }

  /* ===== Create Order ===== */
  async function createOrder(ids){
    const key = getSelectedAddressKey();
    if (!key){
      const err = new Error('no_address'); err.code = 'no_address'; throw err;
    }
    const res = await fetch(ROUTES.checkout, {
      method: 'POST',
      credentials: 'same-origin',
      headers: {
        'Accept':'application/json','Content-Type':'application/json','X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify({
        iditems: ids,
        address_key: key,
        paymethod: document.querySelector('input[name="paymethod"]:checked')?.value || 'COD'
      })
    });
    const ct = res.headers.get('content-type') || '';
    const json = ct.includes('application/json') ? await res.json() : { success:false, error: await res.text() };
    if (!res.ok || !json.success){
      console.error('checkout error:', json);
      const msg = json.message || json.error || 'ไม่ทราบสาเหตุ';
      throw new Error(msg);
    }
    return json;
  }

  /* ===== Events / Hooks ===== */
  if (checkoutBtn){
    checkoutBtn.addEventListener('click', () => {
      ensureAddressListLoaded();
    });
  }

  // กลับจากหน้าเพิ่มที่อยู่ => โหลดใหม่อัตโนมัติ
  function reloadIfBackFromEdit(){
    if (sessionStorage.getItem('after_addr_edit') === '1'){
      ensureAddressListLoaded().finally(() => {
        sessionStorage.removeItem('after_addr_edit');
      });
    }
  }
  window.addEventListener('pageshow', reloadIfBackFromEdit);
  window.addEventListener('focus', reloadIfBackFromEdit);
  document.addEventListener('visibilitychange', () => {
    if (document.visibilityState === 'visible') reloadIfBackFromEdit();
  });

  if (confirmBtn){
    // เริ่มต้นปิดไว้ก่อนจนกว่าจะรู้ว่ามี address
    setConfirmEnabled(false);

    confirmBtn.addEventListener('click', async () => {
      try{
        if (!requireAddressOrRedirect()) return;

        const ids = getSelectedItemIds();
        if (!ids.length){ alert('กรุณาเลือกสินค้า'); return; }

        setConfirmEnabled(false);

        const out = await createOrder(ids);

        // กลับไป marketplace (แก้ route ให้ตรงของจริง)
        window.location.assign('{{ route("test.FLUKE_Marketplace") }}');

        if (out.cart){
          window.STATE.items    = Array.isArray(out.cart.items) ? out.cart.items : [];
          window.STATE.totalQty = Number(out.cart.totalQty ?? 0);
          window.STATE.subtotal = Number(out.cart.subtotal ?? 0);
        }
        if (typeof window.render === 'function') window.render();

        document.getElementById('closeCheckoutModal')?.click();
      }catch(err){
        console.error(err);
        const m = String(err.message || err.code || '');
        if (m.includes('no_address'))      alert('กรุณาเพิ่ม/เลือกที่อยู่จัดส่ง');
        else if (m.includes('no_items'))   alert('กรุณาเลือกสินค้า');
        else                               alert('สร้างออเดอร์ไม่สำเร็จ');
      }finally{
        setConfirmEnabled(HAS_ANY_ADDRESS);
      }
    });
  }
})();
</script>




@include('test.footer')

<script>
  // Swiper (เฉพาะเมื่อมี)
  document.addEventListener('DOMContentLoaded', function(){
    if (document.querySelector('.mySwiper') && typeof Swiper !== 'undefined') {
      new Swiper('.mySwiper', {
        loop:true,
        pagination:{ el:'.swiper-pagination', clickable:true },
        autoplay:{ delay:3500, disableOnInteraction:false },
        effect:'fade', fadeEffect:{ crossFade:true }, speed:700
      });
    }
  });

  /* ==================== I18N (ย่อ) ==================== */
  const I18N = {
    'ไทย': {
      brand_name:'FLUKE',
      top_buyer_central:'Buyer Central', top_help:'Help', top_get_app:'Get the App', top_choose_lang:'เลือกภาษา',
      top_login:'เข้าสู่ระบบ', top_join_free:'สมัครสมาชิกฟรี',
      nav_all_categories:'หมวดหมู่ทั้งหมด',
      cat_left_1:'แคลมป์มิเตอร์', cat_left_2:'มัลติมิเตอร์', cat_left_3:'เครื่องตรวจไฟ/ทดสอบไฟฟ้า', cat_left_4:'เครื่องวัดฉนวน', cat_left_5:'กล้องถ่ายภาพความร้อน',
      search_placeholder:'คุณต้องการให้เราช่วยค้นหาอะไร', search_btn:'ค้นหา',
      promo1_title:'ข้อเสนอพิเศษ', promo1_sub:'ประหยัดกว่าเดิม',
      promo2_title:'สินค้าใหม่ล่าสุด', promo2_sub:'อัปเดตทุกสัปดาห์',
      flash_title:'Flash Deals', flash_view_all:'ดูทั้งหมด', deal_name:'ชื่อสินค้า',
      cat_title:'หมวดหมู่สินค้า',
      footer_contact:'ติดต่อเรา', footer_branch:'สาขาของเรา', footer_social:'Facebook / YouTube',
      footer_service:'บริการของเรา', footer_calib:'ห้องปฏิบัติการสอบเทียบ', footer_promo:'สินค้าโปรโมชั่น',
      footer_warranty:'การรับประกันสินค้า', footer_repair:'บริการซ่อมแซม',
      footer_info:'ข้อมูล', footer_ship:'ค่าขนส่ง', footer_terms:'ข้อกำหนด / ความเป็นส่วนตัว',
      footer_order:'วิธีการสั่งซื้อ', footer_faq:'คำถามที่พบบ่อย',
      footer_payment:'วิธีชำระเงิน', footer_cards:'Visa / Mastercard / โอนเงิน',
      footer_transfer:'รองรับการโอนผ่านบัญชีบริษัท', footer_cod:'เงินสดปลายทาง',
      copyright:'© 2024 FLUKE. สงวนลิขสิทธิ์ทั้งหมด',
      col_product:'สินค้า', col_price_each:'ราคาต่อชิ้น', col_qty:'จำนวน', col_line_total:'ราคารวม', col_actions:'การจัดการ',
      select_all:'เลือกทั้งหมด', remove_selected:'ลบรายการที่เลือก', items:'รายการ',
      summary_subtotal:'รวม', shipping_label:'ค่าส่ง', shipping_reason:'ยอดสั่งซื้อต่ำกว่า ฿1,500', summary_total:'ยอดสุทธิ',
      checkout_btn:'ชำระเงิน', empty_cart:'ยังไม่มีสินค้าในตะกร้า',
      badge_warranty:'รับประกัน 1 ปี', action_remove:'ลบ', action_save_later:'',
      top_user:'ผู้ใช้', top_logout:'ออกจากระบบ',
      coupon_prefix:'คูปองร้าน FLUKE:', coupon_text:'ซื้อขั้นต่ำ ฿1,500 ส่งฟรี', label_profile:'โปรไฟล์',  title: "สรุปคำสั่งซื้อ",
      close: "ปิด",
      selected_items: "สินค้าที่เลือก",
      totals: "ยอดรวม",
      subtotal: "รวมสินค้า",
      shipping: "ค่าส่ง",
      grand_total: "ยอดสุทธิ",
      shipping_address: "ที่อยู่จัดส่ง",
      payment_method: "วิธีชำระเงิน",
      pay_cod: "ชำระปลายทาง (COD)",
      pay_bank: "โอนผ่านบัญชีธนาคาร",
      pay_card: "บัตรเครดิต/เดบิต",
      review_note: "ตรวจสอบข้อมูลให้ถูกต้องก่อนยืนยัน",
      cancel: "ยกเลิก",
      confirm_order: "ยืนยันสั่งซื้อ"
    },
    'English': {
      brand_name:'FLUKE',
      top_buyer_central:'Buyer Central', top_help:'Help', top_get_app:'Get the App', top_choose_lang:'Choose language',
      top_login:'Login', top_join_free:'Join Free',
      nav_all_categories:'All categories',
      col_product:'Product', col_price_each:'Unit price', col_qty:'Quantity', col_line_total:'Line total', col_actions:'Actions',
      select_all:'Select all', remove_selected:'Remove selected', items:'item(s)',
      summary_subtotal:'Subtotal', shipping_label:'Shipping', shipping_reason:'(Total order less than ฿1,500)', summary_total:'Total',
      checkout_btn:'Checkout', empty_cart:'Your cart is empty',
      badge_warranty:'1 year warranty', action_remove:'Remove', action_save_later:'',
      top_user:'user', top_logout:'Sign out',
      coupon_prefix:'FLUKE Coupon:', coupon_text:'Free shipping over ฿1,500', label_profile:'Profile', title: "Order Summary",
      close: "Close",
      selected_items: "Selected Items",
      totals: "Totals",
      subtotal: "Subtotal",
      shipping: "Shipping",
      grand_total: "Grand Total",
      shipping_address: "Shipping Address",
      payment_method: "Payment Method",
      pay_cod: "Cash on Delivery (COD)",
      pay_bank: "Bank Transfer",
      pay_card: "Credit/Debit Card",
      review_note: "Please review your details before confirming.",
      cancel: "Cancel",
      confirm_order: "Confirm Order"
    }
  };

  function applyI18n(lang){
    const dict = I18N[lang] || I18N['ไทย'];
    document.documentElement.lang = (lang === 'ไทย') ? 'th' : 'en';
    document.title = (lang === 'ไทย') ? 'FLUKE | ตะกร้าสินค้า' : 'FLUKE | Shopping Cart';

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
  function t(key){
    const lang = localStorage.getItem('site_lang') || localStorage.getItem('preferredLanguage') || 'ไทย';
    const dict = I18N[lang] || I18N['ไทย'];
    return (dict && key in dict) ? dict[key] : (I18N['ไทย'][key] ?? key);
  }
  window.applyI18n = applyI18n;
  window.t = t;

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

<!-- ===== Cart Badge (DB) ===== -->
<script>
(function(){
  const ROUTES = { list: '{{ route("cart.json") }}' };
  const badge = document.querySelector('a[aria-label="cart"] span');

  async function refreshBadge(){
    try{
      const res = await fetch(ROUTES.list, {headers:{'Accept':'application/json'}, credentials:'same-origin'});
      if(!res.ok) return;
      const ct = res.headers.get('content-type')||'';
      if(!ct.includes('application/json')) return;
      const data = await res.json();
      if (badge){
        badge.textContent = String(data?.totalQty || 0);
        badge.style.transform = 'scale(1.15)';
        badge.style.transition = 'transform .13s';
        setTimeout(()=> badge.style.transform = 'scale(1)', 130);
      }
    }catch(_){}}

  document.addEventListener('DOMContentLoaded', refreshBadge);
  window.addEventListener('focus', refreshBadge);
})();
</script>

<!-- ===== Cart UI ===== -->
<script>
(function(){
  const EXCHANGE = 38;
  const THRESHOLD_FREE = 1500;
  const SHIPPING_FEE_THB = 200;

  const ROUTES = {
    list   : '{{ route("cart.json") }}',
    qty    : '{{ route("cart.qty") }}',
    remove : '{{ route("cart.remove") }}',
    removeMany : '{{ route("cart.removeMany") ?? "#" }}',
    checkout: '{{ route("cart.checkout") }}',
    addresses: '{{ route("profile.addresses") }}'
  };

  const t = window.t || (k=>k);
  const applyI18n = window.applyI18n || (()=>{});

  const getLang = () => localStorage.getItem('site_lang') || localStorage.getItem('preferredLanguage') || 'ไทย';
  const fmtTHB = v => new Intl.NumberFormat('th-TH', {
    style:'currency',
    currency:'THB',
    minimumFractionDigits: 2,
    maximumFractionDigits: 2
  }).format(v || 0);
  const fmtUSD = v => new Intl.NumberFormat('en-US',{style:'currency',currency:'USD',minimumFractionDigits:2,maximumFractionDigits:2}).format(v||0);
  const toUSD = (thb)=>{ if(!Number.isFinite(thb)) return 0; const sat = Math.round(thb*100); const cents=Math.ceil(sat/EXCHANGE); return cents/100; };
  const money = (thb)=> (getLang()==='English'? fmtUSD(toUSD(thb)) : fmtTHB(thb));

  const el = {
    mount: document.getElementById('cartMount'),
    selectAllTop: document.getElementById('selectAllTop'),
    selectAllBottom: document.getElementById('selectAllBottom'),
    removeSelected: document.getElementById('removeSelected'),
    allCount: document.getElementById('allCount'),
    selItems: document.getElementById('selItems'),
    grandSubtotal: document.getElementById('grandSubtotal'),
    grandTotal: document.getElementById('grandTotal'),
    shippingRow: document.getElementById('shippingRow'),
    shippingAmount: document.getElementById('shippingAmount'),
    shippingLabel: document.getElementById('shippingLabel'),
    shippingReason: document.getElementById('shipping_reason'),
    checkoutBtn: document.getElementById('checkoutBtn'),
    badge: document.querySelector('a[aria-label="cart"] span'),
    cartScroll: document.getElementById('cartScroll'),
    summarySticky: document.getElementById('summarySticky'),
    shopSelect: document.getElementById('shopSelect'),
    shopCoupon: document.getElementById('shopCoupon'),
  };

  const STATE = { idcustomer:null, items:[], totalQty:0, subtotal:0 };
  window.STATE = STATE;
  const csrf = ()=> document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

  async function apiGET(url){
    const res = await fetch(url,{method:'GET',credentials:'same-origin',headers:{'Accept':'application/json'}});
    const ct = res.headers.get('content-type')||'';
    if(!res.ok){ throw new Error(await res.text()); }
    if(!ct.includes('application/json')){ throw new Error('Expected JSON'); }
    return res.json();
  }
  async function apiPOST(url, data){
    const res = await fetch(url,{
      method:'POST',credentials:'same-origin',
      headers:{'Accept':'application/json','Content-Type':'application/json','X-CSRF-TOKEN':csrf()},
      body: JSON.stringify(data||{})
    });
    const ct = res.headers.get('content-type')||'';
    if(!res.ok){ throw new Error(await res.text()); }
    if(!ct.includes('application/json')){ throw new Error('Expected JSON'); }
    return res.json();
  }
  async function apiDELETE(url, data){
    const res = await fetch(url,{
      method:'DELETE',credentials:'same-origin',
      headers:{'Accept':'application/json','Content-Type':'application/json','X-CSRF-TOKEN':csrf()},
      body: JSON.stringify(data||{})
    });
    const ct = res.headers.get('content-type')||'';
    if(!res.ok){ throw new Error(await res.text()); }
    if(!ct.includes('application/json')){ throw new Error('Expected JSON'); }
    return res.json();
  }

  function updateBadge(n){
    if(!el.badge) return;
    el.badge.textContent = String(Number(n||0));
    el.badge.style.transform = 'scale(1.15)';
    el.badge.style.transition = 'transform .13s';
    setTimeout(()=> el.badge.style.transform='scale(1)',130);
  }

  async function fetchCart(){
    const data = await apiGET(ROUTES.list);
    STATE.idcustomer = data.idcustomer ?? null;
    STATE.items      = Array.isArray(data.items)? data.items : [];
    STATE.totalQty   = Number(data.totalQty||0);
    STATE.subtotal   = Number(data.subtotal||0);
    updateBadge(STATE.totalQty);
  }

  // คำนวณพื้นที่เลื่อนของ list โดยเผื่อความสูง summary และคูปอง
  function sizeCartScroll(){
    const list = el.cartScroll;
    if(!list) return;

    const bottomH = el.summarySticky ? el.summarySticky.offsetHeight : 0;
    const couponH = el.shopCoupon ? el.shopCoupon.offsetHeight : 0;
    const rect = list.getBoundingClientRect();
    const top  = rect.top;
    const avail = window.innerHeight - top - bottomH - couponH - 16; // กันชน 16px
    list.style.maxHeight = Math.max(320, avail) + 'px';
  }

  function render(){
    const items = STATE.items;
    if(el.allCount) el.allCount.textContent = items.length;
    if(!el.mount) return;

    el.mount.innerHTML = '';
    if(!items.length){
      el.mount.innerHTML = `<div class="p-10 text-center text-gray-500" data-i18n="empty_cart">${t('empty_cart')}</div>`;
      syncSummary();
      sizeCartScroll();
      return;
    }

    // ✅ เรนเดอร์เฉพาะ “แถวสินค้า” ใน #cartScroll เท่านั้น
    items.forEach((it, idx)=>{
      const priceEach = Number(it.webpriceTHB||0);
      const baseOld   = Number(it.basepriceTHB||0);
      const qty       = Number(it.quantity||1);
      const line      = priceEach * qty;

      const row = document.createElement('div');
      row.className = 'cart-row';
      row.innerHTML = `
        <div>
          <input type="checkbox" class="w-4 h-4 item-chk" data-index="${idx}" aria-label="select item">
        </div>

        <div class="flex items-center gap-3">
          <div class="thumb">${it.pic ? `<img src="${it.pic}" alt="" class="w-full h-full object-contain">` : ''}</div>
          <div class="min-w-0">
            <div class="font-semibold line-1">${it.name||'—'}</div>
            <div class="mt-1 perk-badge"><i class="bi bi-shield-check"></i> <span data-i18n="badge_warranty">${t('badge_warranty')}</span></div>
          </div>
        </div>

        <div class="text-center price-cell">
          ${baseOld ? `<div class="price-old old">${money(baseOld)}</div>` : ``}
          <div class="font-semibold now">${money(priceEach)}</div>
        </div>

        <div class="text-center">
          <div class="inline-flex items-center gap-1">
            <button class="qty-btn" data-act="dec" data-iditem="${it.iditem}" data-index="${idx}" type="button" aria-label="decrease">−</button>
            <span class="inline-block w-9 text-center">${qty}</span>
            <button class="qty-btn" data-act="inc" data-iditem="${it.iditem}" data-index="${idx}" type="button" aria-label="increase">+</button>
          </div>
        </div>

        <div class="text-center font-extrabold text-[var(--brand)]">${money(line)}</div>

        <div class="text-center">
          <button class="text-[#ef4444] hover:underline rm" data-iditem="${it.iditem}" data-index="${idx}" type="button" data-i18n="action_remove">${t('action_remove')}</button>
        </div>`;
      el.mount.appendChild(row);
    });

    syncSummary();
    sizeCartScroll();
  }

  function selectedIdx(){ return [...document.querySelectorAll('.item-chk:checked')].map(c=>+c.dataset.index); }

  function syncSelectAll(){
    const all = document.querySelectorAll('.item-chk');
    const on  = document.querySelectorAll('.item-chk:checked');
    const full = all.length && all.length===on.length;

    [el.selectAllTop, el.selectAllBottom].forEach(x=>{
      if(!x) return; x.checked = full; x.indeterminate = (!full && on.length>0);
    });

    // ✅ sync หัวร้าน (shopSelect)
    if (el.shopSelect){
      el.shopSelect.checked = full;
      el.shopSelect.indeterminate = (!full && on.length>0);
    }
  }

  function computeSubtotalTHB(){
    const idxs = selectedIdx();
    const subtotal = idxs.reduce((s,i)=>{
      const it = STATE.items[i]; if(!it) return s;
      return s + Number(it.webpriceTHB||0) * Number(it.quantity||1);
    },0);
    return { subtotalTHB: subtotal, count: idxs.length, idxs };
  }

  function syncSummary(){
    const { subtotalTHB, count } = computeSubtotalTHB();
    const shippingTHB = (subtotalTHB > 0 && subtotalTHB < THRESHOLD_FREE) ? SHIPPING_FEE_THB : 0;
    const grandTHB = subtotalTHB + shippingTHB;

    document.querySelectorAll('[data-i18n="summary_subtotal"]').forEach(n=> n.textContent = t('summary_subtotal'));
    document.querySelectorAll('[data-i18n="items"]').forEach(n=> n.textContent = t('items'));
    document.querySelectorAll('[data-i18n="summary_total"]').forEach(n=> n.textContent = t('summary_total'));
    document.querySelectorAll('[data-i18n="checkout_btn"]').forEach(n=> n.textContent = t('checkout_btn'));

    if (el.selItems)       el.selItems.textContent = String(count);
    if (el.grandSubtotal)  el.grandSubtotal.textContent = money(subtotalTHB);
    if (el.grandTotal)     el.grandTotal.textContent = money(grandTHB);

    if (el.shippingRow){
      if (shippingTHB > 0){
        if (el.shippingAmount) el.shippingAmount.textContent = money(shippingTHB);
        if (el.shippingLabel)  el.shippingLabel.textContent = t('shipping_label');
        if (el.shippingReason) el.shippingReason.textContent = t('shipping_reason');
        el.shippingRow.classList.remove('hidden');
      } else {
        el.shippingRow.classList.add('hidden');
      }
    }

    if (el.checkoutBtn) el.checkoutBtn.disabled = count===0;
    syncSelectAll();
  }

  async function setQty(iditem, newQty){
    if (!iditem) throw new Error('missing iditem');
    const data = await apiPOST(ROUTES.qty, { iditem: String(iditem), quantity: String(Math.max(1,Number(newQty)||1)) });
    STATE.items    = data.items || STATE.items;
    STATE.totalQty = Number(data.totalQty || 0);
    STATE.subtotal = Number(data.subtotal || 0);
    updateBadge(STATE.totalQty);
    render();
  }

  async function removeOne(iditem){
    const data = await apiDELETE(ROUTES.remove, { iditem: String(iditem) });
    STATE.items    = data.items || STATE.items.filter(x=> x.iditem!==iditem);
    STATE.totalQty = Number(data.totalQty || 0);
    STATE.subtotal = Number(data.subtotal || 0);
    updateBadge(STATE.totalQty);
    render();
  }

  async function removeMany(iditems){
    if (!iditems?.length) return;
    if (ROUTES.removeMany === '#'){
      for (const id of iditems){ await removeOne(id); }
      return;
    }
    const data = await apiPOST(ROUTES.removeMany, { iditems: iditems.map(String) });
    STATE.items    = data.items || STATE.items.filter(x=> !iditems.includes(x.iditem));
    STATE.totalQty = Number(data.totalQty || 0);
    STATE.subtotal = Number(data.subtotal || 0);
    updateBadge(STATE.totalQty);
    render();
  }

  document.addEventListener('change', (e)=>{
    const tEl = e.target;

    if (tEl.classList.contains('item-chk')){ syncSummary(); return; }

    // ✅ หัวร้าน: เลือก/ยกเลิกรายการทั้งหมด
    if (tEl===el.shopSelect){
      const st = el.shopSelect.checked;
      document.querySelectorAll('.item-chk').forEach(c=> c.checked = st);
      syncSummary(); return;
    }

    if (tEl===el.selectAllTop || tEl===el.selectAllBottom){
      const st = tEl.checked;
      document.querySelectorAll('.item-chk').forEach(c=> c.checked = st);
      if (el.shopSelect){ el.shopSelect.checked = st; el.shopSelect.indeterminate = false; }
      syncSummary(); return;
    }
  });

  document.addEventListener('click', async (e)=>{
    const q  = e.target.closest('.qty-btn');
    const rm = e.target.closest('.rm');

    if (q){
      const idx   = +q.dataset.index;
      const act   = q.dataset.act;
      const item  = STATE.items[idx];
      if(!item) return;
      const nextQ = Math.max(1, Number(item.quantity||1) + (act==='inc'?1:-1));
      try { await setQty(item.iditem, nextQ); }
      catch(err){ alert(err?.message || 'อัปเดตจำนวนไม่สำเร็จ'); }
    }

    if (rm){
      const idx   = +rm.dataset.index;
      const item  = STATE.items[idx];
      if(!item) return;
      try { await removeOne(item.iditem); }
      catch(err){ alert(err?.message || 'ลบสินค้าไม่สำเร็จ'); }
    }
  });

  if (el.removeSelected){
    el.removeSelected.addEventListener('click', async ()=>{
      const idxs = selectedIdx();
      if (!idxs.length) return;
      const ids = idxs.map(i => STATE.items[i]?.iditem).filter(Boolean);
      try { await removeMany(ids); }
      catch(err){ alert(err?.message || 'ลบหลายรายการไม่สำเร็จ'); }
    });
  }

  // === Checkout Modal ===
  const co = {
    modal: document.getElementById('checkoutModal'),
    items: document.getElementById('coItems'),
    subtotal: document.getElementById('coSubtotal'),
    shipping: document.getElementById('coShipping'),
    grand: document.getElementById('coGrand'),
    closeBtn: document.getElementById('closeCheckoutModal'),
    confirmBtn: document.getElementById('confirmCheckoutBtn'),
    addr: {
      name: document.getElementById('addr_name'),
      phone: document.getElementById('addr_phone'),
      line1: document.getElementById('addr_line1'),
      subdistrict: document.getElementById('addr_subdistrict'),
      district: document.getElementById('addr_district'),
      province: document.getElementById('addr_province'),
      zip: document.getElementById('addr_zip'),
      save: document.getElementById('addr_save')
    }
  };

  function bodyScrollLock(lock){
    document.documentElement.style.overflow = lock ? 'hidden' : '';
    document.body.style.overflow = lock ? 'hidden' : '';
  }

  function openCheckoutModal(payload){
    if (!co.modal) return;
    renderCheckoutModal(payload);
    co.modal.classList.remove('hidden');
    bodyScrollLock(true);
  }

  function closeCheckoutModal(){
    if (!co.modal) return;
    co.modal.classList.add('hidden');
    bodyScrollLock(false);
  }

  function renderCheckoutModal({ items, subtotalTHB, shippingTHB, grandTHB }){
    // รายการสินค้า
    if (co.items){
      co.items.innerHTML = items.map(it=>{
        const qty = Number(it.quantity||1);
        const price = Number(it.webpriceTHB||0);
        const line = price*qty;
        return `
          <div class="p-3 flex items-center gap-3">
            <div class="w-14 h-14 rounded-lg border bg-gray-50 overflow-hidden shrink-0">
              ${it.pic? `<img src="${it.pic}" class="w-full h-full object-contain">` : ``}
            </div>
            <div class="min-w-0 flex-1">
              <div class="font-medium truncate">${it.name||'—'}</div>
              <div class="text-sm text-gray-500">x ${qty}</div>
            </div>
            <div class="font-semibold shrink-0">${money(line)}</div>
          </div>
        `;
      }).join('');
    }
    if (co.subtotal) co.subtotal.textContent = money(subtotalTHB);
    if (co.shipping) co.shipping.textContent = money(shippingTHB);
    if (co.grand)    co.grand.textContent    = money(grandTHB);

    // โหลดที่อยู่จาก localStorage (ครั้งก่อน)
    try{
      const saved = JSON.parse(localStorage.getItem('checkout_address')||'null');
      if (saved){
        co.addr.name.value = saved.name||'';
        co.addr.phone.value = saved.phone||'';
        co.addr.line1.value = saved.line1||'';
        co.addr.subdistrict.value = saved.subdistrict||'';
        co.addr.district.value = saved.district||'';
        co.addr.province.value = saved.province||'';
        co.addr.zip.value = saved.zip||'';
      }
    }catch(_){}}

  // เปิดป๊อปอัพเมื่อกดปุ่มชำระเงิน
  if (el.checkoutBtn){
    el.checkoutBtn.addEventListener('click', ()=>{
      const idxs = selectedIdx();
      if (!idxs.length) return;

      const picked = idxs.map(i => STATE.items[i]).filter(Boolean);
      const { subtotalTHB } = computeSubtotalTHB();
      const shippingTHB = (subtotalTHB > 0 && subtotalTHB < THRESHOLD_FREE) ? SHIPPING_FEE_THB : 0;
      const grandTHB = subtotalTHB + shippingTHB;

      openCheckoutModal({ items: picked, subtotalTHB, shippingTHB, grandTHB });
    });
  }

  // ปิดป๊อปอัพ
  if (co.closeBtn) co.closeBtn.addEventListener('click', closeCheckoutModal);
  document.querySelectorAll('[data-close-modal]').forEach(elClose=>{
    elClose.addEventListener('click', closeCheckoutModal);
  });
  window.addEventListener('site_lang_changed', ()=>{ render(); });
  window.addEventListener('resize', sizeCartScroll);
  window.addEventListener('orientationchange', sizeCartScroll);
  document.addEventListener('DOMContentLoaded', sizeCartScroll);

  (async function init(){
    try { await fetchCart(); render(); }
    catch(e){ alert(e?.message || 'โหลดตะกร้าไม่สำเร็จ'); }
  })();
})();
</script>

</body>
</html>
