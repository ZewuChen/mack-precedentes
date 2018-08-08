@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-6">
                <h2 class="mp-heading mb-5 text-center">Redefinir minha senha</h2>
                
                {{ Form::open(['route' => 'password.request'])}}
                    {{ Form::hidden('token', $token)}}

                    <div class="form-group">
                        <label for="email" class="mp-heading">E-mail</label>

                        <div>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

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

                    <input class="mp-button--primary" type="submit" value="Redefinir senha">
                
                {{ Form::close() }}

            </div>
        </div>
    </div>

@endsection
