<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    //
    protected $table = "categories";
    protected $fillable=["id","name","created_at","updated_at"];


}