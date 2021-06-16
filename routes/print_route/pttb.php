<?php

// Export PTTB to Excel

use App\Http\Controllers\Admin\Pegawai\PTTBController;

Route::get('pttb/export', [PTTBController::class, "exportToExcel"]);
