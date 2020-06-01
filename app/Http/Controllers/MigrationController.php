<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreMigrationsRequest;
use App\Http\Requests\UpdateMigrationsRequest;


use Illuminate\Http\Request;

class MigrationController extends Controller
{
    //
    protected static $model  = 'App\Migration';


    public function create(){
        $item = new self::$model();
        return view('admin.migrations.create', compact('item'));
    }

    public function store(StoreMigrationsRequest $request){
        self::$model::create($request->all());
        return redirect()->route('migrations.index');
    }

    public function destroy($model){
        $model=self::$model::findOrFail($model);   $model->delete();
        return redirect()->route('migrations.index');
    }

    public function index(){
        $items = self::$model::paginate(15);
        return view('admin.migrations.index', compact('items'));
    }


    public function show($id){
        $item = self::$model::findOrFail($id);
        return view('admin.migrations.show', compact('item'));
    }

    public function edit($id){
        $item = self::$model::findOrFail($id);
        return view('admin.migrations.update', compact('item'));
    }

    public function update($id, UpdateMigrationsRequest $request){
        $item = self::$model::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('migrations.index');
    }



}