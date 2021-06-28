<?php

namespace App\Http\Controllers\Admin\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Admin\Pegawai\Diklat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiklatController extends Controller
{
    // Get All Diklat
    public function getAll($id_pegawai)
    {
        $data = Diklat::getAll($id_pegawai);

        if ($data !== 404) {
            return response()->json([
                "message" => "Berhasil mendapatkan semua data diklat dari pegawai dengan id: {$id_pegawai}",
                "data" => $data
            ], 200);
        } else {
            return response()->json([
                "message" => "Data diklat dari pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        }
    }

    // Get Diklat By Id
    public function getById($id_pegawai, $id_diklat)
    {
        $data = Diklat::getById($id_pegawai, $id_diklat);

        if ($data === 404) {
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        } elseif ($data === 405) {
            return response()->json([
                "message" => "Data diklat dengan id: {$id_diklat} tidak ditemukan"
            ], 404);
        } else {
            return response()->json([
                "message" => "Berhasil mendapatkan data diklat dengan id: {$id_diklat}",
                "data" => $data
            ], 200);
        }
    }

    // Insert Diklat
    public function insert(Request $request, $id_pegawai)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "nama_diklat"   => "required",
                "jenis_diklat"  => "required",
                "penyelenggara" => "required",
                "tahun_diklat"  => "required",
                "jumlah_jam"    => "required",
                "dokumentasi"   => 'mimes:jpg,jpeg,png,pdf|max:1048',
                "sertifikat"    => 'mimes:jpg,jpeg,png,pdf|max:1048',
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

        $insert = Diklat::insert($request, $id_pegawai);

        if ($insert) {
            // Jika insert data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Tambah data diklat berhasil",
                "input_data" => $request->all()
            ], 201);
        } else {
            // Jika gagal -> 500 SERVER ERROR
            return response()->json([
                "message" => "Terjadi kesalahan server",
            ], 500);
        }
    }

    // Edit Diklat
    public function edit(Request $request, $id_pegawai, $id_diklat)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "nama_diklat"   => "required",
                "jenis_diklat"  => "required",
                "penyelenggara" => "required",
                "tahun_diklat"  => "required",
                "jumlah_jam"    => "required",
                "dokumentasi"   => 'mimes:jpg,jpeg,png,pdf|max:1048',
                "sertifikat"    => 'mimes:jpg,jpeg,png,pdf|max:1048',
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

        $edit = Diklat::edit($request, $id_pegawai, $id_diklat);

        if ($edit === 404) {
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        } elseif ($edit === 405) {
            return response()->json([
                "message" => "Data diklat dengan id: {$id_diklat} tidak ditemukan"
            ], 404);
        } else {
            return response()->json([
                "message" => "Edit data diklat dengan id: {$id_diklat} berhasil",
                "data" => $edit
            ], 200);
        }
    }

    // Delete Diklat By Id
    public function delete($id_pegawai, $id_diklat)
    {
        // Get data diklat by id
        $data = Diklat::where('id_diklat', '=', $id_diklat)
            ->first();

        $delete = Diklat::deleteDiklat($id_pegawai, $id_diklat);

        if ($delete === 404) {
            // Jika data pegawai tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan",
            ], 404);
        } elseif ($delete === 405) {
            // Jika data diklat tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data diklat dengan id: {$id_diklat} tidak ditemukan",
            ], 404);
        } else {
            return response()->json([
                "message" => "Berhasil menghapus data diklat dengan id: {$id_diklat}",
                "deleted_data" => $data
            ], 201);
        }
    }
}
