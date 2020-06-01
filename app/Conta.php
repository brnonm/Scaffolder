<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    //
    protected $table = "contas";
    protected $fillable=["id","user_id","nome","descricao","saldo_abertura","saldo_atual","data_ultimo_movimento","deleted_at"];

}