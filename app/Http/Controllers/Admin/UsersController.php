<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Pegawai\PNS;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    // Get All Users
    public function getAll()
    {
        $data = User::orderBy("level", "asc")->get();
        $pegawai = null;

        foreach ($data as $i => $item) {
            $item->no = $i + 1;
            if ($item->level == 2) {
                $pegawai = DB::table("pegawai")
                    ->where("id_pegawai", "=", $item->id_pegawai)
                    ->first();
                if ($pegawai) {
                    $item->nama_pegawai = $pegawai->nama;
                    $item->foto_pegawai = $pegawai->foto;
                }
            }
        }

        return response()->json([
            "message" => "Berhasil mendapatkan semua data user",
            "data" => $data
        ], 200);
    }

    // Get User By Id
    public function getById($id_user)
    {
        $data = null;

        $user = User::find($id_user);
        if ($user->level == 1) {
            $data = $user;
        } else {
            $data = User::select(
                "users.*",
                "pegawai.nama",
                "pegawai.foto"
            )
                ->where("id", "=", $id_user)
                ->join("pegawai", "pegawai.id_pegawai", "=", "users.id_pegawai")
                ->first();
        }

        if ($data) {
            return response()->json([
                "message" => "Berhasil mendapatkan data user dengan id: $id_user",
                "data" => $data
            ], 200);
        } else {
            return response()->json([
                "message" => "Data user dengan id: $id_user tidak ditemukan"
            ],);
        }
    }

    // Insert User
    public function register(Request $request)
    {
        // Validation
        $messages = [
            'required'     => ':attribute harus diisi!',
            'unique'       => ':attribute sudah ada yang punya'
        ];
        $validasi = [];

        // Cek level user
        if ($request->level == 1) {
            // Jika admin
            $validasi = [
                'username' => 'required|unique:users',
                'password' => 'required',
                'level'    => 'required',
                'name'     => 'required',
                'foto_profil'     => 'mimes:jpg,jpeg,png|max:1048',
            ];
        } else {
            // Jika user pegawai
            $validasi = [
                'id_pegawai' => 'required',
                'username' => 'required|unique:users',
                'password' => 'required',
                'level'    => 'required',
            ];
        }

        $validator = Validator::make(
            $request->all(),
            $validasi,
            $messages
        );
        // Jika Validasi Gagal
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }
        // Jika Validasi Berhasil
        if (!$request->hasFile("foto_profil")) {
            $foto = "";
        } else {
            $file = $request->file("foto_profil");

            // Sanitasi nama file
            $sanitize = sanitizeFile($file);
            $foto = $file->storeAs("images/foto", rand(0, 9999) . time() . '-' . $sanitize);
        }

        if ($request->level == 1) {
            // Jika admin
            $user = new User();
            $user->name = $request->name;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->level = $request->level;
            $user->foto_profil = $foto;
            $user->save();
        } else {
            // Jika user pegawai
            $user = new User();
            $user->id_pegawai = $request->id_pegawai;
            $user->name = $request->username;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->level = $request->level;
            $user->foto_profil = $foto;
            $user->save();
        }

        return response()->json([
            "message" => "Register User Berhasil",
            "input_data"    => $user
        ], 201);
    }

    // Edit User
    public function edit(Request $request, $id_user)
    {
        // Cek Username
        $user = DB::table("users")->where("id", "=", $id_user)->first();
        if ($user->username === $request->username) {
            $username_rules = "required";
        } else {
            $username_rules = "required|unique:users";
        }

        // Validation
        $messages = [
            'required'     => ':attribute harus diisi!',
            'unique'       => ':attribute sudah ada yang punya'
        ];
        $validator = Validator::make(
            $request->all(),
            [
                'username'    => $username_rules,
                'name'        => 'required',
                'foto_profil' => 'mimes:jpg,jpeg,png|max:1048'
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
        $edit = User::edit($request, $id_user);

        if ($edit === 404) {
            return response()->json([
                "message" => "Data user dengan id: $id_user tidak ditemukan",
            ], 404);
        } else {
            return response()->json([
                "message" => "Berhasil mengubah data user dengan id: $id_user",
                "edited_data" => $edit
            ], 201);
        }
    }

    // Edit Password
    public function editPassword(Request $request, $id_user)
    {
        // Validation
        $messages = [
            'required' => ':attribute is required!',
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
        // Cek password lama
        $user = User::where('id', "=", $id_user)->first();
        if (!Hash::check($request->password_lama, $user->password)) {
            return response()->json([
                "errors" => ["Password lama salah"]
            ], 400);
        }
        // Jika Validasi Berhasil
        $edit = User::editPassword($request, $id_user);

        if ($edit === 404) {
            return response()->json([
                "message" => "Data user dengan id: $id_user tidak ditemukan",
            ], 404);
        } else {
            return response()->json([
                "message" => "Berhasil mengubah password user dengan id: $id_user"
            ], 201);
        }
    }

    // Delete User
    public function delete($id_user)
    {
        $data = User::where("id", "=", $id_user)->first();

        $delete = User::deleteUser($id_user);

        if ($delete !== 404) {
            return response()->json([
                "message" => "Berhasil menghapus data user dengan id: $id_user",
                "deleted_data" => $data
            ], 201);
        } else {
            return response()->json([
                "message" => "Data user dengan id: $id_user tidak ditemukan"
            ], 404);
        }
    }
}
