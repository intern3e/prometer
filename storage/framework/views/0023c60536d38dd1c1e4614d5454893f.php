 <!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

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
  html, body {
  height: 100%;
  margin: 0;
  overscroll-behavior: none; /* ป้องกัน scroll เกิน */
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
  </style>
  <style>
@media (max-width: 767px){
  /* ครอบคลุมชื่อคลาสของไลบรารี autocomplete ทั่วไป */
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
 <!-- ===== Footer ===== -->
  <footer class="bg-gray-900 text-white mt-10">
    <div class="container-outer mx-auto section-pad py-10">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-sm">
        <div>
          <h4 class="font-semibold text-orange-300 mb-3" data-i18n="footer_contact">ติดต่อเรา</h4>
          <p class="text-gray-300" data-i18n="footer_branch">สาขาของเรา</p>
          <p class="text-gray-300" data-i18n="footer_social">Facebook / YouTube</p>
          <p class="text-gray-300 flex items-center gap-2 mt-2"><i class="bi bi-telephone"></i> 1-800-561-8187</p>
          <p class="text-gray-300 flex items-center gap-2"><i class="bi bi-envelope"></i> info@toolshop.com</p>
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
  </footer><?php /**PATH C:\xampp\htdocs\tool\resources\views/test/footer.blade.php ENDPATH**/ ?>