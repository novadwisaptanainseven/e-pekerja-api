<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PangkatGolonganController extends Controller
{
    // Get All Pangkat Golongan
    public function getAll()
    {
        return response()->json([
            "message" => "Berhasil mendapatkan semua data pangkat golongan"
        ], 200);
    }

    // Get Pangkat Golongan By Id
    public function getById($id_pangkat_golongan)
    {
        return response()->json([
            "message" => "Berhasil mendapatkan data pangkat golongan dengan id: {$id_pangkat_golongan}"
        ], 200);
    }

    // Insert Pangkat Golongan
    public function insert(Request $request)
    {
        return response()->json([
            "message" => "Tambah data pangkat golongan berhasil",
            "input_data" => [
                "golongan" => $request->golongan,
                "keterangan" => $request->keterangan,
            ]
        ], 201);
    }

    // Edit Pangkat Golongan
    public function edit(Request $request, $id_pangkat_golongan)
    {
        return response()->json([
            "message" => "Edit data pangkat golongan dengan id: {$id_pangkat_golongan} berhasil",
            "edited_data" => [
                "id_pangkat_golongan" => $id_pangkat_golongan,
                "golongan" => $request->golongan,
                "keterangan" => $request->keterangan,
            ]
        ], 201);
    }

    // Delete Pangkat Eselon By Id
    public function delete($id_pangkat_golongan)
    {
        return response()->json([
            "message" => "Berhasil menghapus data pangkat golongan dengan id: {$id_pangkat_golongan}",
        ], 201);
    }
}
