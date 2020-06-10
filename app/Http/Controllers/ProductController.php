<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreProductsRequest;
use App\Http\Requests\UpdateProductsRequest;


use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    protected static $model  = 'App\Product';


    public function create(){
        $item = new self::$model();
        return view('admin.products.create', compact('item'));
    }

    public function store(StoreProductsRequest $request){
        self::$model::create($request->all());
        return redirect()->route('products.index');
    }

    public function destroy($model){
        $model=self::$model::findOrFail($model);   $model->delete();
        return redirect()->route('products.index');
    }

    public function index(){
        $items = self::$model::paginate(15);
        return view('admin.products.index', compact('items'));
    }


    public function show($id){
        $item = self::$model::findOrFail($id);
        return view('admin.products.show', compact('item'));
    }

    public function edit($id){
        $item = self::$model::findOrFail($id);
        return view('admin.products.update', compact('item'));
    }

    public function update($id, UpdateProductsRequest $request){
        $item = self::$model::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('products.index');
    }

}
