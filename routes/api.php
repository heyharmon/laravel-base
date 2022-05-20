<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use DDD\Http\Sites\SiteController;
use DDD\Http\Sites\SiteCrawlController;
use DDD\Http\Pages\PageController;

use DDD\Http\Files\FileController;
use DDD\Http\Files\FileSignController;

// Sites
Route::get('/sites',           [SiteController::class, 'index']);
Route::post('/sites',          [SiteController::class, 'store']);
Route::get('/sites/{site}',    [SiteController::class, 'show']);
Route::delete('/sites/{site}', [SiteController::class, 'destroy']);

// Crawl site
Route::prefix('/sites/{site}')->group(function () {
    Route::post('/crawl', [SiteCrawlController::class, 'crawl']);
});

// Pages
Route::prefix('/sites/{site}')->group(function () {
    Route::get('/pages',  [PageController::class, 'index']);
    Route::post('/pages', [PageController::class, 'store']);
});

// Files
Route::get('/files',      [FileController::class, 'index']);
Route::post('/files',     [FileController::class, 'store']);
Route::post('/file/sign', [FileSignController::class, 'sign']);
