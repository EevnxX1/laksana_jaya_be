<?php

namespace App\Http\Controllers;
use \Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Register
    public function register(Request $request)
    {
        // validasi jika konten yang terdapat di data ini sama dengan yang di input user
        $validate_data = $request->validate([
            'name'     => 'required',
            'username' => 'required',
            'email'    => 'required|email',
            'password' => 'required',
            'role'     => 'required',
        ]);

        Log::info('Validated Data: ', $validate_data); // Tambahkan log untuk debug

        // setelah tervalidasi, maka masukkan data itu ke database
        $user = User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => $request->role,
        ]);

        if (! $user) {
            Log::error('User registration failed!');
            return response()->json([
                'message' => 'Failed to register user',
            ], 500);
        }

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
        ], 201);
    }

    // Login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid email or password',
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successfully',
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'user' => $user,
        ], 200);
    }

    // Logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out']);
    }
}
