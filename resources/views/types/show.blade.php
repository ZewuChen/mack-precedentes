@extends ('app')

@section ('content')

    <h1>{{ $precedentType->name }}</h1>

    <div class="list-group">

        @foreach ($precedentType->precedents as $precedent)
            @include ('precedents.precedent', $precedent)
        @endforeach

    </div>

@endsection