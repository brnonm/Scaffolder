<?php

namespace App\Http\Controllers;


use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AppointmentController extends Controller
{
    //
    protected static $modelName = "\App\\"$m->modelName;

    public function index()
    {
        $items=self::$modelName::all();
        return view('scaffolder.views.index', compact('items'));
    }


    public function create()
    {

        $item = new self::$modelName();
        return view('scaffolder.views.create', compact('item'));
    }



}
