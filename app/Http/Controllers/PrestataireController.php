<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestataire;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class PrestataireController extends Controller
{
    //
    public function create(Request $request)
    {
        try { 
            
            $prestataire = new Prestataire();
    
            $prestataire -> nom = $request -> name;
            $prestataire -> prenom = $request -> lastname;
            $prestataire -> email = $request -> email;
            $prestataire -> password = Hash::make($request -> password);
    
            $prestataire -> save();

            $prestataire_connected = Prestataire::where('email', '=', $request -> email )
                                            -> first(['id']);
            
            $res = [
                'msg' => 'prestataire created successfully',
                'authorization' => Crypt::encrypt(($prestataire_connected -> id).'<>pid')
            ];
            
            return response()->json($res);

        } catch (\Exception $e) {
            //throw $th;
            return response()->json(['error' => 'Error creating prestataire', 'details' => $e->getMessage()], 500);
        }
        
    }

    public static function find($id)
    {
        $prestataire = Prestataire::find($id);

        if (!$prestataire) {
            return response()->json(['error' => 'Prestataire non trouvé'], 404);
        }

        return response()->json([
            'name' => $prestataire -> nom,
            'lastname' => $prestataire -> prenom,
            'email' => $prestataire -> email,
            'pdp' => $prestataire -> pdp,
            'role' => 'prestateur',
            'id' => $id
        ]);
    }

    public function select(Request $request)
    {
        $prestataire = Prestataire::where('email', '=', $request -> email)
                        ->first(['id', 'nom', 'prenom', 'email', 'password']);

        if(!$prestataire) {
            return response()->json(['status' => false, 'msg' => 'Compte introuvable']);
        }

        if(!(Hash::check($request -> password, $prestataire -> password))) {
            return response()->json(['status' => false, 'msg' => 'Mot de passe incorrecte']);
        }

        $res = [
            'status' => true,
            'name' => $prestataire -> nom.' '.$prestataire -> prenom,
            'email' => $prestataire -> email,
            'authorization' => Crypt::encrypt(($prestataire -> id).'<>pid')
        ];
        
        return response()->json($res);
    }

}
