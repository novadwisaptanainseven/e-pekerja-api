<?php

namespace App\Http\Controllers;

use App\Models\Admin\DUK;
use App\Models\Admin\KGB;
use App\Models\Admin\MasaKerja;
use App\Models\Admin\Pegawai\Absensi;
use App\Models\Admin\Pegawai\Berkas;
use App\Models\Admin\Pegawai\Diklat;
use App\Models\Admin\Pegawai\Keluarga;
use App\Models\Admin\Pegawai\Pendidikan;
use App\Models\Admin\Pegawai\Penghargaan;
use App\Models\Admin\Pegawai\PNS;
use App\Models\Admin\Pegawai\PTTB;
use App\Models\Admin\Pegawai\PTTH;
use App\Models\Admin\Pegawai\RiwayatKerja;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use PDF;

class FileController extends Controller
{

    // Testing Print PDF
    public function cetakDaftarPegawai($jenis_data)
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        $output_data = [];
        $sub_title = "";

        switch ($jenis_data) {
            case "pns":
                $output_data = PNS::getAll();
                $sub_title = "Pegawai Negeri Sipil (PNS)";
                break;
            case "ptth":
                $output_data = PTTH::getAll();
                $sub_title = "Pegawai Tidak Tetap Harian (PTTH)";
                break;
            case 'pttb':
                $output_data = PTTB::getAll();
                $sub_title = "Pegawai Tidak Tetap Bulanan (PTTB)";
                break;
            case 'semua-pegawai':
                $output_data = PNS::getAllPegawai();
                $sub_title = "Pegawai (PNS, PTTH, PTTB)";
                break;
        }

        $title = "Daftar " . $sub_title;

        $data = [
            'title' => $title,
            'date' => date('d/m/Y'),
            'jenis' => $jenis_data,
            'data' => $output_data,
            "ttd" => PNS::getDataKadis()

        ];

        // $pdf = PDF::loadView('printPegawai.rekap_pegawai', $data);

