<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use DDD\Http\Organizations\OrganizationController;
use DDD\Http\Sites\SiteController;
use DDD\Http\Sites\SiteCrawlController;
use DDD\Http\Pages\PageController;
use DDD\Http\Files\FileController;

// Organizations
Route::get('organizations',                   [OrganizationController::class, 'index']);
Route::post('organizations',                  [OrganizationController::class, 'store']);
Route::get('organizations/{organization}',    [OrganizationController::class, 'show']);
Route::put('organizations/{organization}',    [OrganizationController::class, 'update']);
Route::delete('organizations/{organization}', [OrganizationController::class, 'destroy']);

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
Route::prefix('{organization}')->group(function () {
    Route::get('/files',          [FileController::class, 'index']);
    Route::post('/files',         [FileController::class, 'store']);
    Route::delete('files/{file}', [FileController::class, 'destroy']);
});
