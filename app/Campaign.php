<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{

    protected $dates = array('data');

    protected $fillable = [
		'title', 'data'
	];

	public function customers()
    {
        return $this->hasMany('App\Customer');
    }

    public function users(){
    	return $this->belongsToMany('App\User');
    }
}
