<?php

namespace App\Http\Controllers\Scaffolder;

use App\Http\Controllers\Controller;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\File;

use function foo\func;


class ScaffolderController extends Controller
{
    public function indexChooseDB()
    {

        $dbs = DB::select(DB::raw("SHOW DATABASES"));
        return view("scaffolder.choosedb", compact("dbs"));
    }

    public function getSchemaDB(Request $request)
    {

        $tables = DB::select(DB::raw("SELECT TABLE_NAME AS _table FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$request->db'"));

        foreach ($tables as $key=>$table) {
            $t = $table->_table;
            $columns = DB::select(DB::raw("show fields from " . $t));


            $atr=[];
            foreach ($columns as $column) {
                $f=$column->Field;

                $atr[$f]=$column;
            }
            $metadados[$t]=$atr;

        }


        return view("scaffolder.configuretables", compact("metadados"));
    }

    public function tablesConfigureP1Post(Request $request){
        $json=json_encode($request->except('_token'), JSON_PRETTY_PRINT);

        file_put_contents(base_path('app/Http/Controllers/Scaffolder/data/metadados.json'), stripslashes($json));

        $this->createByJsonObject($json);


        dd("Criado tudo");



        dd($json);
    }

    private function createByJsonObject($json){

        $json=collect(json_decode($json));
        $json=$json->first();

        foreach($json as $m)
        {
            if($m->enable=="yes"){


                Artisan::call("make:model $m->modelName   --controller");
                Artisan::call("make:resource $m->modelName ");

                $this->populateFiles($m);
            }



        }
    }


    private function populateFiles($m){

        dd($m);
    }


}
