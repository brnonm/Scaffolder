@extends("scaffolder.views.partials.main")
@section("container")

<div class="card">
    <div class="card-header">
        Show Candidatura
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                
                    <tr>
                                <th> Id</th>
                                <td> {{$item->id}}</td></tr>
                    <tr>
                                <th> Curso</th>
                                <td> {{$item->curso}}</td></tr>
                    <tr>
                                <th> Nome</th>
                                <td> {{$item->nome}}</td></tr>
                    <tr>
                                <th> Email</th>
                                <td> {{$item->email}}</td></tr>
                    <tr>
                                <th> Telefone1</th>
                                <td> {{$item->telefone1}}</td></tr>
                    <tr>
                                <th> Telefone2</th>
                                <td> {{$item->telefone2}}</td></tr>
                    <tr>
                                <th> Genero</th>
                                <td> {{$item->generoEnum()}}</td></tr>
                    <tr>
                                <th> Media</th>
                                <td> {{$item->media}}</td></tr>
                    <tr>
                                <th> M23</th>
                                <td> {{$item->m23}}</td></tr>
                    <tr>
                                <th> Origem</th>
                                <td> {{$item->origemEnum()}}</td></tr>
                    <tr>
                                <th> Ob</th>
                                <td> {{$item->obs}}</td></tr>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                Back
            </a>
        </div>

        <nav class="mb-3">
            <div class="nav nav-tabs">

            </div>
        </nav>
        <div class="tab-content">

        </div>
    </div>
</div>
@endsection
