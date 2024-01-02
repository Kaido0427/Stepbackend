<?php

namespace App\Http\Controllers\Api;

use App\AdminSetting;
use App\Http\Controllers\AppHelper;
use App\Http\Controllers\Controller;
use App\Notifications\SendPassword;
use App\ParkingBooking;
use App\ParkingGuard;
use App\ParkingImage;
use App\ParkingOwner;
use App\ParkingSpace;
use App\Review;
use App\SpaceZone;
use App\SubscriptionBuy;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class GuardApiController extends Controller
{
    public function login(Request $request)
    {
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
    public function guardForgotPassword(Request $request)
    {
        $password = rand(100000, 999999);
        $setting = AdminSetting::first();
        $gard =  ParkingGuard::where('email', $request->email)->first();
        if ($gard) {
            $gard->password = $password;
            $gard->save();
            $config = array(
                'driver'     => $setting->mail_driver,
                'host'       => $setting->mail_host,
                'port'       => $setting->mail_port,
                'from'       => array('address' => $setting->mail_from_address, 'name' => $setting->mail_from_name),
                'encryption' => $setting->mail_encryption,
                'username'   => $setting->mail_username,
                'password'   => $setting->mail_password
            );
            Config::set('mail', $config);
            $gard->notify(new SendPassword($password));
            return response()->json(['msg' => 'Password send to your email address', 'data' => null, 'success' => true], 200);
        } 
        return response()->json(['msg' => 'No User Found ', 'data' => null, 'success' => false], 200);  
    }
    public function showParkingSpace($id)
    {
        $data['space'] = ParkingSpace::with(['guards', 'zones.slots'])->findOrFail($id)->setAppends(['facilitiesData', 'vehicleTypeData']);
        $data['booking'] = ParkingBooking::with(['user', 'vehicle:id,model,vehicle_no'])->where([['space_id', $id]])->get();//whereDate('arriving_time', Carbon::today())->get();
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }
    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'bail|required',
            'phone_no' => 'bail|required',
        ]);
        $data = $request->all();
        if ($request->has('image')) {
            $data['image'] = (new AppHelper)->saveBase64($request->image);
        }
        auth()->user()->update($data);
        return response()->json(['msg' => 'Profile Updated', 'data' => null, 'success' => true], 200);
    }
    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'password' => 'bail|required|confirmed|min:6',
        ]);
        auth()->user()->update($request->all());
        return response()->json(['msg' => 'Password is changed', 'data' => null, 'success' => true], 200);
    }
    public function spaceReview($id)
    {
        $review =  Review::with(['user'])->where('space_id', $id)->get();
        return response()->json(['msg' => null, 'data' =>  $review, 'success' => true], 200);
    }
    public function transactionAllInOne($id, $type)
    {
        $date = Carbon::today();
        if ($type === 'week') {
            $data = ParkingBooking::where('space_id', $id)
                ->whereBetween('arriving_time', [$date->startOfWeek()->format('Y-m-d'),  $date->endOfWeek()->format('Y-m-d')])->orderBy('user_id')
                ->get();
            $temp = array();
            foreach ($data as $value) {

                $userCount = ParkingBooking::with(['user'])->where([['space_id', $id], ['user_id', $value['user_id']]])
                    ->whereBetween('arriving_time', [$date->startOfWeek()->format('Y-m-d'),  $date->endOfWeek()->format('Y-m-d')])
                    ->get();
                array_push($temp, [
                    'user' => $userCount[0]['user'],
                    'user_id' => $userCount[0]['user_id'],
                    'total' => $userCount->sum('total_amount')
                ]);
            }
            $coll = collect($temp);
            $unique = $coll->unique('user_id');
            $tempData = array();
            $tempData['grandTotal'] = $unique->sum('total');
            $tempData['data'] = $unique;
            return response()->json(['msg' => null, 'data' => $tempData, 'success' => true], 200);
        } else if ($type === 'day') {
            $data = ParkingBooking::where('space_id', $id)
                ->whereDate('arriving_time', Carbon::today())->orderBy('user_id')
                ->get();
            $temp = array();
            foreach ($data as $value) {
                $userCount = ParkingBooking::with(['user'])->where([['space_id', $id], ['user_id', $value['user_id']]])
                    ->whereDate('arriving_time', Carbon::today())
                    ->get();
                array_push($temp, [
                    'user' => $userCount[0]['user'],
                    'user_id' => $userCount[0]['user_id'],
                    'total' => $userCount->sum('total_amount')
                ]);
            }
            $coll = collect($temp);
            $unique = $coll->unique('user_id');
            $tempData = array();
            $tempData['grandTotal'] = $unique->sum('total');
            $tempData['data'] = array_values($unique->toArray());
            return response()->json(['msg' => null, 'data' => $tempData, 'success' => true], 200);
        } else if ($type === 'month') {
            $data = ParkingBooking::where('space_id', $id)
                ->whereMonth('arriving_time', $date->month)->orderBy('user_id')
                ->get();
            $temp = array();
            foreach ($data as $value) {
                $userCount = ParkingBooking::with(['user'])->where([['space_id', $id], ['user_id', $value['user_id']]])
                    ->whereMonth('arriving_time', $date->month)->whereYear('arriving_time', $date->year)
                    ->get();
                array_push($temp, [
                    'user' => $userCount[0]['user'],
                    'user_id' => $userCount[0]['user_id'],
                    'total' => $userCount->sum('total_amount')
                ]);
            }
            $coll = collect($temp);
            $unique = $coll->unique('user_id');
            $tempData = array();
            $tempData['grandTotal'] = $unique->sum('total');
            $tempData['data'] = array_values($unique->toArray());
            return response()->json(['msg' => null, 'data' => $tempData, 'success' => true], 200);
        }
        ParkingBooking::where('space_id', $id);
    }
    public function transactionCustom(Request $request, $id)
    {
        $Sdate = Carbon::parse($request->start_date);
        $Edate = Carbon::parse($request->end_date);

        $data = ParkingBooking::where('space_id', $id)
            ->whereBetween('arriving_time', [$Sdate->format('Y-m-d'),  $Edate->format('Y-m-d')])->orderBy('user_id')
            ->get();
        $temp = array();
        foreach ($data as $value) {
            $userCount = ParkingBooking::with(['user'])->where([['space_id', $id], ['user_id', $value['user_id']]])
                ->whereBetween('arriving_time', [$Sdate->format('Y-m-d'),  $Edate->format('Y-m-d')])
                ->get();
            array_push($temp, [
                'user' => $userCount[0]['user'],
                'user_id' => $userCount[0]['user_id'],
                'total' => $userCount->sum('total_amount')
            ]);
        }
        $coll = collect($temp);
        $unique = $coll->unique('user_id');
        $tempData = array();
        $tempData['grandTotal'] = $unique->sum('total');
        $tempData['data'] = $unique;
        return response()->json(['msg' => null, 'data' => $tempData, 'success' => true], 200);
    }
    public function ownerShow($id)
    {
        $data = ParkingBooking::with(['user', 'vehicle:id,model,vehicle_no'])->where([['id', $id]])->get()->first();
        return response()->json(['msg' => 'Thanks', 'data' => $data, 'success' => true], 200);
    }
    public function updateParkingBooking(Request $request, $id)
    {
        $data = ParkingBooking::find($id);
        $data->payment_status = $request->payment_status;
        $data->status = $request->status;
        $data->save();
        $app = AdminSetting::get(['id', 'notification'])->first();
        $data = ParkingBooking::with(['user', 'vehicle:id,model,vehicle_no', 'space:id,title,address'])->where([['id', $id]])->get()->first();
        $temp = true;
        $header = '';
        $text = '';
        if ($request->status == '1') {
           
            $header = $data['space']['title'] . ' welcome`s you';
            $text = 'You are check in for ' . $data['space']['title'] . '   parking space';
        } else if ($request->status == '2') {
            $header = 'Parking with ' . $data['space']['title'] . ' complete';

            $text = 'Thanks for park with' . $data['space']['title'] . ' please visit again';
        } else if ($request->status == '2') {
            $header = 'Important notice by' . $data['space']['title'];

            $text = 'Your parking with' . $data['space']['title'] . ' is cancel please contact us for more info';
        } else if ($request->payment_status == '1') {
            $header = 'Payment received';

            $text = 'Payment complete for ' . $data['space']['title'] . ' parking space thanks for payment';
        } else {
            $temp = false;
        }
        try {
            $userId = $data['user']['device_token'];
            if (isset($userId) && $temp === true  && $app->notification == 1) {
                OneSignal::sendNotificationToUser(
                    $text,
                    $userId,
                    $url = null,
                    $data = null,
                    $buttons = null,
                    $schedule = null,
                    $headings = $header

                );
            }

        } catch (\Throwable $th) {
            //throw $th;
        }
        return response()->json(['msg' => 'Thanks', 'data' => $data, 'success' => true], 200);
    }
    public function liveSlotLocation($id)
    {
        $timezone = AdminSetting::first()->timezone;
        $start = Carbon::now($timezone)->format('Y-m-d H:i:s');
        $end = Carbon::now($timezone)->addMinute('60')->format('Y-m-d H:i:s');
        $ps = SpaceZone::with(['slots'])->where('space_id', $id)->get();
        foreach ($ps as  $value) {
            foreach ($value['slots'] as &$slot) {
                $booking = ParkingBooking::with('user:id,name,image','vehicle:id,model,vehicle_no')->where('slot_id', $slot['id'])->whereIn('status', [0, 1])->get();
                if (count($booking) > 0) {
                    foreach ($booking as &$b) 
                    {
                        $a_date = carbon::parse($b->arriving_time)->format('Y-m-d H:i:s');
                        $l_date = carbon::parse($b->leaving_time)->format('Y-m-d H:i:s');
                        $st = carbon::parse($start);
                        $et = Carbon::parse($end);
                     
                        if ($st->between($a_date, $l_date)) {            
                            $slot['available'] = true; 
                            $slot['booking'] = $b->makeHidden(['created_at','updated_at','discount','payment_type','payment_token','payment_status','status']);
                        } else {
                            $slot['available'] = false;
                        }
                    }
                } else {
                    $slot['available'] = false;
                }
            }
        }
        return response()->json(['msg' => null, 'data' => $ps, 'success' => true], 200);
    }
    public function parkingImages($id)
    {
        $data = ParkingImage::where('space_id', $id)->get();
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }
    public function storeParkingImage(Request $request)
    {
        if ($request->images) {
            foreach ($request->images as  $value) {

                $name = (new AppHelper)->saveBase64($value);
                ParkingImage::create([
                    'space_id' => $request->space_id,
                    'image' => $name
                ]);
            }
        }
        return response()->json(['msg' => 'Image Upload ', 'data' => null, 'success' => true], 200);
    }
    public function destroyParkingImage($id)
    {
        ParkingImage::find($id)->delete($id);
        return response()->json(['msg' => 'Image Deleted ', 'data' => null, 'success' => true], 200);
    }
    public function profilePictureUpdate(Request $request)
    {
        $name = (new AppHelper)->saveBase64($request->image);
        auth()->user()->update([
            'image' => $name,
        ]);
        return response()->json(['msg' => 'Profile Updated', 'data' => null, 'success' => true], 200);
    }
    public function allSetting()
    {
        $data = AdminSetting::first()->makeHidden(['paypal_sandbox','paypal_production']);
        $data['country_code'] = $data['country_code'];
        $data['verification'] = $data['verification'];
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }
    public function ownerShowScanner($order)
    {
        $data = ParkingBooking::with(['user', 'vehicle:id,model,vehicle_no'])->where('id', $order)->first();
        return response()->json(['msg' => 'Thanks', 'data' => $data, 'success' => true], 200);
    }
    public function changeStatus(Request $request)
    {
        $request->validate([
            'booking_id' => 'bail|required|numeric|exists:parking_booking,id',
            'status' => 'bail|required|numeric|in:1,2',
        ]);
        ParkingBooking::find($request->booking_id)->update(['status'=> $request->status]);
        return response()->json(['msg' => 'Booking Status change successfully.', 'success' => true]);
    }

    public function displayParkingImages($id)
    {
        try {
            $parkingSpace = ParkingSpace::findOrFail($id);
            $images = $parkingSpace->images; // Supposons que vous avez une relation "images" dans le modèle ParkingSpace

            return response()->json(['images' => $images, 'success' => true], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            return response()->json(['msg' => 'Parking space not found', 'success' => false], 404);
        } catch (\Exception $ex) {
            return response()->json(['msg' => 'An error occurred', 'success' => false], 500);
        }
    }
}
