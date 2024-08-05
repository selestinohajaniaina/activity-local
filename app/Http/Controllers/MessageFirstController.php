<?php

namespace App\Http\Controllers;

use App\Models\MessageFirst;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MessageFirstController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function select(Request $request)
    {
        //
        $authorization = $request -> authorization;
        $decrypt = Crypt::decrypt($authorization);
        $idUser2 = explode('<>', $decrypt)[0];

        $idUser1 = $request -> idUser1;

        $MP = MessageFirst::where('idUser1', $idUser1)
                            -> where('idUser2', $idUser2)
                            -> first();
        if($MP) {
            return $MP;
        } else {
            $MP = new MessageFirst();
            $MP -> idUser1 = $idUser1;
            $MP -> idUser2 = $idUser2;
            $MP -> save();
            return $MP;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function conversation($authorization)
    {
        //
        $decrypt = Crypt::decrypt($authorization);
        $idUser2 = explode('<>', $decrypt)[0];

        $message_seconds = MessageFirst::where('idUser2', $idUser2)
                                            -> orderBy('id', 'desc')
                                            -> get();
        return $message_seconds;
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
     * @param  \App\Models\MessageFirst  $messageFirst
     * @return \Illuminate\Http\Response
     */
    public function show(MessageFirst $messageFirst)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MessageFirst  $messageFirst
     * @return \Illuminate\Http\Response
     */
    public function edit(MessageFirst $messageFirst)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MessageFirst  $messageFirst
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MessageFirst $messageFirst)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MessageFirst  $messageFirst
     * @return \Illuminate\Http\Response
     */
    public function destroy(MessageFirst $messageFirst)
    {
        //
    }
}
