<?php

namespace App\Models\Admin\Pegawai;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PTTB extends Model
{
    use HasFactory;

    protected $table = "pttb";
    protected $primaryKey = "id_pttb";

    // Get All PTTB
    public static function getAll()
    {
        // Tabel - tabel
        $tbl_pegawai = "pegawai";
        $tbl_agama = "agama";
        $tbl_status_pegawai = "status_pegawai";
        $tbl_bidang = "bidang";
        $tbl_jabatan = "jabatan";
        $tbl_pttb = "pttb";

        $data = DB::table($tbl_pegawai)
            ->select(
                "$tbl_pegawai.nama",
                "$tbl_pegawai.tempat_lahir",
                "$tbl_pegawai.tgl_lahir",
                "$tbl_pegawai.alamat",
                "$tbl_pegawai.jenis_kelamin",
                "$tbl_pegawai.bpjs",
                "$tbl_pegawai.npwp",
                "$tbl_pegawai.no_hp",
                "$tbl_pegawai.email",
                "$tbl_pegawai.no_ktp",
                "$tbl_pegawai.foto",
                "$tbl_pttb.*",
                "$tbl_agama.agama",
                "$tbl_status_pegawai.status_pegawai",
                "$tbl_status_pegawai.keterangan AS ket_status_pegawai",
                "$tbl_bidang.nama_bidang AS bidang",
                "$tbl_jabatan.nama_jabatan AS jabatan",
            )
            ->where("$tbl_pegawai.id_status_pegawai", '=', 3)
            ->leftJoin($tbl_agama, "$tbl_agama.id_agama", "=", "$tbl_pegawai.id_agama")
            ->leftJoin($tbl_status_pegawai, "$tbl_status_pegawai.id_status_pegawai", "=", "$tbl_pegawai.id_status_pegawai")
            ->leftJoin($tbl_bidang, "$tbl_bidang.id_bidang", "=", "$tbl_pegawai.id_bidang")
            ->leftJoin($tbl_jabatan, "$tbl_jabatan.id_jabatan", "=", "$tbl_pegawai.id_jabatan")
            ->leftJoin($tbl_pttb, "$tbl_pttb.id_pegawai", "=", "$tbl_pegawai.id_pegawai")
            ->where("$tbl_pegawai.status_kerja", "=", "aktif")
            ->orderBy("$tbl_pegawai.id_pegawai", 'DESC')
            ->get();

        return $data;
    }

    // Get PTTB By Id
    public static function getById($id)
    {
        // Tabel - tabel
        $tbl_pegawai = "pegawai";
        $tbl_agama = "agama";
        $tbl_status_pegawai = "status_pegawai";
        $tbl_bidang = "bidang";
        $tbl_jabatan = "jabatan";
        $tbl_pttb = "pttb";
        $tbl_bidang = "bidang";

        $data = DB::table($tbl_pegawai)
            ->select(
                "$tbl_pegawai.nama",
                "$tbl_pegawai.tempat_lahir",
                "$tbl_pegawai.tgl_lahir",
                "$tbl_pegawai.alamat",
                "$tbl_pegawai.jenis_kelamin",
                "$tbl_pegawai.bpjs",
                "$tbl_pegawai.npwp",
                "$tbl_pegawai.no_hp",
                "$tbl_pegawai.email",
                "$tbl_pegawai.no_ktp",
                "$tbl_pegawai.foto",
                "$tbl_pttb.*",
                "$tbl_agama.*",
                "$tbl_status_pegawai.status_pegawai",
                "$tbl_status_pegawai.keterangan AS ket_status_pegawai",
                "$tbl_bidang.nama_bidang AS bidang",
                "$tbl_bidang.id_bidang",
                "$tbl_bidang.*",
                "$tbl_jabatan.nama_jabatan AS jabatan",
                "$tbl_jabatan.id_jabatan",
            )
            ->where([
                ["$tbl_pegawai.id_pegawai", '=', $id],
                ["$tbl_pegawai.id_status_pegawai", '=', 3]
            ])
            ->leftJoin($tbl_agama, "$tbl_agama.id_agama", "=", "$tbl_pegawai.id_agama")
            ->leftJoin($tbl_status_pegawai, "$tbl_status_pegawai.id_status_pegawai", "=", "$tbl_pegawai.id_status_pegawai")
            ->leftJoin($tbl_jabatan, "$tbl_jabatan.id_jabatan", "=", "$tbl_pegawai.id_jabatan")
            ->leftJoin($tbl_pttb, "$tbl_pttb.id_pegawai", "=", "$tbl_pegawai.id_pegawai")
            ->leftJoin($tbl_bidang, "$tbl_bidang.id_bidang", "=", "$tbl_pegawai.id_bidang")
            ->first();

        // Cek apakah data pegawai ditemukan
        if ($data) {
            return $data;
        } else {
            return null;
        }
    }

    // Insert PTTB
    public static function insert($req)
    {
        // Tabel - tabel
        $tbl_pegawai = "pegawai";
        $tbl_pendidikan = "pendidikan";
        $tbl_pttb = "pttb";
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
            "nip"                => $req->nip,
            "nama"               => $req->nama,
            'id_bidang'          => $req->id_bidang,
            'id_jabatan'         => $req->id_jabatan,
            'id_agama'           => $req->id_agama,
            'tempat_lahir'       => $req->tempat_lahir,
            'tgl_lahir'          => $req->tgl_lahir,
            'alamat'             => $req->alamat,
            'jenis_kelamin'      => $req->jenis_kelamin,
            'bpjs'               => $req->bpjs,
            'npwp'               => $req->npwp,
            'no_hp'              => $req->no_hp,
            'email'              => $req->email,
            'no_ktp'             => $req->no_ktp,
            'foto'               => $foto,
            "id_status_pegawai"  => 3
        ];
        $insert_pegawai = DB::table($tbl_pegawai)->insert($data_pegawai);
        $id_pegawai = DB::table($tbl_pegawai)->orderBy("id_pegawai", 'desc')->first()->id_pegawai;

