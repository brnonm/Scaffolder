<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    //
    protected $table = "vendas";
    protected $fillable=["id","tpdoc","terceiro","data","totdoc","totmerc","quant","created_at","updated_at","deleted_at"];


}