@extends("scaffolder.views.partials.main")
@section("container")

<div class="card">
    <div class="card-header">
        Show :$templatemodelName
    </div>
    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                :$templateFieldShow
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                Back
            </a>
        </div>
        <nav class="mb-3">
            <div class="nav nav-tabs">
            </div>
        </nav>
        <div class="tab-content">
        </div>
    </div>
</div>
@endsection






