<?php

namespace App\Models\Admin;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cuti extends Model
{
    use HasFactory;

    protected $table = "cuti";
    protected $primaryKey = "id_cuti";

    // Get All Cuti
    public static function getAllCuti()
    {
        // Tabel - tabel
        $tbl_cuti = "cuti";
        $tbl_pegawai = "pegawai";

        $data = DB::table($tbl_cuti)
            ->select(
                "$tbl_cuti.*",
                "$tbl_pegawai.nip",
                "$tbl_pegawai.nama",
            )
            ->leftJoin($tbl_pegawai, "$tbl_pegawai.id_pegawai", '=', "$tbl_cuti.id_pegawai")
            ->orderBy("$tbl_cuti.id_cuti", "desc")
            ->get();

        return $data;
    }

    // Get All Cuti by Id Pegawai
    public static function getAll($id_pegawai)
    {
        // Tabel - tabel
        $tbl_cuti = "cuti";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)
            ->where("id_pegawai", "=", $id_pegawai)
            ->first();
        if (!$data_pegawai) {
            return null;
        }

        $data = DB::table($tbl_cuti)
            ->select(
                "$tbl_cuti.*",
                "$tbl_pegawai.nip",
                "$tbl_pegawai.nama",
            )
            ->leftJoin($tbl_pegawai, "$tbl_pegawai.id_pegawai", '=', "$tbl_cuti.id_pegawai")
            ->where("$tbl_cuti.id_pegawai", "=", $id_pegawai)
            ->orderBy("$tbl_cuti.id_cuti", "desc")
            ->get();

