<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User as UserResource;

class LoginController extends Controller
{
    public function login()
    {
        $Accesstoken = Auth::user()->createToken('Access Token')->accessToken;

        return response([
            'User' => new UserResource(Auth::user()),
            'Access Token' => $Accesstoken, // Fixed syntax here
        ]);
    }
}
