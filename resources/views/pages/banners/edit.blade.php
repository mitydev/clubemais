@extends('layouts.lte')
@section('content')
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Banner - [{{$group->name}}]</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Banners</a></li>
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
                        <div class="card-header"><h3 class="card-title">Banners</h3></div>
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
                            <form class="row" action="{{route('banners.update', $group->id)}}"
                                  method="POST" enctype="multipart/form-data">
                                @csrf
                                @if(isset($group))
                                @method('PUT')
                                @endif

                                <div class="mb-3">
                                    <label for="images" class="form-label">Selecione as imagens</label>
                                    <input type="file" name="images[]" accept="image/*" id="images" class="form-control" multiple required>
                                    <small class="text-muted">Você pode selecionar várias imagens segurando Ctrl (ou Cmd no Mac)</small>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                            </form>
                            <div class="row">
                                <div class="row mt-4">
                                    @foreach ($group->banners as $banner)
                                    <div class="col-md-3 mb-2">
                                        <div class="card">
                                            <div style="height: 120px; overflow: hidden">
                                                <img src="{{ asset($banner->image_path) }}" class="card-img-top" alt="{{ $banner->title ?? 'Banner' }}">
                                            </div>
                                            <div class="card-body position-relative ">
                                                <form action="{{ route('banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('Excluir banner?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label class="w-100 text-center"  for="">
                                                                Ativo <br>
                                                                <input type="checkbox" name="active" {{ ($banner->active) ? 'checked' : '' }} class="form-check-input">
                                                            </label>
                                                            <label for="" class="w-100">
                                                                Link:
                                                                <input name="link" type="text" placeholder="https://example.com/" value="{{$banner->link_url}}" class="form-control mb-2">
                                                            </label>
                                                            <label for="" class="w-100">
                                                                Posição:
                                                                <input type="number" name="position"  value="{{$banner->position}}" min="0" class="form-control mb-2">
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 text-center">
                                                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                                            <button type="button" data-url="{{ route('banners.update', $banner->id) }}" onclick="saveBanner(this)" data-idbanner="{{$banner->id}}" class="btn btn-success btn-sm">Salvar</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <script type="application/javascript">

                            document.addEventListener('keydown', function(e) {
                                if (e.key === 'Enter' && e.target.tagName !== 'TEXTAREA') {
                                    e.preventDefault();
                                }
                            });
                            const saveBanner = async (el) => {
                                const id = el.getAttribute('data-idbanner');
                                const url = el.getAttribute('data-url');

                                // Sobe até o elemento pai mais próximo (card ou form)
                                const cardBody = el.closest('.card-body');

                                // Busca os inputs dentro desse bloco
                                const link = cardBody.querySelector('input[type="text"]').value;
                                const position = cardBody.querySelector('input[type="number"]').value;
                                const active = cardBody.querySelector('input[type="checkbox"]').checked;

                                const payload = {
                                    _method: "PATCH",
                                    id,
                                    link,
                                    active,
                                    position
                                };

                                try {
                                    const response = await fetch(url, {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // se for Laravel
                                        },
                                        body: JSON.stringify(payload)
                                    });

                                    const data = await response.json();
                                    console.log('Resposta:', data);
                                    alert('Banner salvo com sucesso!');
                                } catch (error) {
                                    console.error('Erro ao salvar banner:', error);
                                    alert('Erro ao salvar banner.');
                                }
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection


