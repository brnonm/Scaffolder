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
                        @foreach($table as $name=>$field)

                                    {{$field->Field}}
                                    {{$field->Type}}
                                    {{$field->Null}}
                                    {{$field->Key}}
                                    {{$field->Default}}
                                    {{$field->Extra}}
                            <br>


                        @endforeach
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
