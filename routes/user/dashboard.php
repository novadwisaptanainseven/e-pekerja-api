<?php

use App\Http\Controllers\Admin\StrukturOrgController;
use App\Http\Controllers\User\DashboardController;

// Get informasi dashboard
Route::get("dashboard", [DashboardController::class, "getInformation"]);

// Get all struktur organisasi
Route::get("struktur", [StrukturOrgController::class, "get"]);
