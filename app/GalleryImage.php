<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{

	protected $fillable = [
        'title', 'image', 'content', 'gallery_id',
    ];

    public function gallery()
    {
        return $this->belongsTo('App\Gallery');
    }
}
