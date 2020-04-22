<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    //
    protected static $modelName  = 'App\Cliente';
        public function index()
        {
             $items=self::$modelName::all();
            return view('admin.clientes.index', compact('items'));
        }

        public function destroy($model)
        {
          $model=self::$modelName::findOrFail($model);   $model->delete();
            return redirect()->route('clientes.index');
        }


}