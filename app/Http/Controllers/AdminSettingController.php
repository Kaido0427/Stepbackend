<?php

namespace App\Http\Controllers;

use App\AdminSetting;
use App\AppUsers;
use App\Facilities;
use App\Mail\TestMail;
use App\ParkingBooking;
use App\ParkingGuard;
use App\ParkingOwner;
use App\ParkingSpace;
use App\SubscriptionBuy;
use App\User;
use Carbon\Carbon;
use Exception;
use GPBMetadata\Google\Api\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use LicenseBoxExternalAPI;

use function Psy\debug;

class AdminSettingController extends Controller
{
    public function pp()
    {
        $pp = AdminSetting::first();
        return view('pp.index', ['pp' => $pp]);
    }
    public function websiteContent()
    {
        $webcontent = AdminSetting::first();
        return view('websiteContent.index', ['webcontent' => $webcontent]);
    }
    public function updateWebContent(Request $request)
    {
        $webcontent = AdminSetting::first();
        $webcontent->about_us = $request->about_us;
        $webcontent->update();
        return back();
    }
    public function tc()
    {
        $tc = AdminSetting::first(['terms_condition']);
        return view('tc.index', compact('tc'));
    }
    public function updateTc(Request $request)
    {
        $tc = AdminSetting::first();
        $tc->terms_condition = $request->terms_condition;
        $tc->update();
        return back();
    }

    public function contactUs()
    {
        $data = AdminSetting::first();
        return view('contactUs.index', compact('data'));
    }

    public function allSetting()
    {
        $data = AdminSetting::first()->makeHidden(['paypal_sandbox', 'paypal_production']);
        $data['country_code'] = $data['country_code'];
        $data['verification'] = $data['verification'];
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }

    public function updatePP(Request $request)
    {
        $pp = AdminSetting::first();
        $pp->pp = $request->pp;
        $pp->update();
        return back();
    }

