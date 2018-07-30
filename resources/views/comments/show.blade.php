@extends ('app')

@section ('content')

    <h1>Comentário em resposta a <a href="{{ route('precedent.show', $comment->precedent) }}">{{ $comment->precedent->number }}</a></h1>
    <div><strong>Tese:</strong> {{ $comment->precedent->body }}</div>

    <div class="mt-3 alert alert-secondary">{{ $comment->body }}</div>

    <p class="text-secondary">
        <small>Publicado {{ (new Carbon($comment->created_at))->diffForHumans() }} por {{ $comment->user->name }}</small>
    </p>

@endsection