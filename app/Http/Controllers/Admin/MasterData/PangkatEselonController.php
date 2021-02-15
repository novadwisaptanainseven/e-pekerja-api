<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PangkatEselonController extends Controller
{
    // Get All Pangkat Eselon
    public function getAll()
    {
        return response()->json([
            "message" => "Berhasil mendapatkan semua data pangkat eselon"
        ], 200);
    }

    // Get Pangkat Eselon By Id
    public function getById($id_pangkat_eselon)
    {
        return response()->json([
            "message" => "Berhasil mendapatkan data pangkat eselon dengan id: {$id_pangkat_eselon}"
        ], 200);
    }

    // Insert Pangkat Eselon
    public function insert(Request $request)
    {
        return response()->json([
            "message" => "Tambah data pangkat eselon berhasil",
            "input_data" => [
                "eselon" => $request->eselon,
                "keterangan" => $request->keterangan,
            ]
        ], 201);
    }

    // Edit Pangkat Eselon
    public function edit(Request $request, $id_pangkat_eselon)
    {
        return response()->json([
            "message" => "Edit data pangkat eselon dengan id: {$id_pangkat_eselon} berhasil",
            "edited_data" => [
                "id_pangkat_eselon" => $id_pangkat_eselon,
                "eselon" => $request->eselon,
                "keterangan" => $request->keterangan,
            ]
        ], 201);
    }

    // Delete Pangkat Eselon By Id
    public function delete($id_pangkat_eselon)
    {
        return response()->json([
            "message" => "Berhasil menghapus data pangkat eselon dengan id: {$id_pangkat_eselon}",
        ], 201);
    }
}
