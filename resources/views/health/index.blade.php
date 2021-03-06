@extends('layouts.app')

@section('content')
    @include('layouts.headers.health.index-card')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-sm-12 float-left">
                                <h3 class="mb-0"> Tratamentos e Vacinações </h3>
                            </div>
                            <div class="col-lg-5 col-12">
                                <form action="{{route('health.search')}}" id="pesquisar" method="get" role="search">
                                    {{ csrf_field() }}
                                    <div class="form-group input-group m-0">
                                        <input type="text" class="form-control"
                                               id="search" name="search"
                                               placeholder="Pesquisar" required>
                                        <button type="submit" class="btn btn-outline-light">
                                            <span class="fa fa-search"></span>
                                        </button>
                                        <span class="input-group-btn">

                                    </span>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-3 col-sm-12 float-right">
                                @if($title == 'search')
                                    <a href="{{ URL::previous() }}" class="btn btn-block btn-danger">
                                        <i class="fa fa-arrow-left"></i> Voltar
                                    </a>
                                @endif
                                @if($title == 'Treatment of all animals')
                                    <a href="{{ route('health.create') }}" class="btn btn-block btn-primary">
                                        <i class="fa fa-plus mr-2"></i> Novo Tratamento
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        @include('layouts.flash-message')
                    </div>
                    <div class="table-responsive p-lg-3">
                        <table class="table align-items-center table-flush" id="user-list-table">
                            <thead>
                            <tr>
                                @include('health.partials.table.head')
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($healts as $healt)
                                <tr>
                                    @include('health.partials.table.body')
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer py-4">
                            <nav class="d-flex justify-content-end" aria-label="...">
                                @if($title == 'flock')
                                    {{$animals->links()}}
                                @endif
                                @if($title == 'search')
                                    <a href="{{ URL::previous() }}" class="btn btn-sm btn-danger">
                                        <i class="fa fa-arrow-left"></i> Voltar
                                    </a>
                                @endif
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection
