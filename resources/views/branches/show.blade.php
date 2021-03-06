@extends ('app')

@section ('content')

    <h2 class="mp-heading">{{ $branch->name }}</h2>
    <p class="mp-text-meta">({{ count($branch->precedents) }} resultados)</p>

    <div class="py-4">
        @foreach ($branch->precedents as $precedent)
            @include ('precedents.precedent', $precedent)
        @endforeach
    </div>

@endsection