@extends("scaffolder.views.partials.main")
@section("container")

<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href=:$templateRouteCreate>Create :$modelName</a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        Model: :$modelName
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Permission">
                <thead>
                <tr>
                    :$templateFieldName
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                <tr data-entry-id="{{$item->id}}">
                    :$templateFieldObject
                    :$templateButtonAction

                </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <div class="col">
            :$templateNavLink
        </div>


    </div>
</div>

@endsection
