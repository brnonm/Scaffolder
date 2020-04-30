@extends("scaffolder.views.partials.main")
@section("container")

<div>
    @csrf
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Create Categorie</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
                    <form action="{{route("categories.store")}} " method="POST" enctype="multipart/form-data">
                            <table class="table">
                            @csrf
                    <tr>
                                <th> Options</th><td><input  type=radio name="type"  value=e>    <label>este</label><br>
<input  type=radio name="type"  value=i>    <label>isto</label><br>
</td>
                    <tr>
                                <th> Name</th><td><input  type="text" name="name"></td></table>
                            <input type="submit" value="Create" class="btn btn-info col-md-12">
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
