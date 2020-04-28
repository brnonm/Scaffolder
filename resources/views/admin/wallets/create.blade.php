@extends("scaffolder.views.partials.main")
@section("container")

<div>
    @csrf
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Create Wallet</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
                    <form action="{{route("wallets.store")}} " method="POST" enctype="multipart/form-data">
                            <table class="table">
                            @csrf
                    <tr>
                                <th> Email</th><td><input  type="text" name="email"></td>
                    <tr>
                                <th> Balance</th>
                    <tr>
                                <th> Created_at</th>
                    <tr>
                                <th> Updated_at</th></table>
                            <input type="submit" value="Create" class="btn btn-info col-md-12">
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
