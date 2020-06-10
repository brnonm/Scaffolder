@extends("scaffolder.views.partials.main")
@section("container")

<div>
    @csrf
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Show Product</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
                    <table class="table">
                        
                    <tr>
                                <th> Id</th>
                                <td> {{$item->id}}</td></tr>
                    <tr>
                                <th> Category_id</th>
                                <td> {{$item->category_idRel->name}}</td></tr>
                    <tr>
                                <th> Name</th>
                                <td> {{$item->name}}</td></tr>
                    <tr>
                                <th> Description</th>
                                <td> {{$item->description}}</td></tr>
                    <tr>
                                <th> Stock</th>
                                <td> {{$item->stock}}</td></tr>
                    <tr>
                                <th> Price</th>
                                <td> {{$item->price}}</td></tr>
                    <tr>
                                <th> Old_price</th>
                                <td> {{$item->old_price}}</td></tr>
                    <tr>
                                <th> Created_at</th>
                                <td> {{$item->created_at}}</td></tr>
                    <tr>
                                <th> Updated_at</th>
                                <td> {{$item->updated_at}}</td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
