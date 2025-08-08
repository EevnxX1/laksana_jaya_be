<?php

namespace App\Http\Controllers;
use \Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
            'alamat'   => 'required',
            'no_hp'    => 'required',
            'role'     => 'required',
        ]);

        Log::info('Validated Data: ', $validate_data); // Tambahkan log untuk debug

        // setelah tervalidasi, maka masukkan data itu ke database
        $user = User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'alamat'   => $request->alamat,
            'no_hp'    => $request->no_hp,
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

    public function update(Request $request, $id) 
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'username' => 'required',
            'email'    => 'required|email',
            'password' => 'nullable|string',
            'alamat'   => 'required',
            'no_hp'    => 'required',
            'role'     => 'required',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $data = User::findOrFail($id);

        if(is_null($request->password)) {
            $passBefore = $data->password;
        }

        // Simpan data baru
        $data->update([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => isset($passBefore) ? $passBefore : bcrypt($request->password),
            'alamat'   => $request->alamat,
            'no_hp'    => $request->no_hp,
            'role'     => $request->role,
        ]);

        return response()->json([
            'message' => 'User updated successfully.',
            'data' => $data
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

    public function destroy($id)
    {
        $data = User::find($id);

        if (!$data) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        $data->delete();

        return response()->json(['message' => 'User deleted successfully.'], 200);
    }
}
