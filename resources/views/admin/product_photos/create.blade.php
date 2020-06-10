@extends("scaffolder.views.partials.main")
@section("container")

<div>
    @csrf

    <div class="card">
        <div class="card-header">
            Create Product_photo
        </div>


        <div class="card-body">
            <form action="{{ route('product_photos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
                       <div class="form-group">           <div class="form-group">           <div class="form-group"><label for="exampleInputEmail1">Description</label><input  type="text" name="description" class='form-control'></div>           <div class="form-group"><label for="exampleInputEmail1">Photo</label><input  type="text" name="photo" class='form-control'></div>           <div class="form-group">           <div class="form-group">
            <div>
                <input class="btn btn-danger" type="submit" value="Create">
            </div>
            </form>


        </div>
    </div>




</div>

@endsection
