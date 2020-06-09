@extends("scaffolder.views.partials.main")
@section("container")



<div>
    @csrf

    <div class="card">
        <div class="card-header">
            Update :$modelName
        </div>


        <div class="card-body">
            <form action=:$routeUpdate method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                :$templateFieldUpdate
                <div>
                    <input class="btn btn-danger" type="submit" value="Update">
                </div>
            </form>


        </div>
    </div>




</div>


@endsection
