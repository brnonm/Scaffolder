<?php

namespace App\Http\Controllers;

use App\Http\Resources\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    //
    protected static $modelName  = 'App\Categorie';
        public function index()
        {
             $items=self::$modelName::all();
            return view('categories.index', compact('items'));
        }

        public function create()
        {
            $item= new self::$modelName();
            return view('categories.partials.create', compact('item'));
        }

        public function destroy(\App\Categorie $model)
        {
            dd($model->delete());
            $model->delete();
            return redirect()->route('categories.index');
        }

           public function update(self $model)       {
     }
           public function show()       {
     }

}
