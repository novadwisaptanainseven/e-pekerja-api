<?php

namespace App\Http\Controllers\Admin;

use App\Exports\KenaikanPangkatExport;
use App\Http\Controllers\Controller;
use App\Models\Admin\KenaikanPangkat;
use App\Models\Admin\MasaKerja;
use App\Models\Admin\Pegawai\PNS;
use App\Models\Admin\RiwayatGolongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class KenaikanPangkatController extends Controller
{
    // Get All Kenaikan Pangkat
    public function getAll()
    {
        $data = KenaikanPangkat::getAll();

        foreach ($data as $i => $item) {
            $item->no = $i + 1;
        }

        return response()->json([
            "message" => "Berhasil mendapatkan semua data kenaikan pangkat",
            "data" => $data
        ], 200);
    }

    // Create Kenaikan Pangkat
    public function create(Request $req, $id)
    {
        // Validation
        $messages = [
            "required" => ":attribute harus diisi!"
        ];
        $validator = Validator::make(
            $req->all(),
            [
                "id_golongan"           => "required",
                "pangkat_baru"          => "required",
                "jenis_kp"              => "required",
                "no_sk"                 => "required",
                "tanggal"               => "required",
                "masa_kerja"            => "required",
                "tmt_kenaikan_pangkat"  => "required",
                "pejabat_penetap"       => "required",
                "file"                  => "max:5048|mimes:doc,docx,pdf",
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

        // Cek apakah ada file file
        if (!$req->file('file')) {
            $file = '';
        } else {
            $file = $req->file("file");

            // Sanitasi nama file
            $sanitize = sanitizeFile($file);
            $file = $file->storeAs("documents", rand(0, 9999) . time() . '-' . $sanitize);
        }

        $data = [
            "id_golongan"           => $req->id_golongan,
            "pangkat_baru"          => $req->pangkat_baru,
            "jenis_kp"              => $req->jenis_kp,
            "no_sk"                 => $req->no_sk,
            "tanggal"               => $req->tanggal,
            "masa_kerja"            => $req->masa_kerja,
            "tmt_kenaikan_pangkat"  => $req->tmt_kenaikan_pangkat,
            "pejabat_penetap"       => $req->pejabat_penetap,
            "file"                  => $file,
        ];

        // Update kenaikan pangkat
        KenaikanPangkat::where("id", $id)->update($data);

        return response()->json([
            "message" => "Tambah data kenaikan pangkat berhasil",
            "input_data" => $req->all()
        ], 201);
    }

    // Update Pangkat
    public function updatePangkat($id)
    {
        $kenaikan_pangkat = KenaikanPangkat::find($id);

        // Update pangkat pegawai berdasarkan tabel kenaikan pangkat
        $data = [
            "id_golongan" => $kenaikan_pangkat->id_golongan
        ];
        PNS::where("id_pegawai", $kenaikan_pangkat->id_pegawai)->update($data);

        // Simpan ke riwayat golongan pegawai
        RiwayatGolongan::resetPangkatTerkini2();
        $data2 = [
            "id_pegawai"            => $kenaikan_pangkat->id_pegawai,
            "id_golongan"           => $kenaikan_pangkat->id_golongan,
            "jenis_kp"              => $kenaikan_pangkat->jenis_kp,
            "no_sk"                 => $kenaikan_pangkat->no_sk,
            "tanggal"               => $kenaikan_pangkat->tanggal,
            "masa_kerja"            => $kenaikan_pangkat->masa_kerja,
            "tmt_kenaikan_pangkat"  => $kenaikan_pangkat->tmt_kenaikan_pangkat,
            "pejabat_penetap"       => $kenaikan_pangkat->pejabat_penetap,
            "pangkat_terkini"       => 1,
            "file"                  => $kenaikan_pangkat->file,
        ];
        RiwayatGolongan::create($data2);

        // Get data pegawai hasil update
        $pegawai = PNS::where("id_pegawai", $kenaikan_pangkat->id_pegawai)->first();

        // Setelah pangkat golongan pegawai diupdate, maka kosongkan kolom pangkat_baru, id_golongan, dan tmt_kenaikan_pangkat di tabel kenaikan pangkat
        KenaikanPangkat::find($id)->update([
            "id_golongan"           => null,
            "pangkat_baru"          => null,
            "jenis_kp"              => null,
            "no_sk"                 => null,
            "tanggal"               => null,
            "masa_kerja"            => null,
            "tmt_kenaikan_pangkat"  => null,
            "pejabat_penetap"       => null,
            "file"                  => null,
        ]);

        // Hitung total masa kerja untuk pengurutan
        $total_mkg_hari = hitungMKG2($data2["masa_kerja"]);
        // Update Masa Kerja Golongan di tabel masa kerja
        MasaKerja::where("id_pegawai", $data2["id_pegawai"])
            ->update([
                "mk_golongan" => $data2["masa_kerja"],
                "total_mkg_hari" => $total_mkg_hari,
            ]);

        return response()->json([
            "message" => "Pangkat golongan pegawai dengan id: $kenaikan_pangkat->id_pegawai, berhasil diperbarui",
            "data_updated" => $pegawai
        ], 201);
    }

    // Batalkan Kenaikan Pangkat
    public function batalkanKenaikanPangkat($id)
    {
        $kenaikan_pangkat = KenaikanPangkat::find($id);
        KenaikanPangkat::find($id)->update([
            "id_golongan"           => null,
            "pangkat_baru"          => null,
            "jenis_kp"              => null,
            "no_sk"                 => null,
            "tanggal"               => null,
            "masa_kerja"            => null,
            "tmt_kenaikan_pangkat"  => null,
            "pejabat_penetap"       => null,
            "file"                  => null,
        ]);
        Storage::delete($kenaikan_pangkat->file);

        // Get data kenaikan pangkat setelah dibatalkan
        $kenaikan_pangkat = KenaikanPangkat::find($id);

        return response()->json([
            "message" => "Kenaikan pangkat berhasil dibatalkan",
            "data" => $kenaikan_pangkat
        ], 201);
    }

    // Export KenaikanPangkat Pegawai ke Excel
    public function exportKenaikanPangkatToExcel()
    {
        return (new KenaikanPangkatExport())->download('kenaikan-pangkat-pegawai.xlsx');
    }
}
