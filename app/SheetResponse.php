<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SheetResponse extends Model
{
    protected $table = 'sheets_responses';

    public function sheet()
    {
        return $this->belongsTo('App\Sheet');
    }
}
