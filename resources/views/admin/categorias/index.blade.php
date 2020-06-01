@extends("scaffolder.views.partials.main")
@section("container")

<div>
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Model: Categoria</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
                    <a type="submit" class="btn btn-xs btn-success" href="{{ route('categorias.create') }}">Create</a>
                    <table class="table">
                        <tr>
                             <th> Id </th> 
 <th> Nome </th> 
 <th> Tipo </th> 

                            <td>Actions</td>
                        </tr>
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

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
