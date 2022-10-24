<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use DDD\Http\Auth\AuthLoginController;
use DDD\Http\Auth\AuthLogoutController;
use DDD\Http\Auth\AuthMeController;
use DDD\Http\Auth\AuthRegisterController;
use DDD\Http\Auth\AuthRegisterWithInvitationController;

use DDD\Http\Users\UserController;

use DDD\Http\Invitations\InvitationController;
use DDD\Http\Designs\DesignController;
use DDD\Http\Designs\DesignMediaController;
use DDD\Http\Designs\DesignDuplicationController;
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

// Public - Auth
Route::post('auth/login', AuthLoginController::class);
// Route::post('auth/register', AuthRegisterController::class);
Route::post('auth/register/invitation/{invitation:uuid}', AuthRegisterWithInvitationController::class);

// Public - Media Download
Route::get('/media/{media:uuid}', [MediaDownloadController::class, 'download']);

// Public - Invitation
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

Route::middleware('auth:sanctum')->group(function() {
    // Auth
    Route::post('auth/logout', AuthLogoutController::class);
    Route::get('auth/me', AuthMeController::class);

    // Users
    Route::prefix('{organization:slug}')->group(function() {
        Route::get('users', [UserController::class, 'index']);
    });

    // Invitations
    Route::prefix('{organization:slug}')->group(function() {
        Route::get('invitations', [InvitationController::class, 'index']);
        Route::post('invitations', [InvitationController::class, 'store']);
        Route::delete('invitations/{invitation:uuid}', [InvitationController::class, 'destroy']);
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
        Route::put('/sites/{site}', [SiteController::class, 'update']);
        Route::delete('/sites/{site}', [SiteController::class, 'destroy']);

        // Crawl site
        Route::prefix('/sites/{site}')->group(function() {
            Route::get('/crawls', [CrawlController::class, 'index']);
            Route::post('/crawls', [CrawlController::class, 'store']);
            Route::get('/crawls/{crawl}', [CrawlController::class, 'show']);
            Route::delete('/crawls/{crawl}', [CrawlController::class, 'destroy']);
        });
    });

    // Public - Designs
    // Route::prefix('{organization:slug}')->group(function() {
    //     Route::post('/designs', [DesignController::class, 'store']);
    //     Route::delete('/designs/{design:uuid}', [DesignController::class, 'destroy']);
    // });

    // Pages
    Route::prefix('/sites/{site}')->group(function() {
        Route::get('/pages', [PageController::class, 'index']);
        Route::post('/pages', [PageController::class, 'store']);
        Route::get('/pages/{page}', [PageController::class, 'show']);
        Route::put('/pages/{page}', [PageController::class, 'update']);
        Route::delete('/pages/{page}', [PageController::class, 'destroy']);

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
