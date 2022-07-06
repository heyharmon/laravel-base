<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use DDD\Http\Auth\AuthController;
use DDD\Http\Organizations\OrganizationController;
use DDD\Http\Organizations\OrganizationCommentController;
use DDD\Http\Organizations\OrganizationMediaController;
use DDD\Http\Organizations\OrganizationMetaController;
use DDD\Http\Teams\TeamController;
use DDD\Http\Tags\TagController;
use DDD\Http\Sites\SiteController;
use DDD\Http\Sites\SiteCrawlController;
use DDD\Http\Pages\PageController;
use DDD\Http\Pages\PageTagController;
use DDD\Http\Files\FileController; // TODO: Delete

use DDD\Http\Test\TestController; // TODO: Delete

// TODO: Delete
// Test Routes
Route::middleware('auth:sanctum')->group(function() {
    Route::get('test',  [TestController::class, 'test']);
    Route::get('{organization:slug}/users', [TestController::class, 'users']);
});

// Public - Auth
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);

// Public - Organization - Files
// TODO: Remove
Route::prefix('{organization:slug}')->group(function() {
    Route::get('/files', [FileController::class, 'index']);
});

// Public - Organization - Comments
Route::prefix('/organizations/{organization:slug}')->group(function() {
    Route::get('/comments', [OrganizationCommentController::class, 'index']);
});

// Public - Organization - Media
Route::prefix('/organizations/{organization:slug}')->group(function() {
    Route::get('/media', [OrganizationMediaController::class, 'index']);
});

Route::middleware('auth:sanctum')->group(function() {
    // Auth
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::get('auth/me', [AuthController::class, 'me']);

    // Organizations
    Route::get('organizations', [OrganizationController::class, 'index']);
    Route::post('organizations', [OrganizationController::class, 'store']);
    Route::get('organizations/{organization:slug}', [OrganizationController::class, 'show']);
    Route::put('organizations/{organization:slug}', [OrganizationController::class, 'update']);
    Route::delete('organizations/{organization:slug}', [OrganizationController::class, 'destroy']);

    // Organization - Comments
    Route::prefix('/organizations/{organization:slug}')->group(function() {
        Route::post('/comments', [OrganizationCommentController::class, 'store']);
        Route::delete('comments/{comment}', [OrganizationCommentController::class, 'destroy']);
    });

    // Organization - Media
    Route::prefix('/organizations/{organization:slug}')->group(function() {
        Route::post('/media', [OrganizationMediaController::class, 'store']);
        Route::delete('media/{media}', [OrganizationMediaController::class, 'destroy']);
    });

    // Organization - Meta
    Route::prefix('/organizations/{organization:slug}')->group(function() {
        Route::get('/meta', [OrganizationMetaController::class, 'index']);
        Route::post('/meta', [OrganizationMetaController::class, 'store']);
        Route::get('/meta/{meta:key}', [OrganizationMetaController::class, 'show']);
    });

    // TODO: Remove
    // Files
    Route::prefix('{organization:slug}')->group(function() {
        Route::post('/files', [FileController::class, 'store']);
        Route::delete('files/{file}', [FileController::class, 'destroy']);
    });

    // Teams
    Route::prefix('{organization:slug}')->group(function() {
        Route::get('/teams', [TeamController::class, 'index']);
        Route::post('/teams', [TeamController::class, 'store']);
        Route::get('/teams/{team:slug}', [TeamController::class, 'show']);
        Route::put('teams/{team:slug}', [TeamController::class, 'update']);
        Route::delete('/teams/{team:slug}', [TeamController::class, 'destroy']);
    });

    // Sites
    Route::prefix('{organization:slug}')->group(function() {
        Route::get('/sites', [SiteController::class, 'index']);
        Route::post('/sites', [SiteController::class, 'store']);
        Route::get('/sites/{site}', [SiteController::class, 'show']);
        Route::delete('/sites/{site}', [SiteController::class, 'destroy']);

        // Crawl site
        Route::prefix('/sites/{site}')->group(function() {
            Route::post('/crawl', [SiteCrawlController::class, 'crawl']);
        });
    });

    // Pages
    Route::prefix('/sites/{site}')->group(function() {
        Route::get('/pages', [PageController::class, 'index']);
        Route::post('/pages', [PageController::class, 'store']);

        // Tagging
        route::post('/pages/{page}/tag', [PageTagController::class, 'tag']);
        route::post('/pages/{page}/untag', [PageTagController::class, 'untag']);
        route::post('/pages/{page}/retag', [PageTagController::class, 'retag']);
    });

    // Tags
    Route::prefix('tags')->group(function() {
        Route::get('/', [TagController::class, 'index']);
        Route::post('/', [TagController::class, 'store']);
        Route::get('/{tag:slug}', [TagController::class, 'show']);
        Route::put('/{tag:slug}', [TagController::class, 'update']);
        Route::delete('/{tag:slug}', [TagController::class, 'destroy']);
    });
});
