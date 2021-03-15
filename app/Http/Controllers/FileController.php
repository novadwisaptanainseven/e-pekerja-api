<?php

namespace App\Http\Controllers;

use App\Models\Admin\Pegawai\Berkas;
use App\Models\Admin\Pegawai\Diklat;
use App\Models\Admin\Pegawai\Keluarga;
use App\Models\Admin\Pegawai\Pendidikan;
use App\Models\Admin\Pegawai\Penghargaan;
use App\Models\Admin\Pegawai\PNS;
use App\Models\Admin\Pegawai\RiwayatKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
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
        return $pdf->stream("rekap_pns.pdf", array("Attachment" => false));
        // return response()->json([
        //     "message" => "Hello World"
        // ]);
    }

    // Print laporan pegawai
    public function printLaporanPegawai($id_pegawai, $d)
    {
        $pegawai = DB::table("pegawai")
            ->where("id_pegawai", "=", $id_pegawai)
            ->first();

        $output_data = [];

        $title = "Laporan Data " . ucfirst($d);

        switch ($d) {
            case 'keluarga':
                $output_data = Keluarga::getAll($id_pegawai);
                break;
            case 'pendidikan':
                $output_data = Pendidikan::getAll($id_pegawai);
                break;
            case 'diklat':
                $output_data = Diklat::getAll($id_pegawai);
                break;
            case 'riwayat-kerja':
                $output_data = RiwayatKerja::getAll($id_pegawai);
                $title = "Laporan Data Riwayat Kerja";
                break;
            case 'penghargaan':
                $output_data = Penghargaan::getAll($id_pegawai);
                break;
            case 'berkas':
                $output_data = Berkas::getAll($id_pegawai);
                break;
            default:
                # code...
                break;
        }

        $data = [
            "title" => $title,
            'date' => date('m/d/Y'),
            "jenis" => $d,
            "pegawai" => $pegawai->nama,
            "data" => $output_data
        ];

        $view = View('printPegawai.print_lap_pegawai', $data);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view->render())->setPaper('a4', 'landscape');
        return $pdf->stream("lap-$d-pegawai.pdf", array("Attachment" => false));
    }

    // Get Image
    public function getImage($filename)
    {
        $fullpath = "/app/images/foto/$filename";
        $message = "Data Gambar Tidak Ditemukan";

        return $this->downloads($fullpath, $message, $filename);
    }

    // Get Ijazah
    public function getIjazah($filename)
    {
        $fullpath = "/app/images/ijazah/$filename";
        $message = "Data Ijazah Tidak Ditemukan";

        return $this->downloads($fullpath, $message, $filename);
    }

    // Get Dokumentasi Diklat
    public function getDokDiklat($filename)
    {
        $fullpath = "/app/images/dok_diklat/$filename";
        $message = "Data Dokumentasi Diklat Tidak Ditemukan";

        return $this->downloads($fullpath, $message, $filename);
    }

    // Get Dokumentasi Penghargaan
    public function getDokPenghargaan($filename)
    {
        $fullpath = "/app/images/dok_penghargaan/$filename";
        $message = "Data Dokumentasi Penghargaan Tidak Ditemukan";

        return $this->downloads($fullpath, $message, $filename);
    }

    // Get Berkas Pegawai
    public function getBerkas($filename)
    {
        $fullpath = "/app/images/berkas/$filename";
        $message = "Data Berkas Pegawai Tidak Ditemukan";

        return $this->downloads($fullpath, $message, $filename);
    }

    public function downloads($fullpath, $message, $filename)
    {
        if (file_exists(storage_path($fullpath))) {
            return response()->file(storage_path($fullpath), [
                'Content-Disposition' => 'inline; filename="' . $filename . '"'
            ]);
        } else {
            return response()->json([
                "message" => $message
            ], 404);
        }
    }
}
