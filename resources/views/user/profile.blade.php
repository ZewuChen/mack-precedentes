@extends ('app')

@section ('content')

    <h2 class="mp-heading">Meu perfil</h2>
    <p class="mp-text-meta">Meh mustache mlkshk 3 wolf moon franzen, humblebrag small batch bicycle rights. Single-origin coffee intelligentsia green juice pork belly, letterpress stumptown banh mi austin schlitz. Literally sriracha 3 wolf moon wolf chillwave fam helvetica. Pop-up enamel pin aesthetic lomo viral coloring book umami.</p>

    <div class="my-4">
        {{ Form::open(['route' => 'users.update', 'method' => 'patch', 'files' => true]) }}
            <div class="form-group">
                <div class="row d-flex align-items-center">
                    <label class="mp-heading col-2">Foto</label>
                    <input type="file" class="form-control col-5" name="photo">
                </div>
            </div>

            <div class="form-group">
                <div class="row d-flex align-items-center">
                    <label class="mp-heading col-2">Nome</label>
                    <input type="text" class="form-control col-5" name="name" value="{{ $user->name }}" required>
                </div>
            </div>

            <div class="form-group">
                <div class="row d-flex align-items-center">
                    <label class="mp-heading col-2">E-mail</label>
                    <input type="email" class="form-control col-5" name="email" value="{{ $user->email }}" required>
                </div>
            </div>

            <div class="form-group">
                <div class="row d-flex align-items-center">
                    <label class="mp-heading col-2">Descrição</label>
                    <textarea name="description" class="form-control col-5">{{ $user->description }}</textarea>
                </div>
            </div>

            <input type="submit" class="mp-button--primary" value="Salvar alterações">
        {{ Form::close() }}

    </div>

    <hr>

    <div class="my-4">
        <h2 class="mp-heading">Alterar minha senha</h2>
        <p class="mp-text-meta">Meh mustache mlkshk 3 wolf moon franzen, humblebrag small batch bicycle rights. Single-origin coffee intelligentsia green juice pork belly, letterpress stumptown banh mi austin schlitz</p>

        {{ Form::open(['route' => 'users.password.update', 'method' => 'patch']) }}

            @if ($user->password)
                <div class="form-group">
                    <div class="row d-flex align-items-center">
                        <label class="mp-heading col-2">Senha Atual</label>
                        <input type="password" class="form-control col-5" name="old_password" required>
                    </div>
                </div>
            @endif

            <div class="form-group">
                <div class="row d-flex align-items-center">
                    <label class="mp-heading col-2">Nova Senha</label>
                    <input type="password" class="form-control col-5" name="password" minlength="6" required>
                </div>
            </div>

            <input type="submit" class="mp-button--primary" value="Trocar Senha">

        {{ Form::close() }}

    </div>

@endsection