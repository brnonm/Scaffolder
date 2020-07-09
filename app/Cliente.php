<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
    protected $table = "clientes";
    protected $fillable = ["id", "nome", "tipocliente", "contacto", "morada", "ncontrib", "codigo", "cdpostal", "local", "email", "ncabecas", "datacri", "created_at", "updated_at", "deleted_at"];


    private static $codigo = ['0' => 'Não aceite', '1' => 'Aceite'];

    public function tipoclienteEnum()
    {
        return self::$tipocliente[$this->tipocliente] ?? "";
    }


}
