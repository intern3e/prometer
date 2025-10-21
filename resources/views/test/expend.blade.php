<!doctype html>
<html lang="th">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Custom Pull-to-Refresh</title>
<style>
  /* ===== Base ===== */
  html, body{
    height:100%;
    margin:0;
    overscroll-behavior: none;     /* กัน native refresh ระดับเอกสาร */
    background:#0b1220;
    color:#e5e7eb;
    font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
  }
  .app-scroll{
    position: relative;
    height: 100dvh;
    overflow-y: auto;
    overscroll-behavior-y: contain; /* กัน PTR เดิมใน Chrome/Android */
    -webkit-overflow-scrolling: touch; /* ลื่นบน iOS */
    --pull: 0px; /* จะถูกอัปเดตด้วย JS */
  }

  /* ===== Pull-to-Refresh Indicator (icon only, no background) ===== */
  .ptr{
    position: absolute;
    top: 0; left: 0; right: 0;
    display: flex;
    justify-content: center;
    pointer-events: none;
    z-index: 10;
  }
  .ptr-box{
    display:flex; align-items:center; justify-content:center;
    /* เอาพื้นหลัง/ขอบ/เงาออกทั้งหมด */
    background: transparent;
    border: none;
    box-shadow: none;
    padding: 0;
    width: auto; height: auto;
    transform: translateY(calc(-100% + var(--pull)));
    transition: transform .18s ease;
  }
  .spinner{
    width:18px; height:18px;
    border:3px solid #374151;
    border-top-color:#ff6a00;
    border-radius:50%;
    animation: spin 0.9s linear infinite;
  }
  .arrow{
    width:18px; height:18px; display:inline-block;
    border:3px solid transparent; border-top-color:#ff6a00; border-left-color:#ff6a00;
    transform: rotate(45deg);
  }
  @keyframes spin{ to{ transform:rotate(360deg); } }

  /* ===== Demo content ===== */
  .section{ padding:24px 16px; }
  .card{
    background:#111827; border:1px solid #1f2937; border-radius:14px;
    padding:16px; margin:12px 0;
  }
</style>
</head>
<body>

<div id="app" class="app-scroll">
  <!-- PTR indicator (icon only) -->
  <div class="ptr" aria-hidden="true">
    <div class="ptr-box" id="ptrBox">
      <div id="ptrIcon" class="arrow"></div>
    </div>
  </div>

  <!-- เนื้อหา -->
  <div class="section">
    <h1 style="margin:0 0 8px">ปัดลงค้างเพื่อรีหน้า</h1>
    <p style="margin:0 0 18px; color:#9ca3af">ดึงลงจากบนสุดให้เลยเส้น (≈80px) แล้วค้าง ~0.7 วินาที จะรีเฟรชอัตโนมัติ</p>

    <!-- ทำให้ยาวพอเลื่อน -->
    <div class="card">รายการ 1</div>
    <div class="card">รายการ 2</div>
    <div class="card">รายการ 3</div>
    <div class="card">รายการ 4</div>
    <div class="card">รายการ 5</div>
    <div class="card">รายการ 6</div>
    <div class="card">รายการ 7</div>
    <div class="card">รายการ 8</div>
    <div class="card">รายการ 9</div>
    <div style="height:40vh"></div>
  </div>
</div>

<script>
/*
  Custom Pull-to-Refresh (icon only, no background)
  - ปิด native PTR ด้วย overscroll-behavior + preventDefault ที่ขอบบน
  - ทริกเกอร์เมื่อดึงลง >= threshold แล้ว "ค้าง" ตามกำหนด (holdMs)
*/
(function(){
  const scroller = document.querySelector('.app-scroll');
  const ptrBox  = document.getElementById('ptrBox');
  const ptrIcon = document.getElementById('ptrIcon');

  if(!scroller || !ptrBox || !ptrIcon) return;

  const threshPx = 80;   // ต้องดึงเกินกี่พิกเซล
  const maxPull  = 140;  // ดึงได้สูงสุด (เพื่อหนืด)
  const holdMs   = 700;  // ต้องค้างกี่มิลลิวินาที (0.7s)
  const damp     = v => Math.min(maxPull, v * 0.7); // หนืด 0.7

  let startY = 0;
  let pulling = false;
  let dy = 0;
  let holdTimer = null;
  let fired = false;

  function setPull(px){
    scroller.style.setProperty('--pull', px+'px');
    if (!fired) ptrIcon.className = 'arrow';
  }

  function cancelHold(){
    if (holdTimer){ clearTimeout(holdTimer); holdTimer = null; }
  }

  function beginHoldIfNeeded(){
    if (holdTimer || fired) return;
    if (dy >= threshPx){
      holdTimer = setTimeout(triggerRefresh, holdMs);
    }
  }

  function triggerRefresh(){
    if (fired) return;
    fired = true;
    cancelHold();
    ptrIcon.className = 'spinner';
    setPull(threshPx + 10);
    setTimeout(()=> { location.reload(); }, 250);
  }

  scroller.addEventListener('touchstart', function(e){
    if (!e.touches || e.touches.length === 0) return;
    if (scroller.scrollTop <= 0){
      pulling = true;
      fired = false;
      startY = e.touches[0].clientY;
      dy = 0;
      ptrIcon.className = 'arrow';
      setPull(0);
    } else {
      pulling = false;
    }
  }, {passive: true});

  scroller.addEventListener('touchmove', function(e){
    if (!pulling || !e.touches || e.touches.length === 0) return;
    dy = e.touches[0].clientY - startY;

    if (dy > 0 && scroller.scrollTop <= 0){
      e.preventDefault(); // ต้อง passive:false
      const pull = damp(dy);
      setPull(pull);
      if (pull >= threshPx){
        beginHoldIfNeeded();
      } else {
        cancelHold();
      }
    }
  }, {passive: false});

  function resetPTR(){
    cancelHold();
    setPull(0);
    setTimeout(()=>{}, 180);
  }

  scroller.addEventListener('touchend', function(){
    if (!pulling) return;
    pulling = false;
    if (!fired && dy >= threshPx){
      triggerRefresh();
    } else if (!fired){
      resetPTR();
    }
  }, {passive: true});

  scroller.addEventListener('touchcancel', function(){
    pulling = false;
    if (!fired) resetPTR();
  }, {passive: true});
})();
</script>

</body>
</html>
