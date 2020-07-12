<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreTipoClientesRequest;
use App\Http\Requests\UpdateTipoClientesRequest;


use Illuminate\Http\Request;

class TipoClienteController extends Controller
{
    //
    protected static $model  = 'App\TipoCliente';


    public function create(){
        $item = new self::$model();
        
        return view('admin.tipo_clientes.create', compact('item'));
    }

    public function store(StoreTipoClientesRequest $request){
        self::$model::create($request->all());
        return redirect()->route('tipo_clientes.index');
    }

    public function destroy($model){
        $model=self::$model::findOrFail($model);   $model->delete();
        return redirect()->route('tipo_clientes.index');
    }

    public function index(){
        $items = self::$model::paginate(15);
        return view('admin.tipo_clientes.index', compact('items'));
    }


    public function show($id){
        $item = self::$model::findOrFail($id);
        return view('admin.tipo_clientes.show', compact('item'));
    }

    public function edit($id){
        $item = self::$model::findOrFail($id);

        

        return view('admin.tipo_clientes.update', compact('item'));
    }

    public function update($id, UpdateTipoClientesRequest $request){
        $item = self::$model::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('tipo_clientes.index');
    }



}