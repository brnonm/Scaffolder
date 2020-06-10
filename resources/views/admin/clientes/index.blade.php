@extends("scaffolder.views.partials.main")
@section("container")

<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('clientes.create') }}">Create Cliente</a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        Model: Cliente
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Permission">
                <thead>
                <tr>
                     <th> Id </th> 
 <th> Nome </th> 
 <th> Tipocliente </th> 
 <th> Contacto </th> 
 <th> Morada </th> 
 <th> Ncontrib </th> 
 <th> Codigo </th> 
 <th> Cdpostal </th> 
 <th> Local </th> 
 <th> Email </th> 
 <th> Ncabeca </th> 
 <th> Datacri </th> 
 <th> Created_at </th> 
 <th> Updated_at </th> 
 <th> Deleted_at </th> 

                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                <tr data-entry-id="{{$item->id}}">
                    <td>{{$item->id}}</td> 
<td>{{$item->nome}}</td> 
<td>{{$item->tipocliente}}</td> 
<td>{{$item->contacto}}</td> 
<td>{{$item->morada}}</td> 
<td>{{$item->ncontrib}}</td> 
<td>{{$item->codigo}}</td> 
<td>{{$item->cdpostal}}</td> 
<td>{{$item->local}}</td> 
<td>{{$item->email}}</td> 
<td>{{$item->ncabecas}}</td> 
<td>{{$item->datacri}}</td> 
<td>{{$item->created_at}}</td> 
<td>{{$item->updated_at}}</td> 
<td>{{$item->deleted_at}}</td> 

                    <td><form action="{{ route('clientes.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Confirm delete');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                    </form><a class="btn btn-xs btn-info" href="{{ route('clientes.show', $item->id) }}">Show</a> <a  class="btn btn-xs btn-info" href="{{ route('clientes.edit', $item->id) }}">Update</a> </td>

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
