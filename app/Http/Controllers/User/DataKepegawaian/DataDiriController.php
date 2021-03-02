<?php

namespace App\Http\Controllers\User\DataKepegawaian;

use App\Http\Controllers\Controller;
use App\Models\User\DataKepegawaian\DataDiri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataDiriController extends Controller
{
    // Get Data Diri
    public function getDataDiri()
    {
        // Get Current User 
        $user = Auth::user();

        $data = DataDiri::getDataDiri($user->id_pegawai);

        if ($data) {
            return response()->json([
                "message" => "Berhasil mendapatkan data pegawai dengan id: $user->id_pegawai berdasarkan user saat ini: $user->id",
                "data" => $data
            ], 200);
        } else {
            return response()->json([
                "message" => "Data pegawai dengan id: $user->id_pegawai tidak ditemukan",
                "data" => $data
            ], 404);
        }
    }
}
