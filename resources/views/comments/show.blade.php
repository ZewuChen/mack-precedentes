@extends ('app')

@section ('content')

    <h1 class="mp-heading">
        Comentário em resposta a <a href="{{ route('precedent.show', $comment->precedent) }}">{{ $comment->precedent->number }}</a>
    </h1>
    <div class="mp-text-serif mp-text-secondary"><strong>Tese:</strong> {{ $comment->precedent->body }}</div>

    <div class="mp-text-serif">{{ $comment->body }}</div>

    <div class="mp-text-meta">
        <img class="mp-image--36x36 mp-rounded" src="https://randomuser.me/api/portraits/men/43.jpg">
        <p>Publicado {{ $comment->created_at->diffForHumans() }} por {{ $comment->user->name }}</p>
    </div>

    @if ($comment->file)
        <div class="d-flex justify-content-start">
            <a class="mp-button--outline" href="{{ asset('storage/' . $comment->file) }}" download>Baixar anexo</a>
        </div>
    @endif

    <hr>

    {{ Form::open(['route' => array('comments.destroy', $comment), 'method' => 'delete']) }}
        <input type="submit" value="Deletar">
    {{ Form::close() }}

@endsection