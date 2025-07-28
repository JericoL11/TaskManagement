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
        $res = Http::post("http://127.0.0.1:8000/api/auth/register", [
            'username'   => $request->input('username'),
            'password'   => $request->input('password'),
            'firstName'  => $request->input('firstName'),
            'lastName'   => $request->input('lastName'),
            'middleName' => $request->input('middleName'),
            'address'    => $request->input('address'),
            'birthDate'  => $request->input('birthDate'),
            'contactNo'  => $request->input('contactNo'),
            'email' => $request->input('email'),
            'password_confirmation' => $request->input('password_confirmation')

        ]);

        return response()->json(json_decode($res, true));
        // return view('login.signin',  compact('data'));

    }

    public function logout(Request $request){

       $token = $request->bearerToken();   // Get token from frontend's Authorization header

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

       $res = Http::withToken($token)->post("http://127.0.0.1:8000/api/auth/logout");

        return response()->json(json_decode($res, true));

    }


    public function sendCode(Request $request){
        $res = http::post("http://127.0.0.1:8000/api/forgot-password", [
            'email' => $request->input('email')
        ]);

        return response()->json(json_decode($res, true));
    }

    public function resetPassword(Request $request){
        $res = http::post("http://127.0.0.1:8000/api/reset-password", [
            'email' => $request->input('email'),
            'code' => $request->input('code'),
            'password' => $request->input('password'),
            'password_confirmation' => $request->input('password_confirmation')
        ]);

        return response()->json(json_decode($res,true));
    }
}
