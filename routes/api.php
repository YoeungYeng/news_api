<?php

use App\Http\Controllers\NewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource ("/news", NewsController::class);


// for frontend
Route::get("/lastnews", [\App\Http\Controllers\Font\NewsContrller::class, "lastNews"]);
Route::get ("/hotnews", [\App\Http\Controllers\Font\NewsContrller::class, "hotNews"]);
