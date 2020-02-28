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



        $tables = DB::select( DB::raw("show TABLES from ".$request->db));
        dd($tables);
        return view("scaffolder.configuretables", compact("tables"));
    }


}
