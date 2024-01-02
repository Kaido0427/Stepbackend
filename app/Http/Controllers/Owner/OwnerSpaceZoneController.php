<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use App\ParkingSpace;
use App\SpaceSlot;
use App\SpaceZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnerSpaceZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spacezones = SpaceZone::with('ParkingSpace')->where('owner_id',Auth::guard('owner')->user()->id)->orderBy('name')->get();       
          // $spacezones = SpaceZone::where('owner_id',Auth::guard('owner')->user()->id)->orderBy('name')->get();
        // foreach($spacezones as $zone)
        // {
        //     $zone->space = ParkingSpace::where('id',$zone->space_id)->first();
        // }
        return view('owner.spacezone.index',compact('spacezones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $spaces = ParkingSpace::where('owner_id',Auth::guard('owner')->user()->id)->get();
        return view('owner.spacezone.create',compact('spaces'));
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
            'name' => 'required',
        ]);

        $zone = SpaceZone::create([
            'space_id' => $request->space_id,
            'owner_id' =>Auth::guard('owner')->user()->id,
            'name' => $request->name,
            'status' => $request->status,
        ]);

        $slot = [];
        for ($i = 1; $i < (int) $request->size; $i++) {
            # code...
            $slot[] = [
                'zone_id' => $zone->id,
                'space_id' => $zone->space_id,
                'name' => $request->name . ' ' . $i,
                'position' => $i,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }
        SpaceSlot::insert($slot);
        return redirect('owner/space_zone')->with('status','Successful Added');
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
        $spacezone=SpaceZone::where('owner_id',Auth::guard('owner')->user()->id)->find($id);
        $spaces = ParkingSpace::where('owner_id',Auth::guard('owner')->user()->id)->get();
        // return [$spacezone,$spaces];
        return view('owner.spacezone.edit',compact('spacezone','spaces'));
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
        $zone = SpaceZone::find($request->id);
        $zone->space_id =  $request->space_id;
        $zone->owner_id = Auth::guard('owner')->user()->id;
        $zone->name =  $request->name;
        $zone->status = $request->status;
        $zone->update();
        return  redirect('owner/space_zone')->with('status','Successful Update');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $spacezone=SpaceZone::find($id);
        $spacezone->delete();
        return  redirect('owner/space_zone')->with('status','Successful Deleted');
    }
}
