<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kit extends Model
{
    protected $fillable = [
        'title', 'content', 'campaign_id'
    ];

    public function items()
    {
        return $this->hasMany('App\KitItem');
    }

/*
    public function itemsKitItemIdWhereNull()
    {
        return $this->hasMany('App\KitItem')->whereNull('kit_item_id');
    }


    public function itemsCustomers($id_customer)
    {
        return $this->hasMany('App\KitItem')->where(['customer_id' => $id_customer]);
    }
*/
    public function campaign()
    {
        return $this->belongsTo('App\Campaign');
    }
}
