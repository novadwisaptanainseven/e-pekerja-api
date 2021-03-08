<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Admin\MasterData\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JabatanController extends Controller
{
    // Get All Jabatan
    public function getAll()
    {
        $data = Jabatan::all();

        // Tambah nomor urut
        $no = 1;
        foreach ($data as $key => $d) {
            $d->no = $no++;
        }

        return response()->json([
            "message" => "Berhasil mendapatkan semua data jabatan",
            "data" => $data
        ], 200);
    }

    // Get Jabatan By Id
    public function getById($id_jabatan)
    {
        $data = Jabatan::where('id_jabatan', '=', $id_jabatan)->first();

        if ($data) {
            // Jika data ditemukan -> 200 OK
            return response()->json([
                "message" => "Berhasil mendapatkan data jabatan dengan id: {$id_jabatan}",
                "data" => $data
            ], 200);
        } else {
            // Jika tidak -> 404 NOT FOUND
            return response()->json([
                "message" => "Data jabatan dengan id: {$id_jabatan} tidak ditemukan",
            ], 404);
        }
    }

    // Insert Jabatan
    public function insert(Request $request)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "nama_jabatan"   => "required"
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

        $insert = Jabatan::insert($request);

        if ($insert) {
            // Jika insert data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Tambah data jabatan berhasil",
                "input_data" => [
                    "jabatan" => $request->nama_jabatan
                ]
            ], 201);
        } else {
            // Jika gagal -> 500 SERVER ERROR
            return response()->json([
                "message" => "Terjadi kesalahan server",
            ], 500);
        }
    }

    // Edit Jabatan
    public function edit(Request $request, $id_jabatan)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "nama_jabatan"   => "required"
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

        $edit = Jabatan::edit($request, $id_jabatan);

        if ($edit !== 404) {
            // Jika edit data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Edit data jabatan dengan id: {$id_jabatan} berhasil",
                "edited_data" => [
                    "id_jabatan" => $id_jabatan,
                    "nama_jabatan" => $request->nama_jabatan
                ]
            ], 201);
        } elseif ($edit === 404) {
            return response()->json([
                "message" => "Data jabatan dengan id: {$id_jabatan} tidak ditemukan"
            ], 404);
        } elseif ($edit === 500) {
            // Jika gagal -> 500 SERVER ERROR
            return response()->json([
                "message" => "Terjadi kesalahan server",
            ], 500);
        }
    }

    // Delete Jabatan By Id
    public function delete($id_jabatan)
    {
        // Get data jabatan by id
        $data = Jabatan::where('id_jabatan', '=', $id_jabatan)->first();

        $delete = Jabatan::deleteJabatan($id_jabatan);

        if ($delete !== 404) {
            // Jika proses delete berhasil -> 201 CREATED
            return response()->json([
                "message" => "Berhasil menghapus data jabatan dengan id: {$id_jabatan}",
                "deleted_data" => $data
            ], 201);
        } elseif ($delete === 404) {
            // Jika data tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data jabatan dengan id: {$id_jabatan} tidak ditemukan",
            ], 404);
        } elseif ($delete === 500) {
            // Jika proses delete gagal ->  505 SERVER ERROR
            return response()->json([
                "message" => "Terjadi kesalahan server",
            ], 500);
        }

        return response()->json([
            "message" => "Berhasil menghapus data jabatan dengan id: {$id_jabatan}",
        ], 201);
    }
}
