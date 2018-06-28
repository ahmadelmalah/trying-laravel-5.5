<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SheetAnswer extends Model
{
    protected $table = 'sheets_answers';

    public function type()
    {
        return $this->belongsTo('App\TypeSheetAnswer');
    }
}