        return $data;
    }

    // Get Cuti by Nama Pegawai
    public static function getByName($req)
    {
        // Tabel - tabel
        $tbl_cuti = "cuti";
        $tbl_pegawai = "pegawai";

        $data = DB::table($tbl_cuti)
            ->select(
                "$tbl_cuti.*",
                "$tbl_pegawai.nip",
                "$tbl_pegawai.nama",
            )
            ->leftJoin($tbl_pegawai, "$tbl_pegawai.id_pegawai", '=', "$tbl_cuti.id_pegawai")
            ->where("$tbl_pegawai.nama", "like", "%{$req->nama}%")
            ->orderBy("$tbl_cuti.id_cuti", "desc")
            ->get();

        return $data;
    }

    // Get Cuti By Id
    public static function getById($id_pegawai, $id_cuti)
    {
        // Tabel - tabel
        $tbl_cuti = "cuti";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)
            ->where("id_pegawai", "=", $id_pegawai)
            ->first();
        if (!$data_pegawai) {
            return 404;
        }

        // Cek apakah data cuti ditemukan
        $data_cuti = DB::table($tbl_cuti)
            ->where([
                ["id_cuti", "=", $id_cuti],
                ["id_pegawai", "=", $id_pegawai],
            ])
            ->first();
        if (!$data_cuti) {
            return 405;
        }

        $data = DB::table($tbl_cuti)
            ->where([
                ["id_cuti", "=", $id_cuti],
                ["id_pegawai", "=", $id_pegawai],
            ])
            ->first();

        return $data;
    }

    // Get Pegawai Status Cuti
    public static function getPegawaiStatusCuti($req)
    {
        // Tabel - tabel
        $tbl_cuti = "cuti";
        $tbl_pegawai = "pegawai";
        $tbl_ptth = "ptth";

        $bulan = !$req->bulan ? '' : $req->bulan;
        $tahun = !$req->tahun ? '' : $req->tahun;

        if ($bulan && $tahun) {
            $data = DB::table($tbl_cuti)
                ->select(
                    "$tbl_cuti.*",
                    "$tbl_pegawai.nip",
                    "$tbl_ptth.nik",
                    "$tbl_pegawai.id_status_pegawai",
                    "$tbl_pegawai.nama",
                    "$tbl_pegawai.no_hp",
                    "$tbl_pegawai.jenis_kelamin",
                )
                ->leftJoin($tbl_pegawai, "$tbl_pegawai.id_pegawai", "=", "$tbl_cuti.id_pegawai")
                ->leftJoin($tbl_ptth, "$tbl_ptth.id_pegawai", "=", "$tbl_pegawai.id_pegawai")
                ->whereMonth("$tbl_cuti.tgl_mulai", "=", $bulan)
                ->WhereYear("$tbl_cuti.tgl_mulai", "=", $tahun)
                ->orWhereMonth("$tbl_cuti.tgl_selesai", "=", $bulan)
                ->WhereYear("$tbl_cuti.tgl_selesai", "=", $tahun)
                ->orderByDesc("$tbl_cuti.id_cuti")
                ->get();
        } else {
            $data = DB::table($tbl_cuti)
                ->select(
                    "$tbl_cuti.*",
                    "$tbl_pegawai.nip",
                    "$tbl_ptth.nik",
                    "$tbl_pegawai.id_status_pegawai",
                    "$tbl_pegawai.nama",
                    "$tbl_pegawai.no_hp",
                    "$tbl_pegawai.jenis_kelamin",
                )
                ->leftJoin($tbl_pegawai, "$tbl_pegawai.id_pegawai", '=', "$tbl_cuti.id_pegawai")
                ->leftJoin($tbl_ptth, "$tbl_ptth.id_pegawai", "=", "$tbl_pegawai.id_pegawai")
                ->orderByDesc("$tbl_cuti.id_cuti")
                ->get();
        }

        return $data;
    }

    // Insert Cuti
    public static function insert($req, $id_pegawai)
    {
        // Tabel - tabel
        $tbl_cuti = "cuti";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $pegawai = DB::table($tbl_pegawai)->where('id_pegawai', '=', $id_pegawai)->first();
        if (!$pegawai) {
            return 404; // NOT FOUND
        }

        $data = [
            "id_pegawai"  => $req->id_pegawai,
            "tgl_mulai"   => $req->tgl_mulai,
            "tgl_selesai" => $req->tgl_selesai,
            "jenis_cuti"  => $req->jenis_cuti,
            "keterangan"  => $req->keterangan,
        ];

        DB::table($tbl_cuti)->insert($data);

        return true;
    }

    // Edit cuti
    public static function edit($req, $id_pegawai, $id_cuti)
    {
        // Tabel - tabel
        $tbl_cuti = "cuti";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $pegawai = DB::table($tbl_pegawai)->where('id_pegawai', '=', $id_pegawai)->first();
        if (!$pegawai) {
            return 404; // NOT FOUND
        }

        // Cek apakah data cuti ditemukan
        $cuti = DB::table($tbl_cuti)->where([
            ['id_cuti', '=', $id_cuti],
            ['id_pegawai', '=', $id_pegawai],
        ])->first();
        if (!$cuti) {
            return 405; // NOT FOUND
        }

        // Get current date
        $current_date = new DateTime('now');

        $data = [
            "jenis_cuti"   => $req->jenis_cuti ? $req->jenis_cuti : $cuti->jenis_cuti,
            "tgl_mulai"   => $req->tgl_mulai ? $req->tgl_mulai : $cuti->tgl_mulai,
            "tgl_selesai" => $req->tgl_selesai ? $req->tgl_selesai : $cuti->tgl_selesai,
            "keterangan"  => $req->keterangan ? $req->keterangan : $cuti->keterangan,
            "updated_at"  => $current_date
        ];

        DB::table($tbl_cuti)
            ->where([
                ["id_cuti", "=", $id_cuti],
                ["id_pegawai", "=", $id_pegawai],
            ])
            ->update($data);

        $edited_data = DB::table($tbl_cuti)->where("id_cuti", "=", $id_cuti)->first();

        return $edited_data;
    }

    // Update Status Cuti
    public static function updateStatus($req, $id_pegawai, $id_cuti)
    {
        // Tabel - tabel
        $tbl_cuti = "cuti";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $pegawai = DB::table($tbl_pegawai)->where('id_pegawai', '=', $id_pegawai)->first();
        if (!$pegawai) {
            return 404; // NOT FOUND
        }

        // Cek apakah data cuti ditemukan
        $cuti = DB::table($tbl_cuti)->where([
            ['id_cuti', '=', $id_cuti],
            ['id_pegawai', '=', $id_pegawai],
        ])->first();
        if (!$cuti) {
            return 405; // NOT FOUND
        }

        $data = [
            "status_cuti"   => $req->status_cuti ? $req->status_cuti : $cuti->status_cuti
        ];

        DB::table($tbl_cuti)
            ->where([
                ["id_cuti", "=", $id_cuti],
                ["id_pegawai", "=", $id_pegawai],
            ])
            ->update($data);

        $edited_data = DB::table($tbl_cuti)->where("id_cuti", "=", $id_cuti)->first();

        return $edited_data;
    }

    // Delete Cuti
    public static function deleteCuti($id_pegawai, $id_cuti)
    {
        // Tabel - tabel
        $tbl_cuti = "cuti";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $pegawai = DB::table($tbl_pegawai)->where('id_pegawai', '=', $id_pegawai)->first();
        if (!$pegawai) {
            return 404; // NOT FOUND
        }

        // Cek apakah data cuti ditemukan
        $cuti = DB::table($tbl_cuti)->where([
            ['id_cuti', '=', $id_cuti],
            ['id_pegawai', '=', $id_pegawai],
        ])->first();
        if (!$cuti) {
            return 405; // NOT FOUND
        }

        // Delete data cuti
        DB::table($tbl_cuti)
            ->where([
                ['id_cuti', '=', $id_cuti],
                ['id_pegawai', '=', $id_pegawai],
            ])
            ->delete();

        return true;
    }

    // Get All Pegawai Cuti
    public static function getPegawaiCuti()
    {
        // Tabel - tabel
        $tbl_pegawai = "pegawai";
        $tbl_cuti = "cuti";

        $data_pegawai = DB::table($tbl_pegawai)
            ->where("id_status_pegawai", "=", 1)
            ->get();

        $data_pegawai_cuti = [];
        foreach ($data_pegawai as $i => $item) {
            $cuti = DB::table($tbl_cuti)
                ->select(
                    "$tbl_cuti.*",
                    "$tbl_pegawai.nama",
                    "$tbl_pegawai.nip",
                )
                ->leftJoin($tbl_pegawai, "$tbl_pegawai.id_pegawai", "=", "$tbl_cuti.id_pegawai")
                ->where("$tbl_cuti.id_pegawai", "=", $item->id_pegawai)
                ->orderBy("id_cuti", "desc")
                ->first();

            if ($cuti) {
                $current_timestamp = time();
                $tgl_mulai_timestamp = strtotime($cuti->tgl_mulai);
                $tgl_selesai_timestamp = strtotime($cuti->tgl_selesai);

                if (
                    ($current_timestamp >= $tgl_mulai_timestamp) &&
                    ($current_timestamp <= $tgl_selesai_timestamp)
                ) {
                    array_push($data_pegawai_cuti, $cuti);
                }
            }
        }

        return $data_pegawai_cuti;
    }
}
