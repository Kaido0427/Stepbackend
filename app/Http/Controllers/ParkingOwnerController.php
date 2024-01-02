<?php

namespace App\Http\Controllers;

use App\ParkingGuard;
use App\ParkingOwner;
use App\ParkingSpace;
use App\SubscriptionBuy;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ParkingOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }
    public function adminIndex()
    {
        $parkingOwner = ParkingOwner::get();
        return view('parkingOwner.index',compact('parkingOwner'));
    }

    public function ownerSpaceDetail($id)
    {
        $parkingSpace = ParkingSpace::where('owner_id', $id)->get();
        return view('parkingOwner.spaceView',compact('parkingSpace'));
    }
    public function login(Request $request)
    {
        //
        $request->validate([
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:6',
        ]);
        if ($request->type === 'owner') {

            $user = ParkingOwner::where('email', $request->email)->first();
        } else {

            $user = ParkingGuard::where('email', $request->email)->first();
        }
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                if ($request->type === 'owner' && $user['verified'] != 1) {
                    return response()->json(['msg' => 'Please Verify your email', 'data' => null, 'success' => false], 200);
                }
                $subscription = SubscriptionBuy::where([['owner_id',$user->id],['status',1]])->first();
                if ($subscription)
                {
                    $cDate = Carbon::now()->format('Y-m-d');
                    if($subscription->end_at > $cDate)
                    {
                        // subscription active
                        $user->update(['subscription_status' => 1]);
                    }
                    else
                    {
                        // subscription expire
                        $user->update(['subscription_status' => 0]);
                    }
                }
                else
                {
                    $user->update(['subscription_status' => 0]);
                }
                $token = $user->createToken('stepOwner')->accessToken;
                $user['device_token'] = $request->device_token;
                $user->save();
                $user['token'] = $token;
                return response()->json(['msg' => 'lOGIN ', 'data' => $user, 'success' => true], 200);
            } else {
                return response()->json(['message' => 'Password does not match!'], 401);
            }
        } else {
            return response()->json(['message' => 'User doesn\'t exist!'], 401);
        }
    }
    
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
     * @param  \App\ParkingOwner  $parkingOwner
     * @return \Illuminate\Http\Response
     */
    public function show(ParkingOwner $parkingOwner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ParkingOwner  $parkingOwner
     * @return \Illuminate\Http\Response
     */
    public function edit(ParkingOwner $parkingOwner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ParkingOwner  $parkingOwner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParkingOwner $parkingOwner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ParkingOwner  $parkingOwner
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParkingOwner $parkingOwner)
    {
        //
    }
    
    
}
