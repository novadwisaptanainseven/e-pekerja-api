<?php

namespace App\Models\Admin;

use App\Models\Admin\Pegawai\PNS;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RiwayatGolongan extends Model
{
    use HasFactory;

    protected $table = "rw_golongan";
    protected static $tbl = "rw_golongan";
    protected static $tbl_golongan = "pangkat_golongan";
    protected $primaryKey = "id_rw_golongan";
    protected $guarded = [];

    // Get all riwayat golonga by id pegawai
    public static function get($id_pegawai)
    {
        $tbl = self::$tbl;
        $tbl_golongan = self::$tbl_golongan;

        $pegawai = PNS::find($id_pegawai);

        $rwg = DB::table(self::$tbl)
            ->join($tbl_golongan, "$tbl_golongan.id_pangkat_golongan", "=", "$tbl.id_golongan")
            ->where("$tbl.id_pegawai", $id_pegawai)
            ->orderBy("$tbl.created_at", "desc")
            ->get();

        $data = [
            "pegawai" => $pegawai,
            "data" => $rwg
        ];

        return $data;
    }

    // Reset pangkat terkini golongan
    public static function resetPangkatTerkini($id)
    {
        return DB::table(self::$tbl)->where("id_rw_golongan", "<>", $id)->update(["pangkat_terkini" => 0]);
    }

    // Reset pangkat terkini golongan without id
    public static function resetPangkatTerkini2()
    {
        return DB::table(self::$tbl)->update(["pangkat_terkini" => 0]);
    }
}
