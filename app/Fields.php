<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fields extends Model
{
    public $timestamps = false;


    protected $fillable = [
        "title",
        "type",
        "value",
        "subscriber_id",
    ];

    public function subscriber()
    {
        return $this->belongsTo(Subscribers::class)->onDelete('cascade');;
    }
}
