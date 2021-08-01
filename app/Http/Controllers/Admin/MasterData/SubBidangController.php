<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Admin\MasterData\SubBidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubBidangController extends Controller
{
    // Get All Sub Bidang
    public function getAll()
    {
        $data = SubBidang::getAll();

        // Tambah nomor urut
        $no = 1;
        foreach ($data as $key => $d) {
            $d->no = $no++;
        }

        return response()->json([
            "message" => "Berhasil mendapatkan semua data sub bidang",
            "data" => $data
        ], 200);
    }

    // Get Sub Bidang By Id
    public function getById($id_sub_bidang)
    {
        $data = SubBidang::getById($id_sub_bidang);

        if ($data) {
            // Jika data ditemukan -> 200 OK
            return response()->json([
                "message" => "Berhasil mendapatkan data sub bidang dengan id: {$id_sub_bidang}",
                "data" => $data
            ], 200);
        } else {
            // Jika tidak -> 404 NOT FOUND
            return response()->json([
                "message" => "Data sub bidang dengan id: {$id_sub_bidang} tidak ditemukan",
            ], 404);
        }
    }

    // Insert Sub Bidang
    public function insert(Request $request)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "id_bidang"        => "required",
                "nama_sub_bidang"  => "required",
                "keterangan"       => "required",
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

        $insert = SubBidang::insert($request);

        if ($insert) {
            // Jika insert data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Tambah data sub bidang berhasil",
                "input_data" => [
                    "id_bidang" => $request->id_bidang,
                    "nama_sub_bidang" => $request->nama_sub_bidang,
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

    // Edit Sub Bidang
    public function edit(Request $request, $id_sub_bidang)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "id_bidang" => "required",
                "nama_sub_bidang" => "required",
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

        $edit = SubBidang::edit($request, $id_sub_bidang);

        if ($edit !== 404) {
            // Jika edit data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Edit data sub bidang dengan id: {$id_sub_bidang} berhasil",
                "edited_data" => $edit
            ], 201);
        } elseif ($edit === 404) {
            // Jika data tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data sub bidang dengan id: {$id_sub_bidang} tidak ditemukan"
            ], 404);
        } elseif ($edit === 500) {
            // Jika gagal -> 500 SERVER ERROR
            return response()->json([
                "message" => "Terjadi kesalahan server",
            ], 500);
        }
    }

    // Delete Sub Bidang By Id
    public function delete($id_sub_bidang)
    {
        // Tabel - tabel
        $tbl_sub_bidang = "sub_bidang";
        $tbl_bidang = "bidang";

        // Get data sub bidang by id
        $data = SubBidang::where('id_sub_bidang', '=', $id_sub_bidang)
            ->select("$tbl_sub_bidang.*", "$tbl_bidang.nama_bidang AS bidang")
            ->leftJoin($tbl_bidang, "$tbl_bidang.id_bidang", "=", "$tbl_sub_bidang.id_bidang")
            ->first();

        $delete = SubBidang::deleteSubBidang($id_sub_bidang);

        if ($delete !== 404) {
            // Jika proses delete berhasil -> 201 CREATED
            return response()->json([
                "message" => "Berhasil menghapus data sub bidang dengan id: {$id_sub_bidang}",
                "deleted_data" => $data
            ], 201);
        } elseif ($delete === 404) {
            // Jika data tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data sub bidang dengan id: {$id_sub_bidang} tidak ditemukan",
            ], 404);
        } elseif ($delete === 500) {
            // Jika proses delete gagal ->  500 SERVER ERROR
            return response()->json([
                "message" => "Terjadi kesalahan server",
            ], 500);
        }
    }
}
