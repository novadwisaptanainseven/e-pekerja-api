<?php

namespace App\Models\Admin\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PangkatGolongan extends Model
{
    use HasFactory;

    protected $table = "pangkat_golongan";
    protected $primaryKey = "id_pangkat_golongan";

    // Insert Pangkat Golongan
    public static function insert($req)
    {
        // Tabel - tabel
        $tbl_pangkat_golongan = "pangkat_golongan";

        $data = [
            "golongan"   => $req->golongan,
            "keterangan" => $req->keterangan
        ];

        $cek_insert = DB::table($tbl_pangkat_golongan)->insert($data);

        return $cek_insert;
    }

    // Edit Pangkat Golongan
    public static function edit($req, $id)
    {
        // Tabel - tabel
        $tbl_pangkat_golongan = "pangkat_golongan";

        // Cek apakah data ditemukan
        $pangkat_golongan = DB::table($tbl_pangkat_golongan)->where('id_pangkat_golongan', '=', $id)->first();
        if (!$pangkat_golongan) {
            return 404; // NOT FOUND
        }

        $data = [
            "golongan" => $req->golongan,
            "keterangan" => $req->keterangan
        ];

        $cek_edit = DB::table($tbl_pangkat_golongan)->where('id_pangkat_golongan', '=', $id)->update($data);

        // Cek apakah proses delete berhasil
        if ($cek_edit) {
            return $cek_edit;
        } else {
            return 500;
        }
    }

    // Delete Pangkat Golongan
    public static function deletePangkatGolongan($id)
    {
        // Tabel - tabel
        $tbl_pangkat_golongan = "pangkat_golongan";

        // Cek apakah data ditemukan
        $pangkat_golongan = DB::table($tbl_pangkat_golongan)->where('id_pangkat_golongan', '=', $id)->first();
        if (!$pangkat_golongan) {
            return 404; // NOT FOUND
        }

        $cek_delete = DB::table($tbl_pangkat_golongan)->where('id_pangkat_golongan', '=', $id)->delete();

        // Cek apakah proses delete berhasil
        if ($cek_delete) {
            return $cek_delete;
        } else {
            return 500;
        }
    }
}
