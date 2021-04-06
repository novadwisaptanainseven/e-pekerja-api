<?php

namespace App\Models\Admin\Pegawai;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class PNS extends Model
{
    use HasFactory;

    protected $table = "pegawai";
    protected $primaryKey = "id_pegawai";

    // Get All Pegawai (PNS, PTTH, PTTB)
    public static function getAllPegawai()
    {
        // Tabel - tabel
        $tbl_pegawai = "pegawai";
        $tbl_agama = "agama";
        $tbl_status_pegawai = "status_pegawai";
        $tbl_bidang = "bidang";
        $tbl_pangkat_golongan = "pangkat_golongan";
        $tbl_pangkat_eselon = "pangkat_eselon";
        $tbl_jabatan = "jabatan";
        $tbl_ptth = "ptth";

        $data = DB::table($tbl_pegawai)
            ->select(
                "$tbl_pegawai.*",
                "$tbl_agama.agama",
                "$tbl_status_pegawai.status_pegawai",
                "$tbl_status_pegawai.keterangan AS ket_status_pegawai",
                "$tbl_bidang.nama_bidang AS bidang",
                "$tbl_pangkat_golongan.golongan",
                "$tbl_pangkat_golongan.keterangan AS ket_golongan",
                "$tbl_pangkat_eselon.eselon",
                "$tbl_pangkat_eselon.keterangan AS ket_eselon",
                "$tbl_jabatan.nama_jabatan AS jabatan",
            )
            ->leftJoin($tbl_agama, "$tbl_agama.id_agama", "=", "$tbl_pegawai.id_agama")
            ->leftJoin($tbl_status_pegawai, "$tbl_status_pegawai.id_status_pegawai", "=", "$tbl_pegawai.id_status_pegawai")
            ->leftJoin($tbl_bidang, "$tbl_bidang.id_bidang", "=", "$tbl_pegawai.id_bidang")
            ->leftJoin($tbl_pangkat_golongan, "$tbl_pangkat_golongan.id_pangkat_golongan", "=", "$tbl_pegawai.id_golongan")
            ->leftJoin($tbl_pangkat_eselon, "$tbl_pangkat_eselon.id_pangkat_eselon", "=", "$tbl_pegawai.id_eselon")
            ->leftJoin($tbl_jabatan, "$tbl_jabatan.id_jabatan", "=", "$tbl_pegawai.id_jabatan")
            ->orderBy("$tbl_status_pegawai.id_status_pegawai", "asc")
            ->where("$tbl_pegawai.status_kerja", "=", "aktif")
            ->get();

        foreach ($data as $d) {
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
            // $d->test = "Hello";
        }

        return $data;
    }

    // Get All Pegawai
    public static function getAll()
    {
        // Tabel - tabel
        $tbl_pegawai = "pegawai";
        $tbl_agama = "agama";
        $tbl_status_pegawai = "status_pegawai";
        $tbl_bidang = "bidang";
        $tbl_pangkat_golongan = "pangkat_golongan";
        $tbl_pangkat_eselon = "pangkat_eselon";
        $tbl_jabatan = "jabatan";

        $data = DB::table($tbl_pegawai)
            ->select(
                "$tbl_pegawai.*",
                "$tbl_agama.agama",
                "$tbl_status_pegawai.status_pegawai",
                "$tbl_status_pegawai.keterangan AS ket_status_pegawai",
                "$tbl_pangkat_golongan.golongan",
                "$tbl_pangkat_golongan.keterangan AS ket_golongan",
                "$tbl_pangkat_eselon.eselon",
                "$tbl_pangkat_eselon.keterangan AS ket_eselon",
                "$tbl_jabatan.nama_jabatan AS jabatan",
                "$tbl_bidang.nama_bidang AS bidang",
            )
            ->where("$tbl_pegawai.id_status_pegawai", "=", 1)
            ->leftJoin($tbl_agama, "$tbl_agama.id_agama", "=", "$tbl_pegawai.id_agama")
            ->leftJoin($tbl_status_pegawai, "$tbl_status_pegawai.id_status_pegawai", "=", "$tbl_pegawai.id_status_pegawai")
            ->leftJoin($tbl_bidang, "$tbl_bidang.id_bidang", "=", "$tbl_pegawai.id_bidang")
            ->leftJoin($tbl_pangkat_golongan, "$tbl_pangkat_golongan.id_pangkat_golongan", "=", "$tbl_pegawai.id_golongan")
            ->leftJoin($tbl_pangkat_eselon, "$tbl_pangkat_eselon.id_pangkat_eselon", "=", "$tbl_pegawai.id_eselon")
            ->leftJoin($tbl_jabatan, "$tbl_jabatan.id_jabatan", "=", "$tbl_pegawai.id_jabatan")
            ->where("$tbl_pegawai.status_kerja", "=", "aktif")
            ->get();

        return $data;
    }

