@extends("scaffolder.views.partials.main")
@section("container")

<div>
    @csrf
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Update Categoria</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
                    <form action="{{ route('categorias.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        <table class="table">
                            @csrf
                            @method('PUT')

                            
                    <tr>
                                <th> Id</th><td><input disabled type="text" name="id" value="{{$item->id}}"></td>
                    <tr>
                                <th> Nome</th><td><input  type="text" name="nome" value="{{$item->nome}}"></td>
                    <tr>
                                <th> Tipo</th>

                        </table>
                        <input type="submit" value="Update" class="btn btn-info col-md-12">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
