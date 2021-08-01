<?php

namespace App\Http\Controllers\User\DataKepegawaian;

use App\Http\Controllers\Controller;
use App\Models\User\DataKepegawaian\Penghargaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenghargaanController extends Controller
{
    // Get All Penghargaan
    public function getAll()
    {
        // Get Current User
        $user = Auth::user();

        $data = Penghargaan::getAll($user->id_pegawai);

        if ($data !== 404) {
            return response()->json([
                "message" => "Berhasil mendapatkan semua data penghargaan dari pegawai dengan id: {$user->id_pegawai} berdasarkan user saat ini: $user->id",
                "data" => $data
            ], 200);
        } else {
            return response()->json([
                "message" => "Data penghargaan dari pegawai dengan id: {$user->id_pegawai} tidak ditemukan"
            ], 404);
        }
    }

    // Get Penghargaan By ID
    public function getById($id_penghargaan)
    {
        $data = Penghargaan::getById($id_penghargaan);

        if($data)
        {
            return response()->json([
                "message" => "Berhasil mendapatkan data penghargaan dengan id: $id_penghargaan",
                "data" => $data
            ], 200);
        }
        else
        {
            return response()->json([
                "message" => "Data penghargaan dengan id: $id_penghargaan tidak ditemukan"
            ], 404);
        }
    }
}
