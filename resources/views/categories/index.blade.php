@extends("scaffolder.views.partials.main")
@section("container")

    <div>
        @csrf
        <div class="row">
            <div class="col-md-12" style="text-align: center">
                <p>Categorie</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="accordion">
                    <div class="card">
                        
                    <table class="table">
                        <tr>
                            <th> Id </th>
<th> Type </th>
<th> Name </th>

                            <th>Actions</th>
                        </tr>
                        <tr>
                            @foreach($items as $item)
                                <th></th>
                            @endforeach
                        </tr>

                         @foreach($items as $item)
                                <tr>
                                    @foreach($item->getFillable() as $field)
                                        <th>{{$item->$field}}</th>
                                    @endforeach
                                    <th><button>Editar</button></th>
                                </tr>
                                @endforeach
                    </table>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
