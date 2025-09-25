<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Clube + Local</title>

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
  <h1 class="text-2xl sm:text-3xl font-bold mb-4">
    Resultados em: {{ $term->name }}
  </h1>

  @if($locals->isEmpty())
    <p class="text-gray-500">Nenhum resultado para este destino.</p>
  @else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($locals as $local)
        <article class="rounded-xl overflow-hidden border border-gray-200 bg-white">
          {{-- coloque uma imagem se tiver -> <img src="{{ $local->image_url }}" alt=""> --}}
          <div class="h-40 bg-gray-100"></div>
          <div class="p-4">
            <h2 class="text-lg font-semibold mb-1">{{ $local->name }}</h2>
            @if($local->description)
              <p class="text-sm text-gray-600 line-clamp-3">{{ $local->description }}</p>
            @endif

            <a href="{{ route('hotel.show', $local) }}"
               class="inline-block mt-3 text-[#F46E00] font-medium">
              Ver detalhes
            </a>
          </div>
        </article>
      @endforeach
    </div>

    <div class="mt-6">
      {{ $locals->links() }} {{-- paginação padrão do Laravel (Tailwind) --}}
    </div>
  @endif
</div>

@include('components.footer')
</body>
</html>
