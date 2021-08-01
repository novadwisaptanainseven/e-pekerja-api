<?php

namespace App\Models\Admin\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Agama extends Model
{
    use HasFactory;

    protected $table = "agama";
    protected $primaryKey = "id_agama";

    // Insert Agama
    public static function insert($req)
    {
        // Tabel - tabel
        $tbl_agama = "agama";

        $data = [
            "agama" => $req->agama
        ];

        $cek_insert = DB::table($tbl_agama)->insert($data);

        return $cek_insert;
    }

    // Edit Agama
    public static function edit($req, $id)
    {
        // Tabel - tabel
        $tbl_agama = "agama";

        // Cek apakah data ditemukan
        $agama = DB::table($tbl_agama)->where('id_agama', '=', $id)->first();
        if (!$agama) {
            return 404; // NOT FOUND
        }

        $data = [
            "agama" => $req->agama
        ];

        $cek_edit = DB::table($tbl_agama)->where('id_agama', '=', $id)->update($data);

        // Cek apakah proses delete berhasil
        if ($cek_edit) {
            return $cek_edit;
        } else {
            return 500;
        }
    }

    // Delete Agama
    public static function deleteAgama($id)
    {
        // Tabel - tabel
        $tbl_agama = "agama";

        // Cek apakah data ditemukan
        $agama = DB::table($tbl_agama)->where('id_agama', '=', $id)->first();
        if (!$agama) {
            return 404; // NOT FOUND
        }

        $cek_delete = DB::table($tbl_agama)->where('id_agama', '=', $id)->delete();

        // Cek apakah proses delete berhasil
        if ($cek_delete) {
            return $cek_delete;
        } else {
            return 500;
        }
    }
}
