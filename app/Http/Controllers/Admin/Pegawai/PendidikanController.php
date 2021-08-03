<?php

namespace App\Http\Controllers\Admin\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Admin\Pegawai\Pendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PendidikanController extends Controller
{
    // Get All Pendidikan
    public function getAll($id_pegawai)
    {
        $data = Pendidikan::getAll($id_pegawai);

        if ($data !== 404) {
            return response()->json([
                "message" => "Berhasil mendapatkan semua data pendidikan dari pegawai dengan id: {$id_pegawai}",
                "data" => $data
            ], 200);
        } else {
            return response()->json([
                "message" => "Data pendidikan dari pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        }
    }

    // Get Pendidikan By Id
    public function getById($id_pegawai, $id_pendidikan)
    {
        $data = Pendidikan::getById($id_pegawai, $id_pendidikan);

        if ($data === 404) {
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        } elseif ($data === 405) {
            return response()->json([
                "message" => "Data pendidikan dengan id: {$id_pendidikan} tidak ditemukan"
            ], 404);
        } else {
            return response()->json([
                "message" => "Berhasil mendapatkan data pendidikan dengan id: {$id_pendidikan}",
                "data" => $data
            ], 200);
        }
    }

    // Insert Pendidikan
    public function insert(Request $request, $id_pegawai)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "nama_akademi" => "required",
                "jenjang"      => "required",
                "jurusan"      => "required",
                "tahun_lulus"  => "required",
                "no_ijazah"    => "required",
                "foto_ijazah"  => 'mimes:jpg,jpeg,png,pdf|max:1048',
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

        $insert = Pendidikan::insert($request, $id_pegawai);

        if ($insert) {
            // Jika insert data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Tambah data pendidikan berhasil",
                "input_data" => $request->all()
            ], 201);
        } else {
            // Jika gagal -> 500 SERVER ERROR
            return response()->json([
                "message" => "Terjadi kesalahan server",
            ], 500);
        }
    }

    // Edit Pendidikan
    public function edit(Request $request, $id_pegawai, $id_pendidikan)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "nama_akademi" => "required",
                "jenjang"      => "required",
                "jurusan"      => "required",
                "tahun_lulus"  => "required",
                "no_ijazah"    => "required",
                "foto_ijazah"  => 'mimes:jpg,jpeg,png,pdf|max:1048',
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

        $edit = Pendidikan::edit($request, $id_pegawai, $id_pendidikan);

        if ($edit === 404) {
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        } elseif ($edit === 405) {
            return response()->json([
                "message" => "Data pendidikan dengan id: {$id_pendidikan} tidak ditemukan"
            ], 404);
        } else {
            return response()->json([
                "message" => "Edit data pendidikan dengan id: {$id_pendidikan} berhasil",
                "data" => $edit
            ], 200);
        }
    }

    // Delete Pendidikan By Id
    public function delete($id_pegawai, $id_pendidikan)
    {
        // Get data pendidikan by id
        $data = Pendidikan::where('id_pendidikan', '=', $id_pendidikan)
            ->first();

        $delete = Pendidikan::deletePendidikan($id_pegawai, $id_pendidikan);

        if ($delete === 404) {
            // Jika data pegawai tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan",
            ], 404);
        } elseif ($delete === 405) {
            // Jika data pendidikan tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pendidikan dengan id: {$id_pendidikan} tidak ditemukan",
            ], 404);
        } else {
            return response()->json([
                "message" => "Berhasil menghapus data pendidikan dengan id: {$id_pendidikan}",
                "deleted_data" => $data
            ], 201);
        }
    }

    // Get Jenjang Pendidikan
    public function getJenjangPendidikan()
    {
        $data = Pendidikan::getJenjangPendidikan();

        return response()->json([
            "message" => "Berhasil mendapatkan semua jenjang pendidikan",
            "data" => $data
        ]);
    }
}
