<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use DDD\Http\Auth\AuthController;
use DDD\Http\Designs\DesignController;
use DDD\Http\Media\MediaController;
use DDD\Http\Media\MediaDownloadController;
use DDD\Http\Organizations\OrganizationController;
use DDD\Http\Organizations\OrganizationCommentController;
use DDD\Http\Teams\TeamController;
use DDD\Http\Tags\TagController;
use DDD\Http\Sites\SiteController;
use DDD\Http\Sites\Crawls\CrawlController;
use DDD\Http\Pages\PageController;
use DDD\Http\Pages\PageTagController;

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

// Public - Organization - Comments
Route::prefix('/organizations/{organization:slug}')->group(function() {
    Route::get('/comments', [OrganizationCommentController::class, 'index']);
});

// Public - Media
Route::prefix('/{organization:slug}')->group(function() {
    Route::get('/media', [MediaController::class, 'index']);
    Route::get('/media/{media}', [MediaController::class, 'show']);
});

// Public - Media Download
Route::get('/media/{media:uuid}', [MediaDownloadController::class, 'download']);

// Public - Designs
Route::prefix('{organization:slug}')->group(function() {
    Route::get('/designs', [DesignController::class, 'index']);
    Route::post('/designs', [DesignController::class, 'store']);
    Route::get('/designs/{design:uuid}', [DesignController::class, 'show']);
    Route::put('designs/{design:uuid}', [DesignController::class, 'update']);
    Route::delete('/designs/{design:uuid}', [DesignController::class, 'destroy']);
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

    // Media
    Route::prefix('{organization:slug}')->group(function() {
        Route::post('/media', [MediaController::class, 'store']);
        Route::delete('media/{media}', [MediaController::class, 'destroy']);
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
        Route::put('sites/{site}', [SiteController::class, 'update']);
        Route::delete('/sites/{site}', [SiteController::class, 'destroy']);

        // Crawl site
        Route::prefix('/sites/{site}')->group(function() {
            Route::get('/crawls', [CrawlController::class, 'index']);
            Route::post('/crawls', [CrawlController::class, 'store']);
            Route::get('/crawls/{crawl}', [CrawlController::class, 'show']);
            Route::delete('/crawls/{crawl}', [CrawlController::class, 'destroy']);
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
