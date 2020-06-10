<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidatura extends Model
{
    //
    protected $table = "candidaturas";
    protected $fillable=["id","curso","nome","email","telefone1","telefone2","genero","media","m23","origem","obs"];



    private static $genero=['M'=>'M','F'=>'F'];

    public function generoEnum(){
        return self::$genero[$this->genero]??"";
    }
                        



    private static $origem=['P'=>'P1','UE'=>'UE1','O'=>'O1'];

    public function origemEnum(){
        return self::$origem[$this->origem]??"";
    }
                        


}