@extends("scaffolder.views.partials.main")
@section("container")

<div>
    @csrf
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Create Conta</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
                    <form action="{{ route('contas.store') }}" method="POST" enctype="multipart/form-data">
                        <table class="table">
                            @csrf
                            
                    <tr>
                                <th> Nome</th><td><input  type="text" name="nome"></td>
                    <tr>
                                <th> Descricao</th><td><input  type="text" name="descricao"></td>
                    <tr>
                                <th> Saldo_abertura</th><td><input  type="number" name="saldo_abertura" ></td>
                    <tr>
                                <th> Saldo_atual</th><td><input  type="number" name="saldo_atual" ></td>
                    <tr>
                                <th> Data_ultimo_movimento</th><td><input  type="text" name="data_ultimo_movimento"></td>
                    <tr>
                                <th> Deleted_at</th>
                        </table>
                        <input type="submit" value="Create" class="btn btn-info col-md-12">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
