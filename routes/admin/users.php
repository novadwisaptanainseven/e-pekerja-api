<?php

// GROUP USERS
// Get All Users

use App\Http\Controllers\Admin\UsersController;

Route::get("users", [UsersController::class, "getAll"]);
// Insert Users
Route::post("users", [UsersController::class, "register"]);
// Detail Users
Route::get("users/{id_user}", [UsersController::class, "getById"]);
// Edit Users
Route::post("users/{id_user}", [UsersController::class, "edit"]);
// Edit Password
Route::post("users-password/{id_user}", [UsersController::class, "editPassword"]);
// Delete Users
Route::get("users/{id_user}/delete", [UsersController::class, "delete"]);
