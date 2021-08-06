<?php

use App\Http\Controllers\Admin\MasterData\AgamaController;
use App\Http\Controllers\Admin\MasterData\JabatanController;
use App\Http\Controllers\Admin\Pegawai\PNSController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\AuthController;
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
Route::prefix('v1/')->group(function () {
    include_once __DIR__ . "/print_route/index.php";
    include_once __DIR__ . "/download_files/index.php";

    // Login User
    Route::post('login', [AuthController::class, "login"]);

    // Register User
    Route::post('register', [UsersController::class, "register"]);

    // Get All Jabatan
    Route::get("jabatan", [JabatanController::class, "getAll"]);

    // Get All Agama
    Route::get("agama", [AgamaController::class, "getAll"]);

    // Get PNS By ID
    Route::get("pns/{id_pegawai}", [PNSController::class, 'getById']);

    // Test
    // Route::get('rekap-absensi/{jenis_data}', function ($jenis_data) {
    //     $data = Absensi::getByStatusPegawai($jenis_data);
    //     return response($data, 200);
    // });
});

// Logout User
Route::middleware('auth:sanctum')->post('v1/logout', [AuthController::class, "logout"]);

// Cek User Saat Ini
Route::middleware('auth:sanctum')->get('v1/user', [AuthController::class, "me"]);

// API Publik
include_once __DIR__ . "/public_route/index.php";

// Route::group(['middleware' => 'auth:sanctum'], function () {
//     // For Checking User
//     Route::get('/cek_auth', [AuthController::class, 'me']);
// });

// My Token
// 1|0hUstX659nTXkmWznJ7QSuJBpI9y1ny1Fn1ix8k2