<?php

namespace App\Http\Controllers\Api;

use App\Classes\ImageHandler;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) : JsonResponse
    {
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'image' => ImageHandler::handleUpload($request, 'image'),
            'role_id' => 2,
        ]);

        return response()->json([
            'message' => 'Registration Successful',
        ], 201);
    }

    public function login(Request $request) : JsonResponse
    {
        $this->validate($request, [
            'email' => 'email|required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request['email'])->first();

        if ($user) {
            if (!Hash::check($request['password'], $user['password'])) {
                return response()->json([
                    'message' => 'Password is incorrect',
                ], 422);
            }
        } else {
            return response()->json([
                'message' => 'User with this e-mail does not exist in system!'
            ], 422);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
        ]);
    }

    public function logout(Request $request) : JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged Out!'
        ]);
    }
}
