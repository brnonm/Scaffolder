<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    //
    protected static $modelName  = '\App\Appointment';
        public function index()
        {
             $items=self::$modelName::all();
            return view('scaffolder.views.index', compact('items'));
        }

        public function create()
        {
            $item= new self::$modelName();
            return view('scaffolder.views.create', compact('item'));
        }

        public function destroy($model)
        {
            $model->delete();
            return redirect()->route('$modelName.index');
        }

           public function update($model)       {
     }

}
