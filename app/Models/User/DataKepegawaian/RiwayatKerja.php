<?php

namespace App\Models\User\DataKepegawaian;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class RiwayatKerja extends Model
{
    use HasApiTokens, HasFactory;

    // Get All Riwayat Kerja
    public static function getAll($id_pegawai)
    {
        // Tabel - tabel
        $tbl_riwayat_kerja = "riwayat_kerja";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)->where("id_pegawai", "=", $id_pegawai)->first();
        if (!$data_pegawai) {
            return 404;
        }

        $data_riwayat_kerja = DB::table($tbl_riwayat_kerja)
            ->where('id_pegawai', '=', $id_pegawai)
            ->get();

        return $data_riwayat_kerja;
    }
}
