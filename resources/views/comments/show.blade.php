@extends ('app')

@section ('content')

    <h2 class="mp-heading">
        Comentário em resposta a <a href="{{ route('precedents.show', $comment->precedent) }}">{{ $comment->precedent->number }}</a>
    </h2>

    <div><strong>Tese:</strong> <span class="mp-text-serif mp-text-secondary">{{ $comment->precedent->body }}</span></div>

    <div class="d-flex my-4">
        <svg class="mp-icon mp-icon--dark mr-3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M10,7L8,11H11V17H5V11L7,7H10M18,7L16,11H19V17H13V11L15,7H18Z" /></svg>
        <div class="mp-text-serif">{{ $comment->body }}</div>
    </div>

    @if ($comment->file)
        <div class="d-flex my-4">
            <a class="mp-button--outline" href="{{ asset('storage/' . $comment->file) }}" download>Baixar anexo</a>
        </div>
    @endif
    
    <div class="d-flex align-items-center flex-wrap mt-5">
        <img class="mp-image--36x36 mp-rounded mr-2" src="https://randomuser.me/api/portraits/men/43.jpg">
        <div class="mp-text-meta">Publicado {{ $comment->created_at->diffForHumans() }} por {{ $comment->user->name }}</div>
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

    @can ('delete', $comment)
        <div class="d-flex justify-content-end">
            {{ Form::open(['route' => array('comments.destroy', $comment), 'method' => 'delete']) }}
                <input class="mp-button--outline" type="submit" value="Apagar comentário">
            {{ Form::close() }}
        </div>
    @endcan

@endsection