<?php

use App\Http\Controllers\Admin\CutiController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DUKController;
use App\Http\Controllers\Admin\KGBController;
use App\Http\Controllers\Admin\MasaKerjaController;
use App\Http\Controllers\Admin\MasterData\AgamaController;
use App\Http\Controllers\Admin\MasterData\BidangController;
use App\Http\Controllers\Admin\MasterData\JabatanController;
use App\Http\Controllers\Admin\MasterData\PangkatEselonController;
use App\Http\Controllers\Admin\MasterData\PangkatGolonganController;
use App\Http\Controllers\Admin\MasterData\StatusPegawaiController;
use App\Http\Controllers\Admin\MasterData\SubBidangController;
use App\Http\Controllers\Admin\Pegawai\AbsensiController;
use App\Http\Controllers\Admin\Pegawai\BerkasController;
use App\Http\Controllers\Admin\Pegawai\DiklatController;
use App\Http\Controllers\Admin\Pegawai\KeluargaController;
use App\Http\Controllers\Admin\Pegawai\PendidikanController;
use App\Http\Controllers\Admin\Pegawai\PenghargaanController;
use App\Http\Controllers\Admin\Pegawai\PNSController;
use App\Http\Controllers\Admin\Pegawai\PTTBController;
use App\Http\Controllers\Admin\Pegawai\PTTHController;
use App\Http\Controllers\Admin\Pegawai\RiwayatKerjaController;
use App\Http\Controllers\Admin\PenghargaanController as AdminPenghargaanController;
use App\Http\Controllers\Admin\PensiunController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\User\AkunController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\DataKepegawaian\BerkasController as DataKepegawaianBerkasController;
use App\Http\Controllers\User\DataKepegawaian\DataDiriController;
use App\Http\Controllers\User\DataKepegawaian\DiklatController as DataKepegawaianDiklatController;
use App\Http\Controllers\User\DataKepegawaian\KeluargaController as DataKepegawaianKeluargaController;
use App\Http\Controllers\User\DataKepegawaian\PendidikanController as DataKepegawaianPendidikanController;
use App\Http\Controllers\User\DataKepegawaian\PenghargaanController as DataKepegawaianPenghargaanController;
use App\Http\Controllers\User\DataKepegawaian\RiwayatKerjaController as DataKepegawaianRiwayatKerjaController;
use App\Models\Admin\Pegawai\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// API LEVEL ADMIN
Route::prefix('v1/admin/')->group(function () {

    Route::group(['middleware' => 'auth:sanctum'], function () {
        // All Secure URL's

        Route::group(['middleware' => 'is_admin'], function () {

            // Get All Dashboard Information
            Route::get("dashboard", [DashboardController::class, "getInformation"]);

            // GROUP MASTER DATA
            Route::prefix('master-data/')->group(function () {
                // GROUP AGAMA
                // Get All Agama
                Route::get("agama", [AgamaController::class, "getAll"]);
                // Get Agama By Id
                Route::get("agama/{id_agama}", [AgamaController::class, "getById"]);
                // Insert Agama
                Route::post("agama", [AgamaController::class, "insert"]);
                // Edit Agama
                Route::put("agama/{id_agama}", [AgamaController::class, "edit"]);
                // Delete Agama By Id
                Route::delete("agama/{id_agama}", [AgamaController::class, "delete"]);

                // GROUP PANGKAT GOLONGAN
                // Get All Pangkat Golongan
                Route::get("pangkat-golongan", [PangkatGolonganController::class, "getAll"]);
                // Get Pangkat Golongan By Id
                Route::get("pangkat-golongan/{id_pangkat_golongan}", [PangkatGolonganController::class, "getById"]);
                // Insert Pangkat Golongan
                Route::post("pangkat-golongan", [PangkatGolonganController::class, "insert"]);
                // Edit Pangkat Golongan
                Route::put("pangkat-golongan/{id_pangkat_golongan}", [PangkatGolonganController::class, "edit"]);
                // Delete Pangkat Golongan By Id
                Route::delete("pangkat-golongan/{id_pangkat_golongan}", [PangkatGolonganController::class, "delete"]);

                // GROUP PANGKAT ESELON
                // Get All Pangkat Eselon
                Route::get("pangkat-eselon", [PangkatEselonController::class, "getAll"]);
                // Get Pangkat Eselon By Id
                Route::get("pangkat-eselon/{id_pangkat_eselon}", [PangkatEselonController::class, "getById"]);
                // Insert Pangkat Eselon
                Route::post("pangkat-eselon", [PangkatEselonController::class, "insert"]);
                // Edit Pangkat Eselon
                Route::put("pangkat-eselon/{id_pangkat_eselon}", [PangkatEselonController::class, "edit"]);
                // Delete Pangkat Eselon By Id
                Route::delete("pangkat-eselon/{id_pangkat_eselon}", [PangkatEselonController::class, "delete"]);

                // GROUP JABATAN
                // Get All Jabatan
                Route::get("jabatan", [JabatanController::class, "getAll"]);
                // Get Jabatan By Id
                Route::get("jabatan/{id_jabatan}", [JabatanController::class, "getById"]);
                // Insert Jabatan
                Route::post("jabatan", [JabatanController::class, "insert"]);
                // Edit Jabatan
                Route::put("jabatan/{id_jabatan}", [JabatanController::class, "edit"]);
                // Delete Jabatan By Id
                Route::delete("jabatan/{id_jabatan}", [JabatanController::class, "delete"]);

                // GROUP BIDANG
                // Get All Bidang
                Route::get("bidang", [BidangController::class, "getAll"]);
                // Get Bidang By Id
                Route::get("bidang/{id_bidang}", [BidangController::class, "getById"]);
                // Insert Bidang
                Route::post("bidang", [BidangController::class, "insert"]);
                // Edit Bidang
                Route::put("bidang/{id_bidang}", [BidangController::class, "edit"]);
                // Delete Bidang By Id
                Route::delete("bidang/{id_bidang}", [BidangController::class, "delete"]);

                // GROUP SUB BIDANG
                // Get All Sub Bidang
                Route::get("sub-bidang", [SubBidangController::class, "getAll"]);
                // Get Sub Bidang By Id
                Route::get("sub-bidang/{id_sub_bidang}", [SubBidangController::class, "getById"]);
                // Insert Sub Bidang
                Route::post("sub-bidang", [SubBidangController::class, "insert"]);
                // Edit Sub Bidang
                Route::put("sub-bidang/{id_sub_bidang}", [SubBidangController::class, "edit"]);
                // Delete Sub Bidang By Id
                Route::delete("sub-bidang/{id_sub_bidang}", [SubBidangController::class, "delete"]);

                // GROUP STATUS PEGAWAI
                // Get All Status Pegawai
                Route::get("status-pegawai", [StatusPegawaiController::class, "getAll"]);
                // Get Status Pegawai By Id
                Route::get("status-pegawai/{id_status_pegawai}", [StatusPegawaiController::class, "getById"]);
                // Insert Status Pegawai
                Route::post("status-pegawai", [StatusPegawaiController::class, "insert"]);
                // Edit Status Pegawai
                Route::put("status-pegawai/{id_status_pegawai}", [StatusPegawaiController::class, "edit"]);
                // Delete Status Pegawai By Id
                Route::delete("status-pegawai/{id_status_pegawai}", [StatusPegawaiController::class, "delete"]);
            });

            // GROUP PEGAWAI
            Route::prefix("pegawai/")->group(function () {
                // Get All Pegawai (PNS, PTTH, PTTB)
                Route::get("semua-pegawai", [PNSController::class, "getAllPegawai"]);

                // GROUP PNS
                // Get All PNS
                Route::get("pns", [PNSController::class, 'getAll']);
                // Get PNS By ID
                Route::get("pns/{id_pegawai}", [PNSController::class, 'getById']);
                // Insert PNS
                Route::post("pns", [PNSController::class, 'insert']);
                // Edit PNS
                Route::post("pns/{id_pegawai}", [PNSController::class, 'edit']);
                // Delete PNS
                Route::delete("pns/{id_pegawai}", [PNSController::class, 'delete']);

                // GROUP PTTH
                // Get All PTTH
                Route::get("ptth", [PTTHController::class, 'getAll']);
                // Get PTTH By ID
                Route::get("ptth/{id_pegawai}", [PTTHController::class, 'getById']);
                // Insert PTTH
                Route::post("ptth", [PTTHController::class, 'insert']);
                // Edit PTTH
                Route::post("ptth/{id_pegawai}", [PTTHController::class, 'edit']);
                // Delete PTTH
                Route::delete("ptth/{id_pegawai}", [PTTHController::class, 'delete']);

                // GROUP PTTB
                // Get All PTTB
                Route::get("pttb", [PTTBController::class, 'getAll']);
                // Get PTTB By ID
                Route::get("pttb/{id_pegawai}", [PTTBController::class, 'getById']);
                // Insert PTTB
                Route::post("pttb", [PTTBController::class, 'insert']);
                // Edit PTTB
                Route::post("pttb/{id_pegawai}", [PTTBController::class, 'edit']);
                // Delete PTTB
                Route::delete("pttb/{id_pegawai}", [PTTBController::class, 'delete']);

                // GROUP KELUARGA
                // Get All Keluarga
                Route::get("{id_pegawai}/keluarga", [KeluargaController::class, 'getAll']);
                // Get Keluarga By ID
                Route::get("{id_pegawai}/keluarga/{id_keluarga}", [KeluargaController::class, 'getById']);
                // Insert Keluarga
                Route::post("{id_pegawai}/keluarga", [KeluargaController::class, 'insert']);
                // Edit Keluarga
                Route::put("{id_pegawai}/keluarga/{id_keluarga}", [KeluargaController::class, 'edit']);
                // Delete Keluarga
                Route::delete("{id_pegawai}/keluarga/{id_keluarga}", [KeluargaController::class, 'delete']);

                // GROUP PENDIDIKAN
                // Get All Pendidikan
                Route::get("{id_pegawai}/pendidikan", [PendidikanController::class, 'getAll']);
                // Get Pendidikan By ID
                Route::get("{id_pegawai}/pendidikan/{id_pendidikan}", [PendidikanController::class, 'getById']);
                // Insert Pendidikan
                Route::post("{id_pegawai}/pendidikan", [PendidikanController::class, 'insert']);
                // Edit Pendidikan
                Route::post("{id_pegawai}/pendidikan/{id_pendidikan}", [PendidikanController::class, 'edit']);
                // Delete Pendidikan
                Route::delete("{id_pegawai}/pendidikan/{id_pendidikan}", [PendidikanController::class, 'delete']);

                // GROUP DIKLAT
                // Get All Diklat
                Route::get("{id_pegawai}/diklat", [DiklatController::class, 'getAll']);
                // Get Diklat By ID
                Route::get("{id_pegawai}/diklat/{id_diklat}", [DiklatController::class, 'getById']);
                // Insert Diklat
                Route::post("{id_pegawai}/diklat", [DiklatController::class, 'insert']);
                // Edit Diklat
                Route::post("{id_pegawai}/diklat/{id_diklat}", [DiklatController::class, 'edit']);
                // Delete Diklat
                Route::delete("{id_pegawai}/diklat/{id_diklat}", [DiklatController::class, 'delete']);

                // GROUP RIWAYAT KERJA
                // Get All Riwayat Kerja
                Route::get("{id_pegawai}/riwayat-kerja", [RiwayatKerjaController::class, 'getAll']);
                // Get Riwayat Kerja By ID
                Route::get("{id_pegawai}/riwayat-kerja/{id_riwayat_kerja}", [RiwayatKerjaController::class, 'getById']);
                // Insert Riwayat Kerja
                Route::post("{id_pegawai}/riwayat-kerja", [RiwayatKerjaController::class, 'insert']);
                // Edit Riwayat Kerja
                Route::put("{id_pegawai}/riwayat-kerja/{id_riwayat_kerja}", [RiwayatKerjaController::class, 'edit']);
                // Delete Riwayat Kerja
                Route::delete("{id_pegawai}/riwayat-kerja/{id_riwayat_kerja}", [RiwayatKerjaController::class, 'delete']);

                // GROUP PENGHARGAAN
                // Get All Penghargaan
                Route::get("{id_pegawai}/penghargaan", [PenghargaanController::class, 'getAll']);
                // Get Penghargaan By ID
                Route::get("{id_pegawai}/penghargaan/{id_penghargaan}", [PenghargaanController::class, 'getById']);
                // Insert Penghargaan
                Route::post("{id_pegawai}/penghargaan", [PenghargaanController::class, 'insert']);
                // Edit Penghargaan
                Route::post("{id_pegawai}/penghargaan/{id_penghargaan}", [PenghargaanController::class, 'edit']);
                // Delete Penghargaan
                Route::delete("{id_pegawai}/penghargaan/{id_penghargaan}", [PenghargaanController::class, 'delete']);

                // GROUP BERKAS
                // Get All Berkas
                Route::get("{id_pegawai}/berkas", [BerkasController::class, 'getAll']);
                // Get Berkas By ID
                Route::get("{id_pegawai}/berkas/{id_berkas}", [BerkasController::class, 'getById']);
                // Insert Berkas
                Route::post("{id_pegawai}/berkas", [BerkasController::class, 'insert']);
                // Edit Berkas
                Route::put("{id_pegawai}/berkas/{id_berkas}", [BerkasController::class, 'edit']);
                // Delete Berkas
                Route::delete("{id_pegawai}/berkas/{id_berkas}", [BerkasController::class, 'delete']);

                // GROUP KENAIKAN GAJI BERKALA
                // Insert Kenaikan Gaji Berkala
                Route::post("{id_pegawai}/kgb", [KGBController::class, 'insert']);
                // Edit Kenaikan Gaji Berkala
                Route::put("{id_pegawai}/kgb/{id_kgb}", [KGBController::class, 'edit']);
                // Get All Kenaikan Gaji Berkala
                Route::get("{id_pegawai}/kgb", [KGBController::class, 'getAll']);
                // Get Kenaikan Gaji Berkala Terbaru
                Route::get("{id_pegawai}/kgb-terbaru", [KGBController::class, 'getKGBTerbaru']);
                // Get Kenaikan Gaji Berkala By Id
                Route::get("{id_pegawai}/kgb/{id_kgb}", [KGBController::class, 'getById']);
                // Delete Kenaikan Gaji Berkala By Id
                Route::delete("{id_pegawai}/kgb/{id_kgb}", [KGBController::class, 'delete']);

                // GROUP CUTI
                // Insert Cuti
                Route::post("{id_pegawai}/cuti", [CutiController::class, 'insert']);
                // Edit Cuti
                Route::put("{id_pegawai}/cuti/{id_cuti}", [CutiController::class, 'edit']);
                // Update Status Cuti
                Route::put("{id_pegawai}/cuti/{id_cuti}/status", [CutiController::class, 'updateStatus']);
                // Get All Cuti by Id Pegawai
                Route::get("{id_pegawai}/cuti", [CutiController::class, 'getAll']);
                // Get Cuti by Id Cuti
                Route::get("{id_pegawai}/cuti/{id_cuti}", [CutiController::class, 'getById']);
                // Get All Cuti Pegawai
                Route::get("cuti", [CutiController::class, 'getAllCuti']);
                // Get Cuti By Id
                Route::delete("{id_pegawai}/cuti/{id_cuti}", [CutiController::class, 'delete']);
                // Search Cuti By Nama Pegawai
                Route::get("cuti-nama", [CutiController::class, 'getByName']);
                // Get All Pegawai Cuti
                Route::get("pegawai-cuti", [CutiController::class, 'getPegawaiCuti']);

                // GROUP ABSENSI
                // Get All Absensi by Id Pegawai and Query Parameters
                Route::get("{id_pegawai}/absensi-params", [AbsensiController::class, "getAbsensiByQuery"]);
                // Get Riwayat Absensi by Id Pegawai and Filter
                Route::get("{id_pegawai}/absensi", [AbsensiController::class, "getAbsensiByFilter"]);
                // Insert Absensi
                Route::post("{id_pegawai}/absensi", [AbsensiController::class, "insert"]);
                // Insert or Update Absensi
                Route::post("{id_pegawai}/absensi/insert-update", [AbsensiController::class, "insertOrUpdate"]);
                // Edit Absensi
                Route::put("{id_pegawai}/absensi/{id_absensi}", [AbsensiController::class, "edit"]);
                // Get Absensi by Id Pegawai & Id Absensi
                Route::get("{id_pegawai}/absensi/{id_absensi}", [AbsensiController::class, "getById"]);
                // Delete Absensi
                Route::delete("{id_pegawai}/absensi/{id_absensi}", [AbsensiController::class, "delete"]);
                // Get Informasi Rekap Absensi per Tahun by Id Pegawai
                Route::get("{id_pegawai}/rekap-absensi", [AbsensiController::class, "getRekapAbsensiPerTahun"]);
                // Get All Rekap Absensi Pegawai Per Tahun 
                Route::get("rekap-absensi", [AbsensiController::class, "getAllRekapAbsensiPerTahun"]);
                // Get All Rekap Absensi Pegawai by Tanggal 
                Route::get("rekap-absensi-tanggal", [AbsensiController::class, "getRekapAbsensiByDate"]);
                // Tambah Rekap Absensi
                Route::post("{id_pegawai}/rekap-absensi", [AbsensiController::class, "insertRekapAbsensi"]);
            });

            // GROUP DUK PEGAWAI
            // Edit DUK
            Route::put("duk-pegawai/{id_duk}", [DUKController::class, 'edit']);
            // Get All DUK
            Route::get("duk-pegawai", [DUKController::class, 'getAll']);
            // Get All DUK For Print
            Route::get("duk-pegawai-print", [DUKController::class, 'getAllForPrint']);
            // Get DUK By Id
            Route::get("duk-pegawai/{id_duk}", [DUKController::class, 'getById']);

            // GROUP MASA KERJA
            // Edit Masa Kerja
            Route::put("masa-kerja/{id_masa_kerja}", [MasaKerjaController::class, 'edit']);
            // Get All Masa Kerja
            Route::get("masa-kerja", [MasaKerjaController::class, 'getAll']);
            // Get All Masa Kerja For Print
            Route::get("masa-kerja-pegawai-print", [MasaKerjaController::class, 'getAllForPrint']);
            // Get Masa Kerja By Id
            Route::get("masa-kerja/{id_masa_kerja}", [MasaKerjaController::class, 'getById']);

            // GROUP PENGHARGAAN
            // Get All Penghargaan
            Route::get("penghargaan", [AdminPenghargaanController::class, "getAll"]);
            // Insert Penghargaan
            Route::post("penghargaan", [AdminPenghargaanController::class, "insert"]);
            // Detail Penghargaan
            Route::get("penghargaan/{id_penghargaan}", [AdminPenghargaanController::class, "getById"]);
            // Edit Penghargaan
            Route::post("penghargaan/{id_penghargaan}", [AdminPenghargaanController::class, "edit"]);
            // Delete Penghargaan
            Route::delete("penghargaan/{id_penghargaan}", [AdminPenghargaanController::class, "delete"]);

            // GROUP PENSIUN
            // Get All Pensiun
            Route::get("pensiun", [PensiunController::class, "getAll"]);
            // Insert Pensiun
            Route::post("pensiun", [PensiunController::class, "insert"]);
            // Detail Pensiun
            Route::get("pensiun/{id_pensiun}", [PensiunController::class, "getById"]);
            // Edit Pensiun
            Route::put("pensiun/{id_pensiun}", [PensiunController::class, "edit"]);
            // Delete Pensiun
            Route::delete("pensiun/{id_pensiun}", [PensiunController::class, "delete"]);
            // Batalkan Pensiun
            Route::delete("pensiun-batal/{id_pensiun}", [PensiunController::class, "batalkanPensiun"]);

            // GROUP USERS
            // Get All Users
            Route::get("users", [UsersController::class, "getAll"]);
            // Insert Users
            Route::post("users", [UsersController::class, "insert"]);
            // Detail Users
            Route::get("users/{id_user}", [UsersController::class, "getById"]);
            // Edit Users
            Route::post("users/{id_user}", [UsersController::class, "edit"]);
            // Edit Password
            Route::put("users-password/{id_user}", [UsersController::class, "editPassword"]);
            // Delete Users
            Route::delete("users/{id_user}", [UsersController::class, "delete"]);
        });
    });
});

// API LEVEL USER
Route::prefix('v1/user/')->group(function () {
    Route::group(["middleware" => "auth:sanctum"], function () {
        // All secure URL's

        Route::group(["middleware" => "is_user"], function () {

            // GROUP DASHBOARD
            Route::get("dashboard", [UserDashboardController::class, "getInformation"]);

            // GROUP DATA KEPEGAWAIAN
            Route::prefix("data-kepegawaian/")->group(function () {
                // Data Diri
                Route::get("data-diri", [DataDiriController::class, "getDataDiri"]);
                // Data Keluarga
                Route::get("keluarga", [DataKepegawaianKeluargaController::class, "getAll"]);
                // Data Pendidikan
                Route::get("pendidikan", [DataKepegawaianPendidikanController::class, "getAll"]);
                // Data Diklat
                Route::get("diklat", [DataKepegawaianDiklatController::class, "getAll"]);
                // Data Riwayat Kerja
                Route::get("riwayat-kerja", [DataKepegawaianRiwayatKerjaController::class, "getAll"]);
                // Data Penghargaan
                Route::get("penghargaan", [DataKepegawaianPenghargaanController::class, "getAll"]);

                // Data Berkas
                // Get All
                Route::get("berkas", [DataKepegawaianBerkasController::class, "getAll"]);
                // Insert Berkas
                Route::post("berkas", [DataKepegawaianBerkasController::class, "insert"]);
                // Delete Berkas
                Route::delete("berkas/{id_berkas}", [DataKepegawaianBerkasController::class, "delete"]);
            });

            // GROUP AKUN
            // Get Akun
            Route::get("akun", [AuthController::class, "me"]);
            // Edit Akun
            Route::post("akun", [AkunController::class, "edit"]);
            // Edit Password
            Route::put("akun-password", [AkunController::class, "editPassword"]);
        });
    });
});

// Download File
// Image
Route::get('v1/image/{filename}', [FileController::class, "getImage"]);
// Rekap PDF
Route::get('v1/print-daftar-pegawai/{jenis_data}', [FileController::class, "cetakDaftarPegawai"]);
// Rekap PDF Pegawai By ID
Route::get('v1/print-pegawai/{id_pegawai}/{data}', [FileController::class, "printLaporanPegawai"]);
// Cetak DUK pegawai
Route::get('v1/print-duk-pegawai', [FileController::class, "cetakDUK"]);
// Cetak Masa Kerja Pegawai
Route::get('v1/print-masa-kerja-pegawai', [FileController::class, "cetakMasaKerja"]);
// Cetak KGB Pegawai
Route::get('v1/print-kgb-pegawai/{id_pegawai}', [FileController::class, "cetakKGBPegawai"]);
// Cetak Pensiun Pegawai
Route::get('v1/print-pensiun-pegawai', [FileController::class, "cetakPensiunPegawai"]);

// Cetak Rekap Absensi Pegawai
Route::get('v1/print-rekap-absensi/{jenis_data}', [FileController::class, "cetakRekapAbsensi"]);
// Cetak Rekap Absensi Pegawai
Route::get('v1/print-rekap-absensi-tanggal/{jenis_data}', [FileController::class, "cetakRekapAbsensiByDate"]);
// Cetak Rekap Absensi Pegawai berdasarkan filter tanggal
Route::get('v1/print-rekap-absensi-filter/{id_pegawai}', [FileController::class, "cetakRekapAbsensiByFilterTanggal"]);
// Cetak Rekap Absensi Per Tahun by Id Pegawai
Route::get('v1/print-rekap-absensi-pegawai/{id_pegawai}', [FileController::class, "cetakRekapAbsensiPerTahun"]);
// Test
Route::get('v1/rekap-absensi/{jenis_data}', function ($jenis_data) {
    $data = Absensi::getByStatusPegawai($jenis_data);
    return response($data, 200);
});

// Ijazah
Route::get('v1/ijazah/{filename}', [FileController::class, "getIjazah"]);
// Dokumentasi Diklat
Route::get('v1/dok_diklat/{filename}', [FileController::class, "getDokDiklat"]);
// Dokumentasi Penghargaan
Route::get('v1/dok_penghargaan/{filename}', [FileController::class, "getDokPenghargaan"]);
// Berkas Pegawai
Route::get('v1/berkas/{filename}', [FileController::class, "getBerkas"]);

// Login User
Route::post('v1/login', [AuthController::class, "login"]);

// Register User
Route::post('v1/register', [UsersController::class, "register"]);

// Logout User
Route::middleware('auth:sanctum')->post('v1/logout', [AuthController::class, "logout"]);

// Cek User Saat Ini
Route::middleware('auth:sanctum')->get('v1/user', [AuthController::class, "me"]);





// Route::group(['middleware' => 'auth:sanctum'], function () {
//     // For Checking User
//     Route::get('/cek_auth', [AuthController::class, 'me']);
// });

// My Token
// 1|0hUstX659nTXkmWznJ7QSuJBpI9y1ny1Fn1ix8k2