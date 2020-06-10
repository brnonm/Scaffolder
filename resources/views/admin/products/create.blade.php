@extends("scaffolder.views.partials.main")
@section("container")

<div>
    @csrf
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Create Product</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        <table class="table">
                            @csrf
                            
                    <tr>
                                <th> Name</th><td><input  type="text" name="name"></td>
                    <tr>
                                <th> Description</th><td><input  type="text" name="description"></td>
                    <tr>
                                <th> Stock</th><td><input   type="number" name="stock" ></td>
                    <tr>
                                <th> Price</th><td><input  type="text" name="price"></td>
                    <tr>
                                <th> Old_price</th><td><input  type="text" name="old_price"></td>
                        </table>
                        <input type="submit" value="Create" class="btn btn-info col-md-12">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
