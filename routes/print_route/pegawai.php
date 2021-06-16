<?php

// Rekap PDF

use App\Http\Controllers\FileController;

Route::get('print-daftar-pegawai/{jenis_data}', [FileController::class, "cetakDaftarPegawai"]);

// Rekap PDF Pegawai By ID
Route::get('print-pegawai/{id_pegawai}/{data}', [FileController::class, "printLaporanPegawai"]);

// Rekap Pegawai berdasarkan Golongan/Eselon/Pendidikan/Jenis Kelamin
Route::get('print-rekap-pegawai', [FileController::class, "cetakRekapPegawai"]);
