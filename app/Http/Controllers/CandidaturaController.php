<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreCandidaturasRequest;
use App\Http\Requests\UpdateCandidaturasRequest;


use Illuminate\Http\Request;

class CandidaturaController extends Controller
{
    //
    protected static $model  = 'App\Candidatura';


    public function create(){
        $item = new self::$model();
        
        return view('admin.candidaturas.create', compact('item'));
    }

    public function store(StoreCandidaturasRequest $request){
        self::$model::create($request->all());
        return redirect()->route('candidaturas.index');
    }

    public function destroy($model){
        $model=self::$model::findOrFail($model);   $model->delete();
        return redirect()->route('candidaturas.index');
    }

    public function index(){
        $items = self::$model::paginate(15);
        return view('admin.candidaturas.index', compact('items'));
    }


    public function show($id){
        $item = self::$model::findOrFail($id);
        return view('admin.candidaturas.show', compact('item'));
    }

    public function edit($id){
        $item = self::$model::findOrFail($id);

        

        return view('admin.candidaturas.update', compact('item'));
    }

    public function update($id, UpdateCandidaturasRequest $request){
        $item = self::$model::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('candidaturas.index');
    }



}