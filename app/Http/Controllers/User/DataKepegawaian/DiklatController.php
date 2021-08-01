<?php

namespace App\Http\Controllers\User\DataKepegawaian;

use App\Http\Controllers\Controller;
use App\Models\User\DataKepegawaian\Diklat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiklatController extends Controller
{
    // Get All Diklat
    public function getAll()
    {
        // Get Current User
        $user = Auth::user();

        $data = Diklat::getAll($user->id_pegawai);

        if ($data !== 404) {
            return response()->json([
                "message" => "Berhasil mendapatkan semua data diklat dari pegawai dengan id: {$user->id_pegawai} berdasarkan user saat ini: $user->id",
                "data" => $data
            ], 200);
        } else {
            return response()->json([
                "message" => "Data diklat dari pegawai dengan id: {$user->id_pegawai} tidak ditemukan"
            ], 404);
        }
    }
}
