<nav class="mp-nav p-4">

    <div>
        <a href="#">
            <img class="mp-img-auto-150" src="{{ url('img/logo.png') }}">
        </a>
    </div>

    <div class="my-5">
        <a class="btn btn-sm mp-btn-primary d-flex align-items-center justify-content-center" href="{{ route('precedent.create') }}">
            {{-- <svg class="mp-icon mr-2 --icon-white" style="fill: white;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z" /></svg> --}}
            <svg class="mp-icon mr-2 --icon-white" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M5,3C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V12H19V19H5V5H12V3H5M17.78,4C17.61,4 17.43,4.07 17.3,4.2L16.08,5.41L18.58,7.91L19.8,6.7C20.06,6.44 20.06,6 19.8,5.75L18.25,4.2C18.12,4.07 17.95,4 17.78,4M15.37,6.12L8,13.5V16H10.5L17.87,8.62L15.37,6.12Z" /></svg>
            Criar um precedente
        </a>
    </div>

    <ul class="list-unstyled my-5">

        <li class="mp-nav__item mp-nav__item--selected">
            <a class="d-flex align-items-center py-2" href="{{ route('home') }}">
                <svg class="mp-icon mr-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M10,20V14H14V20H19V12H22L12,3L2,12H5V20H10Z" /></svg>
                Home
            </a>
        </li>
        <li class="mp-nav__item">
            <a class="d-flex align-items-center py-2" href="#">
                <svg class="mp-icon mr-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M7,5H21V7H7V5M7,13V11H21V13H7M4,4.5A1.5,1.5 0 0,1 5.5,6A1.5,1.5 0 0,1 4,7.5A1.5,1.5 0 0,1 2.5,6A1.5,1.5 0 0,1 4,4.5M4,10.5A1.5,1.5 0 0,1 5.5,12A1.5,1.5 0 0,1 4,13.5A1.5,1.5 0 0,1 2.5,12A1.5,1.5 0 0,1 4,10.5M7,19V17H21V19H7M4,16.5A1.5,1.5 0 0,1 5.5,18A1.5,1.5 0 0,1 4,19.5A1.5,1.5 0 0,1 2.5,18A1.5,1.5 0 0,1 4,16.5Z" /></svg>
                Meus Precedentes
            </a>
        </li>
        <li class="mp-nav__item">
            <a class="d-flex align-items-center py-2" href="#">
                <svg class="mp-icon mr-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M17,3H7A2,2 0 0,0 5,5V21L12,18L19,21V5C19,3.89 18.1,3 17,3Z" /></svg>
                Salvos
            </a>
        </li>

        @auth

            @foreach (auth()->user()->collections as $collection)
                
                <li class="mp-nav__item">
                    <a class="d-flex align-items-center py-2" href="{{ route('collection.show', $collection) }}">
                        <span class="mp-collection-icon mr-2">AC</span>
                        {{ $collection->name }}
                    </a>
                </li>

            @endforeach

        @endauth


    </ul>
</nav>