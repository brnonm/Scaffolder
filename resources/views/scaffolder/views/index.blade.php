@extends("scaffolder.views.partials.main")
@section("container")

    <div class="row">
        <h2></h2>
    </div>
    <div class="row">

        <table>
            @foreach($items as $i)
                <tr>
                    @foreach($i::$fill)
            <td>{{$i->user_id}}</td>
                </tr>
            @endforeach
        </table>
    </div>
    </div>


@endsection
