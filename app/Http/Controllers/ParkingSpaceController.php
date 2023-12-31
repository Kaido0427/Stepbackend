<?php

namespace App\Http\Controllers;

use App\ParkingBooking;
use App\ParkingGuard;
use App\ParkingSpace;
use App\SpaceSlot;
use App\SpaceZone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ParkingSpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ParkingSpace::where('owner_id', Auth::user()->id)->get();
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function adminChangeVerify($id)
    {
        $data =   ParkingSpace::findOrFail($id);
        $data->verified = $data->verified == 1 ? 0  : 1;
        $data->update();
        return redirect()->back()->withStatus(__('Status Is changed.'));
    }
    public function adminSpaceView($id)
    {
        $data =   ParkingSpace::with(['guards', 'reviews.user'])->findOrFail($id)->setAppends(['facilitiesData', 'vehicleTypeData', 'avg_rating']);
        return view('parkingOwner.singleSpace', ['data' => $data]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = Auth::user();

        // Vérifie si l'utilisateur actuel (le concierge) a déjà un espace
        if ($user->Spaces->count() > 0) {
            return response()->json(['msg' => 'The concierge already owns a space. They cannot create another one.', 'success' => false], 400);
        }
        $request->validate([
            'title' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'price_par_hour' => 'required',
            'available_all_day' => 'required|numeric',
            'parkingZone' => 'required|array', // Ajout de la validation pour parkingZone
        ]);

        $reqData = $request->all();
        $reqData['open_time'] = Carbon::parse($request->open_time)->format('H:i:s');
        $reqData['close_time'] = Carbon::parse($request->close_time)->format('H:i:s');
        $reqData['owner_id'] = Auth::user()->id;
        $reqData['status'] = 1;
        $reqData['verified'] = 1;
        $data = ParkingSpace::create($reqData);

        if (isset($reqData['parkingZone'])) {
            foreach ($reqData['parkingZone'] as $value) {
                $zoneData = SpaceZone::create([
                    'space_id' => $data->id,
                    'owner_id' => $reqData['owner_id'],
                    'name' => $value['name']
                ]);

                $slot = [];
                for ($i = 1; $i <= (int)$value['size']; $i++) {
                    $slot[] = [
                        'zone_id' => $zoneData->id,
                        'space_id' => $data->id,
                        'name' => $value['name'] . ' ' . $i,
                        'position' => $i,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }

                SpaceSlot::insert($slot);
            }
        }

        if (isset($reqData['guardList'])) {
            ParkingGuard::whereIn('id', $reqData['guardList'])->update([
                'space_id' => $data->id,
            ]);
        }

        return response()->json(['msg' => 'Parking Space Added successfully', 'data' => null, 'success' => true], 200);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\ParkingSpace  $parkingSpace
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ParkingSpace  $parkingSpace
     * @return \Illuminate\Http\Response
     */
    public function edit(ParkingSpace $parkingSpace)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ParkingSpace  $parkingSpace
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'bail|required',
                'address' => 'bail|required',
                'lat' => 'bail|required',
                'lng' => 'bail|required',
                'price_par_hour' => 'bail|required',
                'available_all_day' => 'bail|required|numeric',
                'open_time' => 'bail|required',
                'close_time' => 'bail|required',
                'offline_payment' => 'bail|required|boolean',
                'parkingZone' => 'bail|required|array', // Validation pour parkingZone
            ]);

            $reqData = $request->all();
            $reqData['open_time'] = Carbon::parse($request->open_time)->format('H:i:s');
            $reqData['close_time'] = Carbon::parse($request->close_time)->format('H:i:s');
            $reqData['status'] = 1;


            $parkingSpace = ParkingSpace::findOrFail($id);

            // Vérifiez si l'espace de stationnement est en cours de réservation
            $hasPendingBookings = ParkingBooking::where('space_id', $parkingSpace->id)
                ->where('status', 'waiting') // Statut en attente
                ->exists();

            if (!$hasPendingBookings) {
                // Aucune réservation en attente, vous pouvez mettre à jour l'espace de stationnement
                if ($parkingSpace->owner_id === auth()->user()->id) {
                    $parkingSpace->update($reqData);


                    // Créez ou mettez à jour les zones de stationnement et les emplacements de stationnement
                    if (isset($reqData['parkingZone'])) {
                        foreach ($reqData['parkingZone'] as $value) {
                            $zoneId = $value['id']; // ID de la zone à mettre à jour ou créer

                            $existingZone = SpaceZone::find($zoneId);

                            if ($existingZone) {

                                // Mise à jour de la zone existante
                                $existingZone->update([
                                    'owner_id' => $parkingSpace->owner_id,
                                    'status' => 'active', // Mettez à jour d'autres champs si nécessaire
                                    'name' => $value['name'],
                                ]);

                                $zoneData = $existingZone;
                            } else {
                                // Création d'une nouvelle zone si elle n'existe pas
                                $zoneData = SpaceZone::create([
                                    'id' => $zoneId, // Utilisez l'ID fourni
                                    'space_id' => $parkingSpace->id,
                                    'owner_id' => $parkingSpace->owner_id,
                                    'name' => $value['name'],
                                    'status' => 'active', // Ajoutez d'autres champs si nécessaire
                                ]);
                            }

                            // Mettez à jour les emplacements de stationnement en fonction de la nouvelle taille
                            $zoneSize = (int)$value['size'];

                            // Récupérez le nombre total d'emplacements de stationnement existants
                            $existingSlotsCount = SpaceSlot::where('zone_id', $zoneData->id)->count();

                            if ($zoneSize > $existingSlotsCount) {
                                // Si la nouvelle taille est supérieure au nombre d'emplacements existants, ajoutez de nouveaux emplacements
                                $slotsToAdd = $zoneSize - $existingSlotsCount;

                                for ($i = 1; $i <= $slotsToAdd; $i++) {
                                    SpaceSlot::create([
                                        'zone_id' => $zoneData->id,
                                        'space_id' => $parkingSpace->id,
                                        'name' => $value['name'] . ' ' . ($existingSlotsCount + $i),
                                        'position' => $existingSlotsCount + $i,
                                        'is_active' => 1, // Marquer comme actif
                                    ]);
                                }
                            }

                            // Mettez à jour les emplacements de stationnement existants
                            SpaceSlot::where('zone_id', $zoneData->id)->update(['is_active' => 0]);
                            SpaceSlot::where('zone_id', $zoneData->id)->take($zoneSize)->update(['is_active' => 1]);
                        }
                    }

                    return response()->json(['msg' => 'Parking Space Updated successfully', 'data' => null, 'success' => true], 200);
                } else {
                    return response()->json(['error' => 'Vous n\'êtes pas autorisé à mettre à jour cet espace de stationnement.'], 403);
                }

                return response()->json(['msg' => 'Parking Space Updated successfully', 'data' => null, 'success' => true], 200);
            } else {
                // Il y a des réservations en attente, ne permettez pas la mise à jour
                return response()->json(['error' => 'Vous ne pouvez pas mettre à jour cet espace de stationnement car il y a des réservations en attente.'], 403);
            }
        } catch (\Exception $e) {
            // Gérer l'exception
            return response()->json(['error' => 'Une erreur est survenue lors de la mise à jour de l\'espace de stationnement.', 'message' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $data['space'] = ParkingSpace::with(['guards', 'zones.slots'])->findOrFail($id)->setAppends(['facilitiesData', 'vehicleTypeData']);
        $data['booking'] = ParkingBooking::with(['user', 'vehicle:id,model,vehicle_no'])->where([['space_id', $id]])->get(); //whereDate('arriving_time', Carbon::today())->get();
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ParkingSpace  $parkingSpace
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $parkingSpace = ParkingSpace::findOrFail($id);
        $parkingSpace->delete();
        return response()->json(['msg' => 'Parking Space Deleted successfully', 'data' => null, 'success' => true], 200);
    }
}
