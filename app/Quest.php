<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    protected $fillable = [
        "user_id",
        "name",
        "description",
        "icon",
    ];

    
    public function user() {
        return $this->belongsTo('App\Quest');
    }

    public function goals() {
        return $this->belongsToMany('App\Goal');
    }
}
