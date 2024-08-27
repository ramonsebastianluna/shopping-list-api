<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;


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
        return response()->json([
            'message' => 'método login ok',
        ]);
    }

    public function userProfile(Request $request) {
        return response()->json([
            'message' => 'método userProfile ok',
        ]);
    }

    public function logout() {
        return response()->json([
            'message' => 'método logout ok',
        ]);
    }

    public function allUsers() {
        return response()->json([
            'message' => 'método allUsers ok',
        ]);
    }
}
