<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use DDD\Http\Auth\AuthLoginController;
use DDD\Http\Auth\AuthLogoutController;
use DDD\Http\Auth\AuthMeController;
use DDD\Http\Auth\AuthRegisterController;
use DDD\Http\Auth\AuthRegisterWithInvitationController;
use DDD\Http\Categories\CategoryController;
use DDD\Http\Crawls\CrawlController;
use DDD\Http\Crawls\CrawlImportResultsController;
use DDD\Http\Crawls\CrawlResultsController;
use DDD\Http\Designs\DesignController;
use DDD\Http\Designs\DesignMediaController;
use DDD\Http\Designs\DesignDuplicationController;
use DDD\Http\Invitations\InvitationController;
use DDD\Http\Media\MediaController;
use DDD\Http\Media\MediaDownloadController;
use DDD\Http\Organizations\OrganizationController;
use DDD\Http\Organizations\OrganizationCommentController;
use DDD\Http\Pages\PageController;
// use DDD\Http\Pages\PageTagController;
use DDD\Http\Sites\SiteController;
use DDD\Http\Statuses\StatusController;
use DDD\Http\Tags\TagController;
use DDD\Http\Teams\TeamController;
use DDD\Http\Users\UserController;

// TODO: Alphabetize routes

// Public - Auth
Route::post('auth/login', AuthLoginController::class);
Route::post('auth/register', AuthRegisterController::class);
Route::post('auth/register/invitation/{invitation:uuid}', AuthRegisterWithInvitationController::class);

// Public - Designs
Route::prefix('{organization:slug}')->group(function() {
    Route::get('/designs', [DesignController::class, 'index']);
    Route::post('/designs', [DesignController::class, 'store']);
    Route::get('/designs/{design:uuid}', [DesignController::class, 'show']);
    Route::put('designs/{design:uuid}', [DesignController::class, 'update']);
    Route::delete('/designs/{design:uuid}', [DesignController::class, 'destroy']);
    Route::delete('/designs/{design:uuid}', [DesignController::class, 'destroy']);

    // Public - Duplicate design
    Route::prefix('/designs/{design:uuid}')->group(function() {
        Route::post('/duplicate', [DesignDuplicationController::class, 'duplicate']);
    });

    // Public - Design media
    Route::prefix('/designs/{design:uuid}')->group(function() {
        Route::post('/media', [DesignMediaController::class, 'store']);
    });
});

// Public - Invitations
Route::get('{organization:slug}/invitations/{invitation:uuid}', [InvitationController::class, 'show']);

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

Route::middleware('auth:sanctum')->group(function() {
    // Auth
    Route::post('auth/logout', AuthLogoutController::class);
    Route::get('auth/me', AuthMeController::class);

    // Categories
    Route::prefix('categories')->group(function() {
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::get('/{category}', [CategoryController::class, 'show']);
        Route::put('/{category}', [CategoryController::class, 'update']);
        Route::delete('/{category}', [CategoryController::class, 'destroy']);
    });

    // Crawls
    Route::prefix('{organization:slug}/crawls')->group(function() {
        Route::get('/', [CrawlController::class, 'index']);
        Route::post('/', [CrawlController::class, 'store']);
        Route::get('/{crawl}', [CrawlController::class, 'show']);
        Route::delete('/{crawl}', [CrawlController::class, 'destroy']);

        // Crawl results
        Route::prefix('/{crawl}')->group(function() {
            Route::get('/results', [CrawlResultsController::class, 'show']);
        });

        // Import crawl results
        Route::prefix('/{crawl}')->group(function() {
            Route::get('/import', [CrawlImportResultsController::class, 'import']);
        });
    });

    // Invitations
    Route::prefix('{organization:slug}')->group(function() {
        Route::get('invitations', [InvitationController::class, 'index']);
        Route::post('invitations', [InvitationController::class, 'store']);
        Route::delete('invitations/{invitation:uuid}', [InvitationController::class, 'destroy']);
    });

    // Media
    Route::prefix('{organization:slug}')->group(function() {
        Route::post('/media', [MediaController::class, 'store']);
        Route::delete('media/{media}', [MediaController::class, 'destroy']);
    });

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

    // Pages
    Route::prefix('{organization:slug}/pages')->group(function() {
        Route::get('/', [PageController::class, 'index']);
        Route::post('/', [PageController::class, 'store']);
        Route::get('/{page}', [PageController::class, 'show']);
        Route::put('/', [PageController::class, 'update']);
        Route::post('/destroy', [PageController::class, 'destroy']);

        // Tagging
        // route::post('/pages/{page}/tag', [PageTagController::class, 'tag']);
        // route::post('/pages/{page}/untag', [PageTagController::class, 'untag']);
        // route::post('/pages/{page}/retag', [PageTagController::class, 'retag']);
    });

    // Sites
    Route::prefix('{organization:slug}/sites')->group(function() {
        Route::get('/', [SiteController::class, 'index']);
        Route::post('/', [SiteController::class, 'store']);
        Route::get('/{site}', [SiteController::class, 'show']);
        Route::put('/{site}', [SiteController::class, 'update']);
        Route::delete('/{site}', [SiteController::class, 'destroy']);
    });

    // Statuses
    Route::prefix('statuses')->group(function() {
        Route::get('/', [StatusController::class, 'index']);
        Route::post('/', [StatusController::class, 'store']);
        Route::get('/{status}', [StatusController::class, 'show']);
        Route::put('/{status}', [StatusController::class, 'update']);
        Route::delete('/{status}', [StatusController::class, 'destroy']);
    });

    // Tags
    Route::prefix('tags')->group(function() {
        Route::get('/', [TagController::class, 'index']);
        Route::post('/', [TagController::class, 'store']);
        Route::get('/{tag:slug}', [TagController::class, 'show']);
        Route::put('/{tag:slug}', [TagController::class, 'update']);
        Route::delete('/{tag:slug}', [TagController::class, 'destroy']);
    });

    // Teams
    Route::prefix('{organization:slug}')->group(function() {
        Route::get('/teams', [TeamController::class, 'index']);
        Route::post('/teams', [TeamController::class, 'store']);
        Route::get('/teams/{team:slug}', [TeamController::class, 'show']);
        Route::put('teams/{team:slug}', [TeamController::class, 'update']);
        Route::delete('/teams/{team:slug}', [TeamController::class, 'destroy']);
    });

    // Users
    Route::prefix('{organization:slug}')->group(function() {
        Route::get('users', [UserController::class, 'index']);
    });
});
