<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class SubscriptionBuy extends Model
{
    //
    protected $fillable = [
        'owner_id', 'subscription_id', 'price', 'start_at', 'end_at','payment_status','status','duration','payment_token','payment_type'
    ];
    protected $table = 'subscription_buy';

    public function owner()
    {
        return $this->belongsTo('App\ParkingOwner', 'owner_id', 'id');
    }

    public function subscription()
    {
        return $this->belongsTo('App\Subscription', 'subscription_id', 'id');
    }
}
