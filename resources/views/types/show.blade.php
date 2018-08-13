@extends ('app')

@section ('content')

    <h2 class="mp-heading">{{ $type->name }}</h2>
    <p class="mp-text-meta">({{ $type->precedents->count() }} resultados)</p>

    <div class="py-5">
        @foreach ($type->precedents as $precedent)
            @include ('precedents.precedent', $precedent)
        @endforeach
    </div>

@endsection