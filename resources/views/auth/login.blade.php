@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    @include('layouts.headers.guest')
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                        </div>
                        <form role="form" method="POST" action="{{ route('login') }}">
                            @csrf
                            @if ($errors->has('email') || $errors->has('password'))
                                <div class="alert alert-danger">
                                    Não foi possivel efetuar o login.
                                    Talvez suas credenciais estejam erradas.
                                    Se você nao tem login ainda, clique em Registrar-se
                                </div>
                            @endif

                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : 'email inválido!' }} mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           placeholder="Email" type="email" name="email"
                                           value="{{ old('email') }}" required autofocus>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password" placeholder="@lang('labels.Password')" type="password"
                                           value="secret" required>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" name="remember" checked id="customCheckLogin"
                                       type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customCheckLogin">
                                    <span class="text-muted">@lang('labels.Remember me')</span>
                                </label>
                            </div>
                            <div class="text-center">
                                <button type="submit"
                                        class="btn btn-block btn-primary my-4">@lang('labels.Login')</button>
                            </div>
                            <div class="text-center">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="btn btn-block btn-secondary my-4">
                                        @lang('labels.Forgot Password')
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
