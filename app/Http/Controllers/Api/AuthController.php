<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Cookie;


class AuthController extends Controller
{
    public function register(Request $request) {
        try {
            // validation
            $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:8|confirmed',
            ]);
    
            // set user in db
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
    
            // return response
            return response($user, Response::HTTP_CREATED);
            
            //error response
        } catch (ValidationException $e) {
            throw new HttpResponseException(response()->json($e->errors(), Response::HTTP_UNPROCESSABLE_ENTITY));
        }
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('Token')->plainTextToken;
            $cookie = cookie('cookie_token', $token, 60 * 24);
            return response([
                'message' => "successfully logged in",
                'status_code' => 200,
                'token' => $token
            ], Response::HTTP_OK)->withoutCookie($cookie);
        } else {
            return response(['message' => 'invalid credentials'], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function userProfile(Request $request) {
        return response()->json([
            'message' => 'método userProfile ok',
        ]);
    }

    public function logout() {
        $cookie = Cookie::forget('cookie_token');
        
        return response([
            "message"=>"successfully logged out"
        ], Response::HTTP_OK)->withCookie($cookie);
    }

    public function allUsers() {
        return response()->json([
            'message' => 'método allUsers ok',
        ]);
    }
}
