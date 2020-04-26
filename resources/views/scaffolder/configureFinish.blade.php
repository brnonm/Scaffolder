@extends("scaffolder.views.partials.main")
@section("container")

    @csrf
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
                    Generated Files.
                </div>
            </div>
        </div>
    </div>
@endsection

