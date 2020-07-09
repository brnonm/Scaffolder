<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientesRequest;
use App\Http\Requests\UpdateClientesRequest;


use Illuminate\Http\Request;

class ClienteController extends Controller
{
    //
    protected static $model = 'App\Cliente';


    public function create()
    {
        $item = new self::$model();

        return view('admin.clientes.create', compact('item'));
    }

    public function store(StoreClientesRequest $request)
    {
        self::$model::create($request->all());
        return redirect()->route('clientes.index');
    }

    public function destroy($model)
    {
        $model = self::$model::findOrFail($model);
        $model->delete();
        return redirect()->route('clientes.index');
    }

    public function index()
    {
        $items = self::$model::paginate(15);
        return view('admin.clientes.index', compact('items'));
    }


    public function show($id)
    {
        $item = self::$model::findOrFail($id);
        return view('admin.clientes.show', compact('item'));
    }

    public function edit($id)
    {
        $item = self::$model::findOrFail($id);


        return view('admin.clientes.update', compact('item'));
    }

    public function update($id, UpdateClientesRequest $request)
    {
        $item = self::$model::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('clientes.index');
    }


}
