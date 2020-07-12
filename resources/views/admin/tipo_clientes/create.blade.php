@extends("scaffolder.views.partials.main")
@section("container")

<div>
    @csrf

    <div class="card">
        <div class="card-header">
            Create TipoCliente
        </div>

        <div class="card-body">
            <form action="{{ route('tipo_clientes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                           <div class="form-group">           <div class="form-group"><label for="exampleInputEmail1">Title</label><input  type="text" name="title" class='form-control'></div>           <div class="form-group">           <div class="form-group">           <div class="form-group">
                <div>
                    <input class="btn btn-danger" type="submit" value="Create">
                </div>
            </form>


        </div>
    </div>


</div>

@endsection
