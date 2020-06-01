@extends("scaffolder.views.partials.main")
@section("container")

<div>
    @csrf
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Show Migration</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
                    <table class="table">
                        
                    <tr>
                                <th> Id</th>
                                <td> {{$item->id}}</td>
                            </tr>
                    <tr>
                                <th> Migration</th>
                                <td> {{$item->migration}}</td>
                            </tr>
                    <tr>
                                <th> Batch</th>
                                <td> {{$item->batch}}</td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
