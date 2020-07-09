@extends("scaffolder.views.partials.main")
@section("container")



<div>
    @csrf

    <div class="card">
        <div class="card-header">
            Update Cliente
        </div>


        <div class="card-body">
            <form action=:$routeUpdate method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                           <div class="form-group"><label for="exampleInputEmail1">Id</label><input disabled class="form-control" type="number" name="id" value="{{$item->id}}"></div>           <div class="form-group"><label for="exampleInputEmail1">Nome</label><input  class="form-control" type="text" name="nome" value="{{$item->nome}}"></div>           <div class="form-group"><label for="exampleInputEmail1">Tipocliente</label>

                                <select name="tipocliente" class="form-control">
                                 @foreach($tipoclienteAll as $i)
                                      <option value="{{$i->id}}" @if($item->tipocliente==$i->id) selected @endif>{{$i->title}}</option>
                                 @endforeach
                                 </select>
</div>           <div class="form-group"><label for="exampleInputEmail1">Contacto</label><input  class="form-control" type="text" name="contacto" value="{{$item->contacto}}"></div>           <div class="form-group"><label for="exampleInputEmail1">Morada</label><input  class="form-control" type="text" name="morada" value="{{$item->morada}}"></div>           <div class="form-group"><label for="exampleInputEmail1">Ncontrib</label><input  class="form-control" type="text" name="ncontrib" value="{{$item->ncontrib}}"></div>           <div class="form-group"><label for="exampleInputEmail1">Codigo</label>

                                <select name="codigo" class="form-control">
                                      <option value="0" {{( $item->codigo == '0')? 'selected': '' }}>Nu00e3o aceite</option>                                      <option value="1" {{( $item->codigo == '1')? 'selected': '' }}>Aceite</option>                                 </select>
</div>           <div class="form-group"><label for="exampleInputEmail1">Cdpostal</label><input  class="form-control" type="text" name="cdpostal" value="{{$item->cdpostal}}"></div>           <div class="form-group"><label for="exampleInputEmail1">Local</label><input  class="form-control" type="text" name="local" value="{{$item->local}}"></div>           <div class="form-group"><label for="exampleInputEmail1">Email</label><input  class="form-control" type="text" name="email" value="{{$item->email}}"></div>           <div class="form-group"><label for="exampleInputEmail1">Ncabeca</label><input  class="form-control" type="text" name="ncabecas" value="{{$item->ncabecas}}"></div>           <div class="form-group"><label for="exampleInputEmail1">Datacri</label><input  class="form-control" type="text" name="datacri" value="{{$item->datacri}}"></div></div></div></div>
                <div>
                    <input class="btn btn-danger" type="submit" value="Update">
                </div>
            </form>


        </div>
    </div>




</div>


@endsection
