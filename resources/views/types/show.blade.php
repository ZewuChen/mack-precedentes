@extends ('app')

@section ('content')

    <h2 class="mp-heading">{{ $precedentType->name }}</h2>

    <div class="py-5">
        @foreach ($precedentType->precedents as $precedent)
            @include ('precedents.precedent', $precedent)
        @endforeach
    </div>

@endsection