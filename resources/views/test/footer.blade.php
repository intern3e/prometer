<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Footer • myFlukeTH</title>

  <!-- Fonts & Icons -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

  <style>
    :root{
      --brand:#ff6a00;
      --ink:#111827;
      --card:#ffffff;
      --bg:#0b1220;          /* พื้นหลังฟุตเตอร์ */
      --radius:12px;
      --com:#fb923c;         /* สีลิงก์/ปุ่มเปิดแผนที่ */
    }

    html, body{ height:100%; margin:0; overscroll-behavior:none; overflow-x:hidden; }
    body{
      font-family:'Prompt', system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
      background:#f3f4f6; color:var(--ink);
    }



    footer.compact{ font-size:0.9rem; }
    footer.compact .title{ font-size:clamp(1rem, 3.2vw, 1.35rem); line-height:1.15; }
    footer.compact .lead{ font-size:clamp(12px, 2.9vw, 14px); line-height:1.5; }
    footer.compact .contact-grid{ gap:8px; }
    footer.compact .contact-card{ padding:.45rem .6rem; }
    footer.compact .contact-ico{ width:30px; height:30px; }
    footer.compact .contact-ico i{ font-size:12px; }
    footer.compact .round{ border-radius:12px; }
    footer.compact .round-lg{ border-radius:12px; }
    footer.compact .thin{ border:1px solid rgba(255,255,255,.12); }

    /* มือถือ: การ์ดเรียง 1 คอลัมน์, แผนที่สูงตามจอ */
    .map-h{ height:clamp(180px, 42vw, 260px); }
    @media (min-width:480px){ .map-h{ height:clamp(200px, 38vw, 260px); } }
    @media (min-width:768px){
      .map-h{ height:240px; }
      footer.compact .contact-grid{ grid-template-columns:repeat(2,minmax(0,1fr)); }
    }

    /* Background glow */
    footer .halo-a{ width:260px; height:260px; opacity:.18; }
    footer .halo-b{ width:280px; height:280px; opacity:.12; }

    /* Popup สีลิงก์ / ปุ่มปิด */
    .leaflet-popup-content a{ color:var(--com) !important; font-weight:600; }
    .leaflet-popup-content a:hover{ text-decoration:underline; }
    .leaflet-popup-close-button{ color:var(--com); }
    .leaflet-popup-close-button:hover{ color:#fff; background:var(--com); border-radius:8px; }

    /* ซ่อนซูมคอนโทรล */
    .leaflet-control-zoom{ display:none !important; }

    /* ป้องกันแผนที่แย่งสกอลล์บนมือถือ (แตะเพื่อเปิด interaction) */
    .map-wrap{ position:relative; }
    .map-wrap.mobile-guard:not(.active) #hk-map{ pointer-events:none; }
    .map-overlay{
      position:absolute; inset:0; display:flex; align-items:center; justify-content:center;
      background:linear-gradient(180deg, rgba(11,18,32,.02), rgba(11,18,32,.35));
      color:#fff; text-align:center; padding:10px; font-size:12px; line-height:1.4;
      backdrop-filter: blur(2px);
    }
    .map-overlay .pill{
      background:rgba(255,255,255,.92); color:#0b1220;
      padding:6px 10px; border-radius:999px; font-weight:600;
      display:inline-flex; align-items:center; gap:6px;
      box-shadow:0 6px 18px rgba(0,0,0,.18);
    }
    .map-overlay .pill i{ font-size:14px; }

    /* ปุ่มเปิด Google Maps มุมขวาบน (ย่ออัตโนมัติ) */
    .map-actions{ position:absolute; top:8px; right:8px; z-index:500; display:flex; gap:6px; }
    .btn-openmaps{
      appearance:none; border:1px solid rgba(255,255,255,.25);
      background:rgba(255,255,255,.14); color:#fff;
      padding:4px 8px; border-radius:999px; font-size:11px; font-weight:600;
      display:inline-flex; align-items:center; gap:6px;
      backdrop-filter: blur(6px); line-height:1;
    }
    .btn-openmaps:hover{ background:rgba(255,255,255,.22); }
    .btn-openmaps .dot{ width:8px; height:8px; border-radius:999px; background:var(--com); }
    @media (max-width:360px){
      .btn-openmaps .label{ display:none; }
      .btn-openmaps{ padding:4px; }
    }

    /* ป้องกันข้อความยาวล้น (เช่นอีเมล) */
    .break-any{ overflow-wrap:anywhere; word-break:break-word; }
  </style>
</head>

<body>
  <br><br><br>
  <footer class="compact relative overflow-hidden text-white" style="background:var(--bg);">
    <!-- Background glow -->
    <div aria-hidden="true" class="pointer-events-none absolute inset-0">
      <div class="halo-a absolute -top-16 -left-16 rounded-full blur-3xl"
           style="background: radial-gradient(closest-side, #ff6a00, transparent 70%);"></div>
      <div class="halo-b absolute -bottom-20 -right-10 rounded-full blur-3xl"
           style="background: radial-gradient(closest-side, #22c55e, transparent 70%);"></div>
    </div>

    <div class="container-outer section-pad mx-auto py-5 md:py-7 relative">
      <div class="grid md:grid-cols-12 gap-3 md:gap-6 items-start">
        <!-- Left -->
        <div class="md:col-span-7">
          <h3 class="title font-extrabold tracking-tight">
            myFlukeTH<span class="text-orange-400">.com</span>
          </h3>

          <p class="lead mt-2 text-gray-300">
            Measurement and test instrument solutions from
            <span class="text-orange-300 font-semibold">Fluke</span>
            for industrial and engineering applications — multimeters, electrical safety testers,
            thermal imaging cameras, and calibration instruments — all backed by support services
            that meet international standards.
          </p>
          
          <!-- Contacts -->
          <div class="contact-grid mt-3 grid grid-cols-1">
            <!-- Tel -->
            <a href="tel:+66660975697"
               class="group round bg-gradient-to-br from-white/15 to-white/5 p-[1px] transition">
              <div class="contact-card round bg-white/5 backdrop-blur-sm thin flex items-center gap-2.5">
                <span class="contact-ico round thin flex items-center justify-center">
                  <i class="bi bi-telephone text-white/80"></i>
                </span>
                <div class="leading-5">
                  <div class="font-semibold tracking-tight text-[.95rem]">066-097-5697</div>
                  <div class="text-[11px] text-gray-400">(คุณ ผักบุ้ง)</div>
                </div>
              </div>
            </a>

            <!-- Email -->
            <a href="mailto:info@hikaridenki.co.th"
               class="group round bg-gradient-to-br from-white/15 to-white/5 p-[1px] transition">
              <div class="contact-card round bg-white/5 backdrop-blur-sm thin flex items-center gap-2.5">
                <span class="contact-ico round thin flex items-center justify-center">
                  <i class="bi bi-envelope text-white/80"></i>
                </span>
                <div class="leading-5 break-any">
                  <div class="font-semibold tracking-tight text-[.95rem]">Info@hikaridenki.co.th</div>
                  <div class="text-[11px] text-gray-400">(3e trading)</div>
                </div>
              </div>
            </a>

            <!-- LINE (เปิดแอป → ถ้าไม่มีแอปค่อยไปหน้าเว็บ Add Friend) -->
            <a id="lineBtn"
               href="https://line.me/R/ti/p/%40543ubjtx"
               target="_blank" rel="noopener"
               class="group round bg-gradient-to-br from-emerald-400/25 to-emerald-400/10 p-[1px] transition">
              <div class="contact-card round bg-white/5 backdrop-blur-sm thin flex items-center gap-2.5">
                <span class="contact-ico round thin flex items-center justify-center border-emerald-400/40">
                  <img src="https://cdn.simpleicons.org/line/06C755" alt="LINE" class="w-4 h-4" />
                </span>
                <div class="leading-5">
                  <div class="font-semibold tracking-tight text-[.95rem]">LINE: @543ubjtx</div>
                </div>
              </div>
            </a>
          </div>
        </div>

        <!-- Right (Map) -->
        <div class="md:col-span-5">
          <div class="relative round-lg overflow-hidden">
            <div class="absolute inset-0 round-lg bg-gradient-to-br from-white/15 to-white/10 opacity-25 pointer-events-none"></div>

            <div class="relative round-lg thin bg-white/5 backdrop-blur-sm shadow-xl">
              <!-- ปุ่มเปิด Google Maps -->
              <div class="map-actions">
                <button class="btn-openmaps" id="openMapsBtn" type="button" aria-label="Open in Google Maps">
                  <span class="dot" aria-hidden="true"></span>
                  <span class="label" style="color:#0b1220"> Google Maps</span>
                </button>
              </div>

              <!-- กล่องแผนที่ + overlay -->
              <div class="map-wrap mobile-guard md:mobile-guard:!hidden" id="mapWrap">
                <div id="hk-map" class="map-h" role="img" aria-label="แผนที่ตำแหน่ง TRIPLE E TRADING"></div>

                <!-- overlay เฉพาะมือถือ -->
                <div class="map-overlay md:hidden" id="mapOverlay">
                  <span class="pill"><i class="bi bi-hand-index-thumb"></i> แตะเพื่อโต้ตอบแผนที่</span>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- /Right -->
      </div>

      <!-- Footer bottom -->
      <div class="mt-4 border-t border-white/10 pt-3 text-center text-[10px] text-gray-400">
        © 2025 myFlukeTH.com — TRIPLE E TRADING. All rights reserved.
      </div>
    </div>
  </footer>

  <!-- Leaflet JS -->
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script>
    (function () {
      const lat = 13.717683, lng = 100.4732644;

      // หมุดสีแดง (SVG)
      const redSvg = `
<svg xmlns="http://www.w3.org/2000/svg" width="25" height="41" viewBox="0 0 25 41">
  <defs>
    <linearGradient id="g" x1="50%" x2="50%" y1="0%" y2="100%">
      <stop stop-color="#ff4d4f" offset="0%"/>
      <stop stop-color="#d90429" offset="100%"/>
    </linearGradient>
  </defs>
  <path d="M12.5,0 C5.6,0 0,5.6 0,12.5 c0,9.7 11.6,19.8 12.1,20.3 c0.2,0.2 0.6,0.2 0.8,0 c0.5-0.5 12.1-10.6 12.1-20.3 C25,5.6 19.4,0 12.5,0z"
        fill="url(#g)" stroke="#a10014" stroke-width="1"/>
  <circle cx="12.5" cy="12.5" r="4.2" fill="#fff"/>
</svg>`.trim();

      const redIcon = L.icon({
        iconUrl: 'data:image/svg+xml;utf8,' + encodeURIComponent(redSvg),
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
        shadowSize: [41, 41],
        shadowAnchor: [13, 41],
      });

      // ไม่มีปุ่มซูม
      const map = L.map('hk-map', { zoomControl:false }).setView([lat, lng], 17);

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap'
      }).addTo(map);

      const marker = L.marker([lat, lng], { icon: redIcon }).addTo(map);
      marker.bindPopup(`
        <strong>TRIPLE E TRADING</strong><br>
        <a href="https://www.google.com/maps?q=${lat},${lng}" target="_blank" rel="noopener">เปิดใน Google Maps</a>
      `);

      if (window.matchMedia('(min-width: 768px)').matches) { marker.openPopup(); }

      // ===== มือถือ: overlay กันแผนที่แย่งสกอลล์ =====
      const mapWrap = document.getElementById('mapWrap');
      const overlay = document.getElementById('mapOverlay');
      const isMobile = () => window.matchMedia('(max-width: 767.98px)').matches;

      function enableMapInteraction() {
        mapWrap.classList.add('active');     // เปิด pointer-events ให้แผนที่
        overlay.style.display = 'none';
      }
      function disableMapInteraction() {
        mapWrap.classList.remove('active');  // ปิด pointer-events (กลับมาสกอลล์หน้าเว็บ)
        if (isMobile()) overlay.style.display = '';
      }

      if (isMobile()) {
        disableMapInteraction();
        overlay.addEventListener('click', enableMapInteraction, { passive: true });

        let idleTimer;
        map.on('dragstart zoomstart touchstart', () => { clearTimeout(idleTimer); });
        map.on('dragend zoomend touchend', () => {
          clearTimeout(idleTimer);
          idleTimer = setTimeout(disableMapInteraction, 8000);
        });

        document.addEventListener('click', (e) => {
          if (!mapWrap.contains(e.target)) disableMapInteraction();
        });
      }

      // ปุ่มเปิดใน Google Maps (พยายามเปิดแอปก่อน)
      document.getElementById('openMapsBtn').addEventListener('click', function(){
        const deep = `comgooglemaps://?q=${lat},${lng}&zoom=17`;
        const web  = `https://www.google.com/maps?q=${lat},${lng}`;
        const start = Date.now();
        window.location.href = deep;
        setTimeout(function () { if (Date.now() - start < 1200) window.open(web, '_blank', 'noopener'); }, 800);
      });
    })();
  </script>

  <!-- LINE deep link: เปิดแอปก่อน → ถ้าไม่สำเร็จค่อยเปิดหน้า Add Friend บนเว็บ -->
  <script>
    (function () {
      const lineBtn = document.getElementById('lineBtn');
      if (!lineBtn) return;

      lineBtn.addEventListener('click', function (e) {
        e.preventDefault();
        const deep = 'line://ti/p/@543ubjtx';                 // เปิดแอป LINE ไปหน้ากด Add Friend
        const web  = 'https://line.me/R/ti/p/%40543ubjtx';    // fallback หน้า Add Friend บนเว็บ (%40 = @)

        const start = Date.now();
        // พยายามเปิดแอปก่อน
        window.location.href = deep;

        // ถ้าไม่สำเร็จภายใน ~0.7–1.2s ให้เปิดหน้าเว็บแทน
        setTimeout(function () {
          if (Date.now() - start < 1200) {
            window.open(web, '_blank', 'noopener');
          }
        }, 700);
      }, { passive: false });
    })();
  </script>
</body>
</html>
