<?php

namespace App\Models\Admin\Pegawai;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RiwayatKerja extends Model
{
    use HasFactory;

    protected $table = "riwayat_kerja";
    protected $primaryKey = "id_riwayat_kerja";

    // Get All Riwayat Kerja
    public static function getAll($id_pegawai)
    {
        // Tabel - tabel
        $tbl_riwayat_kerja = "riwayat_kerja";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)->where("id_pegawai", "=", $id_pegawai)->first();
        if (!$data_pegawai) {
            return 404;
        }

        $data_riwayat_kerja = DB::table($tbl_riwayat_kerja)
            ->where('id_pegawai', '=', $id_pegawai)
            ->get();

        return $data_riwayat_kerja;
    }

    // Get Riwayat Kerja By Id
    public static function getById($id_pegawai, $id_riwayat_kerja)
    {
        // Tabel - tabel
        $tbl_riwayat_kerja = "riwayat_kerja";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)->where("id_pegawai", "=", $id_pegawai)->first();
        if (!$data_pegawai) {
            return 404;
        }

        $data_riwayat_kerja = DB::table($tbl_riwayat_kerja)
            ->where([
                ["id_pegawai", '=', $id_pegawai],
                ["id_riwayat_kerja", '=', $id_riwayat_kerja],
            ])
            ->first();

        if ($data_riwayat_kerja) {
            return $data_riwayat_kerja;
        } else {
            return 405;
        }
    }

    // Insert Riwayat Kerja
    public static function insert($req, $id_pegawai)
    {
        // Tabel - tabel
        $tbl_riwayat_kerja = "riwayat_kerja";

        $data = [
            'id_pegawai'   => $id_pegawai,
            'kantor'       => $req->kantor,
            "jabatan"      => $req->jabatan,
            "tgl_masuk"    => $req->tgl_masuk,
            "tgl_keluar"   => $req->tgl_keluar,
            "keterangan"   => $req->keterangan,
        ];

        $insert = DB::table($tbl_riwayat_kerja)->insert($data);

        return $insert;
    }

    // Edit Riwayat Kerja
    public static function edit($req, $id_pegawai, $id_riwayat_kerja)
    {
        // Tabel - tabel
        $tbl_riwayat_kerja = "riwayat_kerja";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $pegawai = DB::table($tbl_pegawai)->where('id_pegawai', '=', $id_pegawai)->first();
        if (!$pegawai) {
            return 404; // NOT FOUND
        }

        // Cek apakah data riwayat_kerja ditemukan
        $riwayat_kerja = DB::table($tbl_riwayat_kerja)
            ->where([
                ["id_pegawai", '=', $id_pegawai],
                ["id_riwayat_kerja", '=', $id_riwayat_kerja],
            ])
            ->first();
        if (!$riwayat_kerja) {
            return 405; // NOT FOUND
        }

        $data = [
            "kantor"     => $req->kantor ? $req->kantor : $riwayat_kerja->kantor,
            "jabatan"    => $req->jabatan ? $req->jabatan : $riwayat_kerja->jabatan,
            "tgl_masuk"  => $req->tgl_masuk ? $req->tgl_masuk : $riwayat_kerja->penyelenggara,
            "tgl_keluar" => $req->tgl_keluar ? $req->tgl_keluar : $riwayat_kerja->tgl_keluar,
            "keterangan" => $req->keterangan ? $req->keterangan : $riwayat_kerja->keterangan,
        ];

        DB::table($tbl_riwayat_kerja)->where([
            ['id_riwayat_kerja', '=', $id_riwayat_kerja],
            ['id_pegawai', '=', $id_pegawai],
        ])->update($data);

        // Get data setelah diedit
        $edited_data = DB::table($tbl_riwayat_kerja)
            ->where("id_riwayat_kerja", '=', $id_riwayat_kerja)
            ->first();

        return $edited_data;
    }

    // Delete Riwayat Kerja
    public static function deleteRiwayatKerja($id_pegawai, $id_riwayat_kerja)
    {
        // Tabel - tabel
        $tbl_riwayat_kerja = "riwayat_kerja";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $pegawai = DB::table($tbl_pegawai)->where('id_pegawai', '=', $id_pegawai)->first();
        if (!$pegawai) {
            return 404; // NOT FOUND
        }
        // Cek apakah data riwayat kerja ditemukan
        $riwayat_kerja = DB::table($tbl_riwayat_kerja)
            ->where([
                ["id_pegawai", '=', $id_pegawai],
                ["id_riwayat_kerja", '=', $id_riwayat_kerja],
            ])
            ->first();
        if (!$riwayat_kerja) {
            return 405; // NOT FOUND
        }

        DB::table($tbl_riwayat_kerja)->where([
            ['id_riwayat_kerja', '=', $id_riwayat_kerja],
            ['id_pegawai', '=', $id_pegawai],
        ])->delete();

        return true;
    }
}
