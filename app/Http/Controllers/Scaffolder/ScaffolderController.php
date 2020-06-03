<?php

namespace App\Http\Controllers\Scaffolder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class ScaffolderController extends Controller
{
    public function selectView()
    {

        $url = base_path('app/Http/Controllers/Scaffolder/data/metadados.json');
        if (!File::exists($url)) {
            return redirect()->route("install.indexChooseDB");
        } else {
            $metadados = File::get($url);
            if (strpos($metadados, '"generated": "yes"') == true) {
                return redirect()->route("scaffolder.controller");
            } else {
                return redirect()->route("install.indexChooseDB");
            }
        }
    }


    public function backofficeController()
    {
        $url = base_path('app/Http/Controllers/Scaffolder/data/metadados.json');
        if (File::exists($url)) {
            $json = File::get($url);
            $metadados = collect(json_decode($json, true));
            return view("scaffolder.back.controllers", compact("metadados"));
        } else {
            $this->errorPage("metadados.jsomn does not find!");
        }

    }

    public function indexChooseDB()
    {
        $dbs = DB::select(DB::raw("SHOW DATABASES"));

        return view("scaffolder.choosedb", compact("dbs"));
    }

    public function getSchemaDB(Request $request)
    {
        $tables = DB::select(DB::raw("SELECT TABLE_NAME AS _table FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$request->db'"));
        foreach ($tables as $key => $table) {
            $t = $table->_table;
            $columns = DB::select(DB::raw("show fields from " . $t));
            $atr = [];
            foreach ($columns as $column) {
                $f = $column->Field;
                $atr[$f] = $column;
            }
            $metadados[$t] = $atr;
        }

        //se for um enum
        foreach ($metadados as $modelName => $models) {
            foreach ($models as $fieldName => $field) {
                if (strstr($field->Type, 'enum')) {
                    $str = $field->Type;
                    $str = explode("'", $str);
                    $values = array();

                    for ($i = 1; $i < sizeof($str); $i = $i + 2) {
                        $values[$str[$i]] = $str[$i];

                    }

                    $metadados[$modelName][$fieldName] = (object)array_merge(
                        (array)$metadados[$modelName][$fieldName], (array)['options' => $values]);

                }
            }
        }


        return view("scaffolder.configuretables", compact("metadados"));
    }

    public function tablesConfigureP1Post(Request $request)
    {

        $urlFolder = base_path('app/Http/Controllers/Scaffolder/data/templates/function');
        $json = json_encode($request->except('_token'), JSON_PRETTY_PRINT);
        file_put_contents(base_path('app/Http/Controllers/Scaffolder/data/metadados.json'), stripslashes($json));
        $metadados = collect(json_decode($json));
        $metadados = collect($metadados->first());


        if (!File::exists($urlFolder)) {
            $this->errorPage("File with generic functions does not find!");
        } else {

            $functions = $this->readTemplatesFunction();
            return view("scaffolder.configureTableController", compact("metadados", "functions"));
        }

    }

    public function tablesConfigureFuncPost(Request $request)
    {
        $baseJson = File::get(base_path('app/Http/Controllers/Scaffolder/data/metadados.json'));
        $baseJson = collect(json_decode($baseJson));
        $baseJson = collect($baseJson->first());

        $newJson = json_encode($request->except('_token'), JSON_PRETTY_PRINT);
        $newJson = collect(json_decode($newJson));
        $newJson = collect($newJson->first());


        $json = $this->joinJson($baseJson, $newJson);

        $this->createByJsonObject($json);
        $this->createMenuBackOffice($json);
        $this->generateView($json);

        file_put_contents(base_path('app/Http/Controllers/Scaffolder/data/metadados.json'), json_encode($baseJson, JSON_PRETTY_PRINT));

        return redirect()->route("scaffolder.controller");
    }

    private function joinJson($baseJson, $newJson)
    {
        foreach ($baseJson as $jName => $j) {
            foreach ($newJson as $nName => $n) {
                if ($jName === $nName) {
                    $baseJson->mergeRecursive([$jName => $n]);
                }
            }
        }
        $baseJson->put("generated", "no");

        return $baseJson;
    }

