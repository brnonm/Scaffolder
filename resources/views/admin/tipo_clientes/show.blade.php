@extends("scaffolder.views.partials.main")
@section("container")

<div class="card">
    <div class="card-header">
        Show TipoCliente
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                
                    <tr>
                                <th> Id</th>
                                <td> {{$item->id}}</td></tr>
                    <tr>
                                <th> Title</th>
                                <td> {{$item->title}}</td></tr>
                    <tr>
                                <th> Created_at</th>
                                <td> {{$item->created_at}}</td></tr>
                    <tr>
                                <th> Updated_at</th>
                                <td> {{$item->updated_at}}</td></tr>
                    <tr>
                                <th> Deleted_at</th>
                                <td> {{$item->deleted_at}}</td></tr>
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
