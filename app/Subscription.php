<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    public function series()
    {
        return $this->belongsTo('App\Series');
    }
}
