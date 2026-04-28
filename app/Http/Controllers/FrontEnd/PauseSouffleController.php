<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontEnd\MiscellaneousController;
use App\Models\PauseSouffleIntake;
use App\Models\ClientProfile;
use App\Services\StripeService;
use App\Services\Junspro\SubscriptionService;
use App\Services\Junspro\FormationService;
use App\Models\FormationEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Price;
use App\Models\PsAmbassadeur;
use App\Mail\PsAmbassadorInvitationMail;

class PauseSouffleController extends Controller
{
    protected $miscController;
    protected $stripeService;
    protected $subscriptionService;
    protected $formationService;

    public function __construct(
        MiscellaneousController $miscController,
        StripeService $stripeService,
        SubscriptionService $subscriptionService,
        FormationService $formationService
    ) {
        $this->miscController = $miscController;
        $this->stripeService = $stripeService;
        $this->subscriptionService = $subscriptionService;
        $this->formationService = $formationService;
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
     * Page landing de la formation certifiante "Praticien Pause Souffle"
     */
    public function formationPraticien()
    {
        $misc = $this->miscController;
        $language = $misc->getLanguage();
        $queryResult = [
            'breadcrumb' => $misc->getBreadcrumb(),
            'language' => $language,
        ];

        return view('frontend.presence.formation-praticien', $queryResult);
    }

    /**
     * Page Le Parcours Pause Souffle (transformation personnelle)
     * Route : GET /presence/le-parcours
     */
    public function parcours()
    {
        $misc = $this->miscController;
        $language = $misc->getLanguage();
        $queryResult = [
            'breadcrumb' => $misc->getBreadcrumb(),
            'language' => $language,
        ];

        return view('frontend.presence.le-parcours', $queryResult);
    }

    /**
     * Page de présentation de la Retraite Pause Souffle (FR + EN)
     */
    public function retraite(\Illuminate\Http\Request $request)
    {
        $misc = $this->miscController;
        $language = $misc->getLanguage();

        // Priorité au paramètre URL ?lang=en|fr (toggle flottant FR|EN)
        $urlLang = $request->query('lang', '');
        if (in_array($urlLang, ['en', 'fr'], true)) {
            $override = \App\Models\Language::where('code', $urlLang)->first();
            if ($override) {
                $language = $override;
            }
        }

        return view('frontend.presence.retraite', [
            'breadcrumb' => $misc->getBreadcrumb(),
            'language'   => $language,
        ]);
    }

    /**
     * Livret de retraite — page imprimable (PDF-friendly)
     */
    public function livretRetraite()
    {
        $misc = $this->miscController;
        $language = $misc->getLanguage();

        return view('frontend.presence.livret-retraite', [
            'breadcrumb' => $misc->getBreadcrumb(),
            'language'   => $language,
        ]);
    }

    /**
     * Inscription liste d'attente retraite
     * Route : POST /presence/la-retraite/waitlist
     */
    public function retraiteWaitlist(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:80',
            'email'      => 'required|email|max:200',
            'edition'    => 'required|string|max:60',
        ]);

        Log::info('Retraite waitlist entry', $data);

        $adminEmail = config('mail.from.address', 'contact@junspro.com');
        Mail::raw(
            "Nouvelle inscription liste d'attente retraite\n\n"
            . "Prénom : {$data['first_name']}\n"
            . "Email : {$data['email']}\n"
            . "Édition souhaitée : {$data['edition']}\n",
            fn($msg) => $msg->to($adminEmail)->subject("[Retraite] Nouvelle inscription liste d'attente")
        );

