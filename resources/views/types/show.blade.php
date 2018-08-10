@extends ('app')

@section ('content')

    <h2 class="mp-heading">{{ $precedentType->name }}</h2>
    <p class="mp-text-meta">({{ $precedentType->precedents->count() }} resultados)</p>

    <div class="py-5">
        @foreach ($precedentType->precedents as $precedent)
            @include ('precedents.precedent', $precedent)
        @endforeach
    </div>

@endsection