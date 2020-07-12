@extends("scaffolder.views.partials.main")
@section("container")

<div>
    @csrf

    <div class="card">
        <div class="card-header">
            Create Venda
        </div>

        <div class="card-body">
            <form action="{{ route('vendas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                           <div class="form-group">           <div class="form-group"><label for="exampleInputEmail1">Tpdoc</label><input  type="text" name="tpdoc" class='form-control'></div>           <div class="form-group"><label for="exampleInputEmail1">Terceiro</label><input  type="text" name="terceiro" class='form-control'></div>           <div class="form-group"><label for="exampleInputEmail1">Data</label><input  type="text" name="data" class='form-control'></div>           <div class="form-group"><label for="exampleInputEmail1">Totdoc</label><input  type="text" name="totdoc" class='form-control'></div>           <div class="form-group"><label for="exampleInputEmail1">Totmerc</label><input  type="text" name="totmerc" class='form-control'></div>           <div class="form-group"><label for="exampleInputEmail1">Quant</label><input  type="text" name="quant" class='form-control'></div>           <div class="form-group">           <div class="form-group">           <div class="form-group">
                <div>
                    <input class="btn btn-danger" type="submit" value="Create">
                </div>
            </form>


        </div>
    </div>


</div>

@endsection
