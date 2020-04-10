@extends("scaffolder.views.partials.main")
@section("container")

    @csrf
    <div>
        {{$error}}
    </div>

@endsection

