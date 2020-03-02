<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        dd($metadados);


        return view("scaffolder.configuretables", compact("metadados"));
    }

}
