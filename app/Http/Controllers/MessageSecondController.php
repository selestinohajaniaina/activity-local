<?php

namespace App\Http\Controllers;

use App\Models\MessageSecond;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MessageSecondController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $authorization = $request -> authorization;
        $decrypt = Crypt::decrypt($authorization);
        $idUser = explode('<>', $decrypt)[0];
        if(explode('<>', $decrypt)[1]=='uid') {
            $role = 'user';
        }else {
            $role = 'prestateur';
        }

        $message = new MessageSecond();
        $message -> contenu = $request -> message;
        $message -> idUser = $idUser;
        $message -> role = $role;
        $message -> IdMessageFirst = $request -> idMessage;
        $message -> save();

        return [
            'status' => true,
        ];
    }

    /**
     * Display created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function select($id)
    {
        //
        $message_seconds = MessageSecond::where('IdMessageFirst', $id)
                                            -> orderBy('id', 'asc')
                                            -> get();
        return $message_seconds;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MessageSecond  $messageSecond
     * @return \Illuminate\Http\Response
     */
    public function show(MessageSecond $messageSecond)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MessageSecond  $messageSecond
     * @return \Illuminate\Http\Response
     */
    public function edit(MessageSecond $messageSecond)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MessageSecond  $messageSecond
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MessageSecond $messageSecond)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MessageSecond  $messageSecond
     * @return \Illuminate\Http\Response
     */
    public function destroy(MessageSecond $messageSecond)
    {
        //
    }
}
