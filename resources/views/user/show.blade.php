@extends ('app')

@section ('content')

    <h2>Olá {{ $user->name }}!</h2>

    <div class="list-group">

    @if( isset($errors) && count($errors) > 0) 
        <div class="alert alert-danger">
            
                @foreach($errors->all() as $error)  
                    <p>{{$error}}</p>
                @endforeach 

        </div>
    @endif

        <div class="mr-5">
            <form class="form" method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data">
            @csrf
            @method ('PUT')

                <div class="form-group">

                    <label class="mp-heading col-sm-2">Nome:</label>      
                              
                    <label>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>   
                    </label>
                
                </div>

                <div class="form-group">

                    <label class="mp-heading col-sm-2">E-mail:</label>      
                              
                    <label>
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>   
                    </label>
                
                </div>

                <div class="form-group">
                    <label class="mp-heading col-sm-2">Descrição:</label>      
                              
                    <label>
                        <textarea name="description" class="form-control">
                            {{ $user->description }}
                        </textarea>
                    </label>
                
                </div>

                <div class="form-group">

                    <label class="mp-heading col-sm-2">Foto:</label>      
                              
                    <label>
                        <input type="file" class="form-control" name="photo">   
                    </label>
                
                </div>

                <button class="btn btn-info btn-add">Atualizar Dados</button>

            </form>
        </div>

    @if( $user->password != null) 
        <div class="mr-5">
            <form class="form" method="POST" action="{{ route('user.password') }}" >
                @csrf

                <div class="form-group">

                    <label class="mp-heading col-sm-2">Senha Atual:</label>      
                              
                    <label>
                        <input type="password" class="form-control" name="old_password" required>   
                    </label>
                
                </div>
    @else
        <div class="mr-5 border border-primary">
            <form class="form" method="POST" action="{{ route('user.password') }}" >
                @csrf

    @endif

                <div class="form-group">

                    <label class="mp-heading col-sm-2">Nova Senha:</label>      
                              
                    <label>
                        <input type="password" class="form-control" name="new_password" minlength="6" required>   
                    </label>
                
                </div>

                <button class="btn btn-info btn-add">Atualizar Senha</button>

            </form>
        </div>

    </div>

@endsection