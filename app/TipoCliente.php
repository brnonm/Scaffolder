<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoCliente extends Model
{
    //
    protected $table = "tipo_clientes";
    protected $fillable=["id","title","created_at","updated_at","deleted_at"];


}