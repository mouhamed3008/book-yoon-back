<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{

    public function register(UserStoreRequest $request) {


        $user = User::create($request->validated());
        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => new UserResource( $user),
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'telephone' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('telephone', $fields['telephone'])->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' =>  new UserResource( $user),
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

}
