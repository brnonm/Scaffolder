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

                    @foreach($metadados as $nameTable=>$table)


                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#{{$nameTable}}"
                                        aria-expanded="true" aria-controls=" {{$nameTable}}">
                                    Tabela {{$nameTable}}
                                </button>
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
        <select class="form-control">
            <option>Texto</option>
            <option>Numero</option>
            <option>Data</option>
        </select>
    </td>
    <td>
       <input type="number" placeholder="Tamanho">
    </td>
</tr>


                        @endforeach
                                </table>
                            </div>
                        </div>
                    @endforeach

                </div>


            </div>
        </div>
    </div>
    <br>
    <input type="button" value="Avançar" class="btn btn-info">

@endsection
