<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="{{ url('css/app.css') }}">

    <title>Mack Precedentes</title>
</head>
<body>

    {{-- @include ('nav') --}}
    
    @auth
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <input type="submit" value="Logout">
        </form>
    @endauth

    <a href="{{ route('user.index') }}"><input type="submit" value="Profile"></a>
    
    <div class="container">

        @yield ('content')
        
    </div>

</body>
</html>