@extends('layouts.site') {{-- ou o seu layout público --}}

@section('title', $page->meta_title ?: $page->title)
@section('meta_description', $page->meta_description)

@section('content')
  {{-- Loop das seções ativas, respeitando a ordem --}}
  @foreach($page->activeSections as $section)
    @includeIf('site.sections.' . $section->type, [
      'section' => $section,
      'data'    => $section->getAttribute('data') ?? [],
    ])
  @endforeach
@endsection
