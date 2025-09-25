<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Clube + Detalhes do local</title>

  <link rel="icon" type="image/png" href="{{ asset('images/plus.png') }}">

  {{-- CSRF para POST no Laravel --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

  @vite(['resources/css/default.css','resources/css/app.css' , 'resources/js/app.js'])
</head>
<body>
@include('components.header')

<div id="main-content" class="max-w-[1280px] mx-auto px-4 sm:px-6 py-8">
  <h1 class="text-3xl font-bold mb-4">{{ $local->name }}</h1>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
      <div class="aspect-[16/9] bg-gray-100 rounded-xl mb-4"></div>
      <div class="prose max-w-none">
        {!! nl2br(e($local->description ?? 'Sem descrição.')) !!}
      </div>
    </div>

    <aside class="lg:col-span-1">
      <div class="rounded-xl border border-gray-200 p-4 bg-white">
        <p class="text-sm text-gray-600 mb-2">Categoria:</p>
        <p class="font-medium">
          {{ optional($local->term)->name ?? '—' }}
        </p>
      </div>
    </aside>
  </div>
</div>

@include('components.footer')
</body>
</html>