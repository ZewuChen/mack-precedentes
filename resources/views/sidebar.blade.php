<section class="mb-5">
    <h6 class="mp-heading">Ramos do Direito</h6>
    <ul class="list-unstyled">
        @forelse ($branches->random(8) as $branch)
            <li><a href="{{ route('branches.show', $branch) }}">{{ $branch->name }}</a></li>
        @empty
            <li>Nenhum ramo encontrado</li>
        @endforelse
    </ul>
</section>

<section class="mb-5">
    <h6 class="mp-heading">Origens Processuais</h6>
    <ul class="list-unstyled">
        @forelse ($precedentsTypes->random(8) as $type)
            <li><a href="{{ route('types.show', $type) }}">{{ $type->name }}</a></li>
        @empty
            <li>Nenhuma origem processual encontrada</li>
        @endforelse
    </ul>
</section>

<section class="mb-5">
    <h6 class="mp-heading">Origens Processuais</h6>
    <ul class="list-unstyled">
        @forelse ($precedentsTypes->random(8) as $type)
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