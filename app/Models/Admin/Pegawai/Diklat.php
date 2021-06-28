<?php

namespace App\Models\Admin\Pegawai;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Diklat extends Model
{
    use HasFactory;

    protected $table = "diklat";
    protected $primaryKey = "id_diklat";

    // Get All Diklat
    public static function getAll($id_pegawai)
    {
        // Tabel - tabel
        $tbl_diklat = "diklat";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)->where("id_pegawai", "=", $id_pegawai)->first();
        if (!$data_pegawai) {
            return 404;
        }

        $data_diklat = DB::table($tbl_diklat)
            ->where('id_pegawai', '=', $id_pegawai)
            ->get();

        return $data_diklat;
    }

    // Get Diklat By Id
    public static function getById($id_pegawai, $id_diklat)
    {
        // Tabel - tabel
        $tbl_diklat = "diklat";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)->where("id_pegawai", "=", $id_pegawai)->first();
        if (!$data_pegawai) {
            return 404;
        }

        $data_diklat = DB::table($tbl_diklat)
            ->where([
                ["$tbl_diklat.id_pegawai", '=', $id_pegawai],
                ["$tbl_diklat.id_diklat", '=', $id_diklat],
            ])
            ->first();

        if ($data_diklat) {
            return $data_diklat;
        } else {
            return 405;
        }
    }

    // Insert Diklat
    public static function insert($req, $id_pegawai)
    {
        // Tabel - tabel
        $tbl_diklat = "diklat";

        // Cek apakah ada file dokumentasi
        if (!$req->file('dokumentasi')) {
            $dokumentasi = '';
        } else {
            $file = $req->file("dokumentasi");

            // Sanitasi nama file
            $sanitize = sanitizeFile($file);
            $dokumentasi = $file->storeAs("images/dok_diklat", rand(0, 9999) . time() . '-' . $sanitize);
        }

        // Cek apakah ada file sertifikat
        if (!$req->file('sertifikat')) {
            $sertifikat = '';
        } else {
            $file = $req->file("sertifikat");

            // Sanitasi nama file
            $sanitize = sanitizeFile($file);
            $sertifikat = $file->storeAs("images/dok_diklat", rand(0, 9999) . time() . '-' . $sanitize);
        }

        $data = [
            'id_pegawai'    => $id_pegawai,
            'nama_diklat'   => $req->nama_diklat,
            "jenis_diklat"  => $req->jenis_diklat,
            "penyelenggara" => $req->penyelenggara,
            "tahun_diklat"  => $req->tahun_diklat,
            "jumlah_jam"    => $req->jumlah_jam,
            "dokumentasi"   => $dokumentasi,
            "sertifikat"    => $sertifikat,
        ];

        $insert = DB::table($tbl_diklat)->insert($data);

        return $insert;
    }

    // Edit Diklat
    public static function edit($req, $id_pegawai, $id_diklat)
    {
        // Tabel - tabel
        $tbl_diklat = "diklat";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $pegawai = DB::table($tbl_pegawai)->where('id_pegawai', '=', $id_pegawai)->first();
        if (!$pegawai) {
            return 404; // NOT FOUND
        }

        // Cek apakah data diklat ditemukan
        $diklat = DB::table($tbl_diklat)
            ->where([
                ["id_pegawai", '=', $id_pegawai],
                ["id_diklat", '=', $id_diklat],
            ])
            ->first();

        if (!$diklat) {
            return 405; // NOT FOUND
        }

        // Cek apakah ada file dokumentasi
        if (!$req->file('dokumentasi')) {
            $dokumentasi = $diklat->dokumentasi;
        } else {
            // Hapus foto lama
            $path_foto = $diklat->dokumentasi;
            Storage::delete($path_foto);

            $file = $req->file("dokumentasi");

            // Sanitasi nama file
            $sanitize = sanitizeFile($file);
            $dokumentasi = $file->storeAs("images/dok_diklat", rand(0, 9999) . time() . '-' . $sanitize);
        }

        // Cek apakah ada file sertifikat
        if (!$req->file('sertifikat')) {
            $sertifikat = $diklat->sertifikat;
        } else {
            // Hapus foto lama
            $path_foto = $diklat->sertifikat;
            Storage::delete($path_foto);

            $file = $req->file("sertifikat");

            // Sanitasi nama file
            $sanitize = sanitizeFile($file);
            $sertifikat = $file->storeAs("images/dok_diklat", rand(0, 9999) . time() . '-' . $sanitize);
        }

        $data = [
            "nama_diklat"   => $req->nama_diklat ? $req->nama_diklat : $diklat->nama_diklat,
            "jenis_diklat"  => $req->jenis_diklat ? $req->jenis_diklat : $diklat->jenis_diklat,
            "penyelenggara" => $req->penyelenggara ? $req->penyelenggara : $diklat->penyelenggara,
            "tahun_diklat"  => $req->tahun_diklat ? $req->tahun_diklat : $diklat->tahun_diklat,
            "jumlah_jam"    => $req->jumlah_jam ? $req->jumlah_jam : $diklat->jumlah_jam,
            "dokumentasi"   => $dokumentasi,
            "sertifikat"    => $sertifikat,
        ];

        DB::table($tbl_diklat)->where([
            ['id_diklat', '=', $id_diklat],
            ['id_pegawai', '=', $id_pegawai],
        ])->update($data);

        // Get data setelah diedit
        $edited_data = DB::table($tbl_diklat)
            ->where("id_diklat", '=', $id_diklat)
            ->first();

        return $edited_data;
    }

    // Delete Diklat
    public static function deleteDiklat($id_pegawai, $id_diklat)
    {
        // Tabel - tabel
        $tbl_diklat = "diklat";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $pegawai = DB::table($tbl_pegawai)->where('id_pegawai', '=', $id_pegawai)->first();
        if (!$pegawai) {
            return 404; // NOT FOUND
        }
        // Cek apakah data diklat ditemukan
        $diklat = DB::table($tbl_diklat)
            ->where([
                ["id_pegawai", '=', $id_pegawai],
                ["id_diklat", '=', $id_diklat],
            ])
            ->first();
        if (!$diklat) {
            return 405; // NOT FOUND
        }

        // Hapus file dokumentasi
        Storage::delete($diklat->dokumentasi);

        DB::table($tbl_diklat)->where([
            ['id_diklat', '=', $id_diklat],
            ['id_pegawai', '=', $id_pegawai],
        ])->delete();

        return true;
    }
}
