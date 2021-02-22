<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MasaKerja extends Model
{
    use HasFactory;

    protected $table = "masa_kerja_pegawai";
    protected $primaryKey = "id_masa_kerja";

    // Get All Masa Kerja
    public static function getAll()
    {
        // Tabel - tabel
        $tbl_masa_kerja = "masa_kerja_pegawai";
        $tbl_pegawai = "pegawai";
        $tbl_golongan = "pangkat_golongan";
        $tbl_eselon = "pangkat_eselon";
        $tbl_jabatan = "jabatan";

        $data = DB::table($tbl_masa_kerja)
            ->select(
                "$tbl_masa_kerja.*",
                "$tbl_pegawai.nip",
                "$tbl_pegawai.nama",
                "$tbl_pegawai.tmt_cpns",
                "$tbl_pegawai.tmt_golongan",
                "$tbl_golongan.golongan",
                "$tbl_golongan.keterangan AS ket_golongan",
                "$tbl_eselon.eselon",
                "$tbl_eselon.keterangan AS ket_eselon",
                "$tbl_jabatan.nama_jabatan",
                "$tbl_masa_kerja.mk_golongan",
            )
            ->leftJoin($tbl_pegawai, "$tbl_pegawai.id_pegawai", '=', "$tbl_masa_kerja.id_pegawai")
            ->leftJoin($tbl_golongan, "$tbl_golongan.id_pangkat_golongan", '=', "$tbl_pegawai.id_golongan")
            ->leftJoin($tbl_eselon, "$tbl_eselon.id_pangkat_eselon", '=', "$tbl_pegawai.id_eselon")
            ->leftJoin($tbl_jabatan, "$tbl_jabatan.id_jabatan", '=', "$tbl_pegawai.id_jabatan")
            ->get();

        return $data;
    }

    // Get Masa Kerja By Id
    public static function getById($id)
    {
        // Tabel - tabel
        $tbl_masa_kerja = "masa_kerja_pegawai";
        $tbl_pegawai = "pegawai";
        $tbl_golongan = "pangkat_golongan";
        $tbl_eselon = "pangkat_eselon";
        $tbl_jabatan = "jabatan";

        // Get data masa kerja
        $data_masa_kerja = DB::table($tbl_masa_kerja)
            ->select(
                "$tbl_masa_kerja.*",
                "$tbl_pegawai.nip",
                "$tbl_pegawai.nama",
                "$tbl_pegawai.tgl_lahir",
                "$tbl_pegawai.tmt_cpns",
                "$tbl_pegawai.tmt_golongan",
                "$tbl_pegawai.foto",
                "$tbl_golongan.golongan",
                "$tbl_golongan.keterangan AS ket_golongan",
                "$tbl_eselon.eselon",
                "$tbl_eselon.keterangan AS ket_eselon",
                "$tbl_jabatan.nama_jabatan",
            )
            ->where("$tbl_masa_kerja.id_masa_kerja", '=', $id)
            ->leftJoin($tbl_pegawai, "$tbl_pegawai.id_pegawai", '=', "$tbl_masa_kerja.id_pegawai")
            ->leftJoin($tbl_golongan, "$tbl_golongan.id_pangkat_golongan", '=', "$tbl_pegawai.id_golongan")
            ->leftJoin($tbl_eselon, "$tbl_eselon.id_pangkat_eselon", '=', "$tbl_pegawai.id_eselon")
            ->leftJoin($tbl_jabatan, "$tbl_jabatan.id_jabatan", '=', "$tbl_pegawai.id_jabatan")
            ->first();

        if ($data_masa_kerja) {
            return $data_masa_kerja;
        } else {
            return null;
        }
    }

    // Edit Masa Kerja
    public static function edit($req, $id)
    {
        // Tabel - tabel
        $tbl_masa_kerja = "masa_kerja_pegawai";

        // Cek apakah data ditemukan
        $masa_kerja = DB::table($tbl_masa_kerja)->where('id_masa_kerja', '=', $id)->first();
        if (!$masa_kerja) {
            return 404; // NOT FOUND
        }

        $data = [
            "mk_golongan" => $req->mk_golongan ? $req->mk_golongan : $masa_kerja->mk_golongan,
            "mk_jabatan" => $req->jabatan ? $req->jabatan : $masa_kerja->jabatan,
            "mk_sebelum_cpns" => $req->mk_sebelum_cpns ? $req->mk_sebelum_cpns : $masa_kerja->mk_sebelum_cpns,
            "mk_seluruhnya" => $req->mk_seluruhnya ? $req->mk_seluruhnya : $masa_kerja->mk_seluruhnya,
        ];

        $cek_edit = DB::table($tbl_masa_kerja)->where('id_masa_kerja', '=', $id)->update($data);

        // Get data setelah dieditx
        $edited_data = DB::table($tbl_masa_kerja)
            ->where('id_masa_kerja', '=', $id)
            ->first();

        // Cek apakah proses delete berhasil
        if ($cek_edit) {
            return $edited_data;
        } else {
            return 500;
        }
    }
}
