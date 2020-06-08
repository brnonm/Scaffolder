@extends("scaffolder.views.partials.main")
@section("container")

<div>
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Model: :$modelName</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
                    <a type="submit" class="btn btn-xs btn-success" href=:$templateRouteCreate>Create</a>
                    <table class="table">
                        <tr>
                            :$templateFieldName
                            <td>Actions</td>
                        </tr>
                        @foreach($items as $item)
                        <tr>
                            :$templateFieldObject
                            :$templateButtonAction
                        </tr>
                        @endforeach
                    </table>
                    <div class="col">
                        :$templateNavLink
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
