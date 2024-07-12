<?php

namespace App\Http\Controllers;

use App\Models\Galerie;
use Illuminate\Http\Request;

class GalerieController extends Controller
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
    public static function create($nom, $id_activity)
    {

        try {
            //
            $image = new Galerie();
            $image -> NomImage = $nom;
            $image -> IdActivite = $id_activity;

            $image -> save();

            $image_id = $image -> id;
            
            return $image_id;
    
        } catch (\Exception $e) {
            //throw $th;
            return response()->json(['error' => 'Error saving name image', 'details' => $e->getMessage()], 500);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function get_one($id_activity)
    {
        //
        return Galerie::inRandomOrder() -> where('IdActivite', $id_activity) -> first();
    }

    public function get_all($id_activity)
    {
        //
        return Galerie::where('IdActivite', $id_activity) -> get();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Galerie  $galerie
     * @return \Illuminate\Http\Response
     */
    public function show(Galerie $galerie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Galerie  $galerie
     * @return \Illuminate\Http\Response
     */
    public function edit(Galerie $galerie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Galerie  $galerie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Galerie $galerie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Galerie  $galerie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Galerie $galerie)
    {
        //
    }
}
