@extends("scaffolder.views.partials.main")
@section("container")


    <div class="row">
        <p>Gerador de projetos - Parte 1 - Configuração das tabelas e metadados</p>
    </div>
    <div class="row">
        <div class="col-2">
            @foreach($metadados as $nameTable=>$table)
                <button style="width: 100%" class="btn btn-sm btn-light" onclick="show({{$nameTable}})">{{$nameTable}}</button><hr style="margin: 5px;" >

            @endforeach
        </div>
        <script>
            function show(text){
                var qwe = document.getElementsByClassName("ableToClose");
                Array.prototype.forEach.call(qwe, function(el) {
                    el.style.display="none";
                });

                text.style.display = "block";
            }

        </script>
        <div class="col-10" >

            <form method="POST" action="{{route("scaffolder.tablesConfigureP1")}}">
                <div class="row">

                                @csrf
                                @foreach($metadados as $nameTable=>$table)




                                    <div class="col-md-10 offset-1 ableToClose"  id="{{$nameTable}}" style="display: none">


                                        <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-2 col-form-label">Name of Class</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="checkField"
                                                       name="metadados[{{$nameTable}}][modelName]"
                                                       class="form-control input-sm"
                                                       value="{{rtrim(ucfirst($nameTable), "s ")}}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-2 col-form-label">Include in Project</label>
                                            <div class="col-sm-10">
                                                <input type="hidden" value="no"
                                                       name="metadados[{{$nameTable}}][enable]">
                                                <input type="checkbox" name="metadados[{{$nameTable}}][enable]"
                                                       data-toggle="toggle"
                                                       value="yes" data-on="Sim" data-off="Não">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-2 col-form-label">Field Configuration</label>
                                            <div class="col-sm-10">





                                                        <table class="table">
                                                            <tr>
                                                                <!--<th>Select</th>-->
                                                                <th>Label</th>
                                                                <th>Type</th>
                                                                <th>Null</th>
                                                                <th>Key</th>
                                                                <th>Other</th>
                                                                <th>Actions</th>
                                                                <th></th>
                                                            </tr>

                                                            <input type="hidden"
                                                                   name="metadados[{{$nameTable}}][modelTable]"
                                                                   value="{{$nameTable}}">


                                                            @foreach($table as $keyy=>$field)
                                                                <tr>
                                                                    <th>{{$field->Field}}</th>
                                                                    <td>{{$field->Type}}</td>
                                                                    <td> {{$field->Null}}</td>
                                                                    <td> {{$field->Key}}</td>
                                                                    <td>{{$field->Default}} / {{$field->Extra}}</td>
                                                                    <td>
                                                                        <select class="form-control"
                                                                                name='metadados[{{$nameTable}}][fields][{{$keyy}}][type]'>
                                                                            <option value="text">Texto</option>
                                                                            <option value="number">Numero</option>
                                                                            <option value="date">Data</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>


                                                                        <input type="number" class="form-control"
                                                                               name='metadados[{{$nameTable}}][fields][{{$keyy}}][lenght]'
                                                                               placeholder="Tamanho"
                                                                               value="{{preg_replace('/[^0-9]/', '',  $field->Type)}}">
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </table>


                                            </div>
                                        </div>

                                    </div>





                                @endforeach



                </div>
                <br>
                <input type="submit" value="Avançar" class="btn btn-info col-md-12">
            </form>
        </div>
    </div>
@endsection

