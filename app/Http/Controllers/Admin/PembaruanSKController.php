<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PembaruanSKExport;
use App\Http\Controllers\Controller;
use App\Models\Admin\Pegawai\PNS;
use App\Models\Admin\PembaruanSK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PembaruanSKController extends Controller
{
    // Get All
    public function getAll($id_pegawai)
    {
        $data = PembaruanSK::getAll($id_pegawai);

        if ($data) {
            foreach ($data as $i => $d) {
                $d->no = $i + 1;
            }
            return response()->json([
                "message" => "Berhasil mendapatkan semua data riwayat SK pegawai dengan id: {$id_pegawai}",
                "data" => $data
            ], 200);
        } else {
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        }
    }

    // Get Pembaruan SK by Id Pembaruan SK
    public function getById($id_pegawai, $id)
    {
        $data = PembaruanSK::getById($id_pegawai, $id);

        if ($data === 404) {
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        } elseif ($data === 405) {
            return response()->json([
                "message" => "Data pembaruan SK dengan id: {$id} tidak ditemukan"
            ], 404);
        } else {
            return response()->json([
                "message" => "Berhasil mendapatkan data SK pegawai dengan id: {$id}",
                "data" => $data
            ], 200);
        }
    }

    // Insert Pembaruan SK
    public function insert(Request $request, $id_pegawai)
    {
        //  Cek status pegawai
        $pegawai = PNS::find($id_pegawai);
        if ($pegawai->id_status_pegawai == 2) {
            // Jika status pegawai ptth
            $rules = [
                "no_sk"            => "required",
                "penetap_sk"       => "required",
                "tgl_penetapan_sk" => "required",
                "tgl_mulai_tugas"  => "required",
                "gaji_pokok"       => "required|numeric",
                "tugas"            => "required",
                "file"             => 'mimes:pdf,doc,docx|max:1048',
            ];
        } else {
            // Jika status pegawai pttb
            $rules = [
                "no_sk"            => "required",
                "penetap_sk"       => "required",
                "tgl_penetapan_sk" => "required",
                "tgl_mulai_tugas"  => "required",
                "kontrak_ke"       => "required",
                "masa_kerja"       => "required",
                "tugas"            => "required",
                "gaji_pokok"       => "required|numeric",
                "file"             => 'mimes:pdf,doc,docx|max:2048',
            ];
        }
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!",
            "numeric"  => ":attribute harus berupa bilangan numerik!",
        ];
        $validator = Validator::make(
            $request->all(),
            $rules,
            $messages
        );

        // Validation Check
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }
        // End of Validation

        $insert = PembaruanSK::insert($request, $id_pegawai);

        if ($insert === true) {
            // Jika insert data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Tambah data pembaruan SK dengan id: {$id_pegawai} berhasil",
                "input_data" => $request->all()
            ], 201);
        } elseif ($insert === 404) {
            // Jika data tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        }
    }

    // Upload SK
    public function upload(Request $request, $id_pegawai)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!",
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "no_sk"      => "required|unique:riwayat_sk",
                "file"       => "required|mimes:pdf,doc,docx|max:2048",
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

        $insert = PembaruanSK::upload($request, $id_pegawai);

        if ($insert === true) {
            // Jika insert data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Tambah data pembaruan SK dengan id: {$id_pegawai} berhasil",
                "input_data" => $request->all()
            ], 201);
        } elseif ($insert === 404) {
            // Jika data tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        }
    }

    // Edit Riwayat SK
    public function edit(Request $request, $id_pegawai, $id)
    {
        //  Cek status pegawai
        $pegawai = PNS::find($id_pegawai);
        if ($pegawai->id_status_pegawai == 2) {
            // Jika status pegawai ptth
            $rules = [
                "no_sk"            => "required",
                "penetap_sk"       => "required",
                "tgl_penetapan_sk" => "required",
                "tgl_mulai_tugas"  => "required",
                "tugas"            => "required",
                "gaji_pokok"       => "required|numeric",
                "file"             => 'mimes:pdf,doc,docx|max:1048',
            ];
        } else {
            // Jika status pegawai pttb
            $rules = [
                "no_sk"            => "required",
                "penetap_sk"       => "required",
                "tgl_penetapan_sk" => "required",
                "tgl_mulai_tugas"  => "required",
                "kontrak_ke"       => "required",
                "masa_kerja"       => "required",
                "tugas"            => "required",
                "gaji_pokok"       => "required|numeric",
                "file"             => 'mimes:pdf,doc,docx|max:1048',
            ];
        }
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!",
            "numeric"  => ":attribute harus berupa bilangan numerik!",
        ];
        $validator = Validator::make(
            $request->all(),
            $rules,
            $messages
        );

        // Validation Check
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }
        // End of Validation

        $edit = PembaruanSK::edit($request, $id_pegawai, $id);

        if ($edit === 404) {
            // Jika data pegawai tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        } elseif ($edit === 405) {
            // Jika data kgb tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data riwayat SK dengan id: {$id} tidak ditemukan"
            ], 404);
        } else {
            // Jika edit data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Edit data riwayat SK dengan id: {$id} berhasil",
                "edited_data" => $edit
            ], 201);
        }
    }

    // Delete Riwayat SK
    public function deleteRiwayatSK($id_pegawai, $id)
    {
        $data = PembaruanSK::where('id_riwayat_sk', '=', $id)->first();

        $delete = PembaruanSK::deleteRiwayatSK($id_pegawai, $id);

        if ($delete === true) {
            return response()->json([
                "message" => "Berhasil menghapus data riwayat SK dengan id: {$id}",
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
                "message" => "Data riwayat SK dengan id: {$id} tidak ditemukan"
            ], 404);
        }
    }

    // Export Riwayat SK Pegawai ke Excel
    public function exportRiwayatSK($id_pegawai)
    {
        return (new PembaruanSKExport($id_pegawai))->download('riwayat-sk-pegawai.xlsx');
    }

    // Insert Riwayat SK
}
