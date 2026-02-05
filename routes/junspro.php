<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Junspro\SubscriptionController;
use App\Http\Controllers\Junspro\WorkSessionController;
use App\Http\Controllers\Junspro\MatchDirectController;
use App\Http\Controllers\Junspro\PaymentIntentController;

/*
|--------------------------------------------------------------------------
| Junspro V2 API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('junspro/v2')->middleware(['auth:sanctum'])->group(function () {
    
    // Abonnements
    Route::prefix('subscriptions')->group(function () {
        Route::get('/', [SubscriptionController::class, 'index']);
        Route::post('/', [SubscriptionController::class, 'store']);
        Route::get('/{id}', [SubscriptionController::class, 'show']);
        Route::post('/{id}/pause', [SubscriptionController::class, 'pause']);
        Route::post('/{id}/resume', [SubscriptionController::class, 'resume']);
        Route::post('/{id}/cancel', [SubscriptionController::class, 'cancel']);
    });

    // Sessions de travail
    Route::prefix('work-sessions')->group(function () {
        Route::get('/', [WorkSessionController::class, 'index']);
        Route::post('/', [WorkSessionController::class, 'store']);
        Route::post('/{id}/complete', [WorkSessionController::class, 'complete']);
        Route::post('/{id}/rebook', [WorkSessionController::class, 'rebook']);
    });

    // MatchDirect™
    Route::prefix('matchdirect')->group(function () {
        Route::post('/find', [MatchDirectController::class, 'find']);
    });

    // PaymentIntents Stripe Connect
    Route::prefix('payment-intents')->group(function () {
        Route::post('/', [PaymentIntentController::class, 'store']);
        Route::get('/{payment_intent_id}', [PaymentIntentController::class, 'show']);
    });
});

