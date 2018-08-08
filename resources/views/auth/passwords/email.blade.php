@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-6">
                <h2 class="mp-heading mb-5 text-center">Esqueci minha senha</h2>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                {{ Form::open(['route' => 'password.email']) }}                        

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

                    <input class="mp-button--primary" type="submit" value="Enviar link de redefinição">
                    
                {{ Form::close() }}

            </div>
        </div>
    </div>
@endsection
