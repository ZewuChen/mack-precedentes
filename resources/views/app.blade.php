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

    @include ('nav')
    
    @auth
        {{ Form::open(['logout' => 'logout']) }}
            <input type="submit" value="Logout">
        {{ Form::close() }}
    @endauth

    

    {{-- <a href="{{ route('user.index') }}"><input type="submit" value="Profile"></a> --}}
    
    <div class="container">
        @include ('topbar')
        <br><br>
        {{-- <img class="mp-img--48x48" src="https://randomuser.me/api/portraits/men/32.jpg"> --}}
        @yield ('content')
        
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(function () {
            setTimeout(function () {
                $('.mp-flash').css('display', 'none');
            }, 6000);
        });
    </script>

    @include ('flash')

</body>
</html>