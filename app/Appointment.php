<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    //
    protected $table = "appointments";
    protected $fillable=["id","employee_id","user_id","service_id","date","start_time","finish_time","comments"];
    public static $fields ;


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::$fields=self::$fillable;
    }
}
