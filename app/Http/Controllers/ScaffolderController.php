<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


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
        $this->generateJson($metadados);

        return view("scaffolder.configuretables", compact("metadados"));
    }

    public function tablesConfigureP1Post(Request $request)
    {

    }


    public function generateJson($metadados){


        $contents = json_encode($metadados);
        Storage::delete("scaffolderConfigs.json");
        Storage::disk('local')->put("scaffolderConfigs.json", $contents);
        //ler
        $readData = Storage::get('scaffolderConfigs.json');
        $data = json_decode($readData);
        //dd($data);

}

}
