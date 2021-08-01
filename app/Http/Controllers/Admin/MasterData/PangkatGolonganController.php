<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Admin\MasterData\PangkatGolongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PangkatGolonganController extends Controller
{
    // Get All Pangkat Golongan
    public function getAll()
    {
        $data = PangkatGolongan::all();

        // Tambah nomor urut
        $no = 1;
        foreach ($data as $key => $d) {
            $d->no = $no++;
        }

        return response()->json([
            "message" => "Berhasil mendapatkan semua data pangkat golongan",
            "data" => $data
        ], 200);
    }

    // Get Pangkat Golongan By Id
    public function getById($id_pangkat_golongan)
    {
        $data = PangkatGolongan::where('id_pangkat_golongan', '=', $id_pangkat_golongan)->first();

        if ($data) {
            // Jika data ditemukan -> 200 OK
            return response()->json([
                "message" => "Berhasil mendapatkan data pangkat golongan dengan id: {$id_pangkat_golongan}",
                "data" => $data
            ], 200);
        } else {
            // Jika tidak -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pangkat golongan dengan id: {$id_pangkat_golongan} tidak ditemukan",
            ], 404);
        }
    }

    // Insert Pangkat Golongan
    public function insert(Request $request)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "golongan"   => "required",
                "keterangan" => "required"
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

        $insert = PangkatGolongan::insert($request);

        if ($insert) {
            // Jika insert data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Tambah data pangkat golongan berhasil",
                "input_data" => [
                    "golongan" => $request->golongan,
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

    // Edit Pangkat Golongan
    public function edit(Request $request, $id_pangkat_golongan)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "golongan"   => "required",
                "keterangan" => "required"
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

        $edit = PangkatGolongan::edit($request, $id_pangkat_golongan);

        if ($edit !== 404) {
            // Jika edit data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Edit data pangkat golongan dengan id: {$id_pangkat_golongan} berhasil",
                "edited_data" => [
                    "id_pangkat_golongan" => $id_pangkat_golongan,
                    "golongan" => $request->golongan,
                    "keterangan" => $request->keterangan,
                ]
            ], 201);
        } elseif ($edit === 404) {
            return response()->json([
                "message" => "Data pangkat dengan id: {$id_pangkat_golongan} tidak ditemukan"
            ], 404);
        } elseif ($edit === 500) {
            // Jika gagal -> 500 SERVER ERROR
            return response()->json([
                "message" => "Terjadi kesalahan server",
            ], 500);
        }
    }

    // Delete Pangkat Eselon By Id
    public function delete($id_pangkat_golongan)
    {
        // Get data pangkat golongan by id
        $data = PangkatGolongan::where('id_pangkat_golongan', '=', $id_pangkat_golongan)->first();

        $delete = PangkatGolongan::deletePangkatGolongan($id_pangkat_golongan);

        if ($delete !== 404) {
            // Jika proses delete berhasil -> 201 CREATED
            return response()->json([
                "message" => "Berhasil menghapus data pangkat golongan dengan id: {$id_pangkat_golongan}",
                "deleted_data" => $data
            ], 201);
        } elseif ($delete === 404) {
            // Jika data tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pangkat golongan dengan id: {$id_pangkat_golongan} tidak ditemukan",
            ], 404);
        } elseif ($delete === 500) {
            // Jika proses delete gagal ->  505 SERVER ERROR
            return response()->json([
                "message" => "Terjadi kesalahan server",
            ], 500);
        }

        return response()->json([
            "message" => "Berhasil menghapus data pangkat golongan dengan id: {$id_pangkat_golongan}",
        ], 201);
    }
}
