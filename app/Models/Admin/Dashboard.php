<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        $tbl_cuti = "cuti";
        $tbl_users = "users";

        $tot_pegawai = DB::table($tbl_pegawai)->get()->count();
        $tot_pns = DB::table($tbl_pegawai)
            ->where("id_status_pegawai", "=", 1)->count();
        $tot_ptth = DB::table($tbl_pegawai)
            ->where("id_status_pegawai", "=", 2)->count();
        $tot_pttb = DB::table($tbl_pegawai)
            ->where("id_status_pegawai", "=", 3)->count();
        $tot_pria = DB::table($tbl_pegawai)
            ->where("jenis_kelamin", "=", "Laki - Laki")->count();
        $tot_wanita = DB::table($tbl_pegawai)
            ->where("jenis_kelamin", "=", "Perempuan")->count();

        $dateNow = date("Y-m-d");
        $tot_cuti = DB::table($tbl_cuti)
            ->where([
                ["tgl_mulai", "<=", $dateNow],
                ["tgl_selesai", ">=", $dateNow],
            ])
            ->get()->count();
        $tot_users = DB::table($tbl_users)->get()->count();

        $data = [
            "total_pegawai" => $tot_pegawai,
            "total_pns" => $tot_pns,
            "total_ptth" => $tot_ptth,
            "total_pttb" => $tot_pttb,
            "total_pria" => $tot_pria,
            "total_wanita" => $tot_wanita,
            "total_cuti" => $tot_cuti,
            "total_users" => $tot_users,
        ];

        return $data;
    }
}
