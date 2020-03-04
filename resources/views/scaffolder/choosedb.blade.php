@extends("scaffolder.views.partials.main")
@section("container")

    <div class="row">
    <h2>Selecionar Base de Dados</h2>
    </div>
    <div class="row">


    <form action="{{route("scaffolder.getSchemaDB")}}" method="get">



            <select class="form-control" name="db">
                @foreach($dbs as $db)

                    <option value="{{$db->Database}}">{{$db->Database}}</option>
                @endforeach
            </select>



    <br>
    <input type="submit" value="Avançar" class="btn btn-info">
    </form>
    </div>
    </div>

@endsection
