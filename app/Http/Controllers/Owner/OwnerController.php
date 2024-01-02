<?php

namespace App\Http\Controllers\Owner;

use App\AdminSetting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ParkingOwner;
use App\ParkingOwnerSetting;
use App\ParkingBooking;
use App\ParkingGuard;
use App\ParkingSpace;
use App\SubscriptionBuy;
use App\Facilities;
use App\AppUsers;
use App\Subscription;
use Hash;
use Carbon\Carbon;
use \Stripe as Stripe;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Stripe\StripeClient;

class OwnerController extends Controller
{
    public function __construct()
    {
        try {
            $setting = AdminSetting::first();
            Stripe\Stripe::setApiKey($setting->stripe_secret_key);
        } catch (\Throwable $th) {
        }
    }

    public function loginView()
    {
        if (Auth::guard('owner')->check()) {
            Auth::guard('owner')->logout();
            return  view('owner.auth.login');
        } else {
            return  view('owner.auth.login');
        }
    }
    public function registerView()
    {
        if (Auth::guard('owner')->check()) {
            Auth::guard('owner')->logout();
            return view('owner.auth.register');
        } else {
            return view('owner.auth.register');
        }
    }
    public function index()
    {
        $Tuser = AppUsers::all()->count();
        $Tguard = ParkingGuard::where('owner_id', Auth::guard('owner')->user()->id)->count();
        $Tspace = ParkingSpace::where('owner_id', Auth::guard('owner')->user()->id)->count();
        $Tbooking = ParkingBooking::where('owner_id', Auth::guard('owner')->user()->id)->count();
        $Tsubscription = SubscriptionBuy::where('owner_id', Auth::guard('owner')->user()->id)->count();
        $Tverify = ParkingSpace::where('owner_id', Auth::guard('owner')->user()->id)->where('verified', 1)->count();
        $facilities_data = Facilities::limit(5)->get();
        $Vdata = ParkingSpace::where('owner_id', Auth::guard('owner')->user()->id)->where('verified', 1)->get()->each->setAppends(['avg_rating']);
        foreach ($Vdata as $value) {
            $tempData = ParkingBooking::where('space_id', $value['id'])->get();
            $value['total_booking'] = count($tempData);
            $value['total_earning'] = (string) $tempData->sum('total_amount');
        }
        $space_data = collect($Vdata)->sortByDesc('total_earning')->take(5);
        $Udata = AppUsers::limit(5)->get(['name', 'id']);
        foreach ($Udata as $value) {
            $value['total_booking'] = ParkingBooking::where('owner_id', Auth::guard('owner')->user()->id)->where('user_id', $value['id'])->get()->count();
            $value['booking'] = rand(0, 100);
        }
        $now = Carbon::now();
        $totalmonthbooking = ParkingBooking::where('owner_id', Auth::guard('owner')->user()->id)->whereMonth('created_at', $now->month)->count();
        return view('owner.dashboard', compact('Tguard', 'Tspace', 'Tbooking', 'Tverify', 'totalmonthbooking', 'Tsubscription', 'facilities_data', 'space_data', 'Udata', 'Tuser'));
    }
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'bail|required|email|unique:parking_owner,email',
            'name' => 'bail|required',
            'password' => 'bail|required|min:6',
            'password_confirmation' => 'bail|required|same:password',
        ]);
        $data = $request->all();
        $data['subscription_status'] = 1;
        $data = ParkingOwner::create($data);
        $subscription = Subscription::where('subscription_name', 'Free')->first();
        $admin_setting = AdminSetting::first();
        SubscriptionBuy::create([
            'owner_id' => $data->id,
            'subscription_id' => $subscription['id'],
            'price' => 0,
            'status' => 1,
            'payment_status' => 1,
            'duration' => 1,
            'start_at' => Carbon::now()->format('Y-m-d'),
            'end_at' => Carbon::now(env('timezone'))->addDay($admin_setting->trial_days)->format('Y-m-d'),
        ]);
        ParkingOwnerSetting::create([
            'owner_id' => $data->id,
        ]);
        Auth::guard('owner')->loginUsingId($data->id);
        return redirect('owner/dashboard')->with('success', 'Registered Successfully');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:6',
        ]);
        $remember = $request->get('remember');
        if (Auth::guard('owner')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            $owner = Auth::guard('owner')->user();
            if ($owner->status == 1) {
                if ($owner->verified == 1) {
                    $subscription = SubscriptionBuy::where([['owner_id', $owner->id], ['status', 1]])->first();
                    if ($subscription) {
                        $cDate = Carbon::now()->format('Y-m-d');
                        if ($subscription->end_at > $cDate)
                            $owner->update(['subscription_status' => 1]); // subscription active
                        else
                            $owner->update(['subscription_status' => 0]); // subscription expire
                    } else
                        $owner->update(['subscription_status' => 0]);
                    return redirect('owner/dashboard')->with('success', 'successful login');
                } else {
                    return back()->with('error', 'Please Your Account  Verifid');
                }
            } else {
                return back()->with('error', 'owner blocked');
            }
        } else {
            return back()->with('error', 'Please Check Your Email and Password');
        }
    }

    public function logout()
    {
        if (Auth::guard('owner')->check()) {
            Auth::guard('owner')->logout();
            return redirect('owner/login');
        }
    }

    public function profile()
    {
        return view('owner.profile.edit');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'bail|required',
            'email' => 'bail|required|email',
            'phone' => 'bail|required',
        ]);
        $data = Auth::guard('owner')->user();
        if ($request->hasFile('photo')) {
            if (\File::exists(public_path('/upload' . $data->image))) {
                \File::delete(public_path('/upload' . $data->image));
            }
            $image = $request->file('photo');
            $name = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/upload');
            $image->move($destinationPath, $name);
            $data->image = $name;
        }
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone_no = $request->phone;
        $data->update();
        return back()->withStatus(__('Profile successfully updated.'));
    }

    public function changePassword(Request $request)
    {

        if (Hash::check($request->old_password, Auth::guard('owner')->user()->password)) {
            $password = $request->password;
            ParkingOwner::findOrFail(Auth::guard('owner')->user()->id)->update(['password' => $password]);
            return back()->with('password_status', 'Password successfully updated.');
        } else
            return back()->with('passworderror', 'Current Password  does not match');
    }

    public function setting()
    {
        $ownerSetting = ParkingOwnerSetting::where('owner_id', Auth::guard('owner')->user()->id)->first();
        return view('owner.setting.setting', compact('ownerSetting'));
    }

    public function settingPayments(Request $request)
    {
        $paymentSetting = ParkingOwnerSetting::where('owner_id', Auth::guard('owner')->user()->id)->first();
        $request->validate([
            'stripe_secret' => 'bail|required_if:stripe_status,1',
            'stripe_public' => 'bail|required_if:stripe_status,1',
            'razorpay_key' => 'bail|required_if:razorpay_status,1',
            'paypal_client_key' => 'bail|required_if:paypal_status,1',
            'paypal_secret_key' => 'bail|required_if:paypal_status,1',
            'flutterwave_key' => 'bail|required_if:flutterwave_status,1',
        ]);
        $data = $request->all();
        $data['stripe_status'] = $request->has('stripe_status') ? 1 : 0;
        $data['razorpay_status'] = $request->has('razorpay_status') ? 1 : 0;
        $data['paypal_status'] = $request->has('paypal_status') ? 1 : 0;
        $data['cod'] = $request->has('cod') ? 1 : 0;
        $data['flutterwave_status'] = $request->has('flutterwave_status') ? 1 : 0;
        $paymentSetting->update($data);
        return back()->with('status', 'PaymentSetting updated.');
    }

    public function bookuser()
    {
        $parkingBooking = ParkingBooking::where('owner_id', Auth::guard('owner')->user()->id)->orderBy('id', 'desc')->get();
        return view('owner.bookeduser.index', compact('parkingBooking'));
    }

    public function bookingStatus(Request $request)
    {
        $status = ParkingBooking::find($request->id);
        $status->status = $request->changestatus;
        $status->update();
        return redirect('owner/bookuser')->with('status', 'Status Successful Changed');
    }

    public function bookingPaymentStatus(Request $request)
    {
        $status = ParkingBooking::find($request->id);
        $status->payment_status = $request->changepaymentstatus;
        $status->update();
        return redirect('owner/bookuser')->with('status', 'Status Successful Changed');
    }

    public function subscription()
    {
        $adminSettings = AdminSetting::first();
        $subscriptions = Subscription::where('status', 1)->get();
        $purchase = SubscriptionBuy::where([['owner_id', Auth::guard('owner')->user()->id], ['status', 1]])->first();
        return view('owner.subplan.index', compact('subscriptions', 'adminSettings', 'purchase'));
    }
   

    public function transection()
    {
        return view('owner.transection.create');
    }

    public function transectionCustom(Request $request)
    {
        $startdate = Carbon::parse($request->startdate);
        $enddate = Carbon::parse($request->enddate);
        $parkingSpace = ParkingSpace::where('owner_id', Auth::guard('owner')->user()->id)->get()->pluck('id')->toArray();
        $data = ParkingBooking::whereIn('space_id',  $parkingSpace)->whereBetween('arriving_time', [$startdate->format('Y-m-d'), $enddate->format('Y-m-d')])->orderBy('user_id')->get();
        $temp = array();
        foreach ($data as $value) {
            $userCount = ParkingBooking::with(['user'])->whereIn('space_id', $parkingSpace)->where('user_id', $value['user_id'])
                ->whereBetween('arriving_time', [$startdate->format('Y-m-d'),  $enddate->format('Y-m-d')])->get();
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
        return  view('owner.transection.index', compact('tempData'));
    }

    public function transectionAll(Request $request)
    {
        $date = Carbon::today();
        if ($request->type === 'week') {
            $parkingSpace = ParkingSpace::where('owner_id', Auth::guard('owner')->user()->id)->get()->pluck('id')->toArray();
            $data = ParkingBooking::whereIn('space_id',  $parkingSpace)->whereBetween('arriving_time', [$date->startOfWeek()->format('Y-m-d'),  $date->endOfWeek()->format('Y-m-d')])->orderBy('user_id')->get();
            $temp = array();
            foreach ($data as $value) {
                $userCount = ParkingBooking::with(['user'])->whereIn('space_id', $parkingSpace)->where('user_id', $value['user_id'])
                    ->whereBetween('arriving_time', [$date->startOfWeek()->format('Y-m-d'),  $date->endOfWeek()->format('Y-m-d')])->get();
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
            return  view('owner.transection.index', compact('tempData'));
        } else if ($request->type === 'today') {
            $parkingSpace = ParkingSpace::where('owner_id', Auth::guard('owner')->user()->id)->get()->pluck('id')->toArray();
            $data = ParkingBooking::whereIn('space_id',  $parkingSpace)->whereDate('arriving_time', Carbon::today())->orderBy('user_id')->get();
            $temp = array();
            foreach ($data as $value) {
                $userCount = ParkingBooking::with(['user'])->whereIn('space_id', $parkingSpace)->where('user_id', $value['user_id'])
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
            return  view('owner.transection.index', compact('tempData'));
        } else if ($request->type === 'month') {
            $parkingSpace = ParkingSpace::where('owner_id', Auth::guard('owner')->user()->id)->get()->pluck('id')->toArray();
            $data = ParkingBooking::whereIn('space_id',  $parkingSpace)->whereMonth('arriving_time', $date->month)->orderBy('user_id')->get();
            $temp = array();
            foreach ($data as $value) {

                $userCount = ParkingBooking::with(['user'])->whereIn('space_id', $parkingSpace)->where('user_id', $value['user_id'])
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
            return  view('owner.transection.index', compact('tempData'));
        }
    }

    public function purchase_subscription(Request $request)
    {
        $data = $request->all();
        $currency = AdminSetting::find(1)->currency;
        try {
            if ($request->payment_type == 'STRIPE') {
                $amount = $data['amount'] * 100;
                $stripe_sk = AdminSetting::first()->stripe_secret;
                $stripe = new StripeClient($stripe_sk);
                $charge = $stripe->charges->create([
                    "amount" => $amount,
                    "currency" => $currency,
                    "source" => $request->payment_token,
                ]);
                $data['payment_token'] = $charge->id;
            }

            Auth::guard('owner')->user()->update(['subscription_status' => 1]);
            SubscriptionBuy::where('owner_id', Auth::guard('owner')->user()->id)->get()->each->update(['status' => 0]);
            SubscriptionBuy::create([
                'owner_id' => Auth::guard('owner')->user()->id,
                'subscription_id' => $data['subscription_id'],
                'price' => $data['amount'],
                'payment_status' => 1,
                'status' => 1,
                'payment_token' => $data['payment_token'],
                'duration' => $data['duration'],
                'start_at' => Carbon::now()->format('Y-m-d'),
                'end_at' => Carbon::now(env('timezone'))->addMonths($data['duration'])->format('Y-m-d'),
                'payment_type' => $data['payment_type'],
            ]);
        } catch (\Throwable $th) {
            return response(['success' => false]);
        }
        return response(['success' => true]);
    }

    public function subscriptionHistory()
    {
        $subscriptions = SubscriptionBuy::with('subscription')->where('owner_id', Auth::guard('owner')->user()->id)->orderBy('id', 'desc')->get();
        return view('owner.subscription_history', compact('subscriptions'));
    }
}
