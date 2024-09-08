<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/kaka', function () {
    return view('welcome');
});

Route::get('/', SiteController::class);
