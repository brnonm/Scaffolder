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
        $folderModel="/app/Http/Model";
        file_put_contents(base_path('app/Http/Controllers/Scaffolder/data/metadados.json'), stripslashes($json));

        //Gerar a pasta model caso nao exista

        foreach($request->metadados as $m)
        {
            if($m["enable"]=="yes"){
                Artisan::call('make:model '.$m["name"]);
                
            }


        }

        dd("Criado tudo");

        if(!File::exists($folderModel)) {
            // path does not exist



            //mkdir($folderModel, 0755, true);
            dd("here");
        }

        dd($json);
    }

}
