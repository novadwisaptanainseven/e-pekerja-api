<?php

use App\Http\Controllers\Admin\Pegawai\PNSController;
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
// Rekap Pegawai berdasarkan Golongan/Eselon/Pendidikan/Jenis Kelamin
Route::get('v1/rekap-pegawai', [PNSController::class, "getRekapPegawai"]);
// Rekap Pegawai berdasarkan Golongan/Eselon/Pendidikan/Jenis Kelamin
Route::get('v1/print-rekap-pegawai', [FileController::class, "cetakRekapPegawai"]);
// Cetak Riwayat Cuti
Route::get('v1/print-riwayat-cuti/{id_pegawai}', [FileController::class, "cetakRiwayatCuti"]);

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