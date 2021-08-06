<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AkunController extends Controller
{
    // Edit User
    public function edit(Request $request)
    {
        // Get Current User
        $user = Auth::user();

        if ($user->username === $request->username) {
            $username_rules = "required";
        } else {
            $username_rules = "required|unique:users";
        }

        // Validation
        $messages = [
            'required'     => ':attribute is required!',
            'unique'       => ':attribute sudah ada yang punya'
        ];
        $validator = Validator::make(
            $request->all(),
            [
                'username'    => $username_rules,
                // 'name'        => 'required',
                // 'foto_profil' => 'mimes:jpg,jpeg,png|max:1048'
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
        $edit = User::edit($request, $user->id);

        if ($edit === 404) {
            return response()->json([
                "message" => "Data user dengan id: $user->id tidak ditemukan",
            ], 404);
        } else {
            return response()->json([
                "message" => "Berhasil mengubah data user dengan id: $user->id",
                "edited_data" => $edit
            ], 201);
        }
    }

    // Edit Password
    public function editPassword(Request $request)
    {
        // Validation
        $messages = [
            'required' => ':attribute harus diisi!',
            'same'     => ':attribute harus sesuai dengan :other'
        ];
        $validator = Validator::make(
            $request->all(),
            [
                'password_lama' => 'required',
                'password_baru' => 'required|same:konfirmasi_password',
                'konfirmasi_password' => 'required',
            ],
            $messages
        );
        // Jika Validasi Gagal
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        // Get Current User
        $user = Auth::user();

        // Cek password lama
        if (!Hash::check($request->password_lama, $user->password)) {
            return response()->json([
                "errors" => ["Password lama salah"]
            ], 400);
        }
        // Jika Validasi Berhasil
        $edit = User::editPassword($request, $user->id);

        if ($edit === 404) {
            return response()->json([
                "message" => "Data user dengan id: $user->id tidak ditemukan",
            ], 404);
        } else {
            return response()->json([
                "message" => "Berhasil mengubah password user dengan id: $user->id"
            ], 201);
        }
    }
}
