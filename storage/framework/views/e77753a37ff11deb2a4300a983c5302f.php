<!DOCTYPE html>
<html lang="th">
<head>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
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

<!-- ===== Top utility bar (คงเดิม) ===== -->
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

  <?php
  use Illuminate\Support\Facades\Route;

  $email    = session('customer_email');
  $username = session('customer_name');

  $profileUrl = Route::has('profile')
    ? route('profile')
    : (Route::has('profile.edit') ? route('profile.edit') : url('/profile'));
?>

<?php if(!$email): ?>
  <a href="<?php echo e(route('login')); ?>" class="hover:text-[var(--brand)]" data-i18n="top_login">เข้าสู่ระบบ</a>
  <a href="<?php echo e(route('Sign_up')); ?>" class="hover:text-[var(--brand)]" data-i18n="top_join_free">สมัครสมาชิกฟรี</a>
<?php else: ?>
  <!-- Desktop -->
  <div class="hidden md:flex items-center gap-3 min-w-0 whitespace-nowrap">
    <span class="text-sm text-gray-700 truncate max-w-[360px]">
      <span data-i18n="top_user">ผู้ใช้</span>:
      <span class="font-medium text-gray-900"><?php echo e($username); ?></span>
      <span class="text-xs text-gray-500 ml-1" title="<?php echo e($email); ?>">
        (<?php echo e(\Illuminate\Support\Str::limit($email, 25, '…')); ?>)
      </span>
    </span>

    <a href="/profile"
      class="px-3 py-1.5 rounded-lg border border-gray-200 hover:bg-orange-50 text-gray-700 inline-flex items-center gap-2"
      data-i18n="label_profile">
      <i class="bi bi-person-gear"></i>
      <span data-i18n="label_profile">โปรไฟล์</span>
    </a>

    <form method="POST" action="<?php echo e(route('logout')); ?>" class="shrink-0">
      <?php echo csrf_field(); ?>
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
      <?php echo e(\Illuminate\Support\Str::limit($username, 15, '...')); ?>

    </span>
    <i class="bi bi-caret-down-fill text-[10px]"></i>
    <span class="sr-only">(<?php echo e($email); ?>)</span>
  </button>

    <div id="userMenuDropdown"
         class="hidden absolute right-0 mt-2 w-56 bg-white border rounded-lg shadow-lg z-50">
      <div class="px-3 py-2 text-xs text-gray-500 break-all">
        <span data-i18n="top_user">ผู้ใช้</span>:
        <span class="font-medium text-gray-800"><?php echo e($username); ?></span>
      </div>
      <div class="px-3 pb-2 text-[11px] text-gray-500 break-all">
        <?php echo e($email); ?>

      </div>

      <div class="border-t"></div>

      <a href="/profile"
        class="block w-full px-4 py-2 text-sm hover:bg-orange-50 flex items-center gap-2"
        data-i18n="label_profile">
        <i class="bi bi-person-gear"></i>
        <span data-i18n="label_profile">โปรไฟล์</span>
      </a>

      <form method="POST" action="<?php echo e(route('logout')); ?>">
        <?php echo csrf_field(); ?>
        <button type="submit"
                class="w-full text-left px-4 py-2 text-sm hover:bg-orange-50 flex items-center gap-2">
          <i class="bi bi-box-arrow-right"></i>
          <span data-i18n="top_logout">ออกจากระบบ</span>
        </button>
      </form>
    </div>
  </div>
<?php endif; ?>

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

