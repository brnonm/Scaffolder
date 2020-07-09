@extends("scaffolder.views.partials.main")
@section("container")

<div class="card">
    <div class="card-header">
        Show Cliente
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">

                    <tr>
                                <th> Id</th>
                                <td> {{$item->id}}</td></tr>
                    <tr>
                                <th> Nome</th>
                                <td> {{$item->nome}}</td></tr>
                    <tr>
                                <th> Tipocliente</th>
                                <td> {{$item->tipoclienteRel->title??""}}</td></tr>
                    <tr>
                                <th> Contacto</th>
                                <td> {{$item->contacto}}</td></tr>
                    <tr>
                                <th> Morada</th>
                                <td> {{$item->morada}}</td></tr>
                    <tr>
                                <th> Ncontrib</th>
                                <td> {{$item->ncontrib}}</td></tr>
                    <tr>
                                <th> Codigo</th>
                                <td> {{$item->codigoEnum()}}</td></tr>
                    <tr>
                                <th> Cdpostal</th>
                                <td> {{$item->cdpostal}}</td></tr>
                    <tr>
                                <th> Local</th>
                                <td> {{$item->local}}</td></tr>
                    <tr>
                                <th> Email</th>
                                <td> {{$item->email}}</td></tr>
                    <tr>
                                <th> Ncabeca</th>
                                <td> {{$item->ncabecas}}</td></tr>
                    <tr>
                                <th> Datacri</th>
                                <td> {{$item->datacri}}</td></tr>
                    <tr>
                                <th> Created_at</th>
                                <td> {{$item->created_at}}</td></tr>
                    <tr>
                                <th> Updated_at</th>
                                <td> {{$item->updated_at}}</td></tr>
                    <tr>
                                <th> Deleted_at</th>
                                <td> {{$item->deleted_at}}</td></tr>
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
