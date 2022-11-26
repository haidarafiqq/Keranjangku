<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
            'role' => 'required|string'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'],),
            'role' => $fields['role']
        ]);

        $token = $user->createToken('tokenku')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json($response, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
        'email' => 'required|string',
        'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();
        // return $user;
        // Check Password
        if (!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'unauthorized'
            ], 401);
        }
            $token = $user->createToken('tokenku')->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token
            ];

            return response($response, 201);
    }   

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
