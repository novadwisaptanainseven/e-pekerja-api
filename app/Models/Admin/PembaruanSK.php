<?php

namespace App\Models\Admin;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PembaruanSK extends Model
{
    use HasFactory;

    protected $table = "riwayat_sk";
    protected $primaryKey = "id_riwayat_sk";
    protected static $tbl = "riwayat_sk";

    // Get All Riwayat SK
    public static function getAll($id_pegawai)
    {
        // Tabel - tabel
        $tbl_riwayat_sk = "riwayat_sk";
        $tbl_pegawai = "pegawai";
        $tbl_jabatan = "jabatan";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)
            ->where("id_pegawai", "=", $id_pegawai)
            ->first();
        if (!$data_pegawai) {
            return null;
        }
        //  Cek status pegawai
        if ($data_pegawai->id_status_pegawai == 2) {
            // Jika ptth maka inisialisasi tabel dengan ptth
            $tbl_pegawai2 = "ptth";
            $tbl_pegawai2_field = "nik";
        } else {
            // Jika pttb maka inisialisasi tabel dengan pttb
            $tbl_pegawai2 = "pttb";
            $tbl_pegawai2_field = "nip";
        }

        $data = DB::table($tbl_riwayat_sk)
            ->select(
                "$tbl_riwayat_sk.*",
                "$tbl_pegawai.nama",
                "$tbl_jabatan.*",
                "$tbl_pegawai2.$tbl_pegawai2_field",
            )
            ->leftJoin($tbl_pegawai, "$tbl_pegawai.id_pegawai", '=', "$tbl_riwayat_sk.id_pegawai")
            ->leftJoin($tbl_pegawai2, "$tbl_pegawai2.id_pegawai", '=', "$tbl_pegawai.id_pegawai")
            ->leftJoin($tbl_jabatan, "$tbl_jabatan.id_jabatan", "=", "$tbl_riwayat_sk.tugas")
            ->where("$tbl_riwayat_sk.id_pegawai", "=", $id_pegawai)
            ->orderBy("id_riwayat_sk", "desc")
            ->get();

