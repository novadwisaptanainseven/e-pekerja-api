<?php

namespace App\Models\User\DataKepegawaian;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class Keluarga extends Model
{
    use HasApiTokens, HasFactory;

    // Get All Keluarga
    public static function getAll($id_pegawai)
    {
        // Tabel - tabel
        $tbl_keluarga = "keluarga";
        $tbl_agama = "agama";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)->where("id_pegawai", "=", $id_pegawai)->first();
        if (!$data_pegawai) {
            return 404;
        }

        $data_keluarga = DB::table($tbl_keluarga)
            ->where('id_pegawai', '=', $id_pegawai)
            ->leftJoin($tbl_agama, "$tbl_agama.id_agama", "=", "$tbl_keluarga.id_agama")
            ->get();

        return $data_keluarga;
    }
}
