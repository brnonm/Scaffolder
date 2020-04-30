<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
protected static $model  = 'App\User';


public
function create()
{
$item = new self::$model();
return view('admin.users.create', compact('item'));
}

public
function store(Request $request)
{
self::$model::create($request->all());
return redirect()->route('users.index');
}

public function destroy($model)
{
$model=self::$model::findOrFail($model);   $model->delete();
return redirect()->route('users.index');
}

public
function index()
{
$items = self::$model::paginate(15);
return view('admin.users.index', compact('items'));
}


public function show($id)
{
$item = self::$model::findOrFail($id);
return view('admin.users.show', compact('item'));
}

public function edit($id)
{
$item = self::$model::findOrFail($id);
return view('admin.users.update', compact('item'));
}

public function update($id, Request $request)
{
$item = self::$model::findOrFail($id);
$item->update($request->all());
return redirect()->route('users.index');
}



}