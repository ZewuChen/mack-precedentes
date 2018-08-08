@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-6">
                <h2 class="mp-heading mb-5 text-center">Junte-se a nós</h2>

                {{ Form::open(['route' => 'register']) }}

                    <div class="form-group">
                        <label for="email" class="mp-heading">Nome</label>

                        <div>
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="mp-heading">E-mail</label>

                        <div>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="mp-heading">Senha</label>

                        <div>
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="mp-heading">Confirmação de senha</label>

                        <div>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <input class="mp-button--primary" type="submit" value="Quero me cadastrar">
                    </div>

                    <div class="d-flex justify-content-center my-5">
                        <a class="mp-button--transparent" href="{{ route('facebook.login') }}" style="color: #3b5998;">
                            <svg class="mp-icon mr-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24" fill="#3b5998"><path d="M5,3H19A2,2 0 0,1 21,5V19A2,2 0 0,1 19,21H5A2,2 0 0,1 3,19V5A2,2 0 0,1 5,3M18,5H15.5A3.5,3.5 0 0,0 12,8.5V11H10V14H12V21H15V14H18V11H15V9A1,1 0 0,1 16,8H18V5Z" /></svg>
                            Entrar com Facebook
                        </a>
                    </div>
                            
                {{ Form::close() }}

                <p class="text-center mp-text-meta">Já possui uma conta? <a href="{{ route('login') }}">Entre aqui</a>.</p>
            </div>
        </div>
    </div>
@endsection
