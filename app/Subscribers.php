<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscribers extends Model
{
    public $timestamps = false;

    protected $fillable = [
        "email",
        "name",
        "state",
    ];
}
