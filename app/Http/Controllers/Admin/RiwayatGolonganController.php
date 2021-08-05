<?php

namespace App\Http\Controllers\Admin;

use App\Exports\RiwayatGolonganExport;
use App\Http\Controllers\Controller;
use App\Models\Admin\MasaKerja;
use App\Models\Admin\Pegawai\PNS;
use App\Models\Admin\RiwayatGolongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RiwayatGolonganController extends Controller
{
    protected $tbl = "rw_golongan";

    // Get all by id pegawai
    public function get($id_pegawai)
    {
        $data = RiwayatGolongan::get($id_pegawai);

        foreach ($data["data"] as $i => $d) {
            $d->no = $i + 1;
        }

        return response()->json([
            "message" => "Berhasil mendapatkan semua data riwayat golongan dengan id pegawai: $id_pegawai",
            "data" => $data
        ], 200);
    }

    // Get by id riwayat golongan
    public function getById($id)
    {
        $data = RiwayatGolongan::find($id);

        if ($data) {
            return response()->json([
                "message" => "Berhasil mendapatkan data riwayat golongan dengan id: $id",
                "data" => $data
            ], 200);
        } else {
            return response()->json([
                "message" => "Data riwayat golongan dengan id: $id tidak ditemukan",
            ], 404);
        }
    }

    // Insert Riwayat Golongan
    public function create(Request $req, $id_pegawai)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $req->all(),
            [
                "id_golongan"           => "required",
                "jenis_kp"              => "required",
                "no_sk"                 => "required",
                "tanggal"               => "required",
                "masa_kerja"            => "required",
                "tmt_kenaikan_pangkat"  => "required",
                "pejabat_penetap"       => "required",
                "file"                  => "max:5048|mimes:doc,docx,pdf",
            ],
            $messages
        );

        // Validation Check
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }
        // End of Validation

        // Cek apakah ada file file
        if (!$req->file('file')) {
            $file = '';
        } else {
            $file = $req->file("file");

            // Sanitasi nama file
            $sanitize = sanitizeFile($file);
            $file = $file->storeAs("documents", rand(0, 9999) . time() . '-' . $sanitize);
        }

        $data = [
            "id_pegawai"            => $id_pegawai,
            "id_golongan"           => $req->id_golongan,
            "jenis_kp"              => $req->jenis_kp,
            "no_sk"                 => $req->no_sk,
            "tanggal"               => $req->tanggal,
            "masa_kerja"            => $req->masa_kerja,
            "tmt_kenaikan_pangkat"  => $req->tmt_kenaikan_pangkat,
            "pejabat_penetap"       => $req->pejabat_penetap,
            "pangkat_terkini"       => $req->pangkat_terkini,
            "file"                  => $file,
        ];

        $insert = RiwayatGolongan::create($data);

        // Update pangkat terkini jika golongan dijadikan pangkat terkini
        if ($req->pangkat_terkini == 1) {

            RiwayatGolongan::resetPangkatTerkini($insert->id_rw_golongan, $id_pegawai);

            // Hitung total masa kerja untuk pengurutan
            $total_mkg_hari = hitungMKG2($req->masa_kerja);

            // Update golongan di tabel pegawai
            $data_pegawai = [
                "id_golongan" => $req->id_golongan,
                "tmt_golongan" => $req->tmt_kenaikan_pangkat
            ];
            PNS::where("id_pegawai", $id_pegawai)->update($data_pegawai);

            // Update Masa Kerja Golongan di tabel masa kerja
            MasaKerja::where("id_pegawai", "$id_pegawai")
                ->update([
                    "mk_golongan" => $data["masa_kerja"],
                    "total_mkg_hari" => $total_mkg_hari,
                ]);
        }

        return response()->json([
            "message" => "Tambah data riwayat golongan berhasil",
            "input_data" => $req->all(),
        ], 201);
    }

    // Update Riwayat Golongan
    public function update(Request $req, $id)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $req->all(),
            [
                "id_golongan"           => "required",
                "jenis_kp"              => "required",
                "no_sk"                 => "required",
                "tanggal"               => "required",
                "masa_kerja"            => "required",
                "tmt_kenaikan_pangkat"  => "required",
                "pejabat_penetap"       => "required",
                "file"                  => "max:5048|mimes:doc,docx,pdf",
            ],
            $messages
        );

        // Validation Check
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }
        // End of Validation

        // Cek data riwayat golongan
        $rwg = RiwayatGolongan::find($id);
        if (!$rwg) {
            return response()->json([
                "message" => "Data riwayat golongan dengan id: $id tidak ditemukan",
            ], 404);
        }

        // Cek apakah ada file file
        if (!$req->file('file')) {
            $file = $rwg->file;
        } else {
            $file = $req->file("file");

            // Hapus file lama
            Storage::delete($rwg->file);

            // Sanitasi nama file
            $sanitize = sanitizeFile($file);
            $file = $file->storeAs("documents", rand(0, 9999) . time() . '-' . $sanitize);
        }

        $data = [
            "id_golongan"           => $req->id_golongan ? $req->id_golongan : $rwg->id_golongan,
            "jenis_kp"              => $req->jenis_kp ? $req->jenis_kp : $rwg->jenis_kp,
            "no_sk"                 => $req->no_sk ? $req->no_sk : $rwg->no_sk,
            "tanggal"               => $req->tanggal ? $req->tanggal : $rwg->tanggal,
            "masa_kerja"            => $req->masa_kerja ? $req->masa_kerja : $rwg->masa_kerja,
            "tmt_kenaikan_pangkat"  => $req->tmt_kenaikan_pangkat ? $req->tmt_kenaikan_pangkat : $rwg->tmt_kenaikan_pangkat,
            "pejabat_penetap"       => $req->pejabat_penetap ? $req->pejabat_penetap : $rwg->pejabat_penetap,
            "pangkat_terkini"       => $req->pangkat_terkini ? $req->pangkat_terkini : $rwg->pangkat_terkini,
            "file"                  => $file,
        ];

        // Update riwayat golongan
        $update = $rwg->update($data);

        // Updata pangkat terkini 
        if ($req->pangkat_terkini == 1) {
            RiwayatGolongan::resetPangkatTerkini($id, $rwg->id_pegawai);

            // Update golongan di tabel pegawai
            $data_pegawai = [
                "id_golongan" => $req->id_golongan,
                "tmt_golongan" => $req->tmt_kenaikan_pangkat
            ];
            PNS::where("id_pegawai", $rwg->id_pegawai)->update($data_pegawai);

            // Hitung total masa kerja untuk pengurutan
            $total_mkg_hari = hitungMKG2($req->masa_kerja);

            // Update Masa Kerja Golongan di tabel masa kerja
            MasaKerja::where("id_pegawai", "$rwg->id_pegawai")
                ->update([
                    "mk_golongan" => $data["masa_kerja"],
                    "total_mkg_hari" => $total_mkg_hari,
                ]);
        }

        return response()->json([
            "message" => "Edit data riwayat golongan dengan id: $id berhasil",
            "input_data" => $req->all()
        ], 201);
    }

    // Delete Riwayat Golongan
    public function destroy($id)
    {
        $data = RiwayatGolongan::find($id);

        if ($data) {
            Storage::delete($data->file);
            $data->delete();

            return response()->json([
                "message" => "Data riwayat golongan dengan id: $id berhasil dihapus",
            ], 201);
        } else {
            return response()->json([
                "message" => "Data riwayat golongan dengan id: $id tidak ditemukan",
            ], 404);
        }
    }

    // Export Riwayat Golongan Pegawai ke Excel
    public function exportRiwayatGolongan($id_pegawai)
    {
        return (new RiwayatGolonganExport($id_pegawai))->download('riwayat-golongan-pegawai.xlsx');
    }
}
