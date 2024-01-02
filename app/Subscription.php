<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscription';

    protected $fillable = ['subscription_name','plan','status','max_space_limit'];


    public function owner()
    {
        return $this->belongsTo('App\ParkingOwner', 'owner_id', 'id');
    }
    
}
