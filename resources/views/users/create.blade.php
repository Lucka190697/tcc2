@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Criar Novo Usuário')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">@lang('labels.User Management')</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('user.index') }}"
                                   class="btn btn btn-primary">
                                    <i class="fa fa-arrow-left mr-2"></i>
                                    @lang('labels.Back')
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('user.store') }}" autocomplete="off"
                              enctype="multipart/form-data">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">
                                @lang('labels.User information')
                            </h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">
                                        @lang('labels.Name')
                                    </label>
                                    <input type="text" name="name" id="input-name"
                                           class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           placeholder="@lang('labels.Name')" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email"
                                           class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Email') }}" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                            <strong>Não é possível usar este email! Ele já exite!</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-password">
                                        @lang('labels.Password')
                                    </label>
                                    <input type="password" name="password" id="input-password"
                                           class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           placeholder="@lang('labels.Password')" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-password-confirmation">
                                        @lang('laels.Confirm Password')
                                    </label>
                                    <input type="password" name="password_confirmation" id="input-password-confirmation"
                                           class="form-control form-control-alternative"
                                           placeholder="@lang('laels.Confirm Password')" value="" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label"
                                           for="input-profile">
                                        @lang('labels.Profile')
                                    </label>
                                    <input type="file" name="profile" id="input-profile"
                                           class="form-control form-control-alternative {{ $errors->has('profile') ? ' is-invalid' : '' }}"
                                           placeholder="@lang('labels.Profile')s" value="" required>
                                    @if ($errors->has('profile'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('profile') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection