<?php

namespace App\Models\User\DataKepegawaian;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class Penghargaan extends Model
{
    use HasApiTokens, HasFactory;

    // Get All Penghargaan
    public static function getAll($id_pegawai)
    {
        // Tabel - tabel
        $tbl_penghargaan = "penghargaan";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)->where("id_pegawai", "=", $id_pegawai)->first();
        if (!$data_pegawai) {
            return 404;
        }

        $data_penghargaan = DB::table($tbl_penghargaan)
            ->where('id_pegawai', '=', $id_pegawai)
            ->get();

        return $data_penghargaan;
    }
}
