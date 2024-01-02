<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\AppHelper;
use App\Http\Controllers\Controller;
use App\UserVehicle;
use App\VehicleType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserVehiclesController extends Controller
{
    public function getUserVehicle()
    {
        
        $vehicle = UserVehicle::where('user_id', Auth::guard('appuser')->user()->id)->get();             
        $vehicletype = VehicleType::where('status',1)->get();
       
        return view('website.vehicle', compact('vehicle','vehicletype'));
    }

    public function userVehicleStore(Request $request)
    {
        $rules = [
            'brand' => 'bail|required',
            'model' => 'bail|required',
            'vehicle_no' => 'bail|required',
            'vehicle_type_id' => 'bail|required',
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }       
        $reqData['user_id'] = Auth::guard('appuser')->user();
        $reqData = $request->all();
        UserVehicle::create($reqData);
        return response()->json(['status' => true, 'message' => 'Vehicle added successfully']);
    }

    public function userVehicleUpdate(Request $request, $id) 
    {
        $rules = [
            'brand' => 'bail|required',
            'model' => 'bail|required',
            'vehicle_no' => 'bail|required'
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }
        $vehicles = UserVehicle::where('id', $id)->first();
        $vehicles->brand = $request->brand;
        $vehicles->model = $request->model;
        $vehicles->vehicle_no = $request->vehicle_no;
        $vehicles->update();
        return response()->json(['success' => true, 'message' => 'Vehicle update successfully.']);
    }

    public function userVehicleDestroy($id)
    {
        UserVehicle::find($id)->delete($id); 
        return response()->json(['success' => true, 'message' => 'Record deleted successfully']);
    }
}
