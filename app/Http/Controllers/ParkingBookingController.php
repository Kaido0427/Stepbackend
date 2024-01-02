<?php

namespace App\Http\Controllers;

use App\AdminSetting;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
class ParkingBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Display the specified resource.
     *
     * @param  \App\ParkingBooking  $parkingBooking
     * @return \Illuminate\Http\Response
     */
   
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ParkingBooking  $parkingBooking
     * @return \Illuminate\Http\Response
     */
 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ParkingBooking  $parkingBooking
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ParkingBooking  $parkingBooking
     * @return \Illuminate\Http\Response
     */
 

    

    private function paymentByStripe($key, $token, $amt)
    {
        \Stripe\Stripe::setApiKey($key);
        $charge = \Stripe\Charge::create([
            'source' => $token,
            'currency' => 'usd',
            'amount' => $amt * 100,
        ]);
        return $charge['id'];
    }





}
