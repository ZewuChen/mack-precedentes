@extends ('app')

@section ('content')

    <h2 class="mp-heading">{{ $court->name }}</h2>

    <div class="py-4">
        @foreach ($court->precedents as $precedent)
            @include ('precedents.precedent', $precedent)
        @endforeach
    </div>

@endsection