@extends ('app')

@section ('content')

    <h2 class="mp-heading">{{ $collection->name }}</h2>
    <p class="mp-text-meta">Coleção de {{ $collection->user->name }} ({{ $collection->precedents->count() }} resultados)</p>

    <div class="py-4">
        
        @foreach ($collection->precedents as $precedent)
            @include ('precedents.precedent', ['incollection' => true, 'codcollection' => $collection->id])
        @endforeach

    </div>

@endsection