<section class="mb-5">
    <h6 class="mp-heading">Ramos do Direito</h6>
    <ul class="list-unstyled">
        @forelse ($branches as $branch)
            <li><a href="{{ route('branches.show', $branch) }}">{{ $branch->name }}</a></li>
        @empty
            <li>Nenhum ramo encontrado</li>
        @endforelse
    </ul>
</section>

<section class="mb-5">
    <h6 class="mp-heading">Origens Processuais</h6>
    <ul class="list-unstyled">
        @forelse ($precedentsTypes as $type)
            <li><a href="{{ route('types.show', $type) }}">{{ $type->name }}</a></li>
        @empty
            <li>Nenhuma origem processual encontrada</li>
        @endforelse
    </ul>
</section>

<section class="mb-5">
    <h6 class="mp-heading">Tags</h6>
    <div class="d-flex justify-content-flex-start flex-wrap">
        @forelse ($tags->random(12) as $tag)
            <a class="mp-tag" href="{{ route('tags.show', $tag) }}">{{ $tag->name }}</a></li>
        @empty
            Nenhuma tag encontrada
        @endforelse
    </div>
</section>

<section class="mb-5">
    <h6 class="mp-heading">Tribunais</h6>
    <ul class="list-unstyled">
        @forelse ($courts->random(8) as $court)
            <li><a href="{{ route('courts.show', $court) }}">{{ $court->name }}</a></li>
        @empty
            <li>Nenhum tribunal encontrado</li>
        @endforelse
    </ul>
</section>

<div class="d-flex align-items-center flex-wrap justify-content-center mp-text-meta pt-5">
    <a href="{{ route('definition') }}" class="mp-text-secondary mx-2 my-1">Definição</a>
    <a href="{{ route('proposal') }}" class="mp-text-secondary mx-2 my-1">Proposta</a>
    <a href="{{ route('team') }}" class="mp-text-secondary mx-2 my-1">Equipe</a>
    {{-- <a href="{{ route('scientific-methodology') }}" class="mp-text-secondary mx-2 my-1">Metodologia Científica</a> --}}
    <a href="{{ route('collection-methodology') }}" class="mp-text-secondary mx-2 my-1">Metodologia de Coleta</a>
    <a href="{{ route('patreon') }}" class="mp-text-secondary mx-2 my-1">Patrono</a>
</div>