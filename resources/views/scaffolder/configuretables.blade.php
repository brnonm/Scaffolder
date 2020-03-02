@extends("scaffolder.templates.main")
@section("content")
    <div class="row">
        <div class="col-md-12">
            <p>Configurar tabelas</p>
        </div>
    </div>
    <div class="row">

        <div class="col-md-12">

            <div id="accordion">
                <div class="card">
{{dd($metadados)}}
                    @foreach($metadados as $nameTable=>$table)



                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#{{$table->_table}}"
                                        aria-expanded="true" aria-controls=" {{$table->_table}}">
                                    Tabela
                                </button>
                            </h5>
                        </div>
                        @foreach($table as $name=>$field)
                            <div id="{{$field->Field}}" class="collapse" aria-labelledby="headingOne"
                                 data-parent="#accordion">
                                <div class="card-body">
                                    <br>{{$field->Field}}
                                    <br>{{$field->Type}}
                                    <br>{{$field->Null}}
                                    <br>{{$field->Key}}
                                    <br>{{$field->Default}}
                                    <br>{{$field->Extra}}

                                </div>
                            </div>
                        @endforeach
                    @endforeach

                </div>


            </div>
        </div>
    </div>
    <br>
    <input type="button" value="Avançar" class="btn btn-info">

@endsection