    private function generateView($metadadosModel)
    {
        $baseViews = base_path("resources/views/admin/");

        foreach ($metadadosModel as $key => $value) {
            if (isset($value->enable)) {
                if ($value->enable == "yes") {
                    foreach ($value->functions as $name => $func) {
                        if (isset($func->enable) && $func->enable == "yes") {
                            $basedirectory = $baseViews . $key;
                            switch ($name) {
                                case "create":
                                    $contentView = File::get(base_path("app/Http/Controllers/Scaffolder/data/templates/view/create.php"));
                                    $this->createDir($basedirectory);
                                    $view = fopen($basedirectory . "/create.blade.php", "w") or die("Unable to open file!");
                                    $contentView = $this->changeView($contentView, $value);
                                    fwrite($view, $contentView);
                                    fclose($view);
                                    break;
                                case "index":
                                    $contentView = File::get(base_path("app/Http/Controllers/Scaffolder/data/templates/view/index.php"));
                                    $this->createDir($basedirectory);
                                    $view = fopen($basedirectory . "/index.blade.php", "w") or die("Unable to open file!");

                                    $contentView = $this->changeView($contentView, $value);

                                    fwrite($view, $contentView);
                                    fclose($view);
                                    break;
                                case "show":
                                    $contentView = File::get(base_path("app/Http/Controllers/Scaffolder/data/templates/view/show.php"));
                                    $this->createDir($basedirectory);
                                    $view = fopen($basedirectory . "/show.blade.php", "w") or die("Unable to open file!");
                                    $contentView = $this->changeView($contentView, $value);
                                    fwrite($view, $contentView);
                                    fclose($view);
                                    break;
                                case "update":
                                    $contentView = File::get(base_path("app/Http/Controllers/Scaffolder/data/templates/view/update.php"));
                                    $this->createDir($basedirectory);
                                    $view = fopen($basedirectory . "/update.blade.php", "w") or die("Unable to open file!");
                                    $contentView = $this->changeView($contentView, $value);
                                    fwrite($view, $contentView);
                                    fclose($view);
                                    break;
                                default:
                                    $this->errorPage("View dont exist.");
                                    break;
                            }
                        }
                    }
                }
            }
        }
    }

    private function changeView($contentView, $value)
    {
        //Views
        $contentView = str_replace([':$modelName'], $value->modelName, $contentView);


        //table
        $contentView = str_replace([':$fieldName'], $this->getFieldName($value), $contentView);
        $contentView = str_replace([':$fieldButton'], "<td>Actions</td>", $contentView);
        $contentView = str_replace([':$fieldObject'], $this->getFieldNameObject($value), $contentView);
        $contentView = str_replace([':$ButtonAction'], $this->getButtonAction($value), $contentView);
        $contentView = str_replace([':$navLink'], "{{ \$items->links()}}", $contentView);


        //Routes
        $contentView = str_replace([':$routeCreate'], "\"{{ route('$value->modelTable.create') }}\"", $contentView);
        $contentView = str_replace([':$routeUpdate'], "\"{{ route('$value->modelTable.update', " . '$item->id' . ") }}\"", $contentView);
        $contentView = str_replace([':$routeShow'], "\"{{ route('$value->modelTable.show', " . '$item->id' . ") }}\"", $contentView);
        $contentView = str_replace([':$routeDestroy'], "\"{{ route('$value->modelTable.destroy', " . '$item->id' . ") }}\"", $contentView);
        $contentView = str_replace([':$routeStore'], "\"{{ route('$value->modelTable.store') }}\"", $contentView);

        //Fields manipulation

        $contentView = str_replace([':$fieldInput'], $this->getFieldInput($value), $contentView);
        $contentView = str_replace([':$fieldShow'], $this->getFieldShow($value), $contentView);
        $contentView = str_replace([':$fieldUpdate'], $this->getFieldUpdate($value), $contentView);

        return $contentView;
    }

    private function getFieldUpdate($value)
    {
        $content = "";

        foreach ($value->fields as $name => $m) {
            $content .= "
                    <tr>
                                <th> $m->name</th>";

            if ($m->Key != 'no') {
                $showOP = 'disabled';
            } else {
                $showOP = '';
            }

            switch ($m->type) {
                case "text":
                    $content .= "<td><input $showOP type=\"text\" name=\"$name\" value=\"{{\$item->$name}}\"></td>";
                    break;
                case "int":
                    $content .= "<td><input $showOP  type=\"number\" name=\"$name\" value=\"{{\$item->$name}}\"></td>";
                    break;
                case "image":
                    $content .= "<td><input $showOP type=\"image\" name=\"$name\" value=\"{{\$item->$name}}\"></td>";
                    break;
                case "date":
                    $content .= "<td><input $showOP type=\"date\" name=\"$name\" value=\"{{\$item->$name}}\"></td>";
                    break;
                case "enum":
                    if (isset($m->options)) {
                        $content .= "<td>";
                        foreach ($m->options as $key => $value) {
                            if ($key != "type") {
                                $content .= "<input type=" . $m->options->type . " name=\"$name\"  value=" . $key . " {{( \$item->$name == '$key')? 'checked': '' }}>";
                                $content .= "    <label>$value</label>";
                                $content .= "<br>";
                                $content .= "\n";
                            }
                        }
                        $content .= "</td>";
                    }

                break;

                case "select":








                    if($m->select->type=="relation"){


                        $content.="\n";
                        $content.="                    <td>";
                        $content.="\n";
                        $content.='                                <select name="'.$name.'" class="form-control">';
                        $content.="\n";
                        $content.='                                 @foreach($item::$'.$name.'::all() as $i)';
                        $content.="\n";
                        $content.='                                      <option value="{{$i->'.$m->select->foregein_key.'}}" @if($item->'.$name.'==$i->id) selected @endif>{{$i->'.$m->select->label.'}}</option>';
                        $content.="\n";
                        $content.='                                 @endforeach';
                        $content.="\n";
                        $content.='                                 </select>';
                        $content.="\n";

                        $content.="                    </td>";

                    }
                    else if($m->select->type="custom"){

                        $content.="\n";
                        $content.="                    <td>";
                        $content.="\n";
                        $content.='                                <select name="'.$name.'" class="form-control">';
                        $content.="\n";

                        foreach ($m->select->custom as $s){

                            $content.='                                      <option value="'.$s.'" >'.$s.'</option>';
                        }

                        $content.='                                 </select>';
                        $content.="\n";

                        $content.="                    </td>";



                    }

                    break;
            }
        }

        return $content;
    }

