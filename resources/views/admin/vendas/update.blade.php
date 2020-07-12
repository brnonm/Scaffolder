@extends("scaffolder.views.partials.main")
@section("container")



<div>
    @csrf

    <div class="card">
        <div class="card-header">
            Update Venda
        </div>


        <div class="card-body">
            <form action="{{ route('vendas.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                           <div class="form-group"><label for="exampleInputEmail1">Id</label><input disabled class="form-control" type="text" name="id" value="{{$item->id}}"></div>           <div class="form-group"><label for="exampleInputEmail1">Tpdoc</label><input  class="form-control" type="text" name="tpdoc" value="{{$item->tpdoc}}"></div>           <div class="form-group"><label for="exampleInputEmail1">Terceiro</label><input  class="form-control" type="text" name="terceiro" value="{{$item->terceiro}}"></div>           <div class="form-group"><label for="exampleInputEmail1">Data</label><input  class="form-control" type="text" name="data" value="{{$item->data}}"></div>           <div class="form-group"><label for="exampleInputEmail1">Totdoc</label><input  class="form-control" type="text" name="totdoc" value="{{$item->totdoc}}"></div>           <div class="form-group"><label for="exampleInputEmail1">Totmerc</label><input  class="form-control" type="text" name="totmerc" value="{{$item->totmerc}}"></div>           <div class="form-group"><label for="exampleInputEmail1">Quant</label><input  class="form-control" type="text" name="quant" value="{{$item->quant}}"></div></div></div></div>
                <div>
                    <input class="btn btn-danger" type="submit" value="Update">
                </div>
            </form>


        </div>
    </div>




</div>


@endsection
