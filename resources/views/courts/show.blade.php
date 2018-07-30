@extends ('app')

@section ('content')

    <h1>{{ $court->name }}</h1>

    <div class="list-group">

        @foreach ($court->precedents as $precedent)
            @include ('precedents.precedent', $precedent)
        @endforeach

    </div>

@endsection