@extends("scaffolder.views.partials.main")
@section("container")

<div>
    @csrf
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Show Categorie</p>
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
                            </tr><th> Options</th><td>
{{( $item->type == 'e')? 'este': '' }}
{{( $item->type == 'i')? 'isto': '' }}
</td> 

                    <tr>
                                <th> Name</th>
                                <td> {{$item->name}}</td>
                            </tr></table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