    public function setup(Request $request)
    {
        $data['DB_HOST'] = $request->db_host;
        $data['DB_DATABASE'] = $request->db_name;
        $data['DB_USERNAME'] = $request->db_user;
        $data['DB_PASSWORD'] = $request->db_pass;
        $result = $this->updateENV($data);
        if ($result) {
            $d = User::first();
            $d->update(['email' => $request->email, 'password' => Hash::make($request->password)]);
            return response()->json(['data' => url('login'), 'success' => true], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Don\'t have enough permission for .env file to be written. '], 200);
        }
    }

    public function active(Request $request)
    {
        $api = new LicenseBoxAPI();
        $result = $api->activate_license($request->license_code, $request->name);

        if ($result['status'] === true) {
            return redirect('/');
        } else {
            $request->session()->put('status', $result['message']);
            return Redirect::back();
        }
    }

    public function updateGeneralSetting(Request $request)
    {
        $data = $request->all();
        $adminSetting = AdminSetting::first();
        $currency = DB::table('currency')->where('id', $data['currency_code'])->first();
        if ($request->hasFile('logo')) {
            if (File::exists(public_path('/upload' . $adminSetting['logo']))) {
                File::delete(public_path('/upload' . $adminSetting['logo']));
            }
            $image = $request->file('logo');
            $name = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/upload');
            $image->move($destinationPath, $name);
            $data['logo'] = $name;
        }

        if ($request->hasFile('favicon')) {
            if (File::exists(public_path('/upload' . $adminSetting['favicon']))) {
                File::delete(public_path('/upload' . $adminSetting['favicon']));
            }
            $image = $request->file('favicon');
            $name = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/upload');
            $image->move($destinationPath, $name);
            $data['favicon'] = $name;
        }

        if ($request->hasFile('white_logo')) {
            if (File::exists(public_path('/upload' . $adminSetting['white_logo']))) {
                File::delete(public_path('/upload' . $adminSetting['white_logo']));
            }
            $image = $request->file('white_logo');
            $name = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/upload');
            $image->move($destinationPath, $name);
            $data['white_logo'] = $name;
        }

        if ($request->hasFile('bg_img')) {
            if (File::exists(public_path('/upload' . $adminSetting['bg_img']))) {
                File::delete(public_path('/upload' . $adminSetting['bg_img']));
            }
            $image = $request->file('bg_img');
            $name = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/upload');
            $image->move($destinationPath, $name);
            $data['bg_img'] = $name;
        }

        $data['currency_symbol'] = $currency->symbol;
        $data['currency_id'] = $data['currency_code'];
        $data['trial_days'] = $data['trial_days'];
        $data['currency'] = $currency->code;
        $adminSetting->update($data);
        return redirect('setting')->withStatus(__('General settings updated successfully.'));
    }

    public function index()
    {
        $timezones = DB::table('timezones')->get();
        $data = AdminSetting::first();
        $currencies = DB::table('currency')->get();

        return view('setting.setting', compact(['data', 'currencies', 'timezones']));
    }
    public function updateContactUs(Request $request)
    {

        $data = AdminSetting::first();
        $data['email'] = $request['email'];
        $data['phone'] = $request['phone'];
        $data['address'] = $request['address'];
        $data['queriemail'] = $request['queriemail'];
        $data['facebook_url'] = $request['facebook_url'];
        $data['linkdin_url'] = $request['linkdin_url'];
        $data['instagram_url'] = $request['instagram_url'];
        $data['twitter_url'] = $request['twitter_url'];
        $data->update();
        return redirect('contactus')->withStatus(__('Contact update successfully.'));
    }

    public function dashboard()
    {
        $data['user'] = AppUsers::all()->count();
        $data['owner'] = ParkingOwner::all()->count();
        $data['guard'] = ParkingGuard::all()->count();
        $data['space'] = ParkingSpace::all()->count();
        $data['buy'] = SubscriptionBuy::all()->count();
        $data['verified_space'] = ParkingSpace::where('verified', '1')->get()->count();
        $data['booking'] = ParkingBooking::all()->count();
        $now = Carbon::now();
        $data['month_booking'] = ParkingBooking::whereMonth('created_at', $now->month)->count();
        $Pdata = ParkingOwner::limit(5)->get(['name', 'id']);
        $Pdata->sortBy('total_booking')->toArray();
        foreach ($Pdata as $value) {
            $value['total_space'] = ParkingSpace::where('owner_id', $value['id'])->get()->count();
            $value['total_guard'] = ParkingGuard::where('owner_id', $value['id'])->get()->count();
            $value['total_booking'] = ParkingBooking::where('owner_id', $value['id'])->get()->count();
        }
        $Udata = AppUsers::inRandomOrder()->limit(5)->get(['name', 'id']);

        foreach ($Udata as $value) {
            $value['total_booking'] = ParkingBooking::where('user_id', $value['id'])->get()->count();
            $value['booking'] = rand(0, 100);
        }

        $Vdata = ParkingSpace::where('verified', '1')->get()->each->setAppends(['avg_rating']);
        foreach ($Vdata as $value) {
            $tempData = ParkingBooking::where('space_id', $value['id'])->get();
            $value['total_booking'] = count($tempData);
            $value['total_earning'] = (string) $tempData->sum('total_amount');
        }
        $VsortData = collect($Vdata)->sortByDesc('total_earning')->take(5);
        $facilities_data = Facilities::limit(5)->get();
        return view('dashboard', ['data' => $data, 'owner_data' => $Pdata, 'user_data' => $Udata, 'space_data' => $VsortData, 'facilities_data' => $facilities_data]);
    }

    public function updateEmail(Request $request)
    {
        $adminSetting = AdminSetting::first();
        $adminSetting->email_verification = $request->has('email_verification') ? 1 : 0;
        $adminSetting->update();
        return redirect('setting')->withStatus(__('Email Configuration updated successfully.'));
    }

    public function updatePayments(Request $request)
    {
        $request->validate([
            'stripe_secret' => 'bail|required_if:stripe_status,1',
            'stripe_public' => 'bail|required_if:stripe_status,1',
            'razorpay_key' => 'bail|required_if:razorpay_status,1',
            'paypal_sandbox' => 'bail|required_if:paypal_status,1',
            'paypal_production' => 'bail|required_if:paypal_status,1',
            'paypal_client_id' => 'bail|required_if:paypal_status,1',
            'paypal_secret_key' => 'bail|required_if:paypal_status,1',
            'flutterwave_key' => 'bail|required_if:flutterwave_status,1',
        ]);
        $data = $request->all();
        $data['stripe_status'] = $request->has('stripe_status') ? 1 : 0;
        $data['razorpay_status'] = $request->has('stripe_status') ? 1 : 0;
        $data['paypal_status'] = $request->has('stripe_status') ? 1 : 0;
        $data['flutterwave_status'] = $request->has('stripe_status') ? 1 : 0;
        AdminSetting::first()->update($data);
        return redirect('setting')->withStatus(__('Payment setting updated successfully.'));
    }

    public function updateNotification(Request $request)
    {
        $request->validate([
            'APP_ID' => 'required',
            'REST_API_KEY' => 'required',
            'USER_AUTH_KEY' => 'required',
            'PROJECT_NUMBER' => 'required',
        ]);
        $setting = AdminSetting::first();
        $setting->app_id = $request->APP_ID;
        $setting->rest_api_key = $request->REST_API_KEY;
        $setting->user_auth_key = $request->USER_AUTH_KEY;
        $setting->project_number = $request->PROJECT_NUMBER;
        $setting->update();

        return redirect('setting')->withStatus(__('OneSignal Configuration updated successfully.'));
    }

    public function updateOwnerNotification(Request $request)
    {
        $request->validate([
            'OWNER_APP_ID' => 'required',
            'OWNER_REST_API_KEY' => 'required',
            'OWNER_AUTH_KEY' => 'required',
        ]);
        $setting = AdminSetting::first();
        $setting->owner_app_id = $request->OWNER_APP_ID;
        $setting->owner_rest_api_key = $request->OWNER_REST_API_KEY;
        $setting->owner_auth_key = $request->OWNER_AUTH_KEY;
        $setting->update();

        return redirect('setting')->withStatus(__('OneSignal Configuration updated successfully.'));
    }

    public function updateGuardNotification(Request $request)
    {
        $request->validate([
            'GUARD_APP_ID' => 'required',
            'GUARD_REST_API_KEY' => 'required',
            'GUARD_AUTH_KEY' => 'required',
        ]);
        $setting = AdminSetting::first();
        $setting->guard_app_id = $request->GUARD_APP_ID;
        $setting->guard_rest_api_key = $request->GUARD_REST_API_KEY;
        $setting->guard_auth_key = $request->GUARD_AUTH_KEY;
        $setting->update();

        return redirect('setting')->withStatus(__('OneSignal Configuration updated successfully.'));
    }

    public function updateTwilio(Request $request)
    {

        $data = [
            'TWILIO_SID' => $request->twilio_id,
            'TWILIO_AUTH_TOKEN' => $request->twilio_auth_token,
            'TWILIO_NUMBER' => $request->twilio_number,
        ];
        $verification = 0;
        if ($request->verification == '1') {
            $verification = 1;
        } else {

            $verification = 0;
        }
        $pp = AdminSetting::first();
        $pp->country_code = $request->country_code;
        $pp->twilio_id = $request->twilio_id;
        $pp->twilio_auth_token = $request->twilio_auth_token;
        $pp->twilio_number = $request->twilio_number;
        $pp->verification = $verification;
        $pp->update();
        // return "true";
        return redirect('setting')->withStatus(__('Twilio Configuration updated successfully.'));
    }

    public function licenseactive()
    {
        $license = AdminSetting::first();
        return view('license.licenseactive', compact('license'));
    }

    public function license()
    {
        return view('license.license');
    }

    public function saveEnvData(Request $request)
    {
        $request->validate([
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:6',
        ]);
        $data = $request->all();
        $envdata['DB_HOST'] = $request->db_host;
        $envdata['DB_DATABASE'] = $request->db_name;
        $envdata['DB_USERNAME'] = $request->db_user;
        $envdata['DB_PASSWORD'] = $request->db_pass;
        $result = $this->updateENV($envdata);
        if ($result) {
            // Artisan::call('config:clear'); 
            // Artisan::call('optimize:clear');
            // Artisan::call('cache:clear');
            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Don\'t have enough permission for .env file to be written. '], 200);
        }
    }
    public function saveAdminData(Request $request)
    {
        $request->validate([
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:6',
        ]);
        User::first()->update(['email' => $request->email, 'password' => Hash::make($request->password)]);
        AdminSetting::find(1)->update(['license_code' => $request->license_code, 'client_name' => $request->client_name, 'license_status' => 1]);
        return response()->json(['data' => url('/login'), 'success' => true], 200);
    }
    public function updateLicense(Request $request)
    {
        $request->validate([
            'license_code' => 'required',
            'client_name' => 'required'
        ]);
        $api = new LicenseBoxExternalAPI();
        $result = $api->activate_license($request->license_code, $request->client_name);
        if ($result['status'] == true) {
            $id = AdminSetting::find(1);
            $data = $request->all();
            $data['license_status'] = 1;
            $id->update($data);
            return redirect('/');
        } else {
            return redirect()->back()->with('error_msg', $result['message']);
        }
        return redirect('admin/setting');
    }
    public function updateENV($data)
    {
        $envFile = app()->environmentFilePath();
        if ($envFile) {
            $str = file_get_contents($envFile);
            if (count($data) > 0) {
                foreach ($data as $envKey => $envValue) {
                    $str .= "\n"; // In case the searched variable is in the last line without \n
                    $keyPosition = strpos($str, "{$envKey}=");
                    $endOfLinePosition = strpos($str, "\n", $keyPosition);
                    $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
                    // If key does not exist, add it
                    if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                        $str .= "{$envKey}={$envValue}\n";
                    } else {
                        $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                    }
                }
            }
            $str = substr($str, 0, -1);
            try {
                if (!file_put_contents($envFile, $str)) {
                }
                return true;
            } catch (Exception $e) {
                return false;
            }
        }
    }
    public function testMail(Request $request)
    {
        try {
            $setting = AdminSetting::first();
            $subject = 'Test Mail From Admin Panel';
            $message = 'This is a test email sent from the admin panel to ensure the proper configuration';
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
            Mail::to($request->to)->send(new TestMail($message, $subject, $setting->name));
            return response()->json(['success' => true, 'message' => 'Mail Send Successfully!'], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'data' => $e]);
        }
    }

    public function transaction()
    {
        return view('Transactions.create');
    }

    public function transactionCustom(Request $request)
    {

        $startDate = Carbon::parse($request->startdate);
        $endDate = Carbon::parse($request->enddate);

        $spaces = ParkingSpace::all();
        $spaceIds = $spaces->pluck('id');
        $bookings = ParkingBooking::whereIn('space_id', $spaceIds)
            ->whereBetween('arriving_time', [$startDate, $endDate])
            ->get();

        $data = [];

        foreach ($bookings as $booking) {

            $userBookings = ParkingBooking::where('user_id', $booking->user_id)
                ->whereBetween('arriving_time', [$startDate, $endDate])
                ->get();

            if (!isset($data[$booking->user_id])) {
                $data[$booking->user_id] = [
                    'user' => $booking->user,
                    'total' => $userBookings->sum('total_amount')
                ];
            }
        }

        $tempData['data'] = array_values($data);
        $tempData['grandTotal'] = collect($data)->sum('total');

        return view('owner.transection.index', compact('tempData'));
    }

    public function transactionAll(Request $request)
    {

        $spaces = ParkingSpace::all();
        $spaceIds = $spaces->pluck('id');
        if ($request->type === 'week') {

            $startDate = Carbon::now()->startOfWeek();
            $endDate = Carbon::now()->endOfWeek();
        } else if ($request->type === 'month') {

            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
        } else {

            $startDate = Carbon::today();
            $endDate = Carbon::today();
        }

        $bookings = ParkingBooking::whereIn('space_id', $spaceIds)->whereBetween('arriving_time', [$startDate, $endDate])->get();

        $data = [];

        foreach ($bookings as $booking) {

            $userBookings = ParkingBooking::where('user_id', $booking->user_id)
                ->whereBetween('arriving_time', [$startDate, $endDate])
                ->get();

            if (!isset($data[$booking->user_id])) {
                $data[$booking->user_id] = [
                    'user' => $booking->user,
                    'total' => $userBookings->sum('total_amount')
                ];
            }
        }

        $tempData['data'] = array_values($data);
        $tempData['grandTotal'] = collect($data)->sum('total');

        return view('transactions.index', compact('tempData'));
    }



    public function blockParkingOwner($id)
    {
        $user = ParkingOwner::find($id);
        $user->status = ($user->status == 1) ? 0 : 1;
        $user->update();
        if ($user->status == 1) {
            return redirect()->back()->with('status', 'user unblock successfully.');
        } else {
            return redirect()->back()->with('status', 'user block successfully.');
        }
    }
}
