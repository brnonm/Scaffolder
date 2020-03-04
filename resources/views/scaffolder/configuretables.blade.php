@extends("scaffolder.templates.main")
@section("content")
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Gerador de projetos - Parte 1 - Configuração das tabelas e metadados</p>
        </div>
    </div>
    <hr>
    <br>
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
                                                Tabela {{$nameTable}}
                                            </a>


                                        </h5>
                                    </div>
                                    <div class="col-md-4">
                                        Incluir no projeto:
                                        <input type="hidden" value="no" name="metadados[{{$nameTable}}][enable]">
                                        <input type="checkbox" name="metadados[{{$nameTable}}][enable]"  data-toggle="toggle"
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
                                            <input type="text" name="metadados[{{$nameTable}}][modelName]" class="form-control" value="{{rtrim(ucfirst($nameTable), "s ")}}">
                                            <br><br>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table">
                                                <tr>
                                                    <th>Campo</th>
                                                    <th>Tipo</th>
                                                    <th> Nulo?</th>
                                                    <th> Chave</th>
                                                    <th>Outros</th>
                                                    <th>Ações</th>
                                                    <th></th>
                                                </tr>
                                                <input type="hidden" name="metadados[{{$nameTable}}][modelTable]" value="{{$nameTable}}">
                                                @foreach($table as $keyy=>$field)
                                                    <tr>
                                                        <th>{{$field->Field}}</th>
                                                        <td>{{$field->Type}}</td>
                                                        <td> {{$field->Null}}</td>
                                                        <td> {{$field->Key}}</td>
                                                        <td>{{$field->Default}} / {{$field->Extra}}</td>


                                                        <td>
                                                            <select class="form-control" name='metadados[{{$nameTable}}][fields][{{$keyy}}][type]'>
                                                                <option value="text">Texto</option>
                                                                <option value="number">Numero</option>
                                                                <option value="date">Data</option>
                                                            </select>
                                                        </td>
                                                        <td>

                                                            <input type="number" class="form-control"
                                                                   name='metadados[{{$nameTable}}][fields][{{$keyy}}][lenght]'
                                                                   placeholder="Tamanho" value="{{preg_replace('/[^0-9]/', '',  $field->Type)}}">
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


@endsection
