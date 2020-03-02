@extends("scaffolder.templates.main")
@section("content")
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Gerador de projetos - Parte 1 - Configuração das tabelas e metadados</p>
        </div>
    </div>
    <hr>
    <br>
    <div class="row">

        <div class="col-md-12">

            <div id="accordion">
                <div class="card">
                    <form method="POST" action="{{route("scaffolder.tablesConfigureP1")}}">
                        @csrf
                        @foreach($metadados as $nameTable=>$table)


                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <a class="btn btn-link" data-toggle="collapse" data-target="#{{$nameTable}}"
                                            aria-expanded="true" aria-controls=" {{$nameTable}}">
                                        Tabela {{$nameTable}}
                                    </a>
                                </h5>
                            </div>
                            <div id="{{$nameTable}}" class="collapse" aria-labelledby="headingOne"
                                 data-parent="#accordion">
                                <div class="card-body">

                                    <table class="table">
                                        @foreach($table as $name=>$field)
                                            <tr>
                                                <th>{{$field->Field}}</th>

                                                <td>{{$field->Type}}</td>
                                                <td> {{$field->Null}}</td>
                                                <td> {{$field->Key}}</td>
                                                <td>{{$field->Default}}</td>
                                                <td>  {{$field->Extra}}</td>
                                                <td>
                                                    <select class="form-control" name='{{$name}}-type'>
                                                        <option value="text">Texto</option>
                                                        <option value="number">Numero</option>
                                                        <option value="date">Data</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name='{{$name}}-lenght' placeholder="Tamanho">
                                                </td>
                                            </tr>


                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </form>

                </div>


            </div>
        </div>
    </div>
    <br>
    <input type="submit" value="Avançar" class="btn btn-info col-md-12">

@endsection
