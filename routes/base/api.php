<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use DDD\Http\Base\Auth\AuthLoginController;
use DDD\Http\Base\Auth\AuthLogoutController;
use DDD\Http\Base\Auth\AuthMeController;
use DDD\Http\Base\Auth\AuthRegisterController;
use DDD\Http\Base\Auth\AuthRegisterWithInvitationController;
use DDD\Http\Base\Auth\AuthPasswordForgotController;
use DDD\Http\Base\Auth\AuthPasswordResetController;
use DDD\Http\Base\Categories\CategoryController;
use DDD\Http\Base\Invitations\InvitationController;
use DDD\Http\Base\Media\MediaController;
use DDD\Http\Base\Media\MediaDownloadController;
use DDD\Http\Base\Organizations\OrganizationController;
use DDD\Http\Base\Organizations\OrganizationCommentController;
use DDD\Http\Base\Sites\SiteController;
use DDD\Http\Base\Statuses\StatusController;
use DDD\Http\Base\Subscriptions\Intent\IntentController;
use DDD\Http\Base\Subscriptions\Plans\PlanController;
use DDD\Http\Base\Subscriptions\Plans\PlanSwapAvailabilityController;
use DDD\Http\Base\Subscriptions\Subscriptions\SubscriptionController;
use DDD\Http\Base\Tags\TagController;
use DDD\Http\Base\Teams\TeamController;
use DDD\Http\Base\Users\UserController;

// Public - Auth
Route::post('auth/login', AuthLoginController::class);
Route::post('auth/register', AuthRegisterController::class);
Route::post('auth/register/invitation/{invitation:uuid}', AuthRegisterWithInvitationController::class);
Route::post('auth/password/forgot', AuthPasswordForgotController::class);
Route::post('auth/password/reset', AuthPasswordResetController::class);

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

// Public - Sites
Route::prefix('{organization:slug}/sites')->group(function() {
    Route::get('/{site}', [SiteController::class, 'show']);
});

Route::middleware('auth:sanctum')->group(function() {
    // Auth
    Route::post('auth/logout', AuthLogoutController::class);
    Route::get('auth/me', AuthMeController::class);

    // Subscriptions
    Route::prefix('{organization:slug}/subscriptions')->group(function() {
        Route::get('/intent', IntentController::class);
        Route::get('/plans', [PlanController::class, 'index']);
        Route::get('/plans/availability', PlanSwapAvailabilityController::class);
        Route::post('/subscriptions', [SubscriptionController::class, 'store']);
        Route::patch('/subscriptions', [SubscriptionController::class, 'update']);
    });

    // Categories
    Route::prefix('categories')->group(function() {
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::get('/{category:slug}', [CategoryController::class, 'show']);
        Route::put('/{category:slug}', [CategoryController::class, 'update']);
        Route::delete('/{category:slug}', [CategoryController::class, 'destroy']);
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

    // Sites
    Route::prefix('{organization:slug}/sites')->group(function() {
        Route::get('/', [SiteController::class, 'index']);
        Route::post('/', [SiteController::class, 'store']);
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