        return $data;
    }

    // Get Riwayat SK By Id
    public static function getById($id_pegawai, $id_riwayat_sk)
    {
        // Tabel - tabel
        $tbl_riwayat_sk = "riwayat_sk";
        $tbl_pegawai = "pegawai";
        $tbl_jabatan = "jabatan";

        // Cek apakah data pegawai ditemukan
        $data_pegawai = DB::table($tbl_pegawai)
            ->where("id_pegawai", "=", $id_pegawai)
            ->first();
        if (!$data_pegawai) {
            return 404;
        }

        // Cek apakah data riwayat sk ditemukan
        $data_riwayat_sk = DB::table($tbl_riwayat_sk)
            ->where([
                ["id_riwayat_sk", "=", $id_riwayat_sk],
                ["id_pegawai", "=", $id_pegawai],
            ])
            ->first();
        if (!$data_riwayat_sk) {
            return 405;
        }

        $data = DB::table($tbl_riwayat_sk)
            ->where([
                ["id_riwayat_sk", "=", $id_riwayat_sk],
                ["id_pegawai", "=", $id_pegawai],
            ])
            ->leftJoin($tbl_jabatan, "$tbl_jabatan.id_jabatan", "=", "$tbl_riwayat_sk.tugas")
            ->first();

        return $data;
    }

    // Insert Riwayat SK
    public static function insert($req, $id_pegawai)
    {
        // Tabel - tabel
        $tbl_riwayat_sk = "riwayat_sk";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $pegawai = DB::table($tbl_pegawai)->where('id_pegawai', '=', $id_pegawai)->first();
        if (!$pegawai) {
            return 404; // NOT FOUND
        }

        // Cek apakah ada file SK
        if (!$req->file('file')) {
            $file = '';
        } else {
            $file = $req->file("file");

            // Sanitasi nama file
            $sanitize = sanitizeFile($file);
            $file = $file->storeAs("images/surat-kontrak", rand(0, 9999) . time() . '-' . $sanitize);
        }

        if ($req->sk_terkini == 1) {
            // Reset SK Terkini
            self::resetSkTerkini($id_pegawai);
        }

        // Cek status pegawai
        if ($pegawai->id_status_pegawai == 2) {
            // Jika ptth
            $tbl_pegawai2 = "ptth";
            $data = [
                "id_pegawai"        => $id_pegawai,
                "no_sk"             => $req->no_sk,
                "penetap_sk"        => $req->penetap_sk,
                "tgl_penetapan_sk"  => $req->tgl_penetapan_sk,
                "tgl_mulai_tugas"   => $req->tgl_mulai_tugas,
                "tugas"             => $req->tugas,
                "gaji_pokok"        => $req->gaji_pokok,
                "file"              => $file,
                "created_at"        => date("Y-m-d"),
                "updated_at"        => date("Y-m-d"),
                "sk_terkini"        => $req->sk_terkini,
            ];
            $data2 = [
                "no_sk"             => $req->no_sk,
                "penetap_sk"        => $req->penetap_sk,
                "tgl_penetapan_sk"  => $req->tgl_penetapan_sk,
                "tgl_mulai_tugas"   => $req->tgl_mulai_tugas,
                "tugas"             => $req->tugas,
                "gaji_pokok"        => $req->gaji_pokok,
            ];
        } else {
            // Jika pttb
            $tbl_pegawai2 = "pttb";
            $data = [
                "id_pegawai"        => $id_pegawai,
                "no_sk"             => $req->no_sk,
                "penetap_sk"        => $req->penetap_sk,
                "tgl_penetapan_sk"  => $req->tgl_penetapan_sk,
                "tgl_mulai_tugas"   => $req->tgl_mulai_tugas,
                "tugas"             => $req->tugas,
                "kontrak_ke"        => $req->kontrak_ke,
                "masa_kerja"        => $req->masa_kerja,
                "gaji_pokok"        => $req->gaji_pokok,
                "created_at"        => date("Y-m-d"),
                "updated_at"        => date("Y-m-d"),
                "file"              => $file,
                "sk_terkini"        => $req->sk_terkini
            ];
            $data2 = [
                "no_sk"             => $req->no_sk,
                "penetap_sk"        => $req->penetap_sk,
                "tgl_penetapan_sk"  => $req->tgl_penetapan_sk,
                "tgl_mulai_tugas"   => $req->tgl_mulai_tugas,
                "tugas"             => $req->tugas,
                "kontrak_ke"        => $req->kontrak_ke,
                "masa_kerja"        => $req->masa_kerja,
                "gaji_pokok"        => $req->gaji_pokok,
            ];
        }

        // Insert ke tabel riwayat sk
        DB::table($tbl_riwayat_sk)->insert($data);

        // Jika riwayat sk dijadikan sk terkini
        if ($req->sk_terkini == 1) {
            // Update data sk pegawai di tabel ptth atau pttb
            DB::table($tbl_pegawai2)
                ->where("id_pegawai", "=", $id_pegawai)
                ->update($data2);
            // Update data sk pegawai di tabel pegawai
            DB::table($tbl_pegawai)
                ->where("id_pegawai", "=", $id_pegawai)
                ->update(["id_jabatan" => $req->tugas]);
        }

        return true;
    }

    // Upload SK
    public static function upload($req, $id_pegawai) {
        // Tabel - tabel
        $tbl_riwayat_sk = "riwayat_sk";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $pegawai = DB::table($tbl_pegawai)->where('id_pegawai', '=', $id_pegawai)->first();
        if (!$pegawai) {
            return 404; // NOT FOUND
        }

        // Cek apakah ada file SK
        if (!$req->file('file')) {
            $file = '';
        } else {
            $file = $req->file("file");

            // Sanitasi nama file
            $sanitize = sanitizeFile($file);
            $file = $file->storeAs("images/surat-kontrak", rand(0, 9999) . time() . '-' . $sanitize);
        }

        $data = [
            "id_pegawai"        => $req->id_pegawai,
            "no_sk"             => $req->no_sk,
            "file"              => $file,
            "created_at"        => Carbon::now(),
            "updated_at"        => Carbon::now(),
        ];

        // Insert ke tabel riwayat sk
        DB::table($tbl_riwayat_sk)->insert($data);

        return true;
    }

    // Edit Riwayat SK
    public static function edit($req, $id_pegawai, $id_riwayat_sk)
    {
        // Tabel - tabel
        $tbl_riwayat_sk = "riwayat_sk";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $pegawai = DB::table($tbl_pegawai)->where('id_pegawai', '=', $id_pegawai)->first();
        if (!$pegawai) {
            return 404; // NOT FOUND
        }

        // Cek apakah data riwayat_sk ditemukan
        $riwayat_sk = DB::table($tbl_riwayat_sk)->where([
            ['id_riwayat_sk', '=', $id_riwayat_sk],
            ['id_pegawai', '=', $id_pegawai],
        ])->first();
        if (!$riwayat_sk) {
            return 405; // NOT FOUND
        }

        // Cek apakah ada file SK
        if (!$req->file('file')) {
            $file = $riwayat_sk->file;
        } else {
            // Delete file lama
            $path_file = $riwayat_sk->file;
            Storage::delete($path_file);

            $file = $req->file("file");

            // Sanitasi nama file
            $sanitize = sanitizeFile($file);
            $file = $file->storeAs("images/surat-kontrak", rand(0, 9999) . time() . '-' . $sanitize);
        }

        // Reset SK Terkini
        if ($req->sk_terkini == 1) {
            self::resetSkTerkini($id_pegawai);
        }

        // Cek status pegawai
        if ($pegawai->id_status_pegawai == 2) {
            // Jika ptth
            $tbl_pegawai2 = "ptth";
            $data = [
                "no_sk"             => $req->no_sk ? $req->no_sk : $riwayat_sk->no_sk,
                "penetap_sk"        => $req->penetap_sk ? $req->penetap_sk : $riwayat_sk->penetap_sk,
                "tgl_penetapan_sk"  => $req->tgl_penetapan_sk ? $req->tgl_penetapan_sk : $riwayat_sk->tgl_penetapan_sk,
                "tgl_mulai_tugas"   => $req->tgl_mulai_tugas ? $req->tgl_mulai_tugas : $riwayat_sk->tgl_mulai_tugas,
                "tugas"             => $req->tugas ? $req->tugas : $riwayat_sk->tugas,
                "gaji_pokok"        => $req->gaji_pokok ? $req->gaji_pokok : $riwayat_sk->gaji_pokok,
                "sk_terkini"        => $req->sk_terkini ? $req->sk_terkini : $riwayat_sk->sk_terkini,
                "file"              => $file,
                "created_at"        => date("Y-m-d"),
                "updated_at"        => date("Y-m-d"),
            ];
            $data2 = [
                "no_sk"             => $req->no_sk ? $req->no_sk : $riwayat_sk->no_sk,
                "penetap_sk"        => $req->penetap_sk ? $req->penetap_sk : $riwayat_sk->penetap_sk,
                "tgl_penetapan_sk"  => $req->tgl_penetapan_sk ? $req->tgl_penetapan_sk : $riwayat_sk->tgl_penetapan_sk,
                "tgl_mulai_tugas"   => $req->tgl_mulai_tugas ? $req->tgl_mulai_tugas : $riwayat_sk->tgl_mulai_tugas,
                "tugas"             => $req->tugas ? $req->tugas : $riwayat_sk->tugas,
                "gaji_pokok"        => $req->gaji_pokok ? $req->gaji_pokok : $riwayat_sk->gaji_pokok,
            ];
        } else {
            // Jika pttb
            $tbl_pegawai2 = "pttb";
            $data = [
                "no_sk"             => $req->no_sk ? $req->no_sk : $riwayat_sk->no_sk,
                "penetap_sk"        => $req->penetap_sk ? $req->penetap_sk : $riwayat_sk->penetap_sk,
                "tgl_penetapan_sk"  => $req->tgl_penetapan_sk ? $req->tgl_penetapan_sk : $riwayat_sk->tgl_penetapan_sk,
                "tgl_mulai_tugas"   => $req->tgl_mulai_tugas ? $req->tgl_mulai_tugas : $riwayat_sk->tgl_mulai_tugas,
                "tugas"             => $req->tugas ? $req->tugas : $riwayat_sk->tugas,
                "gaji_pokok"        => $req->gaji_pokok ? $req->gaji_pokok : $riwayat_sk->gaji_pokok,
                "kontrak_ke"        => $req->kontrak_ke ? $req->kontrak_ke : $riwayat_sk->kontrak_ke,
                "masa_kerja"        => $req->masa_kerja ? $req->masa_kerja : $riwayat_sk->masa_kerja,
                "sk_terkini"        => $req->sk_terkini ? $req->sk_terkini : $riwayat_sk->sk_terkini,
                "updated_at"        => date("Y-m-d"),
                "file"              => $file
            ];
            $data2 = [
                "no_sk"             => $req->no_sk ? $req->no_sk : $riwayat_sk->no_sk,
                "penetap_sk"        => $req->penetap_sk ? $req->penetap_sk : $riwayat_sk->penetap_sk,
                "tgl_penetapan_sk"  => $req->tgl_penetapan_sk ? $req->tgl_penetapan_sk : $riwayat_sk->tgl_penetapan_sk,
                "tgl_mulai_tugas"   => $req->tgl_mulai_tugas ? $req->tgl_mulai_tugas : $riwayat_sk->tgl_mulai_tugas,
                "tugas"             => $req->tugas ? $req->tugas : $riwayat_sk->tugas,
                "gaji_pokok"        => $req->gaji_pokok ? $req->gaji_pokok : $riwayat_sk->gaji_pokok,
                "kontrak_ke"        => $req->kontrak_ke ? $req->kontrak_ke : $riwayat_sk->kontrak_ke,
                "masa_kerja"        => $req->masa_kerja ? $req->masa_kerja : $riwayat_sk->masa_kerja,
            ];
        }

        DB::table($tbl_riwayat_sk)
            ->where([
                ["id_riwayat_sk", "=", $id_riwayat_sk],
                ["id_pegawai", "=", $id_pegawai],
            ])
            ->update($data);

        // Jika riwayat sk dijadikan sk terkini
        if ($req->sk_terkini == 1) {
            // Update data sk pegawai di tabel ptth atau pttb
            DB::table($tbl_pegawai2)
                ->where("id_pegawai", "=", $id_pegawai)
                ->update($data2);
            // Update data sk pegawai di tabel pegawai
            DB::table($tbl_pegawai)
                ->where("id_pegawai", "=", $id_pegawai)
                ->update(["id_jabatan" => $req->tugas]);
        }

        $edited_data = DB::table($tbl_riwayat_sk)->where("id_riwayat_sk", "=", $id_riwayat_sk)->first();

        return $edited_data;
    }

    // Delete RiwayatSK
    public static function deleteRiwayatSK($id_pegawai, $id_riwayat_sk)
    {
        // Tabel - tabel
        $tbl_riwayat_sk = "riwayat_sk";
        $tbl_pegawai = "pegawai";

        // Cek apakah data pegawai ditemukan
        $pegawai = DB::table($tbl_pegawai)->where('id_pegawai', '=', $id_pegawai)->first();
        if (!$pegawai) {
            return 404; // NOT FOUND
        }

        // Cek apakah data riwayat_sk ditemukan
        $riwayat_sk = DB::table($tbl_riwayat_sk)->where([
            ['id_riwayat_sk', '=', $id_riwayat_sk],
            ['id_pegawai', '=', $id_pegawai],
        ])->first();
        if (!$riwayat_sk) {
            return 405; // NOT FOUND
        }

        // Delete data riwayat_sk
        DB::table($tbl_riwayat_sk)
            ->where([
                ['id_riwayat_sk', '=', $id_riwayat_sk],
                ['id_pegawai', '=', $id_pegawai],
            ])
            ->delete();

        // Hapus file sk
        $path_file = $riwayat_sk->file;
        Storage::delete($path_file);

        return true;
    }

    // Reset SK Terkini golongan
    public static function resetSkTerkini($id_pegawai)
    {
        return DB::table(self::$tbl)
            ->where("id_pegawai", "=", $id_pegawai)
            ->update(["sk_terkini" => 0]);
    }
}
