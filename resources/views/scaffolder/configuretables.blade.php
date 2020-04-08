@extends("scaffolder.views.partials.main")
@section("container")


    <div class="row">
        <p>Gerador de projetos - Parte 1 - Configuração das tabelas e metadados</p>
    </div>
    <div class="row">
        <div class="col-md-12" style="width: 100%">

            <form method="POST" action="{{route("scaffolder.tablesConfigureP1")}}">
                <div class="row">
                    <div class="col-md-12">
                        <div id="accordion">
                            <div class="card">
                                @csrf
                                @foreach($metadados as $nameTable=>$table)
                                    <div class="card-header" id="headingOne">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h5 class="mb-0">
                                                    <a class="btn btn-link" style="text-decoration: underline"
                                                       data-toggle="collapse" data-target="#{{$nameTable}}"
                                                       aria-expanded="true" aria-controls=" {{$nameTable}}">
                                                        Table "{{$nameTable}}"
                                                    </a>
                                                </h5>
                                            </div>
                                            <div class="mb-auto">
                                                Include:
                                                <input type="hidden" value="no"
                                                       name="metadados[{{$nameTable}}][enable]">
                                                <input type="checkbox" name="metadados[{{$nameTable}}][enable]"
                                                       data-toggle="toggle"
                                                       value="yes" data-on="Sim" data-off="Não">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="{{$nameTable}}" class="collapse" aria-labelledby="headingOne"
                                         data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    Nome da classe:
                                                    <input type="text" id="checkField"
                                                           name="metadados[{{$nameTable}}][modelName]"
                                                           class="form-control"
                                                           value="{{rtrim(ucfirst($nameTable), "s ")}}">
                                                    <br><br>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
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
                                                            <!--
                                                        <th>

                                                            <input type="checkbox" class="option"
                                                                   name='metadados[{{$nameTable}}][fields][{{$keyy}}][enable]'
                                                                   value="yes">
                                                        </th>
                                                        -->
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
                                    </div>
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

