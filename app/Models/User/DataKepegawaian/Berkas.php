<?php

namespace App\Models\User\DataKepegawaian;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class Berkas extends Model
{
    use HasApiTokens, HasFactory;

    protected $table = "berkas_pegawai";
    protected $primaryKey = "id_berkas";

    // Get All Berkas
    public static function getAll($id_pegawai)
    {
        // Tabel - tabel
        $tbl_berkas = "berkas_pegawai";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)->where("id_pegawai", "=", $id_pegawai)->first();
        if (!$data_pegawai) {
            return 404;
        }

        $data_penghargaan = DB::table($tbl_berkas)
            ->where('id_pegawai', '=', $id_pegawai)
            ->get();

        return $data_penghargaan;
    }

    // Insert Berkas
    public static function insert($req, $id_pegawai)
    {
        // Tabel - tabel
        $tbl_berkas = "berkas_pegawai";

        // Cek apakah ada file berkas
        if (!$req->file('nama_berkas')) {
            $berkas = '';
        } else {
            $file = $req->file("nama_berkas");

            // Sanitasi nama file
            $sanitize = sanitizeFile($file);
            $berkas = $file->storeAs("images/berkas", rand(0, 9999) . time() . '-' . $sanitize);
        }

        $data = [
            'id_pegawai'  => $id_pegawai,
            'nama_berkas' => $berkas,
            "keterangan"  => $req->keterangan,
        ];

        $insert = DB::table($tbl_berkas)->insert($data);

        return $insert;
    }

    // Delete Berkas
    public static function deleteBerkas($id_pegawai, $id_berkas)
    {
        // Tabel - tabel
        $tbl_berkas = "berkas_pegawai";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $pegawai = DB::table($tbl_pegawai)->where('id_pegawai', '=', $id_pegawai)->first();
        if (!$pegawai) {
            return 404; // NOT FOUND
        }
        // Cek apakah data berkas ditemukan
        $berkas = DB::table($tbl_berkas)
            ->where([
                ["id_pegawai", '=', $id_pegawai],
                ["id_berkas", '=', $id_berkas],
            ])
            ->first();
        if (!$berkas) {
            return 405; // NOT FOUND
        }

        // Hapus file nama berkas
        Storage::delete($berkas->nama_berkas);

        DB::table($tbl_berkas)->where([
            ['id_berkas', '=', $id_berkas],
            ['id_pegawai', '=', $id_pegawai],
        ])->delete();

        return true;
    }
}
