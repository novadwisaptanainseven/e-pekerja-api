<?php

namespace App\Models\Admin\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StatusPegawai extends Model
{
    use HasFactory;

    protected $table = "status_pegawai";
    protected $primaryKey = "id_status_pegawai";

    // Insert Status Pegawai
    public static function insert($req)
    {
        // Tabel - tabel
        $tbl_status_pegawai = "status_pegawai";

        $data = [
            "status_pegawai"   => $req->status_pegawai,
            "keterangan"   => $req->keterangan,
        ];

        $cek_insert = DB::table($tbl_status_pegawai)->insert($data);

        return $cek_insert;
    }

    // Edit Status Pegawai
    public static function edit($req, $id)
    {
        // Tabel - tabel
        $tbl_status_pegawai = "status_pegawai";

        // Cek apakah data ditemukan
        $status_pegawai = DB::table($tbl_status_pegawai)->where('id_status_pegawai', '=', $id)->first();
        if (!$status_pegawai) {
            return 404; // NOT FOUND
        }

        $data = [
            "status_pegawai" => $req->status_pegawai,
            "keterangan" => $req->keterangan
        ];

        $cek_edit = DB::table($tbl_status_pegawai)->where('id_status_pegawai', '=', $id)->update($data);

        // Cek apakah proses edit berhasil
        if ($cek_edit) {
            return $cek_edit;
        } else {
            return 500;
        }
    }

    // Delete Status Pegawai
    public static function deleteStatusPegawai($id)
    {
        // Tabel - tabel
        $tbl_status_pegawai = "status_pegawai";

        // Cek apakah data ditemukan
        $status_pegawai = DB::table($tbl_status_pegawai)->where('id_status_pegawai', '=', $id)->first();
        if (!$status_pegawai) {
            return 404; // NOT FOUND
        }

        $cek_delete = DB::table($tbl_status_pegawai)->where('id_status_pegawai', '=', $id)->delete();

        // Cek apakah proses delete berhasil
        if ($cek_delete) {
            return $cek_delete;
        } else {
            return 500;
        }
    }
}
