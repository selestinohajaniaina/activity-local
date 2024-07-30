<?php

namespace App\Http\Controllers;

use App\Models\ActiviteNote;
use App\Models\NotificationPrestataire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ActiviteNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $activnote = new ActiviteNote ();

            $authorization = $request -> authorization;
            $decrypt = Crypt::decrypt($authorization);
            $idUser = explode('<>', $decrypt)[0];

            $activnote -> IdUser = $idUser;
            $activnote -> IdActivite = $request -> CleActivite ;
            $activnote -> NombreNote = 1 ;

            $activnote -> save();

            // create notification to prestataire
            $notification = new NotificationPrestataire();
            $notification -> IdUser = $idUser;
            $notification -> IdElement = $request -> CleActivite;
            $notification -> element = 'activity';
            $notification -> idPrestataire = $request -> idPrestataire;
            $notification -> type = 'like';
            $notification -> view = false;
            $notification -> save();

            $res = [
                'status' => true,
                'msg' => 'avis created successfully',
            ];

            return $res;

      } catch (\Throwable $th) {
          return response()->json(['error' => 'Error ', 'details' => $th->getMessage()], 500);
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function select(Request $request)
    {
        //
        try {
            $authorization = $request -> authorization;
            $decrypt = Crypt::decrypt($authorization);
            $idUser = explode('<>', $decrypt)[0];
    
            $activity = ActiviteNote::where('IdUser', $idUser)
                            -> where('IdActivite', $request -> CleActivite)
                            -> first();

            $nbr = ActiviteNote::where('IdActivite', $request -> CleActivite)->count();


            if($activity) {
                $res = [
                    'status' => true,
                    'msg' => "avis exist",
                    'nbr' => $nbr
                ];
            } else {
                $res = [
                    'status' => false,
                    'msg' => "avis not exist",
                    'nbr' => $nbr
                ];
            }
            

            return $res;

        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error ', 'details' => $th->getMessage()], 500);
        }
    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function count($id_activity)
    {
        //
        return ActiviteNote::where('IdActivite', $id_activity)->count();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ActiviteNote  $activiteNote
     * @return \Illuminate\Http\Response
     */
    public function edit(ActiviteNote $activiteNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ActiviteNote  $activiteNote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ActiviteNote $activiteNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function delete(Request $request)
    {
        //
        try {
            $authorization = $request -> authorization;
            $decrypt = Crypt::decrypt($authorization);
            $idUser = explode('<>', $decrypt)[0];
    
            ActiviteNote::where('IdUser', $idUser)
                            -> where('IdActivite', $request -> CleActivite)
                            -> delete();

            // create notification to prestataire
            $notification = new NotificationPrestataire();
            $notification -> IdUser = $idUser;
            $notification -> IdElement = $request -> CleActivite;
            $notification -> element = 'activity';
            $notification -> idPrestataire = $request -> idPrestataire;
            $notification -> type = 'unlike';
            $notification -> view = false;
            $notification -> save();

            $res = [
                'status' => true,
                'msg' => "avis removed successfully",
            ];

            return $res;

        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error ', 'details' => $th->getMessage()], 500);
        }
    }
}
