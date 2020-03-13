@extends("scaffolder.templates.main")
@section("content")
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Gerador de projetos - Parte 2 - Escolher metodos para os controladores</p>
        </div>
    </div>
    <hr>
    <br>
    <div>


        <form method="POST" action="">
            <div class="row">
                <div class="col-md-12">
                    <div id="accordion">
                        <div class="card">
                            @csrf
                            @foreach($metadados as $nameTable=>$table)
                                @if($table->enable == "yes")
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
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table">
                                                <tr>
                                                    <th>Function Name</th>

                                                    <th></th>

                                                </tr>

                                                <!-- Obter as funcoes do json -->
                                            </table>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <input type="submit" value="Avançar" class="btn btn-info col-md-12">
        </form>


    </div>

@endsection

