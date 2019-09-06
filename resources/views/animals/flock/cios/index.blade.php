@extends('layouts.app')

@section('content')
    @include('layouts.headers.flock-card')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-md-2 col-sm-12 mb-2 mb-lg-0 text-left">
                                <h3 class="mb-0">
                                    Ciclo Reprodutivo
                                </h3>
                            </div>
                            <div class="col-md-6 col-lg-7 mb-lg-0 mb-2">
                                <form action="#" id="pesquisar" method="POST" role="search">
                                    {{ csrf_field() }}
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                               name="nome" placeholder="Search users">
                                        <span class="input-group-btn">
                                        <button type="submit" class="btn btn-outline-light">
                                            <span class="fa fa-search"></span>
                                         </button>
                                    </span>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-3 col-sm-12 text-right">
                                @if($title == 'search')
                                    <a href="{{route('cio.index')}}" class="btn btn-block btn-danger">
                                        <i class="fa fa-arrow-left"></i> Voltar
                                    </a>
                                @endif
                                @if($title == 'Cio')
                                    <a href="{{ route('cio.create', $cios) }}" class="btn btn-block btn-primary">
                                        <i class="fa fa-plus mr-2"></i> Novo
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        @include('layouts.flash-message')
                        @include('animals.flock.cios.flash-message')
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush text-center">
                            <thead>
                            <tr>
                                @include('animals.flock.cios.partials._head')
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cios as $cio)
                                <tr>
                                    @include('animals.flock.cios.partials._body')
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer py-4">
                            <nav class="d-flex justify-content-end" aria-label="...">
                                @if($title == 'Cio')
                                    {{$cios->links()}}
                                @endif
                                @if($title == 'search')
                                    <a href="{{route('flock.index')}}" class="btn btn-sm btn-danger">
                                        <i class="fa fa-arrow-left"></i> Voltar
                                    </a>
                                @endif
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footers.auth')
        </div>
@endsection