<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>FLUKE Marketplace Style</title>
  <link rel="icon" type="image/png" href="https://img5.pic.in.th/file/secure-sv1/ChatGPT_Image_18_.._2568_12_03_57-removebg-preview.png" />

  <!-- Tailwind CDN สำหรับยูทิลิตี้และ responsive -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <style>
    :root{ --brand:#f59e0b; --ink:#0f172a; --muted:#64748b; --line:#e2e8f0; --bg:#fafafa; --card:#ffffff; --radius:16px; --ring:rgba(245,158,11,.35); }
    html,body{height:100%} body{ background:var(--bg); color:var(--ink); margin:0; }
    #profileRoot{ color:var(--ink); }
    .container{ max-width:1080px; margin:0 auto; padding:min(4vw,16px); }
    #profileRoot .muted{ color:var(--muted); }
    #profileRoot .grid{ display:grid; gap:1rem; }
    #profileRoot .grid-cols-12{ grid-template-columns:repeat(12,minmax(0,1fr)); }
    #profileRoot .col-span-12{ grid-column:span 12 / span 12; }
    #profileRoot .md\:col-span-4,#profileRoot .md\:col-span-8{ grid-column:span 12 / span 12; }
    @media (min-width:768px){ #profileRoot .md\:col-span-4{ grid-column:span 4 / span 4; } #profileRoot .md\:col-span-8{ grid-column:span 8 / span 8; } }
    #profileRoot .card{ background:var(--card); border:1px solid var(--line); border-radius:var(--radius); }
    #profileRoot .section{ padding:1rem; } @media (min-width:768px){ #profileRoot .section{ padding:1.25rem; } }
    #profileRoot .shadow-soft{ box-shadow:0 8px 30px rgba(0,0,0,.06); }
    #profileRoot .divider{ height:1px; background:var(--line); margin:1rem 0; }
    #profileRoot .title{ font-weight:800; }
    #profileRoot .avatar{ width:64px; height:64px; border-radius:50%; object-fit:cover; border:2px solid var(--line); }
    #profileRoot .badge{ display:inline-flex; align-items:center; gap:.375rem; padding:.35rem .6rem; font-size:.8125rem; line-height:1; border:1px solid var(--line); border-radius:999px; background:#fff; color:var(--ink); }
    #profileRoot .chip{ display:inline-flex; align-items:center; padding:.25rem .6rem; font-size:.75rem; line-height:1; border-radius:999px; background:#f1f5f9; color:#0f172a; border:1px solid #e5e7eb; }
    #profileRoot .btn{ appearance:none; display:inline-flex; align-items:center; justify-content:center; gap:.5rem; padding:.5rem .9rem; border-radius:999px; border:1px solid var(--line); background:#fff; color:var(--ink); font-weight:600; font-size:clamp(.85rem,.8rem + .2vw,.95rem); text-decoration:none; transition:.18s ease-in-out; cursor:pointer; }
    #profileRoot .btn:hover{ transform:translateY(-1px) } #profileRoot .btn:active{ transform:translateY(0) }
    #profileRoot .btn:focus-visible{ outline:3px solid var(--ring); outline-offset:2px; box-shadow:0 0 0 4px var(--ring); }
    #profileRoot .btn-primary{ background:var(--brand); color:#fff; border-color:transparent; } #profileRoot .btn-primary:hover{ filter:brightness(.96) }
    #profileRoot .btn-outline{ background:#fff; color:var(--ink); border-color:var(--line) } #profileRoot .btn-outline:hover{ background:#f9fafb }
    #profileRoot .btn-block{ width:100% }
    #profileRoot .tablist{ display:flex; gap:.5rem; flex-wrap:nowrap; overflow:auto; padding:.25rem; margin:.25rem -0.25rem 0; }
    #profileRoot .tab{ padding:.45rem .9rem; border-radius:999px; background:#fff; border:1px solid var(--line); font-weight:600; font-size:.9rem; color:var(--ink); cursor:pointer; transition:.18s ease-in-out; white-space:nowrap; }
    #profileRoot .tab:hover{ background:#f9fafb; }
    #profileRoot .tab[aria-selected="true"]{ background:rgba(245,158,11,.10); border-color:var(--brand); color:var(--brand); box-shadow:0 0 0 2px rgba(245,158,11,.12) inset; }
    #profileRoot [role="tabpanel"]{ outline:none; }
    #profileRoot .list-row{ display:flex; align-items:center; justify-content:space-between; gap:1rem; padding:.75rem 0; border-bottom:1px solid var(--line); }
    #profileRoot .list-row:last-child{ border-bottom:0; }
    @media (max-width:640px){ #profileRoot .list-row{ flex-direction:column; align-items:flex-start; } #profileRoot .list-row .btn{ width:100% } }
    #profileRoot nav a{ color:var(--muted); text-decoration:none; } #profileRoot nav a:hover{ text-decoration:underline; }
    @media (prefers-color-scheme:dark){ :root{ --ink:#e5e7eb; --muted:#9ca3af; --line:#334155; --bg:#0b1220; --card:#0f172a; --ring:rgba(245,158,11,.45); } #profileRoot .btn-outline{ background:transparent } #profileRoot .chip{ background:#0b1220; border-color:#1f2937; color:#e5e7eb } #profileRoot .badge{ background:#0b1220; border-color:#1f2937; color:#e5e7eb } }
    #panel-warranty .ci-list { padding:.5rem 1rem 1rem; }
    #panel-warranty .list-row{ display:grid; grid-template-columns:240px 1fr; gap:.75rem; align-items:center; padding:.5rem 0; border-top:1px solid var(--line); }
    #panel-warranty .list-row:first-child{ border-top:none } #panel-warranty .k{ font-weight:600; color:var(--ink) } #panel-warranty .v{ color:#111827 }
    @media (max-width:640px){ #panel-warranty .list-row{ grid-template-columns:1fr; gap:.25rem } #panel-warranty .k{ font-size:.9375rem } }
    .skeleton{ display:inline-block; min-width:12ch; height:.95rem; border-radius:6px; background:linear-gradient(90deg,#eee,#f5f5f5,#eee); background-size:200% 100%; animation:shimmer 1.25s linear infinite; color:transparent; }
    @keyframes shimmer{ 0%{ background-position:200% 0 } 100%{ background-position:-200% 0 } }
    #panel-orders{ scroll-margin-top:80px; }
  </style>
</head>
<body>
  {{-- Header --}}
  @include('test.header-nav')

  {{-- PHP Helper สำหรับที่อยู่ --}}
  @php
    if (!function_exists('formatThaiAddress')) {
      function formatThaiAddress($addr=null,$subdistrict=null,$district=null,$province=null,$postal=null,$country=null){
        $provinceStr = (string)$province; $isBkk = preg_match('/กรุงเทพ|bangkok/i',$provinceStr)===1;
        $parts=[]; $addr=trim((string)$addr); if($addr!=='')$parts[]=$addr;
        $sd=trim((string)$subdistrict); if($sd!=='')$parts[] = ($isBkk?'แขวง ':'ตำบล ').$sd;
        $dt=trim((string)$district); if($dt!=='')$parts[] = ($isBkk?'เขต ':'อำเภอ ').$dt;
        $pv=trim($provinceStr); if($pv!=='')$parts[] = ($isBkk?'':'จังหวัด ').$pv;
        $po=trim((string)$postal); if($po!=='')$parts[] = $po;
        $ct=trim((string)$country); if($ct!=='')$parts[] = $ct;
        return trim(implode(' ',$parts));
      }
    }
    $ship = formatThaiAddress(
      $custdetail->main_address ?? null,
      $custdetail->main_subdistrict ?? null,
      $custdetail->main_district ?? null,
      $custdetail->main_province ?? null,
      $custdetail->main_postal ?? null,
      $custdetail->main_country ?? null
    );
  @endphp

  <main class="container" id="profileRoot" data-orders="{{ $ordersCount ?? 0 }}" data-addresses="{{ $addressesCount ?? 0 }}" data-warranty="{{ $warrantyCount ?? 0 }}">
    <nav class="muted text-sm my-2">
      <a href="/" data-i18n="home" class="text-slate-500 hover:underline">หน้าแรก</a>
      <span class="mx-1.5">/</span>
      <span data-i18n="profile_page" aria-current="page">โปรไฟล์ของฉัน</span>
    </nav>

    <div class="grid grid-cols-12 gap-4">
      <!-- ซ้าย -->
      <section class="card shadow-soft section md:col-span-4 col-span-12 bg-white rounded-2xl p-5 md:p-6" aria-labelledby="profileSummaryHdr">
        <div class="flex items-center gap-4">
          <div class="min-w-0">
            <h1 id="profileSummaryHdr" class="text-xl md:text-[1.375rem] font-extrabold leading-tight truncate" data-i18n="label_profile">โปรไฟล์</h1>
            <div class="mt-1 text-sm text-slate-500 break-all">{{ \Illuminate\Support\Str::limit($custdetail->email ?? '', 30, '...') }}</div>
          </div>
        </div>

        <div class="flex flex-wrap gap-2 mt-5">
          <a href="/account/edit" class="btn btn-primary w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 rounded-xl" data-i18n="edit_profile">แก้ไขโปรไฟล์</a>
        </div>

        <hr class="my-5 border-slate-200">

        <div class="grid grid-cols-2 gap-4 text-center" aria-label="สรุปสถิติ">
          <div class="rounded-xl border border-slate-100 p-4">
            <div class="mx-auto mb-2 w-9 h-9 rounded-full bg-slate-50 flex items-center justify-center"><i class="bi bi-bag text-base opacity-70"></i></div>
            <div class="text-2xl font-bold tracking-tight tabular-nums" data-stat="orders">{{ number_format($ordersCount) }}</div>
            <div class="text-xs text-slate-500" data-i18n="orders">คำสั่งซื้อ</div>
          </div>
          <div class="rounded-xl border border-slate-100 p-4">
            <div class="mx-auto mb-2 w-9 h-9 rounded-full bg-slate-50 flex items-center justify-center"><i class="bi bi-geo-alt text-base opacity-70"></i></div>
            <div class="text-2xl font-bold tracking-tight tabular-nums" data-stat="addresses">{{ number_format($addressesCount) }}</div>
            <div class="text-xs text-slate-500" data-i18n="addresses">ที่อยู่</div>
          </div>
        </div>

        <div class="mt-4"><span class="font-bold" data-i18n="buy">วิธีการชำระ</span></div>
      </section>

      <!-- ขวา -->
      <section class="md:col-span-8 col-span-12" aria-label="รายละเอียดโปรไฟล์">
        <div class="card shadow-soft section pb-2">
          <div class="title flex items-center justify-between gap-2 flex-wrap">
            <span data-i18n="account_overview">ข้อมูลบัญชี</span>
            <div class="tablist" role="tablist" aria-label="สลับแท็บ">
              <button class="tab" role="tab" aria-selected="true" data-tab="overview"  data-i18n="tab_summary">สรุป</button>
              <button class="tab" role="tab" aria-selected="false" data-tab="orders"    data-i18n="tab_orders">คำสั่งซื้อ</button>
              <button class="tab" role="tab" aria-selected="false" data-tab="addresses" data-i18n="tab_addresses">ที่อยู่</button>
              <button class="tab" role="tab" aria-selected="false" data-tab="warranty"  data-i18n="tab_warranty">บริษัท</button>
            </div>
          </div>

          <div class="divider"></div>

          <!-- OVERVIEW -->
          <div id="panel-overview" role="tabpanel" tabindex="-1">
            <div class="grid grid-cols-1 gap-4">
              <div class="card section">
                <input type="hidden" id="idcustomer" name="idcustomer" value="{{ e($custdetail->idcustomer ?? '') }}" />
                <div class="title" data-i18n="contact_info">ข้อมูลติดต่อ</div>
                <div class="muted mt-2" data-i18n="full_name">ชื่อ-สกุล</div><div>{{ $custdetail->main_namecontact ?? '—' }}</div>
                <div class="muted mt-2" data-i18n="email">อีเมล</div><div>{{ $custdetail->email_contact ?? '—' }}</div>
                <div class="muted mt-2" data-i18n="phone">เบอร์โทร</div><div>{{ $custdetail->tel_contact ?? '—' }}</div>
              </div>

              <div class="card section">
                <div class="title" data-i18n="company_org">บริษัท/หน่วยงาน</div>
                <div class="muted mt-2" data-i18n="company_name">ชื่อบริษัท (ถ้ามี)</div><div>{{ $custdetail->company_name ?? '—' }}</div>
                <div class="muted mt-2" data-i18n="customer_type">ที่อยู่จัดส่งหลัก</div><div>{{ $ship !== '' ? e($ship) : '—' }}</div>
              </div>
            </div>
          </div>

          <!-- ORDERS -->
          <div id="panel-orders" role="tabpanel" tabindex="-1" hidden>
            <div class="card section">
              <div class="title text-lg font-extrabold" data-i18n="order_history">ประวัติคำสั่งซื้อ</div>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-4">
                @forelse($ordersPaged as $o)
                  @php
                    $dateStr   = \Illuminate\Support\Str::of($o->create_at ?? '')->replace('T',' ')->__toString();
                    $totalTxt  = number_format($o->total_thb, 2);
                    $qtyTxt    = number_format($o->total_qty);
                    $statusClasses = [
                      'pending'   => 'bg-amber-50 text-amber-700 ring-1 ring-amber-200',
                      'paid'      => 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200',
                      'shipped'   => 'bg-sky-50 text-sky-700 ring-1 ring-sky-200',
                      'completed' => 'bg-emerald-50 text-emerald-800 ring-1 ring-emerald-200',
                      'cancelled' => 'bg-rose-50 text-rose-700 ring-1 ring-rose-200',
                    ];
                    $status = strtolower((string)($o->status ?? ''));
                    $statusClass = $statusClasses[$status] ?? 'bg-slate-50 text-slate-600 ring-1 ring-slate-200';
                    $statusKey = 'status_' . ($status ?: 'unknown');
                  @endphp

                  <div class="rounded-2xl border border-slate-200/70 bg-white p-4 md:p-5 hover:shadow-md hover:border-slate-300 transition">
                    <!-- ✅ หัวการ์ด: ป้ายสถานะไม่ตกบรรทัด -->
                    <div class="flex items-start justify-between gap-3 md:flex-nowrap">
                      <!-- ซ้าย: ให้ยืด-หดได้และตัดข้อความยาว -->
                      <div class="min-w-0 flex-1">
                        <div class="text-base md:text-[1.05rem] font-semibold leading-tight truncate">
                          <span data-i18n="order_id_label">คำสั่งซื้อ:</span>
                          <span class="tabular-nums">{{ $o->id_order }}</span>
                        </div>
                        <div class="text-sm text-slate-500 mt-0.5 truncate">
                          <span data-i18n="ordered_on">วันที่สั่ง:</span>
                          <span class="tabular-nums">{{ $dateStr ?: '—' }}</span>
                        </div>
                      </div>
                      <!-- ขวา: ป้ายสถานะ ไม่หด/ไม่ตัดคำ/ชิดบน -->
                      <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium {{ $statusClass }} shrink-0 whitespace-nowrap self-start">
                        <span data-i18n="{{ $statusKey }}">
                          {{ ['pending'=>'รอดำเนินการ','paid'=>'ชำระแล้ว','shipped'=>'จัดส่งแล้ว','completed'=>'สำเร็จ','cancelled'=>'ยกเลิก'][$status] ?? ($o->status ?? '—') }}
                        </span>
                      </span>
                    </div>

                    @php
                      $fromItems = collect($o->items ?? [])->map(function($it){
                        return $it->pic ?? $it->image ?? $it->image_url ?? $it->thumbnail_url ?? $it->thumb ?? $it->thumb_url ?? $it->photo ?? $it->photo_url ?? null;
                      })->filter();
                      $fromThumbs = collect($o->thumbs ?? []);
                      $allThumbs  = $fromItems->concat($fromThumbs)->filter()->unique()->values()->all();

                      if (!empty($o->names) && is_array($o->names)) {
                        $allNames = $o->names;
                      } elseif (!empty($o->items)) {
                        $allNames = collect($o->items)->map(fn($it)=> $it->name ?? $it->product_name ?? $it->title ?? null)->filter()->values()->all();
                      } else { $allNames = []; }
                    @endphp

                    @if(count($allThumbs))
                      <div class="mt-3 -mx-1 overflow-x-auto">
                        <div class="flex gap-2 px-1">
                          @foreach($allThumbs as $pic)
                            <img src="{{ $pic }}" alt="thumb" class="w-12 h-12 rounded-xl object-cover ring-1 ring-slate-200 flex-shrink-0" loading="lazy">
                          @endforeach
                        </div>
                      </div>
                    @endif

                    @if(count($allNames))
                      <div class="mt-3">
                        <div class="text-sm font-semibold text-slate-800" data-i18n="items">สินค้า</div>
                        <ul class="mt-1 space-y-1 max-h-56 overflow-auto pr-1">
                          @foreach($allNames as $nm)
                            <li class="text-sm text-slate-700 leading-relaxed">{{ $nm }}</li>
                          @endforeach
                        </ul>
                      </div>
                    @endif

                    <hr class="my-4 border-slate-200/80">

                    <div class="flex items-center justify-between">
                      <div class="text-sm text-slate-600">
                        <span data-i18n="total_qty">จำนวนรวม:</span>
                        <strong class="text-slate-800 tabular-nums">{{ $qtyTxt }}</strong>
                        <span data-i18n="pieces">ชิ้น</span>
                      </div>
                      <div class="text-base md:text-lg font-bold tabular-nums">฿{{ $totalTxt }}</div>
                    </div>
                  </div>
                @empty
                  <div class="rounded-xl border border-dashed border-slate-300 p-8 text-center text-slate-500" data-i18n="no_orders_found">ไม่พบคำสั่งซื้อตามเงื่อนไข</div>
                @endforelse
              </div>

              {{-- Pagination --}}
              @if($ordersPaged->hasPages())
                @php $paginator = $ordersPaged->appends(request()->query()); $urls = $paginator->getUrlRange(1,$paginator->lastPage()); @endphp
                <div class="mt-5 flex flex-wrap justify-center gap-2">
                  @if ($paginator->onFirstPage())
                    <span class="btn btn-outline opacity-50 cursor-not-allowed" data-i18n="prev">ก่อนหน้า</span>
                  @else
                    <a class="btn btn-outline" href="{{ $paginator->previousPageUrl() }}#panel-orders" data-i18n="prev">ก่อนหน้า</a>
                  @endif
                  @foreach ($urls as $p => $url)
                    @if ($p == $paginator->currentPage()) <span class="btn btn-primary">{{ $p }}</span>
                    @else <a class="btn btn-outline" href="{{ $url }}#panel-orders">{{ $p }}</a>
                    @endif
                  @endforeach
                  @if ($paginator->hasMorePages())
                    <a class="btn btn-outline" href="{{ $paginator->nextPageUrl() }}#panel-orders" data-i18n="next">ถัดไป</a>
                  @else
                    <span class="btn btn-outline opacity-50 cursor-not-allowed" data-i18n="next">ถัดไป</span>
                  @endif
                </div>
              @endif
            </div>
          </div>

          <!-- ADDRESSES -->
          <div id="panel-addresses" role="tabpanel" tabindex="-1" hidden>
            <div class="card section">
              <div class="title" data-i18n="my_addresses">ที่อยู่ของฉัน</div>
              <div class="list-row">
                <div>
                  <div><strong data-i18n="default_address">ที่อยู่เริ่มต้น</strong></div>
                  <div><h3><span data-i18n="company_prefix">บริษัท :</span> {{ $custdetail->company_name ?? '—' }}</h3></div>
                  <div class="muted text-sm">{{ $ship !== '' ? e($ship) : '—' }}</div>
                </div>
              </div>
            </div>

            @forelse($subaddresses as $idx => $sub)
              <div class="addr-card card section mt-3">
                <div class="flex justify-between items-start gap-3">
                  <div class="min-w-0">
                    <div class="font-semibold"><span data-i18n="secondary_address">ที่อยู่รอง</span> {{ $idx+1 }}</div>
                    <div class="addr">
                      {{ e(trim(($sub->sub_address ?? '').' '.($sub->sub_subdistrict ?? '').' '.($sub->sub_district ?? '').' '.($sub->sub_province ?? '').' '.($sub->sub_postal ?? '').' '.($sub->sub_country ?? ''))) }}
                    </div>
                    @php
                      $contact = array_filter([$sub->sub_namecontact ?? null,$sub->sub_rank_contact ?? null,$sub->sub_tel_contact ?? null,$sub->sub_email_contact ?? null]);
                    @endphp
                    @if($contact)
                      <div class="muted text-sm mt-1">{{ e(implode(' • ',$contact)) }}</div>
                    @endif
                  </div>

                  <div class="flex-shrink-0 self-start">
                    <button type="button" class="btn btn-del-sub" style="background:#ef4444;color:#fff;border:1px solid #ef4444;border-radius:999px;padding:.5rem .9rem;font-weight:600"
                            onmouseenter="this.style.filter='brightness(0.96)'" onmouseleave="this.style.filter='none'"
                            onfocus="this.style.boxShadow='0 0 0 4px rgba(239,68,68,.35)'; this.style.outline='3px solid rgba(239,68,68,.35)'; this.style.outlineOffset='2px'"
                            onblur="this.style.boxShadow='none'; this.style.outline='none'"
                            data-idsub="{{ $sub->idsubaddress }}"
                            data-url="{{ route('delsub', ['idsubaddress' => $sub->idsubaddress]) }}"
                            data-i18n="delete">ลบ</button>
                  </div>
                </div>
              </div>
            @empty
              <div class="muted py-2" data-i18n="no_secondary_address">ยังไม่มีที่อยู่รอง</div>
            @endforelse
          </div>

          <!-- COMPANY -->
          <div id="panel-warranty" role="tabpanel" tabindex="-1" hidden>
            <div class="card section">
              <div class="title" data-i18n="company_info">ข้อมูลบริษัท</div>
              <div id="companyInfo" class="ci-list">
                <div class="list-row"><div class="k" data-i18n="registered_name">ชื่อบริษัท (ตามจดทะเบียน)</div><div class="v" data-field="registered_name">{{ $custdetail->company_name ?? '—' }}</div></div>
                <div class="list-row"><div class="k" data-i18n="entity_type">ประเภทนิติบุคคล</div><div class="v" data-field="entity_type">{{ $custdetail->Legalentity_type ?? '—' }}</div></div>
                <div class="list-row"><div class="k" data-i18n="tax_id">เลขประจำตัวผู้เสียภาษี (13 หลัก)</div><div class="v" data-field="tax_id">{{ $custdetail->idtax ?? '—' }}</div></div>
                <div class="list-row"><div class="k" data-i18n="branch_no">เลขที่สาขา</div><div class="v" data-field="branch_no">{{ $custdetail->Branch_number ?? '—' }}</div></div>
                <div class="list-row"><div class="k" data-i18n="vat_status">สถานะ VAT</div><div class="v" data-field="vat_status">—</div></div>
                <div class="list-row"><div class="k" data-i18n="tax_doc_lang">ภาษาเอกสารภาษี</div><div class="v" data-field="tax_doc_lang">—</div></div>
              </div>
            </div>
          </div>
          <!-- /PANELS -->
        </div>
      </section>
    </div>
  </main>

  {{-- footer --}}
  @include('test.footer')

  <!-- I18N dictionary + engine -->
  <script>
    const I18N={ 'ไทย':{home:'หน้าแรก',profile_page:'โปรไฟล์ของฉัน',account_overview:'ข้อมูลบัญชี',tab_summary:'สรุป',tab_orders:'คำสั่งซื้อ',tab_addresses:'ที่อยู่',tab_warranty:'บริษัท',orders:'คำสั่งซื้อ',addresses:'ที่อยู่',warranty:'ประกันสินค้า',edit_profile:'แก้ไขโปรไฟล์',account_center:'ศูนย์บัญชี',contact_info:'ข้อมูลติดต่อ',full_name:'ชื่อ-สกุล',email:'อีเมล',phone:'เบอร์โทร',company_org:'บริษัท/หน่วยงาน',company_name:'ชื่อบริษัท (ถ้ามี)',customer_type:'ที่อยู่จัดส่งหลัก',b2b:'B2B',industry:'อุตสาหกรรม',language:'ภาษาที่ตั้งค่า',thai:'ไทย',english:'English',recent_items:'รายการล่าสุด',ordered_on:'วันที่สั่ง:',status_shipping:'สถานะ: กำลังจัดส่ง',status_success:'สถานะ: สำเร็จ',details:'รายละเอียด',view_all:'ดูทั้งหมด',order_history:'ประวัติคำสั่งซื้อ',grand_total:'รวมสุทธิ',paid:'ชำระเงินแล้ว',view:'ดู',invoice:'ใบกำกับ',my_addresses:'ที่อยู่ของฉัน',default_address:'ที่อยู่เริ่มต้น',edit:'แก้ไข',all:'ทั้งหมด',warranty_items:'ข้อมูลบริษัท',expires:'หมดอายุ',buy:'วิธีการชำระ',label_profile:'โปรไฟล์',order_id_label:'คำสั่งซื้อ:',items:'สินค้า',total_qty:'จำนวนรวม:',pieces:'ชิ้น',no_orders_found:'ไม่พบคำสั่งซื้อตามเงื่อนไข',prev:'ก่อนหน้า',next:'ถัดไป',company_prefix:'บริษัท :',secondary_address:'ที่อยู่รอง',no_secondary_address:'ยังไม่มีที่อยู่รอง',delete:'ลบ',confirm_delete_address:'ยืนยันการลบที่อยู่นี้?',delete_failed:'ลบไม่สำเร็จ:',network_js_error:'ข้อผิดพลาด Network/JS',status_pending:'รอดำเนินการ',status_paid:'ชำระแล้ว',status_shipped:'จัดส่งแล้ว',status_completed:'สำเร็จ',status_cancelled:'ยกเลิก',status_unknown:'ไม่ทราบสถานะ',registered_name:'ชื่อบริษัท (ตามจดทะเบียน)',entity_type:'ประเภทนิติบุคคล',tax_id:'เลขประจำตัวผู้เสียภาษี (13 หลัก)',branch_no:'เลขที่สาขา',vat_status:'สถานะ VAT',tax_doc_lang:'ภาษาเอกสารภาษี',head_office:'สำนักงานใหญ่',branch_label:'สาขา',vat_registered:'จด VAT',vat_not_registered:'ไม่จด VAT',},
      'English':{home:'Home',profile_page:'My Profile',account_overview:'Account overview',tab_summary:'Summary',tab_orders:'Orders',tab_addresses:'Addresses',tab_warranty:'Company',orders:'Orders',addresses:'Addresses',warranty:'Warranty',edit_profile:'Edit profile',account_center:'Account center',contact_info:'Contact info',full_name:'Full name',email:'Email',phone:'Phone',company_org:'Company / Organization',company_name:'Company name (if any)',customer_type:'Default Shipping Address',b2b:'B2B',industry:'Industry',language:'Language',thai:'ไทย',english:'English',recent_items:'Recent items',ordered_on:'Ordered on:',status_shipping:'Status: Shipping',status_success:'Status: Completed',details:'Details',view_all:'View all',order_history:'Order history',grand_total:'Grand total',paid:'Paid',view:'View',invoice:'Invoice',my_addresses:'My addresses',default_address:'Default address',edit:'Edit',all:'All',warranty_items:'Company information',expires:'Expires',buy:'Payment method',label_profile:'Profile',order_id_label:'Order:',items:'Items',total_qty:'Total qty:',pieces:'pcs',no_orders_found:'No orders match the criteria',prev:'Previous',next:'Next',company_prefix:'Company:',secondary_address:'Secondary address',no_secondary_address:'No secondary addresses yet',delete:'Delete',confirm_delete_address:'Delete this address?',delete_failed:'Delete failed:',network_js_error:'Network/JS Error',status_pending:'Pending',status_paid:'Paid',status_shipped:'Shipped',status_completed:'Completed',status_cancelled:'Cancelled',status_unknown:'Unknown',registered_name:'Registered company name',entity_type:'Entity type',tax_id:'Tax ID (13 digits)',branch_no:'Branch No.',vat_status:'VAT status',tax_doc_lang:'Tax document language',head_office:'Head Office',branch_label:'Branch',vat_registered:'VAT registered',vat_not_registered:'Not VAT registered',}
    };
    function normLang(v){v=String(v||'').toLowerCase();if(v==='th'||v==='ไทย')return'ไทย';if(v==='en'||v==='english')return'English';return(I18N[v]?v:'ไทย');}
    function getCurrentLang(){return normLang(localStorage.getItem('preferredLanguage')||'ไทย');}
    function getDict(){const lang=getCurrentLang();return I18N[lang]||I18N['ไทย'];}
    function tKey(key,fallback){const d=getDict();return(d[key]!=null)?d[key]:(fallback!=null?fallback:key);}
    function applyI18n(lang){
      lang=normLang(lang); const dict=I18N[lang]||I18N['ไทย'];
      document.documentElement.lang=(lang==='ไทย')?'th':'en';
      document.querySelectorAll('[data-i18n]').forEach(el=>{
        const key=el.getAttribute('data-i18n'); const val=dict[key]; if(val==null)return;
        const attr=el.getAttribute('data-i18n-attr'); if(attr){el.setAttribute(attr,val);}else{el.textContent=val;}
      });
      const label=document.getElementById('currentLangLabel'); if(label) label.textContent=(lang==='ไทย')?I18N['ไทย'].thai:I18N['ไทย'].english;
      const chip=document.getElementById('langChip'); if(chip) chip.textContent=(lang==='ไทย')?I18N['ไทย'].thai:I18N['ไทย'].english;
      document.querySelectorAll('[data-lang],[data-set-lang],.lang-item').forEach(el=>{
        const val=el.getAttribute('data-lang')||el.getAttribute('data-set-lang'); const isActive=normLang(val)===lang;
        el.classList.toggle('active',isActive); el.setAttribute('aria-current',isActive?'true':'false');
      });
      localStorage.setItem('preferredLanguage',lang); localStorage.setItem('site_lang',lang);
      window.dispatchEvent(new CustomEvent('site_lang_changed',{detail:{lang}}));
    }
    window.applyI18n=applyI18n; window.tKey=tKey;
  </script>

  <!-- ปุ่มลบที่อยู่รอง -->
  <script>
    (function(){
      const csrf=document.querySelector('meta[name="csrf-token"]')?.content||'';
      document.querySelectorAll('.btn-del-sub').forEach(btn=>{
        btn.addEventListener('click',async()=>{
          const url=btn.dataset.url;
          if(!confirm(tKey('confirm_delete_address','ยืนยันการลบที่อยู่นี้?')))return;
          try{
            const res=await fetch(url,{method:'POST',headers:{'X-CSRF-TOKEN':csrf,'Accept':'application/json','Content-Type':'application/x-www-form-urlencoded;charset=UTF-8'},body:'_method=DELETE'});
            if(res.ok){ window.location.reload(); } else { const t=await res.text(); alert(tKey('delete_failed','ลบไม่สำเร็จ:')+' '+t); }
          }catch(e){ console.error(e); alert(tKey('delete_failed','ลบไม่สำเร็จ:')+' '+tKey('network_js_error','Network/JS Error')); }
        });
      });
    })();
  </script>

  <!-- Boot & bindings -->
  <script>
    document.addEventListener('DOMContentLoaded',()=>{
      applyI18n(getCurrentLang());

      document.addEventListener('click',(e)=>{
        const trg=e.target.closest('.lang-item,[data-lang],[data-set-lang]'); if(!trg)return;
        e.preventDefault(); const raw=trg.getAttribute('data-lang')||trg.getAttribute('data-set-lang')||trg.textContent.trim(); applyI18n(raw);
        const dd=document.getElementById('langDropdown'); if(dd&&!dd.classList.contains('hidden')) dd.classList.add('hidden');
      });

      const currentLangBtn=document.getElementById('currentLangBtn'); const langDropdown=document.getElementById('langDropdown');
      if(currentLangBtn&&langDropdown){
        currentLangBtn.addEventListener('click',(e)=>{ e.stopPropagation(); langDropdown.classList.toggle('hidden'); });
        document.addEventListener('click',(e)=>{ if(!e.target.closest('#langDropdown,#currentLangBtn')) langDropdown.classList.add('hidden'); });
      }

      const root=document.getElementById('profileRoot');
      if(root){
        const orders=Number(root.dataset.orders||0),addresses=Number(root.dataset.addresses||0),warranty=Number(root.dataset.warranty||0);
        for(const [k,v] of Object.entries({orders,addresses,warranty})){ const el=root.querySelector(`[data-stat="${k}"]`); if(el) el.textContent=String(v); }
      }

      document.querySelectorAll('[role="tab"]').forEach(tab=>{
        tab.addEventListener('click',()=>{ selectTab(tab); sessionStorage.setItem('acct_active_tab',tab.getAttribute('data-tab')); });
        tab.addEventListener('keydown',(e)=>{ if(e.key==='Enter'||e.key===' '){ e.preventDefault(); tab.click(); } });
      });
      function selectTab(active){
        const name=active.getAttribute('data-tab');
        document.querySelectorAll('[role="tab"]').forEach(t=>t.setAttribute('aria-selected',String(t===active)));
        document.querySelectorAll('[role="tabpanel"]').forEach(p=>p.hidden=true);
        const panel=document.getElementById('panel-'+name); if(panel){ panel.hidden=false; panel.focus?.(); }
      }

      const hashIsOrders=location.hash==='\\#panel-orders';
      const fromPaging=/[?&]page=/.test(location.search);
      const savedActive=sessionStorage.getItem('acct_active_tab');
      const shouldOrders=hashIsOrders||fromPaging||savedActive==='orders';
      if(shouldOrders){
        const ordersTab=document.querySelector('[role="tab"][data-tab="orders"]');
        if(ordersTab){
          selectTab(ordersTab);
          if(location.hash!=='#panel-orders') history.replaceState(null,'','#panel-orders');
          requestAnimationFrame(()=>{ const panel=document.getElementById('panel-orders'); if(panel) panel.scrollIntoView({behavior:'auto',block:'start'}); });
        }
      }

      document.addEventListener('click',(e)=>{
        const a=e.target.closest('a[href]'); if(!a)return;
        if(a.closest('#panel-orders') && /[?&]page=|\/page\//i.test(a.href)){
          a.href=a.href.split('#')[0]+'#panel-orders';
          sessionStorage.setItem('acct_active_tab','orders');
        }
      });
    });
  </script>

  <!-- โหลดสถิติจาก route ที่คืน JSON (optional) -->
  <script>
    (async()=>{
      try{
        const res=await fetch('{{ route("profile.show") }}',{credentials:'same-origin'});
        if(!res.ok) throw new Error('HTTP '+res.status);
        const stat=await res.json();
        document.querySelectorAll('[data-stat="orders"]').forEach(el=>el.textContent=stat.orders??0);
        document.querySelectorAll('[data-stat="addresses"]').forEach(el=>el.textContent=stat.addresses??1);
      }catch(e){ console.error('load stats failed:',e); }
    })();
  </script>
  <script>
(function(){
const EXCHANGE = 38;

  // ดึง input ทั้ง 2 (desktop + mobile)
  const inputs = [
    { el: document.getElementById('globalSearch'), results: document.getElementById('searchResultsDesktop') },
    { el: document.getElementById('mobileSearchInput'), results: document.getElementById('searchResultsMobile') }
  ].filter(x => x.el && x.results);

  if (!inputs.length) return;

  let ALL = [];
  const BASE = location.origin + '/';

  const getLang = () => localStorage.getItem('site_lang') || localStorage.getItem('preferredLanguage') || 'ไทย';
  const fmtTHB = v => new Intl.NumberFormat('th-TH',{
    style:'currency', currency:'THB', minimumFractionDigits:0, maximumFractionDigits:2
  }).format(v);
  const fmtUSD = v => new Intl.NumberFormat('en-US',{
    style:'currency', currency:'USD', minimumFractionDigits:0, maximumFractionDigits:2
  }).format(v);

  // ✅ แปลงบาท → ดอลลาร์ โดยปัดขึ้นเป็นเซนต์
  const toUSD = (thb) => {
    if (!Number.isFinite(thb)) return null;
    const satang = Math.round(thb * 100);
    const cents  = Math.ceil(satang / EXCHANGE);
    return cents / 100;
  };

  const priceText = (p)=>{
    if (typeof p === 'number' && !isNaN(p)){
      return (getLang()==='English') ? fmtUSD(toUSD(p)) : fmtTHB(p);
    }
    return (getLang()==='English') ? '$0.00' : '฿—';
  };

  // ✅ parser ราคา (ทศนิยมได้)
  function parseTHB(raw){
    if (raw == null) return null;
    const s = String(raw).replace(/[^\d.]/g,'');
    if (!s) return null;
    const n = parseFloat(s);
    return Number.isFinite(n) ? n : null;
  }

  const slugify = (name)=> String(name||'').toLowerCase().trim()
    .replace(/[\/\s]+/g,'-').replace(/[^\u0E00-\u0E7Fa-z0-9\-]+/gi,'')
    .replace(/-+/g,'-').replace(/^-|-$/g,'');

  function buildHref(item){
    const name = (item.name || '').trim();
    const urlParams = new URLSearchParams({
      slug: slugify(name),
      name: name,
      image: item.image || '',
      columnJ: item.columnJ || '',
      price: (typeof item.price === 'number' && !isNaN(item.price)) ? String(item.price) : ''
    });
    return BASE.replace(/\/+$/,'/') + 'product?' + urlParams.toString();
  }

  // ✅ ไม่ดึง API — ใช้ข้อมูล preload จาก DB → window.PRODUCTS (ใช้ webpriceTHB อย่างเดียว)
  function ensureData(){
    if (ALL.length) return;
    const src = Array.isArray(window.PRODUCTS) ? window.PRODUCTS : [];
    ALL = src.map(x => ({
      name: x.name || '',
      category: x.category || '',
      image: x.image || x.pic || '',
      price: parseTHB(x.webpriceTHB), // ← ใช้ webpriceTHB อย่างเดียว
      columnJ: x.columnJ || ''
    }))
    .filter(x => x.name && (x.image || x.price != null));
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
      const href = buildHref(it);
      const name = (it.name || '').trim() || '—';
      const cat  = (it.category || '').trim() || '';
      const img  = it.image || '';
      const price= priceText(it.price);

      const row = document.createElement('a');
      row.href = href;
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

    dd.classList.remove('hidden');
  }

  // ใส่ event ให้ทั้ง desktop + mobile
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

    // click outside
    document.addEventListener('click', (e)=>{
      if (!e.target.closest(`#${target.results.id}, #${target.el.id}`)){
        target.results.classList.add('hidden');
      }
    });
  });

})();
</script>



<script>
  window.FLASH_DEALS = @json($flashDeals ?? []);
  window.PRODUCTS    = @json($products ?? []);
</script>



<!-- ===== Cart Badge Sync ===== -->
<script>
(function(){
  const LS_KEY = 'cartV1';   // เก็บข้อมูลตะกร้าใน localStorage

  // โหลดข้อมูลตะกร้า
  const load = () => { 
    try { return JSON.parse(localStorage.getItem(LS_KEY) || '[]'); } 
    catch { return []; } 
  };

  // รวมจำนวนสินค้าทั้งหมด
  const totalQty = () => load().reduce((s,it)=> s + (Number(it.qty)||1), 0);

  // อัปเดต badge ที่ไอคอนตะกร้า
  function updateCartBadge(){
    const badge = document.querySelector('a[aria-label="cart"] span');
    if(!badge) return;
    const n = totalQty();
    badge.textContent = String(n);
    badge.style.transform = 'scale(1.15)';
    setTimeout(()=> badge.style.transform = 'scale(1)', 130);
  }

  // ฟัง event เมื่อมีการเปลี่ยนตะกร้า
  window.addEventListener('storage', (e)=>{
    if (e.key === LS_KEY || e.key === '__cart_changed__'){
      updateCartBadge();
    }
  });

  document.addEventListener('DOMContentLoaded', updateCartBadge);
})();
</script>
<!-- ===== Minimal, accessible JS for toggles/drawer ===== -->
<script>
  (function () {
    // Collapse toggles (for mobile accordions & search)
    document.querySelectorAll('[data-collapse-toggle]').forEach(btn => {
      const targetSel = btn.getAttribute('data-collapse-toggle');
      const target = document.querySelector(targetSel);
      if (!target) return;
      btn.addEventListener('click', () => {
        const isHidden = target.classList.contains('hidden');
        target.classList.toggle('hidden');
        btn.setAttribute('aria-expanded', String(isHidden));
      });
    });

    // Drawer (mobile off-canvas)
    const openers = document.querySelectorAll('[data-drawer-toggle]');
    const closers = document.querySelectorAll('[data-drawer-close]');
    function openDrawer(sel) {
      const wrap = document.querySelector(sel);
      if (!wrap) return;
      const drawer = wrap.querySelector('aside');
      wrap.classList.remove('hidden');
      // next frame to allow transition
      requestAnimationFrame(() => drawer.classList.remove('translate-x-full'));
      // focus close button for accessibility
      const closeBtn = wrap.querySelector('[data-drawer-close]');
      if (closeBtn) closeBtn.focus();
      // esc to close
      function onEsc(e){ if (e.key === 'Escape') closeDrawer(sel, true); }
      wrap._escHandler = onEsc;
      document.addEventListener('keydown', onEsc);
    }
    function closeDrawer(sel, fromEsc=false) {
      const wrap = document.querySelector(sel);
      if (!wrap) return;
      const drawer = wrap.querySelector('aside');
      drawer.classList.add('translate-x-full');
      // wait for transition then hide
      drawer.addEventListener('transitionend', function onEnd() {
        wrap.classList.add('hidden');
        drawer.removeEventListener('transitionend', onEnd);
      }, { once: true });
      if (wrap._escHandler) {
        document.removeEventListener('keydown', wrap._escHandler);
        wrap._escHandler = null;
      }
      // restore focus to opener
      if (!fromEsc) {
        const opener = document.querySelector(`[data-drawer-toggle="${sel}"]`);
        if (opener) opener.focus();
      }
    }
    openers.forEach(btn => {
      const sel = btn.getAttribute('data-drawer-toggle');
      btn.addEventListener('click', () => {
        const wrap = document.querySelector(sel);
        const drawer = wrap && wrap.querySelector('aside');
        const isClosed = drawer && drawer.classList.contains('translate-x-full');
        if (isClosed) openDrawer(sel); else closeDrawer(sel);
        btn.setAttribute('aria-expanded', String(isClosed));
      });
    });
    closers.forEach(btn => {
      const sel = btn.getAttribute('data-drawer-close');
      btn.addEventListener('click', () => closeDrawer(sel));
    });
  })();
</script>
</body>
</html>
