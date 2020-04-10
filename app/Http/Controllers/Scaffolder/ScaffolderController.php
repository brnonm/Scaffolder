<?php

namespace App\Http\Controllers\Scaffolder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class ScaffolderController extends Controller
{
    public function backofficeIndex()
    {
        return view("scaffolder.views.index");
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
            //retornar vista de erro
            ("Erro nao encontra o ficheiro");
        }
        $func = File::get($urlFunctions);
        $functions = collect(json_decode($func));

        return view("scaffolder.configureTableController", compact("metadados", "functions"));
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

        file_put_contents(base_path('app/Http/Controllers/Scaffolder/data/metadados.json'), json_encode($baseJson, JSON_PRETTY_PRINT));
        return view("scaffolder.configureFinish", compact("json"));
    }

    private function joinJson($baseJson, $newJson)
    {


        foreach ($baseJson as $jName => $j) {
            foreach ($newJson as $nName => $n) {
                //dd($jName . "==" . $nName);
                if ($jName === $nName) {
                    $baseJson->mergeRecursive([$jName => $n]);
                    //dd($jName . "==" . $nName);
                }
            }
        }

        return $baseJson;

    }

    private function createByJsonObject($json)
    {
        //$json = collect(json_decode($json));
        //$json = $json->first();

        foreach ($json as $m) {
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
        $newRoute = 'Route::resource("' . $m->modelName . '", "' . $m->modelName . 'Controller");';
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
                        //adicionar as funcoes

                        foreach ($m->functions as $fName => $f) {
                            if ($fName === $funcName) {
                                if ($f->enable == "yes") {
                                    $contents .= $func;
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
            $contents .= '    protected $table = "' . $m->modelTable . '";';
            $contents .= "\n";
            $contents .= '    protected $fillable=[';
            $i = 0;
            $len = 0;


            foreach ($m->fields as $key => $field) {
                //if (isset($field->enable) == "yes") {
                $len++;
                //}
            }


            foreach ($m->fields as $key => $field) {
                //if (isset($field->enable) == "yes") {
                $i++;
                if ($i == $len) {
                    $contents .= '"' . $key . '"';
                } else {
                    $contents .= '"' . $key . '",';
                }
                //}

            }
            $contents .= "];\n";
            $contents .= "}";


            file_put_contents($modelPath, $contents);

        } else {

            //pensar em alguma coisa
        }


    }


}
