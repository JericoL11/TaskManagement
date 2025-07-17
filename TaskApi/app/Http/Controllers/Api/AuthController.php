<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Create User
     *  @param Request $request 
     *  @return User
     */

    public function createUser(Request $request){
    


        $validators = Validator::make($request->all(), [
            'email' => ['required', 'email', 'unique:user,email'],
            'password' => ['required']
        ]);



    }

}
