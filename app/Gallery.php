<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{

	protected $fillable = [
        'title', 'campaign_id'
    ];

    public function images()
    {
        return $this->hasMany('App\GalleryImage');
    }

    public function campaign()
    {
        return $this->belongsTo('App\Campaign');
    }
    
}
