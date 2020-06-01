@extends("scaffolder.views.partials.main")
@section("container")

<div>
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Model: Conta</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
                    <a type="submit" class="btn btn-xs btn-success" href="{{ route('contas.create') }}">Create</a>
                    <table class="table">
                        <tr>
                             <th> Id </th> 
 <th> User_id </th> 
 <th> Nome </th> 
 <th> Descricao </th> 
 <th> Saldo_abertura </th> 
 <th> Saldo_atual </th> 
 <th> Data_ultimo_movimento </th> 
 <th> Deleted_at </th> 

                            <td>Actions</td>
                        </tr>
                        @foreach($items as $item)
                        <tr>
                            <td>{{$item->id}}</td> 
<td>{{$item->user_id}}</td> 
<td>{{$item->nome}}</td> 
<td>{{$item->descricao}}</td> 
<td>{{$item->saldo_abertura}}</td> 
<td>{{$item->saldo_atual}}</td> 
<td>{{$item->data_ultimo_movimento}}</td> 
<td>{{$item->deleted_at}}</td> 

                            <td><form action="{{ route('contas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Confirm delete');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                    </form><a type="submit" class="btn btn-xs btn-info" href="{{ route('contas.show', $item->id) }}">Show</a> <a type="submit" class="btn btn-xs btn-info" href="{{ route('contas.edit', $item->id) }}">Update</a> </td>
                        </tr>
                        @endforeach
                    </table>
                    <div class="col">
                        {{ $items->links()}}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
