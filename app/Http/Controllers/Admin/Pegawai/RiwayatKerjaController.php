<?php

namespace App\Http\Controllers\Admin\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Admin\Pegawai\RiwayatKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RiwayatKerjaController extends Controller
{
    // Get All Riwayat Kerja
    public function getAll($id_pegawai)
    {
        $data = RiwayatKerja::getAll($id_pegawai);

        if ($data !== 404) {
            return response()->json([
                "message" => "Berhasil mendapatkan semua data riwayat kerja dari pegawai dengan id: {$id_pegawai}",
                "data" => $data
            ], 200);
        } else {
            return response()->json([
                "message" => "Data riwayat kerja dari pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        }
    }

    // Get Riwayat Kerja By Id
    public function getById($id_pegawai, $id_riwayat_kerja)
    {
        $data = RiwayatKerja::getById($id_pegawai, $id_riwayat_kerja);

        if ($data === 404) {
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        } elseif ($data === 405) {
            return response()->json([
                "message" => "Data riwayat kerja dengan id: {$id_riwayat_kerja} tidak ditemukan"
            ], 404);
        } else {
            return response()->json([
                "message" => "Berhasil mendapatkan data riwayat kerja dengan id: {$id_riwayat_kerja}",
                "data" => $data
            ], 200);
        }
    }

    // Insert Riwayat Kerja
    public function insert(Request $request, $id_pegawai)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "kantor"     => "required",
                "jabatan"    => "required",
                "tgl_masuk"  => "required",
                "tgl_keluar" => "required",
                "keterangan" => "required",
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

        $insert = RiwayatKerja::insert($request, $id_pegawai);

        if ($insert) {
            // Jika insert data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Tambah data riwayat kerja berhasil",
                "input_data" => $request->all()
            ], 201);
        } else {
            // Jika gagal -> 500 SERVER ERROR
            return response()->json([
                "message" => "Terjadi kesalahan server",
            ], 500);
        }
    }

    // Edit Riwayat Kerja
    public function edit(Request $request, $id_pegawai, $id_riwayat_kerja)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "kantor"     => "required",
                "jabatan"    => "required",
                "tgl_masuk"  => "required",
                "tgl_keluar" => "required",
                "keterangan" => "required",
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

        $edit = RiwayatKerja::edit($request, $id_pegawai, $id_riwayat_kerja);

        if ($edit === 404) {
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        } elseif ($edit === 405) {
            return response()->json([
                "message" => "Data riwayat kerja dengan id: {$id_riwayat_kerja} tidak ditemukan"
            ], 404);
        } else {
            return response()->json([
                "message" => "Edit data riwayat kerja dengan id: {$id_riwayat_kerja} berhasil",
                "data" => $edit
            ], 200);
        }
    }

    // Delete Riwayat Kerja By Id
    public function delete($id_pegawai, $id_riwayat_kerja)
    {
        // Get data riwayat kerja by id
        $data = RiwayatKerja::where('id_riwayat_kerja', '=', $id_riwayat_kerja)
            ->first();

        $delete = RiwayatKerja::deleteRiwayatKerja($id_pegawai, $id_riwayat_kerja);

        if ($delete === 404) {
            // Jika data pegawai tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan",
            ], 404);
        } elseif ($delete === 405) {
            // Jika data riwayat kerja tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data riwayat kerja dengan id: {$id_riwayat_kerja} tidak ditemukan",
            ], 404);
        } else {
            return response()->json([
                "message" => "Berhasil menghapus data riwayat kerja dengan id: {$id_riwayat_kerja}",
                "deleted_data" => $data
            ], 201);
        }
    }
}
