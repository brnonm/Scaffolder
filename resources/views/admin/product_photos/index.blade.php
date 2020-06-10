@extends("scaffolder.views.partials.main")
@section("container")

<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('product_photos.create') }}">Create Product_photo</a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        Model: Product_photo
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Permission">
                <thead>
                <tr>
                     <th> Id </th> 
 <th> Product_id </th> 
 <th> Description </th> 
 <th> Photo </th> 
 <th> Created_at </th> 
 <th> Updated_at </th> 

                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                <tr data-entry-id="{{$item->id}}">
                    <td>{{$item->id}}</td> 
<td>{{$item->product_id}}</td> 
<td>{{$item->description}}</td> 
<td>{{$item->photo}}</td> 
<td>{{$item->created_at}}</td> 
<td>{{$item->updated_at}}</td> 

                    <td><form action="{{ route('product_photos.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Confirm delete');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                    </form><a class="btn btn-xs btn-info" href="{{ route('product_photos.show', $item->id) }}">Show</a> <a  class="btn btn-xs btn-info" href="{{ route('product_photos.edit', $item->id) }}">Update</a> </td>

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
