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

        return view("scaffolder.configuretables", compact("metadados"));
    }

    public function tablesConfigureP1Post(Request $request)
    {
        $urlFunctions = base_path('app/Http/Controllers/Scaffolder/data/functions.json');
        $json = json_encode($request->except('_token'), JSON_PRETTY_PRINT);
        file_put_contents(base_path('app/Http/Controllers/Scaffolder/data/metadados.json'), stripslashes($json));

        $metadados = collect(json_decode($json));
        $metadados = collect($metadados->first());

        if (!File::exists($urlFunctions)) {
            $error = "File with generic functions does not find!";
            return view("scaffolder.errorPage", compact("error"));
        } else {
            $func = File::get($urlFunctions);
            $functions = collect(json_decode($func));
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

    private function generateView($json)
    {
        $urlFunc = base_path("app/Http/Controllers/Scaffolder/data/functions.json");
        $baseViews = base_path("resources/views/");

        if (!File::exists($urlFunc)) {
            $error = "File Functions does not find!";
            return view("scaffolder.errorPage", compact("error"));
        }

        $functions = json_decode(File::get($urlFunc));

        foreach ($json as $key => $value) {
            if (isset($value->enable)) {
                if ($value->enable == "yes") {
                    $basedirectory = $baseViews . $key;
                    $directoryPartials = $basedirectory . "/partials";

                    $this->createDir($basedirectory);
                    $this->createDir($directoryPartials);

                    $view = fopen($basedirectory . "/index.blade.php", "w") or die("Unable to open file!");
                    $contentView = $functions->views->index;
                    $contentView = str_replace(['$modelName'], [$value->modelName], $contentView);


                    $colum = "";
                    foreach ($value->fields as $name => $f) {
                        $colum .= "<th> $f->name </th>\n";
                    }

                    $actions="";
                    foreach ($value->functions as $name=>$f){

                        if($f->enable =="yes"){
                            switch ($name) {
                                case "update":
                                    $actions .="<button>Update</button>";
                                    break;

                                case "destroy":
                                    $actions .="<button>Delete</button>";
                                    break;

                            }
                        }
                    }



                    $generateTable = "
                    <table class=\"table\">
                        <tr>
                            $colum
                            <th>Actions</th>
                        </tr>
                        <tr>
                            @foreach(" . '$items' . " as " . '$item' . ")
                                <th></th>
                            @endforeach
                        </tr>

                         @foreach(" . '$items' . " as " . '$item' . ")
                                <tr>
                                    @foreach(" . '$item->getFillable()' . " as " . '$field' . ")
                                        <th>{{" . '$item->$field' . "}}</th>
                                    @endforeach
                                    <th>$actions</th>
                                </tr>
                                @endforeach
                    </table>
                    ";

                    $contentView = str_replace(['$generateTable'], $generateTable, $contentView);

                    fwrite($view, $contentView);
                    fclose($view);
                }
            }
        }
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
            //$contents = File::get($modelPath);
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
                Artisan::call("make:model $m->modelName   --controller");
                Artisan::call("make:resource $m->modelName");
                $this->populateModel($m);
                $this->populateController($m);
                $this->populateRoutes($m);
                $this->artisanOptimize();
            }
        }
    }

    private function artisanOptimize()
    {
        Artisan::call("optimize");
    }

    private function populateRoutes($m)
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

    private function populateController($m)
    {
        $name = explode("_", $m->modelName);
        $finalName = "";
        foreach ($name as $part) {
            $finalName .= ucfirst($part);
        }
        $modelPath = base_path("app/Http/Controllers/" . $finalName . "Controller.php");
        $urlFunc = base_path("app/Http/Controllers/Scaffolder/data/functions.json");

        if (File::exists($modelPath)) {

            $functions = json_decode(File::get($urlFunc));

            $contents = File::get($modelPath);
            $contents = substr_replace($contents, "", -3);
            $contents .= "\n";

            foreach ($functions->controller as $funcName => $func) {
                if (strpos($contents, $func) == false) {
                    if (strpos($func, '$m->modelName') != false) {
                        $changed = str_replace(['$m->modelName'], [$m->modelName], $func);

                        if (strpos($contents, $changed) == false) {
                            $contents .= $changed;
                        }
                    } else {
                        foreach ($m->functions as $fName => $f) {
                            if ($fName === $funcName) {
                                if ($f->enable == "yes") {
                                    $changed = str_replace(['$modelTable'], [$m->modelTable], $func);
                                    $contents .= $changed;
                                }
                            }
                        }
                    }
                }
            }
            $contents .= "\n\n";
            $contents .= "}";
            file_put_contents($modelPath, $contents);
        }
    }


    private function populateModel($m)
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
                    $initFillable .= "];";
                } else {
                    $initFillable .= '"' . $key . '",';
                }
            }


            if (strpos($contents, $initFillable) == false) {
                $contents .= $initFillable;
                $contents .= "\n}";
            }

            file_put_contents($modelPath, $contents);

        } else {
            $error = "File" . $m->modelName . "does not find!";
            return view("scaffolder.errorPage", compact("error"));
        }


    }


}
