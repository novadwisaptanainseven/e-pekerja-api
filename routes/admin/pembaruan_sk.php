<?php

// GROUP PembaruanSK PEGAWAI
// Edit PembaruanSK

use App\Http\Controllers\Admin\PembaruanSKController;

$prefix = "pegawai/";

Route::prefix($prefix)->group(function () {

  // Get All Pembaruan SK
  Route::get("{id_pegawai}/pembaruan-sk", [PembaruanSKController::class, 'getAll']);
  // Insert Pembaruan SK
  Route::post("{id_pegawai}/pembaruan-sk", [PembaruanSKController::class, 'insert']);
  // Insert SK
  Route::post("{id_pegawai}/upload-sk", [PembaruanSKController::class, 'upload']);
  // Edit Pembaruan SK By ID
  Route::post("{id_pegawai}/pembaruan-sk/{id}", [PembaruanSKController::class, 'edit']);
  // Get Pembaruan SK By Id
  Route::get("{id_pegawai}/pembaruan-sk/{id}", [PembaruanSKController::class, 'getById']);
  // Delete Pembaruan SK By Id
  Route::get("{id_pegawai}/pembaruan-sk/{id}/delete", [PembaruanSKController::class, 'deleteRiwayatSK']);

  // Insert Riwayat SK
  Route::post("{id_pegawai}/riwayat-sk", [PembaruanSKController::class, 'insert']);
});
