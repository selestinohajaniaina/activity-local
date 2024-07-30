<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class userController extends Controller
{
    //
    public function create(Request $request)
    {
        $user = new User();
 
        $user -> name = ($request -> name).' '.($request -> lastname);
        $user -> email = $request -> email;
        $user -> password = Hash::make($request -> password);
 
        $user -> save();
 
        $prestataire_connected = User::where('email', '=', $request -> email )
                                            -> first(['id']);
            
            $res = [
                'msg' => 'user created successfully',
                'authorization' => Crypt::encrypt(($prestataire_connected -> id).'<>uid')
            ];
        
        return response()->json($res);
    }

    public static function find($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Utilisateur non trouvé'], 404);
        }

        // Autres traitements selon vos besoins
        return response()->json([
            'username' => $user -> name,
            'email' => $user -> email,
            'role' => 'user',
            'id' => $id
        ]);
    }

    public function select(Request $request)
    {
        $user = User::where('email', '=', $request -> email)
                        ->first(['id', 'name', 'email', 'password']);

        if(!$user) {
            return response()->json(['status' => false, 'msg' => 'Compte introuvable']);
        }

        if(!(Hash::check($request -> password, $user -> password))) {
            return response()->json(['status' => false, 'msg' => 'Mot de passe incorrecte']);
        }

        $res = [
            'status' => true,
            'name' => $user -> name,
            'email' => $user -> email,
            'authorization' => Crypt::encrypt(($user -> id).'<>uid')
        ];
        
        return response()->json($res);
    }

    public static function all()
    {
        $user = User::all();

        return $user;
    }

}