    // Get data TTD Kepala Dinas
    public static function getDataKadis()
    {
        // Tabel - tabel
        $tbl_pegawai = "pegawai";
        $tbl_agama = "agama";
        $tbl_status_pegawai = "status_pegawai";
        $tbl_bidang = "bidang";
        $tbl_pangkat_golongan = "pangkat_golongan";
        $tbl_pangkat_eselon = "pangkat_eselon";
        $tbl_jabatan = "jabatan";

        $data = DB::table($tbl_pegawai)
            ->select(
                "$tbl_pegawai.*",
                "$tbl_agama.agama",
                "$tbl_status_pegawai.status_pegawai",
                "$tbl_status_pegawai.keterangan AS ket_status_pegawai",
                "$tbl_pangkat_golongan.golongan",
                "$tbl_pangkat_golongan.keterangan AS ket_golongan",
                "$tbl_pangkat_eselon.eselon",
                "$tbl_pangkat_eselon.keterangan AS ket_eselon",
                "$tbl_jabatan.nama_jabatan AS jabatan",
                "$tbl_bidang.nama_bidang AS bidang",
            )
            ->where("$tbl_pegawai.id_jabatan", "=", 1)
            ->leftJoin($tbl_agama, "$tbl_agama.id_agama", "=", "$tbl_pegawai.id_agama")
            ->leftJoin($tbl_status_pegawai, "$tbl_status_pegawai.id_status_pegawai", "=", "$tbl_pegawai.id_status_pegawai")
            ->leftJoin($tbl_bidang, "$tbl_bidang.id_bidang", "=", "$tbl_pegawai.id_bidang")
            ->leftJoin($tbl_pangkat_golongan, "$tbl_pangkat_golongan.id_pangkat_golongan", "=", "$tbl_pegawai.id_golongan")
            ->leftJoin($tbl_pangkat_eselon, "$tbl_pangkat_eselon.id_pangkat_eselon", "=", "$tbl_pegawai.id_eselon")
            ->leftJoin($tbl_jabatan, "$tbl_jabatan.id_jabatan", "=", "$tbl_pegawai.id_jabatan")
            ->orderBy("$tbl_pegawai.id_pegawai", "asc")
            ->first();

        return $data;
    }

