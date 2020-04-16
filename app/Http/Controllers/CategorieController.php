<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategorieController extends Controller
{
    //
    protected static $modelName  = 'App\Categorie';
        public function index()
        {
             $items=self::$modelName::all();
            return view('scaffolder.views.index', compact('items'));
        }

        public function create()
        {
            $item= new self::$modelName();
            return view('scaffolder.views.create', compact('item'));
        }

           public function update($model)       {
     }


}