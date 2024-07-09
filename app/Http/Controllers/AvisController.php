<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class AvisController extends Controller
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
              $avis = new Avis();

              $avis -> IdUser = $request -> CleUser ;
              $avis -> IdActivite = $request -> CleActivite ;
              $avis -> description = $request -> contenu ;

              $avis -> save();

              $res = [
                'msg' => 'avis created successfully',
              ];

        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error creating prestataire', 'details' => $th->getMessage()], 500);
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
        $avis = Avis::where('id', '=', $request -> id)
        ->first(['id', 'IdUser', 'IdActivite', '', 'description']);

if(!$avis) {
return response()->json(['status' => false, 'msg' => 'Compte introuvable']);
}



$res = [
'status' => true,
'CleUser' => $avis -> IdUser,
'CleActivite' => $avis -> IdActivite,
'contenu' => $avis -> description,

];

return response()->json($res);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Avis  $avis
     * @return \Illuminate\Http\Response
     */
    public function show(Avis $avis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Avis  $avis
     * @return \Illuminate\Http\Response
     */
    public function edit(Avis $avis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Avis  $avis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Avis $avis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Avis  $avis
     * @return \Illuminate\Http\Response
     */
    public function destroy(Avis $avis)
    {
        //
    }
}