    private function getFieldShow($value)
    {
        $content = "";
        foreach ($value->fields as $name => $m) {

            if (isset($m->options)) {
                $content .= "<th> $m->name</th>";
                $content .= "<td>\n";
                foreach ($m->options as $index => $option) {
                    if ($index != "type") {

                        $content .= "{{( \$item->$name == '$index')? '$option': '' }}";
                        $content .= "\n";
                    }
                }
                $content .= "</td> \n";
            } else {

                $content .= "
                    <tr>
                                <th> $m->name</th>
                                ";

                                if($m->type=="select"){
                                    if($m->select->type=="relation"){
                                        $content.="<td> " . '{{$item->' . $name."Rel->".$m->select->label."}}</td>";
                                    }else{
                                        $content.="<td> " . '{{$item->' . "$name}}</td>";
                                    }
                                }else{
                                    $content.="<td> " . '{{$item->' . "$name}}</td>";
                                }

                           $content.= "</tr>";
            }
        }

        return $content;
    }

    private function getFieldInput($value)
    {
        $content = "";

        foreach ($value->fields as $name => $m) {

            if ($m->Key == 'PRI') {
                continue;
            }
            if ($m->Key == 'MUL') {
                //meter relaçao aqui
                continue;
            }
            if (isset($m->name)) {
                $content .= "
                    <tr>
                                <th> $m->name</th>";
            }

            switch ($m->type) {
                case "text":
                    $content .= "<td><input  type=\"text\" name=\"$name\"></td>";
                    break;
                case "int":
                    $content .= "<td><input   type=\"number\" name=\"$name\" ></td>";
                    break;
                case "image":
                    $content .= "<td><input  type=\"image\" name=\"$name\" ></td>";
                    break;
                case "date":
                    $content .= "<td><input  type=\"date\" name=\"$name\" ></td>";
                    break;
                case "decimal":
                    $content .= "<td><input  type=\"number\" name=\"$name\" ></td>";
                    break;
                case "enum":

                    if (isset($m->options)) {
                        $content .= "<td>";
                        foreach ($m->options as $key => $value) {
                            if ($key != "type") {
                                $content .= "<input  type=" . $m->options->type . " name=\"$name\"  value=" . $key . ">";
                                $content .= "    <label>$value</label>";
                                $content .= "<br>";
                                $content .= "\n";
                            }
                        }
                        $content .= "</td>";
                    }
                    break;
                case "select":
                    if($m->select->type=="relation"){


                    $content.="\n";
                    $content.="                    <td>";
                    $content.="\n";
                    $content.='                                <select name="'.$name.'" class="form-control">';
                    $content.="\n";
                    $content.='                                 @foreach($item::$'.$name.'::all() as $i)';
                    $content.="\n";
                    $content.='                                      <option value="{{$i->'.$m->select->foregein_key.'}}" >{{$i->'.$m->select->label.'}}</option>';
                    $content.="\n";
                    $content.='                                 @endforeach';
                    $content.="\n";
                    $content.='                                 </select>';
                    $content.="\n";

                    $content.="                    </td>";
                    }
                    else if($m->select->type="custom"){

                        $content.="\n";
                        $content.="                    <td>";
                        $content.="\n";
                        $content.='                                <select name="'.$name.'" class="form-control">';
                        $content.="\n";

                        foreach ($m->select->custom as $s){

                            $content.='                                      <option value="'.$s.'" >'.$s.'</option>';
                        }

                        $content.='                                 </select>';
                        $content.="\n";

                        $content.="                    </td>";



                    }
            }
        }

        return $content;

    }

