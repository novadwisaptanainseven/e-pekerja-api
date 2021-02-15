<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubBidangController extends Controller
{
    // Get All Sub Bidang
    public function getAll()
    {
        return response()->json([
            "message" => "Berhasil mendapatkan semua data sub bidang"
        ], 200);
    }

    // Get Sub Bidang By Id
    public function getById($id_sub_bidang)
    {
        return response()->json([
            "message" => "Berhasil mendapatkan data sub bidang dengan id: {$id_sub_bidang}"
        ], 200);
    }

    // Insert Sub Bidang
    public function insert(Request $request)
    {
        return response()->json([
            "message" => "Tambah data sub bidang berhasil",
            "input_data" => [
                "id_bidang" => $request->id_bidang,
                "nama_sub_bidang" => $request->nama_sub_bidang,
                "keterangan" => $request->keterangan,
            ]
        ], 201);
    }

    // Edit Sub Bidang
    public function edit(Request $request, $id_sub_bidang)
    {
        return response()->json([
            "message" => "Edit data sub bidang dengan id: {$id_sub_bidang} berhasil",
            "edited_data" => [
                "id_sub_bidang" => $id_sub_bidang,
                "id_bidang" => $request->id_bidang,
                "nama_sub_bidang" => $request->nama_sub_bidang,
                "keterangan" => $request->keterangan,
            ]
        ], 201);
    }

    // Delete Sub Bidang By Id
    public function delete($id_sub_bidang)
    {
        return response()->json([
            "message" => "Berhasil menghapus data sub bidang dengan id: {$id_sub_bidang}",
        ], 201);
    }
}