<!-- ====== CHECKOUT MODAL ====== -->
<div id="checkoutModal" class="fixed inset-0 z-[100] hidden">
  <!-- Backdrop -->
  <div class="absolute inset-0 bg-black/50" data-close-modal></div>

  <!-- Panel -->
  <div class="absolute inset-x-0 bottom-0 md:inset-0 md:flex md:items-center md:justify-center">
    <div class="bg-white md:rounded-2xl md:shadow-2xl w-full md:w-[980px] max-h-[92vh] overflow-hidden">
      <!-- Header -->
      <div class="flex items-center justify-between px-4 sm:px-6 py-3 border-b bg-gray-50">
        <h3 class="text-lg font-semibold">สรุปคำสั่งซื้อ</h3>
        <button class="text-gray-500 hover:text-gray-800" id="closeCheckoutModal" title="ปิด">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>

      <!-- Body -->
      <div class="grid md:grid-cols-5 gap-0 md:gap-6 p-4 sm:p-6 overflow-auto max-h-[calc(92vh-56px-72px)]">
        <!-- สินค้าที่เลือก -->
        <section class="md:col-span-3 space-y-3">
          <div class="border rounded-xl overflow-hidden">
            <div class="px-4 py-3 bg-gray-50 border-b font-medium">สินค้าที่เลือก</div>
            <div id="coItems" class="divide-y max-h-[40vh] overflow-auto"></div>
          </div>

          <div class="border rounded-xl overflow-hidden">
            <div class="px-4 py-3 bg-gray-50 border-b font-medium">ยอดรวม</div>
            <div class="p-4 space-y-2 text-sm">
              <div class="flex justify-between"><span>รวมสินค้า</span><span id="coSubtotal">฿0.00</span></div>
              <div class="flex justify-between"><span>ค่าส่ง</span><span id="coShipping">฿0.00</span></div>
              <div class="border-t my-2"></div>
              <div class="flex justify-between text-base font-bold"><span>ยอดสุทธิ</span><span id="coGrand">฿0.00</span></div>
            </div>
          </div>
        </section>

        <!-- ที่อยู่ + วิธีชำระ -->
        <section class="md:col-span-2 space-y-3">
          <!-- Address -->
          <div class="border rounded-xl overflow-hidden">
            <div class="px-4 py-3 bg-gray-50 border-b font-medium">ที่อยู่จัดส่ง</div>
            <div class="p-4 grid grid-cols-1 gap-3" id="addrList"><!-- render by JS --></div>
          </div>
          <!-- Payment -->
          <div class="border rounded-xl overflow-hidden">
            <div class="px-4 py-3 bg-gray-50 border-b font-medium">วิธีชำระเงิน</div>
            <div class="p-4 grid gap-2 text-sm">
              <label class="flex items-center gap-2">
                <input type="radio" name="paymethod" value="COD" class="w-4 h-4" checked>
                <span>ชำระปลายทาง (COD)</span>
              </label>
              <label class="flex items-center gap-2">
                <input type="radio" name="paymethod" value="BANK" class="w-4 h-4">
                <span>โอนผ่านบัญชีธนาคาร</span>
              </label>
              <label class="flex items-center gap-2">
                <input type="radio" name="paymethod" value="CARD" class="w-4 h-4">
                <span>บัตรเครดิต/เดบิต</span>
              </label>
            </div>
          </div>
        </section>
      </div>

      <!-- Footer -->
      <div class="px-4 sm:px-6 py-4 border-t bg-white flex flex-col md:flex-row items-center justify-between gap-3">
        <div class="text-sm text-gray-500">ตรวจสอบข้อมูลให้ถูกต้องก่อนยืนยัน</div>
        <div class="flex items-center gap-3 w-full md:w-auto">
          <button class="px-4 py-2 rounded-lg border hover:bg-gray-50 w-full md:w-auto" data-close-modal>ยกเลิก</button>
          <button id="confirmCheckoutBtn" class="btn-orange px-5 py-2.5 rounded-lg w-full md:w-auto">
            ยืนยันสั่งซื้อ
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ====== /CHECKOUT MODAL ====== -->


