<div class="list-group-item">
    <div class="row">
        <div class="col-10">
            <p class="text-secondary"><small>{{ $comment->user->name }} escreveu um <a href="{{ route('comment.show', $comment) }}">comentário</a> {{ (new Carbon($comment->created_at))->diffForHumans() }}</small></p>
            {{ $comment->body }}
        </div>

        @if ($comment->status == 0)

            <form action="{{ route('comment.status', $comment) }}" method="POST" enctype="multipart/form-data">
            @csrf

                <div class="mt-3 col-0 d-flex align-items-center justify-content-center">
                    <button class="btn btn-outline-primary btn-sm" name="id" value="{{$comment->id}}">OK</button>
                </div>

            </form>
            
        @endif

        @if ($comment->file)

            <div class="mt-3 col-2 d-flex align-items-center justify-content-center">
                <a class="btn btn-outline-primary btn-sm" href="{{ asset($comment->file) }}" download>Baixar comentário</a>
            </div>

        @else

            <div class="mt-3 col-2 d-flex align-items-center justify-content-center">
                <a class="btn btn-outline-primary btn-sm" href="{{ route('comment.show', $comment) }}">Ler mais</a>
            </div>

        @endif
        
    </div>
</div>