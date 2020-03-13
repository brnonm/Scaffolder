@extends("scaffolder.templates.main")
@section("content")
    <div class="row">
        <div class="col-md-12">
            <p>Escolher a BD</p>
        </div>
    </div>
    <form action="{{route("scaffolder.getSchemaDB")}}" method="get">
        <div class="row">
            <div class="col-md-4">
                <select class="form-control" name="db">

                    @foreach($dbs as $db)
                        @if($db->Database != "sys" && $db->Database != "mysql" && $db->Database != "information_schema" && $db->Database != "performance_schema" )
                            <option value="{{$db->Database}}">{{$db->Database}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <br>
        <input type="submit" value="Avançar" class="btn btn-info">
    </form>

@endsection
