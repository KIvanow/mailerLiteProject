<?php

namespace App;
use App\Fields;

use Illuminate\Database\Eloquent\Model;
// use App\Fields;

class Subscribers extends Model
{
    public $timestamps = false;

    protected $fillable = [
        "email",
        "name",
        "state",
        "user_id"
    ];

    public function fields()
    {
        return $this->hasMany(Fields::class, "subscriber_id", "id");
    }
}
