@extends("scaffolder.views.partials.main")
@section("container")

    <div>
        @csrf
        <div class="row">
            <div class="col-md-12" style="text-align: center">
                <p>Model: Cliente</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="accordion">
                    <div class="card">
                        <a class="btn btn-xs btn-success" href="{{ route('clientes.create') }}">Create</a> 
                                <table class="table">
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

                            <th>Actions</th>
                        </tr>


                         @foreach($items as $item)
                                <tr>
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

                                    <td><a  class="btn btn-xs btn-info" href="{{ route('clientes.show', $item->id) }}">Show</a> <a  class="btn btn-xs btn-light" href="{{ route('clientes.edit', $item->id) }}">Update</a> <form action="{{ route('clientes.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Confirm delete');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                    </form></td>
                                </tr>
                                @endforeach
                    </table>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
