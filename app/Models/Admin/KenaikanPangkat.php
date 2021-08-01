<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KenaikanPangkat extends Model
{
    use HasFactory;

    protected $table = "kenaikan_pangkat";

    protected $guarded = [];

    // Get All Kenaikan Pangkat
    public static function getAll()
    {
        // Tabel - tabel
        $tbl_kenaikan_pangkat = "kenaikan_pangkat";
        $tbl_pangkat_golongan = "pangkat_golongan";
        $tbl_pegawai = "pegawai";

        $data_kenaikan_pangkat = DB::table($tbl_kenaikan_pangkat)
            ->leftJoin($tbl_pegawai, "$tbl_pegawai.id_pegawai", "=", "$tbl_kenaikan_pangkat.id_pegawai")
            ->leftJoin($tbl_pangkat_golongan, "$tbl_pangkat_golongan.id_pangkat_golongan", "=", "$tbl_pegawai.id_golongan")
            ->get();

        return $data_kenaikan_pangkat;
    }
}
