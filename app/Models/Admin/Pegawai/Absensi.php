<?php

namespace App\Models\Admin\Pegawai;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use stdClass;

class Absensi extends Model
{
    use HasFactory;
    protected $table = "absensi";
    protected $primaryKey = "id_absensi";

    // Get Informasi Rekap Absensi Per Tahun
    public static function getRekapAbsensiPerTahun($id_pegawai)
    {
        // Tabel - Tabel
        $tbl_pegawai = "pegawai";
        $tbl_absensi = "absensi";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)
            ->where("id_pegawai", "=", $id_pegawai)
            ->first();
        if (!$data_pegawai) {
            return 404; // NOT FOUND
        }

        // Jika pegawai ditemukan lanjutkan proses get
        // Tentukan range nilai first dan last date
        $firstYear = date("Y") - 4;
        $currentYear = date("Y");

        $data = [];
        

        for ($i = $firstYear; $i <= $currentYear; $i++) {
            // Instantiate Object
            $obj = new stdClass();
            $obj->tahun = $i;

            // Hitung total tanpa keterangan
            $obj->tanpa_keterangan = DB::table($tbl_absensi)
                ->where([
                    ["id_pegawai", "=", $id_pegawai],
                    ["absen", "=", 0],
                ])
                ->whereYear("tgl_absen", "=", $i)
                ->get()->count();
            // Hitung total hadir

            $obj->hadir = DB::table($tbl_absensi)
                ->where([
                    ["id_pegawai", "=", $id_pegawai],
                    ["absen", "=", 1],
                ])
                ->whereYear("tgl_absen", "=", $i)
                ->get()->count();

            // Hitung total izin
            $obj->izin = DB::table($tbl_absensi)
                ->where([
                    ["id_pegawai", "=", $id_pegawai],
                    ["absen", "=", 2],
                ])
                ->whereYear("tgl_absen", "=", $i)
                ->get()->count();

            // Hitung total sakit
            $obj->sakit = DB::table($tbl_absensi)
                ->where([
                    ["id_pegawai", "=", $id_pegawai],
                    ["absen", "=", 3],
                ])
                ->whereYear("tgl_absen", "=", $i)
                ->get()->count();

            // Hitung total cuti
            $obj->cuti = DB::table($tbl_absensi)
                ->where([
                    ["id_pegawai", "=", $id_pegawai],
                    ["absen", "=", 4],
                ])
                ->whereYear("tgl_absen", "=", $i)
                ->get()->count();

            array_push($data, $obj);
        }

        // krsort($data);

