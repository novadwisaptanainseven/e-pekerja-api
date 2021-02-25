<?php

namespace App\Models\Admin;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pensiun extends Model
{
    use HasFactory;
    protected $table = "pensiun";
    protected $primaryKey = "id_pensiun";

    // Get All Pensiun
    public static function getAll()
    {
        // Tabel - tabel
        $tbl_pensiun = "pensiun";
        $tbl_pegawai = "pegawai";

        $data_pensiun = DB::table($tbl_pensiun)
            ->select(
                "$tbl_pensiun.*",
                "$tbl_pegawai.nip",
                "$tbl_pegawai.nama",
            )
            ->leftJoin($tbl_pegawai, "$tbl_pegawai.id_pegawai", "=", "$tbl_pensiun.id_pegawai")
            ->orderBy("$tbl_pensiun.id_pensiun", "desc")
            ->get();

        return $data_pensiun;
    }

    // Get Pensiun By Id
    public static function getById($id_pensiun)
    {
        // Tabel - tabel
        $tbl_pensiun = "pensiun";
        $tbl_pegawai = "pegawai";

        $data_pensiun = DB::table($tbl_pensiun)
            ->select(
                "$tbl_pensiun.*",
                "$tbl_pegawai.nip",
                "$tbl_pegawai.nama",
            )
            ->where("id_pensiun", '=', $id_pensiun)
            ->leftJoin($tbl_pegawai, "$tbl_pegawai.id_pegawai", "=", "$tbl_pensiun.id_pegawai")
            ->first();

        if ($data_pensiun) {
            return $data_pensiun;
        } else {
            return 404;
        }
    }

    // Insert Pensiun
    public static function insert($req)
    {
        // Tabel - tabel
        $tbl_pensiun = "pensiun";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)
            ->where("id_pegawai", "=", $req->id_pegawai)
            ->first();
        if (!$data_pegawai) {
            return 404;
        }

        $data = [
            'id_pegawai'  => $req->id_pegawai,
            'tgl_pensiun' => $req->tgl_pensiun,
            'keterangan'  => $req->keterangan,
        ];

        DB::table($tbl_pensiun)->insert($data);

        return 201;
    }

    // Edit Pensiun
    public static function edit($req, $id_pensiun)
    {
        // Tabel - tabel
        $tbl_pensiun = "pensiun";

        // Cek apakah data pensiun ditemukan
        $pensiun = DB::table($tbl_pensiun)
            ->where("id_pensiun", '=', $id_pensiun)
            ->first();
        if (!$pensiun) {
            return 404; // NOT FOUND
        }

        // Get current date
        $current_date = new DateTime('now');

        $data = [
            "tgl_pensiun"    => $req->tgl_pensiun ? $req->tgl_pensiun : $pensiun->tgl_pensiun,
            "keterangan"     => $req->keterangan ? $req->keterangan : $pensiun->keterangan,
            "status_pensiun" => $req->status_pensiun ? $req->status_pensiun : $pensiun->status_pensiun,
            "updated_at"     => $current_date
        ];

        DB::table($tbl_pensiun)
            ->where("id_pensiun", '=', $id_pensiun)
            ->update($data);

        // Get data setelah diedit
        $edited_data = DB::table($tbl_pensiun)
            ->where("id_pensiun", '=', $id_pensiun)
            ->first();

        return $edited_data;
    }

    // Delete Pensiun
    public static function deletePensiun($id_pensiun)
    {
        // Tabel - tabel
        $tbl_pensiun = "pensiun";

        // Cek apakah data pensiun ditemukan
        $pensiun = DB::table($tbl_pensiun)
            ->where("id_pensiun", '=', $id_pensiun)
            ->first();
        if (!$pensiun) {
            return 404; // NOT FOUND
        }

        DB::table($tbl_pensiun)
            ->where("id_pensiun", '=', $id_pensiun)
            ->delete();

        return 201;
    }
}
