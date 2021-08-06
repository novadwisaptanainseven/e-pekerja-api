<?php


use App\Http\Controllers\Admin\Pegawai\DiklatController;

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
