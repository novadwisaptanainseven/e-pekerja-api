<?php

namespace App\Http\Controllers\Admin;

use App\Exports\KgbExport;
use App\Http\Controllers\Controller;
use App\Models\Admin\KGB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KGBController extends Controller
{
    // Get All KGB
    public function getAll($id_pegawai)
    {
        $data = KGB::getAll($id_pegawai);

        foreach ($data as $i => $d) {
            $d->no = $i + 1;
        }

        if ($data) {
            return response()->json([
                "message" => "Berhasil mendapatkan semua data kenaikan gaji berkala pegawai dengan id: {$id_pegawai}",
                "data" => $data
            ], 200);
        } else {
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        }
    }

    // Get KGB Pegawai
    public function getKGBPegawai(Request $req)
    {
        $data = KGB::getKGBPegawai($req)->groupBy("id_pegawai");
        $data2 = [];
        $currentDate = time();
        $i = 1;

        if ($data) {
            foreach ($data as $d) {
                $d[0]->no = $i++;
                $tmtKenaikanGajiTs = strtotime($d[0]->tmt_kenaikan_gaji);
                $kenaikanGajiYadTs = strtotime($d[0]->kenaikan_gaji_yad);
                if ($currentDate >= $tmtKenaikanGajiTs && $currentDate < $kenaikanGajiYadTs) {
                    $d[0]->status_kgb = "sedang-berjalan";
                } elseif ($currentDate < $tmtKenaikanGajiTs) {
                    $d[0]->status_kgb = "akan-naik-gaji";
                } else {
                    $d[0]->status_kgb = "naik-gaji";
                }

                array_push($data2, $d[0]);
            }
        }

        return response()->json([
            "message" => "Berhasil mendapatkan semua data kenaikan gaji berkala pegawai",
            "data" => $data2
        ], 200);
    }

    // Get KGB Terbaru
    public function getKGBTerbaru($id_pegawai)
    {
        $data = KGB::getKGBTerbaru($id_pegawai);

        if ($data) {
            return response()->json([
                "message" => "Berhasil mendapatkan gaji pokok terakhir pegawai dengan id: {$id_pegawai}",
                "data" => $data
            ], 200);
        } else {
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        }
    }

    // Get KGB by Id KGB
    public function getById($id_pegawai, $id_kgb)
    {
        $data = KGB::getById($id_pegawai, $id_kgb);

        if ($data === 404) {
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        } elseif ($data === 405) {
            return response()->json([
                "message" => "Data kenaikan gaji berkala pegawai dengan id: {$id_kgb} tidak ditemukan"
            ], 404);
        } else {
            return response()->json([
                "message" => "Berhasil mendapatkan data kgb dengan id: {$id_kgb}",
                "data" => $data
            ], 200);
        }
    }

    // Insert Masa Kerja
    public function insert(Request $request, $id_pegawai)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "gaji_pokok_lama"   => "required",
                "gaji_pokok_baru"   => "required",
                "tmt_kenaikan_gaji" => "required",
                "kenaikan_gaji_yad" => "required",
                "peraturan"         => "required",
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

        $insert = KGB::insert($request, $id_pegawai);

        if ($insert === true) {
            // Jika insert data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Tambah data kenaikan gaji berkala dengan id: {$id_pegawai} berhasil",
                "input_data" => $request->all()
            ], 201);
        } elseif ($insert === 404) {
            // Jika data tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        } elseif ($insert === 500) {
            // Jika gagal -> 500 SERVER ERROR
            return response()->json([
                "message" => "Terjadi kesalahan server",
            ], 500);
        }
    }

    // Edit KGB
    public function edit(Request $request, $id_pegawai, $id_kgb)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "gaji_pokok_lama"   => "required",
                "gaji_pokok_baru"   => "required",
                "tmt_kenaikan_gaji" => "required",
                "kenaikan_gaji_yad" => "required",
                "peraturan"         => "required",
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

        $edit = KGB::edit($request, $id_pegawai, $id_kgb);

        if ($edit === 404) {
            // Jika data pegawai tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        } elseif ($edit === 405) {
            // Jika data kgb tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data kenaikan gaji berkala dengan id: {$id_kgb} tidak ditemukan"
            ], 404);
        } else {
            // Jika edit data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Edit data kenaikan gaji berkala dengan id: {$id_kgb} berhasil",
                "edited_data" => $edit
            ], 201);
        }
    }

    // Delete KGB
    public function delete($id_pegawai, $id_kgb)
    {
        $data_kgb = KGB::where('id_kgb', '=', $id_kgb)->first();

        $delete = KGB::deleteKGB($id_pegawai, $id_kgb);

        if ($delete === true) {
            return response()->json([
                "message" => "Berhasil menghapus data kenaikan gaji berkala dengan id: {$id_kgb}",
                "deleted_data" => $data_kgb
            ]);
        } elseif ($delete === 404) {
            // Jika data pegawai tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        } elseif ($delete === 405) {
            // Jika data kgb tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data kenaikan gaji berkala dengan id: {$id_kgb} tidak ditemukan"
            ], 404);
        }
    }

    // Export KGB Pegawai ke Excel
    public function exportKgbToExcel($id)
    {
        return (new KgbExport($id))->download('kgb-pegawai.xlsx');
    }
}
