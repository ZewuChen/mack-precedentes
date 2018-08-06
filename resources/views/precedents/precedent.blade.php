<article class="py-4 mp-precedent">
    <a class="my-2 d-block" href="{{ route('precedent.show', $precedent) }}">
        <small>
            {{ $precedent->type->name }}; {{ $precedent->number }}
        </small>
    </a>

    <div class="d-flex justify-content-between align-items-start flex-column flex-md-row">
        <div class="mr-5">

            <p class="mb-0 pb-0 mp-precedent__body">
                {{ $precedent->body }}
            </p>

            <p class="mp-text-secondary">
                <small>
                    Emitido em 
                    <a href="{{ route('courts.show', $precedent->court) }}">{{ $precedent->court->alias }}</a> 
                    {{ $precedent->created_at->diffForHumans() }}
                </small>
            </p>

        </div>

        <div class="d-flex align-items-center align-items-center justify-content-between mb-3">

        @if  (! $precedent->has($precedent))
            <form action="{{ route('precedent.save') }}" method="POST" enctype="multipart/form-data">
                @csrf

                    <input type="hidden" name="precedent_id" value="{{$precedent->id}}">

                    <button class="btn btn-primary btn-sm" type="submit" name="salvar">
                    <svg class="mp-icon --icon-tertiary" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M17,18L12,15.82L7,18V5H17M17,3H7A2,2 0 0,0 5,5V21L12,18L19,21V5C19,3.89 18.1,3 17,3Z" /></svg>
                    </button>

            </form>
        @else
            <form action="{{ route('save.destroy') }}" method="POST" enctype="multipart/form-data">
                @csrf

                    <input type="hidden" name="precedent_id" value="{{$precedent->id}}">

                    <button class="btn btn-danger btn-sm" type="submit" name="salvar">
                    <svg class="mp-icon --icon-tertiary" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M17,18L12,15.82L7,18V5H17M17,3H7A2,2 0 0,0 5,5V21L12,18L19,21V5C19,3.89 18.1,3 17,3Z" /></svg>
                    </button>

            </form>

        @endif

            <button class="mp-btn--icon d-flex align-items-center justify-content-center mr-2" type="button">
                <svg class="mp-icon --icon-tertiary" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M2,16H10V14H2M18,14V10H16V14H12V16H16V20H18V16H22V14M14,6H2V8H14M14,10H2V12H14V10Z" /></svg>
            </button>
            <button class="mp-btn--icon d-flex align-items-center justify-content-center" type="button">
                <svg class="mp-icon --icon-tertiary" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M12,16A2,2 0 0,1 14,18A2,2 0 0,1 12,20A2,2 0 0,1 10,18A2,2 0 0,1 12,16M12,10A2,2 0 0,1 14,12A2,2 0 0,1 12,14A2,2 0 0,1 10,12A2,2 0 0,1 12,10M12,4A2,2 0 0,1 14,6A2,2 0 0,1 12,8A2,2 0 0,1 10,6A2,2 0 0,1 12,4Z" /></svg>
            </button>
        </div>
    </div>

    <ul class="list-unstyled d-flex align-items-center py-1 flex-wrap">

        @foreach ($precedent->tags as $tag)

            <li class="mr-2 my-1">
                @include ('tags.tag')
            </li>

        @endforeach

    </ul>

    <form action="{{ route('collection.create', $precedent) }}" method="POST" enctype="multipart/form-data">
        @csrf

            <input type="hidden" name="precedent_id" value="{{$precedent->id}}">

                @foreach ($collections as $collection)
                    @if  (! $collection->has($precedent, $collection))
                        <button class="btn btn-outline-primary btn-sm" name="collection_id" value="{{$collection->id}}">{!! $collection->name !!}</button>
                    @endif
                @endforeach

            <br>
            <input type="text" name="collection_name" class="form form-control form-sm">
            <button class="btn btn-secondary btn-add btn-sm">Nova Coleção</button>

    </form>

    @if (isset($incollection) && $incollection)
        <form action="{{ route('collection.destroy', $precedent) }}" method="POST" enctype="multipart/form-data">
        @csrf

            <input type="hidden" name="precedent_id" value="{{$precedent->id}}">
            <input type="hidden" name="collection_id" value="{{$codcollection}}">

            <button class="btn btn-danger btn-add btn-sm">Remover desta coleção</button>

        </form>
    @endif

    <div class="d-flex align-items-end justify-content-between flex-wrap">
        <div class="d-flex align-items-center flex-wrap mr-5">

        @if  (! $precedent->hasLike($precedent))
            <form action="{{ route('precedent.like') }}" method="POST" enctype="multipart/form-data">
            @csrf

                <input type="hidden" name="precedent_id" value="{{$precedent->id}}">
                
                <a class="d-flex align-items-center mr-4 btn btn-primary btn-sm" href="">
                    <button class="mp-icon mr-2 --icon-tertiary" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M23,10C23,8.89 22.1,8 21,8H14.68L15.64,3.43C15.66,3.33 15.67,3.22 15.67,3.11C15.67,2.7 15.5,2.32 15.23,2.05L14.17,1L7.59,7.58C7.22,7.95 7,8.45 7,9V19A2,2 0 0,0 9,21H18C18.83,21 19.54,20.5 19.84,19.78L22.86,12.73C22.95,12.5 23,12.26 23,12V10M1,21H5V9H1V21Z" /></button>
                    <small class="font-weight-bold mp-text-tertiary">Curtir</small>
                </a>

            </form>
        @else
            <form action="{{ route('precedent.deslike') }}" method="POST" enctype="multipart/form-data">
            @csrf

                <input type="hidden" name="precedent_id" value="{{$precedent->id}}">
                
                <a class="d-flex align-items-center mr-4 btn btn-danger btn-sm" href="">
                    <button class="mp-icon mr-2 --icon-tertiary" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M23,10C23,8.89 22.1,8 21,8H14.68L15.64,3.43C15.66,3.33 15.67,3.22 15.67,3.11C15.67,2.7 15.5,2.32 15.23,2.05L14.17,1L7.59,7.58C7.22,7.95 7,8.45 7,9V19A2,2 0 0,0 9,21H18C18.83,21 19.54,20.5 19.84,19.78L22.86,12.73C22.95,12.5 23,12.26 23,12V10M1,21H5V9H1V21Z" /></button>
                    <small class="font-weight-bold mp-text-tertiary">Curtir</small>
                </a>

            </form>
        @endif

            

            <div class="d-flex align-items-center">                
                <svg class="mp-icon mr-2 --icon-tertiary" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M5,3C3.89,3 3,3.89 3,5V19C3,20.11 3.89,21 5,21H19C20.11,21 21,20.11 21,19V5C21,3.89 20.11,3 19,3H5M5,5H19V19H5V5M7,7V9H17V7H7M7,11V13H17V11H7M7,15V17H14V15H7Z" /></svg>
                <small class="font-weight-bold mp-text-tertiary">Comentários ({{ count($precedent->comments) }})</small>
            </div>
        </div>

        <a class="btn btn-sm mp-btn-primary" href="{{ route('precedent.show', $precedent) }}">Ler mais</a>
    </div>
</article>