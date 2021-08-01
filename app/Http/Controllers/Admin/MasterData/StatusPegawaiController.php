<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Admin\MasterData\StatusPegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StatusPegawaiController extends Controller
{
    // Get All Status Pegawai
    public function getAll()
    {
        $data = StatusPegawai::all();

        // Tambah nomor urut
        $no = 1;
        foreach ($data as $key => $d) {
            $d->no = $no++;
        }

        return response()->json([
            "message" => "Berhasil mendapatkan semua data status pegawai",
            "data" => $data
        ], 200);
    }

    // Get status pegawai By Id
    public function getById($id_status_pegawai)
    {
        $data = StatusPegawai::where('id_status_pegawai', '=', $id_status_pegawai)->first();

        if ($data) {
            // Jika data ditemukan -> 200 OK
            return response()->json([
                "message" => "Berhasil mendapatkan data status pegawai dengan id: {$id_status_pegawai}",
                "data" => $data
            ], 200);
        } else {
            // Jika tidak -> 404 NOT FOUND
            return response()->json([
                "message" => "Data status_pegawai dengan id: {$id_status_pegawai} tidak ditemukan",
            ], 404);
        }
    }

    // Insert status pegawai
    public function insert(Request $request)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "status_pegawai"        => "required",
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

        $insert = StatusPegawai::insert($request);

        if ($insert) {
            // Jika insert data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Tambah data status pegawai berhasil",
                "input_data" => [
                    "status_pegawai" => $request->status_pegawai,
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

    // Edit status pegawai
    public function edit(Request $request, $id_status_pegawai)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "status_pegawai" => "required",
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

        $edit = StatusPegawai::edit($request, $id_status_pegawai);

        if ($edit !== 404) {
            // Jika edit data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Edit data status pegawai dengan id: {$id_status_pegawai} berhasil",
                "edited_data" => [
                    "id_status_pegawai" => $id_status_pegawai,
                    "status_pegawai" => $request->status_pegawai,
                    "keterangan" => $request->keterangan,
                ]
            ], 201);
        } elseif ($edit === 404) {
            // Jika data tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data status pegawai dengan id: {$id_status_pegawai} tidak ditemukan"
            ], 404);
        } elseif ($edit === 500) {
            // Jika gagal -> 500 SERVER ERROR
            return response()->json([
                "message" => "Terjadi kesalahan server",
            ], 500);
        }
    }

    // Delete status pegawai By Id
    public function delete($id_status_pegawai)
    {
        // Get data status pegawai by id
        $data = StatusPegawai::where('id_status_pegawai', '=', $id_status_pegawai)->first();

        $delete = StatusPegawai::deleteStatusPegawai($id_status_pegawai);

        if ($delete !== 404) {
            // Jika proses delete berhasil -> 201 CREATED
            return response()->json([
                "message" => "Berhasil menghapus data status pegawai dengan id: {$id_status_pegawai}",
                "deleted_data" => $data
            ], 201);
        } elseif ($delete === 404) {
            // Jika data tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data status pegawai dengan id: {$id_status_pegawai} tidak ditemukan",
            ], 404);
        } elseif ($delete === 500) {
            // Jika proses delete gagal ->  500 SERVER ERROR
            return response()->json([
                "message" => "Terjadi kesalahan server",
            ], 500);
        }
    }
}
