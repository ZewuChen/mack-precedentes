@extends ('app')

@section ('content')

    <div class="py-5">
        <h2 class="mp-heading">Precedentes</h2>

        <p class="text-secondary">
            <small>({{ count($precedents) }} resultados)</small>
        </p>

        {{-- <div class="mr-5 border border-primary">
            <form class="form" method="POST" action="{{ route('precedent.search') }}" >
                @csrf

                <div class="form-inline">                               
                    <label>
                        <input type="text" class="form-control" name="data">   
                    </label>

                    <button class="btn btn-info btn-add">Procurar</button>
                </div>
                
                <div class="form-list col-sm-4 border border-primary">
                    @foreach($courts as $court)                    
                        <label class="form-inline"><input type="checkbox" name="courts[]" class="btn btn-link" value="{{$court->id}}">{!! $court->name !!}</label>                    
                    @endforeach 
                </div>    

                <div class="form-list col-sm-3 border border-secondary">
                    @foreach($precedentsTypes as $precedentType)
                        <label class="form-inline"><input type="checkbox" name="types[]" class="btn btn-link" value="{{$precedentType->id}}">{!! $precedentType->name !!}</label>
                    @endforeach
                </div>

                <div class="form-list col-sm-2 border border-info">
                    <label class="form-inline"><input type="radio" name="date" groupName="date" value="today">Hoje</label>
                    <label class="form-inline"><input type="radio" name="date" groupName="date" value="week">Esta Semana</label>
                    <label class="form-inline"><input type="radio" name="date" groupName="date" value="month">Este Mês</label>
                    <label class="form-inline"><input type="radio" name="date" groupName="date" value="year">Este Ano</label>
                    <label class="form-inline"><input type="radio" name="date" groupName="date" value="last">Mais Antigos</label>
                </div>                

            </form>
        </div> --}}

        @foreach ($precedents as $precedent)
            @include ('precedents.precedent')
        @endforeach
    
    </div>

@endsection