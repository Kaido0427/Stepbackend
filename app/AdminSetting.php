<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminSetting extends Model
{
    //
    protected $fillable = [
        'name', 'pp', 'country_code', 'verification', 'notification', 'license_code', 'client_name', 'license_status',
         'app_id', 'rest_api_key', 'user_auth_key',
        'project_number', 'owner_app_id', 'owner_rest_api_key', 'owner_auth_key', 'guard_app_id', 'guard_rest_api_key', 'guard_auth_key', 'currency_id',
        'currency',
        'color',
        'logo',
        'white_logo',
        'favicon',
        'bg_img',
        'currency_symbol',
        'stripe_status',
        'stripe_secret',
        'stripe_public',
        'razorpay_status',
        'razorpay_key',
        'paypal_status',
        'paypal_sandbox',
        'paypal_production',
        'paypal_client_id',
        'paypal_secret_key',
        'flutterwave_status',
        'flutterwave_key', 'isLiveMode', 'timezone', 'map_key',
        'trial_days',
        'mail_driver','mail_host','mail_port','mail_username','mail_password','mail_encryption','mail_from_address','mail_from_name',
        'twilio_id','twilio_auth_token','twilio_number',
    ];
    protected $table = 'admin_setting';
}
