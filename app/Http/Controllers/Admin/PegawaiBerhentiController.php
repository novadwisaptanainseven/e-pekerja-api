<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PegawaiBerhentiExport;
use App\Http\Controllers\Controller;
use App\Models\Admin\Pegawai\PNS;
use App\Models\Admin\Pegawai\PTTH;
use App\Models\Admin\PegawaiBerhenti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PegawaiBerhentiController extends Controller
{
    protected $tbl_pegawai = "pegawai";
    protected $tbl_status_pegawai = "status_pegawai";
    protected $tbl = "pegawai_berhenti";


    // Get All Pegawai Berhenti
    public function get()
    {
        $data = PegawaiBerhenti::getAll();

        return response()->json([
            "message" => "Berhasil mendapatkan semua pegawai berhenti",
            "data" => $data
        ], 200);
    }

    // Get Pegawai Berhenti By ID
    public function getById($id_pegawai_berhenti)
    {
        $data = PegawaiBerhenti::select(
            "{$this->tbl}.*",
            "{$this->tbl_pegawai}.nama",
            "{$this->tbl_pegawai}.nip",
            "{$this->tbl_pegawai}.id_status_pegawai",
            "{$this->tbl_pegawai}.foto",
            "{$this->tbl_status_pegawai}.status_pegawai",
        )
            ->join($this->tbl_pegawai, "{$this->tbl_pegawai}.id_pegawai", "=", "{$this->tbl}.id_pegawai")
            ->join($this->tbl_status_pegawai, "{$this->tbl_status_pegawai}.id_status_pegawai", "=", "{$this->tbl_pegawai}.id_status_pegawai")
            ->where("{$this->tbl}.id_pegawai_berhenti", $id_pegawai_berhenti)
            ->first();

        if ($data) {
            if ($data->id_status_pegawai == 2) {
                $ptth = PTTH::where("id_pegawai", $data->id_pegawai)->first();
                $data->nip = $ptth->nik;
            }

            // Cek status berhenti pegawai
            $curTs = time();
            $tglBerhentiTs = strtotime($data->tgl_berhenti);

            if ($curTs < $tglBerhentiTs) {
                $data->status_berhenti = "akan-berhenti";
            } else {
                $data->status_berhenti = "berhenti";
            }

            return response()->json([
                "message" => "Berhasil mendapatkan pegawai berhenti dengan id: $id_pegawai_berhenti",
                "data" => $data
            ], 200);
        } else {
            return response()->json([
                "message" => "Pegawai berhenti dengan id: $id_pegawai_berhenti tidak ditemukan",
            ], 404);
        }
    }

    // Insert Pegawai Berhenti
    public function create(Request $req)
    {
        // Validation
        $message = [
            "required" => ":attribute harus diisi"
        ];
        $validation = Validator::make(
            $req->all(),
            [
                "id_pegawai" => "required",
                "tgl_berhenti" => "required",
                "keterangan" => "required"
            ],
            $message
        );
        if ($validation->fails()) {
            return response()->json([
                "error" => $validation->errors()
            ], 400);
        }

        // Cek apakah pegawai ditemukan
        $pegawai = PNS::find($req->id_pegawai);
        if (!$pegawai) {
            return response()->json([
                "message" => "Pegawai dengan id: $req->id_pegawai tidak ditemukan",
            ], 404);
        }
        if ($pegawai->status_kerja == "berhenti") {
            return response()->json([
                "message" => "Pegawai dengan id: $req->id_pegawai sudah berhenti kerja",
            ], 404);
        }

        // Insert Data
        $insert = PegawaiBerhenti::create([
            "id_pegawai" => $req->id_pegawai,
            "tgl_berhenti" => $req->tgl_berhenti,
            "keterangan" => $req->keterangan
        ]);

        // Setelah itu, update status kerja di tabel pegawai menjadi berhenti
        PNS::where("id_pegawai", "=", $req->id_pegawai)
            ->update(["status_kerja" => "berhenti"]);

        return response()->json([
            "message" => "Berhasil menambahkan pegawai berhenti",
            "input_data" => $req->all()
        ], 201);
    }

    // Update Pegawai Berhenti
    public function update(Request $req, $id_pegawai_berhenti)
    {
        // Validation
        $message = [
            "required" => ":attribute harus diisi"
        ];
        $validation = Validator::make(
            $req->all(),
            [
                "tgl_berhenti" => "required",
                "keterangan" => "required"
            ],
            $message
        );
        if ($validation->fails()) {
            return response()->json([
                "error" => $validation->errors()
            ], 400);
        }

        // Cek apakah pegawai berhenti ditemukan
        $pegawai_berhenti = PegawaiBerhenti::find($id_pegawai_berhenti);
        if (!$pegawai_berhenti) {
            return response()->json([
                "message" => "Pegawai berhenti dengan id: $id_pegawai_berhenti tidak ditemukan",
            ], 404);
        }

        $data = [
            "tgl_berhenti" => $req->tgl_berhenti ? $req->tgl_berhenti : "",
            "keterangan" => $req->keterangan ? $req->keterangan : ""
        ];

        // Update Data
        $update = $pegawai_berhenti->update($data);

        return response()->json([
            "message" => "Berhasil mengubah pegawai berhenti dengan id: $id_pegawai_berhenti",
            "updated_data" => $pegawai_berhenti
        ], 201);
    }

    // Batalkan Pegawai Berhenti by ID
    public function destroy($id_pegawai_berhenti)
    {
        $data = PegawaiBerhenti::find($id_pegawai_berhenti);

        if ($data) {
            $data->delete();

            // Kembalikan status kerja pegawai menjadi aktif
            PNS::find($data->id_pegawai)->update(["status_kerja" => "aktif"]);

            return response()->json([
                "message" => "Pegawai berhenti dengan id: $id_pegawai_berhenti berhasil dibatalkan",
                "deleted_data" => $data
            ], 201);
        } else {
            return response()->json([
                "message" => "Pegawai berhenti dengan id: $id_pegawai_berhenti tidak ditemukan",
            ], 404);
        }
    }

    // Export Pegawai Berhenti ke Excel
    public function exportPegawaiBerhentiToExcel()
    {
        return (new PegawaiBerhentiExport())->download('pegawai-berhenti.xlsx');
    }
}
