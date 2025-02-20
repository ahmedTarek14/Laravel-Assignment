<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $registerRequest)
    {
        try {
            $registerRequest['password'] = Hash::make($registerRequest['password']);

            $user = User::create($registerRequest->all());

            $token = $user->createToken('register')->plainTextToken;

            return api_response_success([
                'token' => $token,
                'user' => new UserResource($user),
            ]);
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            return api_response_error();
        }
    }
    public function login(LoginRequest $loginRequest)
    {
        $user = User::where('email', $loginRequest->email)->first();
        if ($user) {
            if (Hash::check($loginRequest->password, $user->password)) {
                $user->tokens()->delete();
                $token = $user->createToken('login')->plainTextToken;
                return api_response_success([
                    'token' => $token,
                    'user' => new UserResource($user),
                ]);
            } else {
                return api_response_error('Password mismatch.');
            }
        } else {
            return api_response_error('Please review your data and try again.');
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

        return api_response_success('Logout successfully.');
    }
}