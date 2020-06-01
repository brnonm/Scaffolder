@extends("scaffolder.views.partials.main")
@section("container")

<div>
    @csrf
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Show Autorizacoes_conta</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
                    <table class="table">
                        
                    <tr>
                                <th> User_id</th>
                                <td> {{$item->user_id}}</td>
                            </tr>
                    <tr>
                                <th> Conta_id</th>
                                <td> {{$item->conta_id}}</td>
                            </tr>
                    <tr>
                                <th> So_leitura</th>
                                <td> {{$item->so_leitura}}</td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
