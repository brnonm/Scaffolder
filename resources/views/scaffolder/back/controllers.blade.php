@extends("scaffolder.views.partials.main")
@section("container")
    <div>
        @csrf
        <div class="row">
            <div class="col-md-12" style="text-align: center">
                <p>Generated controllers</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="accordion">
                    <div class="card">



                        @foreach($metadados as $nameTable=>$table)


                            @if($table["enable"] == "yes")
                                <div id="{{$table->modelName}}" class="collapse" aria-labelledby="headingOne"
                                     data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <table class="table">
                                                <th>Model Name</th>
                                                <th>Model Table</th>
                                                <th>Fields</th>
                                                <th>Function(s) name</th>
                                                </tr>
                                                <tr>
                                                    <th>{{$table->modelName}}</th>
                                                    <th>{{$table->modelTable}}</th>
                                                    <th>{{$table->modelName}}</th>
                                                    <th>{{$table->modelName}}</th>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

