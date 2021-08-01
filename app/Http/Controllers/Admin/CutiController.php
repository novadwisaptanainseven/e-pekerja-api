<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CutiExport;
use App\Exports\PegawaiStatusCutiExport;
use App\Http\Controllers\Controller;
use App\Models\Admin\Cuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CutiController extends Controller
{
    // Get All Cuti
    public function getAllCuti()
    {
        $data = Cuti::getAllCuti();

        foreach ($data as $i => $item) {
            $item->no = $i + 1;
        }

        return response()->json([
            "message" => "Berhasil mendapatkan semua data cuti pegawai",
            "data" => $data
        ], 200);
    }

    // Search Cuti by Name
    public function getByName(Request $request)
    {
        $data = Cuti::getByName($request);

        if (count($data) > 0) {
            return response()->json([
                "message" => "Berhasil mendapatkan data cuti dengan nama pegawai: {$request->nama}",
                "data" => $data
            ], 200);
        } else {
            return response()->json([
                "message" => "Data cuti dengan nama pegawai: {$request->nama} tidak ditemukan",
                "data" => $data
            ], 404);
        }
    }

    // Get All Cuti by Id Pegawai
    public function getAll($id_pegawai)
    {
        $data = Cuti::getAll($id_pegawai);

        foreach ($data as $i => $item) {
            $item->no = $i + 1;
        }

        if ($data) {
            return response()->json([
                "message" => "Berhasil mendapatkan semua data cuti dari pegawai dengan id: {$id_pegawai}",
                "data" => $data
            ], 200);
        } else {
            return response()->json([
                "message" => "Data cuti pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        }
    }

    // Get Cuti by Id Cuti
    public function getById($id_pegawai, $id_cuti)
    {
        $data = Cuti::getById($id_pegawai, $id_cuti);

        if ($data === 404) {
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        } elseif ($data === 405) {
            return response()->json([
                "message" => "Data cuti dengan id: {$id_cuti} tidak ditemukan"
            ], 404);
        } else {
            return response()->json([
                "message" => "Berhasil mendapatkan data cuti dengan id: {$id_cuti}",
                "data" => $data
            ], 200);
        }
    }

    // Insert Cuti
    public function insert(Request $request, $id_pegawai)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "tgl_mulai"   => "required",
                "tgl_selesai" => "required",
                "jenis_cuti"   => "required",
                "keterangan"  => "required",
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

        $insert = Cuti::insert($request, $id_pegawai);

        if ($insert === true) {
            // Jika insert data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Tambah data cuti untuk pegawai dengan id: {$id_pegawai} berhasil",
                "input_data" => $request->all()
            ], 201);
        } elseif ($insert === 404) {
            // Jika data tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        }
    }

    // Edit Cuti
    public function edit(Request $request, $id_pegawai, $id_cuti)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "tgl_mulai"   => "required",
                "tgl_selesai" => "required",
                "jenis_cuti"  => "required",
                "keterangan"  => "required",
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

        $edit = Cuti::edit($request, $id_pegawai, $id_cuti);

        if ($edit === 404) {
            // Jika data pegawai tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        } elseif ($edit === 405) {
            // Jika data kgb tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data cuti pegawai dengan id: {$id_cuti} tidak ditemukan"
            ], 404);
        } else {
            // Jika edit data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Edit data cuti pegawai dengan id: {$id_cuti} berhasil",
                "edited_data" => $edit
            ], 201);
        }
    }

    // Update Status Cuti
    public function updateStatus(Request $request, $id_pegawai, $id_cuti)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "status_cuti"   => "required"
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

        $edit = Cuti::updateStatus($request, $id_pegawai, $id_cuti);

        if ($edit === 404) {
            // Jika data pegawai tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        } elseif ($edit === 405) {
            // Jika data kgb tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data cuti pegawai dengan id: {$id_cuti} tidak ditemukan"
            ], 404);
        } else {
            // Jika edit data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Edit data status cuti pegawai dengan id: {$id_cuti} berhasil",
                "edited_data" => $edit
            ], 201);
        }
    }

    // Delete Cuti
    public function delete($id_pegawai, $id_cuti)
    {
        $data_cuti = Cuti::where('id_cuti', '=', $id_cuti)->first();

        $delete = Cuti::deleteCuti($id_pegawai, $id_cuti);

        if ($delete === true) {
            return response()->json([
                "message" => "Berhasil menghapus data cuti pegawai dengan id: {$id_cuti}",
                "deleted_data" => $data_cuti
            ]);
        } elseif ($delete === 404) {
            // Jika data pegawai tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        } elseif ($delete === 405) {
            // Jika data cuti tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data cuti pegawai dengan id: {$id_cuti} tidak ditemukan"
            ], 404);
        }
    }

    // Get All Pegawai Cuti
    public function getPegawaiCuti()
    {
        $data = Cuti::getPegawaiCuti();

        foreach ($data as $i => $item) {
            $item->no = $i + 1;
        }

        return response()->json([
            "message" => "Berhasil mendapatkan semua data pegawai yang sedang cuti",
            "data" => $data
        ], 200);
    }

    // Get Cuti Pegawai
    public static function getPegawaiStatusCuti(Request $req)
    {
        $data = Cuti::getPegawaiStatusCuti($req)->groupBy("id_pegawai");
        $data2 = [];
        $currentDate = time();
        $i = 1;

        if ($data) {
            foreach ($data as $d) {
                $d[0]->no = $i++;
                $tglMulaiCutiTs = strtotime($d[0]->tgl_mulai);
                $tglSelesaiCutiTs = strtotime($d[0]->tgl_selesai);
                $sisaTglCuti = 24 * 60 * 60;
                $estimasiCutiBerakhir = $tglSelesaiCutiTs - $sisaTglCuti;
                $tgl = date("d-m-Y", $estimasiCutiBerakhir);
                
                if ($currentDate >= $estimasiCutiBerakhir && $currentDate <= $tglSelesaiCutiTs) {
                    $d[0]->status_cuti = "masa-cuti-hampir-selesai";
                } elseif ($currentDate >= $tglMulaiCutiTs && $currentDate <= $tglSelesaiCutiTs) {
                    $d[0]->status_cuti = "sedang-cuti";
                } elseif ($currentDate < $tglMulaiCutiTs) {
                    $d[0]->status_cuti = "akan-cuti";
                } else {
                    $d[0]->status_cuti = "masa-cuti-selesai";
                }

                // $d[0]->currentDate = $currentDate;
                // $d[0]->estimasiCutiBerakhir = $estimasiCutiBerakhir;
                // $d[0]->tglSelesaiCutiTs = $tglSelesaiCutiTs;
                // $d[0]->tgl = $tgl;
                array_push($data2, $d[0]);
            }
        }

        return $data2;
    }

    // Get Pegawai Status Cuti
    public static function getCutiPegawaiForPrint($req)
    {
        $data = Cuti::getPegawaiStatusCuti($req)->groupBy("id_pegawai");
        $data2 = [];
        $currentDate = time();
        $i = 1;

        if ($data) {
            foreach ($data as $d) {
                $d[0]->no = $i++;
                $tglMulaiCutiTs = strtotime($d[0]->tgl_mulai);
                $tglSelesaiCutiTs = strtotime($d[0]->tgl_selesai);
                $sisaTglCuti = 24 * 60 * 60;
                $estimasiCutiBerakhir = $tglSelesaiCutiTs - $sisaTglCuti;
                $tgl = date("d-m-Y", $estimasiCutiBerakhir);
                if ($currentDate >= $estimasiCutiBerakhir && $currentDate <= $tglSelesaiCutiTs) {
                    $d[0]->status_cuti = "masa-cuti-hampir-selesai";
                } elseif ($currentDate >= $tglMulaiCutiTs && $currentDate <= $tglSelesaiCutiTs) {
                    $d[0]->status_cuti = "sedang-cuti";
                } elseif ($currentDate < $tglMulaiCutiTs) {
                    $d[0]->status_cuti = "akan-cuti";
                } else {
                    $d[0]->status_cuti = "masa-cuti-selesai";
                }

                array_push($data2, $d[0]);
            }
        }

        return $data2;
    }

    // Export Cuti Pegawai ke Excel
    public function exportCutiToExcel($id)
    {
        return (new CutiExport($id))->download('cuti-pegawai.xlsx');
    }

    // Export Pegawai Status Cuti
    public function exportPegawaiStatusCuti(Request $req)
    {
        return (new PegawaiStatusCutiExport($req))->download('cuti-pegawai.xlsx');
    }
}
