@extends("scaffolder.templates.main")
@section("content")
    <div>
        <div class="row">
            <div class="col-md-12" style="text-align: center">
                <p>Gerador de projetos - Parte 2 - Escolher metodos para os controladores</p>
            </div>
        </div>
        <hr>
        <br>
        <div>
            <form method="POST" action="{{route("scaffolder.tablesConfigureFunction")}} ">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div id="accordion">
                            <div class="card">
                                @foreach($metadados as $nameTable=>$table)
                                    @if($table->enable == "yes")
                                        <div class="card-header" id="headingOne">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h5 class="mb-0">
                                                        <a class="btn btn-link" style="text-decoration: underline"
                                                           data-toggle="collapse" data-target="#{{$nameTable}}"
                                                           aria-expanded="true" aria-controls=" {{$nameTable}}">
                                                            Table {{$nameTable}}
                                                        </a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="{{$nameTable}}" class="collapse" aria-labelledby="headingOne"
                                             data-parent="#accordion">
                                            <div class="card-body">
                                                <table class="table">
                                                    <tr>
                                                        <th>Select</th>
                                                        <th>Function name</th>
                                                        <th>Function (para apagar??)</th>
                                                    </tr>
                                                    @foreach($functions as $funcName=>$funcs)
                                                        @if($funcName == "controller")
                                                            @foreach($funcs as $fname=>$func)
                                                                @if($fname != "header")
                                                                    <tr>
                                                                        <th>
                                                                            <input type="checkbox"
                                                                                   name='metadados[{{$nameTable}}][functions][{{$fname}}][enable]'
                                                                                   value="yes">
                                                                        </th>
                                                                        <td>{{ucfirst($fname)}}</td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <input type="submit" value="Avançar" class="btn btn-info col-md-12">
            </form>
        </div>
    </div>
@endsection

