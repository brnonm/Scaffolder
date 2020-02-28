@extends("scaffolder.templates.main")
@section("content")
    <div class="row">
        <div class="col-md-12">
            <p>Configurar tabelas</p>
        </div>
    </div>
    <div class="row">

        <div class="col-md-4">
            <select class="form-control">

                @foreach($tables as $table)

                    <option>{{$table->$db}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <br>
    <input type="button" value="Avançar" class="btn btn-info">

@endsection
