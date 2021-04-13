<?php

namespace App\Http\Controllers\User\DataKepegawaian;

use App\Http\Controllers\Controller;
use App\Models\User\DataKepegawaian\Berkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BerkasController extends Controller
{
    // Get All Berkas
    public function getAll()
    {
        // Get Current User
        $user = Auth::user();

        $data = Berkas::getAll($user->id_pegawai);

        if ($data !== 404) {
            return response()->json([
                "message" => "Berhasil mendapatkan semua data berkas dari pegawai dengan id: {$user->id_pegawai} berdasarkan user saat ini: $user->id",
                "data" => $data
            ], 200);
        } else {
            return response()->json([
                "message" => "Data berkas dari pegawai dengan id: {$user->id_pegawai} tidak ditemukan"
            ], 404);
        }
    }

    // Insert Berkas
    public function insert(Request $request)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "nama_berkas" => "mimes:jpg,jpeg,png,pdf|max:1048|required",
                "keterangan"  => "required",
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

        // Get Current User
        $user = Auth::user();

        $insert = Berkas::insert($request, $user->id_pegawai);

        if ($insert) {
            // Jika insert data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Tambah data berkas berhasil",
                "input_data" => $request->all()
            ], 201);
        } else {
            // Jika gagal -> 500 SERVER ERROR
            return response()->json([
                "message" => "Terjadi kesalahan server",
            ], 500);
        }
    }

    // Delete Berkas By Id
    public function deleteBerkas($id_berkas)
    {
        // Get data berkas by id
        $data = Berkas::where('id_berkas', '=', $id_berkas)
            ->first();

        // Get Current User
        $user = Auth::user();

        $delete = Berkas::deleteBerkas($user->id_pegawai, $id_berkas);

        if ($delete === 404) {
            // Jika data pegawai tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pegawai dengan id: {$user->id_pegawai} tidak ditemukan",
            ], 404);
        } elseif ($delete === 405) {
            // Jika data berkas tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data berkas dengan id: {$id_berkas} tidak ditemukan",
            ], 404);
        } else {
            return response()->json([
                "message" => "Berhasil menghapus data berkas dengan id: {$id_berkas}",
                "deleted_data" => $data
            ], 201);
        }
    }
}
