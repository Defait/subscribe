<?php

namespace App;

use App\Helpers\TVShowHelper;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    protected $fillable = [
        'title', 'slug', 'synopsis', 'url_location', 'cover_img_location',
    ];

    public function subscriptions()
    {
        return $this->hasMany('App\Subscription');
    }

}
