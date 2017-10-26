<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
		'title', 'content', 'image', 'user_id'
	];

	public function images()
    {
        return $this->hasMany('App\BlogImage');
    }
}
