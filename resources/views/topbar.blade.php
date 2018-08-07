<div class="d-flex align-items justify-content-between mb-5">
    <div>
        {{ Form::open(['route' => 'precedents.search', 'method' => 'get'])}}
            <div class="form-inline">
                <button class="mp-button-icon" type="submit">
                    <svg class="mp-icon--dark" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" /></svg>
                </button>
                <input type="text" class="form-control" name="data" required>
                <button class="mp-button-icon" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <svg class="mp-icon--dark" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M6,13H18V11H6M3,6V8H21V6M10,18H14V16H10V18Z" /></svg>
                </button>
            </div>            
            <div class="collapse" id="collapseExample">
                <div class="row py-5">
                    <div class="d-flex justify-content-between">
                        <fieldset class="col-4">
                            <legend>Tribunais</legend>
                            @foreach($courts->take(8) as $court)                    
                                <label class="form-inline"><input type="checkbox" name="courts[]" class="btn btn-link" value="{{$court->id}}">{!! $court->name !!}</label>                    
                            @endforeach 
                        </fieldset>

                        <fieldset class="col-4">
                            <legend>Origem processual</legend>
                            @foreach ($precedentsTypes->take(8) as $precedentType)
                                <label class="form-inline">
                                    <input type="checkbox" name="types[]" class="btn btn-link" value="{{$precedentType->id}}">
                                    {!! $precedentType->name !!}
                                </label>
                            @endforeach
                        </fieldset>

                        <fieldset class="col-4">
                            <legend>Por período</legend>
                            <label class="form-inline"><input type="radio" name="date" groupName="date" value="today">Hoje</label>
                            <label class="form-inline"><input type="radio" name="date" groupName="date" value="week">Esta Semana</label>
                            <label class="form-inline"><input type="radio" name="date" groupName="date" value="month">Este Mês</label>
                            <label class="form-inline"><input type="radio" name="date" groupName="date" value="year">Este Ano</label>
                            <label class="form-inline"><input type="radio" name="date" groupName="date" value="last">Mais Antigos</label>
                        </fieldset>
                    </div>
                </div>
            </div>
        {{ Form::close() }}
    </div>

    @auth
        <div class="dropdown">
            <button class="mp-button-icon" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="mp-image--36x36 mp-rounded" src="https://randomuser.me/api/portraits/men/43.jpg">
            </button>
            <div class="dropdown-menu mp-dropdown__menu">
                <a class="mp-dropdown__item" href="{{ route('profile') }}">Perfil</a>
                {{ Form::open(['route' => 'logout'])}}
                    <input type="submit" class="mp-dropdown__item" value="Logout">
                {{ Form::close() }}
            </div>
        </div>
    @endauth

</div>