<?php

use App\Http\Controllers\Admin\Pegawai\PNSController;
use App\Http\Controllers\Admin\Pegawai\PTTBController;
use App\Http\Controllers\Admin\Pegawai\PTTHController;

$prefix = "pegawai/";

Route::prefix($prefix)->group(function () {

  // Edit PNS
  Route::post("pns/{id_pegawai}", [PNSController::class, 'edit']);
  // Edit PTTH
  Route::post("ptth/{id_pegawai}", [PTTHController::class, 'edit']);
  // Edit PTTB
  Route::post("pttb/{id_pegawai}", [PTTBController::class, 'edit']);
});
