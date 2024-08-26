<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request) {
        return response()->json([
            'message' => 'método register ok',
        ]);
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
