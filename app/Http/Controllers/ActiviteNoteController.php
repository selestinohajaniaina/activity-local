<?php

namespace App\Http\Controllers;

use App\Models\ActiviteNote;
use App\Models\AvisNote;
use Illuminate\Http\Request;

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

            $activnote -> IdUser = $request -> CleUser ;
            $activnote -> IdActivite = $request -> CleActivite ;
            $activnote -> NombreNote = $request -> NbNote ;

            $activnote -> save();

            $res = [
              'msg' => 'avis created successfully',
            ];

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
        $avis = AvisNote::where('id', '=', $request -> id)
        ->first(['id', 'IdUser', 'IdAvis', '', 'NombreNote']);

if(!$avis) {
return response()->json(['status' => false, 'msg' => 'Compte introuvable']);
}



$res = [
'status' => true,
'CleUser' => $avis -> IdUser,
'CleActivite' => $avis -> IdActivite,
'NbNote' => $avis -> NombreNote,

];

return response()->json($res);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ActiviteNote  $activiteNote
     * @return \Illuminate\Http\Response
     */
    public function show(ActiviteNote $activiteNote)
    {
        //
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
     * @param  \App\Models\ActiviteNote  $activiteNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActiviteNote $activiteNote)
    {
        //
    }
}
