<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdminResource;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticateController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Cek user berdasarkan username
        $admin = Admin::where('username', $request->username)->first();

        if (!$admin) {
            return response()->json([
                'status' => false,
                'message' => 'Username tidak ditemukan'
            ], 404);
        }

        // Cek password
        if (!Hash::check($request->password, $admin->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Password salah'
            ], 401);
        }

        $token = $admin->createToken('api_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login berhasil',
            'token' => $token,
        ]);
    }

    public function logout(Request $request){
        Auth::guard('admin')->user()->tokens()->delete();
        return response()->json([
            'status' => true,
            'message' => 'Logout berhasil'
        ]);
    }

    public function adminProfile(Request $request){
        return new AdminResource(Auth::guard('admin')->user());
    }
}
