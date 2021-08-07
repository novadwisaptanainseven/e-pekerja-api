<?php

namespace App\Models\Admin\Pegawai;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Pendidikan extends Model
{
    use HasFactory;

    protected $table = "pendidikan";
    protected $primaryKey = "id_pendidikan";

    // Get All Pendidikan
    public static function getAll($id_pegawai)
    {
        // Tabel - tabel
        $tbl_pendidikan = "pendidikan";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)->where("id_pegawai", "=", $id_pegawai)->first();
        if (!$data_pegawai) {
            return 404;
        }

        $data_pendidikan = DB::table($tbl_pendidikan)
            ->where('id_pegawai', '=', $id_pegawai)
            ->get();

        return $data_pendidikan;
    }

    // Get Pendidikan By Id
    public static function getById($id_pegawai, $id_pendidikan)
    {
        // Tabel - tabel
        $tbl_pendidikan = "pendidikan";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)->where("id_pegawai", "=", $id_pegawai)->first();
        if (!$data_pegawai) {
            return 404;
        }

        $data_pendidikan = DB::table($tbl_pendidikan)
            ->where([
                ["$tbl_pendidikan.id_pegawai", '=', $id_pegawai],
                ["$tbl_pendidikan.id_pendidikan", '=', $id_pendidikan],
            ])
            ->first();

        if ($data_pendidikan) {
            return $data_pendidikan;
        } else {
            return 405;
        }
    }

    // Insert Pendidikan
    public static function insert($req, $id_pegawai)
    {
        // Tabel - tabel
        $tbl_pendidikan = "pendidikan";

        // Cek apakah ada file foto ijazah
        if (!$req->file('foto_ijazah')) {
            $foto_ijazah = '';
        } else {
            $file = $req->file("foto_ijazah");

            // Sanitasi nama file
            $sanitize = sanitizeFile($file);
            $foto_ijazah = $file->storeAs("images/ijazah", rand(0, 9999) . time() . '-' . $sanitize);
        }

        $data = [
            'id_pegawai'   => $id_pegawai,
            "nama_akademi" => $req->nama_akademi,
            "jenjang"      => $req->jenjang,
            "jurusan"      => $req->jurusan,
            "tahun_lulus"  => $req->tahun_lulus,
            "no_ijazah"    => $req->no_ijazah,
            "foto_ijazah"  => $foto_ijazah,
        ];

        $insert = DB::table($tbl_pendidikan)->insert($data);

        return $insert;
    }

    // Edit Pendidikan
    public static function edit($req, $id_pegawai, $id_pendidikan)
    {
        // Tabel - tabel
        $tbl_pendidikan = "pendidikan";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $pegawai = DB::table($tbl_pegawai)->where('id_pegawai', '=', $id_pegawai)->first();
        if (!$pegawai) {
            return 404; // NOT FOUND
        }

        // Cek apakah data pendidikan ditemukan
        $pendidikan = DB::table($tbl_pendidikan)->where('id_pendidikan', '=', $id_pendidikan)->first();
        if (!$pendidikan) {
            return 405; // NOT FOUND
        }

        // Cek apakah ada file foto ijazah
        if (!$req->file('foto_ijazah')) {
            $foto_ijazah = $pendidikan->foto_ijazah;
        } else {
            // Hapus foto lama
            $path_foto = $pendidikan->foto_ijazah;
            Storage::delete($path_foto);

            $file = $req->file("foto_ijazah");

            // Sanitasi nama file
            $sanitize = sanitizeFile($file);
            $foto_ijazah = $file->storeAs("images/ijazah", rand(0, 9999) . time() . '-' . $sanitize);
        }

        $data = [
            "nama_akademi" => $req->nama_akademi ? $req->nama_akademi : $pendidikan->nama_akademi,
            "jenjang"      => $req->jenjang ? $req->jenjang : $pendidikan->jenjang,
            "jurusan"      => $req->jurusan ? $req->jurusan : $pendidikan->jurusan,
            "tahun_lulus"  => $req->tahun_lulus ? $req->tahun_lulus : $pendidikan->tahun_lulus,
            "no_ijazah"    => $req->no_ijazah ? $req->no_ijazah : $pendidikan->no_ijazah,
            "foto_ijazah"  => $foto_ijazah,
        ];

        DB::table($tbl_pendidikan)->where([
            ['id_pendidikan', '=', $id_pendidikan],
            ['id_pegawai', '=', $id_pegawai],
        ])->update($data);

        // Get data setelah diedit
        $edited_data = DB::table($tbl_pendidikan)
            ->where("$tbl_pendidikan.id_pendidikan", '=', $id_pendidikan)
            ->first();

        // Cek apakah proses delete berhasil
        return $edited_data;
    }

    // Delete Pendidikan
    public static function deletePendidikan($id_pegawai, $id_pendidikan)
    {
        // Tabel - tabel
        $tbl_pendidikan = "pendidikan";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $pegawai = DB::table($tbl_pegawai)->where('id_pegawai', '=', $id_pegawai)->first();
        if (!$pegawai) {
            return 404; // NOT FOUND
        }
        // Cek apakah data pendidikan ditemukan
        $pendidikan = DB::table($tbl_pendidikan)->where('id_pendidikan', '=', $id_pendidikan)->first();
        if (!$pendidikan) {
            return 405; // NOT FOUND
        }

        // Hapus file dokumentasi
        Storage::delete($pendidikan->foto_ijazah);

        DB::table($tbl_pendidikan)->where([
            ['id_pendidikan', '=', $id_pendidikan],
            ['id_pegawai', '=', $id_pegawai],
        ])->delete();

        return true;
    }

    // Get Jenjang Pendidikan
    public static function getJenjangPendidikan()
    {
        return DB::table("jenjang_pendidikan")->get();
    }
}
