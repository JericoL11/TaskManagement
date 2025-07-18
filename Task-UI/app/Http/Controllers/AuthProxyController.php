<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthProxyController extends Controller
{
      public function login(Request $request)
    {
        // Forward request to backend API
        $res = Http::post("http://127.0.0.1:8000/api/auth/login", [
            'username' => $request->input('username'),
            'password' => $request->input('password')
        ]);

        return response()->json(json_decode($res, true));
    }

    public function register(Request $request)
    {
        $res = Http::post("http://127.0.0.1:8000/api/register", [
            'username'   => $request->input('username'),
            'password'   => $request->input('password'),
            'firstName'  => $request->input('firstName'),
            'lastName'   => $request->input('lastName'),
            'middleName' => $request->input('middleName'),
            'address'    => $request->input('address'),
            'birthDate'  => $request->input('birthDate'),
            'contactNo'  => $request->input('contactNo'),
        ]);

        return response()->json(json_decode($res, true));
    }

    public function logout(Request $request){

       $token = $request->bearerToken();   // Get token from frontend's Authorization header

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

       $res = Http::withToken($token)->post("http://127.0.0.1:8000/api/auth/logout");

        return response()->json(json_decode($res, true));

    }
}
