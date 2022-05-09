<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use DDD\Http\Sites\SiteController;
use DDD\Http\Pages\PageController;

// Sites
Route::get('/sites',                [SiteController::class, 'index']);
Route::post('/sites',               [SiteController::class, 'store']);
Route::get('/sites/{site:host}',    [SiteController::class, 'show']);
Route::delete('/sites/{site:host}', [SiteController::class, 'destroy']);

// Pages
Route::get('/sites/{site:host}/pages',  [PageController::class, 'index']);
Route::post('/sites/{site:host}/pages', [PageController::class, 'store']);
