<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BidangController extends Controller
{
    // Get All Bidang
    public function getAll()
    {
        return response()->json([
            "message" => "Berhasil mendapatkan semua data bidang"
        ], 200);
    }

    // Get Bidang By Id
    public function getById($id_bidang)
    {
        return response()->json([
            "message" => "Berhasil mendapatkan data bidang dengan id: {$id_bidang}"
        ], 200);
    }

    // Insert Bidang
    public function insert(Request $request)
    {
        return response()->json([
            "message" => "Tambah data bidang berhasil",
            "input_data" => [
                "nama_bidang" => $request->nama_bidang,
                "keterangan" => $request->keterangan,
            ]
        ], 201);
    }

    // Edit Bidang
    public function edit(Request $request, $id_bidang)
    {
        return response()->json([
            "message" => "Edit data bidang dengan id: {$id_bidang} berhasil",
            "edited_data" => [
                "id_bidang" => $id_bidang,
                "nama_bidang" => $request->nama_bidang,
                "keterangan" => $request->keterangan,
            ]
        ], 201);
    }

    // Delete Bidang By Id
    public function delete($id_bidang)
    {
        return response()->json([
            "message" => "Berhasil menghapus data bidang dengan id: {$id_bidang}",
        ], 201);
    }
}