    // Get PNS By Id
    public static function getById($id)
    {
        // Tabel - tabel
        $tbl_pegawai = "pegawai";
        $tbl_agama = "agama";
        $tbl_status_pegawai = "status_pegawai";
        $tbl_bidang = "bidang";
        $tbl_pangkat_golongan = "pangkat_golongan";
        $tbl_pangkat_eselon = "pangkat_eselon";
        $tbl_jabatan = "jabatan";
        $tbl_masa_kerja = "masa_kerja_pegawai";
        $tbl_kgb = "kgb";

        $data_pegawai = DB::table($tbl_pegawai)
            ->select(
                "$tbl_pegawai.*",
                "$tbl_agama.agama",
                "$tbl_status_pegawai.status_pegawai",
                "$tbl_status_pegawai.keterangan AS ket_status_pegawai",
                "$tbl_bidang.nama_bidang AS bidang",
                "$tbl_pangkat_golongan.golongan",
                "$tbl_pangkat_golongan.keterangan AS ket_golongan",
                "$tbl_pangkat_eselon.eselon",
                "$tbl_pangkat_eselon.keterangan AS ket_eselon",
                "$tbl_jabatan.nama_jabatan AS jabatan",
            )
            ->where("$tbl_pegawai.id_pegawai", '=', $id)
            ->leftJoin($tbl_agama, "$tbl_agama.id_agama", "=", "$tbl_pegawai.id_agama")
            ->leftJoin($tbl_status_pegawai, "$tbl_status_pegawai.id_status_pegawai", "=", "$tbl_pegawai.id_status_pegawai")
            ->leftJoin($tbl_bidang, "$tbl_bidang.id_bidang", "=", "$tbl_pegawai.id_bidang")
            ->leftJoin($tbl_pangkat_golongan, "$tbl_pangkat_golongan.id_pangkat_golongan", "=", "$tbl_pegawai.id_golongan")
            ->leftJoin($tbl_pangkat_eselon, "$tbl_pangkat_eselon.id_pangkat_eselon", "=", "$tbl_pegawai.id_eselon")
            ->leftJoin($tbl_jabatan, "$tbl_jabatan.id_jabatan", "=", "$tbl_pegawai.id_jabatan")
            ->first();

        // Cek apakah data pegawai ditemukan
        if ($data_pegawai) {

            $data_masa_kerja = DB::table($tbl_masa_kerja)->where('id_pegawai', '=', $id)->first();

            if ($data_masa_kerja) {
                $data_pegawai->mk_jabatan = $data_masa_kerja->mk_jabatan;
                $data_pegawai->mk_sebelum_cpns = $data_masa_kerja->mk_sebelum_cpns;
                $data_pegawai->mk_golongan = $data_masa_kerja->mk_golongan;
                $data_pegawai->mk_seluruhnya = $data_masa_kerja->mk_seluruhnya;
            }

            // if ($data_pegawai->gaji_pokok == 0) {
            //     $data_kgb = DB::table($tbl_kgb)
            //         ->where('id_pegawai', "=", $id)
            //         ->orderBy("id_kgb", "desc")
            //         ->first();
            //     $data_pegawai->gaji_pokok = $data_kgb->gaji_pokok_baru;
            // }

            $data_kgb = DB::table($tbl_kgb)
                ->where('id_pegawai', "=", $id)
                ->orderBy("id_kgb", "desc")
                ->first();

            if ($data_kgb) {
                $data_pegawai->gaji_pokok = $data_kgb->gaji_pokok_baru;
            }


            return $data_pegawai;
        } else {
            return null;
        }
    }

    // Insert PNS
    public static function insert($req)
    {
        // Tabel - tabel
        $tbl_pegawai = "pegawai";
        $tbl_masa_kerja_pegawai = "masa_kerja_pegawai";
        $tbl_pendidikan = "pendidikan";
        $tbl_duk_pegawai = "duk_pegawai";
        $tbl_users = "users";

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
            "nama"              => $req->nama,
            'id_jabatan'        => $req->id_jabatan,
            'id_bidang'     => $req->id_bidang,
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
            'gaji_pokok'        => $req->gaji_pokok,
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

        // Tambah data duk pegawai
        $data_duk_pegawai = [
            'id_pegawai'      => $id_pegawai,
        ];
        DB::table($tbl_duk_pegawai)->insert($data_duk_pegawai);

        // Generate password akun pegawai
        $password = explode("-", $req->tgl_lahir);
        $password2 = $password[2] . $password[1] . $password[0];
        // Register akun pegawai
        $data_user = [
            "id_pegawai" => $id_pegawai,
            "name"       => $req->nama,
            "username"   => $req->nip,
            "level"      => 2,
            "password"   => Hash::make($password2),
            "foto_profil" => $foto
        ];
        DB::table($tbl_users)->insert($data_user);

        return true;
    }

