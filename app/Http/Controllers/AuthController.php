<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterForm;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function register(RegisterForm $request)
    {

        DB::beginTransaction();
        $user = User::add($request->email, $request->validated());

        $accessToken = $user->createToken('user-token')->plainTextToken;
        DB::commit();

        return response()->json([
            'data' => UserResource::make($user),
            'accessToken' => $accessToken,
        ], 200);
    }

    public function login(LoginRequest $request)
    {

        if (!auth()->attempt($request->credentials())) {
            return response()->json([
                'message' => 'Invalid username or password credentials'
            ], 430);
        }

        $user = auth()->user();
        $accessToken = $user->createToken('userToken');


        return response()->json([
            'data' => UserResource::make($user),
            'accessToken' => $accessToken,
        ], 200);
    }
}
