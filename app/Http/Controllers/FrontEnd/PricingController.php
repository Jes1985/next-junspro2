<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontEnd\MiscellaneousController;
use App\Services\Junspro\CycleUsageService;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    /**
     * Méta-données premium pour chaque palier (nom, description, icône, populaire).
     */
    private function planMeta(): array
    {
        return [
            4  => ['name' => 'Essentiel',  'description' => 'Pour démarrer en douceur',         'icon' => 'fas fa-seedling',   'popular' => false],
            8  => ['name' => 'Starter',    'description' => 'Idéal pour un Rituel régulier',     'icon' => 'fas fa-rocket',     'popular' => false],
            16 => ['name' => 'Business',   'description' => 'Le plus choisi — rythme soutenu',   'icon' => 'fas fa-briefcase',  'popular' => true],
            24 => ['name' => 'Pro',        'description' => 'Pour les Rituels ambitieux',         'icon' => 'fas fa-chart-line', 'popular' => false],
            32 => ['name' => 'Premium',    'description' => 'Immersion totale dans le Rituel',   'icon' => 'fas fa-crown',      'popular' => false],
            48 => ['name' => 'Growth',     'description' => 'Cadence intensive',                 'icon' => 'fas fa-bolt',       'popular' => true],
            56 => ['name' => 'Scale',      'description' => 'Pour accélérer fort',               'icon' => 'fas fa-expand-alt', 'popular' => false],
            64 => ['name' => 'Elite',      'description' => 'Expertise dédiée à plein régime',   'icon' => 'fas fa-gem',        'popular' => false],
            72 => ['name' => 'Expert',     'description' => 'Priorité absolue au Rituel',        'icon' => 'fas fa-star',       'popular' => false],
            80 => ['name' => 'Master',     'description' => 'Collaboration quasi temps-plein',   'icon' => 'fas fa-trophy',     'popular' => false],
            88 => ['name' => 'Enterprise', 'description' => 'Volume maximal, impact maximum',   'icon' => 'fas fa-building',   'popular' => false],
        ];
    }

    /**
     * Construit les plans d'un univers à partir des paliers CycleUsageService.
     */
    private function buildPlans(array $paliers, string $universeType, CycleUsageService $svc): array
    {
        $meta = $this->planMeta();
        $plans = [];
        foreach ($paliers as $palier) {
            $topupMax   = $svc->topupCap($palier, $universeType);
            $cycleMax   = $svc->cycleMaxTotal($palier, $universeType);
            $plans[] = [
                'hours_per_cycle' => $palier,
                'hours_per_week'  => $palier / 4,
                'topup_max'       => $topupMax,
                'cycle_max_total' => $cycleMax,
                'name'            => $meta[$palier]['name']        ?? "{$palier}h/cycle",
                'description'     => $meta[$palier]['description'] ?? '',
                'icon'            => $meta[$palier]['icon']        ?? 'fas fa-circle',
                'popular'         => $meta[$palier]['popular']     ?? false,
            ];
        }
        return $plans;
    }

    /**
     * Afficher la page de tarification Junspro V2
     */
    public function index(Request $request, CycleUsageService $cycleUsage)
    {
        $misc = new MiscellaneousController();
        $breadcrumb = $misc->getBreadcrumb();

        // Freelance pré-sélectionné (optionnel)
        $selectedFreelancer = null;
        if ($request->has('freelancer_id')) {
            $selectedFreelancer = \App\Models\FreelancerProfile::with('user')->find($request->freelancer_id);
        }

        // Plans par univers
        $plansA = $this->buildPlans(CycleUsageService::PALIERS_A, CycleUsageService::UNIVERSE_A, $cycleUsage);
        $plansB = $this->buildPlans(CycleUsageService::PALIERS_B, CycleUsageService::UNIVERSE_B, $cycleUsage);

        // Abonnement actif de l'utilisateur (pour surligner son palier courant)
        $currentPalier    = null;
        $currentUniverse  = null;
        $user = auth('web')->user();
        if ($user && $user->clientProfile) {
            $activeSub = \App\Models\Subscription::where('client_id', $user->clientProfile->id)
                ->where('status', 'active')
                ->latest()
                ->first();
            if ($activeSub) {
                $currentPalier   = $cycleUsage->snapToPalier($activeSub->hours_per_week * 4, $cycleUsage->universeType($activeSub->universe ?? ''));
                $currentUniverse = $activeSub->universe ?? null;
            }
        }

        // Options Express (inchangées)
        $expressOptions = [
            ['name' => 'Express 24h', 'multiplier' => 1.30, 'percentage' => '+30%', 'description' => 'Livraison en 24h'],
            ['name' => 'Express 48h', 'multiplier' => 1.20, 'percentage' => '+20%', 'description' => 'Livraison en 48h'],
            ['name' => 'Express 72h', 'multiplier' => 1.10, 'percentage' => '+10%', 'description' => 'Livraison en 72h'],
        ];

        // Garanties (inchangées)
        $guarantees = [
            ['icon' => 'fas fa-shield-alt',  'title' => 'Paiements sécurisés',       'description' => 'Transactions protégées par Stripe'],
            ['icon' => 'fas fa-clock',        'title' => 'Rituel d\'essai de 1h',     'description' => 'Testez un freelance sur 1 heure avant de vous engager davantage.'],
            ['icon' => 'fas fa-file-alt',     'title' => 'Rapport après chaque heure','description' => '50 min de travail concentré + 10 min de rapport pédagogique.'],
            ['icon' => 'fas fa-sync-alt',     'title' => 'Abonnement flexible',       'description' => 'Pause, transfert ou résiliation à tout moment.'],
            ['icon' => 'fas fa-bolt',         'title' => 'Options Express',           'description' => 'Accélérez les livraisons avec +10%, +20%, +30%.'],
            ['icon' => 'fas fa-headset',      'title' => 'Support dédié',             'description' => 'Équipe disponible pour vous accompagner.'],
        ];

        return view('frontend.pricing.index', [
            'breadcrumb'       => $breadcrumb,
            'plansA'           => $plansA,
            'plansB'           => $plansB,
            'expressOptions'   => $expressOptions,
            'guarantees'       => $guarantees,
            'selectedFreelancer' => $selectedFreelancer,
            'currentPalier'    => $currentPalier,
            'currentUniverse'  => $currentUniverse,
            'ritualSignature'  => CycleUsageService::RITUAL_SIGNATURE,
        ]);
    }
    
    /**
     * Créer un abonnement depuis la page pricing
     */
    public function subscribe(Request $request, \App\Services\Junspro\SubscriptionService $subscriptionService)
    {
        $request->validate([
            'freelancer_id' => 'required|exists:freelancer_profiles,id',
            'weekly_hours' => 'required|in:1,2,4,8,12,16,20,24',
            'express_24h' => 'nullable|boolean',
            'express_48h' => 'nullable|boolean',
            'express_72h' => 'nullable|boolean',
        ]);

        $freelancer = \App\Models\FreelancerProfile::with('user')->findOrFail($request->freelancer_id);
        $clientUser = \Illuminate\Support\Facades\Auth::guard('web')->user();
        $clientProfile = $clientUser?->clientProfile;

        if (!$clientProfile) {
            return redirect()->route('user.login')->with('warning', __('Vous devez être connecté en tant que client.'));
        }

        // Déterminer le mode de livraison
        $deliveryMode = 'standard';
        if ($request->boolean('express_24h')) {
            $deliveryMode = 'express_24h';
        } elseif ($request->boolean('express_48h')) {
            $deliveryMode = 'express_48h';
        } elseif ($request->boolean('express_72h')) {
            $deliveryMode = 'express_72h';
        }

        // Créer l'abonnement
        $subscription = $subscriptionService->createSubscription(
            $clientProfile,
            $freelancer,
            $request->weekly_hours,
            $deliveryMode,
            null // Stripe subscription ID sera ajouté après paiement
        );

        return redirect()->route('client.subscriptions.show', $subscription->id)
            ->with('success', __('Votre abonnement a été créé. Un kick-off visio sera programmé avant les premières livraisons.'));
    }
}

