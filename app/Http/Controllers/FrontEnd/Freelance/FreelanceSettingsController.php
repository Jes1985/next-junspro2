<?php

namespace App\Http\Controllers\FrontEnd\Freelance;

use App\Http\Controllers\Controller;
use App\Models\FreelancerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FreelanceSettingsController extends Controller
{
    /**
     * Page principale des paramètres freelance
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
                ->with('error', __('Vous devez compléter votre profil freelance pour accéder aux paramètres.'));
        }

        return view('frontend.freelance.settings.index', [
            'user' => $user,
            'freelancerProfile' => $freelancerProfile,
        ]);
    }

    /**
     * Identité professionnelle
     */
    public function identity()
    {
        $user = Auth::guard('web')->user();
        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();

        $hubConfig = config('services_universes', []);
        $hubUniversesList = $hubConfig['universes'] ?? [];
        $hubDomainsByUniverse = $hubConfig['domains_by_universe'] ?? [];
        $hubUniverses = collect($hubUniversesList)->map(fn ($label, $slug) => ['slug' => $slug, 'label' => $label])->values()->all();
        $hubUniverseDomains = $hubDomainsByUniverse;

        return view('frontend.freelance.settings.identity', [
            'user' => $user,
            'freelancerProfile' => $freelancerProfile,
            'hubUniverses' => $hubUniverses,
            'hubUniverseDomains' => $hubUniverseDomains,
        ]);
    }

    /**
     * Sécurité
     */
    public function security()
    {
        $user = Auth::guard('web')->user();
        
        return view('frontend.freelance.settings.security', [
            'user' => $user,
        ]);
    }

    /**
     * Adresse e-mail
     */
    public function email()
    {
        $user = Auth::guard('web')->user();
        
        return view('frontend.freelance.settings.email', [
            'user' => $user,
        ]);
    }

    /**
     * Versements
     */
    public function payouts()
    {
        $user = Auth::guard('web')->user();
        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        return view('frontend.freelance.settings.payouts', [
            'user' => $user,
            'freelancerProfile' => $freelancerProfile,
        ]);
    }

    /**
     * Sauvegarder les coordonnées bancaires (international)
     */
    public function storePayouts(Request $request)
    {
        $user = Auth::guard('web')->user();
        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();

        if (!$freelancerProfile) {
            return redirect()->back()->with('error', 'Profil freelance introuvable.');
        }

        $request->validate([
            'bank_country'         => 'required|string|size:2',
            'bank_account_holder'  => 'required|string|min:2|max:255',
            'bank_iban'            => 'nullable|string|max:100',
            'bank_routing'         => 'nullable|string|max:60',
            'bank_type'            => 'nullable|string|max:20',
        ]);

        $data = [
            'bank_country'        => strtoupper($request->input('bank_country')),
            'bank_account_holder' => $request->input('bank_account_holder'),
            'bank_type'           => $request->input('bank_type'),
        ];

        // IBAN : stocker sans espaces, majuscules
        if ($request->filled('bank_iban')) {
            $data['bank_iban'] = strtoupper(str_replace(' ', '', $request->input('bank_iban')));
        }

        // Routing number / Sort code / BSB / IFSC…
        if ($request->filled('bank_routing')) {
            $data['bank_routing'] = strtoupper(str_replace([' ', '-'], '', $request->input('bank_routing')));
        }

        if (\Illuminate\Support\Facades\Schema::hasColumn('freelancer_profiles', 'bank_country')) {
            $freelancerProfile->update($data);
        } else {
            // Colonne absente (migration non lancée) : sauver uniquement les champs existants
            $freelancerProfile->update(array_intersect_key($data, array_flip(['bank_iban', 'bank_account_holder'])));
        }

        return redirect()->back()->with('success', 'Vos coordonnées bancaires ont été enregistrées avec succès.');
    }

    /**
     * Notifications
     */
    public function notifications()
    {
        $user = Auth::guard('web')->user();
        
        return view('frontend.freelance.settings.notifications', [
            'user' => $user,
        ]);
    }

    /**
     * Vidéo de présentation
     */
    public function video()
    {
        $user = Auth::guard('web')->user();
        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->route('freelance.dashboard', ['tab' => 'settings'])
                ->with('error', __('Vous devez compléter votre profil freelance.'));
        }
        
        return view('frontend.freelance.settings.video', [
            'user' => $user,
            'freelancerProfile' => $freelancerProfile,
        ]);
    }

    /**
     * Mettre à jour la vidéo de présentation
     */
    public function updateVideo(Request $request)
    {
        $user = Auth::guard('web')->user();
        $freelancerProfile = FreelancerProfile::where('user_id', $user->id)->first();
        
        if (!$freelancerProfile) {
            return redirect()->back()
                ->with('error', __('Profil freelance non trouvé.'));
        }
        
        $request->validate([
            'video_url' => 'nullable|url|max:500',
        ], [
            'video_url.url' => __('L\'URL de la vidéo doit être valide.'),
            'video_url.max' => __('L\'URL de la vidéo ne doit pas dépasser 500 caractères.'),
        ]);
        
        $freelancerProfile->video_url = $request->video_url;
        $freelancerProfile->save();
        
        return redirect()->route('freelance.settings.video')
            ->with('success', __('Vidéo de présentation mise à jour avec succès.'));
    }

    /**
     * Connexions & autorisations
     */
    public function integrations()
    {
        $user = Auth::guard('web')->user();
        
        return view('frontend.freelance.settings.integrations', [
            'user' => $user,
        ]);
    }

    /**
     * Fermer le compte
     */
    public function close()
    {
        $user = Auth::guard('web')->user();
        
        return view('frontend.freelance.settings.close', [
            'user' => $user,
        ]);
    }
}

