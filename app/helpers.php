<?php

use Illuminate\Support\Str;

// Fungsi untuk sanitasi nama file
if (!function_exists('sanitizeFile')) {
    function sanitizeFile($file)
    {
        $file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $file_ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
        $sanitize = Str::of($file_name)->slug('-');
        $sanitize2 = $sanitize . '.' . $file_ext;

        return $sanitize2;
    }
}

// Fungsi untuk memformat tanggal ke dalam format tgl Indonesia
if (!function_exists("formatTanggalIndonesia")) {
    function formatTanggalIndonesia($tgl)
    {
        $day = date("d", strtotime($tgl));
        $month = date("M", strtotime($tgl));
        $year = date("Y", strtotime($tgl));

        $bulan = "";

        switch ($month) {
            case "Jan":
                $bulan = "Januari";
                break;
            case "Feb":
                $bulan = "Februari";
                break;
            case "Mar":
                $bulan = "Maret";
                break;
            case "Apr":
                $bulan = "April";
                break;
            case "May":
                $bulan = "Mei";
                break;
            case "Jun":
                $bulan = "Juni";
                break;
            case "Jul":
                $bulan = "Juli";
                break;
            case "Aug":
                $bulan = "Agustus";
                break;
            case "Sep":
                $bulan = "September";
                break;
            case "Oct":
                $bulan = "Oktober";
                break;
            case "Nov":
                $bulan = "November";
                break;
            case "Des":
                $bulan = "Desember";
                break;
            default:
                break;
        }

        return ["tgl" => $day, "bulan" => $bulan, "tahun" => $year];
    }

    // if(!function_exists("array_push_assoc")) {
    //     function array_push_assoc($arr, $key, $value) {
    //         $arr[$key] = $value;
    //         return $arr;
    //     }
    // }

    if(!function_exists("array_push_assoc")) {
        function array_push_assoc($arr, $key, $value) {
            $arr[$key] = $value;
            return $arr;
        }
    }

    // Fungsi untuk menghitung total masa kerja dalam hari
    if(!function_exists("hitungMKG")) {
        function hitungMKG($req) {
            // Hitung total masa kerja untuk pengurutan
            $mkg = explode(" ", $req->mk_golongan);
            $total_mkg_hari = intval($mkg[0]) * 365 + intval($mkg[2]) * 30; // xTahun * 365 hari + xBulan * 30 hari
            return $total_mkg_hari;
        }
    }
    
}
