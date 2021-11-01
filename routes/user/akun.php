<?php

// GROUP AKUN
// Get Akun

use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\AkunController;

Route::get("akun", [AuthController::class, "me"]);
// Edit Akun
Route::post("akun", [AkunController::class, "edit"]);
// Edit Password
Route::post("akun-password", [AkunController::class, "editPassword"]);
