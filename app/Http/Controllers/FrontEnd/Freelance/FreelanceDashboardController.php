<?php

namespace App\Http\Controllers\FrontEnd\Freelance;

use App\Http\Controllers\Controller;
use App\Models\FreelancerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FreelanceDashboardController extends Controller
{
    /**
     * Dashboard Freelance One-Page Premium
     */
    public function index()
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login')
                ->with('error', __('Vous devez être connecté pour accéder à cette page.'));
        }
        
        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->route('freelance.onboarding.step1')
                ->with('error', __('Vous devez compléter votre profil freelance pour accéder au dashboard.'));
        }

        // Whitelist stricte des onglets valides
        $validTabs = [
            'overview',
            'requests',
            'jobs',
            'calendar',
            'services',
            'messages',
            'earnings',
            'profile',
            'settings',
            'rituals'
        ];

        // Mapping des hash français vers les noms d'onglets anglais (pour compatibilité)
        $hashMapping = [
            'apercu' => 'overview',
            'demandes' => 'requests',
            'prestations' => 'jobs',
            'agenda' => 'calendar',
            'services' => 'services',
            'messages' => 'messages',
            'revenus' => 'earnings',
            'profil' => 'profile',
            'parametres' => 'settings',
            'rituels' => 'rituals'
        ];

        // Récupérer le tab depuis la requête
        $requestedTab = request('tab');
        
        // Si pas de query param, vérifier le hash dans l'URL actuelle (pour compatibilité avec anciens liens)
        if (!$requestedTab) {
            $url = request()->fullUrl();
            if (preg_match('/#([a-z]+)/i', $url, $matches)) {
                $hash = strtolower($matches[1]);
                $requestedTab = $hashMapping[$hash] ?? null;
            }
        }
        
        // Si toujours pas de tab, utiliser 'overview' par défaut
        if (!$requestedTab) {
            $requestedTab = 'overview';
        }
        
        // Valider et définir l'onglet actif
        $activeTab = in_array($requestedTab, $validTabs) ? $requestedTab : 'overview';
        
        // Rediriger si hash détecté dans l'URL pour utiliser query param à la place (SEO + cohérence)
        // Mais seulement si on n'a pas déjà un query param (pour éviter les boucles)
        $currentUrl = request()->fullUrl();
        if (!$requestedTab && preg_match('/#([a-z]+)/i', $currentUrl, $matches)) {
            $hash = strtolower($matches[1]);
            if (isset($hashMapping[$hash])) {
                // Rediriger vers la version avec query param (sans hash)
                return redirect()->route('freelance.dashboard', ['tab' => $hashMapping[$hash]]);
            }
        }

        return view('frontend.freelance.dashboard.index', [
            'user' => $user,
            'freelancerProfile' => $freelancerProfile,
            'activeTab' => $activeTab,
        ]);
    }
}
