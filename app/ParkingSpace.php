<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParkingSpace extends Model
{ 
    //
    protected $fillable = [
        'owner_id', 'vehicle_types', 'title', 'description', 'facilities', 'address', 'lat', 'lng', 'price_par_hour', 'phone_number', 'available_all_day', 'offline_payment', 'verified','price_by_day','price_by_week','price_by_month', 'status', 'close_time', 'open_time'
    ];
    protected $table = 'parking_space';

    public function getFacilitiesDataAttribute()
    {
        // Vérifiez si 'facilities' est vide
        if (empty($this->attributes['facilities'])) {
            return null;
        }
    
        // Convertissez 'facilities' en tableau
        $facilityIds = json_decode($this->attributes['facilities']);
    
        // Vérifiez si le tableau est vide
        if (empty($facilityIds)) {
            return null;
        }
    
        // Recherchez les installations correspondantes dans la table 'Facilities'
        return Facilities::whereIn('id', $facilityIds)->get(['id', 'title', 'image']);
    }
    
    public function getAvgRatingAttribute()
    {
        $revData = Review::where('space_id', $this->attributes['id'])->get();
        $star = $revData->sum('star');
        if ($star > 0) {
            return $star / count($revData);
        }
        return 'N/A';
    }
    public function getVehicleTypeDataAttribute()
    {
        if($this->attributes['vehicle_types'] !== null)
            return VehicleType::where('status', 1)->whereIn('id', explode(',', $this->attributes['vehicle_types']))->get(['id', 'title', 'image']);
        return [];
    }
    public function Images()
    {
        return $this->hasMany('App\ParkingImage', 'space_id', 'id');
    }
    public function Reviews()
    {
        return $this->hasMany('App\Review', 'space_id', 'id');
    }
    public function Zones()
    {
        return $this->hasMany('App\SpaceZone', 'space_id', 'id');
    }
    public function Guards()
    {
        return $this->hasMany('App\ParkingGuard', 'space_id', 'id');
    }
    public function ParkingOwner()
    {
        return $this->belongsTo('App\ParkingOwner', 'owner_id', 'id');
    }
    public function getFacilitiesAttribute()
    {
        return  json_decode($this->attributes['facilities']);
    }
    public function setFacilitiesAttribute($value)
    {
        $this->attributes['facilities'] = json_encode($value);
    }

    public function bookings()
{
    return $this->hasMany(ParkingBooking::class, 'space_id');
}
   
}
