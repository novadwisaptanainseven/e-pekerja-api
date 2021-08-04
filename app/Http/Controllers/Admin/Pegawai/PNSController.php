<?php

namespace App\Http\Controllers\Admin\Pegawai;

use App\Exports\LaporanPegawaiExport;
use App\Exports\PnsExport;
use Illuminate\Http\Request;
use App\Exports\PegawaiExport;
use App\Exports\RekapPegawaiExport;
use App\Models\Admin\Pegawai\PNS;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class PNSController extends Controller
{

    // Get All Pegawai (PNS, PTTH, PTTB)
    public function getAllPegawai()
    {
        $data = PNS::getAllPegawai();

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

    // Get All Pegawai
    public function getAll()
    {
        $data = PNS::getAll();

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
        $data = PNS::getById($id_pegawai);

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
                "nip"             => "required|unique:pegawai",
                "nama"            => "required",
                'id_jabatan'      => 'required',
                'id_bidang'       => 'required',
                'id_golongan'     => 'required',
                'id_eselon'       => 'required',
                'id_agama'        => 'required',
                'tempat_lahir'    => 'required',
                'tgl_lahir'       => 'required',
                'alamat'          => 'required',
                'jenis_kelamin'   => 'required',
                'karpeg'          => 'required',
                'bpjs'            => 'required',
                'npwp'            => 'required',
                'tmt_cpns'        => 'required',
                'tmt_jabatan'     => 'required',
                'tmt_golongan'    => 'required',
                'no_hp'           => 'required',
                'email'           => 'required',
                'no_ktp'          => 'required',
                'gaji_pokok'      => 'required',
                'foto'            => 'mimes:jpg,jpeg,png|max:1048',
                'mk_jabatan'      => 'required',
                'mk_sebelum_cpns' => 'required',
                'mk_golongan'     => 'required',
                'mk_seluruhnya'   => 'required',
                'nama_akademi'    => 'required',
                'jenjang'         => 'required',
                'jurusan'         => 'required',
                'no_ijazah'       => 'required',
                'tahun_lulus'     => 'required',
                'foto_ijazah'     => 'mimes:jpg,jpeg,png,pdf|max:1048',
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

        $insert = PNS::insert($request);

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
        $pegawai = PNS::where("id_pegawai", "=", $id_pegawai)->first();

        if ($request->nip == $pegawai->nip) {
            $nip_rules = "";
        } else {
            $nip_rules = "unique:pegawai";
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

        $edit = PNS::edit($request, $id_pegawai);

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
        $data = PNS::where('id_pegawai', '=', $id_pegawai)->first();

        $delete = PNS::deletePegawai($id_pegawai);

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

    // Rekapitulasi Jumlah Pegawai Berdasarkan Golongan/Eselon/Pendidikan dan Jenis Kelamin
    public function getRekapPegawai()
    {
        $rekap = PNS::getRekapPegawai();

        return response()->json([
            "message" => "Berhasil merekapitulasi seluruh data pegawai",
            "data" => $rekap
        ], 200);
    }

    // Export to Excel
    public function exportToExcel(Request $req)
    {
        // return Excel::download(new PnsExport, 'pns.xlsx');
        return (new PnsExport($req))->download('daftar-pns.xlsx');
        // return new PnsExport();
    }

    // Export semua pegawai ke excel
    public function exportAllPegawaiToExcel(Request $req)
    {
        return (new PegawaiExport($req))->download('daftar-pegawai.xlsx');
    }

    // Export Rekapitulasi Pegawai ke Excel
    public function exportRekapPegawaiToExcel()
    {
        return (new RekapPegawaiExport)->download('rekap-pegawai.xlsx');
    }

    // Export Laporan Pegawai ke Excel
    public function exportLaporanPegawaiToExcel($id_pegawai, $data)
    {
        return (new LaporanPegawaiExport($id_pegawai, $data))->download("laporan-$data-pegawai.xlsx");
    }
}
