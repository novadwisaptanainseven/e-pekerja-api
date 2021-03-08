<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Admin\MasterData\Bidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BidangController extends Controller
{
    // Get All Bidang
    public function getAll()
    {
        $data = Bidang::all();

        // Tambah nomor urut
        $no = 1;
        foreach ($data as $key => $d) {
            $d->no = $no++;
        }

        return response()->json([
            "message" => "Berhasil mendapatkan semua data bidang",
            "data" => $data
        ], 200);
    }

    // Get Bidang By Id
    public function getById($id_bidang)
    {
        $data = Bidang::where('id_bidang', '=', $id_bidang)->first();

        if ($data) {
            // Jika data ditemukan -> 200 OK
            return response()->json([
                "message" => "Berhasil mendapatkan data bidang dengan id: {$id_bidang}",
                "data" => $data
            ], 200);
        } else {
            // Jika tidak -> 404 NOT FOUND
            return response()->json([
                "message" => "Data bidang dengan id: {$id_bidang} tidak ditemukan",
            ], 404);
        }
    }

    // Insert Bidang
    public function insert(Request $request)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "nama_bidang"   => "required",
                "keterangan"   => "required",
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

        $insert = Bidang::insert($request);

        if ($insert) {
            // Jika insert data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Tambah data bidang berhasil",
                "input_data" => [
                    "nama_bidang" => $request->nama_bidang,
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

    // Edit Bidang
    public function edit(Request $request, $id_bidang)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "nama_bidang" => "required",
                "keterangan"  => "required"
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

        $edit = Bidang::edit($request, $id_bidang);

        if ($edit !== 404) {
            // Jika edit data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Edit data bidang dengan id: {$id_bidang} berhasil",
                "edited_data" => [
                    "id_bidang" => $id_bidang,
                    "nama_bidang" => $request->nama_bidang,
                    "keterangan" => $request->keterangan,
                ]
            ], 201);
        } elseif ($edit === 404) {
            // Jika data tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data bidang dengan id: {$id_bidang} tidak ditemukan"
            ], 404);
        } elseif ($edit === 500) {
            // Jika gagal -> 500 SERVER ERROR
            return response()->json([
                "message" => "Terjadi kesalahan server",
            ], 500);
        }
    }

    // Delete Bidang By Id
    public function delete($id_bidang)
    {
        // Get data bidang by id
        $data = Bidang::where('id_bidang', '=', $id_bidang)->first();

        $delete = Bidang::deleteBidang($id_bidang);

        if ($delete !== 404) {
            // Jika proses delete berhasil -> 201 CREATED
            return response()->json([
                "message" => "Berhasil menghapus data bidang dengan id: {$id_bidang}",
                "deleted_data" => $data
            ], 201);
        } elseif ($delete === 404) {
            // Jika data tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data bidang dengan id: {$id_bidang} tidak ditemukan",
            ], 404);
        } elseif ($delete === 500) {
            // Jika proses delete gagal ->  500 SERVER ERROR
            return response()->json([
                "message" => "Terjadi kesalahan server",
            ], 500);
        }
    }
}
