<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\KenaikanPangkat;
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
    public function create(Request $req)
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

        return response()->json([
            "message" => "Tambah data mutasi berhasil",
            "input_data" => $req->all()
        ], 201);
    }
}
