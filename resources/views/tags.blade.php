<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.tag-editor.css') }}">
    <title>Tags</title>
</head>
<body>
    <textarea></textarea>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.tag-editor.min.js') }}"></script>
    <script type="text/javascript">
        $('textarea').tagEditor();
    </script>
</body>
</html>