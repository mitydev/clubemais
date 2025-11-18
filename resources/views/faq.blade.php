{{-- resources/views/faq.blade.php --}}
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  @php
    /** @var \App\Models\Page|null $page */
    $metaTitle = $page->meta_title ?? 'Clube+ | Perguntas Frequentes';
    $metaDesc  = $page->meta_description ?? '';
    $sections  = ($page?->sections ?? collect())->sortBy('position')->values();
  @endphp

  <title>{{ $metaTitle }}</title>
  <meta name="description" content="{{ $metaDesc }}">

  <link rel="icon" type="image/png" href="{{ asset('images/plus.png') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">

  {{-- ajusta os assets conforme seu setup (copiei o padrão de benefícios) --}}
  @vite([
    'resources/css/default.css',
    'resources/css/app.css',
    'resources/css/pages/faq.css',   {{-- cria esse arquivo depois, se ainda não existir --}}
    'resources/js/app.js',
  ])
</head>
<body class="bg-white">
  @include('components.header')

  @php $isHome = false; @endphp

  @if($sections->isNotEmpty())
    @foreach($sections as $section)
      @includeIf('site.sections.' . $section->type, [
        'section' => $section,
        'isHome'  => $isHome,
      ])
    @endforeach
  @else
    {{-- Fallback simples se não houver sections configuradas --}}
    <div class="max-w-[960px] mx-auto px-4 py-16">
      <h1 class="text-3xl font-semibold mb-4">FAQ em construção</h1>
      <p class="text-gray-600">
        Configure as seções da página de Perguntas Frequentes no admin para começar.
      </p>
    </div>
  @endif

  @include('components.footer')
  @stack('page-scripts')
</body>
</html>
