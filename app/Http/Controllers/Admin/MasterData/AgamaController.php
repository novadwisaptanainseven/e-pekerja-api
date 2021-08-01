<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Admin\MasterData\Agama;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AgamaController extends Controller
{
    // Get All Agama
    public function getAll()
    {
        $data = Agama::all();

        // Tambah nomor urut
        $no = 1;
        foreach ($data as $key => $d) {
            $d->no = $no++;
        }

        return response()->json([
            "message" => "Berhasil mendapatkan semua data agama",
            "data" => $data
        ], 200);
    }

    // Get Agama By Id
    public function getById($id_agama)
    {
        $data = Agama::where('id_agama', '=', $id_agama)->first();

        if ($data) {
            // Jika data ditemukan -> 200 OK
            return response()->json([
                "message" => "Berhasil mendapatkan data agama dengan id: {$id_agama}",
                "data" => $data
            ], 200);
        } else {
            // Jika tidak -> 404 NOT FOUND
            return response()->json([
                "message" => "Data agama dengan id: {$id_agama} tidak ditemukan",
            ], 404);
        }
    }

    // Insert Agama
    public function insert(Request $request)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make($request->all(), ["agama" => "required"], $messages);

        // Validation Check
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }
        // End of Validation

        $insert = Agama::insert($request);

        if ($insert) {
            // Jika insert data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Tambah data agama berhasil",
                "input_data" => [
                    "agama" => $request->agama
                ]
            ], 201);
        } else {
            // Jika gagal -> 500 SERVER ERROR
            return response()->json([
                "message" => "Terjadi kesalahan server",
            ], 500);
        }
    }

    // Edit Agama
    public function edit(Request $request, $id_agama)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make($request->all(), ["agama" => "required"], $messages);

        // Validation Check
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }
        // End of Validation

        $edit = Agama::edit($request, $id_agama);

        if ($edit !== 404) {
            // Jika edit data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Edit agama dengan id: {$id_agama} berhasil",
                "edited_data" => [
                    "id_agama" => $id_agama,
                    "agama" => $request->agama
                ]
            ], 201);
        } elseif ($edit === 404) {
            return response()->json([
                "message" => "Data agama dengan id: {$id_agama} tidak ditemukan"
            ], 404);
        } elseif ($edit === 500) {
            // Jika gagal -> 500 SERVER ERROR
            return response()->json([
                "message" => "Terjadi kesalahan server",
            ], 500);
        }
    }

    // Delete Agama By Id
    public function delete($id_agama)
    {
        // Get data agama by id
        $data_agama = Agama::where('id_agama', '=', $id_agama)->first();

        $delete_agama = Agama::deleteAgama($id_agama);

        if ($delete_agama !== 404) {
            // Jika proses delete berhasil -> 201 CREATED
            return response()->json([
                "message" => "Berhasil menghapus data agama dengan id: {$id_agama}",
                "deleted_data" => $data_agama
            ], 201);
        } elseif ($delete_agama === 404) {
            // Jika data tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data agama dengan id: {$id_agama} tidak ditemukan",
            ], 404);
        } elseif ($delete_agama === 500) {
            // Jika proses delete gagal ->  505 SERVER ERROR
            return response()->json([
                "message" => "Terjadi kesalahan server",
            ], 500);
        }
    }
}
