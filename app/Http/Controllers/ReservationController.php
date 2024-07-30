<?php

namespace App\Http\Controllers;

use App\Models\NotificationPrestataire;
use App\Models\NotificationUser;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_reservation($id_activity)
    {
        //
        return Reservation::where('IdActivite', $id_activity)
                            -> orderBy('id', 'desc')
                            -> get();
    }

    /**
     * Show the form resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function select($authorization)
    {
        //
        $tokenDecoded = Crypt::decrypt($authorization);
        $tokenExploded = explode("<>", $tokenDecoded);
        $IdUser = $tokenExploded[0];
        return Reservation::where('IdUser', $IdUser)
                            -> orderBy('id', 'desc')
                            -> get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function new(Request $request)
    {
        //
        $decrypt = Crypt::decrypt($request -> authorization);
        $idUser = explode('<>', $decrypt)[0];

        $reservation = new Reservation();
        $reservation -> IdUser = $idUser;
        $reservation -> IdActivite = $request -> IdActivite;
        $reservation -> confirmation = $request -> confirmation;
        $reservation -> dateDebut = $request -> dateDebut;
        $reservation -> dateFin = $request -> dateFin;
        $reservation -> effectif = $request -> effectif;

        // create notification to prestataire
        $notification = new NotificationPrestataire();
        $notification -> IdUser = $idUser;
        $notification -> IdElement = $request -> IdActivite;
        $notification -> element = 'activity';
        $notification -> idPrestataire = $request -> idPrestataire;
        $notification -> type = 'reserve';
        $notification -> view = false;
        $notification -> save();

        $reservation -> save();

        return $reservation;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $reservation = Reservation::where('id', $request -> id)
                                    -> update([
                                        'confirmation' => 'true'
                                    ]);

        // create notification to user
        $notification = new NotificationUser();
        $notification -> IdUser = $request -> idUser;
        $notification -> IdElement = $request -> IdActivite;
        $notification -> element = 'reserve';
        $notification -> type = 'accept';
        $notification -> view = false;
        $notification -> save();

        $reservation_up_date = Reservation::where('id', $request -> id) -> first();
    
        return [
            'id' => $request -> id,
            'updated_at' => $reservation_up_date -> updated_at,
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $reservation = Reservation::where('id', $request -> id)
                                    -> delete();
        // create notification to prestataire
        $notification = new NotificationUser();
        $notification -> IdUser = $request -> idUser;
        $notification -> IdElement = $request -> IdActivite;
        $notification -> element = 'reserve';
        $notification -> type = 'refuse';
        $notification -> view = false;
        $notification -> save();

        return [
            'id' => $request -> id,
        ];
    }
}
