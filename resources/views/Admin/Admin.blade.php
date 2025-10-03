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
    .nav a{color:var(--sidebar-ink); text-decoration:none; font-size:var(--fz-14); padding:10px 12px; border-radius:10px; display:flex; align-items:center; gap:10px; opacity:.9; cursor:pointer}
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

    .mail{color:#2563eb; text-decoration:none; display:inline-block; max-width:100%; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; word-break:normal; overflow-wrap:normal; vertical-align:bottom}
    .mail:hover{text-decoration:underline}
    @media (max-width:768px){ .mail{white-space:normal; word-break:keep-all; overflow-wrap:normal} }

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

    /* ==== วิวสลับหน้า ==== */
    .view{display:none}
    .view.show{display:block}
  </style>
</head>
<body class="{{ request('nav','') === 'collapsed' ? 'collapsed' : '' }}">
  @php
    /** ข้อมูล orders ใส่มาให้รองรับทันที ถ้า controller ยังไม่ส่งมาก็สร้าง collection ว่างไว้ */
    $orders = $orders ?? collect(); // ควรส่งมาจาก controller: Order::latest()->take(200)->get();
  @endphp

  <div class="shell">
    <aside class="sidebar">
      <div class="brand">
        <img src="https://img5.pic.in.th/file/secure-sv1/ChatGPT_Image_18_.._2568_12_03_57-removebg-preview.png" alt="">
        <h1>FLUKE Admin</h1>
      </div>
      <nav class="nav" id="sideNav">
        {{-- เปลี่ยนลิงก์ให้เป็น SPA ด้วย data-view + href เป็น hash (ทำงานหน้าเดียว) --}}
        <a data-view="users" href="#/users"><span>👥</span><span>Users</span></a>
        <a data-view="orders" href="#/orders"><span>🧾</span><span>Orders</span></a>
        <a data-view="products" href="#/products"><span>📦</span><span>Products</span></a>
      </nav>
      <div style="margin-top:auto; opacity:.8; font-size:12px; color:var(--sidebar-muted); padding:8px 10px">© {{ date('Y') }} FLUKE Marketplace</div>
    </aside>

    <section class="main">
      <div class="topbar">
        <div class="left">
          <button type="button" id="burger" class="burger" title="Toggle Menu">☰</button>
          <div id="pageTitle" class="page-title">รายชื่อลูกค้า (Custdetail)</div>
        </div>
        <div class="top-actions">
          {{-- ปุ่มด้านขวาปรับให้เปลี่ยนพฤติกรรมตาม view --}}
          <form id="exportForm" method="get" action="{{ route('Admin') }}">
            <input type="hidden" name="nav" value="{{ request('nav') }}">
            <input type="hidden" name="q" value="{{ e($q ?? '') }}">
            <button class="btn line" name="export" value="csv" type="submit">Export CSV</button>
          </form>
          <a class="btn ghost" href="{{ route('Admin') }}">รีเฟรช</a>
        </div>
      </div>

      <div class="content">
        {{-- ===== View: Users (เหมือนเดิม) ===== --}}
        <div class="view" id="view-users">
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

                    {{-- อีเมลหลัก --}}
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

                    {{-- ผู้ติดต่อ --}}
                    <td class="td-contact" data-label="ผู้ติดต่อ">
                      @php $contactName = trim((string)($u->main_namecontact ?? '')); @endphp
                      @if($contactName === '') — @else
                        <span class="break-15" data-wbr="15">{{ e($contactName) }}</span>
                      @endif
                    </td>

                    {{-- อีเมลผู้ติดต่อ --}}
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

{{-- ===== View: Orders (หน้าเดียวกัน — จบในไฟล์เดียว: รวมเลขคำสั่งซื้อซ้ำ + เปลี่ยนสถานะด้วย GET + ป๊อปอัพสินค้า + ป้ายไทย) ===== --}}
<div class="view" id="view-orders" aria-hidden="true">
  <div class="card">

@php
  use App\Models\Order;
  use App\Models\Custdetail;
  use Illuminate\Support\Facades\DB;

  /* ==== INLINE HANDLER (GET): ?status_update=1&id_order=...&status=... ==== */
  if (request('status_update') === '1') {
      $idOrder = (string) request('id_order', '');
      $newSt   = (string) request('status', 'pending');
      if (!in_array($newSt, ['pending','completed','cancelled'], true)) {
          $newSt = 'pending';
      }
      DB::table('tblorder')->where('id_order', $idOrder)->update(['status' => $newSt]);

      // ตอบ JSON ถ้าเป็น AJAX; ไม่งั้นโหลดกลับ
      if (request()->ajax() || request()->header('X-Requested-With') === 'XMLHttpRequest') {
          echo json_encode(['ok' => true, 'status' => $newSt, 'id_order' => $idOrder]);
          exit;
      } else {
          echo '<script>location.replace(location.href.split("?")[0]);</script>';
          exit;
      }
  }

  /* ==== QUERY DATA ==== */
  $q      = trim((string) request('q', ''));
  $status = trim((string) request('status', ''));

  $orderTable = (new Order)->getTable();      // 'tblorder'
  $custTable  = (new Custdetail)->getTable(); // 'custdetail'
  $subTable   = 'subaddress';                 // ปรับชื่อให้ตรงของจริงถ้าต่าง
  $collation  = 'utf8mb4_unicode_ci';

  $raw = Order::query()
      ->from($orderTable.' as o')
      ->leftJoin($custTable.' as c', function ($join) use ($collation) {
          $join->on(DB::raw("c.idcustomer COLLATE $collation"), '=', DB::raw("o.idcustomer COLLATE $collation"));
      })
      ->leftJoin($subTable.' as s', function ($join) use ($collation) {
          $join->on(DB::raw("s.idcustomer COLLATE $collation"), '=', DB::raw("o.idcustomer COLLATE $collation"))
               ->whereRaw("LOWER(o.address) <> 'main'")
               ->whereRaw("o.address REGEXP '^[0-9]+$'")
               ->whereRaw("s.idsubaddress = CAST(o.address AS UNSIGNED)");
      })
      ->when($q !== '', function ($qq) use ($q) {
          $like = '%'.$q.'%';
          $qq->where(function ($w) use ($like) {
              $w->where('o.id_order', 'like', $like)
                ->orWhere('c.company_name', 'like', $like)
                ->orWhere('c.username', 'like', $like)
                ->orWhere('c.email_contact', 'like', $like)
                ->orWhere('c.tel_contact', 'like', $like)
                ->orWhere('o.status', 'like', $like);
          });
      })
      ->when($status !== '', fn($qq) => $qq->where('o.status', $status))
      ->orderByDesc('o.create_at')
      ->limit(10000)
      ->get([
          // จากออเดอร์ (รวมฟิลด์สินค้าเพื่อโชว์ในป๊อปอัพ)
          'o.id_order','o.create_at','o.webpriceTHB','o.quantity','o.status','o.address',
          'o.iditem','o.pic','o.name as order_name',
          // main (ลูกค้า)
          'c.company_name','c.username','c.email_contact','c.tel_contact','c.rank_contact','c.main_namecontact',
          'c.main_address','c.main_subdistrict','c.main_district','c.main_province','c.main_postal','c.main_country',
          // subaddress
          's.idsubaddress',
          's.sub_address','s.sub_subdistrict','s.sub_district','s.sub_province','s.sub_postal','s.sub_country',
          's.sub_namecontact','s.sub_email_contact','s.sub_tel_contact','s.sub_rank_contact',
      ]);

  /* ==== GROUP BY id_order: รวมบรรทัดที่มีเลขออเดอร์ซ้ำ + สรุปยอด + เก็บรายการสินค้า ==== */
  $orders = $raw->groupBy('id_order')->map(function ($rows) {
      $first = $rows->first();

      $grandTotal = 0.0;
      $items = [];
      foreach ($rows as $r) {
          $unit = (float) preg_replace('/[^\d.]/', '', (string)($r->webpriceTHB ?? '0'));
          $qty  = (int) ($r->quantity ?? 0);
          $line = $unit * $qty;
          $grandTotal += $line;
          $items[] = [
              'iditem'     => (string) ($r->iditem ?? ''),
              'name'       => (string) ($r->order_name ?? ''),
              'pic'        => (string) ($r->pic ?? ''),
              'unit_price' => $unit,
              'quantity'   => $qty,
              'line_total' => $line,
          ];
      }

      // ชื่อลูกค้า: "username (company)" ถ้ามีบริษัท
      $company  = trim((string) ($first->company_name ?? ''));
      $baseName = trim((string) ($first->username ?? ''));
      if ($baseName === '') $baseName = trim((string) ($first->order_name ?? ''));
      $displayName = $company !== '' ? ($baseName !== '' ? "$baseName ($company)" : $company) : $baseName;

      // ใช้ main หรือ subaddress จากแถวแรก
      $isMain = strtolower((string)($first->address ?? '')) === 'main';
      if ($isMain) {
          $parts = array_filter([
              trim((string)($first->main_address ?? '')),
              trim((string)($first->main_subdistrict ?? '')),
              trim((string)($first->main_district ?? '')),
              trim((string)($first->main_province ?? '')),
              trim((string)($first->main_postal ?? '')),
              trim((string)($first->main_country ?? '')),
          ], fn($v) => $v !== '');
          $shippingAddr = implode(' ', $parts);
          $contactName  = trim((string)($first->main_namecontact ?? $first->rank_contact ?? ''));
          $email        = trim((string)($first->email_contact ?? ''));
          $tel          = trim((string)($first->tel_contact ?? ''));
      } else {
          $parts = array_filter([
              trim((string)($first->sub_address ?? '')),
              trim((string)($first->sub_subdistrict ?? '')),
              trim((string)($first->sub_district ?? '')),
              trim((string)($first->sub_province ?? '')),
              trim((string)($first->sub_postal ?? '')),
              trim((string)($first->sub_country ?? '')),
          ], fn($v) => $v !== '');
          $shippingAddr = implode(' ', $parts);
          $contactName  = trim((string)($first->sub_namecontact ?? $first->sub_rank_contact ?? ''));
          $email        = trim((string)($first->sub_email_contact ?? ''));
          $tel          = trim((string)($first->sub_tel_contact ?? ''));
      }

      return (object) [
          'id_order'         => $first->id_order,
          'created_at'       => $first->create_at,
          'grand_total'      => $grandTotal,
          'customer_name'    => $displayName,
          'customer_email'   => $email,
          'customer_phone'   => $tel,
          'contact_name'     => $contactName,
          'shipping_address' => $shippingAddr,
          'status'           => $first->status,
          'items'            => $items,
          'items_count'      => count($items),
      ];
  })->values();

  /* ==== ป้ายสถานะภาษาไทย (ค่าเก็บใน DB เป็นอังกฤษตามเดิม) ==== */
  $statusMap = [
    'pending'   => 'กำลังดำเนินการ',
    'completed' => 'เสร็จสิ้น',
    'cancelled' => 'ยกเลิก',
  ];
@endphp

    <!-- ===== Filters (GET) ===== -->
    <form class="filters" method="GET" action="">
      <input class="input" name="q" id="orderQ" type="text"
             value="{{ e(request('q','')) }}"
             placeholder="ค้นหา: เลขที่คำสั่งซื้อ / ลูกค้า / อีเมล / สถานะ">
      <select id="orderStatus" name="status" class="select">
        <option value="">สถานะทั้งหมด</option>
        @foreach ($statusMap as $val => $label)
          <option value="{{ $val }}" @selected(request('status')===$val)>{{ $label }}</option>
        @endforeach
      </select>
      <button id="orderSearchBtn" class="btn" type="submit">ค้นหา</button>
      <span class="pill">ทั้งหมด <strong id="orderCount">{{ number_format($orders->count()) }}</strong> รายการ</span>
    </form>

    <!-- ===== Orders Table ===== -->
    <div class="table-wrap">
      <table id="ordersTable">
        <thead>
          <tr>
            <th class="col-index">ลำดับ</th>
            <th>เลขที่คำสั่งซื้อ</th>
            <th>ชื่อลูกค้า</th>
            <th>อีเมล</th>
            <th>เบอร์ติดต่อ</th>
            <th>ชื่อผู้ติดต่อ</th>
            <th>วันที่สั่ง</th>
            <th>ที่อยู่จัดส่ง</th>
            <th>ยอดรวม</th>
            <th>สถานะ</th>
            <th>การทำงาน</th>
          </tr>
        </thead>
        <tbody>
          @forelse($orders as $o)
            <tr>
              <td class="nowrap col-index" data-label="ลำดับ">{{ $loop->iteration }}</td>

              <td class="nowrap" data-label="เลขที่คำสั่งซื้อ">
                <code>{{ e($o->id_order ?? '') }}</code>
              </td>

              <td class="td-long" data-label="ชื่อลูกค้า">
                {{ e($o->customer_name ?? '') }}
              </td>

              <td data-label="อีเมล">
                @if(!blank($o->customer_email))
                  <a class="mail" href="mailto:{{ e($o->customer_email) }}">{{ e($o->customer_email) }}</a>
                @endif
              </td>

              <td class="nowrap" data-label="เบอร์ติดต่อ">
                {{ e($o->customer_phone ?? '') }}
              </td>

              <td class="nowrap" data-label="ชื่อผู้ติดต่อ">
                {{ e($o->contact_name ?? '') }}
              </td>

              <td class="nowrap" data-label="วันที่สั่ง">
                {{ \Illuminate\Support\Carbon::parse($o->created_at ?? now())->format('Y-m-d H:i') }}
              </td>

              <td class="td-long" data-label="ที่อยู่จัดส่ง">
                {{ e($o->shipping_address ?? '') }}
              </td>

              <td class="nowrap" data-label="ยอดรวม" style="font-variant-numeric:tabular-nums">
                {{ number_format((float)($o->grand_total ?? 0), 2) }}
              </td>

              {{-- ===== สถานะ: ดรอปดาวอัปเดต DB (GET) + ป้ายไทย ===== --}}
              <td class="nowrap" data-label="สถานะ">
                <form class="status-form" method="GET" action="">
                  <input type="hidden" name="status_update" value="1">
                  <input type="hidden" name="id_order" value="{{ e($o->id_order) }}">
                  <select name="status"
                          class="status-select {{ e(($o->status ?? 'pending')) }}"
                          data-initial="{{ e($o->status ?? 'pending') }}"
                          aria-label="เปลี่ยนสถานะ">
                    <option value="pending"   @selected(($o->status ?? 'pending') === 'pending')>{{ $statusMap['pending'] }}</option>
                    <option value="completed" @selected(($o->status ?? '') === 'completed')>{{ $statusMap['completed'] }}</option>
                    <option value="cancelled" @selected(($o->status ?? '') === 'cancelled')>{{ $statusMap['cancelled'] }}</option>
                  </select>
                </form>
              </td>

              {{-- ===== การทำงาน: ปุ่มดูสินค้า -> ป๊อปอัพ ===== --}}
              <td class="nowrap" data-label="การทำงาน">
                <button type="button"
                        class="btn-cell view-items"
                        data-order="{{ e($o->id_order) }}"
                        data-customer="{{ e($o->customer_name) }}"
                        data-items='@json($o->items, JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT)'>
                  ดูสินค้า ({{ (int)($o->items_count ?? 0) }})
                </button>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="11" style="text-align:center; padding:28px">ยังไม่มีคำสั่งซื้อ</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- ===== Footer Bar ===== -->
    <div class="footerbar">
      <div class="muted">Orders แสดงในหน้าเดียวกับ Users (SPA)</div>
      <div style="display:flex; gap:8px">
        <button class="btn line" type="button" id="reloadOrdersBtn">รีเฟรช Orders</button>
      </div>
    </div>

  </div>
</div>

{{-- ===== Modal แสดงสินค้า (ไม่มีสกรอลล์แนวนอน) ===== --}}
<div id="itemsModal" class="modal" aria-hidden="true" style="display:none">
  <div class="modal-backdrop" data-close="1"></div>
  <div class="modal-card" role="dialog" aria-modal="true" aria-labelledby="itemsModalTitle">
    <div class="modal-header">
      <h3 id="itemsModalTitle" class="modal-title">สินค้าในคำสั่งซื้อ</h3>
      <button class="modal-close" type="button" aria-label="ปิด" data-close="1">×</button>
    </div>
    <div class="modal-body">
      <div class="meta">
        <div><strong>เลขที่คำสั่งซื้อ:</strong> <span id="mOrder"></span></div>
        <div><strong>ลูกค้า:</strong> <span id="mCustomer"></span></div>
      </div>

      <div class="table-wrap">
        <table class="items-table">
          <colgroup>
            <col style="width:72px">     {{-- รูป --}}
            <col style="width:140px">    {{-- รหัสสินค้า --}}
            <col style="width:auto">     {{-- ชื่อสินค้า (ยืด/ตัดบรรทัด) --}}
            <col style="width:120px">    {{-- ราคา --}}
            <col style="width:100px">    {{-- จำนวน --}}
            <col style="width:140px">    {{-- รวม --}}
          </colgroup>
          <thead>
            <tr>
              <th>รูป</th>
              <th>รหัสสินค้า</th>
              <th>ชื่อสินค้า</th>
              <th style="text-align:right">ราคา</th>
              <th style="text-align:right">จำนวน</th>
              <th style="text-align:right">รวม</th>
            </tr>
          </thead>
          <tbody id="itemsTbody"></tbody>
          <tfoot>
            <tr>
              <td colspan="5" style="text-align:right"><strong>รวมทั้งสิ้น</strong></td>
              <td style="text-align:right"><strong id="itemsGrand">0.00</strong></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>

@once
<style>
  .status-select{
    padding:6px 10px; border:1px solid #e5e7eb; border-radius:8px;
    font-size:12px; line-height:1.2; background:#fff; cursor:pointer;
  }
  .status-select.pending   { color:#b45309; background:#fff7ed; border-color:#f59e0b; } /* ส้ม */
  .status-select.completed { color:#166534; background:#ecfdf5; border-color:#34d399; } /* เขียว */
  .status-select.cancelled { color:#991b1b; background:#fef2f2; border-color:#f87171; } /* แดง  */

  /* ===== Modal: no horizontal scroll ===== */
  .modal{position:fixed; inset:0; z-index:50;}
  .modal-backdrop{position:absolute; inset:0; background:rgba(0,0,0,.35);}
  .modal-card{
    position:relative;
    margin:3vh auto 0;
    width:min(1280px, 98vw);
    background:#fff; border-radius:12px;
    box-shadow:0 20px 40px rgba(0,0,0,.2);
    overflow:hidden; max-height:94vh;
    display:flex; flex-direction:column;
  }
  .modal-header{display:flex; align-items:center; justify-content:space-between; padding:12px 16px; border-bottom:1px solid #eee;}
  .modal-title{margin:0; font-size:18px;}
  .modal-close{border:0; background:transparent; font-size:22px; cursor:pointer; line-height:1;}
  .modal-body{
    padding:14px 16px;
    overflow-y:auto;                 /* เลื่อนเฉพาะแนวตั้งถ้ารายการยาว */
    overflow-x:hidden;               /* ปิดแนวนอน */
  }
  .meta{display:flex; gap:18px; margin:0 0 10px; font-size:13px; color:#374151;}

  .items-table{
    width:100%;
    border-collapse:collapse;
    table-layout:fixed;              /* ให้ colgroup คุมความกว้าง */
  }
  .items-table th, .items-table td{
    border-bottom:1px solid #eee;
    padding:8px 10px; vertical-align:top;
    white-space:normal;
    word-break:break-word;
    overflow-wrap:anywhere;          /* ตัดบรรทัดคำยาว */
    hyphens:auto;
  }
  .items-table img{
    width:56px; height:56px; object-fit:cover; border-radius:6px; display:block;
  }

  .btn-cell.view-items{padding:6px 10px; border:1px solid #e5e7eb; border-radius:8px; background:#fff; cursor:pointer;}
</style>

<script>
(function () {
  // ปุ่มรีเฟรช
  document.getElementById('reloadOrdersBtn')?.addEventListener('click', () => location.reload());

  // ===== เปลี่ยนสี select ตามสถานะ + อัปเดต DB ด้วย GET
  const applyStyle = (sel) => {
    ['pending','completed','cancelled'].forEach(s => sel.classList.remove(s));
    const v = (sel.value || 'pending').toLowerCase();
    sel.classList.add(v);
  };

  document.querySelectorAll('.status-select').forEach(sel => {
    applyStyle(sel);
    sel.addEventListener('change', async () => {
      applyStyle(sel);
      const form = sel.closest('.status-form');
      const url  = new URL(form.action || window.location.href);
      url.searchParams.set('status_update', '1');
      url.searchParams.set('id_order', form.querySelector('input[name="id_order"]').value);
      url.searchParams.set('status', sel.value);

      sel.disabled = true;
      try {
        const res = await fetch(url.toString(), {
          method: 'GET',
          headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });
        if (!res.ok) throw new Error('bad response');
      } catch (e) {
        window.location.href = url.toString(); // fallback โหลดหน้าใหม่
      } finally {
        sel.disabled = false;
      }
    });
  });

  // ===== Modal แสดงสินค้า
  const modal = document.getElementById('itemsModal');
  const tbody = document.getElementById('itemsTbody');
  const grand = document.getElementById('itemsGrand');
  const mOrder = document.getElementById('mOrder');
  const mCustomer = document.getElementById('mCustomer');

  const fmt = (num) => {
    try { return Number(num).toLocaleString('th-TH', {minimumFractionDigits:2, maximumFractionDigits:2}); }
    catch { return (Math.round((+num||0)*100)/100).toFixed(2); }
  };

  const openModal = (orderId, customer, items) => {
    mOrder.textContent = orderId || '';
    mCustomer.textContent = customer || '';

    tbody.innerHTML = '';
    let total = 0;
    (items || []).forEach(it => {
      total += (+it.line_total || 0);
      const tr = document.createElement('tr');

      const tdImg = document.createElement('td');
      if (it.pic) {
        const img = document.createElement('img');
        img.src = it.pic; img.alt = it.name || '';
        tdImg.appendChild(img);
      }
      tr.appendChild(tdImg);

      const tdCode = document.createElement('td');
      tdCode.textContent = it.iditem || '';
      tr.appendChild(tdCode);

      const tdName = document.createElement('td');
      tdName.textContent = it.name || '';
      tr.appendChild(tdName);

      const tdPrice = document.createElement('td');
      tdPrice.style.textAlign = 'right';
      tdPrice.textContent = fmt(it.unit_price || 0);
      tr.appendChild(tdPrice);

      const tdQty = document.createElement('td');
      tdQty.style.textAlign = 'right';
      tdQty.textContent = (it.quantity ?? 0);
      tr.appendChild(tdQty);

      const tdLine = document.createElement('td');
      tdLine.style.textAlign = 'right';
      tdLine.textContent = fmt(it.line_total || 0);
      tr.appendChild(tdLine);

      tbody.appendChild(tr);
    });
    grand.textContent = fmt(total);

    modal.style.display = 'block';
    modal.setAttribute('aria-hidden','false');
  };

  const closeModal = () => {
    modal.style.display = 'none';
    modal.setAttribute('aria-hidden','true');
  };

  document.addEventListener('click', (e) => {
    // เปิดป๊อปอัพ
    const btn = e.target.closest('.view-items');
    if (btn) {
      const orderId = btn.dataset.order || '';
      const customer = btn.dataset.customer || '';
      let items = [];
      try { items = JSON.parse(btn.dataset.items || '[]'); } catch {}
      openModal(orderId, customer, items);
    }
    // ปิดป๊อปอัพ
    if (e.target.matches('[data-close="1"]') || e.target.classList.contains('modal-backdrop')) {
      closeModal();
    }
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeModal();
  });
})();
</script>
@endonce


        </div>

{{-- ===== View: Products (read-only + Add via GET + Delete), 100/หน้า ===== --}}
<div class="view" id="view-products" aria-hidden="false">
  @php
    $pp   = max(1, min(100, (int) request('pp', 100)));
    $page = max(1, (int) request('page', 1));
    $q    = trim((string) request('q', ''));

    $needCols = ['iditem','id','pic','name','model','PriceTHB','Stock','category','document'];

    $products = collect(); $total = 0; $tableName = null; $cols = []; $cats = [];
    $db = \DB::connection()->getDatabaseName();
    $okAdd = request('ok') == '1';
    $okDel = request('ok_del') == '1';
    $error = null;

    // เริ่มต้นเลขรหัสออโต้ ถ้าไม่มีของเดิม
    $defaultPrefix = 'F-';
    $defaultPad    = 5;

    try {
      // หา table อัตโนมัติ
      $ph = implode(',', array_fill(0, count($needCols), '?'));
      $cand = \DB::select(
        "SELECT TABLE_NAME, SUM(CASE WHEN COLUMN_NAME IN ($ph) THEN 1 ELSE 0 END) matched
         FROM INFORMATION_SCHEMA.COLUMNS
         WHERE TABLE_SCHEMA=? GROUP BY TABLE_NAME
         ORDER BY matched DESC, TABLE_NAME ASC",
        array_merge($needCols, [$db])
      );
      if (!empty($cand) && (int)$cand[0]->matched >= 1) $tableName = $cand[0]->TABLE_NAME;
      if (!$tableName) {
        foreach (['fluke','products','tblproduct','product','items','item'] as $try) {
          $exists = \DB::select(
            "SELECT 1 FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA=? AND TABLE_NAME=? LIMIT 1",
            [$db, $try]
          );
          if (!empty($exists)) { $tableName = $try; break; }
        }
      }

      if ($tableName) {
        $colRes = \DB::select(
          "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA=? AND TABLE_NAME=?",
          [$db, $tableName]
        );
        $cols = array_map(fn($o) => $o->COLUMN_NAME, $colRes);

        // PK: iditem > id > คอลัมน์แรก
        $pk = in_array('iditem',$cols) ? 'iditem' : (in_array('id',$cols) ? 'id' : ($cols[0] ?? null));

        /* ===== ลบ (ผ่าน GET) ===== */
        if (request('do') === 'delete' && $pk) {
          $key = request('_pk');
          if ($key !== null && $key !== '') {
            \DB::table($tableName)->where($pk, $key)->delete();
            header('Location: '.request()->url().'?'.http_build_query(['ok_del'=>1,'q'=>$q,'pp'=>$pp,'page'=>$page])); exit;
          }
        }

        /* ===== เพิ่ม (ผ่าน GET) ===== */
        if (request('do') === 'create') {
          $payload = [];
          foreach ($needCols as $c) {
            if (!in_array($c,$cols)) continue;

            if ($c === 'category') {
              $cv = request('category');
              if ($cv === '__new__') $cv = trim((string) request('category_new',''));
              $payload['category'] = $cv;

            } elseif ($c === 'document') {
              // อ่านจาก document_enc (ถ้ามี) แล้ว normalize เบา ๆ
              $docRaw = request()->has('document_enc')
                ? (string) request('document_enc','')
                : (string) request('document','');
              if (request()->has('document_enc')) $docRaw = urldecode($docRaw);

              $doc = trim($docRaw);
              if ($doc !== '') {
                $doc = preg_replace('/\s+/u', ' ', $doc);
                $doc = trim($doc);

                if (!preg_match('~^(?:[a-z][a-z0-9+.\-]*:)?//~i', $doc)
                    && !preg_match('~^(?:data|blob|mailto|tel|file):~i', $doc)) {
                  $doc = ltrim($doc);
                  if (strpos($doc, '//') === 0) $doc = 'https:' . $doc;
                  else $doc = 'https://' . ltrim($doc, '/');
                }
                $payload['document'] = $doc;
              }

            } else {
              $payload[$c] = trim((string) request($c,''));
            }
          }

          // ====== ตรวจขั้นต่ำ + ล็อค iditem ฝั่งเซิร์ฟเวอร์ ======
          if ($pk === 'iditem') {
            // ถ้ามีคอลัมน์ iditem ให้คำนวณใหม่ไม่สนค่าจาก client
            $last = \DB::table($tableName)
              ->whereNotNull('iditem')->where('iditem','<>','')
              ->orderByRaw('LENGTH(iditem) DESC')->orderBy('iditem','DESC')
              ->value('iditem');
            $prefix = $defaultPrefix; $pad = $defaultPad; $num = 1;
            if ($last && preg_match('/^(.+?)(\d+)$/', $last, $m)) {
              $prefix = $m[1]; $pad = strlen($m[2]); $num = (int)$m[2] + 1;
            }
            $candidate = $prefix . str_pad((string)$num, $pad, '0', STR_PAD_LEFT);
            $tries=0;
            while (\DB::table($tableName)->where('iditem',$candidate)->exists() && $tries<50) {
              $num++; $candidate = $prefix . str_pad((string)$num, $pad, '0', STR_PAD_LEFT); $tries++;
            }
            $payload['iditem'] = $candidate;
          }

          if ($pk && empty($payload[$pk] ?? '')) {
            $error = "กรุณาใส่ค่า $pk";
          } elseif (in_array('name',$cols) && empty($payload['name'] ?? '')) {
            $error = "กรุณาใส่ชื่อสินค้า";
          } elseif (in_array('category',$cols) && (empty($payload['category'] ?? ''))) {
            $error = "กรุณาเลือกหมวดหมู่ หรือระบุหมวดหมู่ใหม่";
          } elseif ($pk && \DB::table($tableName)->where($pk,$payload[$pk])->exists()) {
            $error = "รหัสซ้ำ ($pk)";
          }

          if (!$error) {
            \DB::table($tableName)->insert($payload);
            header('Location: '.request()->url().'?'.http_build_query(['ok'=>1,'q'=>$q,'pp'=>$pp,'page'=>$page])); exit;
          }
        }

        // หมวดหมู่สำหรับดรอปดาวน์
        if (in_array('category',$cols)) {
          $cats = \DB::table($tableName)->select('category')
                  ->whereNotNull('category')->where('category','<>','')
                  ->distinct()->orderBy('category')->pluck('category')->toArray();
        }

        // อ่านรายการ + ค้นหา + แบ่งหน้า
        $selectCols = array_values(array_intersect($needCols, $cols));
        if (empty($selectCols)) $selectCols = $cols;

        $orderCol = in_array('name',$cols) ? 'name' : (in_array('iditem',$cols) ? 'iditem' : ($cols[0] ?? null));

        $base = \DB::table($tableName);
        if ($q !== '') {
          $like = '%'.str_replace(' ','%',$q).'%';
          $base->where(function($qq) use($like,$cols){
            foreach (['iditem','id','name','model','category','PriceTHB'] as $c) {
              if (in_array($c,$cols)) $qq->orWhere($c,'like',$like);
            }
          });
        }
        if ($orderCol) $base->orderBy($orderCol);

        $total    = (clone $base)->count();
        $products = (clone $base)->select($selectCols)->forPage($page,$pp)->get();

        // สร้างเลข iditem อัตโนมัติสำหรับฟอร์ม
        $suggestPk = '';
        if ($pk === 'iditem') {
          $last = \DB::table($tableName)
            ->whereNotNull('iditem')->where('iditem','<>','')
            ->orderByRaw('LENGTH(iditem) DESC')->orderBy('iditem','DESC')
            ->value('iditem');
          $prefix = $defaultPrefix; $pad = $defaultPad; $num = 1;
          if ($last && preg_match('/^(.+?)(\d+)$/', $last, $m)) {
            $prefix = $m[1]; $pad = strlen($m[2]); $num = (int)$m[2] + 1;
          }
          $suggestPk = $prefix . str_pad((string)$num, $pad, '0', STR_PAD_LEFT);
        } elseif ($pk === 'id') {
          $maxId = (int) (\DB::table($tableName)->max('id') ?? 0);
          $suggestPk = (string) ($maxId + 1);
        }
      }
    } catch (\Throwable $e) { $error = $error ?: $e->getMessage(); }

    $lastPage = max(1, (int) ceil(($total ?: 0) / $pp));
    function page_url($page,$pp){ return request()->fullUrlWithQuery(['page'=>$page,'pp'=>$pp]); }
  @endphp

  <div class="card" style="padding:18px">
    <div style="display:flex;gap:12px;align-items:center;justify-content:space-between;flex-wrap:wrap;margin-bottom:12px">
      <h3 style="margin:0">Products</h3>
      <form method="GET" style="display:flex;gap:8px;align-items:center;flex-wrap:wrap">
        <input type="text" name="q" value="{{ $q }}" placeholder="ค้นหา: รหัส / ชื่อ / รุ่น / หมวดหมู่ / ราคา"
               style="height:40px;border:1px solid #e5e7eb;border-radius:10px;padding:0 12px;min-width:260px">
        <input type="hidden" name="pp" value="{{ $pp }}">
        <button type="submit" style="height:40px;border-radius:10px;border:1px solid #ff6a00;background:#ff6a00;color:#fff;padding:0 16px;cursor:pointer">ค้นหา</button>
        <a href="{{ request()->url() }}" style="height:40px;display:inline-flex;align-items:center;border-radius:10px;border:1px solid #e5e7eb;background:#fff;color:#111827;padding:0 16px;text-decoration:none">ล้าง</a>
        <span style="display:inline-flex;align-items:center;gap:8px;height:32px;border:1px solid #e5e7eb;padding:0 12px;border-radius:999px;background:#fff;color:#374151">ทั้งหมด <strong>{{ number_format($total) }}</strong> รายการ</span>
        <button type="button" id="btnAdd" style="height:40px;border-radius:10px;border:1px solid #16a34a;background:#16a34a;color:#fff;padding:0 16px;cursor:pointer">+ เพิ่มสินค้า</button>
      </form>
    </div>

    @if($okAdd)
      <div style="margin:6px 0 12px;padding:10px 12px;border:1px solid #d1fae5;background:#ecfdf5;color:#065f46;border-radius:10px">เพิ่มสินค้าเรียบร้อยแล้ว</div>
    @endif
    @if($okDel)
      <div style="margin:6px 0 12px;padding:10px 12px;border:1px solid #fee2e2;background:#fff1f2;color:#991b1b;border-radius:10px">ลบสินค้าเรียบร้อยแล้ว</div>
    @endif
    @if($error)
      <div style="margin:6px 0 12px;padding:10px 12px;border:1px solid #fee2e2;background:#fef2f2;color:#991b1b;border-radius:10px">{{ $error }}</div>
    @endif

    <div class="table-wrap" style="overflow:auto">
      <table style="width:100%;border-collapse:separate;border-spacing:0">
        <thead>
          <tr style="background:#fafafa">
            <th style="text-align:left;padding:10px 12px;border-bottom:1px solid #e5e7eb;width:64px">ภาพ</th>
            <th style="text-align:left;padding:10px 12px;border-bottom:1px solid #e5e7eb;white-space:nowrap">รหัส</th>
            <th style="text-align:left;padding:10px 12px;border-bottom:1px solid #e5e7eb">ชื่อสินค้า</th>
            <th style="text-align:left;padding:10px 12px;border-bottom:1px solid #e5e7eb">รุ่น</th>
            <th style="text-align:left;padding:10px 12px;border-bottom:1px solid #e5e7eb;white-space:nowrap">ราคา (THB)</th>
            <th style="text-align:left;padding:10px 12px;border-bottom:1px solid #e5e7eb">สต็อก</th>
            <th style="text-align:left;padding:10px 12px;border-bottom:1px solid #e5e7eb">หมวดหมู่</th>
            <th style="text-align:left;padding:10px 12px;border-bottom:1px solid #e5e7eb">เอกสาร</th>
            <th style="text-align:right;padding:10px 12px;border-bottom:1px solid #e5e7eb;width:90px">จัดการ</th>
          </tr>
        </thead>
        <tbody>
          @forelse($products as $p)
            @php
              $pic      = property_exists($p,'pic') ? $p->pic : null;
              $iditem   = property_exists($p,'iditem') ? $p->iditem : (property_exists($p,'id') ? $p->id : null);
              $name     = property_exists($p,'name') ? $p->name : null;
              $model    = property_exists($p,'model') ? $p->model : null;
              $price    = property_exists($p,'PriceTHB') ? $p->PriceTHB : null;
              $stock    = property_exists($p,'Stock') ? $p->Stock : null;
              $category = property_exists($p,'category') ? $p->category : null;
              $document = property_exists($p,'document') ? $p->document : null;
            @endphp
            <tr>
              <td style="padding:10px 12px;border-bottom:1px solid #e5e7eb">
                @if(!empty($pic))
                  <img src="{{ $pic }}" alt="{{ e($name ?? '') }}"
                       style="width:48px;height:48px;object-fit:cover;border-radius:8px;border:1px solid #e5e7eb;background:#fff"
                       onerror="this.src='data:image/svg+xml;utf8,&lt;svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2248%22 height=%2248%22&gt;&lt;rect width=%2248%22 height=%2248%22 fill=%22%23f3f4f6%22/&gt;&lt;text x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 font-size=%2210%22 fill=%22%239ca3af%22&gt;N/A&lt;/text&gt;&lt;/svg&gt;'">
                @endif
              </td>
              <td style="padding:10px 12px;border-bottom:1px solid #e5e7eb;white-space:nowrap"><code>{{ e($iditem ?? '—') }}</code></td>
              <td style="padding:10px 12px;border-bottom:1px solid #e5e7eb;max-width:520px;overflow:hidden;text-overflow:ellipsis">{{ e($name ?? '—') }}</td>
              <td style="padding:10px 12px;border-bottom:1px solid #e5e7eb">{{ e($model ?? '—') }}</td>
              <td style="padding:10px 12px;border-bottom:1px solid #e5e7eb;white-space:nowrap">{{ ($price!==null && $price!=='') ? number_format((float)$price,2) : '—' }}</td>
              <td style="padding:10px 12px;border-bottom:1px solid #e5e7eb">{{ ($stock!==null && $stock!=='') ? e($stock) : '—' }}</td>
              <td style="padding:10px 12px;border-bottom:1px solid #e5e7eb"><span style="display:inline-block;border:1px solid #e5e7eb;border-radius:8px;padding:2px 8px;font-size:12px;background:#f9fafb">{{ e($category ?? '—') }}</span></td>
              <td style="padding:10px 12px;border-bottom:1px solid #e5e7eb">
                @if(!empty($document))
                  <a href="{{ $document }}" target="_blank" rel="noopener">เปิดเอกสาร</a>
                @else — @endif
              </td>
              <td style="padding:10px 12px;border-bottom:1px solid #e5e7eb;text-align:right">
                @if($iditem)
                  <form method="GET" onsubmit="return confirm('ยืนยันการลบรายการนี้?');" style="display:inline">
                    <input type="hidden" name="do" value="delete">
                    <input type="hidden" name="_pk" value="{{ $iditem }}">
                    <input type="hidden" name="q" value="{{ $q }}">
                    <input type="hidden" name="pp" value="{{ $pp }}">
                    <input type="hidden" name="page" value="{{ $page }}">
                    <button type="submit" style="padding:6px 10px;border-radius:8px;border:1px solid #ef4444;background:#ef4444;color:#fff;cursor:pointer">ลบ</button>
                  </form>
                @endif
              </td>
            </tr>
          @empty
            <tr><td colspan="9" style="padding:12px;color:#6b7280">ไม่พบรายการ</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($lastPage > 1)
      <div style="display:flex;gap:6px;flex-wrap:wrap;padding:12px 0">
        @if($page > 1)
          <a href="{{ page_url($page-1, $pp) }}" style="border:1px solid #e5e7eb;padding:6px 10px;border-radius:8px;text-decoration:none;color:#111">«</a>
        @else <span style="border:1px solid #e5e7eb;padding:6px 10px;border-radius:8px;opacity:.5">«</span> @endif
        @php $start = max(1, $page-2); $end = min($lastPage, $page+2); @endphp
        @for($p=$start; $p<=$end; $p++)
          @if($p == $page)
            <span style="border:1px solid #ff6a00;background:#ff6a00;color:#fff;padding:6px 10px;border-radius:8px">{{ $p }}</span>
          @else
            <a href="{{ page_url($p, $pp) }}" style="border:1px solid #e5e7eb;padding:6px 10px;border-radius:8px;text-decoration:none;color:#111">{{ $p }}</a>
          @endif
        @endfor
        @if($page < $lastPage)
          <a href="{{ page_url($page+1, $pp) }}" style="border:1px solid #e5e7eb;padding:6px 10px;border-radius:8px;text-decoration:none;color:#111">»</a>
        @else
          <span style="border:1px solid #e5e7eb;padding:6px 10px;border-radius:8px;opacity:.5">»</span>
        @endif
      </div>
    @endif
  </div>

  {{-- ===== Modal: เพิ่มสินค้าใหม่ (ส่งแบบ GET) ===== --}}
  <div id="addModal" style="position:fixed;inset:0;background:rgba(15,23,42,.45);display:none;align-items:center;justify-content:center;padding:16px;z-index:9999">
    <div style="background:#fff;border:1px solid #e5e7eb;border-radius:16px;max-width:780px;width:100%;box-shadow:0 20px 50px rgba(2,8,23,.15)">
      <div style="padding:14px 16px;border-bottom:1px solid #e5e7eb;display:flex;justify-content:space-between;align-items:center">
        <strong>เพิ่มสินค้าใหม่</strong>
        <button type="button" id="btnClose" style="border:1px solid #e5e7eb;background:#fff;border-radius:8px;padding:6px 10px;cursor:pointer">ปิด</button>
      </div>

      <form method="GET" style="padding:16px 16px 18px;display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:12px">
        <input type="hidden" name="do" value="create">
        <input type="hidden" name="q" value="{{ $q }}">
        <input type="hidden" name="pp" value="{{ $pp }}">
        <input type="hidden" name="page" value="{{ $page }}">

        @php
          $has = fn($c) => in_array($c,$cols);
          $pk  = in_array('iditem',$cols) ? 'iditem' : (in_array('id',$cols) ? 'id' : null);
        @endphp

        @if($pk)
          <div>
            <label style="display:block;font-size:12px;color:#6b7280;margin-bottom:4px">
              {{ $pk==='iditem' ? 'รหัสสินค้า (iditem)' : 'รหัส (id)' }}
            </label>

            @if($pk === 'iditem')
              {{-- ล็อคอ่านอย่างเดียว --}}
              <input name="{{ $pk }}" value="{{ $suggestPk ?? '' }}"
                     readonly aria-readonly="true" onfocus="this.blur()"
                     title="ระบบกำหนดให้อัตโนมัติ"
                     style="width:100%;height:40px;border:1px solid #e5e7eb;border-radius:10px;padding:0 10px;background:#f9fafb;color:#6b7280;cursor:not-allowed">
              <small style="display:block;color:#6b7280;margin-top:6px">ระบบจะกำหนดรหัสสินค้าให้อัตโนมัติและไม่อนุญาตให้แก้ไข</small>
            @else
              <input name="{{ $pk }}" placeholder="เช่น 1001" value="{{ $suggestPk ?? '' }}"
                     style="width:100%;height:40px;border:1px solid #e5e7eb;border-radius:10px;padding:0 10px" required>
            @endif
          </div>
        @endif

        @if($has('name'))
          <div>
            <label style="display:block;font-size:12px;color:#6b7280;margin-bottom:4px">ชื่อสินค้า</label>
            <input name="name" placeholder="เช่น Fluke 754 Documenting Process Calibrator"
                   style="width:100%;height:40px;border:1px solid #e5e7eb;border-radius:10px;padding:0 10px" required>
          </div>
        @endif

        @if($has('model'))
          <div>
            <label style="display:block;font-size:12px;color:#6b7280;margin-bottom:4px">รุ่น (Model)</label>
            <input name="model" placeholder="เช่น 754"
                   style="width:100%;height:40px;border:1px solid #e5e7eb;border-radius:10px;padding:0 10px">
          </div>
        @endif

        @if($has('PriceTHB'))
          <div>
            <label style="display:block;font-size:12px;color:#6b7280;margin-bottom:4px">ราคา (THB)</label>
            <input name="PriceTHB" inputmode="decimal" placeholder="เช่น 399248.8"
                   style="width:100%;height:40px;border:1px solid #e5e7eb;border-radius:10px;padding:0 10px">
          </div>
        @endif

        @if($has('Stock'))
          <div>
            <label style="display:block;font-size:12px;color:#6b7280;margin-bottom:4px">สต็อก</label>
            <input name="Stock" inputmode="numeric" placeholder="เช่น 5"
                   style="width:100%;height:40px;border:1px solid #e5e7eb;border-radius:10px;padding:0 10px">
          </div>
        @endif

        @if($has('pic'))
          <div>
            <label style="display:block;font-size:12px;color:#6b7280;margin-bottom:4px">ลิงก์รูปภาพ (URL)</label>
            <input id="inPic" name="pic" placeholder="https://…/image.jpg"
                   style="width:100%;height:40px;border:1px solid #e5e7eb;border-radius:10px;padding:0 10px">
          </div>
          <div style="display:flex;align-items:flex-end;gap:10px">
            <img id="imgPrev" alt="Preview" style="width:96px;height:96px;object-fit:cover;border:1px solid #e5e7eb;border-radius:12px;background:#f8fafc"
                 onerror="this.style.opacity=0.35;this.src='data:image/svg+xml;utf8,&lt;svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2296%22 height=%2296%22&gt;&lt;rect width=%2296%22 height=%2296%22 fill=%22%23f3f4f6%22/&gt;&lt;text x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 font-size=%2212%22 fill=%22%239ca3af%22&gt;No Image&lt;/text&gt;&lt;/svg&gt;'">
          </div>
        @endif

        @if($has('category'))
          <div>
            <label style="display:block;font-size:12px;color:#6b7280;margin-bottom:4px">หมวดหมู่</label>
            <select id="selCat" name="category" required
                    style="width:100%;height:40px;border:1px solid #e5e7eb;border-radius:10px;padding:0 10px">
              <option value="">— เลือกหมวดหมู่ —</option>
              @foreach($cats as $c)<option value="{{ $c }}">{{ $c }}</option>@endforeach
              <option value="__new__">+ เพิ่มหมวดหมู่ใหม่…</option>
            </select>
            <small id="catErr" style="display:none;color:#b91c1c;margin-top:6px">กรุณาเลือกหมวดหมู่ หรือระบุหมวดหมู่ใหม่</small>
          </div>
          <div id="catNewWrap" style="display:none">
            <label style="display:block;font-size:12px;color:#6b7280;margin-bottom:4px">หมวดหมู่ใหม่</label>
            <input id="catNew" name="category_new" placeholder="พิมพ์ชื่อหมวดหมู่"
                   style="width:100%;height:40px;border:1px solid #e5e7eb;border-radius:10px;padding:0 10px">
            <small id="catNewErr" style="display:none;color:#b91c1c;margin-top:6px">กรุณาระบุชื่อหมวดหมู่ใหม่</small>
          </div>
        @endif

        @if($has('document'))
          <div style="grid-column:span 2">
            <label style="display:block;font-size:12px;color:#6b7280;margin-bottom:4px">
              ลิงก์เอกสาร (PDF/แคตตาล็อก)
            </label>
            <div style="display:flex;gap:8px;align-items:center">
              <input id="docRaw" name="document" placeholder="เช่น https://example.com/file.pdf หรือ https://example.com/a"
                     style="flex:1;height:40px;border:1px solid #e5e7eb;border-radius:10px;padding:0 10px">
              <a id="docOpenBtn" href="#" target="_blank" rel="noopener"
                 style="height:40px;display:inline-flex;align-items:center;border-radius:10px;border:1px solid #2563eb;background:#2563eb;color:#fff;padding:0 14px;text-decoration:none;white-space:nowrap">เปิดเอกสาร ↗</a>
            </div>
            <input type="hidden" id="docEnc" name="document_enc">
            <small style="color:#6b7280;display:block;margin-top:6px">
              ระบบจะเติม https:// ให้อัตโนมัติถ้ายังไม่ได้ใส่โปรโตคอล
            </small>
          </div>
        @endif

        <div style="grid-column:span 2;display:flex;gap:8px;justify-content:flex-end;margin-top:4px">
          <button type="button" id="btnCancel" style="border:1px solid #e5e7eb;background:#fff;border-radius:10px;padding:10px 16px;cursor:pointer">ยกเลิก</button>
          <button type="submit" style="border:1px solid #16a34a;background:#16a34a;color:#fff;border-radius:10px;padding:10px 16px;cursor:pointer">บันทึกสินค้าใหม่</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    (function(){
      const $ = (s,c=document)=>c.querySelector(s);

      /* ---------- Modal open/close ---------- */
      const modal = $('#addModal');
      $('#btnAdd')?.addEventListener('click', ()=> modal.style.display='flex');
      $('#btnClose')?.addEventListener('click', ()=> modal.style.display='none');
      $('#btnCancel')?.addEventListener('click', ()=> modal.style.display='none');
      modal?.addEventListener('click', (e)=>{ if(e.target===modal) modal.style.display='none'; });

      /* ---------- พรีวิวรูป ---------- */
      const inPic=$('#inPic'), img=$('#imgPrev');
      if(inPic && img){
        const upd=()=>{ const v=inPic.value.trim(); img.style.opacity=v?1:.35; if(v) img.src=v; };
        inPic.addEventListener('input', upd); upd();
      }

      /* ---------- หมวดหมู่ใหม่ ---------- */
      const sel=$('#selCat'), wrap=$('#catNewWrap'), catNew=$('#catNew');
      const catErr=$('#catErr'), catNewErr=$('#catNewErr');
      function toggleCategoryNew() {
        if (!sel) return;
        const isNew = sel.value === '__new__';
        if (wrap) wrap.style.display = isNew ? 'block' : 'none';
        if (catNew) { catNew.required = isNew; if (!isNew) catNew.value=''; }
      }
      sel?.addEventListener('change', toggleCategoryNew);
      toggleCategoryNew();

      /* ---------- Document: only open (no preview) ---------- */
      const form   = document.querySelector('#addModal form');
      const docRaw = $('#docRaw');
      const docEnc = $('#docEnc');
      const openBt = $('#docOpenBtn');

      function normalizeUrl(v){
        let url = (v||'').trim();
        if (!url) return '';
        if (url.startsWith('//')) return 'https:' + url;
        if (!/^(?:[a-z][a-z0-9+.\-]*:)?\/\//i.test(url)
            && !/^(data|blob|mailto|tel|file):/i.test(url)) {
          url = 'https://' + url.replace(/^\/+/, '');
        }
        return url;
      }
      function updateOpenLink(){
        if (!docRaw || !openBt) return;
        const u = normalizeUrl(docRaw.value || '');
        openBt.href = u || '#';
        openBt.style.opacity = u ? 1 : .5;
        openBt.style.pointerEvents = u ? 'auto' : 'none';
      }
      docRaw?.addEventListener('input', updateOpenLink);
      updateOpenLink();

      /* ---------- Validate + encode ก่อน submit ---------- */
      function validateBeforeSubmit() {
        let ok = true;
        if (sel) {
          const isEmpty = sel.value === '';
          const isNew = sel.value === '__new__';
          if (catErr) catErr.style.display = (isEmpty ? 'block' : 'none');
          sel.setCustomValidity(isEmpty ? 'กรุณาเลือกหมวดหมู่' : '');
          if (isEmpty) ok = false;

          if (isNew && catNew) {
            const emptyNew = catNew.value.trim() === '';
            if (catNewErr) catNewErr.style.display = (emptyNew ? 'block' : 'none');
            catNew.setCustomValidity(emptyNew ? 'กรุณาระบุชื่อหมวดหมู่ใหม่' : '');
            if (emptyNew) ok = false;
          } else if (catNew) {
            catNew.setCustomValidity('');
            if (catNewErr) catNewErr.style.display = 'none';
          }
        }

        if (docRaw && docEnc) {
          const v = (docRaw.value || '').trim();
          docEnc.value = v ? encodeURIComponent(v) : '';
        }
        return ok;
      }

      if (form) {
        form.addEventListener('submit', function(e){
          if (!validateBeforeSubmit()) {
            e.preventDefault();
            if (sel && sel.validationMessage) sel.focus();
            else if (catNew && catNew.validationMessage) catNew.focus();
          }
        }, { capture: true });

        catNew?.addEventListener('input', ()=> validateBeforeSubmit());
      }
    })();
  </script>
</div>



      <button id="toTop" class="to-top" title="ขึ้นบนสุด">▲</button>
    </section>
  </div>

  <script>
    // ===== Utils SPA =====
    const $ = (s, r=document) => r.querySelector(s);
    const $$ = (s, r=document) => Array.from(r.querySelectorAll(s));
    const VIEWS = ['users','orders','products','settings'];
    const TITLE_MAP = {
      users: 'รายชื่อลูกค้า (Custdetail)',
      orders: 'รายการสั่งซื้อ (Orders)',
      products: 'สินค้า (Products)',
    };

    // Sidebar toggle
    const burger = document.getElementById('burger');
    burger?.addEventListener('click', () => {
      document.body.classList.toggle('collapsed');
      try{ localStorage.setItem('admin_nav_collapsed', document.body.classList.contains('collapsed') ? '1' : '0'); }catch{}
    });
    (function(){ try{ if(localStorage.getItem('admin_nav_collapsed')==='1'){ document.body.classList.add('collapsed'); } }catch{} })();

    // ====== Single Page View Switcher ======
    function setActiveNav(view){
      $$('#sideNav a').forEach(a => a.classList.toggle('active', a.dataset.view === view));
    }
    function showView(view){
      if(!VIEWS.includes(view)) view = 'users';
      $$('.view').forEach(el => el.classList.remove('show'));
      const el = $('#view-' + view);
      el?.classList.add('show');
      // Title
      const title = TITLE_MAP[view] || 'Admin';
      $('#pageTitle').textContent = title;

      // ปุ่ม export เปลี่ยนโหมดตาม view (ตัวอย่าง: Users export CSV เดิม, Orders เปลี่ยน name=value)
      const exportForm = $('#exportForm');
      if(view === 'users'){
        exportForm.querySelector('button[type="submit"]').textContent = 'Export CSV';
        exportForm.querySelector('button[type="submit"]').name = 'export';
        exportForm.querySelector('button[type="submit"]').value = 'csv';
      }else if(view === 'orders'){
        exportForm.querySelector('button[type="submit"]').textContent = 'Export Orders';
        exportForm.querySelector('button[type="submit"]').name = 'export_orders';
        exportForm.querySelector('button[type="submit"]').value = 'csv';
      }else{
        exportForm.querySelector('button[type="submit"]').textContent = 'Export';
        exportForm.querySelector('button[type="submit"]').name = 'export';
        exportForm.querySelector('button[type="submit"]').value = 'csv';
      }

      // เก็บ state
      try{
        history.replaceState({view}, '', '#/'+view);
        localStorage.setItem('admin_view', view);
      }catch{}
      setActiveNav(view);
    }
    // init by hash/localStorage
    (function(){
      const hashView = (location.hash || '').replace(/^#\/?/, '');
      const saved = localStorage.getItem('admin_view');
      const initial = VIEWS.includes(hashView) ? hashView : (VIEWS.includes(saved) ? saved : 'users');
      showView(initial);
      window.addEventListener('hashchange', () => {
        const v = (location.hash || '').replace(/^#\/?/, '');
        showView(VIEWS.includes(v)?v:'users');
      });
      // nav clicks
      $$('#sideNav a').forEach(a=>{
        a.addEventListener('click', (e)=>{
          // ทำให้แน่ใจว่าทำงานเป็น SPA
          e.preventDefault();
          const v = a.dataset.view;
          showView(v);
        });
      });
    })();

    // ===== Users: Toggle password =====
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

    // Density toggle (ถ้าต้องการเชื่อมปุ่ม)
    document.getElementById('densityBtn')?.addEventListener('click', () => {
      document.getElementById('dataTable').classList.toggle('dense');
    });

    // ===== Highlight คำค้นใน Users (ปลอดภัย ไม่ทำลาย <wbr>) =====
    (function(){
      const q = "{{ addslashes((string)($q ?? '')) }}".trim();
      if (!q || q.length < 2) return;
      const esc = s => s.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
      const re = new RegExp(esc(q), 'gi');
      const cells = Array.from(document.querySelectorAll('#dataTable tbody td'))
        .filter(td => !td.querySelector('.pw') && !td.querySelector('button') && !td.querySelector('a.mail:not(.mail-wrap)'));
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

    // ===== ใส่ <wbr> อัตโนมัติสำหรับ [data-wbr] =====
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

    // ===== Orders: ค้นหาแบบ client-side (ไม่ต้องสร้างหน้าใหม่) =====
    (function(){
      const qEl = $('#orderQ');
      const stEl = $('#orderStatus');
      const btn = $('#orderSearchBtn');
      const tbody = $('#ordersTable tbody');
      const countEl = $('#orderCount');

      function normalize(s){ return (s||'').toString().toLowerCase().trim(); }

      function filter(){
        const q = normalize(qEl.value);
        const st = normalize(stEl.value);
        let visible = 0;
        $$('#ordersTable tbody tr').forEach(tr=>{
          if(tr.querySelector('td[colspan]')) return; // ข้ามแถว "ยังไม่มีคำสั่งซื้อ"
          const cells = Array.from(tr.children).map(td=>td.innerText.toLowerCase());
          const matchQ = q === '' || cells.some(t=>t.includes(q));
          const statusCell = tr.querySelector('[data-label="สถานะ"] .chip')?.textContent.toLowerCase() || '';
          const matchS = st === '' || statusCell === st;
          const show = matchQ && matchS;
          tr.style.display = show ? '' : 'none';
          if(show) visible++;
        });
        if(countEl) countEl.textContent = new Intl.NumberFormat().format(visible);
      }
      btn?.addEventListener('click', filter);
      qEl?.addEventListener('keydown', e=>{ if(e.key==='Enter'){ e.preventDefault(); filter(); }});
      stEl?.addEventListener('change', filter);

      // ปุ่มรีเฟรช orders (SPA): โหลดผ่าน fetch เป็น option ถ้ามี route คืน partial/JSON
      $('#reloadOrdersBtn')?.addEventListener('click', async ()=>{
        // ถ้าอยากให้รีเฟรชจริง ให้สร้าง route: GET /admin/orders?ajax=1 คืนเป็น HTML <tbody> หรือ JSON
        // ที่นี่ใส่โครงให้ก่อน: ลองยิงไปที่ route('Admin') ด้วยพารามิเตอร์ view=orders&ajax=1 แล้วแทน tbody
        try{
          const url = new URL('{{ route('Admin') }}', location.origin);
          url.searchParams.set('view','orders');
          url.searchParams.set('ajax','1');
          const res = await fetch(url.toString(), {headers:{'X-Requested-With':'XMLHttpRequest'}});
          if(res.ok){
            const html = await res.text();
            // สมมุติ backend ส่งเฉพาะ <tbody> มา
            const tmp = document.createElement('div'); tmp.innerHTML = html.trim();
            const newBody = tmp.querySelector('tbody') || tmp;
            if(newBody && tbody){
              tbody.replaceWith(newBody);
            }
            filter();
          }else{
            alert('โหลด Orders ไม่สำเร็จ');
          }
        }catch(err){
          console.error(err);
          alert('เกิดข้อผิดพลาดในการโหลด Orders');
        }
      });
    })();
  </script>
</body>
</html>
