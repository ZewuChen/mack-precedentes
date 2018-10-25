<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.tag-editor.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ url('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.10.0/ui/trumbowyg.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.10.0/plugins/colors/ui/trumbowyg.colors.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.10.0/plugins/mathml/ui/trumbowyg.mathml.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.10.0/plugins/mention/ui/trumbowyg.mention.min.css">
    <link rel="shortcut icon" sizes="196x196" href="{{ asset('img/favicon.png') }}">

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <title>Mack Precedentes</title>
</head>
<body class="mp-bg-lightgray">

    @include ('nav')
    
    <div style="margin-left: 300px;">
        @include ('topbar')

        <div class="d-flex">
            <div class="mp-content p-5">
                @yield ('content')
            </div>

            <div class="mp-sidebar p-5">
                @include ('sidebar')
            </div>
        </div>
        
    </div>

    

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.10.0/trumbowyg.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.10.0/langs/pt_br.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.10.0/plugins/cleanpaste/trumbowyg.cleanpaste.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script type="text/javascript" defer>
        $(function () {
            setTimeout(function () {
                $('.mp-flash').css('display', 'none');
            }, 6000);
        });

        $(document).ready(function() {
            $('#trumbowyg').trumbowyg({
                btns: [
                    ['strong', 'em'],
                    ['link'],
                    ['unorderedList', 'orderedList'],
                    ['removeformat'],
                    ['superscript', 'subscript'],
                    ['undo', 'redo'],
                ],
                removeformatPasted: true,
                autogrow: true,
            });
        });
    </script>

    @include ('flash')

</body>
</html>