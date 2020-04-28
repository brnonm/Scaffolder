@extends("scaffolder.views.partials.main")
@section("container")

<div>
    @csrf
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Show Wallet</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
                    <table class="table"><tr>
                    <tr>
                                <th> Id</th>
                                <td> {{$item->id}}</td>
                            </tr>
                    <tr>
                                <th> Email</th>
                                <td> {{$item->email}}</td>
                            </tr>
                    <tr>
                                <th> Balance</th>
                                <td> {{$item->balance}}</td>
                            </tr>
                    <tr>
                                <th> Created_at</th>
                                <td> {{$item->created_at}}</td>
                            </tr>
                    <tr>
                                <th> Updated_at</th>
                                <td> {{$item->updated_at}}</td>
                            </tr></table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
