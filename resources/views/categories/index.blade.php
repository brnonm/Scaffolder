@extends("scaffolder.views.partials.main")
@section("container")

    <div>
        @csrf
        <div class="row">
            <div class="col-md-12" style="text-align: center">
                <p>Model: Categorie</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="accordion">
                    <div class="card">

                        <table class="table">
                        <tr>
                            <th> Id </th >
                            <th> Type </th >
                            <th> Name </th >

                            <th>Actions</th>
                        </tr>
                        @foreach($items as $item)
                            <tr>
                                @foreach($item->getFillable() as $field)
                                    <th>{{$item->$field}}</th>
                                @endforeach
                                <th>
                                    <form action="{{ route('categories.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Confirm delete');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                    </form>

                                    <button>Update</button>
                                    <button>Show</button>
                                </th>
                            </tr>
                            @endforeach
                            </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
