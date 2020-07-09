<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
    protected $table = "clientes";
    protected $fillable=["id","nome","tipocliente","contacto","morada","ncontrib","codigo","cdpostal","local","email","ncabecas","datacri","created_at","updated_at","deleted_at"];







    public function tipoclienteRel(){
        return $this->hasOne('App\TipoCliente', "id", "tipocliente");
    }

    private static $codigo=['0'=>'Nu00e3o aceite','1'=>'Aceite'];

    public function codigoEnum(){
        return self::$codigo[$this->codigo]??"";
    }
                        


}