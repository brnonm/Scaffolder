@extends("scaffolder.views.partials.main")
@section("container")

<div>
    @csrf
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Update Cliente</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
                    <form action="{{route("clientes.update", $item->id)}} " method="POST" enctype="multipart/form-data">
                            <table class="table">
                            @csrf
                            @method('PUT')
                    <tr>
                                <th> Id</th><td><input disabled  type="number" name="id" value="{{$item->id}}"></td>
                    <tr>
                                <th> Nome</th><td><input  type="text" name="nome" value="{{$item->nome}}"></td>
                    <tr>
                                <th> Tipocliente</th><td><input   type="number" name="tipocliente" value="{{$item->tipocliente}}"></td>
                    <tr>
                                <th> Contacto</th><td><input  type="text" name="contacto" value="{{$item->contacto}}"></td>
                    <tr>
                                <th> Morada</th><td><input  type="text" name="morada" value="{{$item->morada}}"></td>
                    <tr>
                                <th> Ncontrib</th><td><input  type="text" name="ncontrib" value="{{$item->ncontrib}}"></td>
                    <tr>
                                <th> Codigo</th><td><input  type="text" name="codigo" value="{{$item->codigo}}"></td>
                    <tr>
                                <th> Cdpostal</th><td><input  type="text" name="cdpostal" value="{{$item->cdpostal}}"></td>
                    <tr>
                                <th> Local</th><td><input  type="text" name="local" value="{{$item->local}}"></td>
                    <tr>
                                <th> Email</th><td><input  type="text" name="email" value="{{$item->email}}"></td>
                    <tr>
                                <th> Ncabeca</th><td><input  type="text" name="ncabecas" value="{{$item->ncabecas}}"></td>
                    <tr>
                                <th> Datacri</th><td><input  type="text" name="datacri" value="{{$item->datacri}}"></td>
                    <tr>
                                <th> Created_at</th>
                    <tr>
                                <th> Updated_at</th>
                    <tr>
                                <th> Deleted_at</th></table>
                            <input type="submit" value="Update" class="btn btn-info col-md-12">
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