        // return $pdf->download('rekap_pegawai.pdf');
        $view = View('printPegawai.rekap_pegawai', $data);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view->render())->setPaper('a4', 'landscape');
        return $pdf->stream("daftar-pegawai-$jenis_data.pdf", array("Attachment" => false));
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
            'date' => date('d/m/Y'),
            "jenis" => $d,
            "pegawai" => $pegawai->nama,
            "data" => $output_data,
            "ttd" => PNS::getDataKadis()
        ];

        $view = View('printPegawai.print_lap_pegawai', $data);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view->render())->setPaper('a4', 'landscape');
        return $pdf->stream("lap-$d-pegawai.pdf", array("Attachment" => false));
    }

    // Print DUK Pegawai
    public function cetakDUK()
    {
        $data = [
            "title" => "Daftar Urut Kepangkatan Pegawai Negeri Sipil",
            "date" => date("d/m/Y"),
            "data" => DUK::getAllForPrint(),
            "ttd" => PNS::getDataKadis()
        ];

        $view = View("printPegawai.print_duk_pegawai", $data);
        $pdf = App::make("dompdf.wrapper");
        $pdf->loadHTML($view->render())->setPaper("a4", "landscape");
        return $pdf->stream("duk_pegawai.pdf", array("Attachment" => false));
    }

    // Print Masa Kerja Pegawai
    public function cetakMasaKerja()
    {
        // Fungsi dari helpers.php
        $keadaan = formatTanggalIndonesia(date("Y-m-d"));

        $data = [
            "title" => "Daftar Nama-Nama PNS Dinas Perumahan dan <br> Kawasan Permukiman Kota Samarinda Berdasarkan Masa Kerja Seluruhnya",
            "date" => date("d/m/Y"),
            "keadaan" => $keadaan,
            "data" => MasaKerja::getAllForPrint(),
            "ttd" => PNS::getDataKadis()
        ];

        $view = View("printPegawai.print_masakerja_pegawai", $data);
        $pdf = App::make("dompdf.wrapper");
        $pdf->loadHTML($view->render())->setPaper("a4", "landscape");
        return $pdf->stream("duk_pegawai.pdf", array("Attachment" => false));
    }

    // Print KGB Pegawai
    public function cetakKGBPegawai($id_pegawai)
    {
        // Fungsi dari helpers.php
        // $keadaan = formatTanggalIndonesia(date("Y-m-d"));

        // Get Data Pegawai by Id
        $pegawai = PNS::getById($id_pegawai);

        $data = [
            "title" => "Daftar Histori Kenaikan Gaji Pegawai Negeri Sipil",
            "date" => date("d/m/Y"),
            // "keadaan" => $keadaan,
            "data" => KGB::getAll($id_pegawai),
            "ttd" => PNS::getDataKadis(),
            "pegawai" => $pegawai
        ];

        $view = View("printPegawai.print_kgb_pegawai", $data);
        $pdf = App::make("dompdf.wrapper");
        $pdf->loadHTML($view->render())->setPaper("a4", "portrait");
        return $pdf->stream("duk_pegawai.pdf", array("Attachment" => false));
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

    // Print Rekap Absensi Pegawai
    public function cetakRekapAbsensi(Request $req, $jenis_data)
    {

        $output_data = [];

        $title = "Laporan Rekap Absensi ";

        switch ($jenis_data) {
            case 'pns':
                $output_data = Absensi::getByStatusPegawai($jenis_data);
                $title .= "Pegawai Negeri Sipil (PNS)";
                break;
            case 'ptth':
                $output_data = Absensi::getByStatusPegawai($jenis_data);
                $title .= "Pegawai Tidak Tetap Harian (PTTH)";
                break;
            case 'pttb':
                $output_data = Absensi::getByStatusPegawai($jenis_data);
                $title .= "Pegawai Tidak Tetap Bulanan (PTTB)";
                break;
            case 'semua':
                $output_data = Absensi::getAllRekapAbsensiPerTahun($req);
                $title .= "PNS, PTTH, dan PTTB";
                break;

            default:
                # code...
                break;
        }

        $data = [
            "title" => $title,
            'date' => date('d/m/Y'),
            "jenis" => $jenis_data,
            "data" => $output_data,
            "tahun" => $req->tahun ? $req->tahun : date('Y'),
            "ttd" => PNS::getDataKadis()
        ];

        $view = View('printAbsensi.lap_rekap_absensi', $data);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view->render())->setPaper('a4', 'portrait');
        return $pdf->stream("rekap-absensi-$jenis_data.pdf", array("Attachment" => false));
    }
    // Print Rekap Absensi Pegawai
    public function cetakRekapAbsensiByDate(Request $req, $jenis_data)
    {

        $currentTahun = date("Y");
        $currentBulan = date("m");

        $firstDate = $req->first_date ? $req->first_date : "$currentTahun-$currentBulan-1";
        $lastDate = $req->last_date ? $req->last_date : "$currentTahun-$currentBulan-31";

        $output_data = [];

        $title = "Laporan Rekap Absensi ";

        switch ($jenis_data) {
            case 'pns':
                $output_data = Absensi::getByStatusPegawai($jenis_data);
                $title .= "Pegawai Negeri Sipil (PNS)";
                break;
            case 'ptth':
                $output_data = Absensi::getByStatusPegawai($jenis_data);
                $title .= "Pegawai Tidak Tetap Harian (PTTH)";
                break;
            case 'pttb':
                $output_data = Absensi::getByStatusPegawai($jenis_data);
                $title .= "Pegawai Tidak Tetap Bulanan (PTTB)";
                break;
            case 'semua':
                $output_data = Absensi::getRekapAbsensiByDate($req);
                $title .= "PNS, PTTH, dan PTTB";
                break;

            default:
                # code...
                break;
        }

        $data = [
            "title" => $title,
            'date' => date('d/m/Y'),
            "jenis" => $jenis_data,
            "data" => $output_data,
            "filterTanggal" => [
                "first_date" => date("d/m/Y", strtotime($firstDate)),
                "last_date" => date("d/m/Y", strtotime($lastDate))
            ],
            "ttd" => PNS::getDataKadis()
        ];

        $view = View('printAbsensi.lap_rekap_absensi', $data);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view->render())->setPaper('a4', 'portrait');
        return $pdf->stream("rekap-absensi-$jenis_data.pdf", array("Attachment" => false));
    }

    // Print Rekap Absensi Pegawai by Filter Tanggal
    public function cetakRekapAbsensiByFilterTanggal(Request $req, $id_pegawai)
    {
        $pegawai = DB::table("pegawai")->where("id_pegawai", "=", $id_pegawai)->first();

        $currentTahun = date("Y");
        $currentBulan = date("m");

        $firstDate = $req->first_date ? $req->first_date : "$currentTahun-$currentBulan-1";
        $lastDate = $req->last_date ? $req->last_date : "$currentTahun-$currentBulan-31";

        $output_data = Absensi::getAbsensiByFilter($req, $id_pegawai);

        $title = "Laporan Rekap Absensi";

        $data = [
            "title" => $title,
            'date' => date('d/m/Y'),
            'firstDate' => date('d/m/Y', strtotime($firstDate)),
            'lastDate' => date('d/m/Y', strtotime($lastDate)),
            'pegawai' => $pegawai,
            "data" => $output_data,
            "ttd" => PNS::getDataKadis()
        ];

        $view = View('printAbsensi.lap_rekap_absensi_filter_tanggal', $data);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view->render())->setPaper('a4', 'portrait');
        return $pdf->stream("rekap-absensi-pegawai.pdf", array("Attachment" => false));
    }

    // Print Rekap Absensi Pegawai Per Tahun
    public function cetakRekapAbsensiPerTahun($id_pegawai)
    {

        $output_data = Absensi::getRekapAbsensiPerTahun($id_pegawai);
        $pegawai = DB::table("pegawai")->where("id_pegawai", "=", $id_pegawai)->first();

        $title = "Laporan Rekap Absensi";

        $data = [
            "title" => $title,
            'date' => date('d/m/Y'),
            "data" => $output_data,
            "pegawai" => $pegawai,
            "ttd" => PNS::getDataKadis()
        ];

        $view = View('printAbsensi.lap_rekap_absensi_per_tahun', $data);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view->render())->setPaper('a4', 'portrait');
        return $pdf->stream("rekap-absensi-pegawai.pdf", array("Attachment" => false));
    }
}
