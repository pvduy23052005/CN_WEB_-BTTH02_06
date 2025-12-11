<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // [get] /auth/login
    public function login(){
        return view("auth.login");
    }

    // [post] /auth/login
    public function loginPost(Request $request){
    }

    // [get] /auth/register
    public function register(){
        return view("auth.register");

    }
}