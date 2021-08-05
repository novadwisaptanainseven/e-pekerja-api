<?php

namespace App\Models\User\DataKepegawaian;

use App\Models\Admin\Pegawai\PNS;
use App\Models\Admin\Pegawai\PTTB;
use App\Models\Admin\Pegawai\PTTH;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class DataDiri extends Model
{
    use HasApiTokens, HasFactory;

    // Get Data Diri
    public static function getDataDiri($id)
    {
        // Tabel - tabel
        $tbl_pegawai = "pegawai";
        $tbl_agama = "agama";
        $tbl_status_pegawai = "status_pegawai";
        $tbl_bidang = "bidang";
        $tbl_pangkat_golongan = "pangkat_golongan";
        $tbl_pangkat_eselon = "pangkat_eselon";
        $tbl_jabatan = "jabatan";
        $tbl_masa_kerja = "masa_kerja_pegawai";
        $tbl_kgb = "kgb";
        $tbl_ptth = "ptth";

        $data_pegawai = PNS::getById($id);
        $data_ptth = PTTH::getById($id);
        $data_pttb = PTTB::getById($id);

        // Cek apakah data pegawai ditemukan
        // Jika PNS
        if ($data_pegawai->id_status_pegawai == 1) {

            $data_masa_kerja = DB::table($tbl_masa_kerja)->where('id_pegawai', '=', $id)->first();

            $data_pegawai->mk_jabatan = $data_masa_kerja->mk_jabatan;
            $data_pegawai->mk_sebelum_cpns = $data_masa_kerja->mk_sebelum_cpns;
            $data_pegawai->mk_golongan = $data_masa_kerja->mk_golongan;
            $data_pegawai->mk_seluruhnya = $data_masa_kerja->mk_seluruhnya;

            // Get data gaji pegawai
            // $data_gaji = DB::table($tbl_kgb)
            //     ->where('id_pegawai', '=', $data_pegawai->id_pegawai)
            //     ->orderBy('id_kgb', 'desc')
            //     ->first();
            // if ($data_gaji) {
            //     $data_pegawai->gaji_pokok = $data_gaji->gaji_pokok_baru;
            // }
            return $data_pegawai;
        }

        // Get NIK jika status pegawai adalah PTTH
        // Jika PTTH
        if ($data_pegawai->id_status_pegawai == 2) {
            $ptth = DB::table($tbl_ptth)
                ->where("id_pegawai", "=", $id)
                ->first();

            if ($ptth) {
                $data_pegawai->nik = $ptth->nik;
            } else {
                $data_pegawai->nik = "";
            }

            return $data_ptth;
        }

        // Jika PTTB
        if ($data_pegawai->id_status_pegawai == 3) {
            return $data_pttb;
        }

        return null;
    }
}
