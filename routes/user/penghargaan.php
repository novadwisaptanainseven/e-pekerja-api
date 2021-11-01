<?php


use App\Http\Controllers\Admin\Pegawai\PenghargaanController;

// Get All Penghargaan
Route::get("{id_pegawai}/penghargaan", [PenghargaanController::class, 'getAll']);
// Get Penghargaan By ID
Route::get("{id_pegawai}/penghargaan/{id_penghargaan}", [PenghargaanController::class, 'getById']);
// Insert Penghargaan
Route::post("{id_pegawai}/penghargaan", [PenghargaanController::class, 'insert']);
// Edit Penghargaan
Route::post("{id_pegawai}/penghargaan/{id_penghargaan}", [PenghargaanController::class, 'edit']);
// Delete Penghargaan
Route::get("{id_pegawai}/penghargaan/{id_penghargaan}/delete", [PenghargaanController::class, 'delete']);
