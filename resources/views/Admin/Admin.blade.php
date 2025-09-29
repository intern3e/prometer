{{-- resources/views/admin/users/index.blade.php --}}
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="utf-8">
  <title>Admin • Users</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="https://img5.pic.in.th/file/secure-sv1/ChatGPT_Image_18_.._2568_12_03_57-removebg-preview.png">
  <style>
    :root{
      --brand:#ff6a00; --ink:#0f172a; --muted:#6b7280; --line:#e5e7eb; --bg:#f5f7fb;
      --card:#ffffff; --shadow:0 10px 30px rgba(2,8,23,.08);
      --sidebar:#101828; --sidebar-ink:#e5e7eb; --sidebar-muted:#94a3b8;
      --fz-12: clamp(11px, 2.6vw, 12px);
      --fz-13: clamp(12px, 2.9vw, 13px);
      --fz-14: clamp(12px, 3.2vw, 14px);
      --fz-15: clamp(13px, 3.6vw, 15px);
      --fz-16: clamp(14px, 3.9vw, 16px);
      --fz-18: clamp(15px, 4.6vw, 18px);
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0; background:var(--bg); color:var(--ink);
      font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial;
      line-height:1.55; font-size: var(--fz-14);
    }

    .shell{display:grid; grid-template-columns:280px 1fr; min-height:100dvh}
    .sidebar{background:var(--sidebar); color:var(--sidebar-ink); position:sticky; top:0; height:100dvh; display:flex; flex-direction:column; padding:16px 14px; gap:12px}
    .brand{display:flex; align-items:center; gap:10px; padding:10px 12px; border-radius:12px; background:rgba(255,255,255,.04)}
    .brand img{width:28px; height:28px; border-radius:6px}
    .brand h1{font-size:16px; margin:0; letter-spacing:.2px}
    .nav{margin-top:6px; display:flex; flex-direction:column; gap:6px}
    .nav a{color:var(--sidebar-ink); text-decoration:none; font-size:var(--fz-14); padding:10px 12px; border-radius:10px; display:flex; align-items:center; gap:10px; opacity:.9}
    .nav a:hover{background:rgba(255,255,255,.06); opacity:1}
    .nav a.active{background:#fff; color:#0f172a; font-weight:700}

    .main{display:flex; flex-direction:column}
    .topbar{position:sticky; top:0; z-index:10; background:linear-gradient(180deg,#ffffff,#ffffff 70%, rgba(255,255,255,.6)); border-bottom:1px solid var(--line); padding:10px 18px; display:flex; align-items:center; justify-content:space-between; gap:12px}
    .left{display:flex; align-items:center; gap:10px}
    .burger{display:inline-flex; align-items:center; justify-content:center; width:36px; height:36px; border-radius:10px; border:1px solid var(--line); background:#fff; cursor:pointer}
    .page-title{font-weight:800; font-size:var(--fz-18); letter-spacing:.2px}
    .top-actions{display:flex; gap:8px; align-items:center}
    .btn{padding:clamp(7px,1.6vw,10px) clamp(10px,2.2vw,14px); border-radius:10px; border:1px solid transparent; background:var(--brand); color:#fff; cursor:pointer; font-weight:600; font-size:var(--fz-13)}
    .btn.ghost{background:#fff; color:#0f172a; border-color:var(--line)}
    .btn.line{background:#fff; color:#0f172a; border:1px solid var(--line)}
    .content{padding:18px; display:grid; gap:16px}
    .card{background:var(--card); border-radius:16px; box-shadow:var(--shadow); overflow:hidden}

    .filters{display:flex; flex-wrap:wrap; gap:8px; align-items:center; padding:14px; border-bottom:1px solid #eef2f7}
    .input,.select{padding:10px 12px; border:1px solid var(--line); border-radius:10px; background:#fff; outline:none; font-size:var(--fz-13)}
    .input{min-width:260px}
    .pill{display:inline-flex; align-items:center; gap:6px; padding:6px 10px; border-radius:999px; background:#f3f4f6; font-size:var(--fz-12)}

    .table-wrap{position:relative; overflow:auto; max-width:100%; -webkit-overflow-scrolling:touch; overscroll-behavior:contain; mask-image:linear-gradient(to right, transparent 0, black 12px, black calc(100% - 12px), transparent 100%)}
    table{width:100%; border-collapse:separate; border-spacing:0; min-width:1280px}
    thead th{position:sticky; top:0; background:#fff; z-index:3; font-size:var(--fz-13); color:#374151; text-align:left; padding:11px 10px; border-bottom:1px solid #eaecef; white-space:nowrap}
    tbody td{font-size:var(--fz-14); padding:12px 10px; border-bottom:1px solid #f1f5f9; vertical-align:top; background:#fff}
    tbody tr:nth-child(odd) td{background:#fcfcfd}
    tbody tr:hover td{background:#f9fafb}

    .nowrap{white-space:nowrap}
    .td-long{word-break:break-word; overflow-wrap:anywhere; hyphens:auto}

    /* email ลิงก์ทั่วไป */
    .mail{color:#2563eb; text-decoration:none; display:inline-block; max-width:100%; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; word-break:normal; overflow-wrap:normal; vertical-align:bottom}
    .mail:hover{text-decoration:underline}
    @media (max-width:768px){ .mail{white-space:normal; word-break:keep-all; overflow-wrap:normal} }

    /* === คุมให้ "ผู้ติดต่อ" และ "อีเมลผู้ติดต่อ" ไม่ตัดก่อน 15 ตัวอักษร === */
    .break-15{word-break:normal !important; overflow-wrap:normal !important}
    .mail-wrap{white-space:normal !important; word-break:keep-all !important; overflow-wrap:normal !important}
    .td-contact{word-break:normal !important; overflow-wrap:normal !important}

    .pw{font-family:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,"Courier New",monospace}
    .btn-cell{padding:4px 8px; font-size:12px; border-radius:8px; border:1px solid var(--line); background:#fff; cursor:pointer}

    th.col-index,td.col-index{width:72px; min-width:72px}
    th.col-id,td.col-id{width:180px; min-width:180px}
    .col-index,.col-id{position:sticky; left:0; z-index:2; background:inherit}
    .col-id{left:72px}
    thead th.col-index,thead th.col-id{z-index:4}

    .chip{display:inline-block; padding:4px 10px; border-radius:999px; font-size:12px; border:1px solid transparent; white-space:nowrap}
    .chip[data-legal="limited"]{background:#eef2ff;color:#3730a3;border-color:#c7d2fe}
    .chip[data-legal="public"]{background:#ecfeff;color:#155e75;border-color:#a5f3fc}
    .chip[data-legal="partnership"]{background:#fef3c7;color:#92400e;border-color:#fde68a}
    .chip[data-legal="sole"]{background:#f0fdf4;color:#166534;border-color:#bbf7d0}
    .chip[data-legal="association"],.chip[data-legal="foundation"]{background:#f5f3ff;color:#5b21b6;border-color:#ddd6fe}
    .chip[data-legal="government"],.chip[data-legal="state"]{background:#fff7ed;color:#9a3412;border-color:#fed7aa}
    .chip[data-legal="international_org"]{background:#f0f9ff;color:#075985;border-color:#bae6fd}
    .chip[data-legal="other"]{background:#f3f4f6;color:#374151;border-color:#e5e7eb}

    .footerbar{display:flex; align-items:center; justify-content:space-between; gap:12px; padding:12px 14px; border-top:1px solid #eef2f7; background:#fff}
    .to-top{position:fixed; right:18px; bottom:18px; display:none; padding:10px 12px; border-radius:12px; background:var(--brand); color:#fff; border:0; box-shadow:0 8px 20px rgba(0,0,0,.15); cursor:pointer}
    .to-top.show{display:block}

    .collapsed .shell{grid-template-columns:76px 1fr}
    .collapsed .sidebar .nav a span,.collapsed .brand h1{display:none}
    .collapsed .sidebar{padding:16px 8px}
    .collapsed .nav a{justify-content:center}

    @media (max-width:1024px){
      .shell{grid-template-columns:76px 1fr}
      .nav a span,.brand h1{display:none}
      .sidebar{padding:16px 8px}
    }

    @media (max-width:768px){
      .table-wrap{overflow:visible; mask-image:none}
      table{min-width:0; border-spacing:0}
      thead{position:absolute; width:1px; height:1px; overflow:hidden; clip:rect(0 0 0 0); white-space:nowrap}
      tbody, tr, td{display:block; width:100%}
      tbody tr{background:#fff; border:1px solid var(--line); border-radius:14px; margin:12px 0; box-shadow:var(--shadow); overflow:hidden}
      tbody td{display:grid; grid-template-columns:132px 1fr; gap:8px; padding:10px 12px; border-bottom:1px solid #f1f5f9; font-size:var(--fz-15)}
      tbody td:last-child{border-bottom:0}
      tbody td::before{content:attr(data-label); font-weight:600; color:var(--muted)}
      .col-index,.col-id,th.col-index,th.col-id{position:static; left:auto; min-width:0; width:auto}
      .btn-cell{justify-self:start}
    }

    #dataTable.dense thead th{padding:8px 8px}
    #dataTable.dense tbody td{padding:8px 8px; font-size:13px}
    html{-webkit-text-size-adjust:100%; text-size-adjust:100%}
  </style>
</head>
<body class="{{ request('nav','') === 'collapsed' ? 'collapsed' : '' }}">
  <div class="shell">
    <aside class="sidebar">
      <div class="brand">
        <img src="https://img5.pic.in.th/file/secure-sv1/ChatGPT_Image_18_.._2568_12_03_57-removebg-preview.png" alt="">
        <h1>FLUKE Admin</h1>
      </div>
      <nav class="nav">
        <a href="{{ url('/admin') }}"><span>📊</span><span>Dashboard</span></a>
        <a class="active" href="{{ route('Admin') }}"><span>👥</span><span>Users</span></a>
        <a href="#"><span>🧾</span><span>Orders</span></a>
        <a href="#"><span>📦</span><span>Products</span></a>
        <a href="#"><span>⚙️</span><span>Settings</span></a>
      </nav>
      <div style="margin-top:auto; opacity:.8; font-size:12px; color:var(--sidebar-muted); padding:8px 10px">© {{ date('Y') }} FLUKE Marketplace</div>
    </aside>

    <section class="main">
      <div class="topbar">
        <div class="left">
          <button type="button" id="burger" class="burger" title="Toggle Menu">☰</button>
          <div class="page-title">รายชื่อลูกค้า (Custdetail)</div>
        </div>
        <div class="top-actions">
          <form method="get" action="{{ route('Admin') }}">
            <input type="hidden" name="nav" value="{{ request('nav') }}">
            <input type="hidden" name="q" value="{{ e($q ?? '') }}">
            <button class="btn line" name="export" value="csv" type="submit">Export CSV</button>
          </form>
          <a class="btn ghost" href="{{ route('Admin') }}">รีเฟรช</a>
        </div>
      </div>

      <div class="content">
        <div class="card">
          <form class="filters" method="get" action="{{ route('Admin') }}">
            <input class="input" id="q" type="text" name="q" value="{{ e($q ?? '') }}" placeholder="ค้นหา: รหัสลูกค้า / ผู้ใช้ / อีเมล / บริษัท / ผู้ติดต่อ / เบอร์ / เลขภาษี">
            <button class="btn" type="submit">ค้นหา</button>
            <span class="pill">ทั้งหมด <strong>{{ number_format($users->count()) }}</strong> รายการ</span>
            @if(!blank($q)) <span class="pill">คำค้น “{{ e($q) }}”</span> @endif
          </form>

          <div class="table-wrap" id="tableWrap">
            <table id="dataTable">
              <thead>
                <tr>
                  <th class="col-index">ลำดับ</th>
                  <th class="col-id">รหัสลูกค้า</th>
                  <th>ชื่อผู้ใช้</th>
                  <th>อีเมล</th>
                  <th>รหัสผ่าน</th>
                  <th>ประเภทนิติบุคคล</th>
                  <th>ชื่อบริษัท/ร้านค้า</th>
                  <th>เลขผู้เสียภาษี</th>
                  <th>สาขา</th>
                  <th>ผู้ติดต่อ</th>
                  <th>อีเมลผู้ติดต่อ</th>
                  <th>โทรผู้ติดต่อ</th>
                  <th>ตำแหน่งผู้ติดต่อ</th>
                </tr>
              </thead>
              <tbody>
              @php
                $legalMap = [
                  'limited' => 'บริษัทจำกัด (Ltd.)',
                  'public' => 'บริษัทมหาชนจำกัด (PLC)',
                  'partnership' => 'ห้างหุ้นส่วน',
                  'sole' => 'บุคคลธรรมดา',
                  'association' => 'สมาคม',
                  'foundation' => 'มูลนิธิ',
                  'government' => 'หน่วยงานรัฐ',
                  'state' => 'รัฐวิสาหกิจ',
                  'international_org' => 'องค์การระหว่างประเทศ',
                  'other' => 'อื่น ๆ',
                ];
              @endphp

              @forelse($users as $i => $u)
                @php
                  $code  = (string)($u->Legalentity_type ?? '');
                  $label = $legalMap[$code] ?? ($code !== '' ? e($code) : '—');
                  $pass  = (string)($u->passuser ?? '');
                  $tel   = (string)($u->tel_contact ?? '');
                @endphp
                <tr>
                  <td class="nowrap col-index" data-label="ลำดับ">{{ $i+1 }}</td>
                  <td class="nowrap col-id" data-label="รหัสลูกค้า"><code>{{ e($u->idcustomer ?? '—') }}</code></td>
                  <td class="td-long" data-label="ชื่อผู้ใช้">{{ e($u->username ?? '—') }}</td>

                  {{-- อีเมลหลัก (เดสก์ท็อปเป็นบรรทัดเดียว + ellipsis) --}}
                  <td data-label="อีเมล">
                    @if(!blank($u->email))
                      @php
                        $em = (string)$u->email;
                        $emHtml = str_replace(['@', '.'], ['@<wbr>', '.<wbr>'], e($em));
                      @endphp
                      <a class="mail" href="mailto:{{ e($u->email) }}" title="{{ e($u->email) }}">{!! $emHtml !!}</a>
                    @else — @endif
                  </td>

                  <td data-label="รหัสผ่าน">
                    @if($pass === '')
                      —
                    @else
                      <span class="pw" data-enc="{{ base64_encode($pass) }}">••••••••</span>
                      <button type="button" class="btn-cell toggle-pw">ดู</button>
                    @endif
                  </td>
                  <td data-label="ประเภทนิติบุคคล"><span class="chip" data-legal="{{ e($code) }}">{{ $label }}</span></td>
                  <td class="td-long" data-label="ชื่อบริษัท/ร้านค้า">{{ e($u->company_name ?? '—') }}</td>
                  <td class="nowrap" data-label="เลขผู้เสียภาษี" style="font-variant-numeric:tabular-nums">{{ e($u->idtax ?? '—') }}</td>
                  <td class="nowrap" data-label="สาขา">{{ e($u->Branch_number ?? '—') }}</td>

                  {{-- ผู้ติดต่อ: ไม่ตัดก่อน 15 ตัวอักษร --}}
                  <td class="td-contact" data-label="ผู้ติดต่อ">
                    @php $contactName = trim((string)($u->main_namecontact ?? '')); @endphp
                    @if($contactName === '') — @else
                      <span class="break-15" data-wbr="15">{{ e($contactName) }}</span>
                    @endif
                  </td>

                  {{-- อีเมลผู้ติดต่อ: ไม่ตัดก่อน 15 ตัวอักษร --}}
                  <td data-label="อีเมลผู้ติดต่อ">
                    @if(!blank($u->email_contact))
                      <a class="mail mail-wrap break-15" data-wbr="15" href="mailto:{{ e($u->email_contact) }}" title="{{ e($u->email_contact) }}">{{ e($u->email_contact) }}</a>
                    @else — @endif
                  </td>

                  <td class="nowrap" data-label="โทรผู้ติดต่อ" style="font-variant-numeric:tabular-nums">
                    @if($tel!=='')
                      <a class="mail" href="tel:{{ e(preg_replace('/\s+/', '', $tel)) }}">{{ e($tel) }}</a>
                    @else — @endif
                  </td>
                  <td class="td-long" data-label="ตำแหน่งผู้ติดต่อ">{{ e($u->rank_contact ?? '—') }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="13" style="text-align:center; padding:28px">
                    <div class="muted">ไม่พบข้อมูลที่ตรงกับเงื่อนไข</div>
                  </td>
                </tr>
              @endforelse
              </tbody>
            </table>
          </div>

          <div class="footerbar">
            <div class="muted">เลื่อนตารางแนวนอนบนเดสก์ท็อป</div>
            <div style="display:flex; gap:8px">
              <button id="scrollTopBtn" class="btn line" type="button">ขึ้นบนสุด</button>
            </div>
          </div>
        </div>
      </div>

      <button id="toTop" class="to-top" title="ขึ้นบนสุด">▲</button>
    </section>
  </div>

  <script>
    // Sidebar toggle
    const burger = document.getElementById('burger');
    burger?.addEventListener('click', () => {
      document.body.classList.toggle('collapsed');
      try{ localStorage.setItem('admin_nav_collapsed', document.body.classList.contains('collapsed') ? '1' : '0'); }catch{}
    });
    (function(){ try{ if(localStorage.getItem('admin_nav_collapsed')==='1'){ document.body.classList.add('collapsed'); } }catch{} })();

    // Toggle password
    document.addEventListener('click', (e) => {
      if (!e.target.classList.contains('toggle-pw')) return;
      const td = e.target.closest('td');
      const span = td?.querySelector('.pw'); if (!span) return;
      const showing = span.dataset.showing === '1';
      if (showing) { span.textContent = '••••••••'; span.dataset.showing = '0'; e.target.textContent = 'ดู'; }
      else {
        try { const raw = span.dataset.enc ? atob(span.dataset.enc) : ''; span.textContent = raw; span.dataset.showing = '1'; e.target.textContent = 'ซ่อน'; }
        catch { span.textContent = ''; }
      }
    });

    // Back to top
    const toTopBtn = document.getElementById('toTop');
    const wrap = document.getElementById('tableWrap');
    const onScroll = () => { const s = (wrap?.scrollTop || window.scrollY); if (s > 240) toTopBtn.classList.add('show'); else toTopBtn.classList.remove('show'); };
    (wrap || window).addEventListener('scroll', onScroll, { passive:true });
    toTopBtn.addEventListener('click', () => { if (wrap) wrap.scrollTo({ top:0, behavior:'smooth' }); else window.scrollTo({ top:0, behavior:'smooth' }); });
    onScroll();

    // Density toggle
    document.getElementById('densityBtn')?.addEventListener('click', () => {
      document.getElementById('dataTable').classList.toggle('dense');
    });

    // ===== Highlight คำค้น: ปลอดภัย ไม่ทำลาย <wbr> =====
    (function(){
      const q = "{{ addslashes((string)($q ?? '')) }}".trim();
      if (!q || q.length < 2) return;
      const esc = s => s.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
      const re = new RegExp(esc(q), 'gi');
      const cells = Array.from(document.querySelectorAll('#dataTable tbody td'))
        .filter(td => !td.querySelector('.pw') && !td.querySelector('button') && !td.querySelector('a.mail:not(.mail-wrap)')); // อนุญาตใน mail-wrap
      const styleMark = 'background:#fff2cc; padding:0 2px; border-radius:3px';
      function highlightNode(root){
        const walker = document.createTreeWalker(root, NodeFilter.SHOW_TEXT, null);
        const nodes = []; while (walker.nextNode()) nodes.push(walker.currentNode);
        nodes.forEach(node => {
          const text = node.nodeValue; if (!text || !re.test(text)) return; re.lastIndex = 0;
          const frag = document.createDocumentFragment(); let last = 0, m;
          while ((m = re.exec(text)) !== null) {
            if (m.index > last) frag.appendChild(document.createTextNode(text.slice(last, m.index)));
            const mark = document.createElement('mark'); mark.style.cssText = styleMark; mark.textContent = m[0];
            frag.appendChild(mark); last = re.lastIndex;
          }
          if (last < text.length) frag.appendChild(document.createTextNode(text.slice(last)));
          node.parentNode.replaceChild(frag, node);
        });
      }
      cells.forEach(td => highlightNode(td));
    })();

    // ===== ใส่ <wbr> อัตโนมัติทุก ๆ N ตัวอักษรสำหรับ [data-wbr] =====
    (function(){
      function insertWbr(el, N){
        const walker = document.createTreeWalker(el, NodeFilter.SHOW_TEXT, null);
        const nodes = []; while (walker.nextNode()) nodes.push(walker.currentNode);
        let count = 0;
        nodes.forEach(node => {
          const s = node.nodeValue || ''; if (!s) return;
          const out = [];
          for (let i=0;i<s.length;i++){
            out.push(document.createTextNode(s[i]));
            count++;
            if (count % N === 0 && i < s.length - 1) out.push(document.createElement('wbr'));
          }
          node.replaceWith(...out);
        });
      }
      document.querySelectorAll('[data-wbr]').forEach(el => {
        const N = parseInt(el.getAttribute('data-wbr'), 10) || 15;
        insertWbr(el, N);
      });
    })();
  </script>
</body>
</html>