    private function getButtonAction($value)
    {
        $actions = "<td>";
        foreach ($value->functions as $name => $f) {
            if ($f->enable == "yes") {
                switch ($name) {
                    case "show":
                        $actions .= "<a type=" . '"submit"' . " class=" . '"btn btn-xs btn-info"' . " href=\"{{ route('$value->modelTable.show', " . '$item->id' . ") }}\">Show</a> ";
                        break;

                    case "update":
                        $actions .= "<a type=" . '"submit"' . " class=" . '"btn btn-xs btn-info"' . " href=\"{{ route('$value->modelTable.edit', " . '$item->id' . ") }}\">Update</a> ";
                        break;

                    case "destroy":
                        $actions .= "<form action=\"{{ route('$value->modelTable.destroy', " . '$item->id' . ") }}\" method=\"POST\" onsubmit=\"return confirm('Confirm delete');\" style=\"display: inline-block;\">
                                        <input type=\"hidden\" name=\"_method\" value=\"DELETE\">
                                        <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token() }}\">
                                        <input type=\"submit\" class=\"btn btn-xs btn-danger\" value=\"Delete\">
                                    </form>";
                        break;

                }
            }
        }
        $actions .= "</td>";
        return $actions;
    }

    private function getFieldNameObject($value)
    {
        $rows = "";

        foreach ($value->fields as $name => $f) {


            if ($f->display == "yes") {
                if (isset($f->options)) {

                    $rows .= "<td>\n";
                    foreach ($f->options as $index => $option) {
                        if ($index != "type") {

                            $rows .= "{{( \$item->$name == '$index')? '$option': '' }}";
                            $rows .= "\n";
                        }
                    }
                    $rows .= "</td> \n";
                } else {
                    switch ($f->type){
                        case "photo":
                            $rows .= "<td><img src=\"/storage/fotos/{{ \$item->$name}}\" height=\"70px\" width=\"70px\" /></td>\n";
                            break;
                        case "select":

                                if($f->select->type=="relation"){
                                    $rows .= '<td>{{$item->' . $name . "Rel->".$f->select->label.'?? ""}}</td> '."\n";

                                }else if($f->select->type=="custom"){
                                    $rows .= '<td>{{$item->' . $name . "}}</td> \n";
                                }


                            break;
                        default:
                            $rows .= '<td>{{$item->' . $name . "}}</td> \n";
                            break;
                    }

                }
            }
        }

        return $rows;
    }

    private function getFieldName($value)
    {
        $colum = "";
        foreach ($value->fields as $name => $f) {
            if ($f->display == "yes") {
                $colum .= " <th> $f->name </th> \n";
            }
        }

        return $colum;
    }

    private function readTemplatesFunction()
    {

        $urlFolder = base_path("app/Http/Controllers/Scaffolder/data/templates/function");

        if (!File::exists($urlFolder)) {
            $this->errorPage("Folder with view template functions does not find!");
        }

        $filesInFolder = File::files($urlFolder);
        $viewTemplates = array();
        foreach ($filesInFolder as $path) {
            $file = pathinfo($path);
            array_push($viewTemplates, $file);
        }
        return $viewTemplates;
    }

    private function getTemplatefunction($name)
    {
        $urlTemplate = base_path("app/Http/Controllers/Scaffolder/data/templates/function/" . $name . ".php");

        if (!File::exists($urlTemplate)) {
            $this->errorPage("File Functions does not find!");
        }
        return File::get($urlTemplate);;
    }

    private function createDir($dir)
    {
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

    }

    private function createMenuBackOffice($json)
    {

        $modelPath = base_path("resources/views/scaffolder/views/partials/menujson.blade.php");
        $urlFunc = base_path("app/Http/Controllers/Scaffolder/data/menuTemplate.json");

        if (File::exists($modelPath)) {
            $functions = json_decode(File::get($urlFunc), true);
            $contents = "";
            foreach ($json as $key => $value) {
                if (isset($value->enable)) {
                    if ($value->enable == "yes") {

                        $name = $key;
                        $finalName = "";
                        $contents .= "\n";

                        foreach ($functions as $funcName => $func) {
                            if (strpos($func, '$name') != false) {
                                $changed = str_replace(['$name', '$route'], [$name, $name], $func);

                                if (!(strpos($contents, $changed) > 0)) {

                                    $contents .= $changed;
                                    $contents .= "\n";
                                }
                                file_put_contents($modelPath, $contents);
                            }

                        }
                    }
                }
            }
        }
    }

    private function createByJsonObject($json)
    {
        foreach ($json as $field => $m) {
            if ($field == "generated") {
                $json->put($field, "yes");
                return;
                $json;
            }
            if ($m->enable == "yes") {

                $verify = $this->verifyName($m->modelName);

                Artisan::call("make:model $verify   --controller");
                Artisan::call("make:resource $verify");
                $this->populateModel($m);
                $this->createRequest($m);
                $this->populateController($m);
                $this->populateRoutes($m);
                $this->artisanOptimize();
            }
        }
    }

    private function verifyName($name)
    {
        $array = explode("_", $name);
        $finalName = "";

        foreach ($array as $part) {
            $finalName .= ucfirst($part);
        }

        if($finalName != ""){
            return $finalName;
        }
        $this->errorPage("Name verification error");
    }

    private function createRequest($model)
    {
        foreach ($model->functions as $fName => $func) {
            if ($func->enable == "yes") {
                $url = base_path("app/Http/Requests/");
                $name = "";
                switch ($fName) {
                    case "create":
                        $name .= "Store";
                        //$name .= ucfirst($model->modelTable);
                        $name .= $this->verifyName($model->modelTable);
                        $name .= "Request";
                        $url .= $name . ".php";
                        Artisan::call("make:request $name");
                        $this->populateRequest($url, $model);
                        break;
                    case "update":
                        $name .= "Update";
                        $name .= $this->verifyName($model->modelTable);
                        $name .= "Request";
                        $url .= $name . ".php";
                        Artisan::call("make:request $name");
                        $this->populateRequest($url, $model);
                        break;
                }
            }
        }
    }

    private function populateRequest($url, $model)
    {
        if (File::exists($url)) {
            $content = File::get($url);
            $content = str_replace(['false'], "true", $content);
            $old = "//";
            $new = "";


            foreach ($model->fields as $field => $option) {

                if ($option->Key == "PRI") {
                    continue;
                } else {
                    $i = 0;
                    $rules = [];

                    if (isset($option->required) && $option->required == "yes") {
                        $rules[$i] = "required";
                        $i++;
                    }
                    if (isset($option->lenght) && $option->lenght != null) {
                        $rules[$i] = "max:$option->lenght";
                        $i++;
                    }
                }

                for ($f = 0; $f < $i; $f++) {
                    if ($f == 0) {
                        $new .= "            '$field' => '";
                    }
                    $new .= $rules[$f];
                    if ($f == $i - 1) {
                        $new .= "',\n";
                    } else {
                        $new .= "|";
                    }
                }
            }

            $content = str_replace([$old], $new, $content);
            file_put_contents($url, $content);
        } else {
            $this->errorPage("Directory: $url does not exists.");
        }
    }

    private function artisanOptimize()
    {
        Artisan::call("storage:link");
        Artisan::call("optimize");
    }

    private function populateRoutes($m)
    {

        $controllerName = $this->verifyName($m->modelName);
        $modelName = $this->verifyName($m->modelTable);


        $newRoute = 'Route::resource("' . $m->modelTable . '", "' . $controllerName . 'Controller");';

        $modelPath = base_path("routes/web.php");

        $contents = File::get($modelPath);

        if (strpos($contents, $newRoute) == false) {
            $contents .= "\n";
            $contents .= $newRoute;
            file_put_contents($modelPath, $contents);
        }
    }

    private function populateController($model)
    {
        $finalName = $this->verifyName($model->modelName);

        $modelPath = base_path("app/Http/Controllers/" . $finalName . "Controller.php");
        $availableFunctions = $this->readTemplatesFunction();

        if (File::exists($modelPath)) {

            $content = File::get($modelPath);
            $content = substr_replace($content, "", -3);
            $content .= "\n";

            $header = str_replace(['$modelName'], [$this->verifyName($model->modelName)], $this->getTemplatefunction('header'));

            if (strpos($content, $header) == false) {
                $content .= $header;
                $content .= "\n";
            }

            $content .= "\n";
            $imports = "namespace App\Http\Controllers;\n";

            foreach ($model->functions as $fname => $f) {
                if ($f->enable == "yes") {
                    foreach ($availableFunctions as $ava) {
                        if ($fname == $ava['filename']) {
                            $newFunc = $this->getTemplatefunction($ava['filename']);

                            switch ($ava['filename']) {
                                case "create":
                                    $formRequestName = "Store" . $this->verifyName($model->modelTable) . "Request";
                                    explode('_', $formRequestName); //validar isto

                                    $imports .= "use App\Http\Requests\\$formRequestName;\n";
                                    break;
                                case "update":

                                    $formRequestName = "Update" . $this->verifyName($model->modelTable) . "Request";
                                    $imports .= "use App\Http\Requests\\$formRequestName;\n";
                                    break;
                                default:
                                    $formRequestName = "Request";
                                    break;
                            }

                            $changed = str_replace(['$modelName', '$modelTable', '$formRequest'], [$model->modelName, $model->modelTable, $formRequestName], $newFunc);

                            if (strpos($content, $changed) == false) {
                                $content .= $changed;
                                $content .= "\n";
                            }
                        }
                    }
                }
            }
            $content .= "\n\n}";


            $content = str_replace(['namespace App\Http\Controllers;'], [$imports], $content);

            file_put_contents($modelPath, $content);
        } else {
            $this->errorPage("File" . $finalName . "Controller.php does not found!");
        }
    }

    private function errorPage($error)
    {
        return view("scaffolder.errorPage", compact("error"));
    }

    private function populateModel($m, $json)
    {
        $modelPath = base_path("app/" . $m->modelName . ".php");

        if (File::exists($modelPath)) {
            $contents = File::get($modelPath);
            $contents = substr_replace($contents, "", -3);
            $contents .= "\n";
            $initTable = '    protected $table = "' . $m->modelTable . '";';
            if (strpos($contents, $initTable) == false) {
                $contents .= $initTable;
            }
            $contents .= "\n";
            $initFillable = '    protected $fillable=[';
            $i = 0;
            $len = 0;
            foreach ($m->fields as $key => $field) {
                $len++;
            }
            foreach ($m->fields as $key => $field) {
                $i++;
                if ($i == $len) {
                    $initFillable .= '"' . $key . '"';
                    $initFillable .= "];\n";
                } else {
                    $initFillable .= '"' . $key . '",';
                }
            }
            if (strpos($contents, $initFillable) == false) {
                $contents .= $initFillable;
            }

            $contents.="\n";
            foreach($m->fields as $key => $field){
                if($field->type=="select"){
                    if($field->select->type=="relation"){
                        $contents.="\n";


                        $contents.='public static $'.$key.' = ';
                        foreach ($json as $modelName => $models){

                            if(isset($models->modelTable)){
                                if($models->modelTable===$field->select->table){

                                    $contents.=$models->modelName.'::class;';
                                }
                            }
                        }

                        $contents.="\n";
                        $contents.="\n";

                        $contents.='    public function '.$key.'Rel(){';
                        $contents.="\n";
                        foreach ($json as $modelName => $models){

                            if(isset($models->modelTable)){
                                if($models->modelTable===$field->select->table){

                                    $contents.='        return $this->hasOne(\'App\\'.$models->modelName.'\', "'.$field->select->foregein_key.'", "'.$key.'");';
                                }
                            }
                        }

                        $contents.="\n    }";





                    }

                }
            }

            $contents .= "\n}";
            file_put_contents($modelPath, $contents);
        } else {
            $this->errorPage("File" . $m->modelName . "does not find!");
        }
    }

    private function generateView1($metadadosModel)
    {
        $baseViews = base_path("resources/views/admin/");

        foreach ($metadadosModel as $key => $value) {
            if (isset($value->enable)) {
                if ($value->enable == "yes") {
                    $generateBody = "";
                    $basedirectory = $baseViews . $key;
                    $this->createDir($basedirectory);
                    $view = fopen($basedirectory . "/index.blade.php", "w") or die("Unable to open file!");

                    $contentView = File::get(base_path("app/Http/Controllers/Scaffolder/data/templates/view/index.php"));
                    $contentView = str_replace(['$modelName'], [$value->modelName], $contentView);


                    $actions = "";
                    foreach ($value->functions as $name => $f) {
                        if ($f->enable == "yes") {

                            switch ($name) {
                                case "show":
                                    $actions .= "<a type=" . '"submit"' . " class=" . '"btn btn-xs btn-info"' . " href=\"{{ route('$value->modelTable.show', " . '$item->id' . ") }}\">Show</a> ";
                                    $contentPartial = $this->generateViewActions($name, $value);
                                    $viewPartial = fopen($basedirectory . "/show.blade.php", "w") or die("Unable to open file!");
                                    fwrite($viewPartial, $contentPartial);
                                    fclose($viewPartial);
                                    break;

                                case "update":
                                    $actions .= "<a type=" . '"submit"' . " class=" . '"btn btn-xs btn-info"' . " href=\"{{ route('$value->modelTable.edit', " . '$item->id' . ") }}\">Update</a> ";
                                    $contentPartial = $this->generateViewActions($name, $value);
                                    $viewPartial = fopen($basedirectory . "/update.blade.php", "w") or die("Unable to open file!");
                                    fwrite($viewPartial, $contentPartial);
                                    fclose($viewPartial);
                                    break;

                                case "destroy":
                                    $actions .= "<form action=\"{{ route('$value->modelTable.destroy', " . '$item->id' . ") }}\" method=\"POST\" onsubmit=\"return confirm('Confirm delete');\" style=\"display: inline-block;\">
                                        <input type=\"hidden\" name=\"_method\" value=\"DELETE\">
                                        <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token() }}\">
                                        <input type=\"submit\" class=\"btn btn-xs btn-danger\" value=\"Delete\">
                                    </form>";
                                    break;

                                case "create":
                                    $generateBody .= "<a type=" . '"submit"' . " class=" . '"btn btn-xs btn-success"' . " href=\"{{ route('$value->modelTable.create') }}\">Create</a> ";
                                    $contentPartial = $this->generateViewActions($name, $value);
                                    $viewPartial = fopen($basedirectory . "/create.blade.php", "w") or die("Unable to open file!");
                                    fwrite($viewPartial, $contentPartial);
                                    fclose($viewPartial);
                                    break;

                            }
                        }
                    }

                    $colum = "";

                    foreach ($value->fields as $name => $f) {
                        if ($f->display == "yes") {
                            $colum .= " <th> $f->name </th> \n";
                        }
                    }

                    $rows = "";

                    foreach ($value->fields as $name => $f) {


                        if ($f->display == "yes") {
                            if (isset($f->options)) {

                                $rows .= "<td>\n";
                                foreach ($f->options as $index => $option) {
                                    if ($index != "type") {

                                        $rows .= "{{( \$item->$name == '$index')? '$option': '' }}";
                                        $rows .= "\n";
                                    }
                                }
                                $rows .= "</td> \n";
                            } else {
                                if ($f->type == "photo") {
                                    $rows .= "<td><img src=\"/storage/fotos/{{ \$item->$name}}\" height=\"70px\" width=\"70px\" /></td>\n";
                                } else {
                                    $rows .= '<td>{{$item->' . $name . "}}</td> \n";
                                }
                            }
                        }
                    }
                    $generateBody .= "
                                <table class=\"table\">
                        <tr>
                            $colum
                            <th>Actions</th>
                        </tr>
                         @foreach(" . '$items' . " as " . '$item' . ")
                                <tr>
                                    $rows
                                    <td>$actions</td>
                                </tr>
                                @endforeach
                    </table>
                    <div class=\"col\">
                        {{\$items->links()}}
                    </div>
                    ";
                    $contentView = str_replace(['$generateBody'], $generateBody, $contentView);
                    fwrite($view, $contentView);
                    fclose($view);
                }
            }
        }
    }

    private function generateViewActions($name, $model)
    {

        $templates = $this->readTemplatesView();
        $content = "";

        foreach ($templates as $template) {
            if ($template['filename'] == $name) {
                $content = $this->getTemplateView($template['filename']);
            }
        }

        $content = str_replace(['$modelName'], [$model->modelName], $content);

        switch ($name) {
            case "show":

                $generateBody = "<table class=\"table\"><tr>";
                foreach ($model->fields as $name => $m) {

                    if (isset($m->options)) {
                        $generateBody .= "<th> $m->name</th>";
                        $generateBody .= "<td>\n";
                        foreach ($m->options as $index => $option) {
                            if ($index != "type") {

                                $generateBody .= "{{( \$item->$name == '$index')? '$option': '' }}";
                                $generateBody .= "\n";
                            }
                        }
                        $generateBody .= "</td> \n";
                    } else {

                        $generateBody .= "
                    <tr>
                                <th> $m->name</th>
                                <td> " . '{{$item->' . "$name}}</td>
                            </tr>";
                    }
                }

                $generateBody .= "</table>";

                if (strpos($content, '$generateBody') != false) {
                    $changed = str_replace(['$generateBody'], [$generateBody], $content);
                    if (strpos($content, $changed) == false) {
                        $content = $changed;
                    }
                }

                return $content;
                break;

            case "update":

                $generateBody = "<form action=\"{{route(\"$model->modelTable.update\", \$item->id)}} \" method=\"POST\" enctype=\"multipart/form-data\">
                            <table class=\"table\">
                            @csrf
                            @method('PUT')";

                foreach ($model->fields as $name => $m) {
                    $generateBody .= "
                    <tr>
                                <th> $m->name</th>";

                    if ($m->Key != 'no') {
                        $showOP = 'disabled';
                    } else {
                        $showOP = '';
                    }

                    switch ($m->type) {
                        case "text":
                            $generateBody .= "<td><input $showOP type=\"text\" name=\"$name\" value=\"{{\$item->$name}}\"></td>";
                            break;
                        case "int":
                            $generateBody .= "<td><input $showOP  type=\"number\" name=\"$name\" value=\"{{\$item->$name}}\"></td>";
                            break;
                        case "image":
                            $generateBody .= "<td><input $showOP type=\"image\" name=\"$name\" value=\"{{\$item->$name}}\"></td>";
                            break;
                        case "date":
                            $generateBody .= "<td><input $showOP type=\"date\" name=\"$name\" value=\"{{\$item->$name}}\"></td>";
                            break;
                        case "select":
                            $generateBody .= "<td><select></select></td>";
                            break;
                        case "enum":
                            if (isset($m->options)) {
                                $generateBody .= "<td>";
                                foreach ($m->options as $key => $value) {
                                    if ($key != "type") {
                                        $generateBody .= "<input type=" . $m->options->type . " name=\"$name\"  value=" . $key . " {{( \$item->$name == '$key')? 'checked': '' }}>";
                                        $generateBody .= "    <label>$value</label>";
                                        $generateBody .= "<br>";
                                        $generateBody .= "\n";
                                    }
                                }
                                $generateBody .= "</td>";
                            }

                            break;
                    }
                }
                $generateBody .= "</table>
                            <input type=\"submit\" value=\"Update\" class=\"btn btn-info col-md-12\">
                        </form>";

                if (strpos($content, '$generateBody') != false) {
                    $changed = str_replace(['$generateBody'], [$generateBody], $content);
                    if (strpos($content, $changed) == false) {
                        $content = $changed;
                    }
                }

                return $content;
                break;

            case "create":
                $generateBody = "<form action=\"{{route(\"$model->modelTable.store\")}} \" method=\"POST\" enctype=\"multipart/form-data\">
                            <table class=\"table\">
                            @csrf";

                foreach ($model->fields as $name => $m) {

                    if ($m->Key == 'PRI') {
                        continue;
                    }
                    if (isset($m->name)) {
                        $generateBody .= "
                    <tr>
                                <th> $m->name</th>";
                    }

                    switch ($m->type) {
                        case "text":
                            $generateBody .= "<td><input  type=\"text\" name=\"$name\"></td>";
                            break;
                        case "int":
                            $generateBody .= "<td><input   type=\"number\" name=\"$name\" ></td>";
                            break;
                        case "image":
                            $generateBody .= "<td><input  type=\"image\" name=\"$name\" ></td>";
                            break;
                        case "date":
                            $generateBody .= "<td><input  type=\"date\" name=\"$name\" ></td>";
                            break;
                        case "enum":

                            if (isset($m->options)) {
                                $generateBody .= "<td>";
                                foreach ($m->options as $key => $value) {
                                    if ($key != "type") {
                                        $generateBody .= "<input  type=" . $m->options->type . " name=\"$name\"  value=" . $key . ">";
                                        $generateBody .= "    <label>$value</label>";
                                        $generateBody .= "<br>";
                                        $generateBody .= "\n";
                                    }
                                }
                                $generateBody .= "</td>";
                            }


                            break;
                    }
                }
                $generateBody .= "</table>
                            <input type=\"submit\" value=\"Create\" class=\"btn btn-info col-md-12\">
                        </form>";

                if (strpos($content, '$generateBody') != false) {
                    $changed = str_replace(['$generateBody'], [$generateBody], $content);
                    if (strpos($content, $changed) == false) {
                        $content = $changed;
                    }
                }

                return $content;
                break;
        }

    }

    private function getTemplateView($name)
    {
        $urlTemplate = base_path("app/Http/Controllers/Scaffolder/data/templates/view/" . $name . ".php");

        if (!File::exists($urlTemplate)) {
            $this->errorPage("File Functions does not find!");
        }

        return File::get($urlTemplate);;

    }
    /*
        private function readTemplatesView()
        {

            $urlFolder = base_path("app/Http/Controllers/Scaffolder/data/templates/view");

                foreach ($model->fields as $field => $option) {
                    if ($option->Key == "PRI") {
                        continue;
                    } else {
                        $i = 0;
                        $rules = [];
                        if (isset($option->Null)) {

                        if ($option->Null == "NO") {
                            $rules[$i] = "required";
                            $i++;
                        }
                        }
                        if (isset($option->lenght) && $option->lenght != null) {
                            $rules[$i] = "max:$option->lenght";
                            $i++;
                        }
                    }

                    for ($f = 0; $f < $i; $f++) {
                        if ($f == 0) {
                            $new .= "            '$field' => '";
                        }
                        $new .= $rules[$f];
                        if ($f == $i - 1) {
                            $new .= "',\n";
                        } else {
                            $new .= "|";
                        }
                    }
                }

                $content = str_replace([$old], $new, $content);
                file_put_contents($url, $content);
            } else {
                $this->err("Directory: $url does not exists.");
            }

            $filesInFolder = File::files($urlFolder);
            $viewTemplates = array();
            foreach ($filesInFolder as $path) {
                $file = pathinfo($path);
                array_push($viewTemplates, $file);
            }
            return $viewTemplates;
        }

    */
}
