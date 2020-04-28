<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WalletController extends Controller
{
    //
    protected static $model = 'App\Wallet';


    public
    function create()
    {
        $item = new self::$model();
        return view('admin.wallets.create', compact('item'));
    }

    public
    function store(Request $request)
    {
        self::$model::create($request->all());
        return redirect()->route('wallets.index');
    }

    public function destroy($model)
    {
        $model = self::$model::findOrFail($model);
        $model->delete();
        return redirect()->route('wallets.index');
    }

    public
    function index()
    {
        $items = self::$model::paginate(15);
        return view('admin.wallets.index', compact('items'));
    }


    public function show($id)
    {
        $item = self::$model::findOrFail($id);
        return view('admin.wallets.show', compact('item'));
    }

    public function edit($id)
    {
        $item = self::$model::findOrFail($id);
        return view('admin.wallets.update', compact('item'));
    }

    public function update($id, Request $request)
    {
        $item = self::$model::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('wallets.index');
    }


}
