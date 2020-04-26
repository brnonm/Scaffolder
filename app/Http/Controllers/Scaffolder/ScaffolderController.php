<?php

namespace App\Http\Controllers\Scaffolder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class ScaffolderController extends Controller
{
    public function backofficeController()
    {
        $json = File::get(base_path('app/Http/Controllers/Scaffolder/data/metadados.json'));
        $metadados = collect(json_decode($json, true));

        return view("scaffolder.back.controllers", compact("metadados"));
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
            $error = "File with generic functions does not find!";
            return view("scaffolder.errorPage", compact("error"));
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

                    //cria o index por omissao para alterar
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
                            $rows .= '<td>{{$item->' . $name . "}}</td> \n";
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
                    ";


                    $contentView = str_replace(['$generateBody'], $generateBody, $contentView);
                    fwrite($view, $contentView);
                    fclose($view);
                }
            }
        }
    }

    private function readTemplatesView()
    {

        $urlFolder = base_path("app/Http/Controllers/Scaffolder/data/templates/view");

        if (!File::exists($urlFolder)) {
            $error = "Folder with view template View does not find!";
            return view("scaffolder.errorPage", compact("error"));
        }

        $filesInFolder = File::files($urlFolder);
        $viewTemplates = array();
        foreach ($filesInFolder as $path) {
            $file = pathinfo($path);
            array_push($viewTemplates, $file);
        }
        return $viewTemplates;
    }

    private function getTemplateView($name)
    {
        $urlTemplate = base_path("app/Http/Controllers/Scaffolder/data/templates/view/" . $name . ".php");

        if (!File::exists($urlTemplate)) {
            $error = "File Functions does not find!";
            return view("scaffolder.errorPage", compact("error"));
        }

        return File::get($urlTemplate);;

    }

    private function readTemplatesFunction()
    {

        $urlFolder = base_path("app/Http/Controllers/Scaffolder/data/templates/function");

        if (!File::exists($urlFolder)) {
            $error = "Folder with view template functions does not find!";
            return view("scaffolder.errorPage", compact("error"));
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
            $error = "File Functions does not find!";
            return view("scaffolder.errorPage", compact("error"));
        }

        return File::get($urlTemplate);;

    }

    private
    function generateViewActions($name, $model)
    {

        $templates = $this->readTemplatesView();
        $content = "";

        foreach ($templates as $template) {
            if ($template['filename'] == $name) {
                $content = $this->getTemplateView($template['filename']);
            }
        }

        switch ($name) {
            case "show":

                $generateBody = "<table class=\"table\"><tr>";
                foreach ($model->fields as $name => $m) {
                    $generateBody .= "
                    <tr>
                                <th> $m->name</th>
                                <td> " . '{{$item->' . "$name}}</td>
                            </tr>";
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
                        case "enum":
                            $generateBody .= "<td>(listar opcoes)<input $showOP type=\"radio\" name=\"$name\" value=\"{{\$item->$name}}\"></td>";
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
                                        $generateBody .= "<input  type=" . $m->options->type . " name=\"$name\"  value=".$key.">";
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

    private
    function createDir($dir)
    {
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

    }

    private
    function createMenuBackOffice($json)
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

    private
    function createByJsonObject($json)
    {

        foreach ($json as $field => $m) {
            if ($field == "generated") {
                $json->put($field, "yes");
                return;
                $json;
            }
            if ($m->enable == "yes") {
                Artisan::call("make:model $m->modelName   --controller");
                Artisan::call("make:resource $m->modelName");
                $this->populateModel($m);
                $this->populateController($m);
                $this->populateRoutes($m);
                $this->artisanOptimize();
            }
        }
    }

    private
    function artisanOptimize()
    {
        Artisan::call("optimize");
    }

    private
    function populateRoutes($m)
    {

        $newRoute = 'Route::resource("' . $m->modelTable . '", "' . $m->modelName . 'Controller");';
        $modelPath = base_path("routes/web.php");

        $contents = File::get($modelPath);

        if (strpos($contents, $newRoute) == false) {
            $contents .= "\n";
            $contents .= $newRoute;
            file_put_contents($modelPath, $contents);
        }
    }

    private function createRouteView($modelTable, $view, $modelName)
    {
        $newRoute = 'Route::get("' . $modelTable . '/' . $view . '", "' . ucfirst($modelName) . 'Controller@view' . $view . '")->name("' . $modelName . ucfirst($view) . '");';
        $modelPath = base_path("routes/web.php");

        $contents = File::get($modelPath);
        if (strpos($contents, $newRoute) == false) {
            $contents .= "\n";
            $contents .= $newRoute;
            file_put_contents($modelPath, $contents);
        }


        return $modelName . ucfirst($view);
    }

    private
    function populateController($model)
    {


        $name = explode("_", $model->modelName);
        $finalName = "";
        foreach ($name as $part) {
            $finalName .= ucfirst($part);
        }
        $modelPath = base_path("app/Http/Controllers/" . $finalName . "Controller.php");

        $availableFunctions = $this->readTemplatesFunction();


        if (File::exists($modelPath)) {

            $contents = File::get($modelPath);
            $contents = substr_replace($contents, "", -3);
            $contents .= "\n";

            $header = str_replace(['$modelName'], [$model->modelName], $this->getTemplatefunction('header'));
            if (strpos($contents, $header) == false) {
                $contents .= $header;
                $contents .= "\n";
            }


            $contents .= "\n";

            foreach ($model->functions as $fname => $f) {
                if ($f->enable == "yes") {
                    foreach ($availableFunctions as $ava) {
                        if ($fname == $ava['filename']) {
                            $newFunc = $this->getTemplatefunction($ava['filename']);
                            $changed = str_replace(['$modelName', '$modelTable'], [$model->modelName, $model->modelTable], $newFunc);
                            if (strpos($contents, $changed) == false) {
                                $contents .= $changed;
                                $contents .= "\n";
                            }

                        }
                    }
                }
            }
            $contents .= "\n\n";
            $contents .= "}";

            file_put_contents($modelPath, $contents);
        } else {
            $error = "File" . $finalName . "Controller.php does not find!";
            return view("scaffolder.errorPage", compact("error"));
        }
    }

    private function populateRequest($model)
    {
        //php artisan make:request CategorieStoreRequest

    }


    private
    function populateModel($m)
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
            $contents .= "\n}";
            file_put_contents($modelPath, $contents);
        } else {
            $error = "File" . $m->modelName . "does not find!";
            return view("scaffolder.errorPage", compact("error"));
        }


    }


}
