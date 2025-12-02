<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route pour vérifier l'abonnement de l'utilisateur
Route::get('/me/subscription', function (Request $request) {
    $user = $request->user('web');
    
    // Si l'utilisateur n'est pas authentifié, retourner false
    if (!$user) {
        return response()->json([
            'isPremium' => false
        ]);
    }
    
    // Vérifier si l'utilisateur a un abonnement actif
    $hasActiveSubscription = false;
    
    if ($user->clientProfile) {
        $hasActiveSubscription = \App\Models\Subscription::where('client_id', $user->clientProfile->id)
            ->where('status', 'active')
            ->exists();
    }
    
    if (!$hasActiveSubscription && $user->freelancerProfile) {
        $hasActiveSubscription = \App\Models\Subscription::where('freelancer_id', $user->freelancerProfile->id)
            ->where('status', 'active')
            ->exists();
    }
    
    return response()->json([
        'isPremium' => $hasActiveSubscription
    ]);
});
