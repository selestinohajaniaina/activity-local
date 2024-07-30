<?php

namespace App\Http\Controllers;

use App\Models\NotificationUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class NotificationUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function count($authorization)
    {
        //
        $decrypt = Crypt::decrypt($authorization);
        $idUser = explode('<>', $decrypt)[0];

        $nbr = NotificationUser::where('idUser', $idUser)
                                        ->count();

        return response()->json([
            'status' => true,
            'nbr' => $nbr,
            'msg' => 'total notification',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function select($authorization)
    {
        //
        $decrypt = Crypt::decrypt($authorization);
        $idUser = explode('<>', $decrypt)[0];

        $notification = NotificationUser::where('idUser', $idUser)
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
     * @param  \App\Models\NotificationUser  $notificationUser
     * @return \Illuminate\Http\Response
     */
    public function show(NotificationUser $notificationUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NotificationUser  $notificationUser
     * @return \Illuminate\Http\Response
     */
    public function edit(NotificationUser $notificationUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NotificationUser  $notificationUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NotificationUser $notificationUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NotificationUser  $notificationUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotificationUser $notificationUser)
    {
        //
    }
}
