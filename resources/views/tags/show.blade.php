@extends ('app')

@section ('content')

    <h2 class="mp-heading">{{ $tag->name }}</h2>
    <p class="mp-text-meta">Precedentes categorizados como <strong>{{ $tag->name }}</strong></p>

    <div class="py-5">
        @foreach ($tag->precedents as $precedent)
            @include ('precedents.precedent', $precedent)
        @endforeach
    </div>

@endsection