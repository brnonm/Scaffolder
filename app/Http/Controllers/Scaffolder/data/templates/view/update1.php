@extends("scaffolder.views.partials.main")
@section("container")

<div>
    @csrf
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Update Categoria</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
                    <form action=:$routeUpdate method="POST" enctype="multipart/form-data">
                        <table class="table">
                            @csrf
                            @method('PUT')

                            :$fieldUpdate

                        </table>
                        <input type="submit" value="Update" class="btn btn-info col-md-12">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
