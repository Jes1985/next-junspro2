<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontEnd\MiscellaneousController;
use App\Models\PauseSouffleIntake;
use App\Models\ClientProfile;
use App\Services\StripeService;
use App\Services\Junspro\SubscriptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Price;

class PauseSouffleController extends Controller
{
    protected $miscController;
    protected $stripeService;
    protected $subscriptionService;

    public function __construct(
        MiscellaneousController $miscController,
        StripeService $stripeService,
        SubscriptionService $subscriptionService
    ) {
        $this->miscController = $miscController;
        $this->stripeService = $stripeService;
        $this->subscriptionService = $subscriptionService;
    }

    /**
     * Afficher la page Pause Souffle
     */
    public function index()
    {
        $misc = $this->miscController;
        $language = $misc->getLanguage();
        $queryResult = [
            'breadcrumb' => $misc->getBreadcrumb(),
            'language' => $language,
        ];

        return view('frontend.presence.pause-souffle', $queryResult);
    }

    /**
     * Traiter la soumission du formulaire d'intake et créer la session Stripe
     */
    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'energy' => 'required|integer|min:0|max:10',
            'clarity' => 'required|integer|min:0|max:10',
            'tension' => 'required|integer|min:0|max:10',
            'situation' => 'required|string|in:dirigeant,salarie,parent,freelance,etudiant,transition',
            'rythme' => 'required|in:1-session,4-semaines,3-mois',
            'protect' => 'required|array|min:1',
            'protect.*' => 'in:temps,sante,famille,foi,projet,equilibre',
            'preferences' => 'nullable|array',
            'preferences.*' => 'in:douce,structuree,spirituel',
            'construire' => 'nullable|string|max:2000',
            'consentement' => 'required|accepted',
        ], [
            'energy.required' => 'Veuillez indiquer votre niveau d\'énergie.',
            'clarity.required' => 'Veuillez indiquer votre niveau de clarté.',
            'tension.required' => 'Veuillez indiquer votre niveau de tension.',
            'situation.required' => 'Veuillez sélectionner une situation.',
            'situation.in' => 'Situation invalide.',
            'rythme.required' => 'Veuillez sélectionner un rythme.',
            'rythme.in' => 'Rythme invalide.',
            'protect.required' => 'Veuillez sélectionner au moins un élément à protéger.',
            'protect.min' => 'Veuillez sélectionner au moins un élément à protéger.',
            'consentement.required' => 'Vous devez accepter les conditions pour continuer.',
            'consentement.accepted' => 'Vous devez accepter les conditions pour continuer.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Essai obligatoire uniquement
        $planKey = 'trial';
        
        // Vérifier la configuration Stripe avant de continuer
        $stripeSecret = config('services.stripe.secret');
        if (!$stripeSecret) {
            Log::error('Stripe secret key non configuré', ['config_key' => 'services.stripe.secret']);
            return back()->withErrors(['error' => 'Configuration de paiement invalide. Veuillez contacter le support.'])->withInput();
        }
        
        $priceId = config("pause_souffle.stripe_prices.{$planKey}");
        if (!$priceId) {
            Log::error('Stripe price ID non configuré pour essai', [
                'plan_key' => $planKey,
                'env_var' => 'PAUSE_SOUFFLE_PRICE_TRIAL',
                'config_path' => 'pause_souffle.stripe_prices.trial'
            ]);
            return back()->withErrors(['error' => 'Configuration de paiement invalide. Le prix d\'essai n\'est pas configuré. Veuillez contacter le support.'])->withInput();
        }

        // Récupérer l'utilisateur connecté ou null
        $user = Auth::user();

        // Anti-doublon : vérifier si un intake pending_payment existe déjà pour cet utilisateur
        $existingIntake = null;
        if ($user) {
            $existingIntake = PauseSouffleIntake::where('user_id', $user->id)
                ->where('status', 'pending_payment')
                ->where('plan_key', 'trial')
                ->first();
        }

        // Réutiliser l'intake existant ou en créer un nouveau
        if ($existingIntake) {
            $intake = $existingIntake;
            Log::info('Réutilisation intake existant', ['intake_id' => $intake->id]);
        } else {
            $intake = PauseSouffleIntake::create([
                'user_id' => $user?->id,
                'email' => $user?->email_address ?? $request->email ?? null,
                'first_name' => $user?->first_name ?? $request->first_name ?? null,
                'last_name' => $user?->last_name ?? $request->last_name ?? null,
                'energy' => $request->energy,
                'clarity' => $request->clarity,
                'tension' => $request->tension,
                'situation' => $request->situation, // String unique depuis radio button
                'rythme' => $request->rythme ?? '1-session',
                'protect' => $request->protect,
                'preference' => !empty($request->preferences) ? $request->preferences[0] : null, // Prendre la première valeur (enum ne supporte qu'une valeur)
                'plan_key' => $planKey,
                'stripe_price_id' => $priceId,
                'status' => 'pending_payment',
                'metadata' => [
                    'submitted_at' => now()->toIso8601String(),
                    'construire' => $request->construire ?? null,
                    'preferences' => $request->preferences ?? [], // Stocker toutes les préférences dans metadata
                ],
            ]);
        }

        try {
            // Vérifier que StripeService est correctement configuré
            if (!$this->stripeService) {
                Log::error('StripeService non initialisé');
                return back()->withErrors(['error' => 'Service de paiement non disponible. Veuillez contacter le support.'])->withInput();
            }

            // Si une session existe déjà et est valide, la réutiliser
            if ($intake->stripe_checkout_session_id) {
                try {
                    $stripeSecret = config('services.stripe.secret');
                    if (!$stripeSecret) {
                        throw new \Exception('Stripe secret key non configuré');
                    }
                    \Stripe\Stripe::setApiKey($stripeSecret);
                    $existingSession = \Stripe\Checkout\Session::retrieve($intake->stripe_checkout_session_id);
                    
                    // Si la session est toujours valide (non expirée, non payée)
                    if ($existingSession->status === 'open') {
                        Log::info('Réutilisation session Stripe existante', ['session_id' => $existingSession->id]);
                        return redirect($existingSession->url);
                    }
                } catch (\Stripe\Exception\InvalidRequestException $e) {
                    // Session invalide ou introuvable, on en crée une nouvelle
                    Log::info('Session Stripe invalide, création nouvelle session', [
                        'session_id' => $intake->stripe_checkout_session_id,
                        'error' => $e->getMessage()
                    ]);
                } catch (\Exception $e) {
                    Log::warning('Erreur lors de la récupération de la session Stripe', [
                        'error' => $e->getMessage(),
                        'file' => $e->getFile(),
                        'line' => $e->getLine()
                    ]);
                }
            }

            // Créer la session Stripe Checkout pour l'essai uniquement
            $session = $this->stripeService->createPauseSouffleCheckoutSession(
                $planKey,
                $intake->id,
                $intake->email
            );

            // Mettre à jour l'intake avec le session_id
            $intake->update([
                'stripe_checkout_session_id' => $session->id,
            ]);

            // Rediriger vers Stripe Checkout
            return redirect($session->url);

        } catch (\Stripe\Exception\InvalidRequestException $e) {
            Log::error('Erreur Stripe API lors de la création de la session', [
                'intake_id' => $intake->id,
                'stripe_error' => $e->getStripeCode(),
                'error' => $e->getMessage(),
                'plan_key' => $planKey,
                'price_id' => $priceId,
            ]);

            $errorMessage = 'Erreur lors de la création de la session de paiement. ';
            if (strpos($e->getMessage(), 'No such price') !== false) {
                $errorMessage .= 'Le prix configuré n\'existe pas dans Stripe. Veuillez contacter le support.';
            } else {
                $errorMessage .= 'Veuillez réessayer.';
            }

            return back()->withErrors(['error' => $errorMessage])->withInput();
        } catch (\Exception $e) {
            Log::error('Erreur création session Stripe Pause Souffle', [
                'intake_id' => $intake->id,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            $errorMessage = 'Une erreur est survenue lors de la création de la session de paiement. ';
            if (strpos($e->getMessage(), 'price ID non configuré') !== false) {
                $errorMessage .= 'Configuration de paiement manquante. Veuillez contacter le support.';
            } else {
                $errorMessage .= 'Veuillez réessayer.';
            }

            return back()->withErrors(['error' => $errorMessage])->withInput();
        }
    }

    /**
     * Page de succès après paiement Stripe (essai)
     */
    public function stripeSuccess(Request $request)
    {
        $sessionId = $request->query('session_id');

        if (!$sessionId) {
            return redirect()->route('presence.pause-souffle')->with('error', 'Session de paiement invalide.');
        }

        // Récupérer l'intake via session_id
        $intake = PauseSouffleIntake::where('stripe_checkout_session_id', $sessionId)->first();

        if (!$intake) {
            return redirect()->route('presence.pause-souffle')->with('error', 'Demande introuvable.');
        }

        // Vérifier le statut avec Stripe si pas encore paid (le webhook peut ne pas avoir encore traité)
        if ($intake->status !== 'paid') {
            try {
                $stripeSecret = config('services.stripe.secret');
                \Stripe\Stripe::setApiKey($stripeSecret);
                $session = \Stripe\Checkout\Session::retrieve($sessionId);
                
                if ($session->payment_status === 'paid') {
                    // Mettre à jour manuellement si webhook pas encore passé
                    $intake->update([
                        'status' => 'paid',
                        'stripe_payment_intent_id' => $session->payment_intent,
                        'paid_at' => now(),
                    ]);
                }
            } catch (\Exception $e) {
                Log::warning('Erreur vérification session Stripe', ['error' => $e->getMessage()]);
            }
        }

        // Rediriger vers la page de choix de cycle uniquement si essai payé
        if ($intake->status === 'paid' && $intake->plan_key === 'trial') {
            return redirect()->route('pause-souffle.choose-cycle', ['intake_id' => $intake->id]);
        }

        // Sinon, afficher la confirmation standard
        return view('frontend.presence.pause-souffle-confirmation', [
            'intake' => $intake,
        ]);
    }

    /**
     * Page d'annulation Stripe
     */
    public function stripeCancel(Request $request)
    {
        $intakeId = $request->query('intake_id');

        if ($intakeId) {
            $intake = PauseSouffleIntake::find($intakeId);
            if ($intake && $intake->status === 'pending_payment') {
                // Optionnel : marquer comme annulé
                // $intake->update(['status' => 'cancelled']);
            }
        }

        return redirect()->route('presence.pause-souffle')
            ->with('info', 'Le paiement a été annulé. Vous pouvez réessayer quand vous le souhaitez.');
    }

    /**
     * Page de choix du cycle (4 semaines) après essai payé
     */
    public function chooseCycle(Request $request)
    {
        $intakeId = $request->query('intake_id');
        
        if (!$intakeId) {
            return redirect()->route('presence.pause-souffle')->with('error', 'Demande introuvable.');
        }

        $intake = PauseSouffleIntake::findOrFail($intakeId);

        // Vérifier que l'essai est payé
        if ($intake->status !== 'paid' || $intake->plan_key !== 'trial') {
            return redirect()->route('presence.pause-souffle')->with('error', 'Vous devez d\'abord réserver votre rituel d\'essai.');
        }

        // Vérifier qu'une subscription n'existe pas déjà (idempotence)
        if ($intake->subscription_id) {
            $subscription = $intake->subscription;
            if ($subscription && $subscription->status === 'active') {
                return redirect()->route('pause-souffle.cycle-confirmation', ['intake_id' => $intake->id])
                    ->with('info', 'Votre cycle est déjà activé.');
            }
        }

        // Récupérer les prix Stripe pour les packs
        $packs = $this->getPauseSoufflePacks();

        $misc = $this->miscController;
        $language = $misc->getLanguage();
        
        return view('frontend.presence.pause-souffle-choose-cycle', [
            'intake' => $intake,
            'packs' => $packs,
            'breadcrumb' => $misc->getBreadcrumb(),
            'language' => $language,
        ]);
    }

    /**
     * Activer le cycle choisi
     */
    public function activateCycle(Request $request)
    {
        $request->validate([
            'intake_id' => 'required|exists:pause_souffle_intakes,id',
            'pack' => 'required|in:pack_1,pack_2,pack_4,pack_8',
            'addon_qty' => 'nullable|integer|min:0|max:12',
        ]);

        $intake = PauseSouffleIntake::findOrFail($request->intake_id);

        // Vérifier que l'essai est payé
        if ($intake->status !== 'paid' || $intake->plan_key !== 'trial') {
            return back()->withErrors(['error' => 'Vous devez d\'abord réserver votre rituel d\'essai.'])->withInput();
        }

        // Vérifier idempotence : si subscription existe déjà, ne pas en créer une deuxième
        if ($intake->subscription_id) {
            $subscription = $intake->subscription;
            if ($subscription && $subscription->status === 'active') {
                return redirect()->route('pause-souffle.cycle-confirmation', ['intake_id' => $intake->id])
                    ->with('info', 'Votre cycle est déjà activé.');
            }
        }

        $pack = $request->pack;
        $addonQty = (int) ($request->addon_qty ?? 0);
        $hoursPerWeek = config("pause_souffle.pack_to_hours_per_week.{$pack}");
        $ritualsPerCycle = config("pause_souffle.pack_to_rituals_per_cycle.{$pack}", 1);
        $maxRituals = config('pause_souffle.max_rituals_per_cycle', 12);
        
        // Vérifier limite 12 rituels total
        $totalRituals = $ritualsPerCycle + $addonQty;
        if ($totalRituals > $maxRituals) {
            return back()->withErrors(['addon_qty' => "Le total ne peut pas dépasser {$maxRituals} rituels par cycle."])->withInput();
        }

        // Récupérer le client
        $user = Auth::user() ?? $intake->user;
        if (!$user) {
            return redirect()->route('user.login')->with('warning', 'Vous devez être connecté pour activer un cycle.');
        }

        $clientProfile = $user->clientProfile;
        if (!$clientProfile) {
            // Créer le profil client si nécessaire
            $clientProfile = ClientProfile::create([
                'user_id' => $user->id,
                'total_spent' => 0,
            ]);
        }

        // Vérifier la configuration Stripe avant de continuer
        $stripeSecret = config('services.stripe.secret');
        if (!$stripeSecret) {
            Log::error('Stripe secret key non configuré', ['config_key' => 'services.stripe.secret']);
            return back()->withErrors(['error' => 'Configuration de paiement invalide. Veuillez contacter le support.'])->withInput();
        }

        // Récupérer le prix Stripe pour le pack
        $priceId = config("pause_souffle.stripe_prices.{$pack}");
        if (!$priceId) {
            $envVar = 'PAUSE_SOUFFLE_PRICE_' . strtoupper(str_replace('pack_', 'PACK_', $pack));
            Log::error('Stripe price ID non configuré pour pack', [
                'pack' => $pack,
                'env_var' => $envVar,
                'config_path' => "pause_souffle.stripe_prices.{$pack}"
            ]);
            return back()->withErrors(['error' => "Configuration de paiement invalide. Le prix pour le pack {$pack} n'est pas configuré. Veuillez contacter le support."])->withInput();
        }

        try {
            // Récupérer le prix depuis Stripe pour obtenir le montant
            Stripe::setApiKey($stripeSecret);
            $stripePrice = Price::retrieve($priceId);
            $priceBase = $stripePrice->unit_amount / 100; // Convertir centimes en euros

            // Vérifier que les routes existent
            try {
                $successUrl = route('pause-souffle.cycle-confirmation') . '?session_id={CHECKOUT_SESSION_ID}&intake_id=' . $intake->id;
                $cancelUrl = route('pause-souffle.choose-cycle', ['intake_id' => $intake->id]);
            } catch (\Exception $e) {
                Log::error('Route Stripe non trouvée pour cycle', [
                    'error' => $e->getMessage(),
                    'route_success' => 'pause-souffle.cycle-confirmation',
                    'route_cancel' => 'pause-souffle.choose-cycle'
                ]);
                return back()->withErrors(['error' => 'Routes de paiement non configurées. Veuillez contacter le support.'])->withInput();
            }

            // Créer la session Stripe Checkout pour l'abonnement
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price' => $priceId,
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'subscription',
                'success_url' => $successUrl,
                'cancel_url' => $cancelUrl,
                'metadata' => [
                    'intake_id' => $intake->id,
                    'pack' => $pack,
                    'addon_qty' => $addonQty,
                    'type' => 'pause_souffle_subscription',
                ],
                'customer_email' => $intake->email ?? $user->email_address,
            ]);

            // Sauvegarder les données en session pour création subscription après webhook
            session([
                'pending_pause_souffle_subscription' => [
                    'intake_id' => $intake->id,
                    'pack' => $pack,
                    'addon_qty' => $addonQty,
                    'rituals_per_cycle' => $ritualsPerCycle,
                    'total_rituals' => $totalRituals,
                    'hours_per_week' => $hoursPerWeek,
                    'price_base' => $priceBase,
                    'stripe_checkout_session_id' => $session->id,
                ],
            ]);

            Log::info('Session Stripe Checkout créée pour cycle Pause Souffle', [
                'session_id' => $session->id,
                'pack' => $pack,
                'price_id' => $priceId,
                'intake_id' => $intake->id
            ]);

            return redirect($session->url);

        } catch (\Stripe\Exception\InvalidRequestException $e) {
            Log::error('Erreur Stripe API lors de la création de la session pour cycle', [
                'stripe_error' => $e->getStripeCode(),
                'error' => $e->getMessage(),
                'pack' => $pack,
                'price_id' => $priceId,
                'intake_id' => $intake->id,
            ]);

            $errorMessage = 'Erreur lors de la création de la session de paiement. ';
            if (strpos($e->getMessage(), 'No such price') !== false) {
                $errorMessage .= 'Le prix configuré n\'existe pas dans Stripe. Veuillez contacter le support.';
            } else {
                $errorMessage .= 'Veuillez réessayer.';
            }

            return back()->withErrors(['error' => $errorMessage])->withInput();
        } catch (\Exception $e) {
            Log::error('Erreur création session Stripe pour cycle Pause Souffle', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'intake_id' => $intake->id,
                'pack' => $pack ?? null,
                'price_id' => $priceId ?? null,
                'trace' => $e->getTraceAsString(),
            ]);

            $errorMessage = 'Une erreur est survenue lors de la création de la session de paiement. ';
            if (strpos($e->getMessage(), 'price ID non configuré') !== false) {
                $errorMessage .= 'Configuration de paiement manquante. Veuillez contacter le support.';
            } else {
                $errorMessage .= 'Veuillez réessayer.';
            }

            return back()->withErrors(['error' => $errorMessage])->withInput();
        }
    }

    /**
     * Page de confirmation après activation du cycle
     */
    public function cycleConfirmation(Request $request)
    {
        $sessionId = $request->query('session_id');
        $intakeId = $request->query('intake_id');

        if (!$intakeId) {
            return redirect()->route('presence.pause-souffle')->with('error', 'Demande introuvable.');
        }

        $intake = PauseSouffleIntake::findOrFail($intakeId);

        // Récupérer la subscription liée
        $subscription = $intake->subscription;

        if (!$subscription) {
            // Attendre le webhook ou vérifier directement
            try {
                if ($sessionId) {
                    Stripe::setApiKey(config('services.stripe.secret'));
                    $session = \Stripe\Checkout\Session::retrieve($sessionId);
                    
                    if ($session->payment_status === 'paid' && $session->subscription) {
                        // Le webhook devrait avoir créé la subscription, mais si pas encore, on attend
                        return view('frontend.presence.pause-souffle-cycle-confirmation', [
                            'intake' => $intake,
                            'subscription' => null,
                            'pending' => true,
                        ]);
                    }
                }
            } catch (\Exception $e) {
                Log::warning('Erreur vérification session Stripe', ['error' => $e->getMessage()]);
            }
        }

        $misc = $this->miscController;
        $language = $misc->getLanguage();

        return view('frontend.presence.pause-souffle-cycle-confirmation', [
            'intake' => $intake,
            'subscription' => $subscription,
            'pending' => false,
            'breadcrumb' => $misc->getBreadcrumb(),
            'language' => $language,
        ]);
    }

    /**
     * Récupérer les packs Pause Souffle avec leurs prix depuis Stripe
     */
    protected function getPauseSoufflePacks(): array
    {
        $packs = [];
        $packKeys = ['pack_1', 'pack_2', 'pack_4', 'pack_8'];

        try {
            Stripe::setApiKey(config('services.stripe.secret'));

            foreach ($packKeys as $packKey) {
                $priceId = config("pause_souffle.stripe_prices.{$packKey}");
                if (!$priceId) {
                    continue;
                }

                try {
                    $price = Price::retrieve($priceId);
                    $packs[$packKey] = [
                        'price_id' => $priceId,
                        'amount' => $price->unit_amount / 100,
                        'currency' => strtoupper($price->currency),
                        'label' => config("pause_souffle.plan_labels.{$packKey}"),
                        'rituals_per_cycle' => config("pause_souffle.pack_to_rituals_per_cycle.{$packKey}", 1),
                    ];
                } catch (\Exception $e) {
                    Log::warning('Erreur récupération prix Stripe', ['price_id' => $priceId, 'error' => $e->getMessage()]);
                }
            }
        } catch (\Exception $e) {
            Log::error('Erreur configuration Stripe pour packs Pause Souffle', ['error' => $e->getMessage()]);
        }

        return $packs;
    }
}
