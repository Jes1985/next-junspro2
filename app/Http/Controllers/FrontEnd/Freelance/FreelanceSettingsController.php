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

