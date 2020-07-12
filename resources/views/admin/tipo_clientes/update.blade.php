@extends("scaffolder.views.partials.main")
@section("container")



<div>
    @csrf

    <div class="card">
        <div class="card-header">
            Update TipoCliente
        </div>


        <div class="card-body">
            <form action="{{ route('tipo_clientes.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                           <div class="form-group"><label for="exampleInputEmail1">Id</label><input disabled class="form-control" type="text" name="id" value="{{$item->id}}"></div>           <div class="form-group"><label for="exampleInputEmail1">Title</label><input  class="form-control" type="text" name="title" value="{{$item->title}}"></div></div></div></div>
                <div>
                    <input class="btn btn-danger" type="submit" value="Update">
                </div>
            </form>


        </div>
    </div>




</div>


@endsection
