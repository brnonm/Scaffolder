@extends("scaffolder.views.partials.main")
@section("container")

<div>
    @csrf
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Update Product</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
                    <form action="{{ route('products.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        <table class="table">
                            @csrf
                            @method('PUT')
                            
                    <tr>
                                <th> Id</th><td><input disabled  type="number" name="id" value="{{$item->id}}"></td>
                    <tr>
                                <th> Category_id</th>
                    <td>
                                <select name="category_id" class="form-control">
                                 @foreach($item::$category_id::all() as $i)
                                      <option value="{{$i->id}}" @if($item->category_id==$i->id) selected @endif>{{$i->name}}</option>
                                 @endforeach
                                 </select>
                    </td>
                    <tr>
                                <th> Name</th><td><input  type="text" name="name" value="{{$item->name}}"></td>
                    <tr>
                                <th> Description</th><td><input  type="text" name="description" value="{{$item->description}}"></td>
                    <tr>
                                <th> Stock</th><td><input   type="number" name="stock" value="{{$item->stock}}"></td>
                    <tr>
                                <th> Price</th><td><input  type="text" name="price" value="{{$item->price}}"></td>
                    <tr>
                                <th> Old_price</th><td><input  type="text" name="old_price" value="{{$item->old_price}}"></td>
                        </table>
                        <input type="submit" value="Update" class="btn btn-info col-md-12">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
