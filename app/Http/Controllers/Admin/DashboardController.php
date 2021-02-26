<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Dashboard;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Get All Dashboard Information
    public function getInformation()
    {
        $data = Dashboard::getInformation();

        return response()->json([
            "message" => "Berhasil mendapatkan semua informasi dashboard",
            "data" => $data
        ], 200);
    }
}
