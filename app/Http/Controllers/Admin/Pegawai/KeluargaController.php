<?php

namespace App\Http\Controllers\Admin\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Admin\Pegawai\Keluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KeluargaController extends Controller
{
    // Get All Keluarga
    public function getAll($id_pegawai)
    {
        $data = Keluarga::getAll($id_pegawai);

        if ($data !== 404) {
            return response()->json([
                "message" => "Berhasil mendapatkan semua data keluarga dari pegawai dengan id: {$id_pegawai}",
                "data" => $data
            ], 200);
        } else {
            return response()->json([
                "message" => "Data keluarga dari pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        }
    }

    // Get Keluarga By Id
    public function getById($id_pegawai, $id_keluarga)
    {
        $data = Keluarga::getById($id_pegawai, $id_keluarga);

        if ($data === 404) {
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        } elseif ($data === 405) {
            return response()->json([
                "message" => "Data keluarga dengan id: {$id_keluarga} tidak ditemukan"
            ], 404);
        } else {
            return response()->json([
                "message" => "Berhasil mendapatkan data keluarga dengan id: {$id_keluarga}",
                "data" => $data
            ], 200);
        }
    }

    // Insert Keluarga
    public function insert(Request $request, $id_pegawai)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "nik_nip"       => "required",
                "nama"          => "required",
                "hubungan"      => "required",
                "id_agama"      => "required",
                "jenis_kelamin" => "required",
                "tempat_lahir"  => "required",
                "tgl_lahir"     => "required",
                "pekerjaan"     => "required",
                "telepon"       => "required",
                "alamat"        => "required",
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

        $insert = Keluarga::insert($request, $id_pegawai);

        if ($insert) {
            // Jika insert data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Tambah data keluarga berhasil",
                "input_data" => $request->all()
            ], 201);
        } else {
            // Jika gagal -> 500 SERVER ERROR
            return response()->json([
                "message" => "Terjadi kesalahan server",
            ], 500);
        }
    }

    // Edit Keluarga
    public function edit(Request $request, $id_pegawai, $id_keluarga)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "nik_nip"       => "required",
                "nama"          => "required",
                "hubungan"      => "required",
                "id_agama"      => "required",
                "jenis_kelamin" => "required",
                "tempat_lahir"  => "required",
                "tgl_lahir"     => "required",
                "pekerjaan"     => "required",
                "telepon"       => "required",
                "alamat"        => "required",
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

        $edit = Keluarga::edit($request, $id_pegawai, $id_keluarga);

        if ($edit === 404) {
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        } elseif ($edit === 405) {
            return response()->json([
                "message" => "Data keluarga dengan id: {$id_keluarga} tidak ditemukan"
            ], 404);
        } else {
            return response()->json([
                "message" => "Edit data keluarga dengan id: {$id_keluarga} berhasil",
                "data" => $edit
            ], 200);
        }
    }

    // Delete Keluarga By Id
    public function delete($id_pegawai, $id_keluarga)
    {
        // Tabel - tabel
        $tbl_keluarga = "keluarga";
        $tbl_agama = "agama";

        // Get data keluarga by id
        $data = Keluarga::where('id_keluarga', '=', $id_keluarga)
            ->leftJoin($tbl_agama, "$tbl_agama.id_agama", "=", "$tbl_keluarga.id_agama")
            ->first();

        $delete = Keluarga::deleteKeluarga($id_pegawai, $id_keluarga);

        if ($delete === 404) {
            // Jika data pegawai tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan",
            ], 404);
        } elseif ($delete === 405) {
            // Jika data keluarga tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data keluarga dengan id: {$id_keluarga} tidak ditemukan",
            ], 404);
        } else {
            return response()->json([
                "message" => "Berhasil menghapus data keluarga dengan id: {$id_keluarga}",
                "deleted_data" => $data
            ], 201);
        }
    }
}
