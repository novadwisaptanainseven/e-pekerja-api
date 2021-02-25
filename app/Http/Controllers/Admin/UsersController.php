<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    // Insert User
    public function register(Request $request)
    {
        // Validation
        $messages = [
            'required'     => ':attribute is required!',
            'unique'       => ':attribute sudah ada yang punya'
        ];
        $validator = Validator::make(
            $request->all(),
            [
                'username' => 'required|unique:users',
                'password' => 'required',
                'level'    => 'required',
                'name'     => 'required',
            ],
            $messages
        );
        // Jika Validasi Gagal
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }
        // Jika Validasi Berhasil
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->level = 2; // Level User 
        $user->save();

        return response()->json([
            "message" => "Register User Berhasil",
            "data"    => $user
        ], 201);
    }
}
