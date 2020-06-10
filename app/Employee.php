<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $table = "employees";
    protected $fillable=["id","first_name","last_name","phone","email"];
}