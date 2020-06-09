@extends("scaffolder.views.partials.main")
@section("container")

<div>
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Model: Categorie</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
                    <a type="submit" class="btn btn-xs btn-success" href="{{ route('categories.create') }}">Create</a>
                    <table class="table">
                        <tr>
                             <th> Id </th> 
 <th> Name </th> 
 <th> Created_at </th> 
 <th> Updated_at </th> 

                            <td>Actions</td>
                        </tr>
                        @foreach($items as $item)
                        <tr>
                            <td>{{$item->id}}</td> 
<td>{{$item->name}}</td> 
<td>{{$item->created_at}}</td> 
<td>{{$item->updated_at}}</td> 

                            <td><form action="{{ route('categories.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Confirm delete');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                    </form><a type="submit" class="btn btn-xs btn-info" href="{{ route('categories.show', $item->id) }}">Show</a> <a type="submit" class="btn btn-xs btn-info" href="{{ route('categories.edit', $item->id) }}">Update</a> </td>
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
