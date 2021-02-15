<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatusPegawaiController extends Controller
{
    // Get All Status Pegawai
    public function getAll()
    {
        return response()->json([
            "message" => "Berhasil mendapatkan semua data status pegawai"
        ], 200);
    }

    // Get status pegawai By Id
    public function getById($id_status_pegawai)
    {
        return response()->json([
            "message" => "Berhasil mendapatkan data status pegawai dengan id: {$id_status_pegawai}"
        ], 200);
    }

    // Insert status pegawai
    public function insert(Request $request)
    {
        return response()->json([
            "message" => "Tambah data status pegawai berhasil",
            "input_data" => [
                "status_pegawai" => $request->status_pegawai,
                "keterangan" => $request->keterangan,
            ]
        ], 201);
    }

    // Edit status pegawai
    public function edit(Request $request, $id_status_pegawai)
    {
        return response()->json([
            "message" => "Edit data status pegawai dengan id: {$id_status_pegawai} berhasil",
            "edited_data" => [
                "id_status_pegawai" => $id_status_pegawai,
                "status_pegawai" => $request->status_pegawai,
                "keterangan" => $request->keterangan,
            ]
        ], 201);
    }

    // Delete status pegawai By Id
    public function delete($id_status_pegawai)
    {
        return response()->json([
            "message" => "Berhasil menghapus data status pegawai dengan id: {$id_status_pegawai}",
        ], 201);
    }
}
