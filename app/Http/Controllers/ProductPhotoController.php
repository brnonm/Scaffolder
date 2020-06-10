<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreProductPhotosRequest;
use App\Http\Requests\UpdateProductPhotosRequest;

use App\Http\Requests\StoreProductPhotosRequest;
use App\Http\Requests\UpdateProductPhotosRequest;


use Illuminate\Http\Request;

class ProductPhotoController extends Controller
{
    //
    protected static $model  = 'App\ProductPhoto';


    public function create(){

        $item = new self::$model();

        
        return view('admin.product_photos.create', compact('item'));
    }

    public function store(StoreProductPhotosRequest $request){
        self::$model::create($request->all());
        return redirect()->route('product_photos.index');
    }

    public function destroy($model){
        $model=self::$model::findOrFail($model);   $model->delete();
        return redirect()->route('product_photos.index');
    }

    public function index(){
        $items = self::$model::paginate(15);
        return view('admin.product_photos.index', compact('items'));
    }


    public function show($id){
        $item = self::$model::findOrFail($id);
        return view('admin.product_photos.show', compact('item'));
    }

    public function edit($id){
        $item = self::$model::findOrFail($id);

        

        return view('admin.product_photos.update', compact('item'));
    }

    public function update($id, UpdateProductPhotosRequest $request){
        $item = self::$model::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('product_photos.index');
    }





}