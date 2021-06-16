<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\MasaKerja;
use App\Exports\MasaKerjaExport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

use function GuzzleHttp\Promise\all;

class MasaKerjaController extends Controller
{

    // Get All Masa Kerja
    public function getAll()
    {
        $data = MasaKerja::getAll();

        return response()->json([
            "message" => "Berhasil mendapatkan semua data masa kerja pegawai",
            "data" => $data
        ], 200);
    }

    // Get All DUK For Print
    public function getAllForPrint()
    {
        $data = MasaKerja::getAllForPrint();

        return response()->json([
            "message" => "Berhasil mendapatkan semua data masa kerja pegawai",
            "data" => $data
        ], 200);
    }

    // Get Masa Kerja By Id
    public function getById($id_masa_kerja)
    {
        $data = MasaKerja::getById($id_masa_kerja);

        if ($data) {
            // Jika data ditemukan -> 200 OK
            return response()->json([
                "message" => "Berhasil mendapatkan data masa kerja pegawai dengan id: {$id_masa_kerja}",
                "data" => $data
            ], 200);
        } else {
            // Jika tidak -> 404 NOT FOUND
            return response()->json([
                "message" => "Data masa kerja pegawai dengan id: {$id_masa_kerja} tidak ditemukan",
            ], 404);
        }
    }

    // Edit Masa Kerja
    public function edit(Request $request, $id_masa_kerja)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "mk_golongan" => "required",
                "mk_jabatan" => "required",
                "mk_sebelum_cpns" => "required",
                "mk_seluruhnya" => "required",
            ],
            $messages
        );

        // Validation Check
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }
        // End of Validation

        $edit = MasaKerja::edit($request, $id_masa_kerja);

        if ($edit !== 404) {
            // Jika edit data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Edit data masa kerja dengan id: {$id_masa_kerja} berhasil",
                "edited_data" => $edit
            ], 201);
        } elseif ($edit === 404) {
            // Jika data tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data masa kerja dengan id: {$id_masa_kerja} tidak ditemukan"
            ], 404);
        } elseif ($edit === 500) {
            // Jika gagal -> 500 SERVER ERROR
            return response()->json([
                "message" => "Terjadi kesalahan server",
            ], 500);
        }
    }

    // Insert Riwayat Masa Kerja
    public function insertRiwayatMasaKerja(Request $request, $id_pegawai)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "mk_golongan"   => "required",
                "mk_jabatan"    => "required",
                "mk_cpns"       => "required",
                "mk_seluruhnya" => "required",
            ],
            $messages
        );

        // Validation Check
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }
        // End of Validation

        $insert = MasaKerja::insertRiwayatMasaKerja($request, $id_pegawai);

        if ($insert === true) {
            // Jika insert data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Pembaruan masa kerja pegawai dengan id: {$id_pegawai} berhasil",
                "input_data" => $request->all()
            ], 201);
        } elseif ($insert === 404) {
            // Jika data tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        }
    }

    // Get All Riwayat Masa Kerja
    public function getAllRiwayatMasaKerja($id_pegawai)
    {
        $data = MasaKerja::getAllRiwayatMasaKerja($id_pegawai);

        return response()->json([
            "message" => "Berhasil mendapatkan semua riwayat masa kerja pegawai dengan id: $id_pegawai",
            "data" => $data
        ], 200);
    }

    // Get Riwayat Masa Kerja by Id
    public function getRiwayatMasaKerjaById($id_pegawai, $id)
    {
        $data = MasaKerja::getRiwayatMasaKerjaById($id_pegawai, $id);

        if ($data === 404) {
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        } elseif ($data === 405) {
            return response()->json([
                "message" => "Data riwayat masa kerja pegawai dengan id: {$id} tidak ditemukan"
            ], 404);
        } else {
            return response()->json([
                "message" => "Berhasil mendapatkan data riwayat masa kerja dengan id: {$id}",
                "data" => $data
            ], 200);
        }
    }

    // Get Riwayat Masa Kerja Terbaru
    public function getRiwayatMasaKerjaTerbaru($id_pegawai)
    {
        $data = MasaKerja::getRiwayatMasaKerjaTerbaru($id_pegawai);

        if ($data) {
            return response()->json([
                "message" => "Berhasil mendapatkan riwayat terakhir masa kerja pegawai dengan id: {$id_pegawai}",
                "data" => $data
            ], 200);
        } else {
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        }
    }

    // Delete Riwayat MasaKerja
    public function deleteRiwayatMasaKerja($id_pegawai, $id)
    {
        $data = DB::table('riwayat_mk')->where('id_riwayat_mk', '=', $id)->first();

        $delete = MasaKerja::deleteRiwayatMasaKerja($id_pegawai, $id);

        if ($delete === true) {
            return response()->json([
                "message" => "Berhasil menghapus data riwayat masa kerja pegawai dengan id: {$id}",
                "deleted_data" => $data
            ]);
        } elseif ($delete === 404) {
            // Jika data pegawai tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        } elseif ($delete === 405) {
            // Jika data kgb tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data riwayat masa kerja pegawai dengan id: {$id} tidak ditemukan"
            ], 404);
        }
    }

    // Export Masa Kerja Pegawai ke Excel
    public function exportMasaKerjaToExcel()
    {
        return (new MasaKerjaExport)->download('masa-kerja-pegawai.xlsx');
    }

    // Export Riwayat Masa Kerja Pegawai ke Excel
    public function exportRiwayatMasaKerjaToExcel($id_pegawai)
    {
        return (new MasaKerjaExport($id_pegawai, "riwayat-masa-kerja"))->download('masa-kerja-pegawai.xlsx');
    }

    // Simpan riwayat pegawai berdasarkan masa kerja
    public function saveRiwayatMasaKerjaToExcel(Request $request)
    {
        $messages = [
            "required" => "attribute harus diisi",
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "tanggal"   => "required",
                "nama_file"      => "required",
                "keadaan"   => "required",
            ],
            $messages
        );

        // Validation Check
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }
        // End of Validation

        // Simpan ke dalam database
        $insert = MasaKerja::saveRiwayatMasaKerja($request);

        return response()->json([
            "message" => "Berhasil menyimpan riwayat masa kerja",
            "input_data" => $request->all()
        ], 201);
    }

    // Get All Riwayat Masa Kerja File
    public function getRiwayatMasaKerjaFile(Request $req)
    {
        // Cek apakah ada request yg dikirim
        if (count($req->all()) > 0) {
            // Jika ada
            $data = MasaKerja::getRiwayatMasaKerjaFileByDate($req);
        } else {
            // Jika tidak ada
            $data = MasaKerja::getRiwayatMasaKerjaFile();
        }

        return response()->json([
            "message" => "Berhasil mendapatkan semua riwayat masa kerja pegawai",
            "data" => $data,
        ], 200);
    }

    // Delete Riwayat Masa Kerja File
    public function deleteRiwayatMasaKerjaFile($id)
    {
        $data = DB::table('riwayat_mk_file')
            ->where('id_riwayat_mk_file', '=', $id)
            ->first();

        $delete = MasaKerja::deleteRiwayatMasaKerjaFile($id);

        if ($delete == true) {
            return response()->json([
                "message" => "Berhasil menghapus riwayat masa kerja file dengan id: $id",
                "deleted_data" => $data
            ], 201);
        } else {
            return response()->json([
                "message" => "Data riwayat masa kerja file dengan id: $id tidak ditemukan",
            ], 404);
        }
    }
}
