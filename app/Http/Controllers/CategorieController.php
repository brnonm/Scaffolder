<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategorieController extends Controller
{
    //
protected static $model  = 'App\Categorie';


public
function create()
{
$item = new self::$model();
return view('admin.categories.create', compact('item'));
}

public
function store(Request $request)
{
self::$model::create($request->all());
return redirect()->route('categories.index');
}

public function destroy($model)
{
$model=self::$model::findOrFail($model);   $model->delete();
return redirect()->route('categories.index');
}

public
function index()
{
$items = self::$model::paginate(15);
return view('admin.categories.index', compact('items'));
}


public function show($id)
{
$item = self::$model::findOrFail($id);
return view('admin.categories.show', compact('item'));
}

public function edit($id)
{
$item = self::$model::findOrFail($id);
return view('admin.categories.update', compact('item'));
}

public function update($id, Request $request)
{
$item = self::$model::findOrFail($id);
$item->update($request->all());
return redirect()->route('categories.index');
}



}