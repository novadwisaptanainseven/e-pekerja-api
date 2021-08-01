<?php

namespace App\Models\Admin\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bidang extends Model
{
    use HasFactory;

    protected $table = "bidang";
    protected $primaryKey = "id_bidang";

    // Insert Bidang
    public static function insert($req)
    {
        // Tabel - tabel
        $tbl_bidang = "bidang";

        $data = [
            "nama_bidang"   => $req->nama_bidang,
            "keterangan"   => $req->keterangan,
        ];

        $cek_insert = DB::table($tbl_bidang)->insert($data);

        return $cek_insert;
    }

    // Edit Bidang
    public static function edit($req, $id)
    {
        // Tabel - tabel
        $tbl_bidang = "bidang";

        // Cek apakah data ditemukan
        $bidang = DB::table($tbl_bidang)->where('id_bidang', '=', $id)->first();
        if (!$bidang) {
            return 404; // NOT FOUND
        }

        $data = [
            "nama_bidang" => $req->nama_bidang,
            "keterangan" => $req->keterangan
        ];

        $cek_edit = DB::table($tbl_bidang)->where('id_bidang', '=', $id)->update($data);

        // Cek apakah proses delete berhasil
        if ($cek_edit) {
            return $cek_edit;
        } else {
            return 500;
        }
    }

    // Delete Bidang
    public static function deleteBidang($id)
    {
        // Tabel - tabel
        $tbl_bidang = "bidang";

        // Cek apakah data ditemukan
        $bidang = DB::table($tbl_bidang)->where('id_bidang', '=', $id)->first();
        if (!$bidang) {
            return 404; // NOT FOUND
        }

        $cek_delete = DB::table($tbl_bidang)->where('id_bidang', '=', $id)->delete();

        // Cek apakah proses delete berhasil
        if ($cek_delete) {
            return $cek_delete;
        } else {
            return 500;
        }
    }
}
