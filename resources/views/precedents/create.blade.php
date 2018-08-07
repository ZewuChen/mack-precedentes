@extends ('app')

@section ('content')

    <div class="py-4">
        <h2 class="mp-heading">Novo Precedente</h2>
        
        <form class="form" method="post" action="{{ route('precedents.store') }}" >
            @csrf

        @if( isset($errors) && count($errors) > 0) 
            <div class="alert alert-danger">
            
                @foreach($errors->all() as $error)  
                    <p>{{$error}}</p>
                @endforeach 

             </div>
        @endif

            <div class="form-group">
                <label class="mp-heading col-sm-2">Número</label>      
                          
                <label>
                    <input type="text" class="form-control" name="number" value="{{ old('number') }}" required>   
                </label>                
            </div>

            <div class="form-group">
                <label class="mp-heading col-sm-2">Tribunal</label> 

                <label>                    
                    <select name="court_id" class="form-control">    
                            @foreach($courts as $court)
                                <option value="{{ $court->id }}">{!! $court->name !!}</option>
                            @endforeach
                    </select> 
                </label>
            </div>

            <div class="form-group">                
                <label class="mp-heading col-sm-2">Ramo do direito</label> 

                <label>                    
                    

                </label>                
            </div>

            <div class="form-group">                
                <label class="mp-heading col-sm-2">Origem processual</label>

                <label>
                    <select name="type_id" class="form-control">    
                            @foreach($precedentsTypes as $precedentsType)
                                <option value="{{ $precedentsType->id }}">{!! $precedentsType->name !!}</option>
                            @endforeach
                    </select>
                </label>                
            </div>		

            <div class="form-group">                
                <label class="mp-heading col-sm-2">Tags</label>

                <label>
                    <textarea name="" class="form-control">
                        
                    </textarea>
                </label>                
            </div> 

            <div class="form-group">                
                <label class="mp-heading col-sm-2">Afetação</label>

                <label>
                    <input type="date" class="form-control" name="segregated_at">   
                </label>                
            </div> 

            <div class="form-group">                
                <label class="mp-heading col-sm-2">Aprovação/julgamento</label>

                <label>
                    <input type="date" class="form-control" name="approved_at">   
                </label>                
            </div>

            <div class="form-group">                
                <label class="mp-heading col-sm-2">Suspensão</label>

                <label>
                    <input type="date" class="form-control" name="suspended_at">
                </label>                
            </div>

            <div class="form-group">                
                <label class="mp-heading col-sm-2">Revisão</label>

                <label>
                    <input type="date" class="form-control" name="reviewed_at">
                </label>                
            </div>

            <div class="form-group">                
                <label class="mp-heading col-sm-2">Cancelamento</label>

                <label>
                    <input type="date" class="form-control" name="canceled_at">
                </label>                
            </div>   

            <div class="form-group">                
                <label class="mp-heading col-sm-2">Recurso Pendente?</label>

                <label>
                    <input type="date" class="form-control" name="pending_resources">
                </label>                
            </div> 

            <div class="form-group">                
                <label class="mp-heading col-sm-2">Observação</label>

                <label>
                    <input type="text" class="form-control" name="additional_info">
                </label>                
            </div> 

            <div class="form-group">                
                <label class="mp-heading col-sm-2">Tese</label>

                <label>
                    <textarea name="body" class="form-control" required>
                        {{ old('body') }}
                    </textarea>
                </label>                
            </div> 

            <button class="mp-button--primary">Cadastrar</button>
        </form>
    
    </div>

@endsection