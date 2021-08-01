<?php

namespace App\Models\Admin;

use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KGB extends Model
{
    use HasFactory;

    protected $table = "kgb";
    protected $primaryKey = "id_kgb";
    protected $guarded = [];

    // Get All KGB
    public static function getAll($id_pegawai)
    {
        // Tabel - tabel
        $tbl_kgb = "kgb";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)
            ->where("id_pegawai", "=", $id_pegawai)
            ->first();
        if (!$data_pegawai) {
            return null;
        }

        $data = DB::table($tbl_kgb)
            ->select(
                "$tbl_kgb.*",
                "$tbl_pegawai.nip",
                "$tbl_pegawai.nama",
            )
            ->leftJoin($tbl_pegawai, "$tbl_pegawai.id_pegawai", '=', "$tbl_kgb.id_pegawai")
            ->where("$tbl_kgb.id_pegawai", "=", $id_pegawai)
            ->orderBy("id_kgb", "desc")
            ->get();

        return $data;
    }

    // Get KGB Pegawai
    public static function getKGBPegawai($req)
    {
        // Tabel - tabel
        $tbl_kgb = "kgb";
        $tbl_pegawai = "pegawai";

        $bulan = !$req->bulan ? '' : $req->bulan;
        $tahun = !$req->tahun ? '' : $req->tahun;

        if ($bulan && $tahun) {
            $data = DB::table($tbl_kgb)
                ->select(
                    "$tbl_kgb.*",
                    "$tbl_pegawai.nip",
                    "$tbl_pegawai.nama",
                    "$tbl_pegawai.no_hp",
                    "$tbl_pegawai.jenis_kelamin",
                )
                ->leftJoin($tbl_pegawai, "$tbl_pegawai.id_pegawai", '=', "$tbl_kgb.id_pegawai")
                ->whereMonth("$tbl_kgb.tmt_kenaikan_gaji", '=', $bulan)
                ->WhereMonth("$tbl_kgb.kenaikan_gaji_yad", '=', $bulan)
                ->WhereYear("$tbl_kgb.tmt_kenaikan_gaji", '=', $tahun)
                ->WhereYear("$tbl_kgb.kenaikan_gaji_yad", '=', $tahun)
                ->orderByDesc("$tbl_kgb.id_kgb")
                ->get();
        } else {
            $data = DB::table($tbl_kgb)
                ->select(
                    "$tbl_kgb.*",
                    "$tbl_pegawai.nip",
                    "$tbl_pegawai.nama",
                    "$tbl_pegawai.no_hp",
                    "$tbl_pegawai.jenis_kelamin",
                )
                ->leftJoin($tbl_pegawai, "$tbl_pegawai.id_pegawai", '=', "$tbl_kgb.id_pegawai")
                // ->whereRaw("CURDATE() < $tbl_kgb.kenaikan_gaji_yad")
                ->orderByDesc("$tbl_kgb.id_kgb")
                ->get();
        }

        return $data;
    }

    // Get KGB Terbaru
    public static function getKGBTerbaru($id_pegawai)
    {
        // Tabel - tabel
        $tbl_kgb = "kgb";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)
            ->where("id_pegawai", "=", $id_pegawai)
            ->first();
        if (!$data_pegawai) {
            return null;
        }

        $data_gaji_pokok_pertama = DB::table($tbl_pegawai)
            ->where("id_pegawai", "=", $id_pegawai)
            ->first()->gaji_pokok;

        $data_gaji_pokok_terakhir = DB::table($tbl_kgb)
            ->select(
                "$tbl_kgb.*",
                "$tbl_pegawai.nip",
                "$tbl_pegawai.nama",
            )
            ->leftJoin($tbl_pegawai, "$tbl_pegawai.id_pegawai", '=', "$tbl_kgb.id_pegawai")
            ->where("$tbl_kgb.id_pegawai", "=", $id_pegawai)
            ->orderBy("id_kgb", "desc")
            ->first();

        if ($data_gaji_pokok_terakhir) {
            return $data_gaji_pokok_terakhir->gaji_pokok_baru;
        } else {
            return $data_gaji_pokok_pertama;
        }
    }

    // Get KGB By Id
    public static function getById($id_pegawai, $id_kgb)
    {
        // Tabel - tabel
        $tbl_kgb = "kgb";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)
            ->where("id_pegawai", "=", $id_pegawai)
            ->first();
        if (!$data_pegawai) {
            return 404;
        }

        // Cek apakah data kgb ditemukan
        $data_kgb = DB::table($tbl_kgb)
            ->where([
                ["id_kgb", "=", $id_kgb],
                ["id_pegawai", "=", $id_pegawai],
            ])
            ->first();
        if (!$data_kgb) {
            return 405;
        }

        $data = DB::table($tbl_kgb)
            ->where([
                ["id_kgb", "=", $id_kgb],
                ["id_pegawai", "=", $id_pegawai],
            ])
            ->first();

        return $data;
    }

    // Insert KGB
    public static function insert($req, $id_pegawai)
    {
        // Tabel - tabel
        $tbl_kgb = "kgb";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $pegawai = DB::table($tbl_pegawai)->where('id_pegawai', '=', $id_pegawai)->first();
        if (!$pegawai) {
            return 404; // NOT FOUND
        }

        $data = [
            "id_pegawai"        => $req->id_pegawai,
            "gaji_pokok_lama"   => $req->gaji_pokok_lama,
            "gaji_pokok_baru"   => $req->gaji_pokok_baru,
            "tmt_kenaikan_gaji" => $req->tmt_kenaikan_gaji,
            "kenaikan_gaji_yad" => $req->kenaikan_gaji_yad,
            "peraturan"         => $req->peraturan,
            "keterangan"         => $req->keterangan,
            "created_at"        => date("Y-m-d")
        ];

        DB::table($tbl_kgb)->insert($data);

        // Reset status updated di tabel kgb menjadi 0
        DB::table($tbl_kgb)->where("id_pegawai", $id_pegawai)->update(["status_updated" => 0]);

        return true;
    }

    // Edit KGB
    public static function edit($req, $id_pegawai, $id_kgb)
    {
        // Tabel - tabel
        $tbl_kgb = "kgb";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $pegawai = DB::table($tbl_pegawai)->where('id_pegawai', '=', $id_pegawai)->first();
        if (!$pegawai) {
            return 404; // NOT FOUND
        }

        // Cek apakah data kgb ditemukan
        $kgb = DB::table($tbl_kgb)->where([
            ['id_kgb', '=', $id_kgb],
            ['id_pegawai', '=', $id_pegawai],
        ])->first();
        if (!$kgb) {
            return 405; // NOT FOUND
        }

        // Get current date
        $current_date = new DateTime('now');

        $data = [
            "gaji_pokok_lama"   => $req->gaji_pokok_lama ? $req->gaji_pokok_lama : $kgb->gaji_pokok_lama,
            "gaji_pokok_baru"   => $req->gaji_pokok_baru ? $req->gaji_pokok_baru : $kgb->gaji_pokok_baru,
            "tmt_kenaikan_gaji" => $req->tmt_kenaikan_gaji ? $req->tmt_kenaikan_gaji : $kgb->tmt_kenaikan_gaji,
            "kenaikan_gaji_yad" => $req->kenaikan_gaji_yad ? $req->kenaikan_gaji_yad : $kgb->kenaikan_gaji_yad,
            "peraturan"         => $req->peraturan ? $req->peraturan : $kgb->peraturan,
            "updated_at"        => $current_date,
        ];

        DB::table($tbl_kgb)
            ->where([
                ["id_kgb", "=", $id_kgb],
                ["id_pegawai", "=", $id_pegawai],
            ])
            ->update($data);

        $edited_data = DB::table($tbl_kgb)->where("id_kgb", "=", $id_kgb)->first();

        return $edited_data;
    }

    // Delete KGB
    public static function deleteKGB($id_pegawai, $id_kgb)
    {
        // Tabel - tabel
        $tbl_kgb = "kgb";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $pegawai = DB::table($tbl_pegawai)->where('id_pegawai', '=', $id_pegawai)->first();
        if (!$pegawai) {
            return 404; // NOT FOUND
        }

        // Cek apakah data kgb ditemukan
        $kgb = DB::table($tbl_kgb)->where([
            ['id_kgb', '=', $id_kgb],
            ['id_pegawai', '=', $id_pegawai],
        ])->first();
        if (!$kgb) {
            return 405; // NOT FOUND
        }

        // Delete data kgb
        DB::table($tbl_kgb)
            ->where([
                ['id_kgb', '=', $id_kgb],
                ['id_pegawai', '=', $id_pegawai],
            ])
            ->delete();

        return true;
    }
}
