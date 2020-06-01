@extends("scaffolder.views.partials.main")
@section("container")

<div>
    @csrf
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Create Categoria</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
                    <form action="{{ route('categorias.store') }}" method="POST" enctype="multipart/form-data">
                        <table class="table">
                            @csrf
                            
                    <tr>
                                <th> Nome</th><td><input  type="text" name="nome"></td>
                    <tr>
                                <th> Tipo</th>
                        </table>
                        <input type="submit" value="Create" class="btn btn-info col-md-12">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
