<?php

namespace App\Models\Admin\Pegawai;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use stdClass;

class PNS extends Model
{
    use HasFactory;

    protected $table = "pegawai";
    protected $primaryKey = "id_pegawai";
    protected $guarded = [];

    // Get All Pegawai (PNS, PTTH, PTTB)
    public static function getAllPegawai($req = null)
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
        $tbl_pendidikan = "pendidikan";

        $whereStatement = [
            ["$tbl_pegawai.status_kerja", "=", "aktif"]
        ];
        $columnOrder = "$tbl_pegawai.id_pegawai";
        $order = $req && $req->order ? $req->order : "asc";
        // Cek filter by column
        // Jika ada request filternya adalah kolom
        if ($req && $req->kolom) {
            switch ($req->kolom) {
                case "nama":
                    $columnOrder = "$tbl_pegawai.nama";
                    break;
                case "jabatan":
                    $columnOrder = "$tbl_jabatan.id_jabatan";
                    break;
                case "bidang":
                    $columnOrder = "$tbl_bidang.id_bidang";
                    break;
                case "status-pegawai":
                    $columnOrder = "$tbl_status_pegawai.id_status_pegawai";
                    break;
                default:
                    $columnOrder = "$tbl_status_pegawai.id_status_pegawai";
                    break;
            }
        }
        // Jika ada request filternya adalah status_pegawai
        if ($req && $req->status_pegawai) {
            $whereStatement = [
                ["$tbl_pegawai.status_kerja", "=", "aktif"],
                ["$tbl_status_pegawai.status_pegawai", "=", $req->status_pegawai]
            ];
        }

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
            ->where($whereStatement)
            ->orderBy($columnOrder, $order)
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

        $output = [];
        // Jika ada request filternya adalah jenjang pendidikan
        if ($req && $req->jenjang) {
            foreach ($data as $d) {
                $pend = DB::table($tbl_pendidikan)
                    ->where("id_pegawai", "=", $d->id_pegawai)
                    ->orderByDesc("id_pegawai")
                    ->first();
                if ($pend->jenjang == $req->jenjang) {
                    $d->pendidikan = $pend;
                    array_push($output, $d);
                }
            }
        } else {
            $output = $data;
        }

