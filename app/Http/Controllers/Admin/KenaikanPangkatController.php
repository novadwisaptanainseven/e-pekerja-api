<?php

namespace App\Http\Controllers\Admin;

use App\Exports\KenaikanPangkatExport;
use App\Http\Controllers\Controller;
use App\Models\Admin\KenaikanPangkat;
use App\Models\Admin\Pegawai\PNS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KenaikanPangkatController extends Controller
{
    // Get All Kenaikan Pangkat
    public function getAll()
    {
        $data = KenaikanPangkat::getAll();

        foreach ($data as $i => $item) {
            $item->no = $i + 1;
        }

        return response()->json([
            "message" => "Berhasil mendapatkan semua data kenaikan pangkat",
            "data" => $data
        ], 200);
    }

    // Create Kenaikan Pangkat
    public function create(Request $req, $id)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $req->all(),
            [
                "id_golongan"           => "required",
                "pangkat_baru"          => "required",
                "tmt_kenaikan_pangkat"  => "required",
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

        // Update kenaikan pangkat
        KenaikanPangkat::where("id", $id)->update($req->all());

        return response()->json([
            "message" => "Tambah data mutasi berhasil",
            "input_data" => $req->all()
        ], 201);
    }

    // Update Pangkat
    public function updatePangkat($id)
    {
        $kenaikan_pangkat = KenaikanPangkat::find($id);

        // Update pangkat pegawai berdasarkan tabel kenaikan pangkat
        $data = [
            "id_golongan" => $kenaikan_pangkat->id_golongan
        ];
        PNS::where("id_pegawai", $kenaikan_pangkat->id_pegawai)->update($data);

        // Get data pegawai hasil update
        $pegawai = PNS::where("id_pegawai", $kenaikan_pangkat->id_pegawai)->first();

        // Setelah pangkat golongan pegawai diupdate, maka kosongkan kolom pangkat_baru, id_golongan, dan tmt_kenaikan_pangkat di tabel kenaikan pangkat
        KenaikanPangkat::find($id)->update([
            "id_golongan" => null,
            "pangkat_baru" => null,
            "tmt_kenaikan_pangkat" => null
        ]);

        return response()->json([
            "message" => "Pangkat golongan pegawai dengan id: $kenaikan_pangkat->id_pegawai, berhasil diperbarui",
            "data_updated" => $pegawai
        ], 201);
    }

    // Batalkan Kenaikan Pangkat
    public function batalkanKenaikanPangkat($id)
    {
        KenaikanPangkat::find($id)->update([
            "id_golongan" => null,
            "pangkat_baru" => null,
            "tmt_kenaikan_pangkat" => null
        ]);

        // Get data kenaikan pangkat setelah dibatalkan
        $kenaikan_pangkat = KenaikanPangkat::find($id);

        return response()->json([
            "message" => "Kenaikan pangkat berhasil dibatalkan",
            "data" => $kenaikan_pangkat
        ], 201);
    }

    // Export KenaikanPangkat Pegawai ke Excel
    public function exportKenaikanPangkatToExcel()
    {
        return (new KenaikanPangkatExport())->download('kenaikan-pangkat-pegawai.xlsx');
    }
}
