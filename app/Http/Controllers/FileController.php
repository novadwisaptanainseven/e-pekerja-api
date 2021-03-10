<?php

namespace App\Http\Controllers;

use App\Models\Admin\Pegawai\PNS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use PDF;

class FileController extends Controller
{

    // Testing Print PDF
    public function generatePDF_RekapPNS()
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */

        $data = [
            'title' => 'Rekap Pegawai Negeri Sipil',
            'date' => date('m/d/Y'),
            'data' => PNS::getAll()
        ];

        // $pdf = PDF::loadView('printPegawai.rekap_pegawai', $data);

        // return $pdf->download('rekap_pegawai.pdf');
        $view = View('printPegawai.rekap_pegawai', $data);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view->render())->setPaper('a4', 'landscape');
        return $pdf->stream("rekap_pns.pdf", array("Attachment" => false));;
        // return response()->json([
        //     "message" => "Hello World"
        // ]);
    }

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
