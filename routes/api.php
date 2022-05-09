<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use DDD\Http\Sites\SiteController;

Route::get('/sites',                [SiteController::class, 'index']);
Route::post('/sites',               [SiteController::class, 'store']);
Route::get('/sites/{site:host}',    [SiteController::class, 'show']);
Route::delete('/sites/{site:host}', [SiteController::class, 'destroy']);
