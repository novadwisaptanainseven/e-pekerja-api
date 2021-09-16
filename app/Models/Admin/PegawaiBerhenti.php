<?php

namespace App\Models\Admin;

use App\Models\Admin\Pegawai\PTTB;
use App\Models\Admin\Pegawai\PTTH;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PegawaiBerhenti extends Model
{
    use HasFactory;

    protected static $tbl = "pegawai_berhenti";
    protected static $tbl_ptth = "ptth";
    protected static $tbl_pttb = "pttb";
    protected static $tbl_pegawai = "pegawai";
    protected static $tbl_status_pegawai = "status_pegawai";
    protected $table = "pegawai_berhenti";
    protected $primaryKey = "id_pegawai_berhenti";
    protected $guarded = [];

    public static function getAll()
    {
        $data = DB::table(self::$tbl)
            ->select(
                self::$tbl . ".*",
                self::$tbl_pegawai . ".nama",
                self::$tbl_pegawai . ".nip",
                self::$tbl_pegawai . ".id_status_pegawai",
                self::$tbl_status_pegawai . ".status_pegawai",
            )
            ->join(self::$tbl_pegawai, self::$tbl_pegawai . ".id_pegawai", "=", self::$tbl . ".id_pegawai")
            ->join(self::$tbl_status_pegawai, self::$tbl_status_pegawai . ".id_status_pegawai", "=", self::$tbl_pegawai . ".id_status_pegawai")
            ->orderByDesc(self::$tbl . ".created_at")
            ->get();

        foreach ($data as $i => $d) {
            $d->no = $i + 1;

            if ($d->id_status_pegawai == 2) {
                $data_ptth = DB::table(self::$tbl_ptth)->where("id_pegawai", $d->id_pegawai)->first();
                $d->nip = $data_ptth->nik;
            }

            // Cek status berhenti pegawai
            $curTs = time();
            $tglBerhentiTs = strtotime($d->tgl_berhenti);

            if ($curTs < $tglBerhentiTs) {
                $d->status_berhenti = "akan-berhenti";
            } else {
                $d->status_berhenti = "berhenti";
            }
        }

        return $data;
    }
}
