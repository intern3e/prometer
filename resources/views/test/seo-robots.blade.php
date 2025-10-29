{{-- resources/views/test/seo-robots.blade.php --}}
@php
  // ค่าเริ่มต้น: อนุญาตให้ index ถ้าไม่ส่งพารามิเตอร์มา
  $allow = filter_var($allowIndex ?? true, FILTER_VALIDATE_BOOLEAN);
@endphp
<meta name="robots" content="{{ $allow ? 'index,follow' : 'noindex,follow' }}">
