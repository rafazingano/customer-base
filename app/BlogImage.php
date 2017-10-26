<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogImage extends Model
{

	protected $fillable = [
		'image', 'blog_id'
	];

    public function blog()
    {
        return $this->belongsTo('App\Blog');
    }
}
