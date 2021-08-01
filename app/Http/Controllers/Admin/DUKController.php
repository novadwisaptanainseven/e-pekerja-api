<?php

namespace App\Http\Controllers\Admin;

use App\Exports\DukExport;
use App\Http\Controllers\Controller;
use App\Models\Admin\DUK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DUKController extends Controller
{
    // Get All DUK
    public function getAll()
    {
        $data = DUK::getAll();

        foreach ($data as $i => $d) {
            $d->no = $i + 1;
        }

        return response()->json([
            "message" => "Berhasil mendapatkan semua data duk pegawai",
            "data" => $data
        ], 200);
    }

    // Get All DUK For Print
    public function getAllForPrint()
    {
        $data = DUK::getAllForPrint();

        return response()->json([
            "message" => "Berhasil mendapatkan semua data duk pegawai",
            "data" => $data
        ], 200);
    }

    // Get DUK By Id
    public function getById($id_duk)
    {
        $data = DUK::getById($id_duk);

        if ($data) {
            // Jika data ditemukan -> 200 OK
            return response()->json([
                "message" => "Berhasil mendapatkan data duk pegawai dengan id: {$id_duk}",
                "data" => $data
            ], 200);
        } else {
            // Jika tidak -> 404 NOT FOUND
            return response()->json([
                "message" => "Data duk pegawai dengan id: {$id_duk} tidak ditemukan",
            ], 404);
        }
    }

    // Edit DUK
    public function edit(Request $request, $id_duk)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "catatan_mutasi" => "required",
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

        $edit = DUK::edit($request, $id_duk);

        if ($edit !== 404) {
            // Jika edit data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Edit data duk dengan id: {$id_duk} berhasil",
                "edited_data" => $edit
            ], 201);
        } elseif ($edit === 404) {
            // Jika data tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data duk dengan id: {$id_duk} tidak ditemukan"
            ], 404);
        } elseif ($edit === 500) {
            // Jika gagal -> 500 SERVER ERROR
            return response()->json([
                "message" => "Terjadi kesalahan server",
            ], 500);
        }
    }

    // Export DUK Pegawai ke Excel
    public function exportDukToExcel() {
        return (new DukExport)->download('duk-pegawai.xlsx');
    }
}
