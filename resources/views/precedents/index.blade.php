@extends ('app')

@section ('content')

    <h2 class="mp-heading">Precedentes</h2>
    <p class="mp-text-meta">({{ count($precedents) }} resultados)</p>

    <div class="py-4">
        @foreach ($precedents->take(10) as $precedent)
            @include ('precedents.precedent')
        @endforeach
    </div>

    {{-- {{ $precedents->links() }} --}}

@endsection