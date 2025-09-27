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
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

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
  
  <?php echo $__env->make('test.header-nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  
  <?php
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
  ?>

  <main class="container" id="profileRoot" data-orders="<?php echo e($ordersCount ?? 0); ?>" data-addresses="<?php echo e($addressesCount ?? 0); ?>" data-warranty="<?php echo e($warrantyCount ?? 0); ?>">
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
            <div class="mt-1 text-sm text-slate-500 break-all"><?php echo e(\Illuminate\Support\Str::limit($custdetail->email ?? '', 30, '...')); ?></div>
          </div>
        </div>

        <div class="flex flex-wrap gap-2 mt-5">
          <a href="/account/edit" class="btn btn-primary w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 rounded-xl" data-i18n="edit_profile">แก้ไขโปรไฟล์</a>
        </div>

        <hr class="my-5 border-slate-200">

        <div class="grid grid-cols-2 gap-4 text-center" aria-label="สรุปสถิติ">
          <div class="rounded-xl border border-slate-100 p-4">
            <div class="mx-auto mb-2 w-9 h-9 rounded-full bg-slate-50 flex items-center justify-center"><i class="bi bi-bag text-base opacity-70"></i></div>
            <div class="text-2xl font-bold tracking-tight tabular-nums" data-stat="orders"><?php echo e(number_format($ordersCount)); ?></div>
            <div class="text-xs text-slate-500" data-i18n="orders">คำสั่งซื้อ</div>
          </div>
          <div class="rounded-xl border border-slate-100 p-4">
            <div class="mx-auto mb-2 w-9 h-9 rounded-full bg-slate-50 flex items-center justify-center"><i class="bi bi-geo-alt text-base opacity-70"></i></div>
            <div class="text-2xl font-bold tracking-tight tabular-nums" data-stat="addresses"><?php echo e(number_format($addressesCount)); ?></div>
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
                <input type="hidden" id="idcustomer" name="idcustomer" value="<?php echo e(e($custdetail->idcustomer ?? '')); ?>" />
                <div class="title" data-i18n="contact_info">ข้อมูลติดต่อ</div>
                <div class="muted mt-2" data-i18n="full_name">ชื่อ-สกุล</div><div><?php echo e($custdetail->main_namecontact ?? '—'); ?></div>
                <div class="muted mt-2" data-i18n="email">อีเมล</div><div><?php echo e($custdetail->email_contact ?? '—'); ?></div>
                <div class="muted mt-2" data-i18n="phone">เบอร์โทร</div><div><?php echo e($custdetail->tel_contact ?? '—'); ?></div>
              </div>

              <div class="card section">
                <div class="title" data-i18n="company_org">บริษัท/หน่วยงาน</div>
                <div class="muted mt-2" data-i18n="company_name">ชื่อบริษัท (ถ้ามี)</div><div><?php echo e($custdetail->company_name ?? '—'); ?></div>
                <div class="muted mt-2" data-i18n="customer_type">ที่อยู่จัดส่งหลัก</div><div><?php echo e($ship !== '' ? e($ship) : '—'); ?></div>
              </div>
            </div>
          </div>

          <!-- ORDERS -->
          <div id="panel-orders" role="tabpanel" tabindex="-1" hidden>
            <div class="card section">
              <div class="title text-lg font-extrabold" data-i18n="order_history">ประวัติคำสั่งซื้อ</div>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-4">
                <?php $__empty_1 = true; $__currentLoopData = $ordersPaged; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                  <?php
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
                  ?>

                  <div class="rounded-2xl border border-slate-200/70 bg-white p-4 md:p-5 hover:shadow-md hover:border-slate-300 transition">
                    <!-- ✅ หัวการ์ด: ป้ายสถานะไม่ตกบรรทัด -->
                    <div class="flex items-start justify-between gap-3 md:flex-nowrap">
                      <!-- ซ้าย: ให้ยืด-หดได้และตัดข้อความยาว -->
                      <div class="min-w-0 flex-1">
                        <div class="text-base md:text-[1.05rem] font-semibold leading-tight truncate">
                          <span data-i18n="order_id_label">คำสั่งซื้อ:</span>
                          <span class="tabular-nums"><?php echo e($o->id_order); ?></span>
                        </div>
                        <div class="text-sm text-slate-500 mt-0.5 truncate">
                          <span data-i18n="ordered_on">วันที่สั่ง:</span>
                          <span class="tabular-nums"><?php echo e($dateStr ?: '—'); ?></span>
                        </div>
                      </div>
                      <!-- ขวา: ป้ายสถานะ ไม่หด/ไม่ตัดคำ/ชิดบน -->
                      <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium <?php echo e($statusClass); ?> shrink-0 whitespace-nowrap self-start">
                        <span data-i18n="<?php echo e($statusKey); ?>">
                          <?php echo e(['pending'=>'รอดำเนินการ','paid'=>'ชำระแล้ว','shipped'=>'จัดส่งแล้ว','completed'=>'สำเร็จ','cancelled'=>'ยกเลิก'][$status] ?? ($o->status ?? '—')); ?>

                        </span>
                      </span>
                    </div>

                    <?php
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
                    ?>

                    <?php if(count($allThumbs)): ?>
                      <div class="mt-3 -mx-1 overflow-x-auto">
                        <div class="flex gap-2 px-1">
                          <?php $__currentLoopData = $allThumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <img src="<?php echo e($pic); ?>" alt="thumb" class="w-12 h-12 rounded-xl object-cover ring-1 ring-slate-200 flex-shrink-0" loading="lazy">
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                      </div>
                    <?php endif; ?>

                    <?php if(count($allNames)): ?>
                      <div class="mt-3">
                        <div class="text-sm font-semibold text-slate-800" data-i18n="items">สินค้า</div>
                        <ul class="mt-1 space-y-1 max-h-56 overflow-auto pr-1">
                          <?php $__currentLoopData = $allNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="text-sm text-slate-700 leading-relaxed"><?php echo e($nm); ?></li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                      </div>
                    <?php endif; ?>

                    <hr class="my-4 border-slate-200/80">

                    <div class="flex items-center justify-between">
                      <div class="text-sm text-slate-600">
                        <span data-i18n="total_qty">จำนวนรวม:</span>
                        <strong class="text-slate-800 tabular-nums"><?php echo e($qtyTxt); ?></strong>
                        <span data-i18n="pieces">ชิ้น</span>
                      </div>
                      <div class="text-base md:text-lg font-bold tabular-nums">฿<?php echo e($totalTxt); ?></div>
                    </div>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                  <div class="rounded-xl border border-dashed border-slate-300 p-8 text-center text-slate-500" data-i18n="no_orders_found">ไม่พบคำสั่งซื้อตามเงื่อนไข</div>
                <?php endif; ?>
              </div>

              
              <?php if($ordersPaged->hasPages()): ?>
                <?php $paginator = $ordersPaged->appends(request()->query()); $urls = $paginator->getUrlRange(1,$paginator->lastPage()); ?>
                <div class="mt-5 flex flex-wrap justify-center gap-2">
                  <?php if($paginator->onFirstPage()): ?>
                    <span class="btn btn-outline opacity-50 cursor-not-allowed" data-i18n="prev">ก่อนหน้า</span>
                  <?php else: ?>
                    <a class="btn btn-outline" href="<?php echo e($paginator->previousPageUrl()); ?>#panel-orders" data-i18n="prev">ก่อนหน้า</a>
                  <?php endif; ?>
                  <?php $__currentLoopData = $urls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($p == $paginator->currentPage()): ?> <span class="btn btn-primary"><?php echo e($p); ?></span>
                    <?php else: ?> <a class="btn btn-outline" href="<?php echo e($url); ?>#panel-orders"><?php echo e($p); ?></a>
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php if($paginator->hasMorePages()): ?>
                    <a class="btn btn-outline" href="<?php echo e($paginator->nextPageUrl()); ?>#panel-orders" data-i18n="next">ถัดไป</a>
                  <?php else: ?>
                    <span class="btn btn-outline opacity-50 cursor-not-allowed" data-i18n="next">ถัดไป</span>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <!-- ADDRESSES -->
          <div id="panel-addresses" role="tabpanel" tabindex="-1" hidden>
            <div class="card section">
              <div class="title" data-i18n="my_addresses">ที่อยู่ของฉัน</div>
              <div class="list-row">
                <div>
                  <div><strong data-i18n="default_address">ที่อยู่เริ่มต้น</strong></div>
                  <div><h3><span data-i18n="company_prefix">บริษัท :</span> <?php echo e($custdetail->company_name ?? '—'); ?></h3></div>
                  <div class="muted text-sm"><?php echo e($ship !== '' ? e($ship) : '—'); ?></div>
                </div>
              </div>
            </div>

            <?php $__empty_1 = true; $__currentLoopData = $subaddresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <div class="addr-card card section mt-3">
                <div class="flex justify-between items-start gap-3">
                  <div class="min-w-0">
                    <div class="font-semibold"><span data-i18n="secondary_address">ที่อยู่รอง</span> <?php echo e($idx+1); ?></div>
                    <div class="addr">
                      <?php echo e(e(trim(($sub->sub_address ?? '').' '.($sub->sub_subdistrict ?? '').' '.($sub->sub_district ?? '').' '.($sub->sub_province ?? '').' '.($sub->sub_postal ?? '').' '.($sub->sub_country ?? '')))); ?>

                    </div>
                    <?php
                      $contact = array_filter([$sub->sub_namecontact ?? null,$sub->sub_rank_contact ?? null,$sub->sub_tel_contact ?? null,$sub->sub_email_contact ?? null]);
                    ?>
                    <?php if($contact): ?>
                      <div class="muted text-sm mt-1"><?php echo e(e(implode(' • ',$contact))); ?></div>
                    <?php endif; ?>
                  </div>

                  <div class="flex-shrink-0 self-start">
                    <button type="button" class="btn btn-del-sub" style="background:#ef4444;color:#fff;border:1px solid #ef4444;border-radius:999px;padding:.5rem .9rem;font-weight:600"
                            onmouseenter="this.style.filter='brightness(0.96)'" onmouseleave="this.style.filter='none'"
                            onfocus="this.style.boxShadow='0 0 0 4px rgba(239,68,68,.35)'; this.style.outline='3px solid rgba(239,68,68,.35)'; this.style.outlineOffset='2px'"
                            onblur="this.style.boxShadow='none'; this.style.outline='none'"
                            data-idsub="<?php echo e($sub->idsubaddress); ?>"
                            data-url="<?php echo e(route('delsub', ['idsubaddress' => $sub->idsubaddress])); ?>"
                            data-i18n="delete">ลบ</button>
                  </div>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <div class="muted py-2" data-i18n="no_secondary_address">ยังไม่มีที่อยู่รอง</div>
            <?php endif; ?>
          </div>

          <!-- COMPANY -->
          <div id="panel-warranty" role="tabpanel" tabindex="-1" hidden>
            <div class="card section">
              <div class="title" data-i18n="company_info">ข้อมูลบริษัท</div>
              <div id="companyInfo" class="ci-list">
                <div class="list-row"><div class="k" data-i18n="registered_name">ชื่อบริษัท (ตามจดทะเบียน)</div><div class="v" data-field="registered_name"><?php echo e($custdetail->company_name ?? '—'); ?></div></div>
                <div class="list-row"><div class="k" data-i18n="entity_type">ประเภทนิติบุคคล</div><div class="v" data-field="entity_type"><?php echo e($custdetail->Legalentity_type ?? '—'); ?></div></div>
                <div class="list-row"><div class="k" data-i18n="tax_id">เลขประจำตัวผู้เสียภาษี (13 หลัก)</div><div class="v" data-field="tax_id"><?php echo e($custdetail->idtax ?? '—'); ?></div></div>
                <div class="list-row"><div class="k" data-i18n="branch_no">เลขที่สาขา</div><div class="v" data-field="branch_no"><?php echo e($custdetail->Branch_number ?? '—'); ?></div></div>
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

  
  <?php echo $__env->make('test.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

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
        const res=await fetch('<?php echo e(route("profile.show")); ?>',{credentials:'same-origin'});
        if(!res.ok) throw new Error('HTTP '+res.status);
        const stat=await res.json();
        document.querySelectorAll('[data-stat="orders"]').forEach(el=>el.textContent=stat.orders??0);
        document.querySelectorAll('[data-stat="addresses"]').forEach(el=>el.textContent=stat.addresses??1);
      }catch(e){ console.error('load stats failed:',e); }
    })();
  </script>
  
</body>
</html>
<?php /**PATH C:\xampp\htdocs\tool\resources\views/test/profile.blade.php ENDPATH**/ ?>