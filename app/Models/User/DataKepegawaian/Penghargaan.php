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

    // Get Penghargaan by ID
    public static function getById($id_penghargaan)
    {
        // Tabel - tabel
        $tbl_penghargaan = "penghargaan";
        $tbl_pegawai = "pegawai";
        $tbl_ptth = "ptth";

        $data_penghargaan = DB::table($tbl_penghargaan)
            ->select(
                "$tbl_penghargaan.*",
                "$tbl_pegawai.nip",
                "$tbl_pegawai.nama",
            )
            ->where("id_penghargaan", '=', $id_penghargaan)
            ->leftJoin($tbl_pegawai, "$tbl_pegawai.id_pegawai", "=", "$tbl_penghargaan.id_pegawai")
            ->first();

        if(!$data_penghargaan)
        {
            return null;
        }

        $data_pegawai = DB::table($tbl_pegawai)
                ->where("id_pegawai", "=", $data_penghargaan->id_pegawai)
                ->first();
        
        if($data_pegawai->id_status_pegawai == 2)
        {
            $ptth = DB::table($tbl_ptth)
                ->where("id_pegawai", "=", $data_pegawai->id_pegawai)
                ->first();
            if($ptth)
            {
                $data_penghargaan->nik = $ptth->nik;
            }
            else
            {
                $data_penghargaan->nik = "";
            }
        }

        return $data_penghargaan;
    }
}
