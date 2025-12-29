<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // l'inscription
    public function inscrire (Request $request){
        $request->validate(['name' => 'required|string|max:255', 'email'=>'required|email|unique:users', 'password'=>'required|min:8']);
        $user = User::create(['name'=> $request->name, 'email'=>$request->email, 'password'=>Hash::make($request->password)]);
        //token 
        $token= $user->createToken('aut-token')->plainTextToken;
        return response()->json(['user'=>$user, 'token'=>$token],201);
    }
     
    // connexion
    public function connecter(Request $request){
        $request->validate(['email'=>'required', 'password'=>'required']);
        $user = User::where('email',$request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            //throw ValidationException::withMessages(['email'=>['les information incorrects!']]);
            return response()->json([
            'error' => 'Les informations sont incorrectes!' ], 401);
        }
       //token
       $token = $user->createToken('api_token')->plainTextToken;

       // Connexion réussie
        return response()->json(['message' => 'Connexion réussie','user' => $user,'token' => $token], 200);
        
        
    }

    //Deconnexion
    public function deconnecter(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message'=>'lutilisateur est deconnectee']);
    }
     
}
