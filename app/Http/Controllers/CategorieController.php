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
            return view('admin.categories.index', compact('items'));
        }


}