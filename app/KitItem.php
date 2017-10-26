<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KitItem extends Model
{
    protected $fillable = [
        'title', 'content', 'customer_id', 'amount', 'kit_item_id', 'kit_id'
    ];

    public function kit()
    {
        return $this->belongsTo('App\Kit');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function items()
    {
        return $this->hasMany('App\KitItem');
    }

}
