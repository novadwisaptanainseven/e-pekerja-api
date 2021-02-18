<?php

namespace App\Models\Admin\Pegawai;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Keluarga extends Model
{
    use HasFactory;

    protected $table = "keluarga";
    protected $primaryKey = "id_keluarga";

    // Get All Keluarga
    public static function getAll($id_pegawai)
    {
        // Tabel - tabel
        $tbl_keluarga = "keluarga";
        $tbl_agama = "agama";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)->where("id_pegawai", "=", $id_pegawai)->first();
        if (!$data_pegawai) {
            return 404;
        }

        $data_keluarga = DB::table($tbl_keluarga)
            ->where('id_pegawai', '=', $id_pegawai)
            ->leftJoin($tbl_agama, "$tbl_agama.id_agama", "=", "$tbl_keluarga.id_agama")
            ->get();

        return $data_keluarga;
    }

    // Get Keluarga By Id
    public static function getById($id_pegawai, $id_keluarga)
    {
        // Tabel - tabel
        $tbl_keluarga = "keluarga";
        $tbl_agama = "agama";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)->where("id_pegawai", "=", $id_pegawai)->first();
        if (!$data_pegawai) {
            return 404;
        }

        $data_keluarga = DB::table($tbl_keluarga)
            ->where([
                ["$tbl_keluarga.id_pegawai", '=', $id_pegawai],
                ["$tbl_keluarga.id_keluarga", '=', $id_keluarga],
            ])
            ->leftJoin($tbl_agama, "$tbl_agama.id_agama", "=", "$tbl_keluarga.id_agama")
            ->first();

        if ($data_keluarga) {
            return $data_keluarga;
        } else {
            return 405;
        }
    }

    // Insert Keluarga
    public static function insert($req, $id_pegawai)
    {
        // Tabel - tabel
        $tbl_keluarga = "keluarga";

        $data = [
            "id_pegawai"    => $id_pegawai,
            "nik_nip"       => $req->nik_nip,
            "nama"          => $req->nama,
            "hubungan"      => $req->hubungan,
            "id_agama"      => $req->id_agama,
            "jenis_kelamin" => $req->jenis_kelamin,
            "tempat_lahir"  => $req->tempat_lahir,
            "tgl_lahir"     => $req->tgl_lahir,
            "pekerjaan"     => $req->pekerjaan,
            "telepon"       => $req->telepon,
            "alamat"        => $req->alamat,
        ];

        $insert = DB::table($tbl_keluarga)->insert($data);

        return $insert;
    }

    // Edit Keluarga
    public static function edit($req, $id_pegawai, $id_keluarga)
    {
        // Tabel - tabel
        $tbl_keluarga = "keluarga";
        $tbl_pegawai = "pegawai";
        $tbl_agama = "agama";

        // Cek apakah data pegawai ditemukan ditemukan
        $pegawai = DB::table($tbl_pegawai)->where('id_pegawai', '=', $id_pegawai)->first();
        if (!$pegawai) {
            return 404; // NOT FOUND
        }

        // Cek apakah data keluarga ditemukan ditemukan
        $keluarga = DB::table($tbl_keluarga)->where('id_keluarga', '=', $id_keluarga)->first();
        if (!$keluarga) {
            return 405; // NOT FOUND
        }

        $data = [
            "id_pegawai"    => $id_pegawai,
            "nik_nip"       => $req->nik_nip,
            "nama"          => $req->nama,
            "hubungan"      => $req->hubungan,
            "id_agama"      => $req->id_agama,
            "jenis_kelamin" => $req->jenis_kelamin,
            "tempat_lahir"  => $req->tempat_lahir,
            "tgl_lahir"     => $req->tgl_lahir,
            "pekerjaan"     => $req->pekerjaan,
            "telepon"       => $req->telepon,
            "alamat"        => $req->alamat,
        ];

        DB::table($tbl_keluarga)->where([
            ['id_keluarga', '=', $id_keluarga],
            ['id_pegawai', '=', $id_pegawai],
        ])->update($data);

        // Get data setelah diedit
        $edited_data = DB::table($tbl_keluarga)
            ->where("$tbl_keluarga.id_keluarga", '=', $id_keluarga)
            ->leftJoin($tbl_agama, "$tbl_agama.id_agama", "=", "$tbl_keluarga.id_agama")
            ->first();

        // Cek apakah proses delete berhasil
        return $edited_data;
    }

    // Delete Keluarga
    public static function deleteKeluarga($id_pegawai, $id_keluarga)
    {
        // Tabel - tabel
        $tbl_keluarga = "keluarga";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $pegawai = DB::table($tbl_pegawai)->where('id_pegawai', '=', $id_pegawai)->first();
        if (!$pegawai) {
            return 404; // NOT FOUND
        }
        // Cek apakah data keluarga ditemukan
        $keluarga = DB::table($tbl_keluarga)->where('id_keluarga', '=', $id_keluarga)->first();
        if (!$keluarga) {
            return 405; // NOT FOUND
        }

        DB::table($tbl_keluarga)->where([
            ['id_keluarga', '=', $id_keluarga],
            ['id_pegawai', '=', $id_pegawai],
        ])->delete();

        return true;
    }
}