        return $output;
    }

    // Get All Pegawai
    public static function getAll($req = null)
    {
        // Tabel - tabel
        $tbl_pegawai = "pegawai";
        $tbl_agama = "agama";
        $tbl_status_pegawai = "status_pegawai";
        $tbl_bidang = "bidang";
        $tbl_pangkat_golongan = "pangkat_golongan";
        $tbl_pangkat_eselon = "pangkat_eselon";
        $tbl_jabatan = "jabatan";
        $tbl_pendidikan = "pendidikan";

        $columnOrder = "$tbl_pegawai.id_pegawai";
        $order = $req && $req->order ? $req->order : "asc";
        // Cek filter by column
        if ($req) {
            switch ($req->kolom) {
                case "nama":
                    $columnOrder = "$tbl_pegawai.nama";
                    break;
                case "jabatan":
                    $columnOrder = "$tbl_jabatan.id_jabatan";
                    break;
                case "bidang":
                    $columnOrder = "$tbl_bidang.id_bidang";
                    break;
                case "pangkat":
                    $columnOrder = "$tbl_pangkat_golongan.id_pangkat_golongan";
                    break;
                default:
                    $columnOrder = "$tbl_pegawai.id_pegawai";
                    break;
            }
        }

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
            ->orderBy($columnOrder, $order)
            ->get();

        $output = [];
        // Jika ada request filternya adalah jenjang pendidikan
        if ($req && $req->jenjang) {
            foreach ($data as $d) {
                $pend = DB::table($tbl_pendidikan)
                    ->where("id_pegawai", "=", $d->id_pegawai)
                    ->orderByDesc("id_pegawai")
                    ->first();
                if ($pend->jenjang == $req->jenjang) {
                    $d->pendidikan = $pend;
                    array_push($output, $d);
                }
            }
        } else {
            $output = $data;
        }

        return $output;
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
            ->where("$tbl_pegawai.id_jabatan", "=", 2)
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
                $data_pegawai->gaji_pokok_baru = $data_kgb->gaji_pokok_baru;
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
        $tbl_riwayat_mk = "riwayat_mk";
        $tbl_users = "users";
        $tbl_kenaikan_pangkat = "kenaikan_pangkat";

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
            'id_bidang'         => $req->id_bidang,
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
            'email'             => $req->email,
            'no_ktp'            => $req->no_ktp,
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

        // Tambah data riwayat masa kerja
        $data_riwayat_mk = [
            'id_pegawai'      => $id_pegawai,
            'mk_jabatan'      => $req->mk_jabatan,
            'mk_sebelum_cpns' => $req->mk_sebelum_cpns,
            'mk_golongan'     => $req->mk_golongan,
            'mk_seluruhnya'   => $req->mk_seluruhnya,
            'tanggal'      => date("Y-m-d"),
        ];
        DB::table($tbl_riwayat_mk)->insert($data_riwayat_mk);

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
        // $data_duk_pegawai = [
        //     'id_pegawai'      => $id_pegawai,
        // ];
        // DB::table($tbl_duk_pegawai)->insert($data_duk_pegawai);

        // Tambah data duk pegawai
        $data_kenaikan_pangkat = [
            'id_pegawai'           => $id_pegawai,
            'created_at'           => now(),
            'updated_at'           => now(),
        ];
        DB::table($tbl_kenaikan_pangkat)->insert($data_kenaikan_pangkat);

        // Generate password akun pegawai
        $password = explode("-", $req->tgl_lahir);
        $password2 = $password[2] . $password[1] . $password[0];
        // Register akun pegawai
        $data_user = [
            "id_pegawai" => $id_pegawai,
            "name"       => $req->nama,
            "username"   => str_replace(' ', '', $req->nip),
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
            'id_eselon'         => $req->id_eselon,
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
            'email'             => $req->email ? $req->email : $data_pegawai->email,
            'no_ktp'             => $req->no_ktp ? $req->no_ktp : $data_pegawai->no_ktp,
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

    // Get Rekapitulasi Seluruh Data Pegawai berdasarkan Golongan/Eselon/Pendidikan/Jenis Kelamin
    public static function getRekapPegawai()
    {
        $tbl_pegawai = "pegawai";
        $tbl_golongan = "pangkat_golongan";
        $tbl_eselon = "pangkat_eselon";
        $tbl_pendidikan = "pendidikan";
        $tbl_jenjang = "jenjang_pendidikan";
        $tbl_bidang = "bidang";

        // Get data pns
        $rekap_pegawai = DB::table($tbl_pegawai)
            ->select(
                "$tbl_pegawai.nama",
                "$tbl_pegawai.id_pegawai",
                "$tbl_pegawai.id_bidang",
                "$tbl_golongan.*",
                "$tbl_eselon.*",
                "$tbl_bidang.*"
            )
            ->where("$tbl_pegawai.id_status_pegawai", "=", 1)
            ->leftJoin($tbl_golongan, "$tbl_golongan.id_pangkat_golongan", "=", "$tbl_pegawai.id_golongan")
            ->leftJoin($tbl_eselon, "$tbl_eselon.id_pangkat_eselon", "=", "$tbl_pegawai.id_eselon")
            ->leftJoin($tbl_bidang, "$tbl_bidang.id_bidang", "=", "$tbl_pegawai.id_bidang")
            ->get();
        // Get data ptth
        $rekap_ptth = DB::table($tbl_pegawai)
            ->where("$tbl_pegawai.id_status_pegawai", "=", 2)
            ->leftJoin($tbl_bidang, "$tbl_bidang.id_bidang", "=", "$tbl_pegawai.id_bidang")
            ->get();
        // Get data pttb
        $rekap_pttb = DB::table($tbl_pegawai)
            ->where("$tbl_pegawai.id_status_pegawai", "=", 3)
            ->leftJoin($tbl_bidang, "$tbl_bidang.id_bidang", "=", "$tbl_pegawai.id_bidang")
            ->get();

        // Get data pendidikan untuk masing - masing pegawai pns
        foreach ($rekap_pegawai as $item) {
            $data_pendidikan = DB::table($tbl_pendidikan)
                ->where("id_pegawai", "=", $item->id_pegawai)
                ->first();
            $item->pendidikan = $data_pendidikan;
        }
        // Get data pendidikan untuk masing - masing pegawai ptth
        foreach ($rekap_ptth as $item) {
            $data_pendidikan = DB::table($tbl_pendidikan)
                ->where("id_pegawai", "=", $item->id_pegawai)
                ->first();
            $item->pendidikan = $data_pendidikan;
        }
        // Get data pendidikan untuk masing - masing pegawai pttb
        foreach ($rekap_pttb as $item) {
            $data_pendidikan = DB::table($tbl_pendidikan)
                ->where("id_pegawai", "=", $item->id_pegawai)
                ->first();
            $item->pendidikan = $data_pendidikan;
        }

        // Get data golongan
        $data_golongan = DB::table($tbl_golongan)->get();
        // Get data eselon
        $data_eselon = DB::table($tbl_eselon)->get();
        // Get data eselon
        $data_jenjang = DB::table($tbl_jenjang)->get();
        // Get data bidang
        $data_bidang = DB::table($tbl_bidang)->get();

        // Klasifikasi Golongan / Eselon / Pendidikan

        // Inisialisasi rekap golongan
        $init_rekap_golongan = new stdClass();
        foreach ($data_golongan as $value) {
            $key = $value->golongan;
            $init_rekap_golongan->$key = 0;
        }
        $init_rekap_golongan->Total = 0;
        // Inisialisasi rekap eselon
        $init_rekap_eselon = new stdClass();
        foreach ($data_eselon as $value) {
            $key = $value->eselon;
            $init_rekap_eselon->$key = 0;
        }
        $init_rekap_eselon->Total = 0;
        // Inisialisasi rekap bidang
        $init_rekap_bidang = new stdClass();
        foreach ($data_bidang as $value) {
            $key = $value->nama_bidang;
            $init_rekap_bidang->$key = 0;
        }
        // $init_rekap_bidang->Total = 0;

        // Inisialisasi rekap jenjang pendidikan
        $init_rekap_jenjang = new stdClass();
        foreach ($data_jenjang as $value) {
            $key = $value->jenjang;
            $init_rekap_jenjang->$key = 0;
        }
        $init_rekap_jenjang->Total = 0;
        $init_rekap_jenjang_ptth = clone $init_rekap_jenjang;
        $init_rekap_jenjang_pttb = clone $init_rekap_jenjang;

        // Rincian Jumlah Berdasarkan Golongan dan Jenis Kelamin
        $init_rekap_golongan2 = new stdClass();
        $init_rekap_golongan2->IV = 0;
        $init_rekap_golongan2->III = 0;
        $init_rekap_golongan2->II = 0;
        $init_rekap_golongan2->I = 0;
        $init_rekap_golongan2->Total = 0;
        // Get total jenis kelamin pria dan wanita pns
        $totPria = DB::table($tbl_pegawai)->where([
            ["jenis_kelamin", "=", "Laki-Laki"],
            ["id_status_pegawai", "=", 1]
        ])->get()->count();
        $totWanita = DB::table($tbl_pegawai)->where([
            ["jenis_kelamin", "=", "Perempuan"],
            ["id_status_pegawai", "=", 1]
        ])->get()->count();
        // Get total jenis kelamin pria dan wanita ptth
        $totPriaPTTH = DB::table($tbl_pegawai)->where([
            ["jenis_kelamin", "=", "Laki-Laki"],
            ["id_status_pegawai", "=", 2]
        ])->get()->count();
        $totWanitaPTTH = DB::table($tbl_pegawai)->where([
            ["jenis_kelamin", "=", "Perempuan"],
            ["id_status_pegawai", "=", 2]
        ])->get()->count();
        // Get total jenis kelamin pria dan wanita ptth
        $totPriaPTTB = DB::table($tbl_pegawai)->where([
            ["jenis_kelamin", "=", "Laki-Laki"],
            ["id_status_pegawai", "=", 3]
        ])->get()->count();
        $totWanitaPTTB = DB::table($tbl_pegawai)->where([
            ["jenis_kelamin", "=", "Perempuan"],
            ["id_status_pegawai", "=", 3]
        ])->get()->count();

        // PNS
        foreach ($rekap_pegawai as $item) {

            $key = $item->golongan;
            $keyGolongan = explode("/", $item->golongan)[0];
            $keyEselon = $item->eselon;
            $keyBidang = $item->nama_bidang;
            $keyJenjang = $item->pendidikan->jenjang;

            // Proses perhitungan jumlah per golongan dari seluruh pegawai
            foreach ($init_rekap_golongan as $keyClass => $value) {
                if ($key == $keyClass) {
                    $init_rekap_golongan->$keyClass = $value + 1;
                    break;
                }
            }
            // Proses perhitungan jumlah per eselon dari seluruh pegawai
            foreach ($init_rekap_eselon as $keyClass => $value) {
                if ($keyEselon == $keyClass) {
                    $init_rekap_eselon->$keyClass = $value + 1;
                    break;
                }
            }
            // Proses perhitungan jumlah per bidang dari seluruh pegawai
            foreach ($init_rekap_bidang as $keyClass => $value) {
                if ($keyBidang == $keyClass) {
                    $init_rekap_bidang->$keyClass = $value + 1;
                    break;
                }
            }
            // Proses perhitungan jumlah per jenjang pendidikan dari seluruh pegawai
            foreach ($init_rekap_jenjang as $keyClass => $value) {
                if ($keyJenjang == $keyClass) {
                    $init_rekap_jenjang->$keyClass = $value + 1;
                    break;
                }
            }
            // Proses perhitungan jumlah per golongan (romawi) dari seluruh pegawai
            foreach ($init_rekap_golongan2 as $keyClass => $value) {
                if ($keyGolongan == $keyClass) {
                    $init_rekap_golongan2->$keyClass = $value + 1;
                    break;
                }
            }
        }

        // PTTH
        foreach ($rekap_ptth as $item) {

            $keyJenjang = $item->pendidikan->jenjang;
            $keyBidang = $item->nama_bidang;

            // Proses perhitungan jumlah per jenjang pendidikan dari seluruh pegawai
            foreach ($init_rekap_jenjang_ptth as $keyClass => $value) {
                if ($keyJenjang == $keyClass) {
                    $init_rekap_jenjang_ptth->$keyClass = $value + 1;
                    break;
                }
            }

            // Proses perhitungan jumlah per bidang dari seluruh pegawai
            foreach ($init_rekap_bidang as $keyClass => $value) {
                if ($keyBidang == $keyClass) {
                    $init_rekap_bidang->$keyClass = $value + 1;
                    break;
                }
            }
        }

        // PTTB
        foreach ($rekap_pttb as $item) {

            $keyJenjang = $item->pendidikan->jenjang;
            $keyBidang = $item->nama_bidang;

            // Proses perhitungan jumlah per jenjang pendidikan dari seluruh pegawai
            foreach ($init_rekap_jenjang_pttb as $keyClass => $value) {
                if ($keyJenjang == $keyClass) {
                    $init_rekap_jenjang_pttb->$keyClass = $value + 1;
                    break;
                }
            }
            // Proses perhitungan jumlah per bidang dari seluruh pegawai
            foreach ($init_rekap_bidang as $keyClass => $value) {
                if ($keyBidang == $keyClass) {
                    $init_rekap_bidang->$keyClass = $value + 1;
                    break;
                }
            }
        }

        // Mencari total data dari tiap-tiap klasifikasi
        // Total data rekap golongan
        foreach ($init_rekap_golongan as $keyClass => $value) {
            if ($keyClass != "Total") {
                $init_rekap_golongan->Total += $value;
            }
        }
        // Total data rekap golongan romawi
        foreach ($init_rekap_golongan2 as $keyClass => $value) {
            if ($keyClass != "Total") {
                $init_rekap_golongan2->Total += $value;
            }
        }
        // Total data rekap eselon
        foreach ($init_rekap_eselon as $keyClass => $value) {
            if ($keyClass != "Total") {
                $init_rekap_eselon->Total += $value;
            }
        }
        // Total data rekap jenjang pendidikan PNS
        foreach ($init_rekap_jenjang as $keyClass => $value) {
            if ($keyClass != "Total") {
                $init_rekap_jenjang->Total += $value;
            }
        }
        // Total data rekap jenjang pendidikan PTTH
        foreach ($init_rekap_jenjang_ptth as $keyClass => $value) {
            if ($keyClass != "Total") {
                $init_rekap_jenjang_ptth->Total += $value;
            }
        }
        // Total data rekap jenjang pendidikan PTTB
        foreach ($init_rekap_jenjang_pttb as $keyClass => $value) {
            if ($keyClass != "Total") {
                $init_rekap_jenjang_pttb->Total += $value;
            }
        }

        // Akumulasi jumlah pns, ptth, dan pttb
        $totPNS = $rekap_pegawai->count();
        $totPTTH = $rekap_ptth->count();
        $totPTTB = $rekap_pttb->count();

        $output = [
            "jumlah_pns" => $totPNS,
            "jumlah_ptth" => $totPTTH,
            "jumlah_pttb" => $totPTTB,
            "total_pegawai" => $totPNS + $totPTTH + $totPTTB,
            "total_per_bidang" => $init_rekap_bidang,
            "pns" => [
                "rekap_golongan" => $init_rekap_golongan,
                "rekap_golongan_romawi" => $init_rekap_golongan2,
                "rekap_eselon" => $init_rekap_eselon,
                "rekap_jenjang_pendidikan" => $init_rekap_jenjang,
                "rekap_jenis_kelamin" => [
                    "pria" => $totPria,
                    "wanita" => $totWanita,
                ]
            ],
            "ptth" => [
                "rekap_jenjang_pendidikan" => $init_rekap_jenjang_ptth,
                "rekap_jenis_kelamin" => [
                    "pria" => $totPriaPTTH,
                    "wanita" => $totWanitaPTTH,
                ]
            ],
            "pttb" => [
                "rekap_jenjang_pendidikan" => $init_rekap_jenjang_pttb,
                "rekap_jenis_kelamin" => [
                    "pria" => $totPriaPTTB,
                    "wanita" => $totWanitaPTTB,
                ]
            ]
        ];

        return $output;

        // $init_rekap_golongan = (object)[
        //     "IV_e" => 0,
        //     "IV_d" => 0,
        //     "IV_c" => 0,
        //     "IV_b" => 0,
        //     "IV_a" => 0,
        //     "III_d" => 0,
        //     "III_c" => 0,
        //     "III_b" => 0,
        //     "III_a" => 0,
        //     "II_d" => 0,
        //     "II_c" => 0,
        //     "II_b" => 0,
        //     "II_a" => 0,
        //     "I_d" => 0,
        //     "I_c" => 0,
        //     "I_b" => 0,
        //     "I_a" => 0,
        // ];
    }
}
