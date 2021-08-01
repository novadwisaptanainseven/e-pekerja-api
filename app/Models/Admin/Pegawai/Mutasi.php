<?php

namespace App\Models\Admin\Pegawai;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mutasi extends Model
{
    use HasFactory;
    protected $table = "mutasi";
    protected $primaryKey = "id_mutasi";

    // Get All Mutasi
    public static function getAll($req)
    {
        // Tabel - tabel
        $tbl_mutasi = "mutasi";
        $tbl_pegawai = "pegawai";
        $tbl_ptth = "ptth";

        $bulan = !$req->bulan ? '' : $req->bulan;
        $tahun = !$req->tahun ? '' : $req->tahun;

        if ($bulan && $tahun) {
            $data_mutasi = DB::table($tbl_mutasi)
                ->select(
                    "$tbl_mutasi.*",
                    "$tbl_pegawai.nip",
                    "$tbl_pegawai.id_status_pegawai",
                    "$tbl_pegawai.nama",
                    "$tbl_pegawai.no_hp",
                )
                ->leftJoin($tbl_pegawai, "$tbl_pegawai.id_pegawai", "=", "$tbl_mutasi.id_pegawai")
                ->whereMonth("$tbl_mutasi.tgl_mutasi", "=", $bulan)
                ->whereYear("$tbl_mutasi.tgl_mutasi", "=", $tahun)
                ->orderBy("$tbl_mutasi.id_mutasi", "desc")
                ->get();
        } else {
            $data_mutasi = DB::table($tbl_mutasi)
                ->select(
                    "$tbl_mutasi.*",
                    "$tbl_pegawai.nip",
                    "$tbl_pegawai.id_status_pegawai",
                    "$tbl_pegawai.nama",
                    "$tbl_pegawai.no_hp",
                )
                ->leftJoin($tbl_pegawai, "$tbl_pegawai.id_pegawai", "=", "$tbl_mutasi.id_pegawai")
                ->orderBy("$tbl_mutasi.id_mutasi", "desc")
                ->get();
        }

        foreach ($data_mutasi as $d) {
            if ($d->id_status_pegawai === 2) {
                $ptth = DB::table($tbl_ptth)
                    ->where("id_pegawai", "=", $d->id_pegawai)
                    ->first();

                if ($ptth) {
                    $d->nik = $ptth->nik;
                } else {
                    $d->nik = "";
                }
            }
        }

        return $data_mutasi;
    }

    // Get Mutasi By Id
    public static function getById($id_mutasi)
    {
        // Tabel - tabel
        $tbl_mutasi = "mutasi";
        $tbl_pegawai = "pegawai";
        $tbl_ptth = "ptth";

        $data_mutasi = DB::table($tbl_mutasi)
            ->select(
                "$tbl_mutasi.*",
                "$tbl_pegawai.nip",
                "$tbl_pegawai.nama",
                "$tbl_pegawai.foto",
                "$tbl_pegawai.id_status_pegawai"
            )
            ->where("id_mutasi", '=', $id_mutasi)
            ->leftJoin($tbl_pegawai, "$tbl_pegawai.id_pegawai", "=", "$tbl_mutasi.id_pegawai")
            ->first();

        if (!$data_mutasi) {
            return 404;
        }

        if ($data_mutasi->id_status_pegawai == 2) {
            $ptth = DB::table($tbl_ptth)
                ->where("id_pegawai", "=", $data_mutasi->id_pegawai)
                ->first();
            if ($ptth) {
                $data_mutasi->nik = $ptth->nik;
            } else {
                $data_mutasi->nik = "";
            }
        }

        return $data_mutasi;
    }

    // Insert Mutasi
    public static function insert($req)
    {
        // Tabel - tabel
        $tbl_mutasi = "mutasi";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)
            ->where("id_pegawai", "=", $req->id_pegawai)
            ->first();
        if (!$data_pegawai) {
            return 404;
        }

        $current_date = new DateTime('now');

        $data = [
            'id_pegawai'  => $req->id_pegawai,
            'tgl_mutasi'  => $req->tgl_mutasi,
            'keterangan'  => $req->keterangan,
            'created_at'  => $current_date,
        ];

        // Tambah data mutasi ke tabel mutasi
        DB::table($tbl_mutasi)->insert($data);

        // Setelah itu, update status kerja di tabel pegawai menjadi mutasi
        DB::table($tbl_pegawai)
            ->where("id_pegawai", "=", $req->id_pegawai)
            ->update(["status_kerja" => "mutasi"]);

        return 201;
    }

    // Edit Mutasi
    public static function edit($req, $id_mutasi)
    {
        // Tabel - tabel
        $tbl_mutasi = "mutasi";

        // Cek apakah data mutasi ditemukan
        $mutasi = DB::table($tbl_mutasi)
            ->where("id_mutasi", '=', $id_mutasi)
            ->first();
        if (!$mutasi) {
            return 404; // NOT FOUND
        }

        // Get current date
        $current_date = new DateTime('now');

        $data = [
            "tgl_mutasi"    => $req->tgl_mutasi ? $req->tgl_mutasi : $mutasi->tgl_mutasi,
            "keterangan"     => $req->keterangan ? $req->keterangan : $mutasi->keterangan,
            "updated_at"     => $current_date
        ];

        DB::table($tbl_mutasi)
            ->where("id_mutasi", '=', $id_mutasi)
            ->update($data);

        // Get data setelah diedit
        $edited_data = DB::table($tbl_mutasi)
            ->where("id_mutasi", '=', $id_mutasi)
            ->first();

        return $edited_data;
    }

    // Delete Mutasi
    public static function deleteMutasi($id_mutasi)
    {
        // Tabel - tabel
        $tbl_mutasi = "mutasi";

        // Cek apakah data mutasi ditemukan
        $mutasi = DB::table($tbl_mutasi)
            ->where("id_mutasi", '=', $id_mutasi)
            ->first();
        if (!$mutasi) {
            return 404; // NOT FOUND
        }

        DB::table($tbl_mutasi)
            ->where("id_mutasi", '=', $id_mutasi)
            ->delete();

        return 201;
    }

    // Batalkan Mutasi
    public static function batalkanMutasi($id_mutasi)
    {
        // Tabel - tabel
        $tbl_mutasi = "mutasi";
        $tbl_pegawai = "pegawai";

        // Cek apakah data mutasi ditemukan
        $mutasi = DB::table($tbl_mutasi)
            ->where("id_mutasi", '=', $id_mutasi)
            ->first();
        if (!$mutasi) {
            return 404; // NOT FOUND
        }

        DB::table($tbl_mutasi)
            ->where("id_mutasi", '=', $id_mutasi)
            ->delete();

        DB::table($tbl_pegawai)
            ->where("id_pegawai", "=", $mutasi->id_pegawai)
            ->update(["status_kerja" => "aktif"]);

        return 201;
    }
}
