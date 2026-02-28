<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\FreelancerProfile;
use App\Models\Subscription as SubscriptionModel;
use App\Services\Junspro\SubscriptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class FreelancerController extends Controller
{
    public function show($id)
    {
        try {
            $freelancer = FreelancerProfile::with(['user', 'subscriptions'])->findOrFail($id);
            
            if (!$freelancer->user) {
                Log::warning("FreelancerProfile #{$id} n'a pas de user associé");
                abort(404, __('Freelance non trouvé'));
            }

            $user = $freelancer->user;

            // Récupérer les services du freelance (via Seller si existe)
            $services = collect();
            if ($user->seller) {
                $services = \App\Models\ClientService\Service::where('seller_id', $user->seller->id)
                    ->where('service_status', 1)
                    ->with(['content', 'review'])
                    ->limit(6)
                    ->get();
            }

            // Récupérer les avis (reviews) des services du freelance
            $reviews = collect();
            if ($services->isNotEmpty()) {
                $serviceIds = $services->pluck('id');
                $reviews = \App\Models\ClientService\ServiceReview::whereIn('service_id', $serviceIds)
                    ->with(['user', 'service'])
                    ->orderBy('created_at', 'desc')
                    ->limit(10)
                    ->get();
            }

            // Calculer la note moyenne
            $averageRating = $reviews->isNotEmpty() 
                ? $reviews->avg('rating') 
                : ($freelancer->reliability_score / 20); // Convertir reliability_score (0-100) en note (0-5)

            // Pré-calculer les statistiques pour éviter les requêtes répétées dans la vue
            try {
                $subscriptionsCount = $freelancer->subscriptions()->count();
                $activeSubscriptionsCount = $freelancer->subscriptions()->where('status', 'active')->count();
            } catch (\Exception $e) {
                Log::warning("Erreur lors du calcul des statistiques: " . $e->getMessage());
                $subscriptionsCount = 0;
                $activeSubscriptionsCount = 0;
            }
            $reviewsCount = $reviews->count();

            // Récupérer les freelances recommandés (limité à 4 pour les performances)
            try {
                $recommendedFreelancers = FreelancerProfile::where('id', '!=', $freelancer->id)
                    ->whereHas('user')
                    ->with('user')
                    ->limit(4)
                    ->get();
            } catch (\Exception $e) {
                Log::warning("Erreur lors de la récupération des freelances recommandés: " . $e->getMessage());
                $recommendedFreelancers = collect();
            }

            // Disponibilités depuis users.availability
            $availability = $user->availability ?? [];

            // Récupérer les projets récents livrés (work sessions complétées)
            $recentProjects = collect();
            try {
                $recentProjects = \App\Models\WorkSession::whereHas('subscription', function($query) use ($freelancer) {
                        $query->where('freelancer_id', $freelancer->id);
                    })
                    ->where('status', 'completed')
                    ->with(['subscription.client.user'])
                    ->orderBy('end_at', 'desc')
                    ->limit(6)
                    ->get();
            } catch (\Exception $e) {
                Log::warning("Erreur lors de la récupération des projets récents: " . $e->getMessage());
            }

            // Récupérer les créneaux disponibles du freelance (toutes les heures de base)
            // Pour Preply, on génère automatiquement des créneaux de 30 minutes
            $availableSlots = [];
            try {
                $calendarSlots = \App\Models\CalendarSlot::where('freelancer_id', $freelancer->id)
                    ->where('is_available', true)
                    ->get();
                
                // Organiser par jour, heure et minute (0 ou 30)
                foreach ($calendarSlots as $slot) {
                    // Si une heure pleine est disponible, créer deux créneaux de 30 minutes
                    $availableSlots[$slot->weekday][$slot->hour][0] = true; // :00
                    $availableSlots[$slot->weekday][$slot->hour][30] = true; // :30
                }
            } catch (\Exception $e) {
                Log::warning("Erreur lors de la récupération des créneaux: " . $e->getMessage());
            }
            
            // Récupérer les réservations existantes (work_sessions) pour masquer les heures déjà prises
            // On organise par date complète (Y-m-d) et heure pour pouvoir filtrer par semaine côté client
            $bookedSlotsByDate = [];
            try {
                // Récupérer toutes les sessions planifiées non annulées pour ce freelance
                $workSessions = \App\Models\WorkSession::whereHas('subscription', function($query) use ($freelancer) {
                        $query->where('freelancer_id', $freelancer->id);
                    })
                    ->where('status', '!=', 'cancelled')
                    ->whereNotNull('start_at')
                    ->get();
                
                // Organiser par date complète (Y-m-d), heure et minute pour un filtrage précis (comme Preply)
                foreach ($workSessions as $session) {
                    if ($session->start_at) {
                        $dateKey = $session->start_at->format('Y-m-d');
                        $hour = (int) $session->start_at->format('H');
                        $minute = (int) $session->start_at->format('i');
                        // Arrondir à 0 ou 30 pour les créneaux de 30 minutes
                        $slotMinute = $minute < 30 ? 0 : 30;
                        
                        if (!isset($bookedSlotsByDate[$dateKey])) {
                            $bookedSlotsByDate[$dateKey] = [];
                        }
                        if (!isset($bookedSlotsByDate[$dateKey][$hour])) {
                            $bookedSlotsByDate[$dateKey][$hour] = [];
                        }
                        $bookedSlotsByDate[$dateKey][$hour][$slotMinute] = true;
                    }
                }
            } catch (\Exception $e) {
                Log::warning("Erreur lors de la récupération des réservations: " . $e->getMessage());
            }
            
            // Pour l'affichage initial (semaine actuelle), créer aussi la structure par jour de semaine
            $bookedSlots = [];
            $today = \Carbon\Carbon::now();
            $startOfWeek = $today->copy()->startOfWeek(\Carbon\Carbon::MONDAY);
            for ($day = 0; $day < 7; $day++) {
                $dateForDay = $startOfWeek->copy()->addDays($day);
                $dateKey = $dateForDay->format('Y-m-d');
                if (isset($bookedSlotsByDate[$dateKey])) {
                    $bookedSlots[$day] = $bookedSlotsByDate[$dateKey];
                }
            }
            
            // Générer tous les créneaux de 30 minutes disponibles pour l'affichage Preply
            // Format: [weekday][hour][minute] = true
            $allSlotsByTime = [];
            foreach ($availableSlots as $weekday => $hours) {
                foreach ($hours as $hour => $minutes) {
                    foreach ($minutes as $minute => $available) {
                        if ($available) {
                            if (!isset($allSlotsByTime[$hour])) {
                                $allSlotsByTime[$hour] = [];
                            }
                            if (!isset($allSlotsByTime[$hour][$minute])) {
                                $allSlotsByTime[$hour][$minute] = [];
                            }
                            $allSlotsByTime[$hour][$minute][] = $weekday;
                        }
                    }
                }
            }

            // Anti-désintermédiation : coordonnées visibles uniquement après réservation confirmée + paiement
            $canViewContactInfo = false;
            $authUser = Auth::guard('web')->user();
            if ($authUser) {
                $clientProfile = \App\Models\ClientProfile::where('user_id', $authUser->id)->first();
                if ($clientProfile) {
                    $canViewContactInfo = \App\Models\Subscription::where('client_id', $clientProfile->id)
                        ->where('freelancer_id', $freelancer->id)
                        ->where('status', 'active')
                        ->exists();
                }
            }

            // Utiliser la vue profil classique organisée (version stable)
            return view('frontend.freelance.show', [
                'freelancer' => $freelancer,
                'user' => $user,
                'services' => $services,
                'reviews' => $reviews,
                'averageRating' => round($averageRating, 1),
                'availability' => $availability,
                'subscriptionsCount' => $subscriptionsCount,
                'activeSubscriptionsCount' => $activeSubscriptionsCount,
                'reviewsCount' => $reviewsCount,
                'recommendedFreelancers' => $recommendedFreelancers,
                'recentProjects' => $recentProjects,
                'availableSlots' => $availableSlots, // Créneaux disponibles par jour/heure/minute (CalendarSlot)
                'bookedSlots' => $bookedSlots, // Créneaux déjà réservés pour la semaine actuelle (WorkSession)
                'bookedSlotsByDate' => $bookedSlotsByDate, // Toutes les réservations par date/heure/minute (pour JS)
                'allSlotsByTime' => $allSlotsByTime, // Tous les créneaux organisés par heure/minute pour affichage
                'canViewContactInfo' => $canViewContactInfo, // Anti-désintermédiation : coordonnées débloquées après réservation
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning("FreelancerProfile #{$id} introuvable");
            abort(404, __('Freelance non trouvé'));
        } catch (\Exception $e) {
            Log::error("Erreur dans FreelancerController@show pour ID {$id}: " . $e->getMessage());
            abort(404, __('Erreur lors du chargement du profil freelance'));
        }
    }

    public function booking($id)
    {
        try {
            $freelancer = FreelancerProfile::with(['user', 'subscriptions'])->findOrFail($id);
            
            if (!$freelancer->user) {
                Log::warning("FreelancerProfile #{$id} n'a pas de user associé");
                abort(404, __('Freelance non trouvé'));
            }

            $user = $freelancer->user;

            // Récupérer les créneaux disponibles du freelance (toutes les heures de base)
            // Pour Preply, on génère automatiquement des créneaux de 30 minutes
            $availableSlots = [];
            try {
                if (class_exists(\App\Models\CalendarSlot::class)) {
                    $calendarSlots = \App\Models\CalendarSlot::where('freelancer_id', $freelancer->id)
                        ->where('is_available', true)
                        ->get();
                    
                    // Organiser par jour, heure et minute (0 ou 30)
                    foreach ($calendarSlots as $slot) {
                        if (isset($slot->weekday) && isset($slot->hour)) {
                            // Si une heure pleine est disponible, créer deux créneaux de 30 minutes
                            if (!isset($availableSlots[$slot->weekday])) {
                                $availableSlots[$slot->weekday] = [];
                            }
                            if (!isset($availableSlots[$slot->weekday][$slot->hour])) {
                                $availableSlots[$slot->weekday][$slot->hour] = [];
                            }
                            $availableSlots[$slot->weekday][$slot->hour][0] = true; // :00
                            $availableSlots[$slot->weekday][$slot->hour][30] = true; // :30
                        }
                    }
                }
            } catch (\Exception $e) {
                Log::warning("Erreur lors de la récupération des créneaux", [
                    'freelancer_id' => $freelancer->id,
                    'error' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]);
            }
            
            // Récupérer les réservations existantes (work_sessions) pour masquer les heures déjà prises
            $bookedSlotsByDate = [];
            try {
                // Utiliser une requête plus simple pour éviter les problèmes de relation
                $workSessions = \App\Models\WorkSession::with('subscription')
                    ->whereHas('subscription', function($query) use ($freelancer) {
                        $query->where('freelancer_id', $freelancer->id);
                    })
                    ->where('status', '!=', 'cancelled')
                    ->whereNotNull('start_at')
                    ->get();
                
                // Organiser par date complète (Y-m-d), heure et minute pour un filtrage précis (comme Preply)
                foreach ($workSessions as $session) {
                    if ($session->start_at) {
                        // Gérer le cas où start_at est une string ou un Carbon
                        $startAt = $session->start_at;
                        if (is_string($startAt)) {
                            $startAt = \Carbon\Carbon::parse($startAt);
                        }
                        
                        if ($startAt instanceof \Carbon\Carbon) {
                            $dateKey = $startAt->format('Y-m-d');
                            $hour = (int) $startAt->format('H');
                            $minute = (int) $startAt->format('i');
                            // Arrondir à 0 ou 30 pour les créneaux de 30 minutes
                            $slotMinute = $minute < 30 ? 0 : 30;
                            
                            if (!isset($bookedSlotsByDate[$dateKey])) {
                                $bookedSlotsByDate[$dateKey] = [];
                            }
                            if (!isset($bookedSlotsByDate[$dateKey][$hour])) {
                                $bookedSlotsByDate[$dateKey][$hour] = [];
                            }
                            $bookedSlotsByDate[$dateKey][$hour][$slotMinute] = true;
                        }
                    }
                }
            } catch (\Exception $e) {
                Log::warning("Erreur lors de la récupération des réservations", [
                    'freelancer_id' => $freelancer->id,
                    'error' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString(),
                ]);
            }

            // Détecter l'univers depuis l'URL ou le service du freelance
            $universeType = 'lessons'; // Par défaut
            try {
                $referer = request()->headers->get('referer');
                if ($referer) {
                    if (strpos($referer, '/services/projects') !== false) {
                        $universeType = 'projects';
                    } elseif (strpos($referer, '/services/homeswap') !== false) {
                        $universeType = 'homeswap';
                    } elseif (strpos($referer, '/services/wellnesslive') !== false) {
                        $universeType = 'wellnesslive';
                    } elseif (strpos($referer, '/services/at-home') !== false) {
                        $universeType = 'at-home';
                    } elseif (strpos($referer, '/services/corporate') !== false) {
                        $universeType = 'corporate';
                    }
                }
            } catch (\Exception $e) {
                Log::warning("Erreur lors de la détection de l'univers: " . $e->getMessage());
            }

            return view('frontend.freelance.booking', [
                'freelancer' => $freelancer,
                'user' => $user,
                'availableSlots' => $availableSlots,
                'bookedSlotsByDate' => $bookedSlotsByDate,
                'universeType' => $universeType,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error("FreelancerProfile #{$id} introuvable", [
                'error' => $e->getMessage(),
            ]);
            abort(404, __('Freelance non trouvé'));
        } catch (\Exception $e) {
            Log::error("Erreur dans FreelancerController@booking pour ID {$id}", [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            // En mode debug, afficher l'erreur détaillée
            if (config('app.debug')) {
                throw $e;
            }
            
            abort(500, __('Erreur lors du chargement de la page de réservation'));
        }
    }

    public function bookSlots(Request $request, SubscriptionService $subscriptionService, $id)
    {
        $request->validate([
            'slots' => 'required|array|min:1',
            'slots.*.day' => 'required|integer|min:0|max:6',
            'slots.*.hour' => 'required|integer|min:0|max:23',
            'slots.*.minute' => 'required|integer|in:0,30',
            'duration' => 'nullable|integer|in:30,50,60',
            'booking_type' => 'nullable|string|in:weekly,onetime',
            'week_offset' => 'nullable|integer',
        ]);

        $freelancer = FreelancerProfile::with('user')->findOrFail($id);
        $clientUser = Auth::guard('web')->user();
        $clientProfile = $clientUser?->clientProfile;

        if (!$clientProfile) {
            return response()->json([
                'success' => false,
                'message' => __('Vous devez être connecté en tant que client.'),
            ], 403);
        }

        try {
            // Vérifier que le freelance a un tarif horaire défini
            if (!$freelancer->hourly_rate || $freelancer->hourly_rate <= 0) {
                Log::error('Freelancer sans tarif horaire', [
                    'freelancer_id' => $freelancer->id,
                    'hourly_rate' => $freelancer->hourly_rate
                ]);
                return response()->json([
                    'success' => false,
                    'message' => __('Le freelance n\'a pas de tarif horaire défini. Veuillez contacter le support.'),
                ], 400);
            }

            // Vérifier si une subscription existe déjà pour cette combinaison client/freelance
            $subscription = SubscriptionModel::where('client_id', $clientProfile->id)
                ->where('freelancer_id', $freelancer->id)
                ->where('status', '!=', 'cancelled')
                ->first();

            // Si pas de subscription, créer une séance d'essai (1h)
            if (!$subscription) {
                try {
                    $subscription = $subscriptionService->createSubscription(
                        $clientProfile,
                        $freelancer,
                        1, // 1h d'essai
                        'standard',
                        null // Pas de Stripe pour l'essai
                    );
                } catch (\Exception $e) {
                    Log::error('Erreur création subscription essai', [
                        'client_id' => $clientProfile->id,
                        'freelancer_id' => $freelancer->id,
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                    return response()->json([
                        'success' => false,
                        'message' => __('Erreur lors de la création de l\'abonnement d\'essai: :error', ['error' => $e->getMessage()]),
                    ], 500);
                }
            }

            // Calculer les dates exactes pour chaque créneau
            // Utiliser la semaine actuelle (semaine 0 = cette semaine)
            $today = \Carbon\Carbon::now();
            $startOfWeek = $today->copy()->startOfWeek(\Carbon\Carbon::MONDAY);
            
            // Si on a un offset de semaine dans la requête, l'utiliser
            $weekOffset = $request->week_offset ?? 0;
            if ($weekOffset != 0) {
                $startOfWeek->addWeeks($weekOffset);
            }
            
            $duration = $request->duration ?? 50; // Durée par défaut 50 minutes
            $bookingType = $request->booking_type ?? 'onetime';
            
            $workSessions = [];
            $errors = [];

            foreach ($request->slots as $slot) {
                try {
                    // Calculer la date exacte pour ce créneau
                    $slotDate = $startOfWeek->copy()->addDays($slot['day']);
                    $slotDate->setTime($slot['hour'], $slot['minute'], 0);
                    
                    // Vérifier que la date est dans le futur
                    if ($slotDate->isPast()) {
                        $errors[] = __('Le créneau :time du :day est dans le passé', [
                            'time' => $slotDate->format('H:i'),
                            'day' => $slotDate->format('d/m/Y')
                        ]);
                        continue;
                    }

                    // Vérifier si le créneau n'est pas déjà réservé
                    $existingSession = \App\Models\WorkSession::whereHas('subscription', function($query) use ($freelancer) {
                            $query->where('freelancer_id', $freelancer->id);
                        })
                        ->where('start_at', $slotDate->format('Y-m-d H:i:s'))
                        ->where('status', '!=', 'cancelled')
                        ->first();

                    if ($existingSession) {
                        $errors[] = __('Le créneau :time du :day est déjà réservé', [
                            'time' => $slotDate->format('H:i'),
                            'day' => $slotDate->format('d/m/Y')
                        ]);
                        continue;
                    }

                    // Créer la WorkSession
                    $endAt = $slotDate->copy()->addMinutes($duration);
                    
                    $workSession = \App\Models\WorkSession::create([
                        'subscription_id' => $subscription->id,
                        'start_at' => $slotDate,
                        'end_at' => $endAt,
                        'duration_minutes' => $duration,
                        'is_meeting' => false,
                        'delivery_speed' => 'standard',
                        'deadline_at' => null,
                        'status' => 'scheduled',
                    ]);

                    $workSessions[] = $workSession;
                } catch (\Exception $e) {
                    Log::error('Erreur création WorkSession', [
                        'message' => $e->getMessage(),
                        'file' => $e->getFile(),
                        'line' => $e->getLine(),
                        'slot' => $slot,
                        'subscription_id' => $subscription->id ?? null,
                        'trace' => $e->getTraceAsString()
                    ]);
                    $errors[] = __('Erreur lors de la création du créneau :time', [
                        'time' => ($slot['hour'] ?? '?') . ':' . str_pad($slot['minute'] ?? 0, 2, '0', STR_PAD_LEFT)
                    ]);
                }
            }

            if (empty($workSessions)) {
                return response()->json([
                    'success' => false,
                    'message' => __('Aucun créneau n\'a pu être réservé.') . (!empty($errors) ? ' ' . implode(' ', $errors) : ''),
                ], 400);
            }

            $message = count($workSessions) === 1 
                ? __('Votre Rituel a été programmé avec succès.')
                : __('Vos :count Rituels ont été programmés avec succès.', ['count' => count($workSessions)]);

            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => [
                    'work_sessions' => $workSessions,
                    'subscription_id' => $subscription->id,
                ],
                'errors' => $errors, // Afficher les erreurs s'il y en a
            ], 201);

        } catch (\Exception $e) {
            Log::error('Erreur dans bookSlots', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'client_id' => $clientProfile->id ?? null,
                'freelancer_id' => $freelancer->id ?? null,
            ]);
            return response()->json([
                'success' => false,
                'message' => __('Une erreur est survenue lors de la réservation. Veuillez réessayer.'),
                'debug' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }

    public function startTrial(Request $request, SubscriptionService $subscriptionService, $id)
    {
        $freelancer = FreelancerProfile::with('user')->findOrFail($id);

        $clientUser = Auth::guard('web')->user();
        $clientProfile = $clientUser?->clientProfile;

        if (!$clientProfile) {
            return redirect()->route('user.login')->with('warning', __('Vous devez être connecté en tant que client.'));
        }

        // 1h d’essai, mode standard, sans Stripe pour l’instant (mock)
        $subscriptionService->createSubscription(
            $clientProfile,
            $freelancer,
            1,
            'standard',
            null
        );

        return redirect()->back()->with('success', __('Votre Rituel d\'essai a été créé. Nous vous recontactons pour le kick-off.'));
    }

    public function subscribe(Request $request, SubscriptionService $subscriptionService, $id)
    {
        $request->validate([
            'weekly_hours' => 'required|in:1,2,4,8,12,16,20,24',
            'delivery_mode' => 'required|in:standard,express_24h,express_48h,express_72h',
        ]);

        $freelancer = FreelancerProfile::with('user')->findOrFail($id);
        $clientUser = Auth::guard('web')->user();
        $clientProfile = $clientUser?->clientProfile;

        if (!$clientProfile) {
            return redirect()->route('user.login')->with('warning', __('Vous devez être connecté en tant que client.'));
        }

        // Calculer le prix
        $hoursTotalMonth = $request->weekly_hours * 4;
        $priceBase = $freelancer->hourly_rate * $request->weekly_hours * 4;
        $finalPrice = $subscriptionService->calculateFinalPrice($priceBase, $request->delivery_mode);

        // Créer une session Stripe Checkout
        try {
            $checkoutSession = $subscriptionService->createStripeCheckoutSession(
                $clientProfile,
                $freelancer,
                $request->weekly_hours,
                $request->delivery_mode,
                $finalPrice
            );

            // Rediriger vers Stripe Checkout
            return redirect($checkoutSession->url);
        } catch (\Exception $e) {
            Log::error('Erreur création session Stripe: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', __('Erreur lors de la création de la session de paiement. Veuillez réessayer.'));
        }
    }

    public function stripeSuccess(Request $request, SubscriptionService $subscriptionService)
    {
        $sessionId = $request->query('session_id');
        
        if (!$sessionId) {
            return redirect()->route('user.dashboard')
                ->with('error', __('Session de paiement invalide.'));
        }

        try {
            // Récupérer les données de l'abonnement depuis la session
            $pendingSubscription = session('pending_subscription');
            
            if (!$pendingSubscription) {
                return redirect()->route('user.dashboard')
                    ->with('error', __('Données d\'abonnement introuvables.'));
            }

            // Récupérer la session Stripe pour obtenir le subscription_id
            $stripeSecret = $this->getStripeSecret();
            \Stripe\Stripe::setApiKey($stripeSecret);
            $stripeSession = \Stripe\Checkout\Session::retrieve($sessionId);
            
            $stripeSubscriptionId = $stripeSession->subscription;

            // Récupérer les profils
            $clientProfile = \App\Models\ClientProfile::findOrFail($pendingSubscription['client_id']);
            $freelancer = FreelancerProfile::findOrFail($pendingSubscription['freelancer_id']);

            // Créer l'abonnement avec le stripe_subscription_id
            $subscription = $subscriptionService->createSubscription(
                $clientProfile,
                $freelancer,
                $pendingSubscription['hours_per_week'],
                $pendingSubscription['delivery_mode'],
                $stripeSubscriptionId
            );

            // Nettoyer la session
            session()->forget(['pending_subscription', 'stripe_checkout_session_id']);

            return redirect()->route('client.subscriptions.show', $subscription->id)
                ->with('success', __('Votre abonnement a été créé avec succès. Un kick-off visio sera programmé avant les premières livraisons.'));
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création de l\'abonnement après paiement Stripe: ' . $e->getMessage());
            return redirect()->route('user.dashboard')
                ->with('error', __('Erreur lors de la création de l\'abonnement. Veuillez contacter le support.'));
        }
    }

    public function stripeCancel()
    {
        // Nettoyer la session
        session()->forget(['pending_subscription', 'stripe_checkout_session_id']);

        return redirect()->route('user.dashboard')
            ->with('info', __('Le paiement a été annulé. Vous pouvez réessayer à tout moment.'));
    }

    protected function getStripeSecret(): string
    {
        $stripe = \App\Models\PaymentGateway\OnlineGateway::where('keyword', 'stripe')->first();
        
        if (!$stripe) {
            throw new \RuntimeException('Stripe n\'est pas configuré');
        }

        $stripeConf = is_array($stripe->information) 
            ? $stripe->information 
            : json_decode($stripe->information, true);

        if (!isset($stripeConf['secret'])) {
            throw new \RuntimeException('Clé secrète Stripe non trouvée');
        }

        return $stripeConf['secret'];
    }
}




