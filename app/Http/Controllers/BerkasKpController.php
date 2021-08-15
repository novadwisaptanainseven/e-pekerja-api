<?php

namespace App\Http\Controllers;

use App\Models\Admin\KenaikanPangkat;
use App\Models\Admin\Pegawai\PNS;
use App\Models\BerkasKp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isEmpty;

class BerkasKpController extends Controller
{
    // Get All Berkas KP by Id Pegawai
    public function get($id_pegawai)
    {
        $pegawai = PNS::select(
            "pegawai.*",
            "pangkat_golongan.golongan",
            "pangkat_golongan.keterangan as ket_golongan"
        )
            ->where("id_pegawai", "=", $id_pegawai)
            ->join("pangkat_golongan", "pangkat_golongan.id_pangkat_golongan", "=", "pegawai.id_golongan")->first();
        $berkas_kp = BerkasKp::where("id_pegawai", "=", $id_pegawai)
            ->orderByDesc("created_at")
            ->get();
        $kenaikan_pangkat = KenaikanPangkat::where("id_pegawai", "=", $id_pegawai)->first();

        // Apakah pegawai ditemukan
        if ($pegawai) {
            $output = [
                "pegawai" => $pegawai,
                "kenaikan_pangkat" => $kenaikan_pangkat,
                "berkas_kp" => $berkas_kp
            ];

            return response()->json([
                "message" => "Berhasil mendapatkan semua berkas kenaikan pangkat dengan id pegawai: $id_pegawai",
                "data" => $output
            ], 200);
        } else {
            return response()->json([
                "message" => "Pegawai dengan id: $id_pegawai tidak ditemukan"
            ], 404);
        }
    }

    // Insert Berkas KP by ID Pegawai
    public function create(Request $req, $id_pegawai)
    {
        $pegawai = PNS::find($id_pegawai);

        // Apakah pegawai ditemukan
        if (!$pegawai) {
            return response()->json([
                "errors" => "Pegawai dengan id: $id_pegawai tidak ditemukan"
            ], 404);
        }

        // Cek Validasi Berkas
        $berkas_kp = $req->file("berkas_kp") ? $req->file("berkas_kp") : "";
        if (!$berkas_kp || count($berkas_kp) == 0) {
            // Jika belum ada berkas yang dipilih
            return response()->json([
                "errors" => "Berkas kenaikan pangkat harus dipilih"
            ], 400);
        }

        $input_data = [];
        // Cek ekstensi berkas
        foreach ($berkas_kp as $b) {
            // Get extension of berkas
            $ext_allowed = [
                "pdf",
                "doc",
                "docx",
            ];
            $ext = pathinfo($b->getClientOriginalName(), PATHINFO_EXTENSION);
            if (!in_array($ext, $ext_allowed)) {
                // Jika tidak sesuai
                return response()->json([
                    "errors" => "Ekstensi berkas yang diperbolehkan adalah pdf, doc, dan docx"
                ], 400);
            }

            // Jika semua validasi berhasil terlewati, lakukan proses input data ke database
            // Sanitasi nama file
            $sanitize = sanitizeFile($b);
            $berkas = $b->storeAs("berkas_kp", rand(0, 9999) . time() . '-' . $sanitize);
            $insert = BerkasKp::create([
                "id_pegawai" => $id_pegawai,
                "file" => $berkas
            ]);

            array_push($input_data, $berkas);
        }

        return response()->json([
            "message" => "Berhasil menambahkan berkas kenaikan pangkat dengan id pegawai: $id_pegawai",
            "input_data" => $input_data
        ], 201);
    }

    // Delete Berkas KP by ID Pegawai
    public function destroy($id_pegawai, $id_berkas_kp)
    {
        $pegawai = PNS::find($id_pegawai);
        $berkas_kp = BerkasKp::find($id_berkas_kp);

        // Apakah pegawai ditemukan
        if (!$pegawai) {
            return response()->json([
                "message" => "Pegawai dengan id: $id_pegawai tidak ditemukan"
            ], 404);
        }
        // Apakah berkas kp ditemukan
        if (!$berkas_kp) {
            return response()->json([
                "message" => "Berkas kenaikan pangkat dengan id: $id_berkas_kp tidak ditemukan"
            ], 404);
        }

        // Proses hapus data
        Storage::delete($berkas_kp->file);
        $berkas_kp->delete();

        return response()->json([
            "message" => "Berkas kenaikan pangkat dengan id: $id_berkas_kp berhasil dihapus",
            "deleted_data" => $berkas_kp->file
        ], 201);
    }
}
