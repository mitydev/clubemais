@extends('layouts.app') {{-- ou o layout do seu site --}}

@section('title', $page->meta_title ?? $page->title)
@section('meta_description', $page->meta_description ?? '')

@section('content')
  @foreach($sections as $section)
    @php $view = 'site.sections.' . $section->type; @endphp

    @if(view()->exists($view))
      @include($view, ['section' => $section])
    @else
      {{-- fallback simples para quando ainda não existir a parcial --}}
      <section class="py-8">
        <div class="container">
          <pre class="bg-light p-3 rounded">{{ json_encode($section->content, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) }}</pre>
        </div>
      </section>
    @endif
  @endforeach
@endsection
