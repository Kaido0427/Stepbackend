<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ParkingSpace;
use App\ParkingImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ParkingImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parkingSpace=ParkingSpace::where('owner_id',Auth::guard('owner')->user()->id)->get()->pluck('id')->toArray();
        $parkingimage=ParkingImage::whereIn('space_id', $parkingSpace)->orderBy('id', 'desc')->get();
        return view('owner.spaceimages.index',compact('parkingimage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $spaces=ParkingSpace::where('owner_id',Auth::guard('owner')->user()->id)->get();
        return view('owner.spaceimages.create',compact('spaces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            if ($request->hasFile('image')) {
               
                $parkingimage = new ParkingImage;
                $image = $request->file('image');
                // $name = time() . '.' . $image->getClientOriginalExtension();
                $name = uniqid() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/upload');
                $image->move($destinationPath, $name);
                $parkingimage->image =  $name;
                $parkingimage->space_id= $request->space;
                $parkingimage->save();
            } 
        return  redirect('owner/parkingimages')->with('status','Successful ImageAdded');
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
        $parkingimage=ParkingImage::find($id);
        return view('owner.spaceimages.edit',compact('parkingimage'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $parkingimage=ParkingImage::find($request->id);
        if ($request->hasfile('image')) {
            $destinationpath = 'upload/' . $parkingimage->image;
            if (File::exists($destinationpath)) {
                File::delete($destinationpath);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('upload/', $filename);
            $parkingimage->image = $filename;
            $parkingimage->update();
            return redirect('owner/parkingimages')->with('status','Successful Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $parkingimage=ParkingImage::find($id);
       $parkingimage->delete();
       return redirect('owner/parkingimages')->with('status','Successful Deleted');
    }
}
