
@extends("scaffolder.views.partials.main")
@section("container")
<div>
    @csrf
    <div class="card">
        <div class="card-header">
            Create :$templatemodelName
        </div>
        <div class="card-body">
            <form action=:$templateRouteStore method="POST" enctype="multipart/form-data">
                @csrf
                :$templateFieldInputRow
                <div>
                    <input class="btn btn-danger" type="submit" value="Create">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection



