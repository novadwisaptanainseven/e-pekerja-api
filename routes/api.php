<?php

use App\Http\Controllers\Admin\DUKController;
use App\Http\Controllers\Admin\MasaKerjaController;
use App\Http\Controllers\Admin\Pegawai\PNSController;
use App\Http\Controllers\Admin\Pegawai\PTTBController;
use App\Http\Controllers\Admin\Pegawai\PTTHController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Models\Admin\Pegawai\Absensi;
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
            require __DIR__ . "/admin/index.php";
        });
    });
});

// API LEVEL USER
Route::prefix('v1/user/')->group(function () {
    Route::group(["middleware" => "auth:sanctum"], function () {
        // All secure URL's
        Route::group(["middleware" => "is_user"], function () {
            require __DIR__ . '/user/index.php';
        });
    });
});

// Download File
Route::prefix('v1/')->group(function() {
    // Image
    Route::get('image/{filename}', [FileController::class, "getImage"]);
    // Rekap PDF
    Route::get('print-daftar-pegawai/{jenis_data}', [FileController::class, "cetakDaftarPegawai"]);
    // Rekap PDF Pegawai By ID
    Route::get('print-pegawai/{id_pegawai}/{data}', [FileController::class, "printLaporanPegawai"]);
    // Export PNS to Excel
    Route::get('pns/export', [PNSController::class, "exportToExcel"]);
    // Export PTTH to Excel
    Route::get('ptth/export', [PTTHController::class, "exportToExcel"]);
    // Export PTTB to Excel
    Route::get('pttb/export', [PTTBController::class, "exportToExcel"]);
    // Export Semua Pegawai to Excel
    Route::get('semua-pegawai/export', [PNSController::class, "exportAllPegawaiToExcel"]);
    // Export Rekapitulasi Pegawai to Excel
    Route::get('rekap-pegawai/export', [PNSController::class, "exportRekapPegawaiToExcel"]);
    // Export DUK Pegawai to Excel
    Route::get('duk/export', [DUKController::class, "exportDukToExcel"]);
    // Export Masa Kerja Pegawai to Excel
    Route::get('masa-kerja/export', [MasaKerjaController::class, "exportMasaKerjaToExcel"]);

    // Cetak DUK pegawai
    Route::get('print-duk-pegawai', [FileController::class, "cetakDUK"]);
    // Cetak Masa Kerja Pegawai
    Route::get('print-masa-kerja-pegawai', [FileController::class, "cetakMasaKerja"]);
    // Cetak KGB Pegawai
    Route::get('print-kgb-pegawai/{id_pegawai}', [FileController::class, "cetakKGBPegawai"]);
    // Cetak Pensiun Pegawai
    Route::get('print-pensiun-pegawai', [FileController::class, "cetakPensiunPegawai"]);
    // Rekap Pegawai berdasarkan Golongan/Eselon/Pendidikan/Jenis Kelamin
    Route::get('rekap-pegawai', [PNSController::class, "getRekapPegawai"]);
    // Rekap Pegawai berdasarkan Golongan/Eselon/Pendidikan/Jenis Kelamin
    Route::get('print-rekap-pegawai', [FileController::class, "cetakRekapPegawai"]);
    // Cetak Riwayat Cuti
    Route::get('print-riwayat-cuti/{id_pegawai}', [FileController::class, "cetakRiwayatCuti"]);

    // Cetak Rekap Absensi Pegawai
    Route::get('print-rekap-absensi/{jenis_data}', [FileController::class, "cetakRekapAbsensi"]);
    // Cetak Rekap Absensi Pegawai
    Route::get('print-rekap-absensi-tanggal/{jenis_data}', [FileController::class, "cetakRekapAbsensiByDate"]);
    // Cetak Rekap Absensi Pegawai berdasarkan filter tanggal
    Route::get('print-rekap-absensi-filter/{id_pegawai}', [FileController::class, "cetakRekapAbsensiByFilterTanggal"]);
    // Cetak Rekap Absensi Per Tahun by Id Pegawai
    Route::get('print-rekap-absensi-pegawai/{id_pegawai}', [FileController::class, "cetakRekapAbsensiPerTahun"]);
    // Test
    Route::get('rekap-absensi/{jenis_data}', function ($jenis_data) {
        $data = Absensi::getByStatusPegawai($jenis_data);
        return response($data, 200);
    });

    // Ijazah
    Route::get('ijazah/{filename}', [FileController::class, "getIjazah"]);
    // Dokumentasi Diklat
    Route::get('dok_diklat/{filename}', [FileController::class, "getDokDiklat"]);
    // Dokumentasi Penghargaan
    Route::get('dok_penghargaan/{filename}', [FileController::class, "getDokPenghargaan"]);
    // Berkas Pegawai
    Route::get('berkas/{filename}', [FileController::class, "getBerkas"]);

    // Login User
    Route::post('login', [AuthController::class, "login"]);

    // Register User
    Route::post('register', [UsersController::class, "register"]);

});

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