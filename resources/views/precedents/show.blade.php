@extends ('app')

@section ('content')

    <h1 class="mp-heading">{{ $precedent->type->name }}; {{ $precedent->number }}</h1>
    <div class="mp-text-serif">{{ $precedent->body }}</div>

    <p class="mp-text-meta">Emitido em <a href="{{ route('courts.show', $precedent->court) }}">{{ $precedent->court->alias }}</a> {{ $precedent->created_at->diffForHumans() }}</p>

    <div>
        @foreach ($precedent->tags as $tag)
            <a class="mp-tag" href="{{ route('tags.show', $tag) }}">{{ $tag->name }}</a>
        @endforeach
    </div>

    @can ('create', App\Comment::class)
        <section class="my-5">
            <h6>Adicionar um comentário</h6>

            {{ Form::open(['route' => 'comments.store', 'files' => true]) }}
                {{ Form::textarea('body', old('body')) }}
                {{ Form::file('file')}}
                {{ Form::hidden('precedent_id', $precedent->id) }}
                {{ Form::submit('Adicionar comentário') }}
            {{ Form::close() }}

        </section>
    @endcan

    @if ($precedent->comments->count())

        <section class="mt-5">
            <h6>Comentários</h6>

            <div class="list-group">
                @foreach ($precedent->comments as $comment)
                    @can ('view', $comment)
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-10">
                                    <p class="text-secondary">
                                        <small>{{ $comment->user->name }} escreveu um <a href="{{ route('comments.show', $comment) }}">comentário</a> {{ $comment->created_at->diffForHumans() }}</small>
                                    </p>
                                    {{ $comment->body }}
                                </div>

                                @can ('approve', $comment)
                                    {{ Form::open(['route' => array('comments.approve', $comment), 'method' => 'patch', 'files' => true]) }}
                                        {{ Form::submit('Aprovar') }}
                                    {{ Form::close() }}
                                @endcan

                                @if ($comment->file)
                                    <div class="mt-3 col-2 d-flex align-items-center justify-content-center">
                                        <a class="btn btn-outline-primary btn-sm" href="{{ asset($comment->file) }}" download>Baixar comentário</a>
                                    </div>
                                @else
                                    <div class="mt-3 col-2 d-flex align-items-center justify-content-center">
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('comments.show', $comment) }}">Ler mais</a>
                                    </div>
                                @endif
                                
                            </div>
                        </div>
                    @endcan
                @endforeach
            </div>

        </section>

    @endif

@endsection