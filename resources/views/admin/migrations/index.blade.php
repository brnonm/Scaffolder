@extends("scaffolder.views.partials.main")
@section("container")

<div>
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Model: Migration</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
                    <a type="submit" class="btn btn-xs btn-success" href="{{ route('migrations.create') }}">Create</a>
                    <table class="table">
                        <tr>
                             <th> Id </th> 
 <th> Migration </th> 
 <th> Batch </th> 

                            <td>Actions</td>
                        </tr>
                        @foreach($items as $item)
                        <tr>
                            <td>{{$item->id}}</td> 
<td>{{$item->migration}}</td> 
<td>{{$item->batch}}</td> 

                            <td><form action="{{ route('migrations.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Confirm delete');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                    </form><a type="submit" class="btn btn-xs btn-info" href="{{ route('migrations.show', $item->id) }}">Show</a> <a type="submit" class="btn btn-xs btn-info" href="{{ route('migrations.edit', $item->id) }}">Update</a> </td>
                        </tr>
                        @endforeach
                    </table>
                    <div class="col">
                        {{ $items->links()}}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
