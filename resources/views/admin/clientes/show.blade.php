@extends("scaffolder.views.partials.main")
@section("container")

<div>
    @csrf
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <p>Show Cliente</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
                    <table class="table"><tr>
                    <tr>
                                <th> Id</th>
                                <td> {{$item->id}}</td>
                            </tr>
                    <tr>
                                <th> Nome</th>
                                <td> {{$item->nome}}</td>
                            </tr>
                    <tr>
                                <th> Tipocliente</th>
                                <td> {{$item->tipocliente}}</td>
                            </tr>
                    <tr>
                                <th> Contacto</th>
                                <td> {{$item->contacto}}</td>
                            </tr>
                    <tr>
                                <th> Morada</th>
                                <td> {{$item->morada}}</td>
                            </tr>
                    <tr>
                                <th> Ncontrib</th>
                                <td> {{$item->ncontrib}}</td>
                            </tr>
                    <tr>
                                <th> Codigo</th>
                                <td> {{$item->codigo}}</td>
                            </tr>
                    <tr>
                                <th> Cdpostal</th>
                                <td> {{$item->cdpostal}}</td>
                            </tr>
                    <tr>
                                <th> Local</th>
                                <td> {{$item->local}}</td>
                            </tr>
                    <tr>
                                <th> Email</th>
                                <td> {{$item->email}}</td>
                            </tr>
                    <tr>
                                <th> Ncabeca</th>
                                <td> {{$item->ncabecas}}</td>
                            </tr>
                    <tr>
                                <th> Datacri</th>
                                <td> {{$item->datacri}}</td>
                            </tr>
                    <tr>
                                <th> Created_at</th>
                                <td> {{$item->created_at}}</td>
                            </tr>
                    <tr>
                                <th> Updated_at</th>
                                <td> {{$item->updated_at}}</td>
                            </tr>
                    <tr>
                                <th> Deleted_at</th>
                                <td> {{$item->deleted_at}}</td>
                            </tr></table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
