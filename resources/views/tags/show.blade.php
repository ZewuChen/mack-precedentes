@extends ('app')

@section ('content')

    <h1>{{ $tag->name }}</h1>

    <div class="list-group">

        @foreach ($tag->precedents as $precedent)
            @include ('precedents.precedent', $precedent)
        @endforeach

    </div>

@endsection