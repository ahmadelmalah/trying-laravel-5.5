<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sheet extends Model
{
    public function stack()
    {
        return $this->belongsTo('App\Stack');
    }

    public function answer()
    {
        return $this->hasOne('App\SheetAnswer');
    }

    public function links()
    {
        return $this->hasMany('App\SheetLink');
    }
}
