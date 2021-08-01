<?php

namespace App\Models\Admin;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pensiun extends Model
{
    use HasFactory;
    protected $table = "pensiun";
    protected $primaryKey = "id_pensiun";

    // Get All Pensiun
    public static function getAll($req)
    {
        // Tabel - tabel
        $tbl_pensiun = "pensiun";
        $tbl_pegawai = "pegawai";
        $tbl_ptth = "ptth";

        $bulan = !$req->bulan ? '' : $req->bulan;
        $tahun = !$req->tahun ? '' : $req->tahun;

        if ($bulan && $tahun) {
            $data_pensiun = DB::table($tbl_pensiun)
                ->select(
                    "$tbl_pensiun.*",
                    "$tbl_pegawai.nip",
                    "$tbl_pegawai.id_status_pegawai",
                    "$tbl_pegawai.nama",
                    "$tbl_pegawai.no_hp",
                )
                ->leftJoin($tbl_pegawai, "$tbl_pegawai.id_pegawai", "=", "$tbl_pensiun.id_pegawai")
                ->whereMonth("$tbl_pensiun.tgl_pensiun", "=", $bulan)
                ->whereYear("$tbl_pensiun.tgl_pensiun", "=", $tahun)
                ->orderBy("$tbl_pensiun.id_pensiun", "desc")
                ->get();
        } else {
            $data_pensiun = DB::table($tbl_pensiun)
                ->select(
                    "$tbl_pensiun.*",
                    "$tbl_pegawai.nip",
                    "$tbl_pegawai.id_status_pegawai",
                    "$tbl_pegawai.nama",
                    "$tbl_pegawai.no_hp",
                )
                ->leftJoin($tbl_pegawai, "$tbl_pegawai.id_pegawai", "=", "$tbl_pensiun.id_pegawai")
                ->orderBy("$tbl_pensiun.id_pensiun", "desc")
                ->get();
        }

        foreach ($data_pensiun as $d) {
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

        return $data_pensiun;
    }

    // Get Pensiun By Id
    public static function getById($id_pensiun)
    {
        // Tabel - tabel
        $tbl_pensiun = "pensiun";
        $tbl_pegawai = "pegawai";
        $tbl_ptth = "ptth";

        $data_pensiun = DB::table($tbl_pensiun)
            ->select(
                "$tbl_pensiun.*",
                "$tbl_pegawai.nip",
                "$tbl_pegawai.nama",
                "$tbl_pegawai.foto",
                "$tbl_pegawai.id_status_pegawai"
            )
            ->where("id_pensiun", '=', $id_pensiun)
            ->leftJoin($tbl_pegawai, "$tbl_pegawai.id_pegawai", "=", "$tbl_pensiun.id_pegawai")
            ->first();

        if ($data_pensiun->id_status_pegawai == 2) {
            $ptth = DB::table($tbl_ptth)
                ->where("id_pegawai", "=", $data_pensiun->id_pegawai)
                ->first();
            if ($ptth) {
                $data_pensiun->nik = $ptth->nik;
            } else {
                $data_pensiun->nik = "";
            }
        }

        if ($data_pensiun) {
            return $data_pensiun;
        } else {
            return 404;
        }
    }

    // Insert Pensiun
    public static function insert($req)
    {
        // Tabel - tabel
        $tbl_pensiun = "pensiun";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)
            ->where("id_pegawai", "=", $req->id_pegawai)
            ->first();
        if (!$data_pegawai) {
            return 404;
        }

        $data = [
            'id_pegawai'  => $req->id_pegawai,
            'tgl_pensiun' => $req->tgl_pensiun,
            'keterangan'  => $req->keterangan,
        ];

        // Tambah data pensiun ke tabel pensiun
        DB::table($tbl_pensiun)->insert($data);

        // Setelah itu, update status kerja di tabel pegawai menjadi pensiun
        DB::table($tbl_pegawai)
            ->where("id_pegawai", "=", $req->id_pegawai)
            ->update(["status_kerja" => "pensiun"]);

        return 201;
    }

    // Edit Pensiun
    public static function edit($req, $id_pensiun)
    {
        // Tabel - tabel
        $tbl_pensiun = "pensiun";

        // Cek apakah data pensiun ditemukan
        $pensiun = DB::table($tbl_pensiun)
            ->where("id_pensiun", '=', $id_pensiun)
            ->first();
        if (!$pensiun) {
            return 404; // NOT FOUND
        }

        // Get current date
        $current_date = new DateTime('now');

        $data = [
            "tgl_pensiun"    => $req->tgl_pensiun ? $req->tgl_pensiun : $pensiun->tgl_pensiun,
            "keterangan"     => $req->keterangan ? $req->keterangan : $pensiun->keterangan,
            // "status_pensiun" => $req->status_pensiun ? $req->status_pensiun : $pensiun->status_pensiun,
            "updated_at"     => $current_date
        ];

        DB::table($tbl_pensiun)
            ->where("id_pensiun", '=', $id_pensiun)
            ->update($data);

        // Get data setelah diedit
        $edited_data = DB::table($tbl_pensiun)
            ->where("id_pensiun", '=', $id_pensiun)
            ->first();

        return $edited_data;
    }

    // Delete Pensiun
    public static function deletePensiun($id_pensiun)
    {
        // Tabel - tabel
        $tbl_pensiun = "pensiun";

        // Cek apakah data pensiun ditemukan
        $pensiun = DB::table($tbl_pensiun)
            ->where("id_pensiun", '=', $id_pensiun)
            ->first();
        if (!$pensiun) {
            return 404; // NOT FOUND
        }

        DB::table($tbl_pensiun)
            ->where("id_pensiun", '=', $id_pensiun)
            ->delete();

        return 201;
    }

    // Batalkan Pensiun
    public static function batalkanPensiun($id_pensiun)
    {
        // Tabel - tabel
        $tbl_pensiun = "pensiun";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pensiun ditemukan
        $pensiun = DB::table($tbl_pensiun)
            ->where("id_pensiun", '=', $id_pensiun)
            ->first();
        if (!$pensiun) {
            return 404; // NOT FOUND
        }

        DB::table($tbl_pensiun)
            ->where("id_pensiun", '=', $id_pensiun)
            ->delete();

        DB::table($tbl_pegawai)
            ->where("id_pegawai", "=", $pensiun->id_pegawai)
            ->update(["status_kerja" => "aktif"]);

        return 201;
    }
}
