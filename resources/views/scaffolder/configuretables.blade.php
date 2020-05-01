@extends("scaffolder.views.partials.main")
@section("container")


    <div class="row">
        <p>Gerador de projetos - Parte 1 - Configuração das tabelas e metadados</p>
    </div>
    <div class="row">
        <div class="col-2">
            @foreach($metadados as $nameTable=>$table)
                <button style="width: 100%" class="btn btn-sm btn-light"
                        onclick="show({{$nameTable}})">{{$nameTable}}</button>
                <hr style="margin: 5px;">

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

            <form method="POST" action="{{route("install.tablesConfigureP1")}}">
                <div class="row">

                    @csrf
                    @foreach($metadados as $nameTable=>$table)




                        <div class="col-md-10 offset-1 ableToClose" id="{{$nameTable}}" style="display: none">


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
                                            <th>Select</th>
                                            <th>Label</th>
                                            <th>Type</th>
                                            <th>Null</th>
                                            <th>Key</th>
                                            <th>Other</th>
                                            <th>Type</th>
                                            <th>Options</th>
                                            <th>Name</th>
                                        </tr>

                                        <input type="hidden"
                                               name="metadados[{{$nameTable}}][modelTable]"
                                               value="{{$nameTable}}">


                                        @foreach($table as $keyy=>$field)
                                            <tr>
                                                <td>
                                                    <input type="hidden" class="form-control"
                                                           name='metadados[{{$nameTable}}][fields][{{$keyy}}][Null]'
                                                           value="{{$field->Null}}">

                                                    <input type="hidden" class="form-control"
                                                           name='metadados[{{$nameTable}}][fields][{{$keyy}}][display]'
                                                           value="no">
                                                    <input type="checkbox"
                                                           name='metadados[{{$nameTable}}][fields][{{$keyy}}][display]'
                                                           value="yes" checked>

                                                    @if($field->Key != null || $field->Key != "")
                                                        <input type="hidden" class="form-control"
                                                               name='metadados[{{$nameTable}}][fields][{{$keyy}}][Key]'
                                                               value="{{$field->Key}}">
                                                    @else
                                                        <input type="hidden" class="form-control"
                                                               name='metadados[{{$nameTable}}][fields][{{$keyy}}][Key]'
                                                               value="no">
                                                    @endif
                                                </td>
                                                <th>{{$field->Field}}</th>
                                                <td>{{$field->Type}}</td>
                                                <td> {{$field->Null}}</td>
                                                <td> {{$field->Key}}</td>
                                                <td>{{$field->Default}} / {{$field->Extra}}</td>
                                                <td>
                                                    <select class="form-control"
                                                            name='metadados[{{$nameTable}}][fields][{{$keyy}}][type]'>
                                                        <option
                                                            {{ (explode( '(' ,$field->Type)[0] == 'varchar')? 'selected': '' }} value="text">
                                                            Text
                                                        </option>
                                                        <option
                                                            {{ (explode( ' ' ,$field->Type)[0] == 'int')? 'selected': '' }} value="int">
                                                            Integer
                                                        </option>
                                                        <option
                                                            {{ (explode('(',$field->Type)[0] == 'enum')? 'selected': '' }} value="enum">
                                                            Enum
                                                        </option>
                                                        <option
                                                            {{ (explode(' ',$field->Type)[0] == 'timestamp')? 'selected': '' }} value="timestamp">
                                                            Timestamp
                                                        </option>
                                                        <option
                                                            {{ (explode('(',$field->Type)[0] == 'decimal')? 'selected': '' }} value="decimal">
                                                            Decimal
                                                        </option>
                                                        <option
                                                            {{ (explode('(',$field->Type)[0] == 'tinyint')? 'selected': '' }} value="tinyint">
                                                            Tinyint
                                                        </option>
                                                        <option
                                                             value="photo">
                                                            Photo
                                                        </option>


                                                    </select>
                                                </td>
                                                @if(isset($field->options))
                                                    <td>
                                                        <label>View: (adicionar mais)</label>
                                                        <select class="form-control"
                                                                name='metadados[{{$nameTable}}][fields][{{$keyy}}][options][type]'>
                                                            <option value="radio" selected> Radio button</option>

                                                        </select>
                                                    </td>
                                                    <td>
                                                        <label>Enum name:</label>
                                                        <input type="text" class="form-control"
                                                               name='metadados[{{$nameTable}}][fields][{{$keyy}}][name]'
                                                               placeholder="Enum name"
                                                               value="Options">

                                                        @foreach($field->options as $Key =>$value)
                                                            <label>Option: {{$Key}}</label>
                                                            <input type="text" class="form-control"
                                                                   name='metadados[{{$nameTable}}][fields][{{$keyy}}][options][{{$Key}}]'
                                                                   placeholder="{{$value}}"
                                                                   value="{{$value}}">
                                                        @endforeach
                                                    </td>

                                                @else
                                                    <td>


                                                        <input type="number" class="form-control"
                                                               name='metadados[{{$nameTable}}][fields][{{$keyy}}][lenght]'
                                                               placeholder="Tamanho"
                                                               value="{{preg_replace('/[^0-9]/', '',  $field->Type)}}">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control"
                                                               name='metadados[{{$nameTable}}][fields][{{$keyy}}][name]'
                                                               placeholder="Nome"
                                                               value="{{rtrim(ucfirst($field->Field), "s ")}}">
                                                    </td>
                                                @endif

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

