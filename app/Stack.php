<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stack extends Model
{
    public function sheets()
    {
        return $this->hasMany('App\Sheet');
    }

    public function type()
    {
        return $this->belongsTo('App\TypeStack');
    }

    public function creator()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
}
