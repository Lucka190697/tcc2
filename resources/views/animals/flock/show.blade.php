@extends('layouts.app')

@section('content')
    @include('layouts.headers.flock-card')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-sm-12 col-lg-12 align-items-sm-center">
                                <div class="float-md-left float-lg-left col-sm-6">
                                    <a type="button"
                                       class="btn btn-danger col-sm-3 text-white" data-toggle="modal"
                                       data-target="#deleteAnimalModal">
                                        <i> <i class="fa fa-eraser"></i> Excluir </i>
                                    </a>
                                    <a class="btn btn-warning col-sm-6"
                                       href="{{route('cio.heatByAnimal', $animals->id)}}">
                                        <i class="fa fa-mars-double"></i>
                                        Ver ciclos reprodutivo
                                    </a>
                                </div>
                                <div class="float-md-right float-lg-right col-sm-6">
                                    <a href="{{ route('animals.index') }}"
                                       class="btn btn-outline-primary col-sm-3">
                                        <i class="fa fa-chevron-left"></i>
                                        Voltar
                                    </a>
                                    <a href="{{ route('animals.create') }}"
                                       class="btn btn-primary col-sm-6">
                                        Cadastrar outro
                                        <i class="fa fa-redo"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="card">
                                        <div class="card-header text-white bg-gradient-indigo">
                                            {{$animals->name}}
                                        </div>
                                        <div class="card-body">
                                            <div class="embed-responsive-item">
                                                @if(isset($animals->thumbnail))
                                                    <img src="{{asset('animals/' . $animals->name) }}"
                                                         alt="image"
                                                         width="350"
                                                         height="auto" class="rounded">
                                                @else
                                                    <img src="{{asset('cow-default.png')}}" alt="image" width="500"
                                                         height="auto">
                                                @endif
                                            </div>
                                        </div>
                                        {{--                                        <div class="col-lg-8 col-sm-12 text-white">--}}
                                        {{--                                            <a class="btn btn-warning"--}}
                                        {{--                                               href="{{route('cio.heatByAnimal', $animals->id)}}">--}}
                                        {{--                                                <i class="fa fa-mars-double"></i>--}}
                                        {{--                                                Acompanhar ciclo reprodutivo--}}
                                        {{--                                            </a>--}}
                                        {{--                                        </div>--}}
                                    </div>
                                </div>
                                <div class="col-lg-5 col-sm">
                                    <ul class="list-group">
                                        <li class="list-group-item bg-gradient-indigo text-white">
                                            ID do Animal: <strong> {{$animals->id}} </strong>
                                            <a href="{{ route('animals.edit', $animals->id) }}"
                                               class="text-white float-right">
                                                <i class="fa fa-edit"></i> Editar
                                            </a>
                                        </li>
                                        <li class="list-group-item">
                                            Animal:
                                            <strong> {{ $animals->code }} | </strong>
                                            <strong> {{ $animals->name }} </strong>
                                        </li>
                                        <li class="list-group-item">
                                            Data de nascimento:
                                            <strong>
                                                {{ $animals->born_date = date('d/m/Y', strtotime($animals->born_date))}}
                                            </strong>
                                        </li>
                                        <li class="list-group-item">
                                            Sexo:
                                            <strong>{{ $animals->sex == 'femeale' ? 'Femea' : 'Macho' }} </strong>
                                        </li>
                                        <li class="list-group-item">
                                            Classe:
                                            <strong>
                                                @if($animals->class == 'cow-lactating')
                                                    Lactante
                                                @elseif($animals->class == 'cow-non-lactating')
                                                    Não Lactante
                                                @elseif($animals->class == 'cow-dry')
                                                    Seca
                                                @elseif($animals->class == 'heifer')
                                                    Novilha
                                                @elseif($animals->class == 'she-calves')
                                                    Bezerra
                                                @elseif($animals->class == 'he-calves')
                                                    Bezerro
                                                @elseif($animals->class == 'bull-reproductive')
                                                    Touro
                                                @elseif($animals->class == 'bull-castrated')
                                                    Capão/Castrado
                                                @elseif($animals->class == 'bull-ruffian')
                                                    Rufião
                                                @endif
                                            </strong>
                                        </li>
                                        <li class="list-group-item">
                                            Raça:
                                            <strong> {{ $animals->breed }} </strong>
                                        </li>
                                        <li class="list-group-item">
                                            Status:
                                            @if($animals->status == 'alive')
                                                <strong class="text-primary">Vivo</strong>
                                            @elseif($animals->status == 'dead')
                                                <strong class="text-warning">Morto</strong>
                                            @elseif($animals->status == 'sold')
                                                <strong class="text-warning">Vendido</strong>
                                            @endif
                                        </li>
                                        <li class="list-group-item">
                                            Mãe:
                                            <strong>
                                                {{ $animals->mother == 'unknow' ? 'Desconhecido' : $animals->mother }}
                                            </strong>
                                        </li>
                                        <li class="list-group-item">
                                            Pai:
                                            <strong>
                                                {{ $animals->father == 'unknow' ? 'Desconhecido' : $animals->father }}
                                            </strong>
                                        </li>
                                        <li class="list-group-item">
                                            Criado em:
                                            <strong> {{$animals->created_at}} </strong>
                                        </li>
                                        <li class="list-group-item">
                                            Criado pelo usuário ID:
                                            <strong>{{ $animals->responsible_id }}</strong>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
    @include('animals.flock.partials.modals.confirmation')
@endsection
