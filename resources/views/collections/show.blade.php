@extends ('app')

@section ('content')

    <h1>{{ $collection->name }}</h1>
    <p class="text-secondary"><small>Coleção de {{ $collection->user->name }}</small></p>

    <div class="list-group">
        
        @foreach ($collection->precedents as $precedent)
            @include ('precedents.precedent', ['incollection' => true, 'codcollection' => $collection->id])
        @endforeach

    </div>

@endsection