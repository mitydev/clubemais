{{-- resources/views/components/application-logo.blade.php --}}
@props(['variant' => 'tight'])

@php
  $file = $variant === 'white'
    ? public_path('images/novo_logo_320x100_white.svg')
    : public_path('images/novo_logo_320x100_tight.svg');
  $svg  = is_readable($file) ? file_get_contents($file) : '';
@endphp

{!! $svg !!} {{-- injeta o SVG real do public/ --}}