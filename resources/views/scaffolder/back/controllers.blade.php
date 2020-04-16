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
                            @if(isset($table["enable"]))

                                @if($table["enable"] == "yes")

                                    <div class="card-header" id="headingOne">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h5 class="mb-0">
                                                    <a class="btn btn-link" style="text-decoration: underline"
                                                       data-toggle="collapse" data-target="#{{$table["modelName"]}}"
                                                       aria-expanded="true" aria-controls=" {{$table["modelName"]}}">
                                                        Table {{$table["modelName"]}}
                                                    </a>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="{{$table["modelName"]}}" class="collapse show" aria-labelledby="headingOne"
                                         data-parent="#accordion">
                                        <div class="card-body">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table class="table">
                                                        <th>Model Name</th>
                                                        <th>Model Table</th>
                                                        <th>Fields</th>
                                                        <th>Function(s) name</th>
                                                        </tr>
                                                        <tr>
                                                            <th>{{$table["modelName"]}}</th>
                                                            <th>{{$table["modelTable"]}}</th>

                                                            <th>
                                                                @foreach($table["fields"] as $name=>$field)
                                                                    {{$name}}
                                                                    @if(!$loop->last)
                                                                        {{","}}
                                                                    @endif
                                                                @endforeach
                                                            </th>
                                                            <th>
                                                                @foreach($table["functions"] as $name=>$function)
                                                                    @if($function["enable"] == "yes")
                                                                        {{$name}}
                                                                        @if(!$loop->last)
                                                                            {{","}}
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            </th>

                                                        </tr>
                                                    </table>
                                                </div>
                                                <table class="table">
                                                    <th>Model Name</th>
                                                    <th>Database Table</th>
                                                    <th>Fields</th>
                                                    <th>Function(s) name</th>
                                                    </tr>
                                                    <tr>
                                                        <td>{{$table["modelName"]}}</td>
                                                        <td>{{$table["modelTable"]}}</td>

                                                        <td>
                                                            @foreach($table["fields"] as $name=>$field)
                                                                {{$name}}
                                                                @if(!$loop->last)
                                                                    {{","}}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($table["functions"] as $name=>$function)
                                                                {{$name}}
                                                                @if(!$loop->last)
                                                                    {{","}}
                                                                @endif
                                                            @endforeach
                                                        </td>

                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

