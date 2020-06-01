<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreContasRequest;
use App\Http\Requests\UpdateContasRequest;

use App\Http\Requests\StoreContasRequest;
use App\Http\Requests\UpdateContasRequest;

use App\Http\Requests\StoreContasRequest;
use App\Http\Requests\UpdateContasRequest;


use Illuminate\Http\Request;

class ContaController extends Controller
{
    //
    protected static $model  = 'App\Conta';


    public function create(){
        $item = new self::$model();
        return view('admin.contas.create', compact('item'));
    }

    public function store(StoreContasRequest $request){
        self::$model::create($request->all());
        return redirect()->route('contas.index');
    }

    public function destroy($model){
        $model=self::$model::findOrFail($model);   $model->delete();
        return redirect()->route('contas.index');
    }

    public function index(){
        $items = self::$model::paginate(15);
        return view('admin.contas.index', compact('items'));
    }


    public function show($id){
        $item = self::$model::findOrFail($id);
        return view('admin.contas.show', compact('item'));
    }

    public function edit($id){
        $item = self::$model::findOrFail($id);
        return view('admin.contas.update', compact('item'));
    }

    public function update($id, UpdateContasRequest $request){
        $item = self::$model::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('contas.index');
    }







}