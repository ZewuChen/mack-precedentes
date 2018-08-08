
    <div class="py-5">
        
        <form class="form" method="post" action="{{ route('excel.import') }}" enctype="multipart/form-data">
        @csrf

        	<input type="file" name="file">
            <button class="btn btn-primary btn-add">Cadastrar</button>
        </form>
    
    </div>
