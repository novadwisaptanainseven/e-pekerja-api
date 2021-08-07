<?php

use App\Http\Controllers\Admin\MasterData\AgamaController;
use App\Http\Controllers\Admin\MasterData\BidangController;
use App\Http\Controllers\Admin\MasterData\JabatanController;
use App\Http\Controllers\Admin\MasterData\PangkatEselonController;

$prefix = 'master-data/';

Route::prefix($prefix)->group(function () {
  // Get All Bidang
  Route::get("bidang", [BidangController::class, "getAll"]);
  // Get All Jabatan
  Route::get("jabatan", [JabatanController::class, "getAll"]);
  // Get All Agama
  Route::get("agama", [AgamaController::class, "getAll"]);
  // Get All Eselon
  Route::get("eselon", [PangkatEselonController::class, "getAll"]);
});
