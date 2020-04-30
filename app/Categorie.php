<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    //
    public $timestamps =  false;
    protected $table = "categories";
    protected $fillable=["id","type","name"];






}
