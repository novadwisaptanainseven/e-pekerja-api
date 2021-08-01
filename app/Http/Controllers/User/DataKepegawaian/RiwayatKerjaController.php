<?php

namespace App\Http\Controllers\User\DataKepegawaian;

use App\Http\Controllers\Controller;
use App\Models\User\DataKepegawaian\RiwayatKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatKerjaController extends Controller
{
    // Get All Riwayat Kerja
    public function getAll()
    {
        // Get Current User
        $user = Auth::user();

        $data = RiwayatKerja::getAll($user->id_pegawai);

        if ($data !== 404) {
            return response()->json([
                "message" => "Berhasil mendapatkan semua data riwayat kerja dari pegawai dengan id: {$user->id_pegawai} berdasarkan user saat ini: $user->id",
                "data" => $data
            ], 200);
        } else {
            return response()->json([
                "message" => "Data riwayat kerja dari pegawai dengan id: {$user->id_pegawai} tidak ditemukan"
            ], 404);
        }
    }
}
