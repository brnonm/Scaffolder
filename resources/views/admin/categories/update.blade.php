@extends("scaffolder.views.partials.main")
@section("container")

<div>
    @csrf
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Update $modelName</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
                    <form action="{{route("categories.update", $item->id)}} " method="POST" enctype="multipart/form-data">
                            <table class="table">
                            @csrf
                            @method('PUT')
                    <tr>
                                <th> Id</th><td><input disabled  type="number" name="id" value="{{$item->id}}"></td>
                    <tr>
                                <th> ola</th><td>(listar opcoes)<input  type="radio" name="type" value="{{$item->type}}"></td>
                    <tr>
                                <th> Name</th><td><input  type="text" name="name" value="{{$item->name}}"></td></table>
                            <input type="submit" value="Update" class="btn btn-info col-md-12">
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
