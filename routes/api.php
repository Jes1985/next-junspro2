<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Webhooks\StripeConnectWebhookController;
use App\Http\Controllers\API\AIController;
use App\Http\Controllers\API\MentorshipController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});

// Webhook Stripe Connect (paiements abonnements)
Route::post('/webhooks/stripe-connect', StripeConnectWebhookController::class)->name('webhooks.stripe-connect');

// Route pour vérifier l'abonnement de l'utilisateur
// Retourne toujours false pour éviter les erreurs
// Désactive complètement le throttling pour cette route
Route::get('/me/subscription', function (Request $request) {
    try {
        return response()->json([
            'isPremium' => false
        ], 200, [
            'Content-Type' => 'application/json',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'isPremium' => false,
            'error' => 'Service temporarily unavailable'
        ], 200);
    }
})->middleware([])->withoutMiddleware(['throttle', 'api']);

// ── Routes IA (chatbot + résumés) ─────────────────────────────
Route::post('/ai/chat',              [AIController::class, 'chat'])->middleware('throttle:30,1');
Route::post('/ai/client-summary',    [AIController::class, 'clientSummary'])->middleware(['auth:web', 'throttle:10,1']);
Route::post('/ai/freelance-summary', [AIController::class, 'freelanceSummary'])->middleware(['auth:web', 'throttle:10,1']);

// ── Routes Mentorat (freelance -> stagiaires) ─────────────────────────────
Route::prefix('/mentorship')->middleware(['auth:web', 'throttle:40,1'])->group(function () {
    Route::get('/pods', [MentorshipController::class, 'pods']);
    Route::post('/pods', [MentorshipController::class, 'createPod']);
    Route::post('/pods/{pod}/apply', [MentorshipController::class, 'applyToPod']);
    Route::post('/pods/{pod}/accept/{trainee}', [MentorshipController::class, 'acceptMembership']);

    Route::post('/missions', [MentorshipController::class, 'createMission']);
    Route::post('/milestones/{milestone}/submit', [MentorshipController::class, 'submitMilestone']);
    Route::post('/submissions/{submission}/review', [MentorshipController::class, 'reviewSubmission']);
    Route::post('/checkins', [MentorshipController::class, 'storeCheckin']);

    Route::get('/trainees/{trainee}/passport', [MentorshipController::class, 'traineePassport']);

    Route::get('/dashboard/mentor', [MentorshipController::class, 'mentorDashboard']);
    Route::get('/dashboard/trainee', [MentorshipController::class, 'traineeDashboard']);
});
