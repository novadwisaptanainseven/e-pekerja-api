<?php

namespace App\Http\Controllers\Admin\Pegawai;

use App\Exports\PttbExport;
use App\Http\Controllers\Controller;
use App\Models\Admin\Pegawai\PTTB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PTTBController extends Controller
{
    // Get All Pegawai
    public function getAll()
    {
        $data = PTTB::getAll();

        foreach ($data as $i => $d) {
            $d->no = $i + 1;
        }

        return response()->json([
            "message" => "Berhasil mendapatkan semua data pegawai",
            "data" => $data
        ], 200);
    }

    // Get Pegawai By Id
    public function getById($id_pegawai)
    {
        $data = PTTB::getById($id_pegawai);

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
                "nip"              => "required|unique:pttb",
                "nama"             => "required",
                'penetap_sk'       => 'required',
                'tgl_penetapan_sk' => 'required',
                'no_sk'            => 'required',
                'kontrak_ke'       => 'required',
                'masa_kerja'       => 'required',
                'tugas'            => 'required',
                'id_bidang'        => 'required',
                'id_jabatan'       => 'required',
                'id_agama'         => 'required',
                'tempat_lahir'     => 'required',
                'tgl_lahir'        => 'required',
                'alamat'           => 'required',
                'jenis_kelamin'    => 'required',
                'bpjs'             => 'required',
                'npwp'             => 'required',
                'no_hp'            => 'required',
                'email'            => 'required',
                'no_ktp'           => 'required',
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

        $insert = PTTB::insert($request);

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
        $pegawai = PTTB::getById($id_pegawai);
        if ($request->nip == $pegawai->nip) {
            $nip_rules = "";
        } else {
            $nip_rules = "unique:pttb";
        }

        $messages = [
            "required" => ":attribute harus diisi!",
            "unique"   => ":attribute sudah ada yang punya!"
        ];
        $validator = Validator::make(
            $request->all(),
            [
                "nip"             => $nip_rules,
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

        $edit = PTTB::edit($request, $id_pegawai);

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
        $data = PTTB::where('id_pegawai', '=', $id_pegawai)->first();

        $delete = PTTB::deletePegawai($id_pegawai);

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

    public function exportToExcel(Request $req)
    {
        return (new PttbExport($req))->download('daftar-pttb.xlsx');
    }
}
