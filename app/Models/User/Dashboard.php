<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class Dashboard extends Model
{
    use HasApiTokens, HasFactory;

    // Get All Information Dashboard
    public static function getInformation()
    {
        // Tabel - Tabel
        $tbl_pegawai = "pegawai";
        $tbl_keluarga = "keluarga";
        $tbl_absensi = "absensi";
        $tbl_status_pegawai = "status_pegawai";
        $tbl_kgb = "kgb";

        // Get Current User
        $user = Auth::user();

        $data_pegawai = DB::table($tbl_pegawai)
            ->where("id_pegawai", "=", $user->id_pegawai)
            ->leftJoin($tbl_status_pegawai, "$tbl_status_pegawai.id_status_pegawai", "=", "$tbl_pegawai.id_status_pegawai")
            ->first();

        $total_keluarga = DB::table($tbl_keluarga)
            ->where("id_pegawai", "=", $user->id_pegawai)
            ->get()->count();

        // Hitung total tanpa keterangan
        $tanpa_keterangan = DB::table($tbl_absensi)
            ->where([
                ["id_pegawai", "=", $user->id_pegawai],
                ["absen", "=", 0],
            ])
            ->get()->count();
        // Hitung total hadir

        $hadir = DB::table($tbl_absensi)
            ->where([
                ["id_pegawai", "=", $user->id_pegawai],
                ["absen", "=", 1],
            ])
            ->get()->count();

        // Hitung total izin
        $izin = DB::table($tbl_absensi)
            ->where([
                ["id_pegawai", "=", $user->id_pegawai],
                ["absen", "=", 2],
            ])
            ->get()->count();

        // Hitung total sakit
        $sakit = DB::table($tbl_absensi)
            ->where([
                ["id_pegawai", "=", $user->id_pegawai],
                ["absen", "=", 3],
            ])
            ->get()->count();

        // Hitung total cuti
        $cuti = DB::table($tbl_absensi)
            ->where([
                ["id_pegawai", "=", $user->id_pegawai],
                ["absen", "=", 4],
            ])
            ->get()->count();

        // Get data gaji pegawai
        $data_gaji = DB::table($tbl_kgb)
            ->where('id_pegawai', '=', $data_pegawai->id_pegawai)
            ->orderBy('id_kgb', 'desc')
            ->first();
        if ($data_gaji) {
            $gaji_pokok = $data_gaji->gaji_pokok_baru;
        } else {
            $gaji_pokok = $data_pegawai->gaji_pokok;
        }

        $data = [
            "foto_pegawai" => $data_pegawai->foto,
            "total_keluarga" => $total_keluarga,
            "status_pegawai" => $data_pegawai->status_pegawai,
            "tanpa_keterangan" => $tanpa_keterangan,
            "hadir" => $hadir,
            "izin" => $izin,
            "sakit" => $sakit,
            "cuti" => $cuti,
            "gaji_pokok" => $gaji_pokok
        ];

        return $data;
    }
}
