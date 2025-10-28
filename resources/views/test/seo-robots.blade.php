@props(['allowIndex' => false])

@if ($allowIndex)
  <meta name="robots" content="index,follow">
@else
  <meta name="robots" content="noindex,follow">
@endif
