<?php

namespace App\Models\Admin;

use App\Exports\MasaKerjaExport;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class MasaKerja extends Model
{
    use HasFactory;

    protected $table = "masa_kerja_pegawai";
    protected $primaryKey = "id_masa_kerja";

    protected $guarded = [];

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
                "$tbl_pegawai.tmt_jabatan",
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
            ->orderBy("$tbl_masa_kerja.total_mkg_hari", "DESC")
            ->get();

        return $data;
    }

    // Get All Masa Kerja For Print
    public static function getAllForPrint()
    {
        // Tabel - tabel
        $tbl_masa_kerja = "masa_kerja_pegawai";
        $tbl_pegawai = "pegawai";
        $tbl_golongan = "pangkat_golongan";
        $tbl_eselon = "pangkat_eselon";
        $tbl_masa_kerja = "masa_kerja_pegawai";
        $tbl_pendidikan = "pendidikan";
        $tbl_jabatan = "jabatan";
        $tbl_diklat = "diklat";

        // Get data masa_kerja
        $data_masa_kerja = DB::table($tbl_masa_kerja)
            ->select(
                "$tbl_masa_kerja.*",
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
                "$tbl_jabatan.nama_jabatan AS jabatan",
                "$tbl_masa_kerja.mk_golongan"
            )
            ->leftJoin($tbl_pegawai, "$tbl_pegawai.id_pegawai", '=', "$tbl_masa_kerja.id_pegawai")
            ->leftJoin($tbl_golongan, "$tbl_golongan.id_pangkat_golongan", '=', "$tbl_pegawai.id_golongan")
            ->leftJoin($tbl_eselon, "$tbl_eselon.id_pangkat_eselon", '=', "$tbl_pegawai.id_eselon")
            ->leftJoin($tbl_jabatan, "$tbl_jabatan.id_jabatan", '=', "$tbl_pegawai.id_jabatan")
            ->orderBy("$tbl_masa_kerja.total_mkg_hari", "DESC")
            ->get();

        foreach ($data_masa_kerja as $i => $d) {
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

        return $data_masa_kerja;
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
                "$tbl_pegawai.tmt_jabatan",
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

        // Hitung total masa kerja untuk pengurutan
        $total_mkg_hari = hitungMKG($req);

        $data = [
            "mk_golongan" => $req->mk_golongan ? $req->mk_golongan : $masa_kerja->mk_golongan,
            "mk_jabatan" => $req->mk_jabatan ? $req->mk_jabatan : $masa_kerja->mk_jabatan,
            "mk_sebelum_cpns" => $req->mk_sebelum_cpns ? $req->mk_sebelum_cpns : $masa_kerja->mk_sebelum_cpns,
            "mk_seluruhnya" => $req->mk_seluruhnya ? $req->mk_seluruhnya : $masa_kerja->mk_seluruhnya,
            "total_mkg_hari" => $req->mk_golongan ? $total_mkg_hari : $masa_kerja->total_mkg_hari
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

    // Insert Riwayat Masa Kerja
    public static function insertRiwayatMasaKerja($req, $id_pegawai)
    {
        // Tabel - tabel
        $tbl_riwayat_mk = "riwayat_mk";
        $tbl_masa_kerja_pegawai = "masa_kerja_pegawai";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $pegawai = DB::table($tbl_pegawai)->where('id_pegawai', '=', $id_pegawai)->first();
        if (!$pegawai) {
            return 404; // NOT FOUND
        }

        // Insert Riwayat Masa Kerja ke database
        $data = [
            "id_pegawai"      => $id_pegawai,
            "mk_golongan"     => $req->mk_golongan,
            "mk_jabatan"      => $req->mk_jabatan,
            "mk_sebelum_cpns" => $req->mk_cpns,
            "mk_seluruhnya"   => $req->mk_seluruhnya,
            "tanggal"         => date("Y-m-d"),
            "created_at"      => now(),
            "updated_at"      => now(),
        ];

        DB::table($tbl_riwayat_mk)->insert($data);

        // Update Masa Kerja Di Tabel Pegawai

        // Hitung total masa kerja untuk pengurutan
        $total_mkg_hari = hitungMKG($req);

        $data2 = [
            "id_pegawai"      => $id_pegawai,
            "mk_golongan"     => $req->mk_golongan,
            "mk_jabatan"      => $req->mk_jabatan,
            "mk_sebelum_cpns" => $req->mk_cpns,
            "mk_seluruhnya"   => $req->mk_seluruhnya,
            "total_mkg_hari"  => $total_mkg_hari,
        ];

        DB::table($tbl_masa_kerja_pegawai)
            ->where('id_pegawai', "=", $id_pegawai)
            ->update($data2);

        return true;
    }

    // Get All Masa Kerja
    public static function getAllRiwayatMasaKerja($id_pegawai)
    {
        // Tabel - tabel
        $tbl_riwayat_mk = "riwayat_mk";

        $data = DB::table($tbl_riwayat_mk)
            ->orderBy("$tbl_riwayat_mk.id_riwayat_mk", "DESC")
            ->where("id_pegawai", '=', $id_pegawai)
            ->get();

        return $data;
    }

    // Get Riwayat masa kerja By Id
    public static function getRiwayatMasaKerjaById($id_pegawai, $id_riwayat_mk)
    {
        // Tabel - tabel
        $tbl_riwayat_mk = "riwayat_mk";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)
            ->where("id_pegawai", "=", $id_pegawai)
            ->first();
        if (!$data_pegawai) {
            return 404;
        }

        // Cek apakah data riwayat_mk ditemukan
        $data_riwayat_mk = DB::table($tbl_riwayat_mk)
            ->where([
                ["id_riwayat_mk", "=", $id_riwayat_mk],
                ["id_pegawai", "=", $id_pegawai],
            ])
            ->first();
        if (!$data_riwayat_mk) {
            return 405;
        } else {
            return $data_riwayat_mk;
        }
    }

    // Get Riwayat Masa Kerja Terbaru
    public static function getRiwayatMasaKerjaTerbaru($id_pegawai)
    {
        // Tabel - tabel
        $tbl_riwayat_mk = "riwayat_mk";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)
            ->where("id_pegawai", "=", $id_pegawai)
            ->first();
        if (!$data_pegawai) {
            return null;
        }

        $data = DB::table($tbl_riwayat_mk)
            ->where('id_pegawai', '=', $id_pegawai)
            ->orderBy('id_riwayat_mk', 'DESC')
            ->first();

        return $data;
    }

    // Delete Riwayat Masa Kerja
    public static function deleteRiwayatMasaKerja($id_pegawai, $id_riwayat_mk)
    {
        // Tabel - tabel
        $tbl_riwayat_mk = "riwayat_mk";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $pegawai = DB::table($tbl_pegawai)->where('id_pegawai', '=', $id_pegawai)->first();
        if (!$pegawai) {
            return 404; // NOT FOUND
        }

        // Cek apakah data riwayat_mk ditemukan
        $riwayat_mk = DB::table($tbl_riwayat_mk)->where([
            ['id_riwayat_mk', '=', $id_riwayat_mk],
            ['id_pegawai', '=', $id_pegawai],
        ])->first();
        if (!$riwayat_mk) {
            return 405; // NOT FOUND
        }

        // Delete data riwayat_mk
        DB::table($tbl_riwayat_mk)
            ->where([
                ['id_riwayat_mk', '=', $id_riwayat_mk],
                ['id_pegawai', '=', $id_pegawai],
            ])
            ->delete();

        return true;
    }

    // Simpan riwayat pegawai berdasarkan masa kerja
    public static function saveRiwayatMasaKerja($req)
    {
        // Tabel
        $tbl_riwayat_mk_file = "riwayat_mk_file";

        // Generate Random Number for Filename
        $sanitizeName = Str::of($req->nama_file)->slug('-');
        $filename = time() . rand(0, 999) . "-" . $sanitizeName;

        $data = [
            "tanggal"   => $req->tanggal,
            "file"      => $req->nama_file,
            "file_slug" => $filename,
            "keadaan"   => $req->keadaan,
        ];
        DB::table($tbl_riwayat_mk_file)->insert($data);

        // Excel::store(new MasaKerjaExport(tanggal: $req->tanggal), "exports/$filename.xlsx");
        Excel::store(new MasaKerjaExport(null, null, $req->tanggal), "exports/$filename.xlsx");
    }

    // Get riwayat masa kerja file
    public static function getRiwayatMasaKerjaFile()
    {
        // Tabel
        $tbl_riwayat_mk_file = "riwayat_mk_file";

        $data = DB::table($tbl_riwayat_mk_file)
            ->orderByDesc('id_riwayat_mk_file')
            ->get();

        return $data;
    }

    // Get riwayat masa kerja file berdasarkan bulan dan tahun
    public static function getRiwayatMasaKerjaFileByDate($req)
    {
        // Tabel
        $tbl_riwayat_mk_file = "riwayat_mk_file";

        $bulan = $req->bulan ? $req->bulan : "";
        $tahun = $req->tahun ? $req->tahun : "";

        $data = DB::table($tbl_riwayat_mk_file)
            ->orderByDesc('id_riwayat_mk_file')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->get();

        return $data;
    }

    // Delete riwayat masa kerja file
    public static function deleteRiwayatMasaKerjaFile($id)
    {
        // Tabel
        $tbl_riwayat_mk_file = "riwayat_mk_file";

        // Find Data
        $data_mk_file = DB::table($tbl_riwayat_mk_file)
            ->where('id_riwayat_mk_file', '=', $id)
            ->first();
        if (!$data_mk_file) {
            return 404;
        }

        // Delete data
        DB::table($tbl_riwayat_mk_file)
            ->where('id_riwayat_mk_file', '=', $id)
            ->delete();
        // Delete file from storage
        Storage::delete("exports/$data_mk_file->file_slug" . ".xlsx");

        return true;
    }
}