    // Edit PNS
    public static function edit($req, $id_pegawai)
    {
        // Tabel - tabel
        $tbl_pegawai = "pegawai";

        // Get data pegawai by id
        $data_pegawai = DB::table($tbl_pegawai)->where('id_pegawai', '=', $id_pegawai)->first();

        // Cek apakah data pegawai ditemukan
        if (!$data_pegawai) {
            return 404;
        }

        // Cek apakah ada file foto
        if (!$req->file('foto')) {
            $foto = $data_pegawai->foto;
        } else {
            // Delete foto lama
            $path_foto = $data_pegawai->foto;
            Storage::delete($path_foto);

            $file = $req->file("foto");

            // Sanitasi nama file
            $sanitize = sanitizeFile($file);
            $foto = $file->storeAs("images/foto", rand(0, 9999) . time() . '-' . $sanitize);
        }

        // Proses Edit Data
        $data_pegawai = [
            "nip"               => $req->nip ? $req->nip : $data_pegawai->nip,
            "nama"              => $req->nama ? $req->nama : $data_pegawai->nama,
            'id_jabatan'        => $req->id_jabatan ? $req->id_jabatan : $data_pegawai->id_jabatan,
            'id_bidang'     => $req->id_bidang ? $req->id_bidang : $data_pegawai->id_bidang,
            'id_golongan'       => $req->id_golongan ? $req->id_golongan : $data_pegawai->id_golongan,
            'id_eselon'         => $req->id_eselon ? $req->id_eselon : $data_pegawai->id_eselon,
            'id_agama'          => $req->id_agama ? $req->id_agama : $data_pegawai->id_agama,
            'id_status_pegawai' => 1,
            'tempat_lahir'      => $req->tempat_lahir ? $req->tempat_lahir : $data_pegawai->tempat_lahir,
            'tgl_lahir'         => $req->tgl_lahir ? $req->tgl_lahir : $data_pegawai->tgl_lahir,
            'alamat'            => $req->alamat ? $req->alamat : $data_pegawai->alamat,
            'jenis_kelamin'     => $req->jenis_kelamin ? $req->jenis_kelamin : $data_pegawai->jenis_kelamin,
            'karpeg'            => $req->karpeg ? $req->karpeg : $data_pegawai->karpeg,
            'bpjs'              => $req->bpjs ? $req->bpjs : $data_pegawai->bpjs,
            'npwp'              => $req->npwp ? $req->npwp : $data_pegawai->npwp,
            'tmt_golongan'      => $req->tmt_golongan ? $req->tmt_golongan : $data_pegawai->tmt_golongan,
            'tmt_cpns'          => $req->tmt_cpns ? $req->tmt_cpns : $data_pegawai->tmt_cpns,
            'tmt_jabatan'       => $req->tmt_jabatan ? $req->tmt_jabatan : $data_pegawai->tmt_jabatan,
            'no_hp'             => $req->no_hp ? $req->no_hp : $data_pegawai->no_hp,
            'gaji_pokok'        => $req->gaji_pokok ? $req->gaji_pokok : $data_pegawai->gaji_pokok,
            'foto'              => $foto,
        ];
        DB::table($tbl_pegawai)->where('id_pegawai', '=', $id_pegawai)->update($data_pegawai);

        // Get data pegawai setelah diupdate
        $data_pegawai_updated = DB::table($tbl_pegawai)->where('id_pegawai', '=', $id_pegawai)->first();

        return $data_pegawai_updated;
    }

    // Delete PNS
    public static function deletePegawai($id)
    {
        // Tabel - tabel
        $tbl_pegawai = "pegawai";

        // Cek apakah data ditemukan
        $pegawai = DB::table($tbl_pegawai)->where('id_pegawai', '=', $id)->first();
        if (!$pegawai) {
            return 404; // NOT FOUND
        }

        // Hapus foto pegawai
        $path_foto = $pegawai->foto;
        Storage::delete($path_foto);

        $cek_delete = DB::table($tbl_pegawai)->where('id_pegawai', '=', $id)->delete();

        // Cek apakah proses delete berhasil
        if ($cek_delete) {
            return $cek_delete;
        } else {
            return 500;
        }
    }
}
