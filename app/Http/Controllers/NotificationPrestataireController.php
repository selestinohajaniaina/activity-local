<?php

namespace App\Http\Controllers;

use App\Models\NotificationPrestataire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class NotificationPrestataireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function count($authorization)
    {
        //
        $decrypt = Crypt::decrypt($authorization);
        $idPrestataire = explode('<>', $decrypt)[0];

        $nbr = NotificationPrestataire::where('idPrestataire', $idPrestataire)
                                        ->count();

        return response()->json([
            'status' => true,
            'nbr' => $nbr,
            'msg' => 'total notification',
        ]);
    }

    /**
     * Show the form for resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function select($authorization)
    {
        //
        $decrypt = Crypt::decrypt($authorization);
        $idPrestataire = explode('<>', $decrypt)[0];

        $notification = NotificationPrestataire::where('idPrestataire', $idPrestataire)
                                                    -> orderBy('id', 'desc')
                                                    -> get();

        return $notification;
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
     * @param  \App\Models\NotificationPrestataire  $notificationPrestataire
     * @return \Illuminate\Http\Response
     */
    public function show(NotificationPrestataire $notificationPrestataire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NotificationPrestataire  $notificationPrestataire
     * @return \Illuminate\Http\Response
     */
    public function edit(NotificationPrestataire $notificationPrestataire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NotificationPrestataire  $notificationPrestataire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NotificationPrestataire $notificationPrestataire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NotificationPrestataire  $notificationPrestataire
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotificationPrestataire $notificationPrestataire)
    {
        //
    }
}
