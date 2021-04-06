<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Admin\MasterData\PangkatEselon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PangkatEselonController extends Controller
{
    // Get All Pangkat Eselon
    public function getAll()
    {
        $data = PangkatEselon::all();

        // Tambah nomor urut
        $no = 1;
        foreach ($data as $key => $d) {
            $d->no = $no++;
        }

        return response()->json([
            "message" => "Berhasil mendapatkan semua data pangkat eselon",
            "data" => $data
        ], 200);
    }

    // Get Pangkat Eselon By Id
    public function getById($id_pangkat_eselon)
    {
        $data = PangkatEselon::where('id_pangkat_eselon', '=', $id_pangkat_eselon)->first();

        if ($data) {
            // Jika data ditemukan -> 200 OK
            return response()->json([
                "message" => "Berhasil mendapatkan data pangkat eselon dengan id: {$id_pangkat_eselon}",
                "data" => $data
            ], 200);
        } else {
            // Jika tidak -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pangkat eselon dengan id: {$id_pangkat_eselon} tidak ditemukan",
            ], 404);
        }
    }

    // Insert Pangkat Eselon
    public function insert(Request $request)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "eselon"   => "required",
                // "keterangan" => "required"
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

        $insert = PangkatEselon::insert($request);

        if ($insert) {
            // Jika insert data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Tambah data pangkat eselon berhasil",
                "input_data" => [
                    "eselon" => $request->eselon,
                    "keterangan" => $request->keterangan,
                ]
            ], 201);
        } else {
            // Jika gagal -> 500 SERVER ERROR
            return response()->json([
                "message" => "Terjadi kesalahan server",
            ], 500);
        }
    }

    // Edit Pangkat Eselon
    public function edit(Request $request, $id_pangkat_eselon)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "eselon"   => "required",
                // "keterangan" => "required"
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

        $edit = PangkatEselon::edit($request, $id_pangkat_eselon);

        if ($edit !== 404) {
            // Jika edit data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Edit data pangkat eselon dengan id: {$id_pangkat_eselon} berhasil",
                "edited_data" => [
                    "id_pangkat_eselon" => $id_pangkat_eselon,
                    "eselon" => $request->eselon,
                    "keterangan" => $request->keterangan,
                ]
            ], 201);
        } elseif ($edit === 404) {
            return response()->json([
                "message" => "Data pangkat dengan id: {$id_pangkat_eselon} tidak ditemukan"
            ], 404);
        } elseif ($edit === 500) {
            // Jika gagal -> 500 SERVER ERROR
            return response()->json([
                "message" => "Terjadi kesalahan server",
            ], 500);
        }
    }

    // Delete Pangkat Eselon By Id
    public function delete($id_pangkat_eselon)
    {
        // Get data pangkat eselon by id
        $data = PangkatEselon::where('id_pangkat_eselon', '=', $id_pangkat_eselon)->first();

        $delete = PangkatEselon::deletePangkatEselon($id_pangkat_eselon);

        if ($delete !== 404) {
            // Jika proses delete berhasil -> 201 CREATED
            return response()->json([
                "message" => "Berhasil menghapus data pangkat eselon dengan id: {$id_pangkat_eselon}",
                "deleted_data" => $data
            ], 201);
        } elseif ($delete === 404) {
            // Jika data tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pangkat eselon dengan id: {$id_pangkat_eselon} tidak ditemukan",
            ], 404);
        } elseif ($delete === 500) {
            // Jika proses delete gagal ->  505 SERVER ERROR
            return response()->json([
                "message" => "Terjadi kesalahan server",
            ], 500);
        }
    }
}
