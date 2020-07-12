@extends("scaffolder.views.partials.main")
@section("container")

<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('vendas.create') }}">Create Venda</a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        Model: Venda
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Permission">
                <thead>
                <tr>
                     <th> Id </th> 
 <th> Tpdoc </th> 
 <th> Terceiro </th> 
 <th> Data </th> 
 <th> Totdoc </th> 
 <th> Totmerc </th> 
 <th> Quant </th> 
 <th> Created_at </th> 
 <th> Updated_at </th> 
 <th> Deleted_at </th> 

                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                <tr data-entry-id="{{$item->id}}">
                    <td>{{$item->id}}</td> 
<td>{{$item->tpdoc}}</td> 
<td>{{$item->terceiro}}</td> 
<td>{{$item->data}}</td> 
<td>{{$item->totdoc}}</td> 
<td>{{$item->totmerc}}</td> 
<td>{{$item->quant}}</td> 
<td>{{$item->created_at}}</td> 
<td>{{$item->updated_at}}</td> 
<td>{{$item->deleted_at}}</td> 

                    <td><form action="{{ route('vendas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Confirm delete');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                    </form><a class="btn btn-xs btn-info" href="{{ route('vendas.show', $item->id) }}">Show</a> <a  class="btn btn-xs btn-info" href="{{ route('vendas.edit', $item->id) }}">Update</a> </td>

                </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <div class="col">
            {{ $items->links()}}
        </div>


    </div>
</div>

@endsection
