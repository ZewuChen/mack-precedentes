<nav class="mp-nav">
    <div class="px-4">
        <a href="{{ route('home') }}">
            <img class="mp-image--max-w-150" src="{{ url('img/logo.png') }}">
        </a>
    </div>

    @can ('create', App\Precedent::class)
        <div class="my-5 px-4">
            <a class="mp-button--primary" href="{{ route('precedents.create') }}">Criar um precedente</a>
        </div>
    @endcan

    <ul class="list-unstyled mt-5">
        <li class="mp-nav__item mp-nav__item--selected">
            <a class="d-flex align-items-center py-2" href="{{ route('home') }}">
                <svg class="mp-icon mr-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M10,20V14H14V20H19V12H22L12,3L2,12H5V20H10Z" /></svg>
                Home
            </a>
        </li>

        @auth
            @role ('admin')
                <li class="mp-nav__item">
                    <a class="d-flex align-items-center py-2" href="{{ route('precedents.mine') }}">
                        <svg class="mp-icon mr-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M7,5H21V7H7V5M7,13V11H21V13H7M4,4.5A1.5,1.5 0 0,1 5.5,6A1.5,1.5 0 0,1 4,7.5A1.5,1.5 0 0,1 2.5,6A1.5,1.5 0 0,1 4,4.5M4,10.5A1.5,1.5 0 0,1 5.5,12A1.5,1.5 0 0,1 4,13.5A1.5,1.5 0 0,1 2.5,12A1.5,1.5 0 0,1 4,10.5M7,19V17H21V19H7M4,16.5A1.5,1.5 0 0,1 5.5,18A1.5,1.5 0 0,1 4,19.5A1.5,1.5 0 0,1 2.5,18A1.5,1.5 0 0,1 4,16.5Z" /></svg>
                        Meus Precedentes
                    </a>
                </li>
            @endrole
            <li class="mp-nav__item">
                <a class="d-flex align-items-center py-2" href="{{ route('precedents.saved') }}">
                    <svg class="mp-icon mr-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M17,3H7A2,2 0 0,0 5,5V21L12,18L19,21V5C19,3.89 18.1,3 17,3Z" /></svg>
                    Meus salvos
                </a>
            </li>

            <hr>

            @foreach (auth()->user()->collections->sortBy('name') as $collection)
                
                <li class="mp-nav__item">
                    <a class="d-flex align-items-center py-2" href="{{ route('collections.show', $collection) }}">
                        <span class="mp-collection-initials mr-2">{{ (new Initials)->name($collection->name)->length(2)->generate() }}</span>
                        {{ $collection->name }}
                    </a>
                </li>

            @endforeach

        @endauth
       
    </ul>

    @auth
        <div class="px-4 mb-3 position-relative">
            {{ Form::open(['route' => 'collections.store']) }}
                <div class="position-relative">
                    <input class="mp-input--rounded mp-bg-lightgray" type="text" name="name" placeholder="Nova coleção">
                    <button class="mp-form-icon" type="submit">
                        <svg class="mp-icon--white" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z" /></svg>
                    </button>
                </div>
            {{ Form::close() }}                
        </div>
    @endauth

    @guest
        <div class="my-5 px-4">
            <a class="mp-button--primary" href="{{ route('register') }}">Inscreva-se</a>
            <a class="mp-button--outline mt-3" href="{{ route('login') }}">Login</a>
        </div>
    @endguest

    <div class="d-flex align-items-center justify-content-center" style="position: absolute; bottom: 24px; left: 0; right: 0;">
        <a href="https://www.mackenzie.br/">
            <img class="mp-image--max-w-100px" src="{{ url('img/mack-pesquisa.png') }}">
        </a>
    </div>
</nav>