<script>
/* ================== CART CHECKOUT SCRIPT (paste once, after HTML) ================== */
(function () {
  /* ---- ROUTES (Blade) ---- */
  const ROUTES = {
    addresses: '<?php echo e(route("profile.addresses")); ?>', // must return { main:{...}, subs:[...] }
    checkout : '<?php echo e(route("cart.checkout")); ?>'      // expects {iditems[], address_key, paymethod}
  };

  /* ---- Globals / Elements ---- */
  const addrListEl  = document.getElementById('addrList');
  const checkoutBtn = document.getElementById('checkoutBtn');
  const confirmBtn  = document.getElementById('confirmCheckoutBtn');
  const cartMount   = document.getElementById('cartMount');
  const csrfToken   = document.querySelector('meta[name="csrf-token"]')?.content || '';

  /* ---- Expose STATE (cart script should assign into this) ---- */
  window.STATE = window.STATE || { idcustomer:null, items:[], totalQty:0, subtotal:0 };

  /* ================== ADDRESS LOADING ================== */
  const esc = (s) => String(s ?? '').replace(/[&<>"']/g, m => ({
    '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'
  }[m]));

  const fmtAddr = (a) => {
    const p = [];
    if (a.line1)       p.push(esc(a.line1));
    if (a.subdistrict) p.push('ต.' + esc(a.subdistrict));
    if (a.district)    p.push('อ.' + esc(a.district));
    if (a.province)    p.push('จ.' + esc(a.province));
    if (a.zip)         p.push(esc(a.zip));
    if (a.country)     p.push(esc(a.country));
    return p.join(' ');
  };

  async function fetchAddresses() {
    const res = await fetch(ROUTES.addresses, {
      headers: { 'Accept': 'application/json' },
      credentials: 'same-origin'
    });
    if (!res.ok) throw new Error('HTTP ' + res.status);
    return res.json();
  }

  function renderAddresses(data) {
    if (!addrListEl) return;
    const list = [];
    if (data?.main) list.push({ key:'main', ...data.main, tag:'ค่าเริ่มต้น' });
    (data?.subs || []).forEach(s => list.push({ key:String(s.idsubaddress), ...s }));

    if (!list.length) {
      addrListEl.innerHTML = `<div class="text-sm text-gray-500">ไม่พบที่อยู่ในบัญชีของคุณ</div>`;
      return;
    }

    addrListEl.innerHTML = list.map((a, i) => `
      <label class="border rounded-xl p-3 flex gap-3 items-start hover:bg-orange-50 cursor-pointer">
        <input type="radio" name="shipaddr" class="mt-1.5" value="${esc(a.key)}" ${i===0?'checked':''}>
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
  }

  async function ensureAddressListLoaded() {
    if (!addrListEl) return;
    try {
      const data = await fetchAddresses();
      renderAddresses(data);
    } catch (e) {
      console.error(e);
      addrListEl.innerHTML = `<div class="text-sm text-red-600">โหลดที่อยู่ไม่สำเร็จ</div>`;
    }
  }

  /* ================== ITEM SELECTION ================== */
  function getSelectedIdxs() {
    // จำกัดขอบเขตค้นหา checkbox เฉพาะใน cart list
    return [...cartMount.querySelectorAll('.item-chk:checked')].map(c => +c.dataset.index);
  }

  function getSelectedItemIds() {
    const idxs = getSelectedIdxs();
    return idxs.map(i => window.STATE.items?.[i]?.iditem).filter(Boolean);
  }

  function getSelectedAddressKey() {
    const rb = document.querySelector('#addrList input[name="shipaddr"]:checked');
    return rb ? rb.value : null; // 'main' or '123' (idsubaddress)
  }

  /* ================== CREATE ORDER ================== */
async function createOrder(ids) {
  const res = await fetch(ROUTES.checkout, {
    method: 'POST',
    credentials: 'same-origin',
    headers: {
      'Accept':'application/json','Content-Type':'application/json','X-CSRF-TOKEN': csrfToken
    },
    body: JSON.stringify({
      iditems: ids,
      address_key: getSelectedAddressKey() ?? 'main',
      paymethod: document.querySelector('input[name="paymethod"]:checked')?.value || 'COD'
    })
  });

  const ct = res.headers.get('content-type') || '';
  const json = ct.includes('application/json') ? await res.json() : {success:false, error: await res.text()};

  if (!res.ok || !json.success) {
    // 👇 แสดงรายละเอียดทั้งหมด
    console.error('checkout error:', json);
    const msg = json.message || json.error || 'ไม่ทราบสาเหตุ';
    alert('สร้างออเดอร์ไม่สำเร็จ\n' + msg);
    throw new Error(msg);
  }
  return json;
}

  /* ================== HOOK BUTTONS ================== */
  if (checkoutBtn) {
    checkoutBtn.addEventListener('click', () => {
      // หน้าหลักจะเปิด modal + render รายการสินค้าอยู่แล้ว
      // ตรงนี้เราแค่ไปโหลดรายการที่อยู่มาขึ้นใน panel
      ensureAddressListLoaded();
    });
  }

  if (confirmBtn) {
    confirmBtn.addEventListener('click', async () => {
      try {
        const ids = getSelectedItemIds();
        if (!ids.length) { alert('กรุณาเลือกสินค้า'); return; }

        const out = await createOrder(ids);
        // อัปเดตตะกร้าในหน้า (ข้อมูลจาก backend)
        window.location.assign('<?php echo e(route("test.FLUKE_Marketplace")); ?>');
        if (out.cart) {
          window.STATE.items    = Array.isArray(out.cart.items) ? out.cart.items : [];
          window.STATE.totalQty = Number(out.cart.totalQty ?? 0);
          window.STATE.subtotal = Number(out.cart.subtotal ?? 0);
        }

        // ถ้ามีฟังก์ชัน render() จากสคริปต์ตะกร้าเดิม ให้เรียกเพื่อรีเฟรช UI
        if (typeof window.render === 'function') window.render();

        // ปิดโมดอล
        document.getElementById('closeCheckoutModal')?.click();
      } catch (err) {
        console.error(err);
        // โชว์ข้อความตาม error
        const m = String(err.message || '');
        if (m.includes('no_items')) {
          alert('กรุณาเลือกสินค้า');
        } else if (m.includes('no_address')) {
          // already alerted
        } else {
          alert('สร้างออเดอร์ไม่สำเร็จ');
        }
      }
    });
  }
})();
</script>



<?php echo $__env->make('test.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

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
      coupon_prefix:'คูปองร้าน FLUKE:', coupon_text:'ซื้อขั้นต่ำ ฿1,500 ส่งฟรี', label_profile:'โปรไฟล์'
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
      coupon_prefix:'FLUKE Coupon:', coupon_text:'Free shipping over ฿1,500', label_profile:'Profile'
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
  const ROUTES = { list: '<?php echo e(route("cart.json")); ?>' };
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
    list   : '<?php echo e(route("cart.json")); ?>',
    qty    : '<?php echo e(route("cart.qty")); ?>',
    remove : '<?php echo e(route("cart.remove")); ?>',
    removeMany : '<?php echo e(route("cart.removeMany") ?? "#"); ?>',
    checkout: '<?php echo e(route("cart.checkout")); ?>',
    addresses: '<?php echo e(route("profile.addresses")); ?>'
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
<?php /**PATH C:\xampp\htdocs\tool\resources\views/test/cart.blade.php ENDPATH**/ ?>