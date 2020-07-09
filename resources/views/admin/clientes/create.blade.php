@extends("scaffolder.views.partials.main")
@section("container")

<div>
    @csrf

    <div class="card">
        <div class="card-header">
            Create Cliente
        </div>

        <div class="card-body">
            <form action="{{ route('clientes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                           <div class="form-group">           <div class="form-group"><label for="exampleInputEmail1">Nome</label><input  type="text" name="nome" class='form-control'></div>           <div class="form-group"><label for="exampleInputEmail1">Tipocliente</label>
                    <td>
                                <select name="tipocliente" class="form-control">
                                 @foreach($tipoclienteAll as $i)
                                      <option value="{{$i->id}}" >{{$i->title}}</option>
                                 @endforeach
                                 </select>
                    </td></div>           <div class="form-group"><label for="exampleInputEmail1">Contacto</label><input  type="text" name="contacto" class='form-control'></div>           <div class="form-group"><label for="exampleInputEmail1">Morada</label><input  type="text" name="morada" class='form-control'></div>           <div class="form-group"><label for="exampleInputEmail1">Ncontrib</label><input  type="text" name="ncontrib" class='form-control'></div>           <div class="form-group"><label for="exampleInputEmail1">Codigo</label>
                    <td>
                                <select name="codigo" class="form-control">
                                      <option value="0" >Nu00e3o aceite</option>                                      <option value="1" >Aceite</option>                                 </select>
                    </td></div>           <div class="form-group"><label for="exampleInputEmail1">Cdpostal</label><input  type="text" name="cdpostal" class='form-control'></div>           <div class="form-group"><label for="exampleInputEmail1">Local</label><input  type="text" name="local" class='form-control'></div>           <div class="form-group"><label for="exampleInputEmail1">Email</label><input  type="text" name="email" class='form-control'></div>           <div class="form-group"><label for="exampleInputEmail1">Ncabeca</label><input  type="text" name="ncabecas" class='form-control'></div>           <div class="form-group"><label for="exampleInputEmail1">Datacri</label><input  type="text" name="datacri" class='form-control'></div>           <div class="form-group">           <div class="form-group">           <div class="form-group">
                <div>
                    <input class="btn btn-danger" type="submit" value="Create">
                </div>
            </form>


        </div>
    </div>


</div>

@endsection
