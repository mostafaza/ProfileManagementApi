<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        
        $request->validate([
            'adm_email' => 'required|email',
            'adm_password' => 'required',
        ]);

        //Recuperation du compte admin 
        $admin = Administrator::where('adm_email', $request->adm_email)->first();

        //Verification si le compte administrator existe et si le mot de passe match avec le hash
        if (!$admin || !Hash::check($request->adm_password, $admin->adm_password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $admin->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token], 200);
    
    }
}
