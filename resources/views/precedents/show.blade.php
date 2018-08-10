@extends ('app')

@section ('content')

    <h2 class="mp-heading">{{ $precedent->type->name }}; {{ $precedent->number }}</h2>
    <div class="mp-text-serif">{{ $precedent->body }}</div>

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
                    <textarea class="form-control" name="body" id="trumbowyg">{{ old('body') }}</textarea>
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

            <div id="trumbowyg-icons">
                <svg xmlns="http://www.w3.org/2000/svg">
                    <symbol id="trumbowyg-strong" viewBox="0 0 72 72"><path d="M51.1 37.8c-1.1-1.4-2.5-2.5-4.2-3.3 1.2-.8 2.1-1.8 2.8-3 1-1.6 1.5-3.5 1.5-5.3 0-2-.6-4-1.7-5.8-1.1-1.8-2.8-3.2-4.8-4.1-2-.9-4.6-1.3-7.8-1.3h-16v42h16.3c2.6 0 4.8-.2 6.7-.7 1.9-.5 3.4-1.2 4.7-2.1 1.3-1 2.4-2.4 3.2-4.1.9-1.7 1.3-3.6 1.3-5.7.2-2.5-.5-4.7-2-6.6zM40.8 50.2c-.6.1-1.8.2-3.4.2h-9V38.5h8.3c2.5 0 4.4.2 5.6.6 1.2.4 2 1 2.7 2 .6.9 1 2 1 3.3 0 1.1-.2 2.1-.7 2.9-.5.9-1 1.5-1.7 1.9-.8.4-1.7.8-2.8 1zm2.6-20.4c-.5.7-1.3 1.3-2.5 1.6-.8.3-2.5.4-4.8.4h-7.7V21.6h7.1c1.4 0 2.6 0 3.6.1s1.7.2 2.2.4c1 .3 1.7.8 2.2 1.7.5.9.8 1.8.8 3-.1 1.3-.4 2.2-.9 3z"/></symbol>
                    <symbol id="trumbowyg-ordered-list" viewBox="0 0 72 72"><path d="M27 14h36v8H27zM27 50h36v8H27zM27 32h36v8H27zM11.8 15.8V22h1.8v-7.8h-1.5l-2.1 1 .3 1.3zM12.1 38.5l.7-.6c1.1-1 2.1-2.1 2.1-3.4 0-1.4-1-2.4-2.7-2.4-1.1 0-2 .4-2.6.8l.5 1.3c.4-.3 1-.6 1.7-.6.9 0 1.3.5 1.3 1.1 0 .9-.9 1.8-2.6 3.3l-1 .9V40H15v-1.5h-2.9zM13.3 53.9c1-.4 1.4-1 1.4-1.8 0-1.1-.9-1.9-2.6-1.9-1 0-1.9.3-2.4.6l.4 1.3c.3-.2 1-.5 1.6-.5.8 0 1.2.3 1.2.8 0 .7-.8.9-1.4.9h-.7v1.3h.7c.8 0 1.6.3 1.6 1.1 0 .6-.5 1-1.4 1-.7 0-1.5-.3-1.8-.5l-.4 1.4c.5.3 1.3.6 2.3.6 2 0 3.2-1 3.2-2.4 0-1.1-.8-1.8-1.7-1.9z"/></symbol>
                    <symbol id="trumbowyg-undo" viewBox="0 0 72 72"><path d="M61.2 51.2c0-5.1-2.1-9.7-5.4-13.1-3.3-3.3-8-5.4-13.1-5.4H26.1v-12L10.8 36l15.3 15.3V39.1h16.7c3.3 0 6.4 1.3 8.5 3.5 2.2 2.2 3.5 5.2 3.5 8.5h6.4z"/></symbol>
                    <symbol id="trumbowyg-unlink" viewBox="0 0 72 72"><path d="M30.9 49.1l-6.7 6.7c-.8.8-1.6.9-2.1.9s-1.4-.1-2.1-.9l-5.2-5.2c-1.1-1.1-1.1-3.1 0-4.2l6.1-6.1.2-.2 6.5-6.5c-1.2-.6-2.5-.9-3.8-.9-2.3 0-4.6.9-6.3 2.6L10.8 42c-3.5 3.5-3.5 9.2 0 12.7l5.2 5.2c1.7 1.7 4 2.6 6.3 2.6s4.6-.9 6.3-2.6l6.7-6.7C38 50.5 38.6 46.3 37 43l-6.1 6.1zM38.5 22.7l6.7-6.7c.8-.8 1.6-.9 2.1-.9s1.4.1 2.1.9l5.2 5.2c1.1 1.1 1.1 3.1 0 4.2l-6.1 6.1-.2.2-6.5 6.5c1.2.6 2.5.9 3.8.9 2.3 0 4.6-.9 6.3-2.6l6.7-6.7c3.5-3.5 3.5-9.2 0-12.7l-5.2-5.2c-1.7-1.7-4-2.6-6.3-2.6s-4.6.9-6.3 2.6l-6.7 6.7c-2.7 2.7-3.3 6.9-1.7 10.2l6.1-6.1z"/><path d="M44.1 30.7c.2-.2.4-.6.4-.9 0-.3-.1-.6-.4-.9l-2.3-2.3c-.2-.2-.6-.4-.9-.4-.3 0-.6.1-.9.4L25.8 40.8c-.2.2-.4.6-.4.9 0 .3.1.6.4.9l2.3 2.3c.2.2.6.4.9.4.3 0 .6-.1.9-.4l14.2-14.2zM41.3 55.8v-5h22.2v5H41.3z"/></symbol>
                    <symbol id="trumbowyg-unordered-list" viewBox="0 0 72 72"><path d="M27 14h36v8H27zM27 50h36v8H27zM9 50h9v8H9zM9 32h9v8H9zM9 14h9v8H9zM27 32h36v8H27z"/></symbol>
                    <symbol id="trumbowyg-link" viewBox="0 0 72 72"><path d="M30.9 49.1l-6.7 6.7c-.8.8-1.6.9-2.1.9s-1.4-.1-2.1-.9l-5.2-5.2c-1.1-1.1-1.1-3.1 0-4.2l6.1-6.1.2-.2 6.5-6.5c-1.2-.6-2.5-.9-3.8-.9-2.3 0-4.6.9-6.3 2.6L10.8 42c-3.5 3.5-3.5 9.2 0 12.7l5.2 5.2c1.7 1.7 4 2.6 6.3 2.6s4.6-.9 6.3-2.6l6.7-6.7C38 50.5 38.6 46.3 37 43l-6.1 6.1zM38.5 22.7l6.7-6.7c.8-.8 1.6-.9 2.1-.9s1.4.1 2.1.9l5.2 5.2c1.1 1.1 1.1 3.1 0 4.2l-6.1 6.1-.2.2-6.5 6.5c1.2.6 2.5.9 3.8.9 2.3 0 4.6-.9 6.3-2.6l6.7-6.7c3.5-3.5 3.5-9.2 0-12.7l-5.2-5.2c-1.7-1.7-4-2.6-6.3-2.6s-4.6.9-6.3 2.6l-6.7 6.7c-2.7 2.7-3.3 6.9-1.7 10.2l6.1-6.1z"/><path d="M44.1 30.7c.2-.2.4-.6.4-.9 0-.3-.1-.6-.4-.9l-2.3-2.3c-.2-.2-.6-.4-.9-.4-.3 0-.6.1-.9.4L25.8 40.8c-.2.2-.4.6-.4.9 0 .3.1.6.4.9l2.3 2.3c.2.2.6.4.9.4.3 0 .6-.1.9-.4l14.2-14.2z"/></symbol>
                    <symbol id="trumbowyg-create-link" viewBox="0 0 72 72"><path d="M31.1 48.9l-6.7 6.7c-.8.8-1.6.9-2.1.9s-1.4-.1-2.1-.9L15 50.4c-1.1-1.1-1.1-3.1 0-4.2l6.1-6.1.2-.2 6.5-6.5c-1.2-.6-2.5-.9-3.8-.9-2.3 0-4.6.9-6.3 2.6L11 41.8c-3.5 3.5-3.5 9.2 0 12.7l5.2 5.2c1.7 1.7 4 2.6 6.3 2.6s4.6-.9 6.3-2.6l6.7-6.7c2.5-2.6 3.1-6.7 1.5-10l-5.9 5.9zM38.7 22.5l6.7-6.7c.8-.8 1.6-.9 2.1-.9s1.4.1 2.1.9l5.2 5.2c1.1 1.1 1.1 3.1 0 4.2l-6.1 6.1-.2.2L42 38c1.2.6 2.5.9 3.8.9 2.3 0 4.6-.9 6.3-2.6l6.7-6.7c3.5-3.5 3.5-9.2 0-12.7l-5.2-5.2c-1.7-1.7-4-2.6-6.3-2.6s-4.6.9-6.3 2.6l-6.7 6.7c-2.7 2.7-3.3 6.9-1.7 10.2l6.1-6.1c0 .1 0 .1 0 0z"/><path d="M44.2 30.5c.2-.2.4-.6.4-.9 0-.3-.1-.6-.4-.9l-2.3-2.3c-.3-.2-.6-.4-.9-.4-.3 0-.6.1-.9.4L25.9 40.6c-.2.2-.4.6-.4.9 0 .3.1.6.4.9l2.3 2.3c.2.2.6.4.9.4.3 0 .6-.1.9-.4l14.2-14.2zM49.9 55.4h-8.5v-5h8.5v-8.9h5.2v8.9h8.5v5h-8.5v8.9h-5.2v-8.9z"/></symbol>
                    <symbol id="trumbowyg-removeformat" viewBox="0 0 72 72"><path d="M58.2 54.6L52 48.5l3.6-3.6 6.1 6.1 6.4-6.4 3.8 3.8-6.4 6.4 6.1 6.1-3.6 3.6-6.1-6.1-6.4 6.4-3.7-3.8 6.4-6.4zM21.7 52.1H50V57H21.7zM18.8 15.2h34.1v6.4H39.5v24.2h-7.4V21.5H18.8v-6.3z"/></symbol>
                    <symbol id="trumbowyg-superscript" viewBox="0 0 72 72"><path d="M32 15h7.8L56 57.1h-7.9l-4-11.1H27.4l-4 11.1h-7.6L32 15zm-2.5 25.4h12.9L36 22.3h-.2l-6.3 18.1zM49.6 28.8c.5-1.1 1.6-2.3 3.4-3.6 1.5-1.1 2.5-1.9 3-2.4.7-.7 1-1.6 1-2.4 0-.7-.2-1.3-.6-1.8-.4-.5-1-.7-1.7-.7-1 0-1.7.4-2.1 1.1-.2.4-.3 1.1-.4 2.1H49c.1-1.5.3-2.6.8-3.5.9-1.7 2.5-2.6 4.8-2.6 1.8 0 3.2.5 4.3 1.5 1.1 1 1.6 2.3 1.6 4 0 1.3-.4 2.4-1.1 3.4-.5.7-1.3 1.4-2.4 2.2l-1.3 1c-.8.6-1.4 1-1.7 1.3-.3.3-.6.6-.8.9h7.4v3H48.8c0-1.3.3-2.4.8-3.5z"/></symbol>
                    <symbol id="trumbowyg-subscript" viewBox="0 0 72 72"><path d="M32 15h7.8L56 57.1h-7.9L44.3 46H27.4l-4 11.1h-7.6L32 15zm-2.5 25.4h12.9L36 22.3h-.2l-6.3 18.1zM58.7 59.9c.6-1.4 2-2.8 4.1-4.4 1.9-1.3 3.1-2.3 3.7-2.9.8-.9 1.3-1.9 1.3-3 0-.9-.2-1.6-.7-2.2-.5-.6-1.2-.9-2.1-.9-1.2 0-2.1.5-2.5 1.4-.3.5-.4 1.4-.5 2.5h-4c.1-1.8.4-3.2 1-4.3 1.1-2.1 3-3.1 5.8-3.1 2.2 0 3.9.6 5.2 1.8 1.3 1.2 1.9 2.8 1.9 4.8 0 1.5-.5 2.9-1.4 4.1-.6.8-1.6 1.7-3 2.6L66 57.7c-1 .7-1.7 1.2-2.1 1.6-.4.3-.7.7-1 1.1H72V64H57.8c0-1.5.3-2.8.9-4.1z"/></symbol>
                    <symbol id="trumbowyg-redo" viewBox="0 0 72 72"><path d="M10.8 51.2c0-5.1 2.1-9.7 5.4-13.1 3.3-3.3 8-5.4 13.1-5.4H46v-12L61.3 36 45.9 51.3V39.1H29.3c-3.3 0-6.4 1.3-8.5 3.5-2.2 2.2-3.5 5.2-3.5 8.5h-6.5z"/></symbol>
                    <symbol id="trumbowyg-em" viewBox="0 0 72 72"><path d="M26 57l10.1-42h7.2L33.2 57H26z"/></symbol>
                </svg>
            </div>

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
                                        <div class="mp-text-serif mp-text-meta">{{ str_limit(strip_tags($comment->body), 200) }}</div>
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

        </section>

    @endif

@endsection