{{-- resources/views/test/seo-robots.blade.php --}}
@php
  // ถ้าไม่ส่งอะไรมาถือว่าอนุญาตให้ index
  $allow = filter_var($allowIndex ?? true, FILTER_VALIDATE_BOOLEAN);
  $robots = $allow ? 'index,follow' : 'noindex,follow';
@endphp
<meta name="robots" content="{{ $robots }}">
