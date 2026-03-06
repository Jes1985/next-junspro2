<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\FreelancerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class NexusDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::guard('web')->user();

        if (!$user) {
            return redirect()->route('user.login')
                ->with('error', __('Vous devez être connecté pour accéder à votre espace NEXUS.'));
        }

        $validTabs = ['overview', 'exchanges', 'search', 'messages', 'profile', 'settings'];
        $hashMapping = [
            'apercu'       => 'overview',
            'echanges'     => 'exchanges',
            'recherche'    => 'search',
            'messages'     => 'messages',
            'profil'       => 'profile',
            'parametres'   => 'settings',
        ];

        $requestedTab = $request->get('tab');
        if (!$requestedTab) {
            $url = $request->fullUrl();
            if (preg_match('/#([a-z]+)/i', $url, $matches)) {
                $hash = strtolower($matches[1]);
                $requestedTab = $hashMapping[$hash] ?? null;
            }
        }
        $activeTab = in_array($requestedTab, $validTabs) ? $requestedTab : 'overview';

        // Données utilisateur
        $displayName = $user->first_name ?: ($user->username ?: 'Voyageur');
        $initials    = strtoupper(
            substr($user->first_name ?? $user->username ?? 'U', 0, 1) .
            substr($user->last_name  ?? '', 0, 1)
        );

        // Profil freelance optionnel (pour afficher le badge si l'user est aussi freelance)
        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();

        // Recharger l'offre sauvegardée pour pré-remplir le formulaire miroir
        $savedOffer = [];
        // 1) BDD en source de vérité — cast 'array', gérer le legacy double-encodé
        if ($user && Schema::hasColumn('users', 'nexus_offer') && !empty($user->nexus_offer)) {
            $raw = $user->nexus_offer;
            $savedOffer = is_array($raw) ? $raw : (json_decode($raw, true) ?? []);
        }
        // 2) Fallback : session
        if (empty($savedOffer)) {
            $savedOffer = session('nexus_offer', []);
        }
        // Merger dans la requête courante pour que request() pré-remplisse le composant
        if (!empty($savedOffer)) {
            $request->merge($savedOffer);
        }

        return view('nexus.dashboard', compact(
            'user',
            'displayName',
            'initials',
            'activeTab',
            'freelancerProfile'
        ));
    }

    /**
     * Sauvegarde les préférences de recherche de l'utilisateur NEXUS.
     * Ces préférences constituent le "profil miroir" qui alimente la recherche communautaire.
     */
    public function savePreferences(Request $request)
    {
        $user = Auth::guard('web')->user();

        $validated = $request->validate([
            'pref_domain'         => 'nullable|in:logement,infrastructure-pro,enseignement',
            'nexus_domain'        => 'nullable|in:logement,infrastructure-pro,enseignement',
            'pref_specialization' => 'nullable|string|max:100',
            'pref_country'        => 'nullable|string|size:2',
            'pref_available_from' => 'nullable|date',
            'pref_available_to'   => 'nullable|date|after_or_equal:pref_available_from',
            'pref_duration'       => 'nullable|in:week,2weeks,month,quarter,semester,year',
            'pref_capacity'       => 'nullable|in:1,2,3,4,5+',
            'pref_notes'          => 'nullable|string|max:1000',
        ]);

        // Stocke les préférences en session (fallback sécurisé si la colonne n'existe pas encore)
        $existing = session('nexus_preferences', []);
        $merged   = array_merge($existing, array_filter($validated, fn($v) => !is_null($v)));
        session(['nexus_preferences' => $merged]);

        // Si la colonne nexus_preferences existe sur le modèle, on persiste aussi en base
        if (in_array('nexus_preferences', $user->getFillable()) ||
            \Illuminate\Support\Facades\Schema::hasColumn('users', 'nexus_preferences')) {
            $user->nexus_preferences = json_encode($merged);
            $user->save();
        }

        return redirect()->route('nexus.dashboard', ['tab' => 'search'])
            ->with('success', 'Vos préférences de recherche ont été enregistrées.');
    }

    /**
     * Sauvegarde les paramètres de l'offre NEXUS de l'utilisateur (ce qu'il propose à l'échange).
     * Appelé depuis le panneau "Mon Offre NEXUS" de l'onglet Profil (GET car form homeswap-filters).
     */
    public function saveOffer(Request $request)
    {
        $offer = $request->except(['_token', 'page']);

        // Persistance en session
        session(['nexus_offer' => $offer]);

        // Persistance BDD — cast 'array' sur le modèle, ne pas json_encode()
        $user = Auth::guard('web')->user();
        if ($user && Schema::hasColumn('users', 'nexus_offer')) {
            $user->nexus_offer = $offer;  // Laravel gère l'encodage JSON via le cast
            $user->save();
        }

        return redirect()->route('nexus.dashboard', ['tab' => 'search'])
            ->with('success', 'Votre offre NEXUS a été enregistrée. Elle est maintenant visible dans la recherche miroir.');
    }
}
