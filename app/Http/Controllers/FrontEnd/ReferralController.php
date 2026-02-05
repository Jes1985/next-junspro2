<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontEnd\MiscellaneousController;
use App\Services\Junspro\ReferralService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class ReferralController extends Controller
{
    protected $referralService;
    protected $miscController;

    public function __construct(ReferralService $referralService, MiscellaneousController $miscController)
    {
        $this->referralService = $referralService;
        $this->miscController = $miscController;
    }

    /**
     * Page principale du parrainage
     */
    public function index(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return redirect()->route('user.login');
        }

        // Générer le code s'il n'existe pas
        $referralCode = $this->referralService->getOrCreateReferralCode($user);
        
        // Statistiques
        $stats = $this->referralService->getReferralStats($user);
        
        // Liste des parrainages
        $status = $request->get('status', 'all');
        $referrals = $this->referralService->getReferralsList($user, $status);

        // Vérifier si on doit ouvrir la modale
        $openInvite = $request->has('openInvite') || $request->has('invite');

        $misc = $this->miscController;
        $language = $misc->getLanguage();
        $queryResult = [
            'breadcrumb' => $misc->getBreadcrumb(),
            'language' => $language,
            // basicInfo, websiteInfo et currentLanguageInfo sont déjà partagés via View::composer dans AppServiceProvider
        ];

        return view('frontend.referral.index', array_merge($queryResult, [
            'user' => $user,
            'referralCode' => $referralCode,
            'stats' => $stats,
            'referrals' => $referrals,
            'status' => $status,
            'openInvite' => $openInvite,
            'config' => [
                'min_eligible_amount' => ReferralService::MIN_ELIGIBLE_AMOUNT,
                'reward_amount' => ReferralService::REWARD_AMOUNT,
                'benefit_label' => ReferralService::BENEFIT_LABEL,
                'cooldown_hours' => ReferralService::COOLDOWN_HOURS,
                'monthly_cap' => ReferralService::MONTHLY_CAP,
            ],
        ]));
    }

    /**
     * Page des conditions du parrainage (publique)
     */
    public function conditions()
    {
        $misc = $this->miscController;
        $language = $misc->getLanguage();
        $queryResult = [
            'breadcrumb' => $misc->getBreadcrumb(),
            'language' => $language,
            // basicInfo, websiteInfo et currentLanguageInfo sont déjà partagés via View::composer dans AppServiceProvider
        ];

        return view('frontend.referral.conditions', array_merge($queryResult, [
            'config' => [
                'min_eligible_amount' => ReferralService::MIN_ELIGIBLE_AMOUNT,
                'reward_amount' => ReferralService::REWARD_AMOUNT,
                'benefit_label' => ReferralService::BENEFIT_LABEL,
                'cooldown_hours' => ReferralService::COOLDOWN_HOURS,
                'monthly_cap' => ReferralService::MONTHLY_CAP,
            ],
        ]));
    }

    /**
     * Route de tracking /r/{code}
     */
    public function track(Request $request, string $code)
    {
        $user = \App\Models\User::where('referral_code', $code)->first();

        if (!$user) {
            // Code invalide, rediriger vers signup sans cookie
            return redirect()->route('user.signup')->with('error', __('Code de parrainage invalide.'));
        }

        // Définir le cookie de parrainage (valide 30 jours)
        Cookie::queue('referral_code', $code, 60 * 24 * 30);

        // Rediriger vers la page d'inscription
        return redirect()->route('user.signup')->with('success', __('Code de parrainage appliqué ! Vous bénéficierez de :benefit_label sur votre première réservation.', [
            'benefit_label' => ReferralService::BENEFIT_LABEL,
        ]));
    }

    /**
     * API: Copier le lien de parrainage
     */
    public function copyLink(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return response()->json(['ok' => false, 'message' => __('Non autorisé.')], 401);
        }

        $referralCode = $this->referralService->getOrCreateReferralCode($user);
        $link = route('referral.track', ['code' => $referralCode]);

        return response()->json([
            'ok' => true,
            'link' => $link,
            'message' => __('Lien copié avec succès !'),
        ]);
    }

    /**
     * API: Envoyer des invitations par email
     */
    public function sendInvitations(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return response()->json(['ok' => false, 'message' => __('Non autorisé.')], 401);
        }

        $request->validate([
            'emails' => 'required|array|min:1|max:10',
            'emails.*' => 'required|email',
        ]);

        $referralCode = $this->referralService->getOrCreateReferralCode($user);
        $link = route('referral.track', ['code' => $referralCode]);

        // TODO: Envoyer les emails d'invitation
        // Pour l'instant, on retourne juste un succès

        return response()->json([
            'ok' => true,
            'message' => __('Invitations envoyées avec succès !'),
        ]);
    }

    /**
     * API: Recommander son entreprise
     */
    public function recommendCompany(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            return response()->json(['ok' => false, 'message' => __('Non autorisé.')], 401);
        }

        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_email' => 'required|email|max:255',
            'message' => 'nullable|string|max:1000',
        ]);

        // TODO: Envoyer l'email de recommandation entreprise
        // Pour l'instant, on retourne juste un succès

        return response()->json([
            'ok' => true,
            'message' => __('Votre recommandation a été envoyée. Nous vous répondrons sous 48h ouvrées.'),
        ]);
    }
}

