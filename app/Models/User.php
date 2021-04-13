<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = "users";
    protected $primaryKey = "id";

    // Edit User
    public static function edit($req, $id_user)
    {
        // Tabel - Tabel
        $tbl_users = "users";

        // Cek apakah data user ditemukan
        $user = DB::table($tbl_users)
            ->where("id", "=", $id_user)
            ->first();
        if (!$user) {
            return 404;
        }

        // Upload foto
        $foto_profil = $user->foto_profil;
        if ($req->file("foto_profil")) {
            // Hapus Foto Profil Lama
            Storage::delete($user->foto_profil);

            $file = $req->file("foto_profil");

            // Sanitasi nama file
            $sanitize = sanitizeFile($file);
            $foto_profil = $file->storeAs("images/foto", rand(0, 9999) . time() . '-' . $sanitize);
        }

        $data = [
            "username" => $req->username ? $req->username : $user->username,
            "name" => $req->name ? $req->name : $user->name,
            "foto_profil" => $foto_profil,
        ];
        // Update Data
        DB::table($tbl_users)
            ->where("id", "=", $id_user)
            ->update($data);

        // Dapatkan data setelah diedit
        $edited_data = DB::table($tbl_users)
            ->where("id", "=", $id_user)
            ->first();

        return $edited_data;
    }

    // Edit Password
    public static function editPassword($req, $id_user)
    {
        // Tabel - Tabel
        $tbl_users = "users";

        // Cek apakah data user ditemukan
        $user = DB::table($tbl_users)
            ->where("id", "=", $id_user)
            ->first();
        if (!$user) {
            return 404;
        }

        $data = [
            "password" => $req->password_baru ? Hash::make($req->password_baru) : $user->password,
        ];

        // Update Data
        DB::table($tbl_users)
            ->where("id", "=", $id_user)
            ->update($data);

        return 201;
    }

    // Delete User
    public static function deleteUser($id_user)
    {
        // Tabel - Tabel
        $tbl_users = "users";

        // Cek apakah data user ditemukan
        $user = DB::table($tbl_users)
            ->where("id", "=", $id_user)
            ->first();
        if (!$user) {
            return 404;
        }

        // Update Data
        DB::table($tbl_users)
            ->where("id", "=", $id_user)
            ->delete();

        return 201;
    }
}
