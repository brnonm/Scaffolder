@extends("scaffolder.views.partials.main")
@section("container")

<div>
    @csrf
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Update Categoria</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
                    <form action="{{ route('autorizacoes_contas.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        <table class="table">
                            @csrf
                            @method('PUT')

                            
                    <tr>
                                <th> User_id</th><td><input disabled type="text" name="user_id" value="{{$item->user_id}}"></td>
                    <tr>
                                <th> Conta_id</th><td><input disabled type="text" name="conta_id" value="{{$item->conta_id}}"></td>
                    <tr>
                                <th> So_leitura</th><td><input  type="text" name="so_leitura" value="{{$item->so_leitura}}"></td>

                        </table>
                        <input type="submit" value="Update" class="btn btn-info col-md-12">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
