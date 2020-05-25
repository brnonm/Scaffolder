@extends("scaffolder.views.partials.main")
@section("container")

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <div class="row">
        <p>Project Generator - Part 1  - Configuration of tables and metadata</p>

    </div>
    <div class="row">
        <div class="col-2">
            @foreach($metadados as $nameTable=>$table)
                <button style="width: 100%" class="btn btn-sm  @if($loop->index==0) btn-info  @else btn-light @endif"
                        onclick="show({{$nameTable}})" id="{{$nameTable}}_btn">{{$nameTable}}</button>
                <hr style="margin: 5px;">

            @endforeach
        </div>
        <script>
            function show(text) {
                var qwe = document.getElementsByClassName("ableToClose");
                Array.prototype.forEach.call(qwe, function (el) {
                    el.style.display = "none";
                });
                var btn = document.getElementById(text.id+"_btn");
                if(!(btn.classList.contains("btn-success"))){
                    btn.classList.remove("btn-light");
                    btn.classList.add("btn-info");
                }
                text.style.display = "block";
            }

            function configureClick(name) {
                    var btn = document.getElementById(name.id+"_btn");
                    btn.classList.remove("btn-light");
                    btn.classList.add("btn-success");
                    var type = document.getElementById(name.id+"_type");
                    switch (type.value) {
                        case "int":
                        case "text":
                            var btn = document.getElementById(name.id+"_text");
                            btn.style.display="block";
                            var btn = document.getElementById(name.id+"_select");
                            btn.style.display="none";
                            break;
                        case "select":
                            var btn = document.getElementById(name.id+"_text");
                            btn.style.display="none";
                            var btn = document.getElementById(name.id+"_select");
                            btn.style.display="block";
                            break;
                        default:
                            var btn = document.getElementById(name.id+"_text");
                            btn.style.display="none";
                            var btn = document.getElementById(name.id+"_select");
                            btn.style.display="none";
                        break;
                    }




            }

            function changeColorGreen(name) {

                var btn = document.getElementById(name.id+"_btn");
                if(!(btn.classList.contains("btn-success"))){
                    btn.classList.remove("btn-info");
                    btn.classList.add("btn-success");
                }else{
                    btn.classList.add("btn-info");
                    btn.classList.remove("btn-success");
                }


            }

        </script>
        <div class="col-10">

            <form method="POST" action="{{route("install.tablesConfigureP1")}}">
                <div class="row">

                    @csrf
                    @foreach($metadados as $nameTable=>$table)




                        <div class="col-md-10 offset-1 ableToClose" id="{{$nameTable}}" @if($loop->index!=0) style="display: none;" @endif>



                            <div class="form-group row">


                                <label for="inputPassword" class="col-sm-2 col-form-label">Name of Class</label>
                                <div class="col-sm-10">
                                    <input type="text" id="checkField"
                                           name="metadados[{{$nameTable}}][modelName]"
                                           class="form-control input-sm"
                                           value="{{rtrim(ucfirst($nameTable), "s ")}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Include in Project</label>
                                <div class="col-sm-10">
                                    <input type="hidden" value="no"
                                           name="metadados[{{$nameTable}}][enable]">

                                    <input type="checkbox" name="metadados[{{$nameTable}}][enable]"
                                           data-toggle="toggle" style="border:  border: 5px solid red;" onchange="changeColorGreen({{$nameTable}})"
                                           value="yes" data-on="Yes" data-off="No">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Field Configuration</label>
                                <div class="col-sm-10">

                                    <table class="table">
                                        <tr>
                                            <!--<th>Select</th>-->
                                            <th>Label</th>
                                            <th>Type</th>
                                            <th>Null</th>
                                            <th>Key</th>
                                            <th>Other</th>
                                            <th>Type</th>
                                            <th></th>

                                        </tr>

                                        <input type="hidden"
                                               name="metadados[{{$nameTable}}][modelTable]"
                                               value="{{$nameTable}}">


                                        @foreach($table as $keyy=>$field)
                                            <tr>
                                                <th>{{$field->Field}}</th>
                                                <td>{{$field->Type}}</td>
                                                <td> {{$field->Null}}</td>
                                                <td> {{$field->Key}}</td>
                                                <td>{{$field->Default}} / {{$field->Extra}}</td>
                                                <td>
                                                    <select class="form-control"
                                                            name='metadados[{{$nameTable}}][fields][{{$keyy}}][type]' id="{{$nameTable}}{{$keyy}}_type">
                                                        <option
                                                            {{ (explode( '(' ,$field->Type)[0] == 'varchar')? 'selected': '' }} value="text">
                                                            Text
                                                        </option>
                                                        <option
                                                            {{ (explode( ' ' ,$field->Type)[0] == 'int')? 'selected': '' }} value="int">
                                                            Integer
                                                        </option>
                                                        <option
                                                            {{ (explode('(',$field->Type)[0] == 'enum')? 'selected': '' }} value="select">
                                                            Select
                                                        </option>
                                                        <option
                                                            {{ (explode(' ',$field->Type)[0] == 'timestamp')? 'selected': '' }} value="timestamp">
                                                            Timestamp
                                                        </option>
                                                        <option
                                                            {{ (explode('(',$field->Type)[0] == 'decimal')? 'selected': '' }} value="decimal">
                                                            Decimal
                                                        </option>


                                                    </select>
                                                </td>

                                                <td class="changecolor">
                                                    <button type="button"  class="btn btn-sm btn-light" onclick="configureClick({{$nameTable.$keyy}})" id="{{$nameTable.$keyy}}_btn" data-toggle="modal" data-target="#{{$nameTable.$keyy}}">Configure</button>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="{{$nameTable.$keyy}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="top: 20%; border-right: 20%;" >
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">{{$keyy}} - Configuration</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">


                                                            <div class="row">

                                                                <div class="col-md-12">


                                                                    <div id="{{$nameTable.$keyy}}_text" style="display: none;">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Field Name</label>
                                                                        <input type="text" class="form-control"
                                                                               name='metadados[{{$nameTable}}][fields][{{$keyy}}][name]'
                                                                               placeholder="Nome"
                                                                               value="{{rtrim(ucfirst($field->Field), "s ")}}">
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Lenght</label>
                                                                        <input type="number" class="form-control"
                                                                               name='metadados[{{$nameTable}}][fields][{{$keyy}}][lenght]'
                                                                               placeholder="255"
                                                                               value="{{preg_replace('/[^0-9]/', '',  $field->Type)}}">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Show in project</label>
                                                                        <input type="hidden" class="form-control"
                                                                               name='metadados[{{$nameTable}}][fields][{{$keyy}}][display]'
                                                                               value="no">
                                                                        <input type="checkbox"
                                                                               name='metadados[{{$nameTable}}][fields][{{$keyy}}][display]'
                                                                               value="yes" checked>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Required</label>
                                                                        <input type="hidden" class="form-control"
                                                                               name='metadados[{{$nameTable}}][fields][{{$keyy}}][required]'
                                                                               value="no">
                                                                        <input type="checkbox"
                                                                               name='metadados[{{$nameTable}}][fields][{{$keyy}}][required]' onchange="changeColorGreen({{$nameTable.$keyy}})"
                                                                               value="yes" checked>
                                                                    </div>


                                                                    </div>
                                                                    <div id="{{$nameTable.$keyy}}_select" style="display: none;">
                                                                        <select class="form-control"
                                                                                name='metadados[{{$nameTable}}][fields][{{$keyy}}][select][type]'>
                                                                            <option value="select">
                                                                                Enum (DB)
                                                                            </option>
                                                                            <option value="custom">
                                                                                Custom Select
                                                                            </option>
                                                                            <option value="relation">
                                                                                Relation
                                                                            </option>


                                                                        </select>
                                                                    </div>


                                                                </div>




                                                                @if($field->Key != null || $field->Key != '')
                                                                    <input type="hidden" class="form-control"
                                                                           name='metadados[{{$nameTable}}][fields][{{$keyy}}][Key]'
                                                                           value="{{$field->Key}}">
                                                                @else
                                                                    <input type="hidden" class="form-control"
                                                                           name='metadados[{{$nameTable}}][fields][{{$keyy}}][Key]'
                                                                           value="no">
                                                                @endif


                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Save and Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        @endforeach
                                    </table>


                                </div>
                            </div>

                        </div>





                    @endforeach


                </div>
                <br>
                <input type="submit" value="Avançar" class="btn btn-info col-md-12">
            </form>
        </div>
    </div>
    <style>
        .modal-backdrop{
            display: none;
        }
        .toggle-off.btn {
            border: 1px solid grey;
        }

    </style>
@endsection

