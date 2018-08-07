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
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <input type="submit" value="Logout">
        </form>
    @endauth

    {{-- <div class="mr-5 border border-primary">
        <form class="form" method="POST" action="{{ route('precedent.search') }}" >
            @csrf

            <div class="form-inline">                               
                <label>
                    <input type="text" class="form-control" name="data">   
                </label>

                <button class="btn btn-info btn-add">Procurar</button>
            </div>
            
            <div class="form-list col-sm-4 border border-primary">
                @foreach($courts as $court)                    
                    <label class="form-inline"><input type="checkbox" name="courts[]" class="btn btn-link" value="{{$court->id}}">{!! $court->name !!}</label>                    
                @endforeach 
            </div>    

            <div class="form-list col-sm-3 border border-secondary">
                @foreach($precedentsTypes as $precedentType)
                    <label class="form-inline"><input type="checkbox" name="types[]" class="btn btn-link" value="{{$precedentType->id}}">{!! $precedentType->name !!}</label>
                @endforeach
            </div>

            <div class="form-list col-sm-2 border border-info">
                <label class="form-inline"><input type="radio" name="date" groupName="date" value="today">Hoje</label>
                <label class="form-inline"><input type="radio" name="date" groupName="date" value="week">Esta Semana</label>
                <label class="form-inline"><input type="radio" name="date" groupName="date" value="month">Este Mês</label>
                <label class="form-inline"><input type="radio" name="date" groupName="date" value="year">Este Ano</label>
                <label class="form-inline"><input type="radio" name="date" groupName="date" value="last">Mais Antigos</label>
            </div>                

        </form>
    </div> --}}

    {{-- <a href="{{ route('user.index') }}"><input type="submit" value="Profile"></a> --}}
    
    <div class="container">
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