        return $data;
    }

    // Get Informasi Rekap Absensi Per Tahun by Status Pegawai
    public static function getByStatusPegawai($jenis_data)
    {
        // Tabel - Tabel
        $tbl_pegawai = "pegawai";
        $tbl_absensi = "absensi";
        $tbl_jabatan = "jabatan";

        if ($jenis_data === "pns") {
            $id_status_pegawai = 1;
        } elseif ($jenis_data === "ptth") {
            $id_status_pegawai = 2;
        } elseif ($jenis_data === "pttb") {
            $id_status_pegawai = 3;
        }

        $data_pegawai = DB::table($tbl_pegawai)
            ->select(
                "$tbl_pegawai.id_pegawai",
                "$tbl_pegawai.nama",
                "$tbl_jabatan.nama_jabatan AS jabatan"
            )
            ->where("$tbl_pegawai.id_status_pegawai", "=", $id_status_pegawai)
            ->leftJoin($tbl_jabatan, "$tbl_jabatan.id_jabatan", "=", "$tbl_pegawai.id_jabatan")
            ->get();

        $tahun = date("Y");

        foreach ($data_pegawai as $data) {

            // Hitung total tanpa keterangan
            $data->tanpa_keterangan = DB::table($tbl_absensi)
                ->where([
                    ["id_pegawai", "=", $data->id_pegawai],
                    ["absen", "=", 0],
                ])
                ->whereYear("tgl_absen", "=", $tahun)
                ->get()->count();
            // Hitung total hadir

            $data->hadir = DB::table($tbl_absensi)
                ->where([
                    ["id_pegawai", "=", $data->id_pegawai],
                    ["absen", "=", 1],
                ])
                ->whereYear("tgl_absen", "=", $tahun)
                ->get()->count();

            // Hitung total izin
            $data->izin = DB::table($tbl_absensi)
                ->where([
                    ["id_pegawai", "=", $data->id_pegawai],
                    ["absen", "=", 2],
                ])
                ->whereYear("tgl_absen", "=", $tahun)
                ->get()->count();

            // Hitung total sakit
            $data->sakit = DB::table($tbl_absensi)
                ->where([
                    ["id_pegawai", "=", $data->id_pegawai],
                    ["absen", "=", 3],
                ])
                ->whereYear("tgl_absen", "=", $tahun)
                ->get()->count();

            // Hitung total cuti
            $data->cuti = DB::table($tbl_absensi)
                ->where([
                    ["id_pegawai", "=", $data->id_pegawai],
                    ["absen", "=", 4],
                ])
                ->whereYear("tgl_absen", "=", $tahun)
                ->get()->count();
        }

        return $data_pegawai;
    }

    // Get Informasi Rekap Absensi Per Tahun
    public static function getAllRekapAbsensiPerTahun($req)
    {
        // Tabel - Tabel
        $tbl_pegawai = "pegawai";
        $tbl_absensi = "absensi";
        $tbl_jabatan = "jabatan";

        // Jika pegawai ditemukan lanjutkan proses get

        $data_pegawai = DB::table($tbl_pegawai)
            ->select(
                "$tbl_pegawai.id_pegawai",
                "$tbl_pegawai.nama",
                "$tbl_jabatan.nama_jabatan AS jabatan"
            )
            ->leftJoin($tbl_jabatan, "$tbl_jabatan.id_jabatan", "=", "$tbl_pegawai.id_jabatan")
            ->get();

        $tahun = $req->tahun ? $req->tahun : date("Y");

        foreach ($data_pegawai as $data) {

            // Hitung total tanpa keterangan
            $data->tanpa_keterangan = DB::table($tbl_absensi)
                ->where([
                    ["id_pegawai", "=", $data->id_pegawai],
                    ["absen", "=", 0],
                ])
                ->whereYear("tgl_absen", "=", $tahun)
                ->get()->count();
            // Hitung total hadir

            $data->hadir = DB::table($tbl_absensi)
                ->where([
                    ["id_pegawai", "=", $data->id_pegawai],
                    ["absen", "=", 1],
                ])
                ->whereYear("tgl_absen", "=", $tahun)
                ->get()->count();

            // Hitung total izin
            $data->izin = DB::table($tbl_absensi)
                ->where([
                    ["id_pegawai", "=", $data->id_pegawai],
                    ["absen", "=", 2],
                ])
                ->whereYear("tgl_absen", "=", $tahun)
                ->get()->count();

            // Hitung total sakit
            $data->sakit = DB::table($tbl_absensi)
                ->where([
                    ["id_pegawai", "=", $data->id_pegawai],
                    ["absen", "=", 3],
                ])
                ->whereYear("tgl_absen", "=", $tahun)
                ->get()->count();

            // Hitung total cuti
            $data->cuti = DB::table($tbl_absensi)
                ->where([
                    ["id_pegawai", "=", $data->id_pegawai],
                    ["absen", "=", 4],
                ])
                ->whereYear("tgl_absen", "=", $tahun)
                ->get()->count();
        }

        return $data_pegawai;
    }

    // Get All Rekap Absensi berdasarkan tanggal
    public static function getRekapAbsensiByDate($req)
    {
        // Tabel - Tabel
        $tbl_pegawai = "pegawai";
        $tbl_absensi = "absensi";
        $tbl_jabatan = "jabatan";

        // Jika pegawai ditemukan lanjutkan proses get

        $data_pegawai = DB::table($tbl_pegawai)
            ->select(
                "$tbl_pegawai.id_pegawai",
                "$tbl_pegawai.nama",
                "$tbl_jabatan.nama_jabatan AS jabatan"
            )
            ->leftJoin($tbl_jabatan, "$tbl_jabatan.id_jabatan", "=", "$tbl_pegawai.id_jabatan")
            ->get();

        $currentTahun = date("Y");
        $currentBulan = date("m");

        $firstDate = $req->first_date ? $req->first_date : "$currentTahun-$currentBulan-1";
        $lastDate = $req->last_date ? $req->last_date : "$currentTahun-$currentBulan-31";

        foreach ($data_pegawai as $data) {

            // Hitung total tanpa keterangan
            $data->tanpa_keterangan = DB::table($tbl_absensi)
                ->where([
                    ["id_pegawai", "=", $data->id_pegawai],
                    ["absen", "=", 0],
                ])
                ->whereBetween("tgl_absen", [$firstDate, $lastDate])
                ->get()->count();
            // Hitung total hadir

            $data->hadir = DB::table($tbl_absensi)
                ->where([
                    ["id_pegawai", "=", $data->id_pegawai],
                    ["absen", "=", 1],
                ])
                ->whereBetween("tgl_absen", [$firstDate, $lastDate])
                ->get()->count();

            // Hitung total izin
            $data->izin = DB::table($tbl_absensi)
                ->where([
                    ["id_pegawai", "=", $data->id_pegawai],
                    ["absen", "=", 2],
                ])
                ->whereBetween("tgl_absen", [$firstDate, $lastDate])
                ->get()->count();

            // Hitung total sakit
            $data->sakit = DB::table($tbl_absensi)
                ->where([
                    ["id_pegawai", "=", $data->id_pegawai],
                    ["absen", "=", 3],
                ])
                ->whereBetween("tgl_absen", [$firstDate, $lastDate])
                ->get()->count();

            // Hitung total cuti
            $data->cuti = DB::table($tbl_absensi)
                ->where([
                    ["id_pegawai", "=", $data->id_pegawai],
                    ["absen", "=", 4],
                ])
                ->whereBetween("tgl_absen", [$firstDate, $lastDate])
                ->get()->count();

            // $data->tahun = $currentTahun;
            // $data->bulan = $currentBulan;
        }

        return $data_pegawai;
    }

    // Get All Absensi by Id Pegawai and Query Paramaters
    public static function getAbsensiByQuery($req, $id_pegawai)
    {
        // Tabel - Tabel
        $tbl_pegawai = "pegawai";
        $tbl_absensi = "absensi";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)
            ->where("id_pegawai", "=", $id_pegawai)
            ->first();
        if (!$data_pegawai) {
            return 404; // NOT FOUND
        }

        // Jika pegawai ditemukan lanjutkan proses get
        // Tentukan range nilai first dan last date
        $firstDate = "{$req->tahun}-{$req->bulan}-1";
        $lastDate = "{$req->tahun}-{$req->bulan}-31";

        $data_absensi = DB::table($tbl_absensi)
            ->whereBetween("tgl_absen", [$firstDate, $lastDate])
            ->where("id_pegawai", "=", $id_pegawai)
            ->orderBy("tgl_absen", "asc")
            ->get();

        return $data_absensi;
    }

    // Get Riwayat Absensi by Id Pegawai and Filter
    public static function getAbsensiByFilter($req, $id_pegawai)
    {
        // Tabel - Tabel
        $tbl_pegawai = "pegawai";
        $tbl_absensi = "absensi";

        // Cek apakah data pegawai ditemukaxn
        $data_pegawai = DB::table($tbl_pegawai)
            ->where("id_pegawai", "=", $id_pegawai)
            ->first();
        if (!$data_pegawai) {
            return 404; // NOT FOUND
        }

        // Jika pegawai ditemukan lanjutkan proses get
        // Tentukan range nilai first dan last date
        $currentTahun = date("Y");
        $currentBulan = date("m");

        $firstDate = $req->first_date ? $req->first_date : "$currentTahun-$currentBulan-1";
        $lastDate = $req->last_date ? $req->last_date : "$currentTahun-$currentBulan-31";

        $data_absensi = DB::table($tbl_absensi)
            ->whereBetween("tgl_absen", [$firstDate, $lastDate])
            ->where("id_pegawai", "=", $id_pegawai)
            ->orderBy("tgl_absen", "desc")
            ->get();

        return $data_absensi;
    }

    // Insert Absensi
    public static function insert($req, $id_pegawai)
    {
        // Tabel - tabel
        $tbl_pegawai = "pegawai";
        $tbl_absensi = "absensi";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)
            ->where("id_pegawai", "=", $id_pegawai)
            ->first();
        if (!$data_pegawai) {
            return 404; // NOT FOUND
        }

        // Jika pegawai ditemukan lanjutkan proses insert
        $data_absensi = [
            "id_pegawai" => $id_pegawai,
            "tgl_absen"  => $req->tgl_absen,
            "hari"       => $req->hari,
            "absen"      => $req->absen,
            "keterangan" => $req->keterangan,
        ];

        DB::table($tbl_absensi)->insert($data_absensi);

        return 201;
    }

    // Insert Rekap Absensi
    public static function insertRekapAbsensi($req, $id_pegawai)
    {
        // Tabel - tabel
        $tbl_pegawai = "pegawai";
        $tbl_absensi = "rekap_absensi";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)
            ->where("id_pegawai", "=", $id_pegawai)
            ->first();
        if (!$data_pegawai) {
            return 404; // NOT FOUND
        }

        // Jika pegawai ditemukan lanjutkan proses insert
        $data_absensi = [
            "id_pegawai"       => $id_pegawai,
            "tanpa_keterangan" => $req->tanpa_keterangan,
            "hadir"            => $req->hadir,
            "izin"             => $req->izin,
            "sakit"            => $req->sakit,
            "cuti"             => $req->cuti,
        ];

        DB::table($tbl_absensi)->insert($data_absensi);

        return 201;
    }

    // Insert Or Update Absensi
    public static function insertOrUpdate($req, $id_pegawai)
    {
        // Tabel - tabel
        $tbl_pegawai = "pegawai";
        $tbl_absensi = "absensi";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)
            ->where("id_pegawai", "=", $id_pegawai)
            ->first();
        if (!$data_pegawai) {
            return 404; // NOT FOUND
        }

        // Jika pegawai ditemukan lanjutkan proses insert
        // Cek apakah data absensi sudah ada
        // Jika belum ada, lakukan proses insert, sebaliknya lakukan proses update
        $data_absensi = DB::table($tbl_absensi)
            ->where([
                ["id_absensi", "=", $req->id_absensi],
                ["id_pegawai", "=", $id_pegawai],
            ])
            ->first();
        if (!$data_absensi) {
            // Jika data absensi belum ada
            $data = [
                "id_pegawai" => $id_pegawai,
                "tgl_absen"  => $req->tgl_absen,
                "hari"       => $req->hari,
                "absen"      => $req->absen,
                "keterangan" => $req->keterangan,
            ];

            DB::table($tbl_absensi)->insert($data);

            return 201;
        } else {
            // Jika data absensi sudah ada
            $data = [
                "tgl_absen"  => $req->tgl_absen,
                "hari"       => $req->hari,
                "absen"      => $req->absen,
                "keterangan" => $req->keterangan,
            ];

            DB::table($tbl_absensi)
                ->where([
                    ["id_absensi", "=", $req->id_absensi],
                    ["id_pegawai", "=", $id_pegawai],
                ])
                ->update($data);

            return 202;
        }
    }

    // Edit Absensi
    public static function edit($req, $id_pegawai, $id_absensi)
    {
        // Tabel - tabel
        $tbl_pegawai = "pegawai";
        $tbl_absensi = "absensi";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)
            ->where("id_pegawai", "=", $id_pegawai)
            ->first();
        if (!$data_pegawai) {
            return 404; // NOT FOUND
        }

        // Cek apakah data absensi ditemukan
        $data_absensi = DB::table($tbl_absensi)
            ->where([
                ["id_absensi", "=", $id_absensi],
                ["id_pegawai", "=", $id_pegawai],
            ])
            ->first();
        if (!$data_absensi) {
            return 405; // NOT FOUND
        }

        // Jika pegawai dan absensi ditemukan lanjutkan proses edit
        $data_absensi = [
            "tgl_absen"  => $req->tgl_absen ? $req->tgl_absen : $data_absensi->tgl_absen,
            "hari"       => $req->hari ? $req->hari : $data_absensi->hari,
            "absen"      => $req->absen ? $req->absen : $data_absensi->absen,
            "keterangan" => $req->keterangan ? $req->keterangan : $data_absensi->keterangan,
        ];

        DB::table($tbl_absensi)
            ->where([
                ["id_absensi", "=", $req->id_absensi],
                ["id_pegawai", "=", $id_pegawai],
            ])
            ->update($data_absensi);

        return 201;
    }

    // Get Absensi by Id Pegawai & Id Absensi
    public static function getById($id_pegawai, $id_absensi)
    {
        // Tabel - tabel
        $tbl_pegawai = "pegawai";
        $tbl_absensi = "absensi";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)
            ->where("id_pegawai", "=", $id_pegawai)
            ->first();
        if (!$data_pegawai) {
            return 404; // NOT FOUND
        }

        // Cek apakah data absensi ditemukan
        $data_absensi = DB::table($tbl_absensi)
            ->where([
                ["id_absensi", "=", $id_absensi],
                ["id_pegawai", "=", $id_pegawai],
            ])
            ->first();

        if (!$data_absensi) {
            return 405;
        }

        return $data_absensi;
    }

    // Delete Absensi
    public static function deleteAbsensi($id_pegawai, $id_absensi)
    {
        // Tabel - tabel
        $tbl_absensi = "absensi";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)
            ->where("id_pegawai", "=", $id_pegawai)
            ->first();
        if (!$data_pegawai) {
            return 404; // NOT FOUND
        }

        // Cek apakah data absensi ditemukan
        $data_absensi = DB::table($tbl_absensi)
            ->where([
                ["id_absensi", "=", $id_absensi],
                ["id_pegawai", "=", $id_pegawai],
            ])
            ->first();
        if (!$data_absensi) {
            return 405; // NOT FOUND
        }

        // Jika pegawai dan absensi ditemukan lanjutkan proses delete
        DB::table($tbl_absensi)
            ->where([
                ["id_absensi", "=", $id_absensi],
                ["id_pegawai", "=", $id_pegawai],
            ])
            ->delete();

        return 201;
    }
}
