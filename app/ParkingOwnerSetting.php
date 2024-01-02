<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingOwnerSetting extends Model
{
    use HasFactory;
    protected $table = 'parking_owner_setting';
    protected $fillable = [
    'owner_id',
    'cod',
    'stripe_status',
    'stripe_secret',
    'stripe_public',
    'razorpay_status',
    'razorpay_key',
    'paypal_status',
    'paypal_client_key',
    'paypal_secret_key',
    'flutterwave_status',
    'flutterwave_key',
    'isLiveMode',
];
    public  $timestamps =false;
}
