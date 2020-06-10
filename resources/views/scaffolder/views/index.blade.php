@extends("scaffolder.views.partials.main")
@section("container")

    <div class="row">
        <h2></h2>
    </div>
    <div class="row">
<<<<<<< Updated upstream
        <table>
            @foreach($items as $i)
                <tr>
                    <td>{{$i->user_id}}</td>
=======

        <table>
            @foreach($items as $i)
                <tr>
                    @foreach($i::$fill)
            <td>{{$i->user_id}}</td>
>>>>>>> Stashed changes
                </tr>
            @endforeach
        </table>
    </div>
    </div>


@endsection
