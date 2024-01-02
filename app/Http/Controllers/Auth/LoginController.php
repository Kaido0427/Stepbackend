<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use LicenseBoxExternalAPI;
use App\AdminSetting;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */


    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function credentials(Request $request)
    {
        $data = AdminSetting::find(1);
        $api = new LicenseBoxExternalAPI();
        $res = $api->verify_license();
        if ($res['status'] != true)
        {
            $data->license_status = 0;
            $data->save();
        }
        else
        {
            $data->license_status = 1;
            $data->save();
        }
        return ['email'=>$request->{$this->username()},'password'=>$request->password];    
    }
}
