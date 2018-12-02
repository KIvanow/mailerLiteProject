<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fields extends Model
{
    public $timestamps = false;


    protected $fillable = [
        "subscriber_id",
        "title",
        "type",
        "value"
    ];

    public function subscriber()
    {
        return $this->belongsTo(Subscribers::class)->onDelete('cascade');
    }
}
