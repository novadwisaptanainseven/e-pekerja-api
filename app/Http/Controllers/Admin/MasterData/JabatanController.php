<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    // Get All Jabatan
    public function getAll()
    {
        return response()->json([
            "message" => "Berhasil mendapatkan semua data jabatan"
        ], 200);
    }

    // Get Jabatan By Id
    public function getById($id_jabatan)
    {
        return response()->json([
            "message" => "Berhasil mendapatkan data jabatan dengan id: {$id_jabatan}"
        ], 200);
    }

    // Insert Jabatan
    public function insert(Request $request)
    {
        return response()->json([
            "message" => "Tambah data jabatan berhasil",
            "input_data" => [
                "jabatan" => $request->jabatan
            ]
        ], 201);
    }

    // Edit Jabatan
    public function edit(Request $request, $id_jabatan)
    {
        return response()->json([
            "message" => "Edit data jabatan dengan id: {$id_jabatan} berhasil",
            "edited_data" => [
                "id_jabatan" => $id_jabatan,
                "jabatan" => $request->jabatan
            ]
        ], 201);
    }

    // Delete Jabatan By Id
    public function delete($id_jabatan)
    {
        return response()->json([
            "message" => "Berhasil menghapus data jabatan dengan id: {$id_jabatan}",
        ], 201);
    }
}
