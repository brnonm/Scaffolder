@extends("scaffolder.views.partials.main")
@section("container")

<div>
    @csrf
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Show Conta</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
                    <table class="table">
                        
                    <tr>
                                <th> Id</th>
                                <td> {{$item->id}}</td>
                            </tr>
                    <tr>
                                <th> User_id</th>
                                <td> {{$item->user_id}}</td>
                            </tr>
                    <tr>
                                <th> Nome</th>
                                <td> {{$item->nome}}</td>
                            </tr>
                    <tr>
                                <th> Descricao</th>
                                <td> {{$item->descricao}}</td>
                            </tr>
                    <tr>
                                <th> Saldo_abertura</th>
                                <td> {{$item->saldo_abertura}}</td>
                            </tr>
                    <tr>
                                <th> Saldo_atual</th>
                                <td> {{$item->saldo_atual}}</td>
                            </tr>
                    <tr>
                                <th> Data_ultimo_movimento</th>
                                <td> {{$item->data_ultimo_movimento}}</td>
                            </tr>
                    <tr>
                                <th> Deleted_at</th>
                                <td> {{$item->deleted_at}}</td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
