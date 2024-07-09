<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    //
    public function upload(Request $request)
    {
        try {
            
            // Récupérer le fichier
            $image = $request -> file('image');

            // Définir un nom unique pour l'image
            $imageName = time().'_'.uniqid().'.'.$image->extension();

            // Déplacer l'image dans le dossier public
            $image->move(public_path('galery'), $imageName);

            // Retourner le nom de l'image
            // return response()->json(['image' => $imageName]);
            return response()->json(['image' => $imageName]);

        } catch (\Exception $e) {
            //throw $th;
            return response()->json(['error' => 'Error uploading this file', 'details' => $e->getMessage()], 500);
        }
    }

}
