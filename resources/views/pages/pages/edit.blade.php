@extends('layouts.lte')
@section('content')
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Pagina - [{{$page->name}}]</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Paginas</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">

            <!--begin::Row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header"><h3 class="card-title">Home</h3></div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if ($errors->any())
                            <div class="alert alert-danger mb-4">
                                <strong>Corrija os erros abaixo:</strong>
                                <ul class="mt-2 mb-0">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif
                            <form class="row" action=""
                                  method="POST">
                                @csrf
                                @if(isset($page))
                                @method('PUT')
                                @endif

                                {{-- Título --}}
                                <div class="mb-4 col-md-6">
                                    <label for="content[title]">Título</label>
                                    <input type="text" name="content[title]" id="content[title]" class="form-control"
                                           value="{{ old('content.title', $page->content['title'] ?? '') }}" required>
                                </div>

                                {{-- Slug --}}
                                <div class="mb-4 col-md-6">
                                    <label for="content[slug]">Slug (URL)</label>
                                    <input type="text" name="content[slug]" id="content[slug]" class="form-control"
                                           value="{{ old('content.slug', $page->content['slug'] ?? '') }}" required>
                                </div>

                                {{-- Meta Title --}}
                                <div class="mb-4">
                                    <label for="content[meta_title]">Meta Title</label>
                                    <input type="text" name="content[meta_title]" id="content[meta_title]" class="form-control"
                                           value="{{ old('content.meta_title', $page->content['meta_title'] ?? '') }}">
                                </div>

                                {{-- Meta Description --}}
                                <div class="mb-4">
                                    <label for="content[meta_description]">Meta Description</label>
                                    <input type="text" name="content[meta_description]" id="content[meta_description]" class="form-control"
                                           value="{{ old('content.meta_description', $page->content['meta_description'] ?? '') }}">
                                </div>

                                <div class="mb-4">
                                    <label for="hero-banner">Banner principal</label>
                                    <select name="content[hero_banner_id]" class="form-select" id="hero-banner">
                                        <option value="1">Banner home</option>
                                        <option value="2">Banner teste</option>
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary float-end">
                                        {{ isset($page) ? 'Atualizar Página' : 'Criar Página' }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

