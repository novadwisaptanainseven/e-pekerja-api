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
}

// if(!function_exists("array_push_assoc")) {
//     function array_push_assoc($arr, $key, $value) {
//         $arr[$key] = $value;
//         return $arr;
//     }
// }

if (!function_exists("array_push_assoc")) {
    function array_push_assoc($arr, $key, $value)
    {
        $arr[$key] = $value;
        return $arr;
    }
}

// Fungsi untuk menghitung total masa kerja dalam hari
if (!function_exists("hitungMKG")) {
    function hitungMKG($req)
    {
        // Hitung total masa kerja untuk pengurutan
        $mkg = explode(" ", $req->mk_golongan);
        $total_mkg_hari = intval($mkg[0]) * 365 + intval($mkg[2]) * 30; // xTahun * 365 hari + xBulan * 30 hari
        return $total_mkg_hari;
    }
}
if (!function_exists("hitungMKG2")) {
    function hitungMKG2($masa_kerja)
    {
        // Hitung total masa kerja untuk pengurutan
        $mkg = explode(" ", $masa_kerja);
        $total_mkg_hari = intval($mkg[0]) * 365 + intval($mkg[2]) * 30; // xTahun * 365 hari + xBulan * 30 hari
        return $total_mkg_hari;
    }
}

// Kenaikan Gaji Berkala
// Fungsi untuk memberikan pemberitahuan berdasarkan status KGB
if (!function_exists('getPemberitahuan')) {
    function getPemberitahuan($val)
    {
        $pemberitahuan = "";

        if ($val->status_kgb == "akan-naik-gaji") {
            $pemberitahuan = "Pegawai ini akan naik gaji pada tanggal " . date("d/m/Y", strtotime($val->kenaikan_gaji_yad));
        } elseif ($val->status_kgb == "naik-gaji") {
            $pemberitahuan = "Pegawai ini sudah bisa dilakukan kenaikan gaji";
        } elseif ($val->status_kgb == "sedang-berjalan") {
            $pemberitahuan = "Pegawai ini telah diperbarui gajinya";
        } elseif ($val->status_kgb == "akan-naik-gaji-2") {
            $pemberitahuan = "Pegawai ini dalam waktu dekat akan mengalami kenaikan gaji yaitu pada tanggal " . date("d/m/Y", strtotime($val->kenaikan_gaji_yad));
        }

        return $pemberitahuan;
    }
}
if (!function_exists('getStatusKGB')) {
    function getStatusKGB($val)
    {
        $pemberitahuan = "";

        if ($val->status_kgb == "akan-naik-gaji") {
            $pemberitahuan = "Akan Naik Gaji";
        } elseif ($val->status_kgb == "naik-gaji") {
            $pemberitahuan = "Naik Gaji";
        } elseif ($val->status_kgb == "sedang-berjalan") {
            $pemberitahuan = "Sedang Berjalan";
        } elseif ($val->status_kgb == "akan-naik-gaji-2") {
            $pemberitahuan = "Akan Naik Gaji Dalam Waktu Dekat";
        }

        return $pemberitahuan;
    }
}

// Cuti Pegawai
// Fungsi untuk memberikan pemberitahuan berdasarkan status Cuti
if (!function_exists('getPemberitahuanCuti')) {
    function getPemberitahuanCuti($val)
    {
        $pemberitahuan = "";

        if ($val->status_cuti == "akan-cuti") {
            $pemberitahuan = "Pegawai ini akan cuti dari tanggal " . date("d/m/Y", strtotime($val->tgl_mulai)) . " s/d " . date("d/m/Y", strtotime($val->tgl_selesai));
        } elseif ($val->status_cuti == "sedang-cuti") {
            $pemberitahuan = "Pegawai ini sedang cuti sampai tanggal " . date("d/m/Y", strtotime($val->tgl_selesai));
        } elseif ($val->status_cuti == "masa-cuti-hampir-selesai") {
            $pemberitahuan = "Masa cuti pegawai ini akan berakhir pada tanggal " . date("d/m/Y", strtotime($val->tgl_selesai));
        } elseif ($val->status_cuti == "masa-cuti-selesai") {
            $pemberitahuan = "Masa cuti pegawai ini telah berakhir";
        }

        return $pemberitahuan;
    }
}

// Kenaikan Pangkat
if (!function_exists('getPemberitahuanKP')) {
    function getPemberitahuanKP($data)
    {
        $pemberitahuan = "";
        $status = "";
        $currentDateTs = time();
        $tmtKenaikanPangkat = $data->tmt_kenaikan_pangkat ? strtotime($data->tmt_kenaikan_pangkat) : "";

        if ($tmtKenaikanPangkat) {
            $status = $currentDateTs < $tmtKenaikanPangkat ? "akan-naik-pangkat" : "naik-pangkat";
        }

        if ($status === "naik-pangkat") {
            $pemberitahuan = "Pegawai ini pangkatnya sudah bisa diperbarui";
        } elseif ($status === "akan-naik-pangkat") {
            $pemberitahuan = "Pegawai ini akan mengalami kenaikan pangkat menjadi " . $data->pangkat_baru . " pada tanggal " . date("d/m/Y", strtotime($data->tmt_kenaikan_pangkat));
        }

        return $pemberitahuan;
    }
}

if (!function_exists('getStatusKP')) {
    function getStatusKP($data)
    {
        $txt_status = "";
        $status = "";
        $currentDateTs = time();
        $tmtKenaikanPangkat = $data->tmt_kenaikan_pangkat ? strtotime($data->tmt_kenaikan_pangkat) : "";

        if ($tmtKenaikanPangkat) {
            $status = $currentDateTs < $tmtKenaikanPangkat ? "akan-naik-pangkat" : "naik-pangkat";
        }

        if ($status === "naik-pangkat") {
            $txt_status = "Naik Pangkat";
        } elseif ($status === "akan-naik-pangkat") {
            $txt_status = "Akan Naik Pangkat";
        }

        return $txt_status;
    }
}
