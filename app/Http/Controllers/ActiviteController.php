<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use Illuminate\Http\Request;
use App\Http\Controllers\GalerieController;
use Illuminate\Support\Facades\Crypt;

class ActiviteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profil($id)
    {
        //
        return Activite::where('id', $id) -> first();
    }

    public function fetch($authorization)
    {
        //
        $tokenDecoded = Crypt::decrypt($authorization);
        $tokenExploded = explode("<>", $tokenDecoded);
        $id_prestatire = $tokenExploded[0];
        return Activite::where('idPrestataire', $id_prestatire)
                            -> orderBy('id', 'desc')
                            -> get();
    }

    public function count($authorization)
    {
        //
        $tokenDecoded = Crypt::decrypt($authorization);
        $tokenExploded = explode("<>", $tokenDecoded);
        $id_prestatire = $tokenExploded[0];
        return Activite::where('idPrestataire', $id_prestatire) -> count();
    }

    public function profil_random()
    {
        //
        return Activite::inRandomOrder() -> first();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
        //
            $activity = new Activite();
            $activity -> titre = $request -> titre;
            $activity -> lieu = $request -> lieu;
            $activity -> datedebut = $request -> datedebut;
            $activity -> datefin = $request -> datefin;
            $activity -> NombreParticipant = $request -> NombreParticipant;
            $activity -> prix = $request -> prix;
            $activity -> prixParPersonne = $request -> prixParPersonne;
            $activity -> description = $request -> description;

            $authorization = $request -> authorization;
            $tokenDecoded = Crypt::decrypt($authorization);
            $tokenExploded = explode("<>", $tokenDecoded);

            $activity -> idPrestataire = intval($tokenExploded[0]);

            $activity -> save();

            $id = $activity->id;

            $image_saveds_id = [];

            if($request -> images) {
                foreach ($request -> images as $image) {
                    $imageSaved = GalerieController::create($image, $id);
                    array_push($image_saveds_id, $imageSaved);
                }
            }
    

            $res = [
                'status' => true,
                'msg' => 'Activity created successfully',
                'id' => $id,
                'activity' => $activity,
                'galery' => $image_saveds_id,
            ];
            
            return response()->json($res);

        } catch (\Exception $e) {
            //throw $th;
            return response()->json(['error' => 'Error creating activity', 'details' => $e->getMessage()], 500);
        }

    }

    public function select()
    {
        //
        return Activite::all();
    }

    public function random()
    {
        //
        return Activite::inRandomOrder() -> limit(10) -> get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activite  $activite
     * @return \Illuminate\Http\Response
     */
    public function show(Activite $activite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activite  $activite
     * @return \Illuminate\Http\Response
     */
    public function edit(Activite $activite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activite  $activite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activite $activite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activite  $activite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activite $activite)
    {
        //
    }
}
