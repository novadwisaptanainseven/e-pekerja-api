<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\CutiController;
use App\Http\Controllers\Admin\KGBController;
use App\Models\Admin\Cuti;
use App\Models\Admin\DUK;
use App\Models\Admin\KenaikanPangkat;
use App\Models\Admin\KGB;
use App\Models\Admin\MasaKerja;
use App\Models\Admin\Pegawai\Absensi;
use App\Models\Admin\Pegawai\Berkas;
use App\Models\Admin\Pegawai\Diklat;
use App\Models\Admin\Pegawai\Keluarga;
use App\Models\Admin\Pegawai\Mutasi;
use App\Models\Admin\Pegawai\Pendidikan;
use App\Models\Admin\Pegawai\Penghargaan;
use App\Models\Admin\Pegawai\PNS;
use App\Models\Admin\Pegawai\PTTB;
use App\Models\Admin\Pegawai\PTTH;
use App\Models\Admin\Pegawai\RiwayatKerja;
use App\Models\Admin\PembaruanSK;
use App\Models\Admin\Pensiun;
use App\Models\Admin\RiwayatGolongan;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use PDF;

class FileController extends Controller
{

    // Testing Print PDF
    public function cetakDaftarPegawai(Request $req, $jenis_data)
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
                $output_data = PNS::getAll($req);
                $sub_title = "Pegawai Negeri Sipil (PNS)";
                break;
            case "ptth":
                $output_data = PTTH::getAll($req);
                $sub_title = "Pegawai Tidak Tetap Harian (PTTH)";
                break;
            case 'pttb':
                $output_data = PTTB::getAll($req);
                $sub_title = "Pegawai Tidak Tetap Bulanan (PTTB)";
                break;
            case 'semua-pegawai':
                $output_data = PNS::getAllPegawai($req);
                $sub_title = "Pegawai (PNS, PTTH, PTTB)";
                break;
        }

        if ($req->jenjang) {
            $sub_title .= " Berdasarkan Jenjang Pendidikan {$req->jenjang}";
        } else if ($req->kolom) {
            $sub_title .= " Berdasarkan " . ucfirst($req->kolom);
        } else if ($req->status_pegawai) {
            $sub_title = "Pegawai {$req->status_pegawai}";
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

        $F4 = [0, 0, 595.28, 841.89]; // Ukuran kertas F4 dalam bentuk px
        // return $pdf->download('rekap_pegawai.pdf');
        $view = View('printPegawai.rekap_pegawai', $data);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view->render())->setPaper($F4, 'landscape');
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

        $F4 = [0, 0, 595.28, 841.89];

        $view = View('printPegawai.print_lap_pegawai', $data);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view->render())->setPaper($F4, 'landscape');
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

        $F4 = [0, 0, 595.28, 841.89];

        $view = View("printPegawai.print_duk_pegawai", $data);
        $pdf = App::make("dompdf.wrapper");
        $pdf->loadHTML($view->render())->setPaper($F4, "landscape");
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

        $F4 = [0, 0, 595.28, 841.89];

        $view = View("printPegawai.print_masakerja_pegawai", $data);
        $pdf = App::make("dompdf.wrapper");
        $pdf->loadHTML($view->render())->setPaper($F4, "landscape");
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

        $F4 = [0, 0, 595.28, 841.89];

        $view = View("printPegawai.print_kgb_pegawai", $data);
        $pdf = App::make("dompdf.wrapper");
        $pdf->loadHTML($view->render())->setPaper($F4, "portrait");
        return $pdf->stream("kgb_pegawai.pdf", array("Attachment" => false));
    }

    // Print KGB Pegawai 2
    public function cetakKGBPegawai2(Request $req)
    {
        // Fungsi dari helpers.php
        if (!$req->bulan || !$req->tahun) {
            $keadaan = "";
        } else {
            $keadaan = formatTanggalIndonesia(date("Y-m-d", strtotime("$req->tahun-$req->bulan-1")));
        }

        $kgb_pegawai = KGBController::getKGBPegawaiForPrint($req);

        $data = [
            "title" => "Semua Kenaikan Gaji Berkala Pegawai Negeri Sipil",
            "date" => date("d/m/Y"),
            "keadaan" => $keadaan,
            "data" => $kgb_pegawai,
            "ttd" => PNS::getDataKadis(),
        ];

        $F4 = [0, 0, 595.28, 841.89];

        $view = View("printPegawai.print_kgb_semua_pegawai", $data);
        $pdf = App::make("dompdf.wrapper");
        $pdf->loadHTML($view->render())->setPaper($F4, "landscape");
        return $pdf->stream("kgb_pegawai.pdf", array("Attachment" => false));
    }

    // Print Riwayat SK Pegawai
    public function cetakRiwayatSK($id_pegawai)
    {
        // Get Data Pegawai by Id
        $pegawai = PNS::getById($id_pegawai);

        $data = [
            "title" => "Riwayat SK Pegawai",
            "date" => date("d/m/Y"),
            "data" => PembaruanSK::getAll($id_pegawai),
            "ttd" => PNS::getDataKadis(),
            "pegawai" => $pegawai
        ];

        $F4 = [0, 0, 595.28, 841.89];

        $view = View("printPegawai.print_riwayat_sk_pegawai", $data);
        $pdf = App::make("dompdf.wrapper");
        $pdf->loadHTML($view->render())->setPaper($F4, "landscape");
        return $pdf->stream("riwayat-sk-pegawai.pdf", array("Attachment" => false));
    }

    // Print Riwayat Golongan Pegawai
    public function cetakRiwayatGolongan($id_pegawai)
    {
        // Get Data Pegawai by Id
        $pegawai = PNS::getById($id_pegawai);

        $data = [
            "title" => "Riwayat Golongan Pegawai",
            "date" => date("d/m/Y"),
            "data" => RiwayatGolongan::get($id_pegawai),
            "ttd" => PNS::getDataKadis(),
            "pegawai" => $pegawai
        ];

        $F4 = [0, 0, 595.28, 841.89];

        $view = View("printPegawai.print_riwayat_golongan_pegawai", $data);
        $pdf = App::make("dompdf.wrapper");
        $pdf->loadHTML($view->render())->setPaper($F4, "landscape");
        return $pdf->stream("riwayat-golongan-pegawai.pdf", array("Attachment" => false));
    }

    // Print Riwayat Masa Kerja Pegawai
    public function cetakRiwayatMasaKerja($id_pegawai)
    {
        // Get Data Pegawai by Id
        $pegawai = PNS::getById($id_pegawai);

        $data = [
            "title" => "Riwayat Masa Kerja Pegawai",
            "date" => date("d/m/Y"),
            "data" => MasaKerja::getAllRiwayatMasaKerja($id_pegawai),
            "ttd" => PNS::getDataKadis(),
            "pegawai" => $pegawai
        ];

        $F4 = [0, 0, 595.28, 841.89];

        $view = View("printPegawai.print_riwayat_mk_pegawai", $data);
        $pdf = App::make("dompdf.wrapper");
        $pdf->loadHTML($view->render())->setPaper($F4, "landscape");
        return $pdf->stream("riwayat-mk-pegawai.pdf", array("Attachment" => false));
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

    // Get SK Pegawai
    public function getSK($filename)
    {
        $fullpath = "/app/images/surat-kontrak/$filename";
        $message = "Data SK Pegawai Tidak Ditemukan";

        return $this->downloads($fullpath, $message, $filename);
    }

    // Get Riwayat Masa Kerja Pegawai
    public function getRiwayatMK($filename)
    {
        $filename2 = "$filename.xlsx";
        $fullpath = "/app/exports/$filename2";
        $message = "Data Riwayat Masa Kerja Pegawai Tidak Ditemukan";

        return $this->downloads($fullpath, $message, $filename2);
    }

    // Get File SK Golongan
    public function getDocument($filename)
    {
        $fullpath = "/app/documents/$filename";
        $message = "Data SK Golongan Tidak Ditemukan";

        return $this->downloads($fullpath, $message, $filename);
    }

    // Get Berkas Kenaikan Pangkat
    public function getBerkasKp($filename)
    {
        $fullpath = "/app/berkas_kp/$filename";
        $message = "Data Berkas Kenaikan Pangkat Tidak Ditemukan";

        return $this->downloads($fullpath, $message, $filename);
    }

    public function downloads($fullpath, $message, $filename)
    {
        if (file_exists(storage_path($fullpath))) {
            return response()->file(storage_path($fullpath), [
                'Content-Disposition' => 'inline; filename="' . $filename . '"'
            ], 200);
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
    // Print Rekap Absensi Pegawai By Date
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

    // Print Rekap Absensi Pegawai per Tahun
    public function cetakRekapAbsensiPerTahun($id_pegawai)
    {
        $pegawai = DB::table("pegawai")->where("id_pegawai", "=", $id_pegawai)->first();

        $output_data = Absensi::getRekapAbsensiPerTahun($id_pegawai);
        $title = "Laporan Rekap Absensi Per Tahun";

        $data = [
            "title" => $title,
            'date' => date('d/m/Y'),
            'pegawai' => $pegawai,
            "data" => $output_data,
            "ttd" => PNS::getDataKadis()
        ];

        $view = View("printAbsensi.lap_rekap_absensi_per_tahun", $data);
        $pdf = App::make("dompdf.wrapper");
        $pdf->loadHTML($view->render())->setPaper("a4", "portrait");

        return $pdf->stream("rekap-absensi-pegawai.pdf", ["Attachment" => false]);
    }

    // Print Pensiun Pegawai
    public function cetakPensiunPegawai(Request $req)
    {
        if (!$req->bulan || !$req->tahun) {
            $keadaan = "";
        } else {
            $tgl = "$req->tahun-$req->bulan-1";
            $keadaan = formatTanggalIndonesia(date("Y-m-d", strtotime($tgl)));
        }

        $output_data = Pensiun::getAll($req);

        $title = "Laporan Data Pensiunan Pegawai";

        $data = [
            "title" => $title,
            'date' => date('d/m/Y'),
            "keadaan" => $keadaan,
            "data" => $output_data,
            "ttd" => PNS::getDataKadis()
        ];

        $F4 = [0, 0, 595.28, 841.89];

        $view = View('printPensiun.lap_pensiun_pegawai', $data);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view->render())->setPaper($F4, 'landscape');
        return $pdf->stream("lap-pensiun-pegawai.pdf", array("Attachment" => false));
    }

    // Print Mutasi Pegawai
    public function cetakMutasiPegawai(Request $req)
    {
        if (!$req->bulan || !$req->tahun) {
            $keadaan = "";
        } else {
            $tgl = "$req->tahun-$req->bulan-1";
            $keadaan = formatTanggalIndonesia(date("Y-m-d", strtotime($tgl)));
        }

        $output_data = Mutasi::getAll($req);

        $title = "Laporan Data Mutasi Pegawai";

        $data = [
            "title" => $title,
            'date' => date('d/m/Y'),
            "keadaan" => $keadaan,
            "data" => $output_data,
            "ttd" => PNS::getDataKadis()
        ];

        $F4 = [0, 0, 595.28, 841.89];

        $view = View('printMutasi.lap_mutasi_pegawai', $data);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view->render())->setPaper($F4, 'landscape');
        return $pdf->stream("lap-mutasi-pegawai.pdf", array("Attachment" => false));
    }

    // Print Kenaikan Pangkat Pegawai
    public function cetakKenaikanPangkatPegawai()
    {

        $output_data = KenaikanPangkat::getAll();

        $title = "Laporan Data Kenaikan Pangkat Pegawai";

        $data = [
            "title" => $title,
            'date' => date('d/m/Y'),
            "data" => $output_data,
            "ttd" => PNS::getDataKadis()
        ];

        $F4 = [0, 0, 595.28, 841.89];

        $view = View('printKenaikanPangkat.lap_kenaikan_pangkat_pegawai', $data);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view->render())->setPaper($F4, 'landscape');
        return $pdf->stream("lap-kenaikan-pangkat-pegawai.pdf", array("Attachment" => false));
    }

    // Print Rekapitulasi Pegawai
    public function cetakRekapPegawai()
    {
        $output_data = PNS::getRekapPegawai();

        // PNS
        // For Loop Rekap Golongan
        $arr_rekap_golongan = [];
        foreach ($output_data["pns"]["rekap_golongan"] as $key => $value) {
            array_push($arr_rekap_golongan, ["key" => $key, "value" => $value]);
        }
        // For Loop Rekap Eselon
        $arr_rekap_eselon = [];
        foreach ($output_data["pns"]["rekap_eselon"] as $key => $value) {
            array_push($arr_rekap_eselon, ["key" => $key, "value" => $value]);
        }
        // For Loop Rekap Jenjang  Pendidikan
        $arr_rekap_jenjang = [];
        foreach ($output_data["pns"]["rekap_jenjang_pendidikan"] as $key => $value) {
            array_push($arr_rekap_jenjang, ["key" => $key, "value" => $value]);
        }

        // PTTB
        $arr_rekap_jenjang_pttb = [];
        foreach ($output_data["pttb"]["rekap_jenjang_pendidikan"] as $key => $value) {
            array_push($arr_rekap_jenjang_pttb, ["key" => $key, "value" => $value]);
        }
        $arr_rekap_jenis_kelamin_pttb = [];
        foreach ($output_data["pttb"]["rekap_jenis_kelamin"] as $key => $value) {
            array_push($arr_rekap_jenis_kelamin_pttb, ["key" => $key, "value" => $value]);
        }

        // PTTH
        $arr_rekap_jenjang_ptth = [];
        foreach ($output_data["ptth"]["rekap_jenjang_pendidikan"] as $key => $value) {
            array_push($arr_rekap_jenjang_ptth, ["key" => $key, "value" => $value]);
        }
        $arr_rekap_jenis_kelamin_ptth = [];
        foreach ($output_data["ptth"]["rekap_jenis_kelamin"] as $key => $value) {
            array_push($arr_rekap_jenis_kelamin_ptth, ["key" => $key, "value" => $value]);
        }

        // Total Pegawai berdasarkan Status
        $arr_jumlah_pegawai = [
            [
                "key" => "PNS",
                "value" => $output_data["jumlah_pns"],
            ],
            [
                "key" => "PTTB",
                "value" => $output_data["jumlah_pttb"],
            ],
            [
                "key" => "PTTH",
                "value" => $output_data["jumlah_ptth"],
            ],
        ];
        // Total Pegawai berdasarkan Bidang
        $arr_jumlah_pegawai_bidang = [];
        foreach ($output_data["total_per_bidang"] as $key => $value) {
            array_push($arr_jumlah_pegawai_bidang, ["key" => $key, "value" => $value]);
        }

        // dd($arr_jumlah_pegawai_bidang);

        $title = "Laporan Data Rekapitulasi Pegawai";

        $output_data2 = [
            "rekap_golongan" => $arr_rekap_golongan,
            "rekap_eselon" => $arr_rekap_eselon,
            "rekap_jenjang" => $arr_rekap_jenjang,
            "rekap_jenjang_pttb" => $arr_rekap_jenjang_pttb,
            "rekap_jenis_kelamin_pttb" => $arr_rekap_jenis_kelamin_pttb,
            "rekap_jenjang_ptth" => $arr_rekap_jenjang_ptth,
            "rekap_jenis_kelamin_ptth" => $arr_rekap_jenis_kelamin_ptth,
            "total_pegawai_bidang" => $arr_jumlah_pegawai_bidang,
            "total_pegawai_status" => $arr_jumlah_pegawai
        ];

        $data = [
            "title" => $title,
            'date' => date('d/m/Y'),
            "data" => $output_data,
            "data2" => $output_data2,
            "tanggal" => formatTanggalIndonesia(date('Y-m-d')),
            "ttd" => PNS::getDataKadis()
        ];

        $F4 = [0, 0, 595.28, 841.89]; // Ukuran kertas F4 dalam bentuk px
        $view = View('printPegawai.print_lap_rekap_pegawai', $data);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view->render())->setPaper($F4, 'landscape');
        return $pdf->stream("lap-rekap-pegawai.pdf", array("Attachment" => false));
    }

    // Print Riwayat Cuti
    public function cetakRiwayatCuti($id_pegawai)
    {
        $pegawai = DB::table("pegawai")->where("id_pegawai", "=", $id_pegawai)->first();

        $output_data = Cuti::getAll($id_pegawai);
        $title = "Data Riwayat Cuti Pegawai";

        $data = [
            "title" => $title,
            'date' => date('d/m/Y'),
            'pegawai' => $pegawai,
            "data" => $output_data,
            "ttd" => PNS::getDataKadis()
        ];
        $F4 = [0, 0, 595.28, 841.89]; // Ukuran kertas F4 dalam bentuk px
        $view = View("printPegawai.riwayat_cuti", $data);
        $pdf = App::make("dompdf.wrapper");
        $pdf->loadHTML($view->render())->setPaper($F4, "landscape");

        return $pdf->stream("riwayat-cuti-pegawai.pdf", ["Attachment" => false]);
    }

    // Print Pegawai Status Cuti
    public function cetakPegawaiStatusCuti(Request $req)
    {
        if (!$req->bulan || !$req->tahun) {
            $keadaan = "";
        } else {
            $keadaan = formatTanggalIndonesia(date("Y-m-d", strtotime("$req->tahun-$req->bulan-1")));
        }

        $cuti_pegawai = CutiController::getCutiPegawaiForPrint($req);

        $data = [
            "title" => "Semua Pegawai Cuti",
            "date" => date("d/m/Y"),
            "keadaan" => $keadaan,
            "data" => $cuti_pegawai,
            "ttd" => PNS::getDataKadis(),
        ];

        $F4 = [0, 0, 595.28, 841.89];

        $view = View("printPegawai.print_cuti_semua_pegawai", $data);
        $pdf = App::make("dompdf.wrapper");
        $pdf->loadHTML($view->render())->setPaper($F4, "landscape");
        return $pdf->stream("cuti_pegawai.pdf", array("Attachment" => false));
    }
}
