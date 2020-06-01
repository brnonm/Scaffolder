@extends("scaffolder.views.partials.main")
@section("container")

<div>
    @csrf
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Create Cliente</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
                    <form action="{{route("clientes.store")}} " method="POST" enctype="multipart/form-data">
                            <table class="table">
                            @csrf
                    <tr>
                                <th> Nome</th><td><input  type="text" name="nome"></td>
                    <tr>
                                <th> Tipocliente</th><td><input   type="number" name="tipocliente" ></td>
                    <tr>
                                <th> Contacto</th><td><input  type="text" name="contacto"></td>
                    <tr>
                                <th> Morada</th><td><input  type="text" name="morada"></td>
                    <tr>
                                <th> Ncontrib</th><td><input  type="text" name="ncontrib"></td>
                    <tr>
                                <th> Codigo</th><td><input  type="text" name="codigo"></td>
                    <tr>
                                <th> Cdpostal</th><td><input  type="text" name="cdpostal"></td>
                    <tr>
                                <th> Local</th><td><input  type="text" name="local"></td>
                    <tr>
                                <th> Email</th><td><input  type="text" name="email"></td>
                    <tr>
                                <th> Ncabeca</th><td><input  type="text" name="ncabecas"></td>
                    <tr>
                                <th> Datacri</th><td><input  type="text" name="datacri"></td>
                    <tr>
                                <th> Created_at</th>
                    <tr>
                                <th> Updated_at</th>
                    <tr>
                                <th> Deleted_at</th></table>
                            <input type="submit" value="Create" class="btn btn-info col-md-12">
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
