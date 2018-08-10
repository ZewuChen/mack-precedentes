@extends ('app')

@section ('content')
    
    <h2 class="mp-heading">Criar um novo Precedente</h2>
    <p class="mp-text-meta">Meh mustache mlkshk 3 wolf moon franzen, humblebrag small batch bicycle rights. Single-origin coffee intelligentsia green juice pork belly, letterpress stumptown banh mi austin schlitz. Literally sriracha 3 wolf moon wolf chillwave fam helvetica. Pop-up enamel pin aesthetic lomo viral coloring book umami.</p>

    <div class="py-4">

        {{ Form::open(['route' => 'precedents.store']) }}

            <div class="form-group">
                <div class="row d-flex align-items-center">
                    <label class="mp-heading col-2">Número*</label>
                    <input type="text" class="form-control col-5" name="number" value="{{ old('number') }}" required>
                </div>
            </div>

            <div class="form-group">
                <div class="row d-flex align-items-center">
                    <label class="mp-heading col-2">Tribunal*</label>
                   
                    <select name="court_id" class="form-control col-5">
                            @foreach($courts as $court)
                                <option value="{{ $court->id }}">{{ $court->name }}</option>
                            @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="row d-flex align-items-center">
                    <label class="mp-heading col-2">Ramo do direito</label>
                    <select name="branch_id" class="form-control col-5">
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="row d-flex align-items-center">
                    <label class="mp-heading col-2">Origem processual*</label>
                    <select name="type_id" class="form-control col-5">    
                            @foreach($precedentsTypes as $precedentsType)
                                <option value="{{ $precedentsType->id }}">{!! $precedentsType->name !!}</option>
                            @endforeach
                    </select>
                </div>        
            </div>		

            {{-- <div class="form-group">
                <div class="row d-flex align-items-center">
                    <label class="mp-heading col-2">Tags</label>
                    <textarea name="" class="form-control col-5"></textarea>
                </div>      
            </div>  --}}

            <div class="form-group">
                <div class="row d-flex align-items-center">
                    <label class="mp-heading col-2">Afetação</label>
                    <input type="date" class="form-control col-5" name="segregated_at">
                </div>       
            </div> 

            <div class="form-group">
                <div class="row d-flex align-items-center">     
                    <label class="mp-heading col-2">Aprovação/julgamento</label>
                    <input type="date" class="form-control col-5" name="approved_at">
                </div>            
            </div>

            <div class="form-group">
                <div class="row d-flex align-items-center">
                    <label class="mp-heading col-2">Suspensão</label>
                    <input type="date" class="form-control col-5" name="suspended_at">
                </div>
            </div>

            <div class="form-group">
                <div class="row d-flex align-items-center">
                    <label class="mp-heading col-2">Revisão</label>
                    <input type="date" class="form-control col-5" name="reviewed_at">
                </div>    
            </div>

            <div class="form-group">
                <div class="row d-flex align-items-center">
                    <label class="mp-heading col-2">Cancelamento</label>
                    <input type="date" class="form-control col-5" name="canceled_at">
                </div>
            </div>   

            <div class="form-group">
                <div class="row d-flex align-items-center">
                    <label class="mp-heading col-2">Recurso Pendente?</label>
                    <input type="date" class="form-control col-5" name="pending_resources">
                </div>           
            </div> 

            <div class="form-group">
                <div class="row d-flex align-items-center">
                    <label class="mp-heading col-2">Observação</label>
                    <input type="text" class="form-control col-5" name="additional_info">
                </div>
            </div> 

            <div class="form-group">
                <div class="row d-flex align-items-center">
                    <label class="mp-heading col-sm-2">Tese*</label>
                    <textarea name="body" class="form-control col-8" required>{{ old('body') }}</textarea>
                </div>
            </div> 

            <input type="submit" class="mp-button--primary" value="Publicar precedente">

        {{ Form::close() }}
    
    </div>

@endsection