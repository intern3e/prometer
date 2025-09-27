<!DOCTYPE html>
<html lang="th">
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Product | FLUKE</title>
  <link rel="icon" type="image/png" href="https://img5.pic.in.th/file/secure-sv1/ChatGPT_Image_18_.._2568_12_03_57-removebg-preview.png">

  <!-- ====== BASE THEME ====== -->
  <style>
    :root{
      --brand:#ff6a00; --brand-600:#ea580c; --ink:#111827; --muted:#6b7280;
      --card:#ffffff; --bg:#f3f4f6; --radius:16px; --radius-sm:12px; --ring:#fde7d5;
      --ok:#16a34a; --warn:#f59e0b; --danger:#ef4444;
    }
    html, body { height: 100%; margin: 0; overscroll-behavior: none; }
    body{ font-family:'Prompt', system-ui, -apple-system, Segoe UI, Roboto, sans-serif; background:var(--bg); color:var(--ink); }
    .container-outer{ width:100%; max-width:1200px; margin:0 auto; }
    .section-pad{ padding-left:.75rem; padding-right:.75rem; }
    @media (min-width:768px){ .section-pad{ padding-left:1rem; padding-right:1rem; } }
    .card{ background:var(--card); border:1px solid rgba(17,24,39,.08); border-radius:var(--radius); box-shadow:0 1px 2px rgba(0,0,0,.04); }
    .soft{ box-shadow:0 8px 24px rgba(0,0,0,.06); }

    /* Buttons */
    .btn-brand{ background:var(--brand); color:#fff; border-radius:12px; padding:.75rem 1rem; font-weight:700; letter-spacing:.2px; }
    .btn-brand:hover{ filter:brightness(.96); }

    /* Breadcrumb */
    .breadcrumbs{ font-size:.9rem; color:#6b7280; display:flex; flex-wrap:wrap; gap:.25rem .4rem; align-items:center; }
    .breadcrumbs a{ color:#6b7280; text-decoration:none; }
    .breadcrumbs a:hover{ text-decoration:underline; }

    /* Image */
    .image-zoom{ overflow:hidden; border-radius:14px; }
    .image-zoom img{ transition:transform .35s ease; object-fit:contain; }
    .image-zoom:hover img{ transform:scale(1.03); }

    /* Tiny status dot */
    .dot{ width:10px; height:10px; border-radius:9999px; display:inline-block; margin-right:8px; }

    details[open] summary .chev{ transform:rotate(180deg); }

    /* Fly to cart clone */
    .fly-clone{ position:fixed; z-index:9999; pointer-events:none; width:80px; height:80px; border-radius:12px; overflow:hidden; box-shadow:0 6px 16px rgba(0,0,0,.2); transform:translate(0,0) scale(1); opacity:1; transition:transform .8s cubic-bezier(.2,.8,.2,1), opacity .8s ease; }

    /* Toast */
    .cart-toast{ position:fixed; left:50%; bottom:16px; transform:translateX(-50%) translateY(10px); background:#111827; color:#fff; border-radius:12px; padding:.75rem 1rem; display:none; align-items:center; gap:.75rem; z-index:10000; box-shadow:0 10px 30px rgba(0,0,0,.2); font-size:.95rem; }
    .cart-toast.show{ display:flex; animation:toastIn .18s ease-out forwards; }
    @keyframes toastIn{ from{opacity:0; transform:translateX(-50%) translateY(10px);} to{opacity:1; transform:translateX(-50%) translateY(0);} }
    .toast-btn{ background:var(--brand); color:#fff; border:none; border-radius:10px; padding:.5rem .75rem; font-weight:700; cursor:pointer; }
    .toast-btn:hover{ filter:brightness(.95); }

    /* Mobile search dropdown helpers */
    @media (max-width: 767px){
      #mobileSearch .tt-menu,
      #mobileSearch .autocomplete-suggestions,
      #mobileSearch .awesomplete ul,
      #mobileSearch .ais-SearchBox-suggestions,
      #mobileSearch #searchResultsMobile{
        position: absolute; top: calc(100% + 8px); left: 0; right: 0; max-height: 65vh; overflow: auto; z-index: 90; background: #fff;
        border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,.12);
      }
    }

    /* Responsive image box */
    @media (max-width: 639px){ #imgBox{ height: 260px; max-width: 320px; margin-left:auto; margin-right:auto; background-size:contain!important; background-position:center!important; background-repeat:no-repeat!important; } }
    @media (max-width: 375px){ #imgBox{ height: 220px; max-width: 260px; } }

    /* Sticky CTA */
    .sticky-cta{ position:fixed; left:0; right:0; bottom:0; background:#fff; border-top:1px solid #e5e7eb; z-index:40; display:none; }
    .sticky-cta.show{ display:block; }

    /* Meta single card (Delivery only) */
    .meta-card{
      background:#fff;
      border:1px solid #e5e7eb;
      border-radius:var(--radius-sm);
      padding:.95rem 1rem;
      display:flex; gap:.75rem; align-items:flex-start;
      box-shadow:0 2px 4px rgba(0,0,0,.05);
    }
    .meta-ic{ color:var(--brand); font-size:1.2rem; margin-top:.15rem; flex-shrink:0; }
    .meta-body{ min-width:0; }
    .meta-title{ font-weight:800; font-size:1rem; line-height:1.25; }
    .meta-desc{ color:#6b7280; font-size:.85rem; margin-top:.25rem; line-height:1.3; }

    /* Utilities */
    .sr-only{ position:absolute; width:1px; height:1px; padding:0; margin:-1px; overflow:hidden; clip:rect(0,0,0,0); white-space:nowrap; border:0; }
  </style>
</head>
<body>
  {{-- Header --}}
  @include('test.header-nav')

  {{-- Content --}}
  <main>
    @yield('content')
  </main>

  <!-- ===== Top container ===== -->
  <main class="container-outer section-pad py-6">
    <!-- Breadcrumbs -->
    <nav class="breadcrumbs" aria-label="breadcrumb">
      <a href="{{ url('/') }}" data-i18n="bc_home">Home</a>
      <span aria-hidden="true">/</span>
      <span id="bcName" aria-current="page">{{ $product->name }}</span>
    </nav>

    <!-- ===== Product area ===== -->
    <div id="productWrap" class="grid grid-cols-1 md:grid-cols-12 gap-6 mt-4">
      <!-- Left: gallery -->
      <section class="md:col-span-5">
        <div class="card p-3 soft">
          <div id="imgBox" class="aspect-square bg-white rounded-xl image-zoom flex items-center justify-center overflow-hidden" aria-label="product image">
            <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="w-full h-full object-contain" loading="eager" decoding="async">
          </div>
          <div class="mt-4 grid grid-cols-3 gap-3 text-xs" role="list" aria-label="trust badges">
            <div class="flex items-center gap-2" role="listitem"><i class="bi bi-shield-check" aria-hidden="true" style="color:var(--brand);"></i><span data-i18n="trust_warranty">รับประกัน 1 ปี</span></div>
            <div class="flex items-center gap-2" role="listitem"><i class="bi bi-truck" aria-hidden="true" style="color:var(--brand);"></i><span data-i18n="trust_fast_shipping">ส่งเร็ว</span></div>
            <div class="flex items-center gap-2" role="listitem"><i class="bi bi-box-seam" aria-hidden="true" style="color:var(--brand);"></i><span data-i18n="trust_instock">มีสต็อกพร้อมส่ง</span></div>
          </div>
        </div>
      </section>

      <!-- Right: buy box -->
      <aside class="md:col-span-7">
        <div class="card p-5 soft">
          <input type="hidden" id="iditem" value="{{ $product->iditem }}">

          <!-- Title + Model -->
          @php $model = trim((string)($product->model ?? '')); @endphp
          <h1 id="pName" class="text-xl md:text-2xl font-extrabold mb-1">{{ $product->name }}</h1>
          @if($model !== '')
            <p id="pModel" class="text-sm text-gray-400 mb-3">
              <span class="font-medium" data-i18n="label_model">Model:</span>
              <span>{{ $model }}</span>
            </p>
          @endif

          <!-- Price + Stock + VAT -->
          <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
            <div>
              @php
                $toNum = function ($v) {
                  if ($v === null) return null;
                  $s = trim((string) $v);
                  if ($s === '') return null;
                  $s = str_replace(['฿', ',', ' '], '', $s);
                  $s = rtrim($s, '%');
                  return is_numeric($s) ? (float) $s : null;
                };
                $base = $toNum($product->basepriceTHB ?? null);
                $web  = $toNum($product->webpriceTHB  ?? null);
              @endphp

              <div class="flex items-baseline gap-2 mb-2">
                <span id="pPrice" class="text-2xl md:text-3xl font-extrabold" style="color:var(--brand);" data-thb="{{ number_format($web ?? 0, 2, '.', '') }}">
                  @if(($web ?? 0) > 0) {{ '฿'.number_format($web, 2) }} @else <span data-i18n="label_quote">ขอใบเสนอราคา</span> @endif
                </span>
                @if(($base ?? 0) > ($web ?? 0) && ($web ?? 0) > 0)
                  <span id="pBase" class="line-through text-sm text-gray-400" data-thb="{{ number_format($base ?? 0, 2, '.', '') }}">{{ '฿'.number_format($base, 2) }}</span>
                @endif
              </div>

              {{-- Stock status --}}
              @php
                $raw = trim((string)($product->Stock ?? ''));
                $qty = null; if (is_numeric($raw)) { $qty = (int)$raw; } elseif (preg_match('/\d+/', $raw, $m)) { $qty = (int)$m[0]; }
              @endphp
              @if($qty !== null && $qty > 0)
                <div class="mt-1 text-sm" style="color:var(--ok)">
                  <span class="dot" style="background:var(--ok);"></span>
                  <span data-i18n="stock_in">มีสินค้า</span>
                  <span class="font-medium" style="color:#15803d">({{ $qty }} <span data-i18n="unit_piece">ชิ้น</span>)</span>
                </div>
              @else
                <div class="mt-1 text-sm" style="color:var(--warn)">
                  <span class="dot" style="background:var(--warn);"></span>
                  <span data-i18n="stock_lead">Pre-order</span>
                </div>
              @endif
            </div>

            <div class="text-xs text-gray-500 mt-2 md:mt-0 md:text-right">
              <div data-i18n="tax_included">ยังไม่รวมภาษีมูลค่าเพิ่ม (VAT)</div>
            </div>
          </div>

          <!-- ===== Meta: เฉพาะ 'วันที่จัดส่ง:' ===== -->
          <div class="mb-4" aria-label="product meta">
            <div class="meta-card">
              <i class="bi bi-calendar-check meta-ic" aria-hidden="true"></i>
              <div class="meta-body">
                <div class="meta-title">
                  <span data-i18n="badge_shipping_title">วันที่จัดส่ง:</span>
                  <!-- เพิ่ม data-source ตรงนี้ -->
                  <span id="leadtimeText"
                        data-leadtime-raw="{{ trim($product->leadtime ?? '') }}"
                        data-source="{{ trim($product->source ?? '') }}"></span>
                </div>
                <div class="meta-desc" data-i18n="badge_shipping_desc">จัดส่งตามระยะเวลาส่งของบริษัท</div>
              </div>
            </div>
          </div>

          <!-- Qty + CTA -->
          <div class="mb-5 flex flex-col md:flex-row items-stretch md:items-center gap-2 md:gap-3" aria-label="purchase controls">
            <div class="flex items-center border rounded-xl overflow-hidden w-[140px] md:w-[160px]" aria-label="quantity">
              <button id="qtyMinus" class="w-9 h-10 text-lg hover:bg-gray-50" aria-label="decrease">−</button>
              <input name="quantity" id="qtyInput" type="number" min="1" value="1" class="w-full h-10 text-center outline-none" aria-label="quantity input">
              <button id="qtyPlus" class="w-9 h-10 text-lg hover:bg-gray-50" aria-label="increase">+</button>
            </div>

            <!-- ปุ่ม Add / Contact -->
            <button id="addToCartBtn" type="button" class="flex-1 flex items-center justify-center gap-2 px-4 py-3 rounded-xl text-white bg-[#ff6a00] hover:bg-[#e65f00] active:brightness-95 disabled:bg-[#ff6a00]/60 disabled:cursor-not-allowed focus:outline-none focus-visible:ring-2 focus-visible:ring-[#ff6a00]/40 transition-colors">
              <i class="bi bi-cart-plus" aria-hidden="true"></i>
              <span data-i18n="add_to_cart">เพิ่มลงตะกร้า</span>
            </button>
        
            <!-- ปุ่ม "ติดต่อสอบถาม" เข้าหน้า Add LINE @543ubjtx โดยตรง -->
            <a id="contactBtn"
              href="line://ti/p/%40543ubjtx"
              class="flex-1 flex items-center justify-center gap-2 px-4 py-3 rounded-xl text-white bg-[#0ea5e9] hover:bg-[#0284c7] active:brightness-95 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#0ea5e9]/40 transition-colors"
              onclick="location.href='line://ti/p/%40543ubjtx'; return false;">
              <i class="bi bi-chat-dots" aria-hidden="true"></i>
              <span data-i18n="contact_us">ติดต่อสอบถาม</span>
            </a> 
            
            <script id="productData" type="application/json">
{!! json_encode([
  'iditem'        => (string) $product->iditem,
  'name'          => (string) $product->name,
  'webpriceTHB'   => (($web ?? null) !== null)  ? number_format($web, 2, '.', '')   : '0.00',
  'pic'           => (string) ($product->pic ?? ''),
  'basepriceTHB'  => (($base ?? null) !== null) ? number_format($base, 2, '.', '')  : null,
  'discount'      => (string) ($product->discount ?? ''),
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
            </script>
          </div>
@if(!blank($product->document))
<section id="pColJWrap" class="mb-4">
  <div class="border rounded-2xl overflow-hidden bg-white shadow-sm">
    <!-- Header -->
    <div class="flex items-center justify-between gap-3 px-4 md:px-5 py-3 border-b bg-gray-50">
      <div class="flex items-center gap-2 min-w-0">
        <i class="bi bi-file-earmark-pdf text-[var(--brand,#ff6a00)] text-xl"></i>
        <span class="font-semibold text-gray-900 text-base"data-i18n="p_desc_title">รายละเอียดสินค้า</span> 
      </div>

      <div class="flex items-center gap-2">
        <!-- File selector (auto-hidden if single file) -->
        <label for="pdfSelect" class="sr-only">Select file</label>
        <select id="pdfSelect" class="hidden border rounded px-2 py-1 text-sm"></select>

        <!-- Buttons (EN) -->
        <button id="pdfFsBtn" type="button"
                class="inline-flex items-center gap-1 text-sm px-2.5 py-1.5 border rounded-lg hover:bg-gray-100"
                aria-label="Fullscreen">
          <i class="bi bi-arrows-fullscreen"></i><span class="hidden sm:inline">Fullscreen</span>
        </button>
        <a id="pdfOpenBtn" href="#" target="_blank" rel="noopener"
           class="inline-flex items-center gap-1 text-sm px-2.5 py-1.5 border rounded-lg hover:bg-gray-100"
           aria-label="Open in new tab">
          {{-- <i class="bi bi-box-arrow-up-right"></i><span class="hidden sm:inline">Open tab</span> --}}
        </a>
      </div>
    </div>

    <!-- Viewer -->
    <div id="pdfCard" class="relative bg-white">
      <div id="pdfSkeleton" class="skeleton rounded-none"></div>

      <!-- ครอบ iframe เพื่อตัด toolbar ของ PDF.js -->
      <div class="pdf-viewport">
        <iframe id="pdfFrame" class="pdf-frame" title="PDF viewer" loading="lazy"></iframe>
      </div>
    </div>

    <!-- SEO/fallback text (kept but hidden) -->
    <div id="pColJ" class="sr-only">{{ e($product->document) }}</div>
  </div>
</section>

<style>
  /* ปรับความสูง toolbar ของ PDF.js ที่จะถูกตัดทิ้ง หากอนาคต PDF.js เปลี่ยนความสูงให้ปรับค่านี้ */
  :root{ --pdfjs-toolbar-h: 48px; }

  .pdf-viewport{ position:relative; overflow:hidden; }
  .pdf-frame{
    width:100%;
    /* เพิ่มความสูงเท่ากับ toolbar แล้วเลื่อนขึ้น ให้พื้นที่แสดงผลยังคง ~70vh ตามเดิม */
    height: calc(min(70vh, 900px) + var(--pdfjs-toolbar-h));
    border:0; display:block;
    transform: translateY(calc(-1 * var(--pdfjs-toolbar-h)));
  }
  @media (max-width: 640px){
    .pdf-frame{ height: calc(60vh + var(--pdfjs-toolbar-h)); }
  }

  .skeleton{ position:absolute; inset:0;
    background:linear-gradient(90deg,#f6f7f8 25%,#eee 37%,#f6f7f8 63%);
    background-size:400% 100%; animation:shimmer 1.2s infinite; border-radius:0.75rem }
  @keyframes shimmer{ 0%{background-position:100% 0} 100%{background-position:0 0} }

  /* ตอน fullscreen ให้ชดเชยความสูง toolbar เช่นกัน */
  :fullscreen .pdf-frame{ height: calc(100vh + var(--pdfjs-toolbar-h)); }
</style>

<script>
(function () {
  const textEl = document.getElementById('pColJ');
  if (!textEl) return;
  const PROXY = '/pdf-proxy';

  // === 1) ดึงข้อความดิบจาก SEO/fallback แล้วหา URL ===
  const raw = (textEl.textContent || '').trim();

  // จับลิงก์แบบเต็ม (absolute)
  const absUrls = raw.match(/https?:\/\/[^\s<>"']+/gi) || [];

  // จับลิงก์แบบ relative ของ myflukestore: /pdfs/cache/.../*.pdf[?...]#
  const relPdfMatches = raw.match(/(?:^|\s)(\/pdfs\/cache\/[^\s<>"']+?\.pdf(?:[?#][^\s<>"']*)?)/gi) || [];

  // แปลง relative -> absolute สำหรับโดเมน myflukestore
  const MYFLUKE_BASE = 'https://www.myflukestore.com';
  const toAbsolute = (u) => {
    // ถ้าเป็น //host/path ให้เติม https:
    if (/^\/\//.test(u)) return 'https:' + u;
    // ถ้าเป็น /path ให้เติมโดเมน myflukestore
    if (/^\//.test(u)) return MYFLUKE_BASE + u;
    return u;
  };

  // รวมรายการ pdf ทั้งแบบ absolute ที่ลงท้าย .pdf และแบบ relative ที่ถูกแปลงแล้ว
  const pdfFromAbs = absUrls.filter(u => /\.pdf(\?|#|$)/i.test(u));
  const pdfFromRel = relPdfMatches.map(s => toAbsolute(s.trim()));
  // รวม + ลบซ้ำ
  const pdfs = Array.from(new Set([...pdfFromAbs, ...pdfFromRel]));

  if (!pdfs.length) return;

  // === 2) เตรียม viewer + proxy ===
  const proxied = (u) => `${location.origin}/pdf-proxy?url=${encodeURIComponent(u)}`;

    const viewerSrc = (u) =>
    `/pdfjs/web/viewer.html?file=${
      encodeURIComponent(`${PROXY}?url=${encodeURIComponent(u)}`)
    }#zoom=page-width&pagemode=none&disableDownload=true`;


  // === 3) อ้างอิง element ต่าง ๆ ===
  const frame    = document.getElementById('pdfFrame');
  const skeleton = document.getElementById('pdfSkeleton');
  const fsBtn    = document.getElementById('pdfFsBtn');
  const openBtn  = document.getElementById('pdfOpenBtn');
  const card     = document.getElementById('pdfCard');
  const select   = document.getElementById('pdfSelect');

  // ถ้ามีหลายไฟล์ แสดงตัวเลือก
  if (pdfs.length > 1) {
    select.classList.remove('hidden');
    select.innerHTML = '';
    pdfs.forEach((u, i) => {
      const opt = document.createElement('option');
      opt.value = u;
      // ชื่อไฟล์อ่านง่าย
      try {
        const url = new URL(u);
        const name = url.pathname.split('/').pop() || `file-${i+1}.pdf`;
        opt.textContent = `${i+1}. ${name}`;
      } catch {
        opt.textContent = `File #${i+1}`;
      }
      select.appendChild(opt);
    });
  }

  function render(u){
    skeleton.style.display = 'block';
    frame.src = viewerSrc(u);
    openBtn.href = u; // เปิดแท็บใหม่เป็น URL ต้นฉบับ
    if (select.options.length) {
      const idx = pdfs.indexOf(u);
      if (idx >= 0) select.selectedIndex = idx;
    }
  }

  frame.addEventListener('load', () => { skeleton.style.display = 'none'; });

  // แสดงไฟล์แรก
  render(pdfs[0]);

  // เปลี่ยนไฟล์จาก selector
  select.addEventListener('change', () => render(select.value));

  // === 4) Fullscreen toggle ===
  fsBtn.addEventListener('click', async () => {
    if (!document.fullscreenElement) {
      try {
        await card.requestFullscreen();
        fsBtn.innerHTML = '<i class="bi bi-fullscreen-exit"></i><span class="hidden sm:inline">Exit fullscreen</span>';
      } catch(e){}
    } else {
      await document.exitFullscreen();
      fsBtn.innerHTML = '<i class="bi bi-arrows-fullscreen"></i><span class="hidden sm:inline">Fullscreen</span>';
    }
  });
  document.addEventListener('fullscreenchange', () => {
    if (!document.fullscreenElement) {
      fsBtn.innerHTML = '<i class="bi bi-arrows-fullscreen"></i><span class="hidden sm:inline">Fullscreen</span>';
    }
  });
})();
</script>
@endif



        </div>
      </aside>
    </div>

    <!-- Not found -->
    <div id="notFound" class="hidden text-center py-16">
      <div class="text-4xl mb-3" aria-hidden="true">🤔</div>
      <p class="text-gray-600" data-i18n="notfound_text">ไม่พบสินค้า</p>
      <a href="{{ url('/') }}" class="mt-4 inline-block" style="color:var(--brand);" data-i18n="notfound_back">กลับหน้าแรก</a>
    </div>
  </main>

  <!-- Sticky CTA -->
  @php
    $s = trim((string)($product->webpriceTHB ?? ''));
    if ($s !== '') { $s = str_replace(['฿', ',', ' '], '', $s); $s = rtrim($s, '%'); }
    $webSticky = ($s !== '' && is_numeric($s)) ? (float)$s : null;
  @endphp
  <div id="stickyBar" class="sticky-cta" role="region" aria-label="sticky purchase bar">
    <div class="container-outer section-pad py-3 flex items-center gap-3">
      <div class="min-w-0 flex-1">
        <div id="stickyName" class="truncate font-semibold">{{ $product->name ?? 'Loading...' }}</div>
        <div id="stickyPrice" class="font-bold" style="color:var(--brand);" data-thb="{{ number_format($webSticky ?? 0, 2, '.', '') }}">
          @if(($webSticky ?? 0) > 0) ฿{{ number_format($webSticky, 2) }} @else <span data-i18n="label_quote">ขอใบเสนอราคา</span> @endif
        </div>
      </div>
      <div class="flex items-center border rounded-xl overflow-hidden w-[120px]" aria-label="quantity">
        <button id="qtyMinus2" class="w-8 h-9 text-lg" aria-label="decrease">−</button>
        <input id="qtyInput2" type="number" min="1" value="1" class="w-full h-9 text-center outline-none" aria-label="quantity input">
        <button id="qtyPlus2" class="w-8 h-9 text-lg" aria-label="increase">+</button>
      </div>
      <button id="addToCartBtn2" class="btn-brand flex items-center gap-2"><i class="bi bi-cart-plus" aria-hidden="true"></i> <span data-i18n="sticky_add">เพิ่ม</span></button>
    </div>
  </div>

  <!-- ===== Small helpers ===== -->
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const menuBtn = document.querySelector('[data-drawer-toggle="#mobileMenu"]');
      const mobileSearch = document.getElementById("mobileSearch");
      menuBtn?.addEventListener("click", () => mobileSearch?.classList.add("hidden"));
    });
  </script>
  <!-- ===== Lead time localizer (myfluke store + fluke-direct) ===== -->
<script>
(function(){
  const el = document.getElementById('leadtimeText');
  if (!el) return;

  const getLang = () =>
    (window.getSiteLang && window.getSiteLang()) || localStorage.getItem('site_lang') || 'ไทย';
  const fallback = () => ({ th:'สอบถามเพิ่มเติม', en:'Further inquiry' });

  function localize(raw, source){
    if (!raw) return fallback();

    // normalize
    let s = String(raw).trim();
    s = s.replace(/[\u2013\u2014]/g, '-').replace(/\s+/g, ' ').trim();
    s = s.replace(/\s*-\s*/g, '–').replace(/\s+to\s+/gi, '–');
    s = s.replace(/^(ships?\s+in|lead\s*time:|delivery:)\s*/i, '');

    // detect unit/kind
    let unit = 'day', kind = 'normal';
    if (/month/i.test(s)) unit='month';
    else if (/week/i.test(s)) unit='week';
    else if (/(business|working)\s*day/i.test(s)) { unit='day'; kind='business'; }

    // extract numbers
    let n1=null, n2=null;
    let m = s.match(/(\d+(?:\.\d+)?)\s*–\s*(\d+(?:\.\d+)?)/);
    if (m){ n1=parseFloat(m[1]); n2=parseFloat(m[2]); }
    else { m = s.match(/(\d+(?:\.\d+)?)/); if (m) n1=parseFloat(m[1]); }

    // bump: myfluke store & fluke-direct
    const bumpSource = /(?:myfluke\s*store|fluke[-\s]*direct)/i.test(String(source||''));
    if (bumpSource){
      if (unit === 'week'){
        if (n1 != null) n1 += 2;
        if (n2 != null) n2 += 2;
        if (n1 == null && n2 == null){ n1 = 2; } // only text 'week(s)'
      } else if (unit === 'day') {
        if (n1 != null) n1 += 10;
        if (n2 != null) n2 += 10;
        if (n1 == null && n2 == null){ n1 = 13; n2 = 15; } // fallback "3–5" +10
      }
      // unit === 'month' → no change
    }

    // build text
    const enUnitBase = (unit==='month')?'month':(unit==='week')?'week':'day';
    const enPlural = (n,w)=> (n>1?w+'s':w);
    const enText = (n2!=null)
      ? `${n1}–${n2} ${kind==='business'?'business ':''}${enPlural(n2,enUnitBase)}`
      : `${n1 ?? '3–5'} ${kind==='business'?'business ':''}${enPlural(n1||5,enUnitBase)}`;

    const thUnit = (unit==='month')?'เดือน':(unit==='week')?'สัปดาห์':(kind==='business'?'วันทำการ':'วัน');
    const thText = (n2!=null)
      ? `${n1}–${n2} ${thUnit}`
      : `${n1 ?? '3–5'} ${thUnit}`;

    return { th: thText, en: enText };
  }

  const raw    = (el.dataset.leadtimeRaw || '').trim();
  const source = (el.dataset.source || window.PRODUCT_SOURCE || '').trim();
  const loc = localize(raw, source);

  const render = () => { el.textContent = (getLang()==='English') ? loc.en : loc.th; };
  (document.readyState === 'loading') ? document.addEventListener('DOMContentLoaded', render) : render();
  window.addEventListener('site_lang_changed', render);
})();
</script>


  <!-- ===== Add to Cart (API + FX) ===== -->
  <script>
  (function(){
    const qtyEl1 = document.getElementById('qtyInput');
    const btn1   = document.getElementById('addToCartBtn');
    const btn2   = document.getElementById('addToCartBtn2'); // sticky
    const qtyEl2 = document.getElementById('qtyInput2');
    const badge  = document.querySelector('a[aria-label="cart"] span');
    const csrf   = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    function moneyStr(v){ if (v == null) return ''; let s = String(v).trim().replace(/[^\d.,-]/g,'').replace(/,/g,''); if (!/^\d+(\.\d+)?$/.test(s)) return ''; const n = Number(s); if (!Number.isFinite(n)) return ''; return n.toFixed(2); }
    function getProduct(){ const node = document.getElementById('productData'); if (!node) throw new Error('ไม่พบ productData'); let p; try { p = JSON.parse(node.textContent || '{}'); } catch { throw new Error('productData ไม่ใช่ JSON ที่ถูกต้อง'); }
      if (!p.iditem) throw new Error('ไม่พบรหัสสินค้า (iditem)'); if (!p.name) throw new Error('ไม่พบชื่อสินค้า'); return { iditem:String(p.iditem), name:String(p.name), pic:String(p.pic||''), basepriceTHB:moneyStr(p.basepriceTHB ?? ''), discount:String(p.discount||''), webpriceTHB:moneyStr(p.webpriceTHB ?? '0') };
    }
    function updateBadge(n){ if (!badge) return; badge.textContent = String(Number(n||0)); badge.style.transform='scale(1.15)'; badge.style.transition='transform .13s'; setTimeout(()=> badge.style.transform='scale(1)',130); }
    async function addToCart(payload){ const res = await fetch('{{ route("cart.add") }}', { method:'POST', credentials:'same-origin', headers:{ 'X-CSRF-TOKEN':csrf, 'Accept':'application/json', 'Content-Type':'application/json' }, body: JSON.stringify(payload) });
      const ct = res.headers.get('content-type') || ''; const readJson = async () => ct.includes('application/json') ? res.json() : Promise.reject(new Error(await res.text())); if (!res.ok) { let msg=''; try { const j=await readJson(); msg=j?.message||j?.error||(j?.errors && Object.values(j.errors)[0]?.[0])||''; } catch (e) { try{ msg = await res.text(); }catch(_){} } throw new Error(msg || ('HTTP '+res.status)); }
      if (!ct.includes('application/json')) throw new Error('Expected JSON but got: '+ct); return res.json(); }
    const getQty = (el) => Math.max(1, Number(el?.value || 1));

    function animateFlyToCart(){ const img=document.querySelector('#imgBox img'); const cart=document.querySelector('a[aria-label="cart"]'); if (!img||!cart) return; const ir=img.getBoundingClientRect(); const cr=cart.getBoundingClientRect(); const startX=ir.left+ir.width/2; const startY=ir.top+ir.height/2; const endX=cr.left+cr.width/2; const endY=cr.top+cr.height/2; const clone=document.createElement('div'); clone.className='fly-clone'; clone.style.left=startX+'px'; clone.style.top=startY+'px'; clone.innerHTML=`<img src="${img.src}" style="width:100%;height:100%;object-fit:contain;">`; document.body.appendChild(clone); requestAnimationFrame(()=>{ const dx=endX-startX; const dy=endY-startY; clone.style.transform=`translate(${dx}px, ${dy}px) scale(.1)`; clone.style.opacity='0'; }); clone.addEventListener('transitionend', ()=> clone.remove(), { once:true }); }
    function showToast(){ const dict=(window.getDict&&window.getDict()) || { added_to_cart:'เพิ่มสินค้าลงตะกร้าแล้ว', view_cart:'ไปยังตะกร้า' }; let toast=document.getElementById('cartToast'); if (!toast){ toast=document.createElement('div'); toast.id='cartToast'; toast.className='cart-toast'; toast.innerHTML=`<span id="toastMsg">${dict.added_to_cart}</span> <a href="{{ url('cart') }}" class="toast-btn" id="toastGoCart">${dict.view_cart||'ไปยังตะกร้า'}</a>`; document.body.appendChild(toast);} else { toast.querySelector('#toastMsg').textContent=dict.added_to_cart; toast.querySelector('#toastGoCart').textContent=dict.view_cart||'ไปยังตะกร้า'; } toast.classList.add('show'); clearTimeout(toast._t); toast._t=setTimeout(()=> toast.classList.remove('show'), 3000); }

    async function handleAdd(btn, qtyInput){
      if (!btn) return;
      if (btn.dataset.mode==='contact'){ location.href='/contact'; return; }
      try{
        btn.disabled=true;
        const p=getProduct();
        const qty=getQty(qtyInput);
        const payload={ iditem:p.iditem, pic:p.pic, name:p.name, basepriceTHB:p.basepriceTHB, discount:p.discount, webpriceTHB:p.webpriceTHB, quantity:String(qty), status:'ตะกร้า' };
        const data = await addToCart(payload);
        if (data?.cart_count != null) updateBadge(data.cart_count);
        animateFlyToCart(); showToast();
      }catch(e){
        console.error('Add to cart failed:', e);
        alert(e?.message||'เพิ่มสินค้าไม่สำเร็จ');
      } finally{ btn.disabled=false; }
    }

    document.getElementById('addToCartBtn')?.addEventListener('click', ()=> handleAdd(document.getElementById('addToCartBtn'), document.getElementById('qtyInput')));
    document.getElementById('addToCartBtn2')?.addEventListener('click', ()=> handleAdd(document.getElementById('addToCartBtn2'), document.getElementById('qtyInput2')));
  })();
  </script>

  <!-- ===== Quantity controls (คู่) ===== -->
  <script>
  (function(){
    function clampInt(el){ let v=Math.floor(Number(el.value)); if(!Number.isFinite(v)||v<1) v=1; el.value=v; return v; }
    function setDisabled(btn, d){ if(!btn) return; btn.disabled=d; btn.classList.toggle('opacity-50', d); btn.classList.toggle('cursor-not-allowed', d); }
    function repeatable(btn, onStep){ if(!btn) return; let t1=null,t2=null,didHold=false; const start=(e)=>{ if(e.pointerType==='mouse' && e.button!==0) return; didHold=false; clearTimeout(t1); clearInterval(t2); t1=setTimeout(()=>{ didHold=true; onStep(); t2=setInterval(onStep, 60); },350); }; const end=()=>{ clearTimeout(t1); t1=null; clearInterval(t2); t2=null; }; btn.addEventListener('pointerdown', start); ['pointerup','pointercancel','pointerleave'].forEach(ev=> btn.addEventListener(ev,end)); btn.addEventListener('click', ()=>{ if(didHold){ didHold=false; return; } onStep(); }); }
    function bindQty({input, plus, minus, mirror}){ if(!input) return; function sync(v){ input.value=v; if(mirror && mirror!==input) mirror.value=v; setDisabled(minus, v<=1); } repeatable(plus, ()=> sync(clampInt(input)+1)); repeatable(minus, ()=> sync(Math.max(1, clampInt(input)-1))); input.addEventListener('input', ()=> sync(clampInt(input))); input.addEventListener('blur',  ()=> sync(clampInt(input))); sync(clampInt(input)); }
    document.addEventListener('DOMContentLoaded', ()=>{ const q1=document.getElementById('qtyInput'); const p1=document.getElementById('qtyPlus'); const m1=document.getElementById('qtyMinus'); const q2=document.getElementById('qtyInput2'); const p2=document.getElementById('qtyPlus2'); const m2=document.getElementById('qtyMinus2'); bindQty({input:q1, plus:p1, minus:m1, mirror:q2}); bindQty({input:q2, plus:p2, minus:m2, mirror:q1}); });
  })();
  </script>

  <!-- ===== Currency + unified toggle: “ถ้ามีราคาและมีสต็อก → 2 ปุ่ม” ===== -->
  <script>
    (function(){
      const EXCHANGE = 38; // THB per USD
      const getLang = () => (window.getSiteLang && window.getSiteLang()) || localStorage.getItem('site_lang') || localStorage.getItem('preferredLanguage') || 'ไทย';
      const fmtTHB = v => new Intl.NumberFormat('th-TH',{style:'currency',currency:'THB',minimumFractionDigits:2,maximumFractionDigits:2}).format(v ?? 0);
      const fmtUSD = v => new Intl.NumberFormat('en-US',{style:'currency',currency:'USD',minimumFractionDigits:2,maximumFractionDigits:2}).format(v ?? 0);
      const toUSD = (thb) => { if (!Number.isFinite(thb)) return null; return Math.round((thb / EXCHANGE) * 100) / 100; };

      function getBaseTHB(el){
        if (!el) return 0;
        if (el.dataset && el.dataset.thb){
          const v = parseFloat(el.dataset.thb);
          if (Number.isFinite(v)) return v;
        }
        const rawText = (el.textContent || '').replace(/,/g,'');
        const n = parseFloat(rawText.replace(/[^\d.]/g,'') || '0');
        const thb = Number.isFinite(n) ? n : 0;
        if (el.dataset) el.dataset.thb = String(thb || 0);
        return thb;
      }

      function renderPrices(){
        const lang = getLang();
        const quoteText = (lang === 'English') ? 'Request a quote' : 'ขอใบเสนอราคา';
        const toText    = (thb) => (lang === 'English') ? fmtUSD(toUSD(thb)) : fmtTHB(thb);

        const pPrice = document.getElementById('pPrice');
        if (pPrice){ const thb = getBaseTHB(pPrice); pPrice.textContent = (thb > 0) ? toText(thb) : quoteText; }

        const pBase = document.getElementById('pBase');
        if (pBase){ const thb = getBaseTHB(pBase); if (thb > 0) pBase.textContent = toText(thb); }

        const stickyPrice = document.getElementById('stickyPrice');
        if (stickyPrice){
          let thb = getBaseTHB(stickyPrice);
          if (!thb && pPrice){ thb = getBaseTHB(pPrice); stickyPrice.dataset && (stickyPrice.dataset.thb = String(thb || 0)); }
          stickyPrice.textContent = (thb > 0) ? toText(thb) : quoteText;
        }

        const thbNow = getBaseTHB(document.getElementById('pPrice'));
        window.__hasPrice = Number.isFinite(thbNow) && thbNow > 0;
      }
      window.rerenderCurrency = renderPrices;
      (document.readyState === 'loading') ? document.addEventListener('DOMContentLoaded', renderPrices) : renderPrices();
      window.addEventListener('site_lang_changed', renderPrices);
    })();

    (function(){
      function renderButtons(){
        const addBtn       = document.getElementById('addToCartBtn');
        const stickyAddBtn = document.getElementById('addToCartBtn2');
        const contactBtn   = document.getElementById('contactBtn');
        const lang         = (window.getSiteLang && window.getSiteLang()) ? window.getSiteLang() : (localStorage.getItem('site_lang') || 'ไทย');

        const hasPrice = !!window.__hasPrice;
        const hasStock = !!window.__hasStock;   // ตั้งค่าจากบล็อกสต็อกด้านล่าง
        if (hasPrice && hasStock){
          // แสดงสองปุ่ม + sticky add
          if (addBtn){
            addBtn.classList.remove('hidden');
            addBtn.dataset.mode = 'cart';
            (addBtn.querySelector('span') || addBtn).textContent = (lang === 'English') ? 'Add to cart' : 'เพิ่มลงตะกร้า';
          }
          stickyAddBtn?.classList.remove('hidden');
          contactBtn?.classList.remove('hidden');
        } else {
          // แสดงเฉพาะติดต่อสอบถาม
          contactBtn?.classList.remove('hidden');
          if (addBtn){
            addBtn.classList.add('hidden');
            addBtn.dataset.mode = 'contact';
            (addBtn.querySelector('span') || addBtn).textContent = (lang === 'English') ? 'Contact us' : 'ติดต่อสอบถาม';
          }
          stickyAddBtn?.classList.add('hidden');
        }
      }

      // intercept: ถ้าปุ่ม Add โดนโหมด contact ให้พาไปหน้าติดต่อ
      document.addEventListener('DOMContentLoaded', () => {
        const addBtn = document.getElementById('addToCartBtn');
        if (addBtn){
          addBtn.addEventListener('click', function(e){
            if (this.dataset.mode === 'contact'){
              e.preventDefault(); e.stopImmediatePropagation();
              location.href = '/contact';
            }
          }, true);
        }
      });

      const _oldRender = window.rerenderCurrency || function(){};
      window.rerenderCurrency = function(){ _oldRender(); renderButtons(); };

      (document.readyState === 'loading') ? document.addEventListener('DOMContentLoaded', renderButtons) : renderButtons();
      window.addEventListener('site_lang_changed', renderButtons);
      window.renderButtons = renderButtons;
    })();
  </script>

  <!-- ===== STOCK: คำนวณ __hasStock จากค่า Blade แล้วเรนเดอร์ปุ่ม ===== -->
  <script>
    (function(){
      const RAW_STOCK = "{{ trim((string)($product->Stock ?? '')) }}";
      let qty = null;
      if (RAW_STOCK && !isNaN(RAW_STOCK)) {
        qty = parseInt(RAW_STOCK, 10);
      } else if (RAW_STOCK) {
        const m = RAW_STOCK.match(/\d+/);
        if (m) qty = parseInt(m[0], 10);
      }
      window.__hasStock = Number.isFinite(qty) && qty > 0;

      function apply(){
        if (typeof window.renderButtons === 'function') window.renderButtons();
      }
      (document.readyState === 'loading') ? document.addEventListener('DOMContentLoaded', apply) : apply();
    })();
  </script>
  <!-- ===== I18N (ย่อ) ===== -->
  <script>
// ===== I18N DICTIONARY =====
const I18N = {
  'ไทย': {
    brand_name:'FLUKE',
    top_buyer_central:'Buyer Central', top_help:'Help', top_get_app:'Get the App', top_choose_lang:'เลือกภาษา',
    top_login:'เข้าสู่ระบบ', top_join_free:'สมัครสมาชิกฟรี',
    nav_all_categories:'หมวดหมู่ทั้งหมด',
    mega_measure:'เครื่องมือวัด', mega_process:'กระบวนการ/สอบเทียบ', mega_accessories:'อุปกรณ์เสริม',
    cat_left_1:'แคลมป์มิเตอร์', cat_left_2:'มัลติมิเตอร์', cat_left_3:'เครื่องตรวจไฟ/ทดสอบไฟฟ้า', cat_left_4:'กล้องถ่ายภาพความร้อน',
    cat_left_5:'เครื่องวัดฉนวน', cat_left_6:'คุณภาพไฟฟ้า', cat_left_7:'เครื่องสอบเทียบ', cat_left_8:'อุปกรณ์เสริม',
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
    copyright:'© 2024 FLUKE. สงวนลิขสิทธิ์ทั้งหมด', top_user:'ผู้ใช้', top_logout:'ออกจากระบบ', label_profile:'โปรไฟล์',

    bc_home:'หน้าแรก',
    trust_warranty:'รับประกัน 1 ปี',
    trust_fast_shipping:'ส่งเร็ว',
    trust_instock:'มีสต็อกพร้อมส่ง',
    label_model:'รุ่น:',
    label_quote:'ขอใบเสนอราคา',
    stock_in:'มีสินค้า',
    unit_piece:'ชิ้น',
    tax_included:'ยังไม่รวมภาษีมูลค่าเพิ่ม (VAT)',
    badge_shipping_title:'วันที่จัดส่ง:',
    badge_shipping_desc:'จัดส่งตามระยะเวลาส่งของบริษัท',
    add_to_cart:'เพิ่มลงตะกร้า',
    contact_us:'ติดต่อสอบถาม',
    p_desc_title:'รายละเอียดสินค้า',
    notfound_text:'ไม่พบสินค้า',
    notfound_back:'กลับหน้าแรก',
    sticky_add:'เพิ่ม'
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
    copyright:'© 2024 FLUKE. All rights reserved', top_user:'user', top_logout:'Sign out', label_profile:'Profile',

    bc_home:'Home',
    trust_warranty:'1-year warranty',
    trust_fast_shipping:'Fast shipping',
    trust_instock:'In stock',
    label_model:'Model:',
    label_quote:'Request a quote',
    stock_in:'In stock',
    unit_piece:'pcs',
    tax_included:'VAT not included',
    badge_shipping_title:'Delivery date:',
    badge_shipping_desc:'Shipped according to company lead time',
    add_to_cart:'Add to cart',
    contact_us:'Contact us',
    p_desc_title:'Product details',
    notfound_text:'Product not found',
    notfound_back:'Back to home',
    sticky_add:'Add'
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
(function(){
  const EXCHANGE = 38; // THB -> USD
  // ====== Config เส้นทางปลายทางสินค้า ======
  // ถ้าคุณมี route เป็น /product/{iditem} ให้ใช้แบบนี้
  const PRODUCT_PATH = '/product/'; // <-- แก้เป็น path ที่มีอยู่จริง

  const inputs = [
    { el: document.getElementById('globalSearch'), results: document.getElementById('searchResultsDesktop') },
    { el: document.getElementById('mobileSearchInput'), results: document.getElementById('searchResultsMobile') }
  ].filter(x => x.el && x.results);

  if (!inputs.length) return;

  let ALL = [];

  const getLang = () => localStorage.getItem('site_lang')
                   || localStorage.getItem('preferredLanguage')
                   || 'ไทย';

  const fmtTHB = v => new Intl.NumberFormat('th-TH', {
    style:'currency', currency:'THB', minimumFractionDigits:0, maximumFractionDigits:2
  }).format(v);

  const fmtUSD = v => new Intl.NumberFormat('en-US', {
    style:'currency', currency:'USD', minimumFractionDigits:0, maximumFractionDigits:2
  }).format(v);

  // THB -> USD (ปัดขึ้นเป็นเซนต์)
  const toUSD = (thb) => {
    if (!Number.isFinite(thb)) return null;
    const satang = Math.round(thb * 100);
    const cents  = Math.ceil(satang / EXCHANGE);
    return cents / 100;
  };

  const priceText = (p) => {
    if (typeof p === 'number' && isFinite(p)) {
      return (getLang()==='English') ? fmtUSD(toUSD(p)) : fmtTHB(p);
    }
    return (getLang()==='English') ? '$0.00' : '฿—';
  };

  // ดึงตัวเลขจาก string ทุกรูปแบบ (รองรับมี comma/สัญลักษณ์เงิน)
  function parseTHB(raw){
    if (raw == null) return null;
    const s = String(raw).replace(/[^\d.,-]/g,'').replace(/,/g,'');
    if (!s) return null;
    const n = parseFloat(s);
    return Number.isFinite(n) ? n : null;
  }

  // โหลดข้อมูลจาก preload (ต้องมี iditem ด้วย)
  function ensureData(){
    if (ALL.length) return;

    const src = Array.isArray(window.PRODUCTS) ? window.PRODUCTS : [];

    ALL = src.map(x => {
      // รองรับชื่อฟิลด์ราคาได้หลายแบบ
      const rawPrice = (x.webpriceTHB ?? x.webprice_thb ?? x.price ?? null);
      return {
        iditem: x.iditem ?? x.id ?? null,                 // ✅ ต้องมีเพื่อสร้างลิงก์
        name:   x.name || '',
        category: x.category || x.brand || '',
        image:  x.image || x.pic || '',
        price:  parseTHB(rawPrice),                       // ✅ แปลงราคาเป็นตัวเลข
        columnJ: x.columnJ || ''
      };
    })
    // ต้องมีชื่อ + มี iditem และ (มีรูป หรือ มีราคา)
    .filter(x => x.name && x.iditem && (x.image || x.price != null));
  }

  // ลิงก์ไปหน้ารายละเอียดที่มีอยู่จริง
  function buildHref(item){
    // /product/{iditem}
    return PRODUCT_PATH.replace(/\/+$/,'/') + encodeURIComponent(item.iditem);
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
      const href  = buildHref(it);
      const name  = (it.name || '').trim() || '—';
      const cat   = (it.category || '').trim() || '';
      const img   = it.image || '';
      const price = priceText(it.price);

      const row = document.createElement('a');
      row.href = href;
      row.className = 'flex gap-3 items-center px-3 py-2 hover:bg-orange-50 transition-colors';
      row.innerHTML = `
        <div class="h-10 w-10 rounded border bg-white overflow-hidden flex-shrink-0">
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

  // events: desktop + mobile
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

    document.addEventListener('click', (e)=>{
      if (!e.target.closest(`#${target.results.id}, #${target.el.id}`)){
        target.results.classList.add('hidden');
      }
    });
  });

})();
</script>
  {{-- footer --}}
  @include('test.footer')
</body>
</html>
