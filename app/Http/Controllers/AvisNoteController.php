<?php

namespace App\Http\Controllers;

use App\Models\AvisNote;
use Illuminate\Http\Request;

class AvisNoteController extends Controller
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
        {
            try {
                $avnote = new AvisNote ();
    
                $avnote -> IdUser = $request -> CleUser ;
                $avnote -> IdAvis = $request -> CleAvis ;
                $avnote -> NombreNote = $request -> NbNote ;
    
                $avnote -> save();
    
                $res = [
                  'msg' => 'avis created successfully',
                ];
    
          } catch (\Throwable $th) {
              return response()->json(['error' => 'Error ', 'details' => $th->getMessage()], 500);
          }
        }
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
     * @param  \App\Models\AvisNote  $avisNote
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
'CleAvis' => $avis -> IdAvis,
'NbNote' => $avis -> NombreNote,

];

return response()->json($res);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AvisNote  $avisNote
     * @return \Illuminate\Http\Response
     */
    public function edit(AvisNote $avisNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AvisNote  $avisNote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AvisNote $avisNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AvisNote  $avisNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(AvisNote $avisNote)
    {
        //
    }
}
