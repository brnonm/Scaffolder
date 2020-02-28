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

        $metadados=[];
        $db= "Tables_in_".$request->db;
        $tables = DB::select( DB::raw("show TABLES from ".$request->db));
        foreach($tables as $t){
            $metadados[$db]=DB::connection($request->db)->select( DB::raw("show fields from ".$t->$db));
        }
        dd($metadados);

        return view("scaffolder.configuretables", compact("tables", "db"));
    }


}
