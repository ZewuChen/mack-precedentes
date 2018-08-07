@extends ('app')

@section ('content')

    <h2 class="mp-heading">{{ $precedent->type->name }}; {{ $precedent->number }}</h2>
    <div class="mp-text-serif">{{ $precedent->body }}</div>

    <p class="mp-text-meta">Emitido em <a href="{{ route('courts.show', $precedent->court) }}">{{ $precedent->court->alias }}</a> {{ $precedent->created_at->diffForHumans() }}</p>

    <div>
        @foreach ($precedent->tags as $tag)
            <a class="mp-tag" href="{{ route('tags.show', $tag) }}">{{ $tag->name }}</a>
        @endforeach
    </div>

    <hr>

    @can ('create', App\Comment::class)
        <section class="my-5">
            <h6>Publicar um comentário</h6>
            <p class="mp-text-meta">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

            {{ Form::open(['route' => 'comments.store', 'files' => true]) }}
                <div class="form-group">
                    {{ Form::textarea('body', old('body'), array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::file('file', array('class' => 'form-control'))}}
                </div>
                {{ Form::hidden('precedent_id', $precedent->id) }}
                <div class="d-flex justify-content-end">
                    <input class="mp-button--primary" type="submit" value="Adicionar comentário">
                </div>
            {{ Form::close() }}

        </section>
    @endcan

    @if ($precedent->comments->count())

        <section class="mt-5">
            <h6>Comentários</h6>

            <div>
                @foreach ($precedent->comments as $comment)
                    @can ('view', $comment)
                        <article class="py-3">
                            <div class="row">
                                <div class="col-9">
                                    <header>
                                        <img class="mp-image--36x36 mp-rounded mr-2" src="https://randomuser.me/api/portraits/men/43.jpg">
                                        {{ $comment->user->name }} publicou um <a href="{{ route('comments.show', $comment) }}">comentário</a> {{ $comment->created_at->diffForHumans() }}
                                    </header>
                                    <div class="d-flex align-items-center my-2">
                                        <svg class="mp-icon mp-icon--dark mr-3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M10,7L8,11H11V17H5V11L7,7H10M18,7L16,11H19V17H13V11L15,7H18Z" /></svg>
                                        <div class="mp-text-serif mp-text-meta">{{ $comment->body }}</div>
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
                    @endcan
                @endforeach
            </div>

        </section>

    @endif

@endsection