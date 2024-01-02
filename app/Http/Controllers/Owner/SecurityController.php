<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ParkingGuard;
use App\ParkingSpace;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
class SecurityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sguards= ParkingGuard::with('space')->where('owner_id',Auth::guard('owner')->user()->id)->orderBy('id', 'desc')->get();
        return view('owner.securityguard.index',compact('sguards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parkingSpace=ParkingSpace::where('owner_id',Auth::guard('owner')->user()->id)->get();
        return view('owner.securityguard.create',compact('parkingSpace'));
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
                'phone'=>'bail|required',
                'password'=>'bail|required|min:6'
            ]);
        $sguard= new ParkingGuard;
        if ($request->hasfile('image')) {
            $destinationpath = 'upload/' . $sguard->image;
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('upload/', $filename);
            $sguard->image = $filename;
        }
          $sguard->owner_id= Auth::guard('owner')->user()->id;
          $sguard->name= $request->name;
          $sguard->email= $request->email;
          $sguard->phone_no= $request->phone;
          $sguard->password= $request->password;
          $sguard->space_id=$request->space;
          $sguard->status=$request->status;
          $sguard->save();
          return redirect('owner/security')->with('status','Successful Added');
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
        $parkingSpace=ParkingSpace::where('owner_id',Auth::guard('owner')->user()->id)->get();
       $sguards=ParkingGuard::find($id);
       return view('owner.securityguard.edit',compact('sguards','parkingSpace'));

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
        $sguard=ParkingGuard::find($request->id);
        if ($request->hasfile('image')) {
            $destinationpath = 'upload/' . $sguard->image;
            if (File::exists($destinationpath)) {
                File::delete($destinationpath);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('upload/', $filename);
            $sguard->image = $filename;
        }
        $sguard->name= $request->name;
        $sguard->email= $request->email;
        $sguard->phone_no= $request->phone;
        $sguard->space_id=$request->space;
        $sguard->status=$request->status;
        $sguard->update();
        return redirect('owner/security')->with('status','Successful Updated');
        
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sguards=ParkingGuard::find($id);
        //  unlink('upload/'.$sguards->image);
        $sguards->delete();
        return redirect('owner/security')->with('status','Delete Successful');
       
    }
}
