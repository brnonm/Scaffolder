@extends("scaffolder.views.partials.main")
@section("container")

<div>
    <div class="row">
        <div class="col-md-12" style="text-align: center">
<<<<<<< HEAD:resources/views/admin/categorias/index.blade.php
            <p>Model: Categoria</p>
=======
            <p>Model: Cliente</p>
>>>>>>> master:resources/views/admin/clientes/index.blade.php
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
<<<<<<< HEAD:resources/views/admin/categorias/index.blade.php
                    <a type="submit" class="btn btn-xs btn-success" href="{{ route('categorias.create') }}">Create</a>
                    <table class="table">
                        <tr>
                             <th> Id </th> 
 <th> Nome </th> 
 <th> Tipo </th> 
=======

                    <a type="submit" class="btn btn-xs btn-success" href="{{ route('clientes.create') }}">Create</a> 
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
>>>>>>> master:resources/views/admin/clientes/index.blade.php

                            <td>Actions</td>
                        </tr>
<<<<<<< HEAD:resources/views/admin/categorias/index.blade.php
                        @foreach($items as $item)
                        <tr>
                            <td>{{$item->id}}</td> 
<td>{{$item->nome}}</td> 
<td>{{$item->tipo}}</td> 

                            <td><form action="{{ route('categorias.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Confirm delete');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                    </form><a type="submit" class="btn btn-xs btn-info" href="{{ route('categorias.show', $item->id) }}">Show</a> <a type="submit" class="btn btn-xs btn-info" href="{{ route('categorias.edit', $item->id) }}">Update</a> </td>
                        </tr>
                        @endforeach
                    </table>
                    <div class="col">
                        {{ $items->links()}}
                    </div>

=======
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

                                    <td><form action="{{ route('clientes.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Confirm delete');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                    </form><a type="submit" class="btn btn-xs btn-info" href="{{ route('clientes.show', $item->id) }}">Show</a> <a type="submit" class="btn btn-xs btn-info" href="{{ route('clientes.edit', $item->id) }}">Update</a> </td>
                                </tr>
                                @endforeach
                    </table>
                    <div class="col">
                        {{$items->links()}}
                    </div>
                    
>>>>>>> master:resources/views/admin/clientes/index.blade.php
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
