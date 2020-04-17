@extends("scaffolder.views.partials.main")
@section("container")

    <div>
        @csrf
        <div class="row">
            <div class="col-md-12" style="text-align: center">
                <p>User</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="accordion">
                    <div class="card">

                        
                    <table class="table">
                        <tr>

                            <th> Id </th>
<th> Name </th>
<th> Email </th>
<th> Email_verified_at </th>
<th> Password </th>
<th> Remember_token </th>
<th> Created_at </th>
<th> Updated_at </th>
<th> Type </th>
<th> Active </th>
<th> Photo </th>
<th> Nif </th>

                            <th>Actions</th>
                        </tr>
                        <tr>
                            @foreach($items as $item)
                                <th></th>
                            @endforeach
                        </tr>
                    </table>
                    

                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection