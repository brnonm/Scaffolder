<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = "products";
    protected $fillable = ["id", "category_id", "name", "description", "stock", "price", "old_price", "created_at", "updated_at"];


    public static $category_id = Categorie::class;

    public function category_idRel()
    {
        return $this->hasOne('App\Categorie', "id", "category_id");

    }

}