        return response()->json(['success' => true]);
    }

    /**
     * Créer la session Stripe Checkout pour le paiement de la formation (3 490 €)
     * Route : POST /presence/formation/checkout  [auth:web]
     */
    public function formationCheckout(Request $request)
    {
        $user = Auth::user();

        // Vérifier si l'utilisateur est déjà inscrit et actif
        $existing = FormationEnrollment::where('user_id', $user->id)
            ->whereIn('status', ['active', 'completed'])
            ->first();

        if ($existing) {
            return redirect()->route('formation.dashboard')
                ->with('info', 'Vous êtes déjà inscrit à la formation.');
        }

        try {
            $productType = $request->input('product_type', 'pause_freelance');
            // Sécuriser : seulement les types PS autorisés
            if (!in_array($productType, ['pause_parcours', 'pause_freelance'])) {
                $productType = 'pause_freelance';
            }

            $psAmbassadorCode = $request->cookie('ps_ambassador_code') ?? session('ps_ambassador_code', '');

            $session = $this->stripeService->createFormationCheckoutSession(
                $user->id,
                $user->email_address ?? $user->email ?? '',
                $productType,
                $psAmbassadorCode ?: null
            );

            return redirect($session->url);

        } catch (\Exception $e) {
            Log::error('Erreur création checkout formation', [
                'user_id' => $user->id,
                'error'   => $e->getMessage(),
            ]);
            return back()->with('error', 'Une erreur est survenue lors de la création du paiement. Veuillez réessayer.');
        }
    }

    /**
     * Page de succès après paiement formation
     * Route : GET /presence/formation/success
     */
    public function formationSuccess(Request $request)
    {
        $misc = $this->miscController;
        $language = $misc->getLanguage();

        $user = Auth::user();
        $isAlreadyAmbassadeur = false;
        if ($user) {
            $isAlreadyAmbassadeur = PsAmbassadeur::where('user_id', $user->id)
                ->whereIn('status', ['active', 'pending'])
                ->exists();

            if (!$isAlreadyAmbassadeur && !session('ps_invitation_sent_formation_' . $user->id)) {
                try {
                    Mail::to($user->email_address ?? $user->email)
                        ->queue(new PsAmbassadorInvitationMail($user, 'formation'));
                    session(['ps_invitation_sent_formation_' . $user->id => true]);
                } catch (\Throwable $e) {
                    Log::warning('Erreur envoi invitation ambassadeur formation', ['error' => $e->getMessage()]);
                }
            }
        }

        return view('frontend.presence.formation-success', [
            'breadcrumb'           => $misc->getBreadcrumb(),
            'language'             => $language,
            'isAlreadyAmbassadeur' => $isAlreadyAmbassadeur,
        ]);
    }

    /**
     * Redirection si paiement formation annulé
     * Route : GET /presence/formation/cancel
     */
    public function formationCancel(Request $request)
    {
        return redirect()->route('presence.formation-praticien')
            ->with('info', 'Paiement annulé. Vous pouvez réessayer quand vous souhaitez.');
    }

    /**
     * Créer la session Stripe en 3 mensualités de 1 164 €
     * Route : POST /presence/formation/checkout-installment  [auth:web]
     */
    public function formationCheckoutInstallment(Request $request)
    {
        $user = Auth::user();

        $existing = FormationEnrollment::where('user_id', $user->id)
            ->whereIn('status', ['active', 'completed'])
            ->first();

        if ($existing) {
            return redirect()->route('formation.dashboard')
                ->with('info', 'Vous êtes déjà inscrit à la formation.');
        }

        try {
            $psAmbassadorCode = $request->cookie('ps_ambassador_code') ?? session('ps_ambassador_code', '');

            $session = $this->stripeService->createFormationInstallmentCheckoutSession(
                $user->id,
                $user->email_address ?? $user->email ?? '',
                $psAmbassadorCode ?: null
            );

            return redirect($session->url);

        } catch (\Exception $e) {
            Log::error('Erreur création checkout formation installment', [
                'user_id' => $user->id,
                'error'   => $e->getMessage(),
            ]);
            return back()->with('error', 'Une erreur est survenue lors de la création du paiement. Veuillez réessayer.');
        }
    }

    // ─── Parcours Pause Souffle — Checkout Niveau 1 / Niveau 2 / Pack Intégral ────

    public function parcoursCheckoutNiveau1(Request $request)
    {
        $user = Auth::user();
        $psCode = $request->cookie('ps_ambassador_code') ?? session('ps_ambassador_code', '');
        try {
            $session = $this->stripeService->createFormationNiveau1CheckoutSession($user->id, $user->email_address ?? $user->email ?? '', $psCode ?: null);
            return redirect($session->url);
        } catch (\Exception $e) {
            Log::error('Erreur checkout Niveau 1', ['user_id' => $user->id, 'error' => $e->getMessage()]);
            return back()->with('error', 'Une erreur est survenue lors de la création du paiement.');
        }
    }

    public function parcoursCheckoutNiveau1Installment(Request $request)
    {
        $user = Auth::user();
        $psCode = $request->cookie('ps_ambassador_code') ?? session('ps_ambassador_code', '');
        try {
            $session = $this->stripeService->createFormationNiveau1InstallmentCheckoutSession($user->id, $user->email_address ?? $user->email ?? '', $psCode ?: null);
            return redirect($session->url);
        } catch (\Exception $e) {
            Log::error('Erreur checkout Niveau 1 mensualités', ['user_id' => $user->id, 'error' => $e->getMessage()]);
            return back()->with('error', 'Une erreur est survenue lors de la création du paiement.');
        }
    }

    public function parcoursCheckoutNiveau2(Request $request)
    {
        $user = Auth::user();
        $psCode = $request->cookie('ps_ambassador_code') ?? session('ps_ambassador_code', '');
        try {
            $session = $this->stripeService->createFormationNiveau2CheckoutSession($user->id, $user->email_address ?? $user->email ?? '', $psCode ?: null);
            return redirect($session->url);
        } catch (\Exception $e) {
            Log::error('Erreur checkout Niveau 2', ['user_id' => $user->id, 'error' => $e->getMessage()]);
            return back()->with('error', 'Une erreur est survenue lors de la création du paiement.');
        }
    }

    public function parcoursCheckoutNiveau2Installment(Request $request)
    {
        $user = Auth::user();
        $psCode = $request->cookie('ps_ambassador_code') ?? session('ps_ambassador_code', '');
        try {
            $session = $this->stripeService->createFormationNiveau2InstallmentCheckoutSession($user->id, $user->email_address ?? $user->email ?? '', $psCode ?: null);
            return redirect($session->url);
        } catch (\Exception $e) {
            Log::error('Erreur checkout Niveau 2 mensualités', ['user_id' => $user->id, 'error' => $e->getMessage()]);
            return back()->with('error', 'Une erreur est survenue lors de la création du paiement.');
        }
    }

    public function parcoursCheckoutNiveau3(Request $request)
    {
        $user = Auth::user();
        $psCode = $request->cookie('ps_ambassador_code') ?? session('ps_ambassador_code', '');
        try {
            $session = $this->stripeService->createFormationNiveau3CheckoutSession($user->id, $user->email_address ?? $user->email ?? '', $psCode ?: null);
            return redirect($session->url);
        } catch (\Exception $e) {
            Log::error('Erreur checkout Niveau 3', ['user_id' => $user->id, 'error' => $e->getMessage()]);
            return back()->with('error', 'Une erreur est survenue lors de la création du paiement.');
        }
    }

    public function parcoursCheckoutNiveau3Installment(Request $request)
    {
        $user = Auth::user();
        $psCode = $request->cookie('ps_ambassador_code') ?? session('ps_ambassador_code', '');
        try {
            $session = $this->stripeService->createFormationNiveau3InstallmentCheckoutSession($user->id, $user->email_address ?? $user->email ?? '', $psCode ?: null);
            return redirect($session->url);
        } catch (\Exception $e) {
            Log::error('Erreur checkout Niveau 3 mensualités', ['user_id' => $user->id, 'error' => $e->getMessage()]);
            return back()->with('error', 'Une erreur est survenue lors de la création du paiement.');
        }
    }

    /**
     * Page tous les programmes et tarifs
     * Route : GET /presence/nos-programmes
     */
    public function nosProgrammes()
    {
        $misc = $this->miscController;
        $language = $misc->getLanguage();
        $queryResult = [
            'breadcrumb' => $misc->getBreadcrumb(),
            'language'   => $language,
        ];

        return view('frontend.presence.nos-programmes', $queryResult);
    }

    public function mentorsCheckout(Request $request)
    {
        $user = Auth::user();
        $psCode = $request->cookie('ps_ambassador_code') ?? session('ps_ambassador_code', '');
        try {
            $session = $this->stripeService->createFormationMentorsCheckoutSession($user->id, $user->email_address ?? $user->email ?? '', $psCode ?: null);
            return redirect($session->url);
        } catch (\Exception $e) {
            Log::error('Erreur checkout Formation Mentors', ['user_id' => $user->id, 'error' => $e->getMessage()]);
            return back()->with('error', 'Une erreur est survenue lors de la création du paiement.');
        }
    }

    public function mentorsCheckoutInstallment(Request $request)
    {
        $user = Auth::user();
        $psCode = $request->cookie('ps_ambassador_code') ?? session('ps_ambassador_code', '');
        try {
            $session = $this->stripeService->createFormationMentorsInstallmentCheckoutSession($user->id, $user->email_address ?? $user->email ?? '', $psCode ?: null);
            return redirect($session->url);
        } catch (\Exception $e) {
            Log::error('Erreur checkout Formation Mentors cycles', ['user_id' => $user->id, 'error' => $e->getMessage()]);
            return back()->with('error', 'Une erreur est survenue lors de la création du paiement.');
        }
    }

    public function maPauseSouffleCheckout(Request $request)
    {
        $user = Auth::user();
        $psCode = $request->cookie('ps_ambassador_code') ?? session('ps_ambassador_code', '');
        try {
            $session = $this->stripeService->createMaPauseSouffleCheckoutSession($user->id, $user->email_address ?? $user->email ?? '', $psCode ?: null);
            return redirect($session->url);
        } catch (\Exception $e) {
            Log::error('Erreur checkout Ma Pause Souffle', ['user_id' => $user->id, 'error' => $e->getMessage()]);
            return back()->with('error', 'Une erreur est survenue lors de la création du paiement.');
        }
    }

    public function maPauseSouffleCheckoutInstallment(Request $request)
    {
        $user = Auth::user();
        $psCode = $request->cookie('ps_ambassador_code') ?? session('ps_ambassador_code', '');
        try {
            $session = $this->stripeService->createMaPauseSouffleInstallmentCheckoutSession($user->id, $user->email_address ?? $user->email ?? '', $psCode ?: null);
            return redirect($session->url);
        } catch (\Exception $e) {
            Log::error('Erreur checkout Ma Pause Souffle cycles', ['user_id' => $user->id, 'error' => $e->getMessage()]);
            return back()->with('error', 'Une erreur est survenue lors de la création du paiement.');
        }
    }

    public function parcoursCheckoutPackIntegral(Request $request)
    {
        $user = Auth::user();
        $psCode = $request->cookie('ps_ambassador_code') ?? session('ps_ambassador_code', '');
        try {
            $session = $this->stripeService->createFormationPackIntegralCheckoutSession($user->id, $user->email_address ?? $user->email ?? '', $psCode ?: null);
            return redirect($session->url);
        } catch (\Exception $e) {
            Log::error('Erreur checkout Pack Intégral', ['user_id' => $user->id, 'error' => $e->getMessage()]);
            return back()->with('error', 'Une erreur est survenue lors de la création du paiement.');
        }
    }

    public function parcoursCheckoutPackIntegralInstallment(Request $request)
    {
        $user = Auth::user();
        $psCode = $request->cookie('ps_ambassador_code') ?? session('ps_ambassador_code', '');
        try {
            $session = $this->stripeService->createFormationPackIntegralInstallmentCheckoutSession($user->id, $user->email_address ?? $user->email ?? '', $psCode ?: null);
            return redirect($session->url);
        } catch (\Exception $e) {
            Log::error('Erreur checkout Pack Intégral mensualités', ['user_id' => $user->id, 'error' => $e->getMessage()]);
            return back()->with('error', 'Une erreur est survenue lors de la création du paiement.');
        }
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
        $misc     = $this->miscController;
        $language = $misc->getLanguage();

        // ── Mode aperçu (dev / design) : ?preview=1 ────────────────────────
        // Permet de visualiser la page sans passer par le tunnel Stripe.
        if ($request->boolean('preview') && config('app.debug')) {
            $mockIntake = new \stdClass();
            $mockIntake->id            = 0;
            $mockIntake->status        = 'paid';
            $mockIntake->plan_key      = 'trial';
            $mockIntake->subscription_id = null;

            $mockPacks = [
                'pack_1' => ['price_id' => 'preview', 'amount' => 49,  'currency' => 'EUR', 'label' => '1 rituel',  'rituals_per_cycle' => 1],
                'pack_2' => ['price_id' => 'preview', 'amount' => 89,  'currency' => 'EUR', 'label' => '2 rituels', 'rituals_per_cycle' => 2],
                'pack_4' => ['price_id' => 'preview', 'amount' => 159, 'currency' => 'EUR', 'label' => '4 rituels', 'rituals_per_cycle' => 4],
                'pack_8' => ['price_id' => 'preview', 'amount' => 279, 'currency' => 'EUR', 'label' => '8 rituels', 'rituals_per_cycle' => 8],
            ];

            return view('frontend.presence.pause-souffle-choose-cycle', [
                'intake'     => $mockIntake,
                'packs'      => $mockPacks,
                'breadcrumb' => $misc->getBreadcrumb(),
                'language'   => $language,
                'isPreview'  => true,
            ]);
        }
        // ── Fin mode aperçu ─────────────────────────────────────────────────

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

        return view('frontend.presence.pause-souffle-choose-cycle', [
            'intake'     => $intake,
            'packs'      => $packs,
            'breadcrumb' => $misc->getBreadcrumb(),
            'language'   => $language,
            'isPreview'  => false,
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

        // Vérifier si l'utilisateur est déjà ambassadeur
        $user = Auth::user();
        $isAlreadyAmbassadeur = false;
        if ($user) {
            $isAlreadyAmbassadeur = PsAmbassadeur::where('user_id', $user->id)
                ->whereIn('status', ['active', 'pending'])
                ->exists();

            // Envoyer l'invitation une seule fois (via session flag)
            if (!$isAlreadyAmbassadeur && !session('ps_invitation_sent_' . $user->id)) {
                try {
                    Mail::to($user->email_address ?? $user->email)
                        ->queue(new PsAmbassadorInvitationMail($user, 'cycle'));
                    session(['ps_invitation_sent_' . $user->id => true]);
                } catch (\Throwable $e) {
                    Log::warning('Erreur envoi invitation ambassadeur', ['error' => $e->getMessage()]);
                }
            }
        }

        return view('frontend.presence.pause-souffle-cycle-confirmation', [
            'intake'               => $intake,
            'subscription'         => $subscription,
            'pending'              => false,
            'isAlreadyAmbassadeur' => $isAlreadyAmbassadeur,
            'breadcrumb'           => $misc->getBreadcrumb(),
            'language'             => $language,
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
    public function retraiteCheckoutMer(Request $request)
    {
        $user = Auth::user();
        try {
            $session = $this->stripeService->createRetraiteMerCheckoutSession($user->id, $user->email_address ?? $user->email ?? '');
            return redirect($session->url);
        } catch (\Exception $e) {
            Log::error('Erreur checkout Retraite Mer', ['user_id' => $user->id, 'error' => $e->getMessage()]);
            return back()->with('error', 'Une erreur est survenue lors de la création du paiement.');
        }
    }

    public function retraiteCheckoutMerInstallment(Request $request)
    {
        $user = Auth::user();
        try {
            $session = $this->stripeService->createRetraiteMerInstallmentCheckoutSession($user->id, $user->email_address ?? $user->email ?? '');
            return redirect($session->url);
        } catch (\Exception $e) {
            Log::error('Erreur checkout Retraite Mer cycles', ['user_id' => $user->id, 'error' => $e->getMessage()]);
            return back()->with('error', 'Une erreur est survenue lors de la création du paiement.');
        }
    }

    public function retraiteCheckoutMontagne(Request $request)
    {
        $user = Auth::user();
        try {
            $session = $this->stripeService->createRetraiteMontagneCheckoutSession($user->id, $user->email_address ?? $user->email ?? '');
            return redirect($session->url);
        } catch (\Exception $e) {
            Log::error('Erreur checkout Retraite Montagne', ['user_id' => $user->id, 'error' => $e->getMessage()]);
            return back()->with('error', 'Une erreur est survenue lors de la création du paiement.');
        }
    }

    public function retraiteCheckoutMontagneInstallment(Request $request)
    {
        $user = Auth::user();
        try {
            $session = $this->stripeService->createRetraiteMontagneInstallmentCheckoutSession($user->id, $user->email_address ?? $user->email ?? '');
            return redirect($session->url);
        } catch (\Exception $e) {
            Log::error('Erreur checkout Retraite Montagne cycles', ['user_id' => $user->id, 'error' => $e->getMessage()]);
            return back()->with('error', 'Une erreur est survenue lors de la création du paiement.');
        }
    }
}
