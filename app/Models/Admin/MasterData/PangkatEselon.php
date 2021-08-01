<?php

namespace App\Models\Admin\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PangkatEselon extends Model
{
    use HasFactory;

    protected $table = "pangkat_eselon";
    protected $primaryKey = "id_pangkat_eselon";

    // Insert Pangkat Golongan
    public static function insert($req)
    {
        // Tabel - tabel
        $tbl_pangkat_eselon = "pangkat_eselon";

        $data = [
            "eselon"   => $req->eselon,
            "keterangan" => $req->keterangan
        ];

        $cek_insert = DB::table($tbl_pangkat_eselon)->insert($data);

        return $cek_insert;
    }

    // Edit Pangkat Eselon
    public static function edit($req, $id)
    {
        // Tabel - tabel
        $tbl_pangkat_eselon = "pangkat_eselon";

        // Cek apakah data ditemukan
        $pangkat_eselon = DB::table($tbl_pangkat_eselon)->where('id_pangkat_eselon', '=', $id)->first();
        if (!$pangkat_eselon) {
            return 404; // NOT FOUND
        }

        $data = [
            "eselon" => $req->eselon,
            "keterangan" => $req->keterangan
        ];

        $cek_edit = DB::table($tbl_pangkat_eselon)->where('id_pangkat_eselon', '=', $id)->update($data);

        // Cek apakah proses delete berhasil
        if ($cek_edit) {
            return $cek_edit;
        } else {
            return 500;
        }
    }

    // Delete Pangkat Eselon
    public static function deletePangkatEselon($id)
    {
        // Tabel - tabel
        $tbl_pangkat_eselon = "pangkat_eselon";

        // Cek apakah data ditemukan
        $pangkat_eselon = DB::table($tbl_pangkat_eselon)->where('id_pangkat_eselon', '=', $id)->first();
        if (!$pangkat_eselon) {
            return 404; // NOT FOUND
        }

        $cek_delete = DB::table($tbl_pangkat_eselon)->where('id_pangkat_eselon', '=', $id)->delete();

        // Cek apakah proses delete berhasil
        if ($cek_delete) {
            return $cek_delete;
        } else {
            return 500;
        }
    }
}
