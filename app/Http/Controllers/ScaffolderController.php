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
        $metadados = array();
        $tables = DB::select(DB::raw("SELECT TABLE_NAME AS _table FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$request->db'"));


        foreach ($tables as $table) {
            $columns = DB::select(DB::raw("show fields from " . $table->_table));
            $atr = [];
            //array_push($atr, $table->_table);
            foreach ($columns as $column) {
                array_push($atr, $column);
            }
            array_push($metadados, $atr);
        }


        return view("scaffolder.configuretables", compact("metadados"));
    }

}
