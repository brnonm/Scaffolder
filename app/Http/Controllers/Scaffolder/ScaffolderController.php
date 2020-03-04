<?php

namespace App\Http\Controllers\Scaffolder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class ScaffolderController extends Controller
{
    public function indexChooseDB()
    {

        $dbs = DB::select(DB::raw("SHOW DATABASES"));
        return view("scaffolder.choosedb", compact("dbs"));
    }

    public function backofficeIndex(){
        return view("scaffolder.views.index");
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

        $json = json_encode($request->except('_token'), JSON_PRETTY_PRINT);

        file_put_contents(base_path('app/Http/Controllers/Scaffolder/data/metadados.json'), stripslashes($json));

        $this->createByJsonObject($json);


        dd("Criado tudo");


        dd($json);
    }

    private function createByJsonObject($json)
    {

        $json = collect(json_decode($json));
        $json = $json->first();


        foreach ($json as $m) {
            if ($m->enable == "yes") {


                Artisan::call("make:model $m->modelName   --controller");
                Artisan::call("make:resource $m->modelName ");

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
        $modelPath = base_path("routes/web.php");

        $contents = File::get($modelPath);
        $contents .= "\n";
        $contents .= 'Route::resource("/' . $m->modelName . '/", "' . $m->modelName . 'Controller");';

        file_put_contents($modelPath, $contents);

    }

    private function populateController($m)
    {
        $name = explode("_", $m->modelName);
        $finalName = "";
        foreach ($name as $part) {
            $finalName .= ucfirst($part);
        }
        $modelPath = base_path("app/Http/Controllers/" . $finalName . "Controller.php");

        if (File::exists($modelPath)) {

            $contents = File::get($modelPath);
            $contents = substr_replace($contents, "", -3);
            $contents .= "\n";

            $contents .= "    protected static " . '$modelName' . " = 'app/$m->modelName.php';";

            $contents .= "\n";
            $contents .= "
        public function index()
        {
            " . '$items' . "=self:: " . '$modelName' . "::all();
            return view('scaffolder.views.index', compact('items'));
        }";
            $contents .= "\n";
            $contents .= "
        public function create()
        {
            " . '$item' . " = new self::" . '$modelName()' . ";
            return view('scaffolder.views.create', compact('item'));
        }";


            $contents .= "\n\n";
            $contents .= "}";


            file_put_contents($modelPath, $contents);
        }


    }


    private function populateModel($m)
    {

        $modelPath = base_path("app/" . $m->modelName . ".php");


        if (!File::exists($modelPath)) {

            $contents = File::get($modelPath);

            $contents = substr_replace($contents, "", -3);
            $contents .= "\n";
            $contents .= '    protected $table = "' . $m->modelTable . '";';
            $contents .= "\n";
            $contents .= '    protected $fillable=[';
            $i = 0;
            $len = collect($m->fields)->count();

            foreach ($m->fields as $key => $field) {
                $i++;

                if ($i == $len) {


                    $contents .= '"' . $key . '"';
                } else {
                    $contents .= '"' . $key . '",';
                }

            }
            $contents .= "];\n";
            $contents .= "}";

            file_put_contents($modelPath, $contents);

        } else {

            //pensar em alguma coisa
        }


    }


}
