<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Migration extends Model
{
    //
    public $timestamps = false;
    protected $table = "migrations";
    protected $fillable=["id","migration","batch"];






}
