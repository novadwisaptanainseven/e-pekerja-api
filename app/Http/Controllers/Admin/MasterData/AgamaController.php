<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgamaController extends Controller
{
    // Get All Agama
    public function getAll()
    {
        return response()->json([
            "message" => "Berhasil mendapatkan semua data agama"
        ], 200);
    }

    // Get Agama By Id
    public function getById($id_agama)
    {
        return response()->json([
            "message" => "Berhasil mendapatkan data agama dengan id: {$id_agama}"
        ], 200);
    }

    // Insert Agama
    public function insert(Request $request)
    {
        return response()->json([
            "message" => "Tambah data agama berhasil",
            "input_data" => [
                "agama" => $request->agama
            ]
        ], 201);
    }

    // Edit Agama
    public function edit(Request $request, $id_agama)
    {
        return response()->json([
            "message" => "Edit agama dengan id: {$id_agama} berhasil",
            "input_data" => [
                "id_agama" => $id_agama,
                "agama" => $request->agama
            ]
        ], 201);
    }

    // Delete Agama By Id
    public function delete($id_agama)
    {
        return response()->json([
            "message" => "Berhasil menghapus data agama dengan id: {$id_agama}",
        ], 201);
    }
}
