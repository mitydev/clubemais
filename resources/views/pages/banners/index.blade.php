@extends('layouts.lte')
@section('content')
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Banners</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Banners</li>
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
                        <div class="card-header"><h3 class="card-title">Lista</h3></div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered" role="table">
                                <thead>
                                <tr>
                                    <th style="width: 10px" scope="col">#</th>
                                    <th scope="col">Banners</th>
                                    <th style="width: 10px" class="text-center" scope="col">Ativa</th>
                                    <th style="width: 10px" scope="col">Editar</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($banners) && count($banners) > 0)
                                @foreach($banners as $banner)
                                <tr class="align-middle">
                                    <td>1.</td>
                                    <td>{{$banner->name}}</td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" class="form-check-input">
                                        </label>
                                    </td>
                                    <td><a href="{{route('banners.edit', $banner->id )}}" class="float-end">Editar</a></td>
                                </tr>
                                @endforeach
                                @else
                                <tr class="align-middle">
                                    <td colspan="4" class="text-center">
                                        Nenhuma página cadastrada.
                                    </td>
                                </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-end">
                                <li class="page-item"><a class="page-link" href="#">«</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">»</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>
@endsection

