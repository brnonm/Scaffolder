@extends("scaffolder.views.partials.main")
@section("container")

<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('candidaturas.create') }}">Create Candidatura</a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        Model: Candidatura
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Permission">
                <thead>
                <tr>
                     <th> Id </th> 
 <th> Curso </th> 
 <th> Nome </th> 
 <th> Email </th> 
 <th> Telefone1 </th> 
 <th> Telefone2 </th> 
 <th> Genero </th> 
 <th> Media </th> 
 <th> M23 </th> 
 <th> Origem </th> 
 <th> Ob </th> 

                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                <tr data-entry-id="{{$item->id}}">
                    <td>{{$item->id}}</td> 
<td>{{$item->curso}}</td> 
<td>{{$item->nome}}</td> 
<td>{{$item->email}}</td> 
<td>{{$item->telefone1}}</td> 
<td>{{$item->telefone2}}</td> 
<td> {{$item->generoEnum()}}</td><td>{{$item->media}}</td> 
<td>{{$item->m23}}</td> 
<td> {{$item->origemEnum()}}</td><td>{{$item->obs}}</td> 

                    <td><form action="{{ route('candidaturas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Confirm delete');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                    </form><a class="btn btn-xs btn-info" href="{{ route('candidaturas.show', $item->id) }}">Show</a> <a  class="btn btn-xs btn-info" href="{{ route('candidaturas.edit', $item->id) }}">Update</a> </td>

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
