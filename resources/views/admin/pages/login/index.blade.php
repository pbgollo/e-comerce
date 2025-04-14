@extends('admin.master.admin')

@section('layout')

<style>
    :root{
        --primary-color: {{$appearance['login_primary_color']}};
        --secondary-color: {{$appearance['login_secondary_color']}};
    }
</style>

<div class="header bg-gradient-primary py-7 py-lg-8">
    <div class="container">
        <div class="header-body text-center mb-7">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6">
                    <img src="{{ resize($appearance['login_logo'],400) }}" height="50" />
                </div>
            </div>
        </div>
    </div>
    <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
        </svg>
    </div>
</div>

<div class="container mt--8 pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card bg-secondary shadow border-0">

                <div class="card-body px-lg-5 py-lg-5">

                    @if(session()->has('alert'))
                        <div class="alert alert-warning">
                            {{ session()->get('alert') }}
                        </div>
                    @else
                        <div class="text-center text-muted mb-4 small">
                            Informe os dados abaixo para realizar o acesso
                        </div>
                    @endif

                    <form role="form" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">email</i>
                                    </span>
                                </div>
                                <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" type="email" name="email" value="{{ old('email') }}" autofocus>
                            </div>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                   {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">vpn_key</i>
                                    </span>
                                </div>
                                <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Senha" type="password">
                            </div>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    {{ $errors->first('password') }}
                                </span>
                            @endif
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary my-4">Entrar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col text-center">
                    <a href="{{ route('admin.login.recovery') }}" class="text-primary">
                        <small>Esqueceu a senha?</small>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
