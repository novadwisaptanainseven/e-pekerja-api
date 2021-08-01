<?php

namespace App\Http\Controllers\Admin\Pegawai;

use App\Exports\MutasiExport;
use App\Http\Controllers\Controller;
use App\Models\Admin\Pegawai\Mutasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MutasiController extends Controller
{
    // Get All Mutasi
    public function getAll(Request $req)
    {
        $data = Mutasi::getAll($req);

        foreach ($data as $i => $item) {
            $item->no = $i + 1;
        }

        return response()->json([
            "message" => "Berhasil mendapatkan semua data mutasi",
            "data" => $data
        ], 200);
    }

    // Get Mutasi By Id
    public function getById($id_mutasi)
    {
        $data = Mutasi::getById($id_mutasi);

        if ($data === 404) {
            return response()->json([
                "message" => "Data mutasi dengan id: {$id_mutasi} tidak ditemukan"
            ], 404);
        } else {
            return response()->json([
                "message" => "Berhasil mendapatkan data mutasi dengan id: {$id_mutasi}",
                "data" => $data
            ], 200);
        }
    }

    // Insert Mutasi
    public function insert(Request $request)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "id_pegawai"  => "required",
                "tgl_mutasi"  => "required",
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

        $insert = Mutasi::insert($request);

        if ($insert === 201) {
            // Jika insert data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Tambah data mutasi berhasil",
                "input_data" => $request->all()
            ], 201);
        } else {
            // Jika data pegawai tidak ditemukan
            return response()->json([
                "message" => "Data pegawai dengan id: $request->id_pegawai",
            ], 404);
        }
    }

    // Edit Mutasi
    public function edit(Request $request, $id_mutasi)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "tgl_mutasi"     => "required",
                "keterangan"      => "required",
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

        $edit = Mutasi::edit($request, $id_mutasi);

        if ($edit === 404) {
            return response()->json([
                "message" => "Data mutasi dengan id: {$id_mutasi} tidak ditemukan"
            ], 404);
        } else {
            return response()->json([
                "message" => "Edit data mutasi dengan id: {$id_mutasi} berhasil",
                "edited_data" => $edit
            ], 201);
        }
    }

    // Delete Mutasi By Id
    public function delete($id_mutasi)
    {
        // Get data penghargaan by id
        $data = Mutasi::where('id_mutasi', '=', $id_mutasi)
            ->first();

        $delete = Mutasi::deleteMutasi($id_mutasi);

        if ($delete === 404) {
            // Jika data mutasi tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data mutasi dengan id: {$id_mutasi} tidak ditemukan",
            ], 404);
        } else {
            return response()->json([
                "message" => "Berhasil menghapus data mutasi dengan id: {$id_mutasi}",
                "deleted_data" => $data
            ], 201);
        }
    }

    // Batalkan Mutasi
    public function batalkanMutasi($id_mutasi)
    {
        // Get data mutasi by id
        $data = Mutasi::where('id_mutasi', '=', $id_mutasi)
            ->first();

        $batal = Mutasi::batalkanMutasi($id_mutasi);

        if ($batal === 404) {
            // Jika data mutasi tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data mutasi dengan id: {$id_mutasi} tidak ditemukan",
            ], 404);
        } else {
            return response()->json([
                "message" => "Berhasil membatalkan mutasi untuk pegawai dengan id: {$data->id_pegawai}",
                "deleted_data" => $data
            ], 201);
        }
    }

    // Export Mutasi Pegawai ke Excel
    public function exportMutasiToExcel(Request $req)
    {
        return (new MutasiExport($req))->download('mutasi-pegawai.xlsx');
    }
}
