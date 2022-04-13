<?php

use Framework59\Route;

Route::create('get', 'home', [Framework59\App\Http\Controllers\HomeController::class, 'home']);
Route::create('get', '', [Framework59\App\Http\Controllers\HomeController::class, 'index']);
