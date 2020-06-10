@extends("scaffolder.views.partials.main")
@section("container")

<div>
    @csrf

    <div class="card">
        <div class="card-header">
            Create Candidatura
        </div>

        <div class="card-body">
            <form action="{{ route('candidaturas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                           <div class="form-group">           <div class="form-group">           <div class="form-group"><label for="exampleInputEmail1">Nome</label><input  type="text" name="nome" class='form-control'></div>           <div class="form-group"><label for="exampleInputEmail1">Email</label><input  type="text" name="email" class='form-control'></div>           <div class="form-group"><label for="exampleInputEmail1">Telefone1</label><input  type="text" name="telefone1" class='form-control'></div>           <div class="form-group"><label for="exampleInputEmail1">Telefone2</label><input  type="text" name="telefone2" class='form-control'></div>           <div class="form-group"><label for="exampleInputEmail1">Genero</label>

                                <select name="genero" class="form-control">
                            <option value="M" {{( $item->origem == 'M')? 'selected': '' }}>M1</option>                            <option value="F" {{( $item->origem == 'F')? 'selected': '' }}>F1</option>                                 </select>
</div>           <div class="form-group"><label for="exampleInputEmail1">Media</label><input  type="number" name="media" class='form-control'></div>           <div class="form-group"><label for="exampleInputEmail1">M23</label><input  type="text" name="m23" class='form-control'></div>           <div class="form-group"><label for="exampleInputEmail1">Origem</label>

                                <select name="origem" class="form-control">
                            <option value="P" {{( $item->origem == 'P')? 'selected': '' }}>P1</option>                            <option value="UE" {{( $item->origem == 'UE')? 'selected': '' }}>UE1</option>                            <option value="O" {{( $item->origem == 'O')? 'selected': '' }}>O1</option>                                 </select>
</div>           <div class="form-group"><label for="exampleInputEmail1">Ob</label><input  type="text" name="obs" class='form-control'></div>
                <div>
                    <input class="btn btn-danger" type="submit" value="Create">
                </div>
            </form>


        </div>
    </div>


</div>

@endsection
