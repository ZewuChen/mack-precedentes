@extends ('app')

@section ('content')

    <h1>{{ $precedent->type->name }}; {{ $precedent->number }}</h1>
    <div class="mt-4 alert alert-secondary">{{ $precedent->body }}</div>

    <p class="text-secondary">
        <small>Emitido em <a href="{{ route('court.show', $precedent->court) }}">{{ $precedent->court->alias }}</a> {{ (new Carbon($precedent->created_at))->diffForHumans() }}</small>
    </p>

    <div>
        @foreach ($precedent->tags as $tag)
            @include ('tags.tag')
        @endforeach
    </div>

    <section class="my-5">
        <h6>Adicionar um comentário</h6>

        <form action="{{ route('comment.create', $precedent) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <textarea class="form-control" name="body">{{old('body')}}</textarea>
            </div>
            
            <div class="form-group">
                <input class="form-control" type="file" name="file"></input>
            </div>

            <div class="text-right">
                <button class="btn btn-primary">Adicionar comentário</button>
            </div>
        </form>
    </section>

    @if( isset($errors) && count($errors) > 0) 
        <div class="alert alert-danger">
            
                @foreach($errors->all() as $error)  
                    <p>{{$error}}</p>
                @endforeach 

        </div>
    @endif

    @if (count($precedent->comments))

        <section class="mt-5">
            <h6>Comentários ({{ count($precedent->comments) }})</h6>

            <div class="list-group">

                @foreach ($precedent->comments as $comment)

                    @include ('comments.comment')

                @endforeach

            </div>

        </section>

    @endif

@endsection