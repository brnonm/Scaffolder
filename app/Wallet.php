<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    //
    protected $table = "wallets";
    protected $fillable=["id","email","balance","created_at","updated_at"];


}