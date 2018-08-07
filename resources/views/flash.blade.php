@if (Session::has('error'))
    <div class="mp-flash">{{ Session::get('error') }}</div>
@elseif (Session::has('success'))
    <div class="mp-flash">{{ Session::get('success') }}</div>
@endif