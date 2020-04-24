@extends("scaffolder.views.partials.main")
@section("container")


    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Gerador de projetos - Parte 2 - Escolher metodos para os controladores</p>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-2">
            @foreach($metadados as $nameTable=>$table)
                @if($table->enable == "yes")
                    <button style="width: 100%" class="btn btn-sm btn-light"
                            onclick="show({{$nameTable}})">{{$nameTable}}</button>
                    <hr style="margin: 5px;">
                @endif
            @endforeach
        </div>
        <script>
            function show(text) {
                var qwe = document.getElementsByClassName("ableToClose");
                Array.prototype.forEach.call(qwe, function (el) {
                    el.style.display = "none";
                });

                text.style.display = "block";
            }

        </script>
        <div class="col-10">

            <form method="POST" action="{{route("install.tablesConfigureFunction")}} ">
                @csrf
                @foreach($metadados as $nameTable=>$table)
                    @if($table->enable == "yes")

                        <div id="{{$nameTable}}" class="ableToClose" style="display: none">
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">{{$nameTable}}</label>
                                <div class="col-sm-10">

                                    <table class="table">
                                        <tr>
                                            <th>Select</th>
                                            <th>Function name</th>

                                        </tr>

                                        @foreach($functions as $func)
                                            @if($func['filename'] != "header")

                                                <tr>
                                                    <th>

                                                        @if($func['filename'] =="index")
                                                            <input type="checkbox"
                                                                   name="metadados[{{$nameTable}}][functions][{{$func['filename']}}][enable]"
                                                                   value="yes" checked disabled>
                                                            <input type="hidden"
                                                                   name="metadados[{{$nameTable}}][functions][{{$func['filename']}}][enable]"
                                                                   value="yes">
                                                        @else

                                                            <input type="hidden"
                                                                   name="metadados[{{$nameTable}}][functions][{{$func['filename']}}][enable]"
                                                                   value="no">
                                                            <input type="checkbox"
                                                                   name="metadados[{{$nameTable}}][functions][{{$func['filename']}}][enable]"
                                                                   value="yes" checked>
                                                        @endif
                                                    </th>
                                                    <td>{{ucfirst($func['filename'])}}</td>

                                                </tr>
                                            @endif
                                        @endforeach

                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach


                <input type="submit" value="Next" class="btn btn-info col-md-12">
            </form>

        </div>
    </div>

@endsection

