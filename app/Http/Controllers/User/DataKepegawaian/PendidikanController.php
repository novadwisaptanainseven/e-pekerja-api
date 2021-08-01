<?php

namespace App\Http\Controllers\User\DataKepegawaian;

use App\Http\Controllers\Controller;
use App\Models\User\DataKepegawaian\Pendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendidikanController extends Controller
{
    // Get All Pendidikan
    public function getAll()
    {
        $user = Auth::user();

        $data = Pendidikan::getAll($user->id_pegawai);

        if ($data !== 404) {
            return response()->json([
                "message" => "Berhasil mendapatkan semua data pendidikan dari pegawai dengan id: {$user->id_pegawai} berdasarkan user saat ini: $user->id",
                "data" => $data
            ], 200);
        } else {
            return response()->json([
                "message" => "Data pendidikan dari pegawai dengan id: {$user->id_pegawai} tidak ditemukan"
            ], 404);
        }
    }
}
