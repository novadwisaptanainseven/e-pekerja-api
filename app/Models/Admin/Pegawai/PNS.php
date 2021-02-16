<?php

namespace App\Models\Admin\Pegawai;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class PNS extends Model
{
    use HasFactory;

    protected $table = "pegawai";
    protected $primaryKey = "id_pegawai";

    // Insert PNS
    public static function insert($req)
    {
        // Tabel - tabel
        $tbl_pegawai = "pegawai";
        $tbl_masa_kerja_pegawai = "masa_kerja_pegawai";
        $tbl_pendidikan = "pendidikan";

        // Cek apakah ada file foto
        if (!$req->file('foto')) {
            $foto = '';
        } else {
            $file = $req->file("foto");

            // Sanitasi nama file
            $sanitize = sanitizeFile($file);
            $foto = $file->storeAs("images/foto", rand(0, 9999) . time() . '-' . $sanitize);
        }

        // Cek apakah ada file foto_ijazah
        if (!$req->file('foto_ijazah')) {
            $foto_ijazah = '';
        } else {
            $file = $req->file("foto_ijazah");

            // Sanitasi nama file
            $sanitize = sanitizeFile($file);
            $foto_ijazah = $file->storeAs("images/ijazah", rand(0, 9999) . time() . '-' . $sanitize);
        }

        // Proses Tambah Data

        $data_pegawai = [
            "nip"               => $req->nip,
            "nama"              => $req->nip,
            'id_jabatan'        => $req->id_jabatan,
            'id_sub_bidang'     => $req->id_sub_bidang,
            'id_golongan'       => $req->id_golongan,
            'id_eselon'         => $req->id_eselon,
            'id_agama'          => $req->id_agama,
            'id_status_pegawai' => 1,
            'tempat_lahir'      => $req->tempat_lahir,
            'tgl_lahir'         => $req->tgl_lahir,
            'alamat'            => $req->alamat,
            'jenis_kelamin'     => $req->jenis_kelamin,
            'karpeg'            => $req->karpeg,
            'bpjs'              => $req->bpjs,
            'npwp'              => $req->npwp,
            'tmt_golongan'      => $req->tmt_golongan,
            'tmt_cpns'          => $req->tmt_cpns,
            'tmt_jabatan'       => $req->tmt_jabatan,
            'no_hp'             => $req->no_hp,
            'foto'              => $foto,
        ];
        $insert_pegawai = DB::table($tbl_pegawai)->insert($data_pegawai);
        $id_pegawai = DB::table($tbl_pegawai)->orderBy("id_pegawai", 'desc')->first()->id_pegawai;

        // Tambah data masa kerja
        $data_masa_kerja = [
            'id_pegawai'      => $id_pegawai,
            'mk_jabatan'      => $req->mk_jabatan,
            'mk_sebelum_cpns' => $req->mk_sebelum_cpns,
            'mk_golongan'     => $req->mk_golongan,
            'mk_seluruhnya'   => $req->mk_seluruhnya,
        ];
        DB::table($tbl_masa_kerja_pegawai)->insert($data_masa_kerja);

        // Tambah data pendidikan
        $data_pendidikan = [
            'id_pegawai'      => $id_pegawai,
            'nama_akademi'    => $req->nama_akademi,
            'tahun_lulus'     => $req->tahun_lulus,
            'jenjang'         => $req->jenjang,
            'jurusan'         => $req->jurusan,
            'no_ijazah'       => $req->no_ijazah,
            'foto_ijazah'     => $foto_ijazah,
        ];
        DB::table($tbl_pendidikan)->insert($data_pendidikan);

        return $insert_pegawai;
    }
}
