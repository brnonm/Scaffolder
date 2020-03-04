<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FailedJobController extends Controller
{
    //
    protected static $modelName = 'app/Failed_job.php';

        public function index()
        {
            $items=self:: $modelName::all();
            return view('scaffolder.views.index', compact('items'));
        }

        public function create()
        {
            $item = new self::$modelName();
            return view('scaffolder.views.create', compact('item'));
        }

}