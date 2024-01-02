<?php

namespace App\Http\Controllers;

use App\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class VehicleTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $VehicleType =  VehicleType::get();
        return view('vehicleType.index', compact('VehicleType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vehicleType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'bail|required|unique:vehicle_type,title|max:10',
            'status' => 'bail|required|numeric',
            'image' => 'bail|required|image',

        ]);
        $vehicle = new VehicleType();
        $vehicle->title = $request->title;
        $vehicle->status = $request->status;
        if($image = $request->file('image'))
        {
            $imageDestinationPath = public_path().'/vehicleType/';
            $postImage = uniqid() . "." . $image->getClientOriginalExtension();
            $image->move($imageDestinationPath, $postImage);
            $vehicle->image = $postImage;
        }
        $vehicle->save();
        return redirect()->route('vehicle_type.index')->withStatus(__('Vehicle Type added successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehicleType = VehicleType::find($id);
        return view('vehicleType.edit', compact('vehicleType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vehicle = VehicleType::where('id',$id)->first();
        $vehicle->title = $request->title;
        $vehicle->status = $request->status;     
        if($request->hasfile('image')){
            $destination = public_path("vehicleType/{$vehicle->image}");  
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = uniqid() ."." .$extension;
            $file->move(public_path('/vehicleType'),$filename);
            $vehicle->image = $filename;
        } 
        $vehicle->save();
        return redirect()->route('vehicle_type.index')->withStatus(__('Vehicle Type update successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        VehicleType::find($id)->delete();
        return redirect()->route('vehicle_type.index')->withStatus(__('Vehicle Type deleted successfully.'));
    }
}
