<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class ScaffolderController extends Controller
{
    public function indexChooseDB(){

        $dbs = DB::select( DB::raw("SHOW DATABASES"));
        return view("scaffolder.choosedb", compact("dbs"));
    }

    public function getSchemaDB(Request $request){


        $db= "Tables_in_".$request->db;
        $tables = DB::select( DB::raw("show TABLES from ".$request->db));

        return view("scaffolder.configuretables", compact("tables", "db"));
    }


}
