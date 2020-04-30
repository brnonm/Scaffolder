@extends("scaffolder.views.partials.main")
@section("container")

<div>
    @csrf
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Create User</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
                    <form action="{{route("users.store")}} " method="POST" enctype="multipart/form-data">
                            <table class="table">
                            @csrf
                    <tr>
                                <th> Name</th><td><input  type="text" name="name"></td>
                    <tr>
                                <th> Email</th><td><input  type="text" name="email"></td>
                    <tr>
                                <th> Email_verified_at</th>
                    <tr>
                                <th> Password</th><td><input  type="text" name="password"></td>
                    <tr>
                                <th> Remember_token</th><td><input  type="text" name="remember_token"></td>
                    <tr>
                                <th> Created_at</th>
                    <tr>
                                <th> Updated_at</th>
                    <tr>
                                <th> Options</th><td><input  type=radio name="type"  value=u>    <label>u</label><br>
<input  type=radio name="type"  value=o>    <label>o</label><br>
<input  type=radio name="type"  value=a>    <label>a</label><br>
</td>
                    <tr>
                                <th> Active</th>
                    <tr>
                                <th> Photo</th>
                    <tr>
                                <th> Nif</th><td><input  type="text" name="nif"></td></table>
                            <input type="submit" value="Create" class="btn btn-info col-md-12">
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
