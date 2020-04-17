<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    protected static $modelName  = 'App\User';
        public function index()
        {
             $items=self::$modelName::all();
            return view('users.index', compact('items'));
        }


}