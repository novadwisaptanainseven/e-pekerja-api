<?php

namespace App\Models\Admin;

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
    public static function getAll()
    {
        // Tabel - tabel
        $tbl_penghargaan = "penghargaan";
        $tbl_pegawai = "pegawai";

        $data_penghargaan = DB::table($tbl_penghargaan)
            ->select(
                "$tbl_penghargaan.*",
                "$tbl_pegawai.nip",
                "$tbl_pegawai.nama",
            )
            ->leftJoin($tbl_pegawai, "$tbl_pegawai.id_pegawai", "=", "$tbl_penghargaan.id_pegawai")
            ->orderBy("$tbl_penghargaan.id_penghargaan", "desc")
            ->get();

        return $data_penghargaan;
    }

    // Get Penghargaan By Id
    public static function getById($id_penghargaan)
    {
        // Tabel - tabel
        $tbl_penghargaan = "penghargaan";
        $tbl_pegawai = "pegawai";

        $data_penghargaan = DB::table($tbl_penghargaan)
            ->select(
                "$tbl_penghargaan.*",
                "$tbl_pegawai.nip",
                "$tbl_pegawai.nama",
            )
            ->where("id_penghargaan", '=', $id_penghargaan)
            ->leftJoin($tbl_pegawai, "$tbl_pegawai.id_pegawai", "=", "$tbl_penghargaan.id_pegawai")
            ->first();

        if ($data_penghargaan) {
            return $data_penghargaan;
        } else {
            return 404;
        }
    }

    // Insert Penghargaan
    public static function insert($req)
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
            'id_pegawai'       => $req->id_pegawai ? $req->id_pegawai : null,
            'nama_penerima'    => $req->nama_penerima,
            'nama_penghargaan' => $req->nama_penghargaan,
            "pemberi"          => $req->pemberi,
            "tgl_penghargaan"  => $req->tgl_penghargaan,
            "dokumentasi"      => $dokumentasi,
        ];

        $insert = DB::table($tbl_penghargaan)->insert($data);

        return $insert;
    }

    // Edit Penghargaan
    public static function edit($req, $id_penghargaan)
    {
        // Tabel - tabel
        $tbl_penghargaan = "penghargaan";

        // Cek apakah data penghargaan ditemukan
        $penghargaan = DB::table($tbl_penghargaan)
            ->where("id_penghargaan", '=', $id_penghargaan)
            ->first();

        if (!$penghargaan) {
            return 404; // NOT FOUND
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
            "id_pegawai"   => $req->id_pegawai ? $req->id_pegawai : $penghargaan->id_pegawai,
            "nama_penghargaan"   => $req->nama_penghargaan ? $req->nama_penghargaan : $penghargaan->nama_penghargaan,
            "pemberi"  => $req->pemberi ? $req->pemberi : $penghargaan->pemberi,
            "tgl_penghargaan" => $req->tgl_penghargaan ? $req->tgl_penghargaan : $penghargaan->tgl_penghargaan,
            "dokumentasi"  => $dokumentasi,
        ];

        DB::table($tbl_penghargaan)
            ->where("id_penghargaan", '=', $id_penghargaan)
            ->update($data);

        // Get data setelah diedit
        $edited_data = DB::table($tbl_penghargaan)
            ->where("id_penghargaan", '=', $id_penghargaan)
            ->first();

        return $edited_data;
    }

    // Delete Penghargaan
    public static function deletePenghargaan($id_penghargaan)
    {
        // Tabel - tabel
        $tbl_penghargaan = "penghargaan";

        // Cek apakah data penghargaan ditemukan
        $penghargaan = DB::table($tbl_penghargaan)
            ->where("id_penghargaan", '=', $id_penghargaan)
            ->first();
        if (!$penghargaan) {
            return 404; // NOT FOUND
        }

        // Hapus file dokumentasi
        Storage::delete($penghargaan->dokumentasi);

        DB::table($tbl_penghargaan)
            ->where("id_penghargaan", '=', $id_penghargaan)
            ->delete();

        return 201;
    }
}
