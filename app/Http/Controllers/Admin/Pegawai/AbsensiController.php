<?php

namespace App\Http\Controllers\Admin\Pegawai;

use App\Exports\Absensi\AbsenExport;
use App\Exports\Absensi\AbsenFilterTanggalExport;
use App\Exports\Absensi\AbsensiPerTahunExport;
use App\Exports\Absensi\RekapAbsenSemuaPegawaiExport;
use App\Http\Controllers\Controller;
use App\Models\Admin\Pegawai\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AbsensiController extends Controller
{
    // Get Informasi Rekap Absensi per Tahun by Id Pegawai
    public function getRekapAbsensiPerTahun($id_pegawai)
    {
        $data = Absensi::getRekapAbsensiPerTahun($id_pegawai);

        if ($data === 404) {
            return response()->json([
                "message" => "Data pegawai dengan id: $id_pegawai tidak ditemukan"
            ], 404);
        } else {
            return response()->json([
                "message" => "Berhasil mendapatkan data rekap absensi per tahun dari pegawai dengan id: $id_pegawai",
                "data" => $data,
            ], 200);
        }
    }

    // Get Informasi Rekap Absensi per Tahun by Id Pegawai
    public function getAllRekapAbsensiPerTahun(Request $request)
    {
        $data = Absensi::getAllRekapAbsensiPerTahun($request);

        return response()->json([
            "message" => "Berhasil mendapatkan semua data rekap absensi per tahun",
            "tahun" => $request->tahun ? $request->tahun : date("Y"),
            "data" => $data,
        ], 200);
    }

    // Get Informasi Rekap Absensi Berdasarkan Range Tanggal
    public function getRekapAbsensiByDate(Request $request)
    {
        $data = Absensi::getRekapAbsensiByDate($request);

        return response()->json([
            "message" => "Berhasil mendapatkan semua data rekap absensi berdasarkan tanggal",
            "first_date" => $request->first_date,
            "last_date" => $request->last_date,
            "data" => $data,
        ], 200);
    }

    // Get All Absensi by Id Pegawai and Query Parameters
    public function getAbsensiByQuery(Request $request, $id_pegawai)
    {
        $data = Absensi::getAbsensiByQuery($request, $id_pegawai);

        if ($data === 404) {
            return response()->json([
                "message" => "Data pegawai dengan id: $id_pegawai tidak ditemukan"
            ], 404);
        } else {
            return response()->json([
                "message" => "Berhasil mendapatkan data absensi dari pegawai dengan id: $id_pegawai",
                "bulan" => $request->bulan,
                "tahun" => $request->tahun,
                "data" => $data,
            ], 200);
        }
    }

    // Get Riwayat Absensi by Id Pegawai and Filter
    public function getAbsensiByFilter(Request $request, $id_pegawai)
    {
        $data = Absensi::getAbsensiByFilter($request, $id_pegawai);

        foreach ($data as $i => $item) {
            $item->no = $i + 1;
        }

        if ($data === 404) {
            return response()->json([
                "message" => "Data pegawai dengan id: $id_pegawai tidak ditemukan"
            ], 404);
        } else {
            return response()->json([
                "message" => "Berhasil mendapatkan data absensi dari pegawai dengan id: $id_pegawai",
                "first_date" => $request->first_date,
                "last_date" => $request->last_date,
                "data" => $data,
            ], 200);
        }
    }

    // Get Absensi by Id Pegawai & Id Absensi
    public function getById($id_pegawai, $id_absensi)
    {
        $data = Absensi::getById($id_pegawai, $id_absensi);

        if ($data === 404) {
            return response()->json([
                "message" => "Data pegawai dengan id: $id_pegawai tidak ditemukan"
            ], 404);
        } elseif ($data === 405) {
            return response()->json([
                "message" => "Data absensi dari id_pegawai: $id_pegawai dan id_absensi: $id_absensi, tidak ditemukan"
            ], 404);
        } else {
            return response()->json([
                "message" => "Berhasil mendapatkan data rekap absensi per tahun dari pegawai dengan id: $id_pegawai",
                "data" => $data,
            ], 200);
        }
    }

    // Insert Absensi
    public function insert(Request $request, $id_pegawai)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "tgl_absen"  => "required",
                "hari"       => "required",
                "absen"      => "required",
            ],
            $messages
        );
        // Validation Check
        if ($validator->fails()) {
            return response()->json([
                "errors" => $validator->errors()
            ], 400);
        }

        $insert = Absensi::insert($request, $id_pegawai);

        if ($insert === 404) {
            // Jika data pegawai tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pegawai dengan id: $id_pegawai tidak ditemukan"
            ], 404);
        } else {
            // Jika proses insert berhasil -> 201 CREATED
            return response()->json([
                "message" => "Berhasil menambah data absensi untuk pegawai dengan id: $id_pegawai",
                "input_data" => $request->all()
            ], 201);
        }
    }

    // Insert Rekap Absensi
    public function insertRekapAbsensi(Request $request, $id_pegawai)
    {
        $insert = Absensi::insertRekapAbsensi($request, $id_pegawai);

        if ($insert === 404) {
            // Jika data pegawai tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pegawai dengan id: $id_pegawai tidak ditemukan"
            ], 404);
        } else {
            // Jika proses insert berhasil -> 201 CREATED
            return response()->json([
                "message" => "Berhasil menambah data rekap absensi untuk pegawai dengan id: $id_pegawai",
                "input_data" => $request->all()
            ], 201);
        }
    }

    // Insert Or Update Absensi
    public function insertOrUpdate(Request $request, $id_pegawai)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "tgl_absen"  => "required",
                "hari"       => "required",
                "absen"      => "required",
            ],
            $messages
        );
        // Validation Check
        if ($validator->fails()) {
            return response()->json([
                "errors" => $validator->errors()
            ], 400);
        }

        $insert = Absensi::insertOrUpdate($request, $id_pegawai);

        if ($insert === 404) {
            // Jika data pegawai tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pegawai dengan id: $id_pegawai tidak ditemukan"
            ], 404);
        } elseif ($insert === 202) {
            // Jika data sudah ada maka tampilkan response berhasil update data
            $data = Absensi::where("id_absensi", "=", $request->id_absensi)->first();

            return response()->json([
                "message" => "Berhasil mengubah data absensi untuk pegawai dengan id: $id_pegawai",
                "edited_data" => $data
            ], 201);
        } else {
            // Jika data belum ada maka tampilkan proses insert berhasil -> 201 CREATED
            return response()->json([
                "message" => "Berhasil menambah data absensi untuk pegawai dengan id: $id_pegawai",
                "input_data" => $request->all()
            ], 201);
        }
    }

    // Edit Absensi
    public function edit(Request $request, $id_pegawai, $id_absensi)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "tgl_absen"  => "required",
                "hari"       => "required",
                "absen"      => "required"
            ],
            $messages
        );
        // Validation Check
        if ($validator->fails()) {
            return response()->json([
                "errors" => $validator->errors()
            ], 400);
        }

        $edit = Absensi::edit($request, $id_pegawai, $id_absensi);

        if ($edit === 404) {
            // Jika data pegawai tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pegawai dengan id: $id_pegawai tidak ditemukan"
            ], 404);
        } elseif ($edit === 405) {
            // Jika data absensi tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data absensi dengan id: $id_absensi dari pegawai: $id_pegawai tidak ditemukan"
            ], 404);
        } else {
            // Jika proses edit berhasil -> 201 CREATED
            return response()->json([
                "message" => "Berhasil mengubah data absensi dengan id: $id_absensi untuk pegawai: $id_pegawai",
                "edited_data" => $request->all()
            ], 201);
        }
    }

    // Delete Absensi
    public function delete($id_pegawai, $id_absensi)
    {
        $data = Absensi::where("id_absensi", "=", $id_absensi)->first();

        $delete = Absensi::deleteAbsensi($id_pegawai, $id_absensi);

        if ($delete === 404) {
            // Jika data pegawai tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pegawai dengan id: $id_pegawai tidak ditemukan"
            ], 404);
        } elseif ($delete === 405) {
            // Jika data absensi tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data absensi dengan id: $id_absensi dari pegawai: $id_pegawai tidak ditemukan"
            ], 404);
        } else {
            // Jika proses delete berhasil -> 201 CREATED
            return response()->json([
                "message" => "Berhasil menghapus data absensi dengan id: $id_absensi untuk pegawai: $id_pegawai",
                "deleted_data" => $data
            ], 201);
        }
    }

    // Export Absensi Pegawai ke Excel
    public function exportAbsensiToExcel($jenis)
    {
        return (new AbsenExport($jenis))->download("absensi-$jenis.xlsx");
    }

    // Export Absensi Per Tahun Pegawai ke Excel
    public function exportAbsensiPerTahunToExcel(Request $req, $id)
    {
        return (new AbsensiPerTahunExport($id))->download("absensi-per-tahun.xlsx");
    }

    // Export Absensi By Filter Tanggal ke Excel
    public function exportAbsensiByFilterTanggalToExcel(Request $req, $id)
    {
        return (new AbsenFilterTanggalExport($req, $id))->download("absensi-filter-tanggal.xlsx");
    }

    // Export Absensi Semua Pegawai per Tahun to Excel
    public function exportAbsensiSemuaPegawaiPerTahun(Request $req, $filter)
    {
        return (new RekapAbsenSemuaPegawaiExport($req, $filter))->download("rekap-absensi-semua-pegawai.xlsx");
    }
}
