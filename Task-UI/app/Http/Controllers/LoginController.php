<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{

    public function signin(){
        return view("login.signin");
    }

    public function signup(){
        return view("login.signup");
    }


}
