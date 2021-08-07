<?php

namespace App\Http\Controllers\Admin\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Admin\Pegawai\Penghargaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenghargaanController extends Controller
{
    // Get All Penghargaan
    public function getAll($id_pegawai)
    {
        $data = Penghargaan::getAll($id_pegawai);

        if ($data !== 404) {
            return response()->json([
                "message" => "Berhasil mendapatkan semua data penghargaan dari pegawai dengan id: {$id_pegawai}",
                "data" => $data
            ], 200);
        } else {
            return response()->json([
                "message" => "Data penghargaan dari pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        }
    }

    // Get Penghargaan By Id
    public function getById($id_pegawai, $id_penghargaan)
    {
        dd($id_pegawai);
        $data = Penghargaan::getById($id_pegawai, $id_penghargaan);

        if ($data === 404) {
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        } elseif ($data === 405) {
            return response()->json([
                "message" => "Data penghargaan dengan id: {$id_penghargaan} tidak ditemukan"
            ], 404);
        } else {
            return response()->json([
                "message" => "Berhasil mendapatkan data penghargaan dengan id: {$id_penghargaan}",
                "data" => $data
            ], 200);
        }
    }

    // Insert Penghargaan
    public function insert(Request $request, $id_pegawai)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "nama_penghargaan" => "required",
                "pemberi"          => "required",
                "tgl_penghargaan"  => "required",
                "dokumentasi"      => "mimes:jpg,jpeg,png,pdf|max:1048",
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

        $insert = Penghargaan::insert($request, $id_pegawai);

        if ($insert) {
            // Jika insert data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Tambah data penghargaan berhasil",
                "input_data" => $request->all()
            ], 201);
        } else {
            // Jika gagal -> 500 SERVER ERROR
            return response()->json([
                "message" => "Terjadi kesalahan server",
            ], 500);
        }
    }

    // Edit Penghargaan
    public function edit(Request $request, $id_pegawai, $id_penghargaan)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "nama_penghargaan" => "required",
                "pemberi"          => "required",
                "tgl_penghargaan"  => "required",
                "dokumentasi"      => "mimes:jpg,jpeg,png,pdf|max:1048",
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

        $edit = Penghargaan::edit($request, $id_pegawai, $id_penghargaan);

        if ($edit === 404) {
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        } elseif ($edit === 405) {
            return response()->json([
                "message" => "Data penghargaan dengan id: {$id_penghargaan} tidak ditemukan"
            ], 404);
        } else {
            return response()->json([
                "message" => "Edit data penghargaan dengan id: {$id_penghargaan} berhasil",
                "edited_data" => $edit
            ], 201);
        }
    }

    // Delete Penghargaan By Id
    public function delete($id_pegawai, $id_penghargaan)
    {
        // Get data penghargaan by id
        $data = Penghargaan::where('id_penghargaan', '=', $id_penghargaan)
            ->first();

        $delete = Penghargaan::deletePenghargaan($id_pegawai, $id_penghargaan);

        if ($delete === 404) {
            // Jika data pegawai tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan",
            ], 404);
        } elseif ($delete === 405) {
            // Jika data penghargaan tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data penghargaan dengan id: {$id_penghargaan} tidak ditemukan",
            ], 404);
        } else {
            return response()->json([
                "message" => "Berhasil menghapus data penghargaan dengan id: {$id_penghargaan}",
                "deleted_data" => $data
            ], 201);
        }
    }
}