        // Tambah data ptth
        $data_pttb = [
            'nip'                => $req->nip,
            'id_pegawai'         => $id_pegawai,
            'penetap_sk'         => $req->penetap_sk,
            'tgl_penetapan_sk'   => $req->tgl_penetapan_sk,
            'no_sk'              => $req->no_sk,
            'kontrak_ke'         => $req->kontrak_ke,
            'masa_kerja'         => $req->masa_kerja,
            'tgl_mulai_tugas'    => $req->tgl_mulai_tugas,
            'tugas'              => $req->tugas,
            'gaji_pokok'         => $req->gaji_pokok
        ];
        DB::table($tbl_pttb)->insert($data_pttb);

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

        return $insert_pegawai;
    }

    // Edit PTTH
    public static function edit($req, $id_pegawai)
    {
        // Tabel - tabel
        $tbl_pegawai = "pegawai";
        $tbl_pttb = "pttb";

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
        $data_pegawai2 = [
            "nip"                => $req->nip ? $req->nip : $data_pegawai->nip,
            "nama"               => $req->nama ? $req->nama : $data_pegawai->nama,
            'id_bidang'          => $req->id_bidang ? $req->id_bidang : $data_pegawai->id_bidang,
            'id_jabatan'         => $req->id_jabatan ? $req->id_jabatan : $data_pegawai->id_jabatan,
            'id_agama'           => $req->id_agama ? $req->id_agama : $data_pegawai->id_agama,
            'tempat_lahir'       => $req->tempat_lahir ? $req->tempat_lahir : $data_pegawai->tempat_lahir,
            'tgl_lahir'          => $req->tgl_lahir ? $req->tgl_lahir : $data_pegawai->tgl_lahir,
            'alamat'             => $req->alamat ? $req->alamat : $data_pegawai->alamat,
            'jenis_kelamin'      => $req->jenis_kelamin ? $req->jenis_kelamin : $data_pegawai->jenis_kelamin,
            'bpjs'               => $req->bpjs ? $req->bpjs : $data_pegawai->bpjs,
            'npwp'               => $req->npwp ? $req->npwp : $data_pegawai->npwm,
            'no_hp'              => $req->no_hp ? $req->no_hp : $data_pegawai->no_hp,
            'email'              => $req->email ? $req->email : $data_pegawai->email,
            'no_ktp'             => $req->no_ktp ? $req->no_ktp : $data_pegawai->no_ktp,
            'foto'               => $foto,
            "id_status_pegawai"  => 3
        ];
        $data_pttb = [
            "nip"                => $req->nip ? $req->nip : $data_pegawai->nip,
            'penetap_sk'         => $req->penetap_sk ? $req->penetap_sk : $data_pegawai->penetap_sk,
            'tgl_penetapan_sk'   => $req->tgl_penetapan_sk ? $req->tgl_penetapan_sk : $data_pegawai->tgl_penetapan_sk,
            'no_sk'              => $req->no_sk ? $req->no_sk : $data_pegawai->no_sk,
            'kontrak_ke'         => $req->kontrak_ke ? $req->kontrak_ke : $data_pegawai->kontrak_ke,
            'masa_kerja'         => $req->masa_kerja ? $req->masa_kerja : $data_pegawai->masa_kerja,
            'tgl_mulai_tugas'    => $req->tgl_mulai_tugas ? $req->tgl_mulai_tugas : $data_pegawai->tgl_mulai_tugas,
            'tugas'              => $req->tugas ? $req->tugas : $data_pegawai->tugas,
            'gaji_pokok'         => $req->gaji_pokok ? $req->gaji_pokok : $data_pegawai->gaji_pokok,
        ];

        // Update data di tabel pegawai
        DB::table($tbl_pegawai)->where('id_pegawai', '=', $id_pegawai)->update($data_pegawai2);
        // Update data di tabel pttb
        DB::table($tbl_pttb)->where('id_pegawai', '=', $id_pegawai)->update($data_pttb);

        // Get data pegawai setelah diupdate
        $data_pegawai_updated = DB::table($tbl_pegawai)
            ->where("$tbl_pegawai.id_pegawai", '=', $id_pegawai)
            ->leftJoin($tbl_pttb, "$tbl_pttb.id_pegawai", '=', "$tbl_pegawai.id_pegawai")
            ->first();

        return $data_pegawai_updated;
    }

    // Delete PNS
    public static function deletePegawai($id)
    {
        // Tabel - tabel
        $tbl_pegawai = "pegawai";
        $tbl_pttb = "pttb";

        // Cek apakah data ditemukan
        $pttb = DB::table($tbl_pttb)->where('id_pegawai', '=', $id)->first();
        if (!$pttb) {
            return 404; // NOT FOUND
        }

        $pegawai = DB::table($tbl_pegawai)->where('id_pegawai', '=', $id)->first();

        // Hapus foto pegawai
        $path_foto = $pegawai->foto;
        Storage::delete($path_foto);

        // Delete table child
        $cek_delete = DB::table($tbl_pttb)->where('id_pegawai', '=', $id)->delete();
        // Delete table parent
        DB::table($tbl_pegawai)->where('id_pegawai', '=', $id)->delete();

        // Cek apakah proses delete berhasil
        if ($cek_delete) {
            return $cek_delete;
        } else {
            return 500;
        }
    }
}
