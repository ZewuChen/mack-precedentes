<article class="py-4 mp-border-between">
    <a class="mp-text-small" href="{{ route('precedents.show', $precedent) }}">
        {{ $precedent->type->name }}; {{ $precedent->number }}
    </a>

    <div class="d-flex justify-content-between align-items-start flex-column flex-md-row">
        <div class="mr-5">
            <p class="mp-text-serif">{{ str_limit(strip_tags(html_entity_decode($precedent->body)), 200) }}</p>
            <p class="mp-text-meta">Emitido {{ $precedent->created_at->diffForHumans() }} em <a href="{{ route('branches.show', $precedent->branch) }}">{{ $precedent->branch->name }}</a> no tribunal <a href="{{ route('courts.show', $precedent->court) }}">{{ $precedent->court->alias }}</a></p>
        </div>

        @auth

            <div class="d-flex align-items-center align-items-center justify-content-between mb-3">

                @if (! auth()->user()->hasSaved($precedent))
                    {{ Form::open(['route' => array('precedents.save', $precedent)]) }}
                        <button class="mp-button-icon" title="Salvar" type="submit">
                            <svg class="mp-icon--dark" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M17,18L12,15.82L7,18V5H17M17,3H7A2,2 0 0,0 5,5V21L12,18L19,21V5C19,3.89 18.1,3 17,3Z" /></svg>
                        </button>
                    {{ Form::close() }}
                @else
                    {{ Form::open(['route' => array('precedents.unsave', $precedent)]) }}
                        <button class="mp-button-icon" title="Remover dos salvos" type="submit">
                            <svg class="mp-icon--golden" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M17,3H7A2,2 0 0,0 5,5V21L12,18L19,21V5C19,3.89 18.1,3 17,3Z" /></svg>
                        </button>
                    {{ Form::close() }}
                @endif

                <div class="dropdown">
                    <button class="mp-button-icon" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Adicionar a uma coleção">
                        <svg class="mp-icon--dark" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M2,16H10V14H2M18,14V10H16V14H12V16H16V20H18V16H22V14M14,6H2V8H14M14,10H2V12H14V10Z" /></svg>
                    </button>

                    <div class="dropdown-menu mp-dropdown__menu">
                        <h6 class="mp-dropdown__header">Adicionar a:</h6>

                        @foreach (auth()->user()->collections as $collection)
                            {{-- @can ('add', [$collection, $precedent]) --}}
                            @if (! $collection->has($precedent))
                                {{ Form::open(['route' => array('collections.add', $collection)]) }}
                                    {{ Form::hidden('precedent_id', $precedent->id) }}
                                    <input type="submit" class="mp-dropdown__item" value="{{ $collection->name }}">
                                {{ Form::close() }}
                            @endif
                            {{-- @endcan --}}
                        @endforeach
                    </div>
                </div>

                @can ('delete', $precedent)
                    <div class="dropdown">
                        <button class="mp-button-icon" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Mais opções">
                            <svg class="mp-icon--dark" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M12,16A2,2 0 0,1 14,18A2,2 0 0,1 12,20A2,2 0 0,1 10,18A2,2 0 0,1 12,16M12,10A2,2 0 0,1 14,12A2,2 0 0,1 12,14A2,2 0 0,1 10,12A2,2 0 0,1 12,10M12,4A2,2 0 0,1 14,6A2,2 0 0,1 12,8A2,2 0 0,1 10,6A2,2 0 0,1 12,4Z" /></svg>
                        </button>
                        <div class="dropdown-menu">
                            
                            @if (isset($allowCollectionOperations) && $allowCollectionOperations)
                                {{ Form::open(['route' => array('collections.remove', $collection), 'method' => 'delete']) }}
                                    {{ Form::hidden('precedent_id', $precedent->id) }}
                                    <input type="submit" class="mp-dropdown__item" value="Remover da coleção">
                                {{ Form::close() }}
                            @endif
                            
                            {{ Form::open(['route' => array('precedents.destroy', $precedent), 'method' => 'delete']) }}
                                <input class="mp-dropdown__item" type="submit" value="Deletar">
                            {{ Form::close() }}
                        </div>
                    </div>                    
                @endcan

            </div>

        @endauth

    </div>

    <div>
        @foreach ($precedent->tags as $tag)
            <a class="mp-tag" href="{{ route('tags.show', $tag) }}">{{ $tag->name }}</a>
        @endforeach
    </div>    

    <div class="d-flex align-items-end justify-content-between flex-wrap pt-3">
        <div class="d-flex align-items-center flex-wrap mr-5">
            @auth
                @if (! $precedent->isLikedBy(auth()->user()))
                    {{ Form::open(['route' => array('precedent.like', $precedent)]) }}
                        <button class="mp-button--transparent mp-text-meta" type="submit">
                            <svg class="mp-icon--dark mr-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M23,10C23,8.89 22.1,8 21,8H14.68L15.64,3.43C15.66,3.33 15.67,3.22 15.67,3.11C15.67,2.7 15.5,2.32 15.23,2.05L14.17,1L7.59,7.58C7.22,7.95 7,8.45 7,9V19A2,2 0 0,0 9,21H18C18.83,21 19.54,20.5 19.84,19.78L22.86,12.73C22.95,12.5 23,12.26 23,12V10M1,21H5V9H1V21Z" /></svg>
                            Curtir
                        </button>
                    {{ Form::close() }}
                @else
                    {{ Form::open(['route' => array('precedent.dislike', $precedent)]) }}
                        <button class="mp-button--transparent mp-text-meta" type="submit">
                            <svg class="mp-icon--golden mr-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M23,10C23,8.89 22.1,8 21,8H14.68L15.64,3.43C15.66,3.33 15.67,3.22 15.67,3.11C15.67,2.7 15.5,2.32 15.23,2.05L14.17,1L7.59,7.58C7.22,7.95 7,8.45 7,9V19A2,2 0 0,0 9,21H18C18.83,21 19.54,20.5 19.84,19.78L22.86,12.73C22.95,12.5 23,12.26 23,12V10M1,21H5V9H1V21Z" /></svg>
                            Curtido
                        </button>
                    {{ Form::close() }}
                @endif

            @endauth
        </div>

        <a class="mp-button--primary" href="{{ route('precedents.show', $precedent) }}">Ler mais</a>
    </div>
</article>