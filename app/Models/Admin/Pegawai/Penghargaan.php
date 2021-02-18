<?php

namespace App\Models\Admin\Pegawai;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Penghargaan extends Model
{
    use HasFactory;

    protected $table = "penghargaan";
    protected $primaryKey = "id_penghargaan";

    // Get All Penghargaan
    public static function getAll($id_pegawai)
    {
        // Tabel - tabel
        $tbl_penghargaan = "penghargaan";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)->where("id_pegawai", "=", $id_pegawai)->first();
        if (!$data_pegawai) {
            return 404;
        }

        $data_penghargaan = DB::table($tbl_penghargaan)
            ->where('id_pegawai', '=', $id_pegawai)
            ->get();

        return $data_penghargaan;
    }

    // Get Penghargaan By Id
    public static function getById($id_pegawai, $id_penghargaan)
    {
        // Tabel - tabel
        $tbl_penghargaan = "penghargaan";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)->where("id_pegawai", "=", $id_pegawai)->first();
        if (!$data_pegawai) {
            return 404;
        }

        $data_penghargaan = DB::table($tbl_penghargaan)
            ->where([
                ["id_pegawai", '=', $id_pegawai],
                ["id_penghargaan", '=', $id_penghargaan],
            ])
            ->first();

        if ($data_penghargaan) {
            return $data_penghargaan;
        } else {
            return 405;
        }
    }

    // Insert Penghargaan
    public static function insert($req, $id_pegawai)
    {
        // Tabel - tabel
        $tbl_penghargaan = "penghargaan";

        // Cek apakah ada file dokumentasi
        if (!$req->file('dokumentasi')) {
            $dokumentasi = '';
        } else {
            $file = $req->file("dokumentasi");

            // Sanitasi nama file
            $sanitize = sanitizeFile($file);
            $dokumentasi = $file->storeAs("images/dok_penghargaan", rand(0, 9999) . time() . '-' . $sanitize);
        }

        $data = [
            'id_pegawai'       => $id_pegawai,
            'nama_penghargaan' => $req->nama_penghargaan,
            "pemberi"          => $req->pemberi,
            "tgl_penghargaan"  => $req->tgl_penghargaan,
            "dokumentasi"      => $dokumentasi,
        ];

        $insert = DB::table($tbl_penghargaan)->insert($data);

        return $insert;
    }

    // Edit Penghargaan
    public static function edit($req, $id_pegawai, $id_penghargaan)
    {
        // Tabel - tabel
        $tbl_penghargaan = "penghargaan";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $pegawai = DB::table($tbl_pegawai)->where('id_pegawai', '=', $id_pegawai)->first();
        if (!$pegawai) {
            return 404; // NOT FOUND
        }

        // Cek apakah data penghargaan ditemukan
        $penghargaan = DB::table($tbl_penghargaan)
            ->where([
                ["id_pegawai", '=', $id_pegawai],
                ["id_penghargaan", '=', $id_penghargaan],
            ])
            ->first();

        if (!$penghargaan) {
            return 405; // NOT FOUND
        }

        // Cek apakah ada file dokumentasi
        if (!$req->file('dokumentasi')) {
            $dokumentasi = $penghargaan->dokumentasi;
        } else {
            // Hapus file dokumentasi lama
            $path_foto = $penghargaan->dokumentasi;
            Storage::delete($path_foto);

            $file = $req->file("dokumentasi");

            // Sanitasi nama file
            $sanitize = sanitizeFile($file);
            $dokumentasi = $file->storeAs("images/dok_penghargaan", rand(0, 9999) . time() . '-' . $sanitize);
        }

        $data = [
            "nama_penghargaan"   => $req->nama_penghargaan ? $req->nama_penghargaan : $penghargaan->nama_penghargaan,
            "pemberi"  => $req->pemberi ? $req->pemberi : $penghargaan->pemberi,
            "tgl_penghargaan" => $req->tgl_penghargaan ? $req->tgl_penghargaan : $penghargaan->tgl_penghargaan,
            "dokumentasi"  => $dokumentasi,
        ];

        DB::table($tbl_penghargaan)->where([
            ['id_penghargaan', '=', $id_penghargaan],
            ['id_pegawai', '=', $id_pegawai],
        ])->update($data);

        // Get data setelah diedit
        $edited_data = DB::table($tbl_penghargaan)
            ->where("id_penghargaan", '=', $id_penghargaan)
            ->first();

        return $edited_data;
    }

    // Delete Penghargaan
    public static function deletePenghargaan($id_pegawai, $id_penghargaan)
    {
        // Tabel - tabel
        $tbl_penghargaan = "penghargaan";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $pegawai = DB::table($tbl_pegawai)->where('id_pegawai', '=', $id_pegawai)->first();
        if (!$pegawai) {
            return 404; // NOT FOUND
        }
        // Cek apakah data penghargaan ditemukan
        $penghargaan = DB::table($tbl_penghargaan)
            ->where([
                ["id_pegawai", '=', $id_pegawai],
                ["id_penghargaan", '=', $id_penghargaan],
            ])
            ->first();
        if (!$penghargaan) {
            return 405; // NOT FOUND
        }

        // Hapus file dokumentasi
        Storage::delete($penghargaan->dokumentasi);

        DB::table($tbl_penghargaan)->where([
            ['id_penghargaan', '=', $id_penghargaan],
            ['id_pegawai', '=', $id_pegawai],
        ])->delete();

        return true;
    }
}
