<?php

namespace App\Models\Admin\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = "jabatan";
    protected $primaryKey = "id_jabatan";

    // Insert Jabatan
    public static function insert($req)
    {
        // Tabel - tabel
        $tbl_jabatan = "jabatan";

        $data = [
            "nama_jabatan"   => $req->nama_jabatan
        ];

        $cek_insert = DB::table($tbl_jabatan)->insert($data);

        return $cek_insert;
    }

    // Edit Jabatan
    public static function edit($req, $id)
    {
        // Tabel - tabel
        $tbl_jabatan = "jabatan";

        // Cek apakah data ditemukan
        $jabatan = DB::table($tbl_jabatan)->where('id_jabatan', '=', $id)->first();
        if (!$jabatan) {
            return 404; // NOT FOUND
        }

        $data = [
            "nama_jabatan" => $req->nama_jabatan
        ];

        $cek_edit = DB::table($tbl_jabatan)->where('id_jabatan', '=', $id)->update($data);

        // Cek apakah proses delete berhasil
        if ($cek_edit) {
            return $cek_edit;
        } else {
            return 500;
        }
    }

    // Delete Jabatan
    public static function deleteJabatan($id)
    {
        // Tabel - tabel
        $tbl_jabatan = "jabatan";

        // Cek apakah data ditemukan
        $jabatan = DB::table($tbl_jabatan)->where('id_jabatan', '=', $id)->first();
        if (!$jabatan) {
            return 404; // NOT FOUND
        }

        $cek_delete = DB::table($tbl_jabatan)->where('id_jabatan', '=', $id)->delete();

        // Cek apakah proses delete berhasil
        if ($cek_delete) {
            return $cek_delete;
        } else {
            return 500;
        }
    }
}
