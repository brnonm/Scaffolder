@extends("scaffolder.views.partials.main")
@section("container")

<div>
    @csrf
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Update User</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
                    <form action="{{route("users.update", $item->id)}} " method="POST" enctype="multipart/form-data">
                            <table class="table">
                            @csrf
                            @method('PUT')
                    <tr>
                                <th> Id</th><td><input disabled type="text" name="id" value="{{$item->id}}"></td>
                    <tr>
                                <th> Name</th><td><input  type="text" name="name" value="{{$item->name}}"></td>
                    <tr>
                                <th> Email</th><td><input disabled type="text" name="email" value="{{$item->email}}"></td>
                    <tr>
                                <th> Email_verified_at</th>
                    <tr>
                                <th> Password</th><td><input  type="text" name="password" value="{{$item->password}}"></td>
                    <tr>
                                <th> Remember_token</th><td><input  type="text" name="remember_token" value="{{$item->remember_token}}"></td>
                    <tr>
                                <th> Created_at</th>
                    <tr>
                                <th> Updated_at</th>
                    <tr>
                                <th> Options</th><td><input type=radio name="type"  value=u {{( $item->type == 'u')? 'checked': '' }}>    <label>u</label><br>
<input type=radio name="type"  value=o {{( $item->type == 'o')? 'checked': '' }}>    <label>o</label><br>
<input type=radio name="type"  value=a {{( $item->type == 'a')? 'checked': '' }}>    <label>a</label><br>
</td>
                    <tr>
                                <th> Active</th><td><input  type="text" name="active" value="{{$item->active}}"></td>
                    <tr>
                                <th> Photo</th><td><input  type="text" name="photo" value="{{$item->photo}}"></td>
                    <tr>
                                <th> Nif</th><td><input  type="text" name="nif" value="{{$item->nif}}"></td></table>
                            <input type="submit" value="Update" class="btn btn-info col-md-12">
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
