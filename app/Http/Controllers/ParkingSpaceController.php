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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

        Log::channel('custom')->info('Requête reçue pour ajouter un espace', ['user_id' => $user->id]);

        try {

            // Vérifie si l'utilisateur actuel (le concierge) a déjà un espace
            if ($user->Spaces->count() > 0) {

                Log::channel('custom')->info('Le concierge possède déjà un espace. Il ne peut pas en créer un autre.', ['user_id' => $user->id, 'success' => false]);

                return response()->json(['msg' => 'Le concierge possède déjà un espace. Il ne peut pas en créer un autre.', 'success' => false], 400);
            }

            Log::channel('custom')->info('Validation des données envoyées', ['user_id' => $user->id]);

            $request->validate([
                'title' => 'required',
                'address' => 'required',
                'lat' => 'required',
                'lng' => 'required',
                'price_par_hour' => 'required',
                'available_all_day' => 'required|numeric',
                'parkingZone' => 'required|array',
            ]);

            Log::channel('custom')->info('Données validées', ['user_id' => $user->id]);

            $reqData = $request->all();

            Log::channel('custom')->info('Récupération des données envoyées', ['data' => $reqData, 'user_id' => $user->id]);

            $reqData['open_time'] = Carbon::parse($request->open_time)->format('H:i:s');
            $reqData['close_time'] = Carbon::parse($request->close_time)->format('H:i:s');
            $reqData['owner_id'] = Auth::user()->id;
            $reqData['status'] = 1;
            $reqData['verified'] = 1;

            Log::channel('custom')->info('Préparation des données avant insertion en DB', ['data' => $reqData, 'user_id' => $user->id]);

            DB::beginTransaction();

            $data = ParkingSpace::create($reqData);

            Log::channel('custom')->info('Espace créé', ['data' => $data, 'user_id' => $user->id]);

            if (isset($reqData['parkingZone'])) {

                foreach ($reqData['parkingZone'] as $value) {

                    Log::channel('custom')->info('Création de la zone de parking', ['zone' => $value, 'user_id' => $user->id]);

                    $zoneData = SpaceZone::create([
                        'space_id' => $data->id,
                        'owner_id' => $reqData['owner_id'],
                        'name' => $value['name']
                    ]);

                    Log::channel('custom')->info('Zone créée', ['zone' => $zoneData, 'user_id' => $user->id]);

                    $slot = [];

                    for ($i = 1; $i <= (int)$value['size']; $i++) {

                        Log::channel('custom')->info('Création de l\'emplacement', ['zone_id' => $zoneData->id, 'user_id' => $user->id]);

                        $slot[] = [
                            'zone_id' => $zoneData->id,
                            'space_id' => $data->id,
                            'name' => $value['name'] . ' ' . $i,
                            'position' => $i,
                            'created_at' => now(),
                            'updated_at' => now(),
                            'is_active' => 1,
                        ];
                    }

                    Log::channel('custom')->info('Insertion des emplacements', ['slots' => $slot, 'user_id' => $user->id]);

                    SpaceSlot::insert($slot);
                }
            }

            DB::commit();

            Log::channel('custom')->info('Espace de stationnement ajouté avec succès', ['data' => null, 'success' => true, 'user_id' => $user->id]);

            return response()->json(['msg' => 'Espace de stationnement ajouté avec succès', 'data' => null, 'success' => true], 200);
        } catch (\Exception $e) {

            DB::rollBack();

            Log::channel('custom')->error('Erreur lors de l\'ajout des emplacements.', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString(), 'user_id' => $user->id]);

            return response()->json(['msg' => 'Erreur lors de l\'ajout des emplacements.', 'error' => $e->getMessage(), 'success' => false], 500);
        }
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
