<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontEnd\MiscellaneousController;
use App\Models\Affiliate;
use App\Services\Junspro\AffiliateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AffiliateController extends Controller
{
    protected AffiliateService $affiliateService;
    protected MiscellaneousController $miscController;

    public function __construct(AffiliateService $affiliateService, MiscellaneousController $miscController)
    {
        $this->affiliateService = $affiliateService;
        $this->miscController   = $miscController;
    }

    // =========================================================
    // PAGE PUBLIQUE — Landing apporteurs d'affaires
    // =========================================================

    public function landing()
    {
        $misc        = $this->miscController;
        $queryResult = [
            'breadcrumb' => $misc->getBreadcrumb(),
            'language'   => $misc->getLanguage(),
        ];

        $user      = Auth::guard('web')->user();
        $affiliate = $user ? Affiliate::where('user_id', $user->id)->first() : null;

        return view('frontend.affiliate.landing', array_merge($queryResult, [
            'tiers'     => Affiliate::TIERS,
            'user'      => $user,
            'affiliate' => $affiliate,
        ]));
    }

    // =========================================================
    // DASHBOARD PRIVÉ — Mon espace apporteur
    // =========================================================

    public function dashboard(Request $request)
    {
        $user = Auth::guard('web')->user();

        if (!$user) {
            Session::put('redirectTo', route('affiliate.dashboard'));
            return redirect()->route('user.login');
        }

        $affiliate = Affiliate::where('user_id', $user->id)->first();

        // Si pas encore inscrit → rediriger vers la landing avec CTA
        if (!$affiliate) {
            return redirect()->route('affiliate.landing')
                ->with('info', 'Rejoignez le programme Apporteurs d\'Affaires JunsPro pour accéder à votre espace.');
        }

        $stats       = $this->affiliateService->getStats($affiliate);
        $status      = $request->get('status', 'all');
        $conversions = $this->affiliateService->getConversions($affiliate, $status);

        $misc        = $this->miscController;
        $queryResult = [
            'breadcrumb' => $misc->getBreadcrumb(),
            'language'   => $misc->getLanguage(),
        ];

        return view('frontend.affiliate.dashboard', array_merge($queryResult, [
            'user'        => $user,
            'affiliate'   => $affiliate,
            'stats'       => $stats,
            'conversions' => $conversions,
            'status'      => $status,
            'tiers'       => Affiliate::TIERS,
        ]));
    }

    // =========================================================
    // INSCRIPTION AU PROGRAMME
    // =========================================================

    public function register(Request $request)
    {
        $user = Auth::guard('web')->user();

        if (!$user) {
            return redirect()->route('user.login');
        }

        // Vérifier si déjà inscrit
        $existing = Affiliate::where('user_id', $user->id)->first();
        if ($existing) {
            return redirect()->route('affiliate.dashboard');
        }

        $affiliate = $this->affiliateService->getOrCreateAffiliate($user);

        // Auto-activation (peut être changé en validation manuelle si besoin)
        $this->affiliateService->activate($affiliate);

        return redirect()->route('affiliate.dashboard')
            ->with('success', '🎉 Bienvenue dans le programme Apporteurs d\'Affaires JunsPro ! Votre lien de parrainage est prêt.');
    }

    // =========================================================
    // TRACKING — /a/{code} (JunsPro générique, cookie 30j)
    // =========================================================

    public function track(Request $request, string $code)
    {
        $affiliate = $this->affiliateService->resolveCode($code);

        if (!$affiliate) {
            return redirect()->route('user.signup');
        }

        Cookie::queue('affiliate_code', $code, 60 * 24 * 30);
        Session::put('affiliate_code', $code);

        return redirect()->route('user.signup')
            ->with('success', 'Vous avez été invité par un membre JunsPro — profitez d\'une expérience premium dès votre inscription.');
    }

    // =========================================================
    // API — Coordonnées bancaires
    // =========================================================

    public function updateBankInfo(Request $request)
    {
        $user = Auth::guard('web')->user();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Non authentifié.'], 401);
        }

        $affiliate = Affiliate::where('user_id', $user->id)->first();

        if (!$affiliate) {
            return response()->json(['success' => false, 'message' => 'Profil apporteur introuvable.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'account_holder' => 'required|string|max:150',
            'iban'           => ['required', 'string', 'max:50', 'regex:/^[A-Z]{2}\d{2}[A-Z0-9]{1,30}$/'],
            'bic'            => ['required', 'string', 'max:15', 'regex:/^[A-Z]{6}[A-Z0-9]{2,5}$/'],
            'bank_name'      => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $affiliate->update([
            'account_holder' => $request->account_holder,
            'iban'           => strtoupper(str_replace(' ', '', $request->iban)),
            'bic'            => strtoupper($request->bic),
            'bank_name'      => $request->bank_name,
        ]);

        return response()->json(['success' => true, 'message' => 'Coordonnées bancaires enregistrées.']);
    }

    // =========================================================
    // API — Copier le lien de tracking
    // =========================================================

    public function copyLink(Request $request)
    {
        $user = Auth::guard('web')->user();

        if (!$user) {
            return response()->json(['success' => false], 401);
        }

        $affiliate = Affiliate::where('user_id', $user->id)->first();

        if (!$affiliate) {
            return response()->json(['success' => false], 404);
        }

        return response()->json([
            'success' => true,
            'link'    => $affiliate->tracking_link,
        ]);
    }
}
