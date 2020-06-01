@extends("scaffolder.views.partials.main")
@section("container")

<div>
    @csrf
    <div class="row">
        <div class="col-md-12" style="text-align: center">
<<<<<<< HEAD:resources/views/admin/contas/update.blade.php
            <p>Update Categoria</p>
=======
            <p>Update Cliente</p>
>>>>>>> master:resources/views/admin/clientes/update.blade.php
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
<<<<<<< HEAD:resources/views/admin/contas/update.blade.php
                    <form action="{{ route('contas.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        <table class="table">
                            @csrf
                            @method('PUT')

                            
                    <tr>
                                <th> Id</th><td><input disabled type="text" name="id" value="{{$item->id}}"></td>
                    <tr>
                                <th> User_id</th><td><input disabled type="text" name="user_id" value="{{$item->user_id}}"></td>
                    <tr>
                                <th> Nome</th><td><input  type="text" name="nome" value="{{$item->nome}}"></td>
                    <tr>
                                <th> Descricao</th><td><input  type="text" name="descricao" value="{{$item->descricao}}"></td>
                    <tr>
                                <th> Saldo_abertura</th>
                    <tr>
                                <th> Saldo_atual</th>
                    <tr>
                                <th> Data_ultimo_movimento</th><td><input  type="text" name="data_ultimo_movimento" value="{{$item->data_ultimo_movimento}}"></td>
                    <tr>
                                <th> Deleted_at</th>

                        </table>
                        <input type="submit" value="Update" class="btn btn-info col-md-12">
                    </form>
=======
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
>>>>>>> master:resources/views/admin/clientes/update.blade.php
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
