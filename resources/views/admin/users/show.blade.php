@extends("scaffolder.views.partials.main")
@section("container")

<div>
    @csrf
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Show User</p>
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
                                <th> Name</th>
                                <td> {{$item->name}}</td>
                            </tr>
                    <tr>
                                <th> Email</th>
                                <td> {{$item->email}}</td>
                            </tr>
                    <tr>
                                <th> Email_verified_at</th>
                                <td> {{$item->email_verified_at}}</td>
                            </tr>
                    <tr>
                                <th> Password</th>
                                <td> {{$item->password}}</td>
                            </tr>
                    <tr>
                                <th> Remember_token</th>
                                <td> {{$item->remember_token}}</td>
                            </tr>
                    <tr>
                                <th> Created_at</th>
                                <td> {{$item->created_at}}</td>
                            </tr>
                    <tr>
                                <th> Updated_at</th>
                                <td> {{$item->updated_at}}</td>
                            </tr><th> Options</th><td>
{{( $item->type == 'u')? 'u': '' }}
{{( $item->type == 'o')? 'o': '' }}
{{( $item->type == 'a')? 'a': '' }}
</td> 

                    <tr>
                                <th> Active</th>
                                <td> {{$item->active}}</td>
                            </tr>
                    <tr>
                                <th> Photo</th>
                                <td> {{$item->photo}}</td>
                            </tr>
                    <tr>
                                <th> Nif</th>
                                <td> {{$item->nif}}</td>
                            </tr></table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
