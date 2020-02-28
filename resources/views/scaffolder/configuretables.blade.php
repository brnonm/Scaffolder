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
                @foreach($tables as $table)

                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#{{$table->$db}}" aria-expanded="true" aria-controls="{{$table->$db}}">
                                        Configurar Tabela {{$table->$db}}
                                    </button>
                                </h5>
                            </div>

                            <div id="{{$table->$db}}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    {{$table->$db}}
                                </div>
                            </div>
                        </div>


            @endforeach
            </div>
        </div>
    </div>
    <br>
    <input type="button" value="Avançar" class="btn btn-info">

@endsection
