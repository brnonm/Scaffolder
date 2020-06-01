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
                    <a type="submit" class="btn btn-xs btn-success" href=:$routeCreate>Create</a>
                    <table class="table">
                        <tr>
                            :$fieldName
                            :$fieldButton
                        </tr>
                        @foreach($items as $item)
                        <tr>
                            :$fieldObject
                            :$ButtonAction
                        </tr>
                        @endforeach
                    </table>
                    <div class="col">
                        :$navLink
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
