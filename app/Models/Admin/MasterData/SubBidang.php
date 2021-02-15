<?php

namespace App\Models\Admin\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SubBidang extends Model
{
    use HasFactory;

    protected $table = "sub_bidang";
    protected $primaryKey = "id_sub_bidang";

    // Get All Sub Bidang
    public static function getAll()
    {
        // Tabel - tabel
        $tbl_sub_bidang = "sub_bidang";
        $tbl_bidang = "bidang";

        $data = DB::table($tbl_sub_bidang)
            ->select("$tbl_sub_bidang.*", "$tbl_bidang.nama_bidang AS bidang")
            ->leftJoin($tbl_bidang, "$tbl_bidang.id_bidang", "=", "$tbl_sub_bidang.id_bidang")
            ->get();

        return $data;
    }

    // Get Sub Bidang By Id
    public static function getById($id)
    {
        // Tabel - tabel
        $tbl_sub_bidang = "sub_bidang";
        $tbl_bidang = "bidang";

        $data = DB::table($tbl_sub_bidang)
            ->select("$tbl_sub_bidang.*", "$tbl_bidang.nama_bidang AS bidang")
            ->where('id_sub_bidang', '=', $id)
            ->leftJoin($tbl_bidang, "$tbl_bidang.id_bidang", "=", "$tbl_sub_bidang.id_bidang")
            ->first();

        if ($data) {
            return $data;
        } else {
            return null;
        }
    }

    // Insert Sub Bidang
    public static function insert($req)
    {
        // Tabel - tabel
        $tbl_sub_bidang = "sub_bidang";

        $data = [
            "id_bidang" => $req->id_bidang,
            "nama_sub_bidang"   => $req->nama_sub_bidang,
            "keterangan"   => $req->keterangan,
        ];

        $cek_insert = DB::table($tbl_sub_bidang)->insert($data);

        return $cek_insert;
    }

    // Edit Sub Bidang
    public static function edit($req, $id)
    {
        // Tabel - tabel
        $tbl_sub_bidang = "sub_bidang";
        $tbl_bidang = "bidang";

        // Cek apakah data ditemukan
        $sub_bidang = DB::table($tbl_sub_bidang)->where('id_sub_bidang', '=', $id)->first();
        if (!$sub_bidang) {
            return 404; // NOT FOUND
        }

        $data = [
            "id_bidang" => $req->id_bidang,
            "nama_sub_bidang" => $req->nama_sub_bidang,
            "keterangan" => $req->keterangan
        ];

        $cek_edit = DB::table($tbl_sub_bidang)->where('id_sub_bidang', '=', $id)->update($data);

        // Get data setelah diedit
        $edited_data = DB::table($tbl_sub_bidang)
            ->where('id_sub_bidang', '=', $id)
            ->leftJoin($tbl_bidang, "$tbl_bidang.id_bidang", "=", "$tbl_sub_bidang.id_bidang")
            ->first();

        // Cek apakah proses delete berhasil
        if ($cek_edit) {
            return $edited_data;
        } else {
            return 500;
        }
    }

    // Delete Sub Bidang
    public static function deleteSubBidang($id)
    {
        // Tabel - tabel
        $tbl_sub_bidang = "sub_bidang";

        // Cek apakah data ditemukan
        $sub_bidang = DB::table($tbl_sub_bidang)->where('id_sub_bidang', '=', $id)->first();
        if (!$sub_bidang) {
            return 404; // NOT FOUND
        }

        $cek_delete = DB::table($tbl_sub_bidang)->where('id_sub_bidang', '=', $id)->delete();

        // Cek apakah proses delete berhasil
        if ($cek_delete) {
            return $cek_delete;
        } else {
            return 500;
        }
    }
}
