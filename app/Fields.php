<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Fields extends Model
{
    public $timestamps = false;


    protected $fillable = [
        "title",
        "type",
        "subscriber_id",
    ];
}
