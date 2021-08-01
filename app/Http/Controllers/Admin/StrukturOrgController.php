<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\StrukturOrg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StrukturOrgController extends Controller
{
    // Get struktur organisasi
    public function get()
    {
        $data = StrukturOrg::all();

        return response()->json([
            "message" => "Berhasil mendapatkan struktur organisasi",
            "data" => $data
        ], 200);
    }

    // Insert gambar struktur organisasi
    public function insertGambar(Request $req, $id)
    {
        // Validation
        $message = [
            "required" => ":attribute harus diisi",
            "max" => ":attribute kapasitas file melebihi 1 MB",
        ];

        $validator = Validator::make(
            $req->all(),
            [
                "gambar" => "required|max:1048|mimes:jpg,jpeg,png",
            ],
            $message
        );
        // Validation Check
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        // Get data struktur by id
        $struktur = StrukturOrg::find($id);
        if (!$struktur) {
            return response()->json([
                "message" => "Struktur dengan id: $id, tidak ditemukan",
            ], 404);
        }

        if (!$req->file("gambar")) {
            $file = $struktur->gambar;
        } else {
            Storage::delete($struktur->gambar);
            $file = $req->file("gambar");
            // Sanitasi nama file
            $sanitize = sanitizeFile($file);
            $file = $file->storeAs("documents", rand(0, 9999) . time() . '-' . $sanitize);
        }

        $struktur->update([
            "gambar" => $file
        ]);

        return response()->json([
            "message" => "Berhasil menambahkan gambar struktur untuk $struktur->nama_struktur",
            "data_updated" => $struktur
        ], 201);
    }

    // Delete gambar struktur
    public function deleteGambar($id)
    {
        $data = StrukturOrg::find($id);

        if ($data) {
            // Delete gambar di storage
            Storage::delete($data->gambar);

            // Delete data di db
            $data->gambar = "";
            $data->save();

            return response()->json([
                "message" => "Berhasil menghapus gambar dengan id struktur: $id",
                "data_deleted" => $data
            ], 201);
        } else {
            return response()->json([
                "message" => "Struktur dengan id: $id, tidak ditemukan",
            ], 404);
        }
    }
}
