@extends("scaffolder.views.partials.main")
@section("container")

<div>
    @csrf

    <div class="card">
        <div class="card-header">
            Create :$modelName
        </div>


        <div class="card-body">
            <form action=:$routeStore method="POST" enctype="multipart/form-data">
            @csrf
            :$fieldInput
            <div>
                <input class="btn btn-danger" type="submit" value="Create">
            </div>
            </form>


        </div>
    </div>




</div>

@endsection
