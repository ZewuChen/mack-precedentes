<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mack Precedentes</title>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="{{ url('css/app.css') }}">
</head>
<body class="mp-bg-lightgray">
    <nav class="navbar navbar-expand-md navbar-light py-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img width="250" src="{{ url('img/logo.png') }}">
            </a>

            @guest
                <div class="navbar-nav ml-auto">
                    <a class="mp-button--primary" href="{{ route('login') }}">Login</a>
                    <a class="mp-button--link" href="{{ route('register') }}">Cadastre-se</a>
                </div>
            @endguest
        </div>
    </nav>

    <div class="py-4">
        @yield('content')
    </div>
</body>
</html>
