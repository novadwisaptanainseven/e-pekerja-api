<?php

namespace App\Http\Controllers\Admin;

use App\Exports\MasaKerjaExport;
use App\Http\Controllers\Controller;
use App\Models\Admin\MasaKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MasaKerjaController extends Controller
{

    // Get All Masa Kerja
    public function getAll()
    {
        $data = MasaKerja::getAll();

        return response()->json([
            "message" => "Berhasil mendapatkan semua data masa kerja pegawai",
            "data" => $data
        ], 200);
    }

    // Get All DUK For Print
    public function getAllForPrint()
    {
        $data = MasaKerja::getAllForPrint();

        return response()->json([
            "message" => "Berhasil mendapatkan semua data masa kerja pegawai",
            "data" => $data
        ], 200);
    }

    // Get Masa Kerja By Id
    public function getById($id_masa_kerja)
    {
        $data = MasaKerja::getById($id_masa_kerja);

        if ($data) {
            // Jika data ditemukan -> 200 OK
            return response()->json([
                "message" => "Berhasil mendapatkan data masa kerja pegawai dengan id: {$id_masa_kerja}",
                "data" => $data
            ], 200);
        } else {
            // Jika tidak -> 404 NOT FOUND
            return response()->json([
                "message" => "Data masa kerja pegawai dengan id: {$id_masa_kerja} tidak ditemukan",
            ], 404);
        }
    }

    // Edit Masa Kerja
    public function edit(Request $request, $id_masa_kerja)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "mk_golongan" => "required",
                "mk_jabatan" => "required",
                "mk_sebelum_cpns" => "required",
                "mk_seluruhnya" => "required",
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

        $edit = MasaKerja::edit($request, $id_masa_kerja);

        if ($edit !== 404) {
            // Jika edit data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Edit data masa kerja dengan id: {$id_masa_kerja} berhasil",
                "edited_data" => $edit
            ], 201);
        } elseif ($edit === 404) {
            // Jika data tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data masa kerja dengan id: {$id_masa_kerja} tidak ditemukan"
            ], 404);
        } elseif ($edit === 500) {
            // Jika gagal -> 500 SERVER ERROR
            return response()->json([
                "message" => "Terjadi kesalahan server",
            ], 500);
        }
    }

    // Export Masa Kerja Pegawai ke Excel
    public function exportMasaKerjaToExcel() {
        return (new MasaKerjaExport)->download('masa-kerja-pegawai.xlsx');
    }
}

