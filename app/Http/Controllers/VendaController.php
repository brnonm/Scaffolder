<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreVendasRequest;
use App\Http\Requests\UpdateVendasRequest;


use Illuminate\Http\Request;

class VendaController extends Controller
{
    //
    protected static $model  = 'App\Venda';


    public function create(){
        $item = new self::$model();
        
        return view('admin.vendas.create', compact('item'));
    }

    public function store(StoreVendasRequest $request){
        self::$model::create($request->all());
        return redirect()->route('vendas.index');
    }

    public function destroy($model){
        $model=self::$model::findOrFail($model);   $model->delete();
        return redirect()->route('vendas.index');
    }

    public function index(){
        $items = self::$model::paginate(15);
        return view('admin.vendas.index', compact('items'));
    }


    public function show($id){
        $item = self::$model::findOrFail($id);
        return view('admin.vendas.show', compact('item'));
    }

    public function edit($id){
        $item = self::$model::findOrFail($id);

        

        return view('admin.vendas.update', compact('item'));
    }

    public function update($id, UpdateVendasRequest $request){
        $item = self::$model::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('vendas.index');
    }



}