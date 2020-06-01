@extends("scaffolder.views.partials.main")
@section("container")

<div>
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Model: Autorizacoes_conta</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
                    <a type="submit" class="btn btn-xs btn-success" href="{{ route('autorizacoes_contas.create') }}">Create</a>
                    <table class="table">
                        <tr>
                             <th> User_id </th> 
 <th> Conta_id </th> 
 <th> So_leitura </th> 

                            <td>Actions</td>
                        </tr>
                        @foreach($items as $item)
                        <tr>
                            <td>{{$item->user_id}}</td> 
<td>{{$item->conta_id}}</td> 
<td>{{$item->so_leitura}}</td> 

                            <td><form action="{{ route('autorizacoes_contas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Confirm delete');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                    </form><a type="submit" class="btn btn-xs btn-info" href="{{ route('autorizacoes_contas.show', $item->id) }}">Show</a> <a type="submit" class="btn btn-xs btn-info" href="{{ route('autorizacoes_contas.edit', $item->id) }}">Update</a> </td>
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
