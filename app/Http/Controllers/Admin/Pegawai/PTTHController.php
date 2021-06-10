<?php

namespace App\Http\Controllers\Admin\Pegawai;

use App\Exports\PtthExport;
use Illuminate\Http\Request;
use App\Models\Admin\Pegawai\PTTH;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PTTHController extends Controller
{
    // Get All Pegawai
    public function getAll()
    {
        $data = PTTH::getAll();

        // Tambah nomor urut
        $no = 1;
        foreach ($data as $key => $d) {
            $d->no = $no++;
        }

        return response()->json([
            "message" => "Berhasil mendapatkan semua data pegawai",
            "data" => $data
        ], 200);
    }

    // Get Pegawai By Id
    public function getById($id_pegawai)
    {
        $data = PTTH::getById($id_pegawai);

        if ($data) {
            // Jika data ditemukan -> 200 OK
            return response()->json([
                "message" => "Berhasil mendapatkan data pegawai dengan id: {$id_pegawai}",
                "data" => $data
            ], 200);
        } else {
            // Jika tidak -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan",
            ], 404);
        }
    }

    // Insert Pegawai
    public function insert(Request $request)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!",
            "unique"   => ":attribute sudah ada yang punya",
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "nik"              => "required|unique:ptth",
                "nama"             => "required",
                'penetap_sk'       => 'required',
                'tgl_penetapan_sk' => 'required',
                'no_sk'            => 'required',
                'tgl_mulai_tugas'  => 'required',
                'tugas'            => 'required',
                'id_jabatan'       => 'required',
                'id_bidang'        => 'required',
                'id_agama'         => 'required',
                'tempat_lahir'     => 'required',
                'tgl_lahir'        => 'required',
                'alamat'           => 'required',
                'jenis_kelamin'    => 'required',
                'bpjs'             => 'required',
                'npwp'             => 'required',
                'no_hp'            => 'required',
                'email'           => 'required',
                'no_ktp'          => 'required',
                'foto'             => 'mimes:jpg,jpeg,png|max:1048',
                'nama_akademi'     => 'required',
                'jenjang'          => 'required',
                'jurusan'          => 'required',
                'tahun_lulus'      => 'required',
                'no_ijazah'        => 'required',
                'foto_ijazah'      => 'mimes:jpg,jpeg,png,pdf|max:1048',
                'gaji_pokok'       => 'required'
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

        $insert = PTTH::insert($request);

        if ($insert) {
            // Jika insert data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Tambah data pegawai berhasil",
                "input_data" => $request->all()
            ], 201);
        } else {
            // Jika gagal -> 500 SERVER ERROR
            return response()->json([
                "message" => "Terjadi kesalahan server",
            ], 500);
        }
    }

    // Edit Pegawai
    public function edit(Request $request, $id_pegawai)
    {
        // Validation
        $pegawai = PTTH::getById($id_pegawai);
        if ($request->nik == $pegawai->nik) {
            $nik_rules = "";
        } else {
            $nik_rules = "unique:ptth";
        }

        $messages = [
            "required" => ":attribute harus diisi!",
            "unique"   => ":attribute sudah ada yang punya!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "nik"             => $nik_rules,
                'foto'            => 'mimes:jpg,jpeg,png|max:1048',
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

        $edit = PTTH::edit($request, $id_pegawai);

        if ($edit !== 404) {
            // Jika edit data berhasil -> 201 CREATED
            return response()->json([
                "message" => "Edit data pegawai dengan id: {$id_pegawai} berhasil",
                "edited_data" => $edit
            ], 201);
        } elseif ($edit === 404) {
            // Jika data tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan"
            ], 404);
        } elseif ($edit === 500) {
            // Jika gagal -> 500 SERVER ERROR
            return response()->json([
                "message" => "Terjadi kesalahan server",
            ], 500);
        }
    }

    // Delete Pegawai By Id
    public function delete($id_pegawai)
    {
        // Get data pegawai by id
        $data = PTTH::where('id_pegawai', '=', $id_pegawai)->first();

        $delete = PTTH::deletePegawai($id_pegawai);

        if ($delete !== 404) {
            // Jika proses delete berhasil -> 201 CREATED
            return response()->json([
                "message" => "Berhasil menghapus data pegawai dengan id: {$id_pegawai}",
                "deleted_data" => $data
            ], 201);
        } elseif ($delete === 404) {
            // Jika data tidak ditemukan -> 404 NOT FOUND
            return response()->json([
                "message" => "Data pegawai dengan id: {$id_pegawai} tidak ditemukan",
            ], 404);
        } elseif ($delete === 500) {
            // Jika proses delete gagal ->  500 SERVER ERROR
            return response()->json([
                "message" => "Terjadi kesalahan server",
            ], 500);
        }
    }

    // // Export to Excel
    public function exportToExcel()
    {
        return (new PtthExport)->download('daftar-ptth.xlsx');
    }
}
