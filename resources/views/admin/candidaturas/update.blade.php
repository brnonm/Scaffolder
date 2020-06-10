@extends("scaffolder.views.partials.main")
@section("container")



<div>
    @csrf

    <div class="card">
        <div class="card-header">
            Update Candidatura
        </div>


        <div class="card-body">
            <form action=:$routeUpdate method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                           <div class="form-group"><label for="exampleInputEmail1">Id</label><input disabled class="form-control" type="text" name="id" value="{{$item->id}}"></div>           <div class="form-group"><label for="exampleInputEmail1">Curso</label><input disabled class="form-control" type="text" name="curso" value="{{$item->curso}}"></div>           <div class="form-group"><label for="exampleInputEmail1">Nome</label><input  class="form-control" type="text" name="nome" value="{{$item->nome}}"></div>           <div class="form-group"><label for="exampleInputEmail1">Email</label><input  class="form-control" type="text" name="email" value="{{$item->email}}"></div>           <div class="form-group"><label for="exampleInputEmail1">Telefone1</label><input  class="form-control" type="text" name="telefone1" value="{{$item->telefone1}}"></div>           <div class="form-group"><label for="exampleInputEmail1">Telefone2</label><input  class="form-control" type="text" name="telefone2" value="{{$item->telefone2}}"></div>           <div class="form-group"><label for="exampleInputEmail1">Genero</label>

                                <select name="genero" class="form-control">
                            <option value="M" {{( $item->origem == 'M')? 'selected': '' }}>M1</option>                            <option value="F" {{( $item->origem == 'F')? 'selected': '' }}>F1</option>                                 </select>
</div>           <div class="form-group"><label for="exampleInputEmail1">Media</label></div>           <div class="form-group"><label for="exampleInputEmail1">M23</label><input  class="form-control" type="text" name="m23" value="{{$item->m23}}"></div>           <div class="form-group"><label for="exampleInputEmail1">Origem</label>

                                <select name="origem" class="form-control">
                            <option value="P" {{( $item->origem == 'P')? 'selected': '' }}>P1</option>                            <option value="UE" {{( $item->origem == 'UE')? 'selected': '' }}>UE1</option>                            <option value="O" {{( $item->origem == 'O')? 'selected': '' }}>O1</option>                                 </select>
</div>           <div class="form-group"><label for="exampleInputEmail1">Ob</label><input  class="form-control" type="text" name="obs" value="{{$item->obs}}"></div>
                <div>
                    <input class="btn btn-danger" type="submit" value="Update">
                </div>
            </form>


        </div>
    </div>




</div>


@endsection
