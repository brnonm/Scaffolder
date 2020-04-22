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
 <th> Created_at </th> 
 <th> Updated_at </th> 
 <th> Deleted_at </th> 

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
<td>{{$item->created_at}}</td> 
<td>{{$item->updated_at}}</td> 
<td>{{$item->deleted_at}}</td> 

                                    <td>
                                    <form action="{{ route('clientes.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Confirm delete');" style="display: inline-block;">
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
