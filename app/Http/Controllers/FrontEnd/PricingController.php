<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontEnd\MiscellaneousController;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    /**
     * Afficher la page de tarification Junspro V2
     */
    public function index(Request $request)
    {
        $misc = new MiscellaneousController();
        $breadcrumb = $misc->getBreadcrumb();
        
        // Récupérer le freelance sélectionné si présent
        $selectedFreelancer = null;
        if ($request->has('freelancer_id')) {
            $selectedFreelancer = \App\Models\FreelancerProfile::with('user')->find($request->freelancer_id);
        }
        
        // Formules d'abonnement disponibles
        $subscriptionPlans = [
            [
                'hours_per_week' => 1,
                'hours_per_month' => 4,
                'name' => 'Essentiel',
                'description' => 'Parfait pour les projets ponctuels',
                'icon' => 'fas fa-star',
            ],
            [
                'hours_per_week' => 2,
                'hours_per_month' => 8,
                'name' => 'Starter',
                'description' => 'Idéal pour démarrer votre projet',
                'icon' => 'fas fa-rocket',
            ],
            [
                'hours_per_week' => 4,
                'hours_per_month' => 16,
                'name' => 'Business',
                'description' => 'Pour les projets réguliers',
                'icon' => 'fas fa-briefcase',
            ],
            [
                'hours_per_week' => 8,
                'hours_per_month' => 32,
                'name' => 'Professional',
                'description' => 'Pour un suivi intensif',
                'icon' => 'fas fa-chart-line',
            ],
            [
                'hours_per_week' => 12,
                'hours_per_month' => 48,
                'name' => 'Enterprise',
                'description' => 'Pour les projets ambitieux',
                'icon' => 'fas fa-building',
            ],
            [
                'hours_per_week' => 16,
                'hours_per_month' => 64,
                'name' => 'Premium',
                'description' => 'Maximum de flexibilité',
                'icon' => 'fas fa-crown',
            ],
            [
                'hours_per_week' => 20,
                'hours_per_month' => 80,
                'name' => 'Elite',
                'description' => 'Pour les projets complexes',
                'icon' => 'fas fa-gem',
            ],
            [
                'hours_per_week' => 24,
                'hours_per_month' => 96,
                'name' => 'Ultimate',
                'description' => 'Dédié à votre projet',
                'icon' => 'fas fa-trophy',
            ],
        ];

        // Options Express
        $expressOptions = [
            [
                'name' => 'Express 24h',
                'multiplier' => 1.30,
                'percentage' => '+30%',
                'description' => 'Livraison en 24h',
            ],
            [
                'name' => 'Express 48h',
                'multiplier' => 1.20,
                'percentage' => '+20%',
                'description' => 'Livraison en 48h',
            ],
            [
                'name' => 'Express 72h',
                'multiplier' => 1.10,
                'percentage' => '+10%',
                'description' => 'Livraison en 72h',
            ],
        ];

        // Garanties
        $guarantees = [
            [
                'icon' => 'fas fa-shield-alt',
                'title' => 'Paiements sécurisés',
                'description' => 'Transactions protégées par Stripe',
            ],
            [
                'icon' => 'fas fa-clock',
                'title' => 'Abonnements flexibles',
                'description' => 'De 1 à 24h par semaine, adaptez selon vos besoins',
            ],
            [
                'icon' => 'fas fa-file-alt',
                'title' => 'Rapport après chaque heure',
                'description' => '50 min de travail + 10 min de rapport détaillé',
            ],
            [
                'icon' => 'fas fa-sync-alt',
                'title' => 'Changement de freelance',
                'description' => 'Possibilité de changer si besoin',
            ],
            [
                'icon' => 'fas fa-pause',
                'title' => 'Mise en pause',
                'description' => 'Mettez en pause votre abonnement à tout moment',
            ],
            [
                'icon' => 'fas fa-headset',
                'title' => 'Support dédié',
                'description' => 'Équipe disponible pour vous accompagner',
            ],
        ];

        return view('frontend.pricing.index', [
            'breadcrumb' => $breadcrumb,
            'subscriptionPlans' => $subscriptionPlans,
            'expressOptions' => $expressOptions,
            'guarantees' => $guarantees,
            'selectedFreelancer' => $selectedFreelancer,
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

