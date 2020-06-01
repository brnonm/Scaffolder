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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
