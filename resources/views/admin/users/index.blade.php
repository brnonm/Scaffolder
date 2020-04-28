@extends("scaffolder.views.partials.main")
@section("container")

<div>
    @csrf
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Model: User</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
                    <a type="submit" class="btn btn-xs btn-success" href="{{ route('users.create') }}">Create</a> 
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
 <th> Options </th> 
 <th> Active </th> 
 <th> Photo </th> 
 <th> Nif </th> 

                            <th>Actions</th>
                        </tr>


                         @foreach($items as $item)
                                <tr>
                                    <td>{{$item->id}}</td> 
<td>{{$item->name}}</td> 
<td>{{$item->email}}</td> 
<td>{{$item->email_verified_at}}</td> 
<td>{{$item->password}}</td> 
<td>{{$item->remember_token}}</td> 
<td>{{$item->created_at}}</td> 
<td>{{$item->updated_at}}</td> 
<td>
{{( $item->type == 'u')? 'u': '' }}
{{( $item->type == 'o')? 'o': '' }}
{{( $item->type == 'a')? 'a': '' }}
</td> 
<td>{{$item->active}}</td> 
<td><img src="/storage/fotos/{{ $item->photo}}" height="70px" width="70px" /></td>
<td>{{$item->nif}}</td> 

                                    <td><form action="{{ route('users.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Confirm delete');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                    </form><a type="submit" class="btn btn-xs btn-info" href="{{ route('users.show', $item->id) }}">Show</a> <a type="submit" class="btn btn-xs btn-info" href="{{ route('users.edit', $item->id) }}">Update</a> </td>
                                </tr>
                                @endforeach
                    </table>
                    <div class="col">
                        {{$items->links()}}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
