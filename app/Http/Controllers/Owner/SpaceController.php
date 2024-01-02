<?php
namespace App\Http\Controllers\Owner;
use App\AdminSetting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Facilities;
use App\ParkingSpace;
use App\SpaceZone;
use App\SpaceSlot;
use App\ParkingImage;
use App\Review;
use App\Subscription;
use App\SubscriptionBuy;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parkingSpace=ParkingSpace::where('owner_id',Auth::guard('owner')->user()->id)->orderBy('id', 'desc')->get();
        $parkingSpace_count=ParkingSpace::where('owner_id',Auth::guard('owner')->user()->id)->orderBy('id', 'desc')->get()->count();
        $subscription_purchase = SubscriptionBuy::where('owner_id',Auth::guard('owner')->user()->id)->first();
        $subscription = Subscription::where('id',$subscription_purchase->subscription_id)->first();
        return view('owner.addspace.index',compact('parkingSpace','subscription','parkingSpace_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $facilites =Facilities::get();
        $adminsetting = AdminSetting::first(['map_key']); 
        return view('owner.addspace.create',compact('facilites','adminsetting'));
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
            'phone'=>'bail|required|numeric',
            'price'=>'bail|required|numeric',
            'size'=>'bail|required',
            'spacezone'=>'bail|required'
        ]); 
        $space= new ParkingSpace;
        $space->owner_id = Auth::guard('owner')->user()->id;
        $space->title= $request->spacename;
        $space->description=$request->description;
        $space->phone_number=$request->phone;
        $space->price_par_hour= $request->price;
        $space->facilities= $request->facilites ?? [];
        $space->address=$request->address;
        $space->lat=$request->lat;
        $space->lng=$request->lng;
        if($request->available)
        {
        $space->available_all_day= $request->available;
        }
        else
        {
         $space->available_all_day=0;
         $space->open_time= Carbon::parse($request->open_time)->format('H:i:s');
         $space->close_time= Carbon::parse($request->close_time)->format('H:i:s');    
        }
        $space->offline_payment=$request->offlinepayment;
        $space->status= $request->status;
        $space->save();
       
        if ($request->spacezone) {
            $data=[$request->spacezone];
            foreach ($data as $key => $value) {
                $zoneData = SpaceZone::create([
                    'space_id' => $space->id,
                    'owner_id' => $space->owner_id,
                    'name' => $request->spacezone
                ]);
                $slot = [];
                for ($i = 1; $i < (int) $request->size; $i++) {
                    # code...
                    $slot[] = [
                        'zone_id' => $zoneData->id,
                        'space_id' => $space->id,
                        'name' => $request->spacezone . ' ' . $i,
                        'position' => $i,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                }
                  SpaceSlot::insert($slot);
            }
        }
        
        return  redirect('owner/spaces')->with('status','Successful Added');
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
        $facilites =Facilities::get();
        $parkingSpace=ParkingSpace::find($id);
        $adminsetting = AdminSetting::first(['map_key']);
        return view('owner.addspace.edit',compact('parkingSpace','facilites','adminsetting'));
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
        $space=ParkingSpace::find($request->id);
        $space->title= $request->spacename;
        $space->description=$request->description;
        $space->phone_number=$request->phone;
        $space->price_par_hour= $request->price;
        $space->facilities= $request->facilites ?? [];
        $space->address=$request->address;
        $space->lat=$request->lat;
        $space->lng=$request->lng;
        if($request->available)
        {
            $space->open_time=Null;
            $space->close_time=Null;
            $space->available_all_day= $request->available;
        }
        else
        {
         $space->available_all_day=0;    
         $space->open_time= Carbon::parse($request->open_time)->format('H:i:s');
         $space->close_time= Carbon::parse($request->close_time)->format('H:i:s');
        }
        $space->offline_payment=$request->offlinepayment;
        $space->status= $request->status;
        $space->update();
        return  redirect('owner/spaces')->with('status','Successful Updated');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $parkingSpace=ParkingSpace::find($id);
        $parkingSpace->delete();
        return  redirect('owner/spaces')->with('status','Successful Deleted');
       
    }
    public function review()
    {
        $parkingSpace=ParkingSpace::where('owner_id',Auth::guard('owner')->user()->id)->get()->pluck('id')->toArray();
        $reviews =Review::whereIn('space_id',$parkingSpace)->get();
        return view('owner.review.review',compact('reviews'));  
    }
}

