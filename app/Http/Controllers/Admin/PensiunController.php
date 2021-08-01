<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PensiunExport;
use App\Http\Controllers\Controller;
use App\Models\Admin\Pensiun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PensiunController extends Controller
{
    // Get All Pensiun
    public function getAll(Request $req)
    {
        $data = Pensiun::getAll($req);

        foreach ($data as $i => $item) {
            $item->no = $i + 1;
        }

        return response()->json([
            "message" => "Berhasil mendapatkan semua data pensiun",
            "data" => $data
        ], 200);
    }

    // Get Pensiun By Id
    public function getById($id_pensiun)
    {
        $data = Pensiun::getById($id_pensiun);

        if ($data === 404) {
            return response()->json([
                "message" => "Data pensiun dengan id: {$id_pensiun} tidak ditemukan"
            ], 404);
        } else {
            return response()->json([
                "message" => "Berhasil mendapatkan data pensiun dengan id: {$id_pensiun}",
                "data" => $data
            ], 200);
        }
    }

    // Insert Pensiun
    public function insert(Request $request)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "id_pegawai"  => "required",
                "tgl_pensiun" => "required",
                "keterangan"  => "required",
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

        $insert = Pensiun::insert($request);

        if ($insert === 201) {
            // Jika insert data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Tambah data pensiun berhasil",
                "input_data" => $request->all()
            ], 201);
        } else {
            // Jika data pegawai tidak ditemukan
            return response()->json([
                "message" => "Data pegawai dengan id: $request->id_pegawai",
            ], 404);
        }
    }

    // Edit Pensiun
    public function edit(Request $request, $id_pensiun)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "tgl_pensiun"     => "required",
                "keterangan"      => "required",
                // "status_pensiun"  => "required",
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

        $edit = Pensiun::edit($request, $id_pensiun);

        if ($edit === 404) {
            return response()->json([
                "message" => "Data pensiun dengan id: {$id_pensiun} tidak ditemukan"
            ], 404);
        } else {
            return response()->json([
                "message" => "Edit data pensiun dengan id: {$id_pensiun} berhasil",
                "edited_data" => $edit
            ], 201);
        }
    }

    // Delete Pensiun By Id
    public function delete($id_pensiun)
    {
        // Get data penghargaan by id
        $data = Pensiun::where('id_pensiun', '=', $id_pensiun)
            ->first();

        $delete = Pensiun::deletePensiun($id_pensiun);

        if ($delete === 404) {
            // Jika data pensiun tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pensiun dengan id: {$id_pensiun} tidak ditemukan",
            ], 404);
        } else {
            return response()->json([
                "message" => "Berhasil menghapus data pensiun dengan id: {$id_pensiun}",
                "deleted_data" => $data
            ], 201);
        }
    }

    // Batalkan Pensiun
    public function batalkanPensiun($id_pensiun)
    {
        // Get data pensiun by id
        $data = Pensiun::where('id_pensiun', '=', $id_pensiun)
            ->first();

        $batal = Pensiun::batalkanPensiun($id_pensiun);

        if ($batal === 404) {
            // Jika data pensiun tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pensiun dengan id: {$id_pensiun} tidak ditemukan",
            ], 404);
        } else {
            return response()->json([
                "message" => "Berhasil membatalkan pensiun untuk pegawai dengan id: {$data->id_pegawai}",
                "deleted_data" => $data
            ], 201);
        }
    }

    // Export Pensiun Pegawai ke Excel
    public function exportPensiunToExcel(Request $req)
    {
        return (new PensiunExport($req))->download('pensiun-pegawai.xlsx');
    }
}
