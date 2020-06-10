@extends("scaffolder.views.partials.main")
@section("container")



<div>
    @csrf

    <div class="card">
        <div class="card-header">
            Update Product_photo
        </div>


        <div class="card-body">
            <form action=:$routeUpdate method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                           <div class="form-group"><label for="exampleInputEmail1">Id</label><input disabled class="form-control" type="number" name="id" value="{{$item->id}}"></div>           <div class="form-group"><label for="exampleInputEmail1">Product_id</label><input disabled class="form-control" type="number" name="product_id" value="{{$item->product_id}}"></div>           <div class="form-group"><label for="exampleInputEmail1">Description</label><input  class="form-control" type="text" name="description" value="{{$item->description}}"></div>           <div class="form-group"><label for="exampleInputEmail1">Photo</label><input  class="form-control" type="text" name="photo" value="{{$item->photo}}"></div></div></div>
                <div>
                    <input class="btn btn-danger" type="submit" value="Update">
                </div>
            </form>


        </div>
    </div>




</div>


@endsection
