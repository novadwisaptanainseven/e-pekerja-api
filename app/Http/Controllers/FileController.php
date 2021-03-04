<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    // Get Image
    public function getImage($filename)
    {
        $fullpath = "/app/images/foto/$filename";
        $message = "Data Gambar Tidak Ditemukan";

        return $this->downloads($fullpath, $message);
    }

    public function downloads($fullpath, $message)
    {
        if (file_exists(storage_path($fullpath))) {
            return response()->download(storage_path($fullpath));
        } else {
            return response()->json([
                "message" => $message
            ], 404);
        }
    }
}
