<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validatedData->fails()) {
            $errors = $validatedData->errors();

            // Return a response with the validation errors
            return response()->json(['errors' => $errors], 422);
        }
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        // Create a new user
        $user = new User([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        $user->save();


        // Generate JWT token for the user
        $token = JWTAuth::fromUser($user);

        // Return the user and token in the response
        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function index()
    {
        return User::all();
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }

        return response()->json(['token' => $token]);
    }

    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
