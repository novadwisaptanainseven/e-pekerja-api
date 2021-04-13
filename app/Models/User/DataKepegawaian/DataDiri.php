<?php

namespace App\Models\User\DataKepegawaian;

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

        $data_pegawai = DB::table($tbl_pegawai)
            ->select(
                "$tbl_pegawai.*",
                "$tbl_agama.agama",
                "$tbl_status_pegawai.status_pegawai",
                "$tbl_status_pegawai.keterangan AS ket_status_pegawai",
                "$tbl_bidang.nama_bidang AS bidang",
                "$tbl_pangkat_golongan.golongan",
                "$tbl_pangkat_golongan.keterangan AS ket_golongan",
                "$tbl_pangkat_eselon.eselon",
                "$tbl_pangkat_eselon.keterangan AS ket_eselon",
                "$tbl_jabatan.nama_jabatan AS jabatan",
            )
            ->where('id_pegawai', '=', $id)
            ->leftJoin($tbl_agama, "$tbl_agama.id_agama", "=", "$tbl_pegawai.id_agama")
            ->leftJoin($tbl_status_pegawai, "$tbl_status_pegawai.id_status_pegawai", "=", "$tbl_pegawai.id_status_pegawai")
            ->leftJoin($tbl_bidang, "$tbl_bidang.id_bidang", "=", "$tbl_pegawai.id_bidang")
            ->leftJoin($tbl_pangkat_golongan, "$tbl_pangkat_golongan.id_pangkat_golongan", "=", "$tbl_pegawai.id_golongan")
            ->leftJoin($tbl_pangkat_eselon, "$tbl_pangkat_eselon.id_pangkat_eselon", "=", "$tbl_pegawai.id_eselon")
            ->leftJoin($tbl_jabatan, "$tbl_jabatan.id_jabatan", "=", "$tbl_pegawai.id_jabatan")
            ->first();

        // Cek apakah data pegawai ditemukan
        if ($data_pegawai) {

            $data_masa_kerja = DB::table($tbl_masa_kerja)->where('id_pegawai', '=', $id)->first();

            $data_pegawai->mk_jabatan = $data_masa_kerja->mk_jabatan;
            $data_pegawai->mk_sebelum_cpns = $data_masa_kerja->mk_sebelum_cpns;
            $data_pegawai->mk_golongan = $data_masa_kerja->mk_golongan;
            $data_pegawai->mk_seluruhnya = $data_masa_kerja->mk_seluruhnya;

            // Get NIK jika status pegawai adalah PTTH
            if ($data_pegawai->id_status_pegawai == 2) {
                $ptth = DB::table($tbl_ptth)
                    ->where("id_pegawai", "=", $id)
                    ->first();

                if ($ptth) {
                    $data_pegawai->nik = $ptth->nik;
                } else {
                    $data_pegawai->nik = "";
                }
            }

            // Get data gaji pegawai
            $data_gaji = DB::table($tbl_kgb)
                ->where('id_pegawai', '=', $data_pegawai->id_pegawai)
                ->orderBy('id_kgb', 'desc')
                ->first();
            if ($data_gaji) {
                $data_pegawai->gaji_pokok = $data_gaji->gaji_pokok_baru;
            }

            return $data_pegawai;
        } else {
            return null;
        }
    }
}
