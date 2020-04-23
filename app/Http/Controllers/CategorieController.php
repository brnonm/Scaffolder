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
public function create()
    {
        $item = new self::$modelName();
        return view('admin.categories.create', compact('item'));
    }
    
    public function store(){
        
    }
public function show($id)
    {
        $item = self::$modelName::findOrFail($id);
        return view('admin.categories.show', compact('item'));
    } public function edit($id)
    {
        $item = self::$modelName::findOrFail($id);
        return view('admin.categories.update', compact('item'));
    }

        public function update($id, Request $request)
    {
        $item = self::$modelName::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('categories.index');
    }
        public function destroy($model)
        {
          $model=self::$modelName::findOrFail($model);   $model->delete();
            return redirect()->route('categories.index');
        }


}