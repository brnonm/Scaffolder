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

                        @foreach($json as $field=>$jsOB)
                            @if(isset($jsOB->enable) == 'yes')



                                <div id="{{$field}}" class="collapse" aria-labelledby="headingOne"
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
                                                    <th>{{$jsOB->modelName}}</th>
                                                    <th>{{$jsOB->modelTable}}</th>
                                                    <th>{{$jsOB->modelName}}</th>
                                                    <th>{{$jsOB->modelName}}</th>
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

