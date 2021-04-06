<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DUK extends Model
{
    use HasFactory;

    protected $table = "duk_pegawai";
    protected $primaryKey = "id_duk";

    // Get All DUK
    public static function getAll()
    {
        // Tabel - tabel
        $tbl_duk = "duk_pegawai";
        $tbl_pegawai = "pegawai";
        $tbl_golongan = "pangkat_golongan";
        $tbl_eselon = "pangkat_eselon";
        $tbl_masa_kerja = "masa_kerja_pegawai";
        $tbl_pendidikan = "pendidikan";
        $tbl_jabatan = "jabatan";

        $data = DB::table($tbl_duk)
            ->select(
                "$tbl_duk.*",
                "$tbl_pegawai.nip",
                "$tbl_pegawai.nama",
                "$tbl_pegawai.tgl_lahir",
                "$tbl_pegawai.tmt_cpns",
                "$tbl_pegawai.tmt_golongan",
                "$tbl_golongan.golongan",
                "$tbl_golongan.keterangan AS ket_golongan",
                "$tbl_eselon.eselon",
                "$tbl_eselon.keterangan AS ket_eselon",
                "$tbl_jabatan.nama_jabatan",
                "$tbl_masa_kerja.mk_golongan",
                "$tbl_pendidikan.jurusan AS pendidikan",
            )
            ->leftJoin($tbl_pegawai, "$tbl_pegawai.id_pegawai", '=', "$tbl_duk.id_pegawai")
            ->leftJoin($tbl_golongan, "$tbl_golongan.id_pangkat_golongan", '=', "$tbl_pegawai.id_golongan")
            ->leftJoin($tbl_eselon, "$tbl_eselon.id_pangkat_eselon", '=', "$tbl_pegawai.id_eselon")
            ->leftJoin($tbl_jabatan, "$tbl_jabatan.id_jabatan", '=', "$tbl_pegawai.id_jabatan")
            ->leftJoin($tbl_masa_kerja, "$tbl_masa_kerja.id_pegawai", '=', "$tbl_pegawai.id_pegawai")
            ->leftJoin($tbl_pendidikan, "$tbl_pendidikan.id_pegawai", '=', "$tbl_pegawai.id_pegawai")
            ->orderBy("$tbl_pegawai.id_golongan", "asc")
            ->get();

        return $data;
    }

    // Get All DUK For Print
    public static function getAllForPrint()
    {
        // Tabel - tabel
        $tbl_duk = "duk_pegawai";
        $tbl_pegawai = "pegawai";
        $tbl_golongan = "pangkat_golongan";
        $tbl_eselon = "pangkat_eselon";
        $tbl_masa_kerja = "masa_kerja_pegawai";
        $tbl_pendidikan = "pendidikan";
        $tbl_jabatan = "jabatan";
        $tbl_diklat = "diklat";

        // Get data duk
        $data_duk = DB::table($tbl_duk)
            ->select(
                "$tbl_duk.*",
                "$tbl_pegawai.nip",
                "$tbl_pegawai.id_pegawai",
                "$tbl_pegawai.nama",
                "$tbl_pegawai.tgl_lahir",
                "$tbl_pegawai.tmt_cpns",
                "$tbl_pegawai.tmt_golongan",
                "$tbl_pegawai.tmt_jabatan",
                "$tbl_pegawai.foto",
                "$tbl_golongan.golongan",
                "$tbl_golongan.keterangan AS ket_golongan",
                "$tbl_eselon.eselon",
                "$tbl_eselon.keterangan AS ket_eselon",
                "$tbl_jabatan.nama_jabatan",
                "$tbl_masa_kerja.mk_golongan"
            )
            ->leftJoin($tbl_pegawai, "$tbl_pegawai.id_pegawai", '=', "$tbl_duk.id_pegawai")
            ->leftJoin($tbl_golongan, "$tbl_golongan.id_pangkat_golongan", '=', "$tbl_pegawai.id_golongan")
            ->leftJoin($tbl_eselon, "$tbl_eselon.id_pangkat_eselon", '=', "$tbl_pegawai.id_eselon")
            ->leftJoin($tbl_jabatan, "$tbl_jabatan.id_jabatan", '=', "$tbl_pegawai.id_jabatan")
            ->leftJoin($tbl_masa_kerja, "$tbl_masa_kerja.id_pegawai", '=', "$tbl_pegawai.id_pegawai")
            ->orderBy("$tbl_golongan.id_pangkat_golongan", "asc")
            ->get();

        foreach ($data_duk as $i => $d) {
            // Get data pendidikan
            $data_pendidikan = DB::table($tbl_pendidikan)
                ->where('id_pegawai', '=', $d->id_pegawai)
                ->orderBy("id_pendidikan", "asc")
                ->first();

            // Get data diklat
            $data_diklat = DB::table($tbl_diklat)
                ->where('id_pegawai', '=', $d->id_pegawai)
                ->get();

            $d->pendidikan = $data_pendidikan;

            if (count($data_diklat) == 0) {
                $d->diklat = [];
            }
            $d->diklat = $data_diklat;
            $d->no = $i + 1;
        }

        return $data_duk;
    }

    // Get Masa Kerja By Id
    public static function getById($id)
    {
        // Tabel - tabel
        $tbl_duk = "duk_pegawai";
        $tbl_pegawai = "pegawai";
        $tbl_golongan = "pangkat_golongan";
        $tbl_eselon = "pangkat_eselon";
        $tbl_masa_kerja = "masa_kerja_pegawai";
        $tbl_pendidikan = "pendidikan";
        $tbl_jabatan = "jabatan";
        $tbl_diklat = "diklat";

        // Get data duk
        $data_duk = DB::table($tbl_duk)
            ->select(
                "$tbl_duk.*",
                "$tbl_pegawai.nip",
                "$tbl_pegawai.nama",
                "$tbl_pegawai.tgl_lahir",
                "$tbl_pegawai.tmt_cpns",
                "$tbl_pegawai.tmt_golongan",
                "$tbl_pegawai.tmt_jabatan",
                "$tbl_pegawai.foto",
                "$tbl_golongan.golongan",
                "$tbl_golongan.keterangan AS ket_golongan",
                "$tbl_eselon.eselon",
                "$tbl_eselon.keterangan AS ket_eselon",
                "$tbl_jabatan.nama_jabatan",
                "$tbl_masa_kerja.mk_golongan",
            )
            ->where("$tbl_duk.id_duk", '=', $id)
            ->leftJoin($tbl_pegawai, "$tbl_pegawai.id_pegawai", '=', "$tbl_duk.id_pegawai")
            ->leftJoin($tbl_golongan, "$tbl_golongan.id_pangkat_golongan", '=', "$tbl_pegawai.id_golongan")
            ->leftJoin($tbl_eselon, "$tbl_eselon.id_pangkat_eselon", '=', "$tbl_pegawai.id_eselon")
            ->leftJoin($tbl_jabatan, "$tbl_jabatan.id_jabatan", '=', "$tbl_pegawai.id_jabatan")
            ->leftJoin($tbl_masa_kerja, "$tbl_masa_kerja.id_pegawai", '=', "$tbl_pegawai.id_pegawai")
            ->first();

        // Get data pendidikan
        $data_pendidikan = DB::table($tbl_pendidikan)
            ->where('id_pegawai', '=', $data_duk->id_pegawai)
            ->get();

        // Get data diklat
        $data_diklat = DB::table($tbl_diklat)
            ->where('id_pegawai', '=', $data_duk->id_pegawai)
            ->get();

        if ($data_duk) {

            $data_duk->pendidikan = $data_pendidikan;
            $data_duk->diklat = $data_diklat;

            return $data_duk;
        } else {
            return null;
        }
    }

    // Edit Masa kerja
    public static function edit($req, $id)
    {
        // Tabel - tabel
        $tbl_duk = "duk_pegawai";

        // Cek apakah data ditemukan
        $duk = DB::table($tbl_duk)->where('id_duk', '=', $id)->first();
        if (!$duk) {
            return 404; // NOT FOUND
        }

        $data = [
            "catatan_mutasi" => $req->catatan_mutasi
        ];

        $cek_edit = DB::table($tbl_duk)->where('id_duk', '=', $id)->update($data);

        // Get data setelah diedit
        $edited_data = DB::table($tbl_duk)
            ->where('id_duk', '=', $id)
            ->first();

        // Cek apakah proses delete berhasil
        if ($cek_edit) {
            return $edited_data;
        } else {
            return 500;
        }
    }
}
