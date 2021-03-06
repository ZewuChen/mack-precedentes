@extends ('app')

@section ('content')

    <h2 class="mp-heading">{{ $precedent->type->name }}; {{ $precedent->number }}</h2>
    <div class="mp-text-serif">{!! $precedent->body !!}</div>

    <p class="mp-text-meta">Emitido {{ $precedent->created_at->diffForHumans() }} em <a href="{{ route('branches.show', $precedent->branch) }}">{{ $precedent->branch->name }}</a> no tribunal <a href="{{ route('courts.show', $precedent->court) }}">{{ $precedent->court->alias }}</a></p>

    <div>
        @foreach ($precedent->tags as $tag)
            <a class="mp-tag" href="{{ route('tags.show', $tag) }}">{{ $tag->name }}</a>
        @endforeach
    </div>

    @auth
        <div class="mt-5">
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
        </div>

    @endauth

    <hr>

    @auth
        <section class="my-5">
            <h6 class="mp-heading">Publicar um comentário</h6>
            <p class="mp-text-meta">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

            {{ Form::open(['route' => 'comments.store', 'files' => true]) }}
                <div class="form-group">
                    <textarea class="form-control" name="body" id="trumbowyg" required>{{ old('body') }}</textarea>
                </div>

                <div class="form-group">
                    {{ Form::label('Documento (PDF) - opcional') }}
                    {{ Form::file('file', array('class' => 'form-control'))}}
                </div>

                {{ Form::hidden('precedent_id', $precedent->id) }}

                <div class="d-flex justify-content-end">
                    <input class="mp-button--primary" type="submit" value="Adicionar comentário">
                </div>
            {{ Form::close() }}

            @include ('trumbowyg-icons')

        </section>
    @endauth

    @if ($precedent->comments->count())

        <section class="mt-5">
            <h6 class="mp-heading">Comentários</h6>

            <div>
                @foreach ($precedent->comments as $comment)
                    @if ($comment->isApproved() || (auth()->check() && auth()->user()->hasRole('admin')))
                        <article class="py-3">
                            <div class="row">
                                <div class="col-9">
                                    <header>
                                        <img class="mp-image--36x36 mp-rounded mr-2" src="https://randomuser.me/api/portraits/men/43.jpg">
                                        {{ $comment->user->name }} publicou um <a href="{{ route('comments.show', $comment) }}">comentário</a> {{ $comment->created_at->diffForHumans() }}
                                    </header>
                                    <div class="d-flex align-items-center my-2">
                                        <svg class="mp-icon mp-icon--dark mr-3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M10,7L8,11H11V17H5V11L7,7H10M18,7L16,11H19V17H13V11L15,7H18Z" /></svg>
                                        <div class="mp-text-serif mp-text-meta">{{ str_limit(strip_tags(html_entity_decode($comment->body)), 200) }}</div>
                                    </div>
                                </div>

                                <div class="col-3 d-flex align-items-center justify-content-end">
                                    @if ($comment->file)
                                        <a class="mp-button--outline" href="{{ asset($comment->file) }}" download>Baixar</a>
                                    @else
                                        <a class="mp-button--outline" href="{{ route('comments.show', $comment) }}">Ler mais</a>
                                    @endif
                                </div>

                                @can ('approve', $comment)
                                    <div class="d-flex flex-wrap align-items-center mb-3 col-12">
                                        <svg class="mp-icon--golden mr-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M23,12L20.56,9.22L20.9,5.54L17.29,4.72L15.4,1.54L12,3L8.6,1.54L6.71,4.72L3.1,5.53L3.44,9.21L1,12L3.44,14.78L3.1,18.47L6.71,19.29L8.6,22.47L12,21L15.4,22.46L17.29,19.28L20.9,18.46L20.56,14.78L23,12M10,17L6,13L7.41,11.59L10,14.17L16.59,7.58L18,9L10,17Z" /></svg>
                                        <span class="mp-text-bold mp-text-small mr-3">Deseja aprovar este comentário?</span>
                                        <div class="d-flex flex-wrap">
                                            {{ Form::open(['route' => array('comments.approve', $comment), 'method' => 'patch']) }}
                                                <input class="mp-text-small mp-button--inline-golden" type="submit" value="Sim">
                                            {{ Form::close() }}
                                            {{ Form::open(['route' => array('comments.destroy', $comment), 'method' => 'delete']) }}
                                                <input class="mp-text-small mp-button--inline" type="submit" value="Não">
                                            {{ Form::close() }}
                                        </div>
                                    </div>                                    
                                @endcan
                            </div>
                        </article>
                    @endif
                @endforeach
            </div>
            <hr>
            <p class="mp-text-meta"><strong>Disclaimer:</strong> os comentários exibidos no site são resultado do trabalho dos acadêmicos
    da Universidade Presbiteriana Mackenzie ou de outros estudiosos, submetidos a
    revisão dos editores do projeto Mack Precedentes, também acadêmicos de Direito.
    Seu propósito é exclusivamente didático-científico, como ferramenta de discussão e
    análise do conteúdo dos precedentes vinculantes analisados. Os comentários não
    servem como orientação jurídica e estão sujeitos a erros de análise próprios do
    contexto de sua produção. A autonomia científica dos autores dos comentários foi
    preservada, motivo pelo qual o Observatório e a Universidade Presbiteriana Mackenzie
    não se responsabilizam nem endossam as opiniões aqui expostas.</p>

        </section>

    @endif

@endsection