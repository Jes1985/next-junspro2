<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontEnd\MiscellaneousController;
use App\Models\FormationEnrollment;
use App\Models\PsAmbassadeur;
use App\Models\PsTestimonial;
use App\Services\PsAmbassadeurService;
use Illuminate\Http\Request;
use App\Mail\PsWelcomeMail;
use App\Mail\PsShareInviteMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PsAmbassadeurController extends Controller
{
    protected PsAmbassadeurService $psService;
    protected MiscellaneousController $miscController;

    public function __construct(PsAmbassadeurService $psService, MiscellaneousController $miscController)
    {
        $this->psService      = $psService;
        $this->miscController = $miscController;
    }

    // =========================================================
    // PAGE PUBLIQUE — Landing Ambassadeurs Pause Souffle
    // =========================================================

    public function landing(Request $request)
    {
        $misc        = $this->miscController;
        $user        = Auth::guard('web')->user();
        $ambassadeur = $user ? PsAmbassadeur::where('user_id', $user->id)->first() : null;
        $psStats     = $ambassadeur ? $this->psService->getStats($ambassadeur) : null;

        // MODE PREVIEW (local uniquement) — ?preview=1
        if ($request->get('preview') === '1' && config('app.env') === 'local') {
            $fakeUser            = new \App\Models\User(['name' => 'Younes Preview', 'email' => 'preview@pausesouffle.fr']);
            $fakeAmbassadeur     = new PsAmbassadeur(['code' => 'ps_preview7', 'status' => 'active', 'tier' => 'partenaire', 'total_earned' => 1695, 'pending_payout' => 372]);
            $fakeAmbassadeur->id = 0;
            $psStats = [
                'clicks_count'    => 47,
                'sales_count'     => 7,
                'validated_amt'   => 1695,
                'pending_amt'     => 372,
                'pending_count'   => 1,
                'referrals_count' => 7,
                'conversion_rate' => 14.9,
                'tier'            => 'partenaire',
                'tier_label'      => 'Ambassadeur Partenaire',
                'tier_icon'       => '✦✦',
                'next_tier'       => 'ambassadeur',
                'next_tier_label' => 'Ambassadeur',
                'next_min'        => 15,
                'progress'        => 46,
                'tracking_link'   => url('/ps/ps_preview7'),
            ];
            $leaderboard  = collect();
            $testimonials = collect();
            return view('frontend.affiliate.pause-ambassadeur', [
                'breadcrumb'   => $misc->getBreadcrumb(),
                'language'     => $misc->getLanguage(),
                'user'         => $fakeUser,
                'ambassadeur'  => $fakeAmbassadeur,
                'psStats'      => $psStats,
                'psTiers'      => PsAmbassadeur::TIERS,
                'hasAffiliate' => true,
                'isLoggedIn'   => true,
                'leaderboard'  => $leaderboard,
                'testimonials' => $testimonials,
            ]);
        }

        // Top ambassadeurs (anonymisés, prénom uniquement)
        $leaderboard = PsAmbassadeur::where('status', 'active')
            ->where('total_earned', '>', 0)
            ->orderByDesc('total_earned')
            ->limit(5)
            ->with('user')
            ->get();

        // Témoignages publiés par l'admin via Nova
        $testimonials = PsTestimonial::published()
            ->orderBy('sort_order')
            ->orderByDesc('highlight')
            ->limit(6)
            ->get();

        return view('frontend.affiliate.pause-ambassadeur', [
            'breadcrumb'   => $misc->getBreadcrumb(),
            'language'     => $misc->getLanguage(),
            'user'         => $user,
            'ambassadeur'  => $ambassadeur,
            'psStats'      => $psStats,
            'psTiers'      => PsAmbassadeur::TIERS,
            'leaderboard'  => $leaderboard,
            'testimonials' => $testimonials,
        ]);
    }

    // =========================================================
    // INSCRIPTION AU RÉSEAU AMBASSADEUR PS
    // =========================================================

    public function register(Request $request)
    {
        $user = Auth::guard('web')->user();

        if (!$user) {
            Session::put('redirectTo', route('presence.ambassadeurs'));
            return redirect()->route('user.login');
        }

        $existing = PsAmbassadeur::where('user_id', $user->id)->first();
        if ($existing) {
            return redirect()->route('presence.ambassadeurs')
                ->with('success', 'Vous êtes déjà inscrit au réseau des Ambassadeurs Pause Souffle.');
        }

        // Condition obligatoire : avoir suivi le Parcours Pause Souffle
        $hasEnrollment = FormationEnrollment::where('user_id', $user->id)
            ->whereIn('status', ['active', 'completed'])
            ->exists();

        if (!$hasEnrollment) {
            return redirect()->route('presence.ambassadeurs')
                ->with('error', 'Pour rejoindre le Réseau des Ambassadeurs Pause Souffle, vous devez d\'abord avoir suivi le Parcours Pause Souffle. C\'est la condition fondamentale : on ne partage que ce qu\'on a vécu.');
        }

        // Valider les champs du formulaire d'inscription
        $validated = Validator::make($request->all(), [
            'phone'      => ['nullable', 'string', 'max:30'],
            'motivation' => ['nullable', 'string', 'max:1000'],
        ])->validate();

        $ambassadeur = $this->psService->getOrCreate($user);

        // Stocker les infos d'inscription si fournies
        if (!empty($validated['phone']) || !empty($validated['motivation'])) {
            $ambassadeur->update([
                'phone'      => $validated['phone'] ?? null,
                'motivation' => $validated['motivation'] ?? null,
            ]);
        }

        // Email de bienvenue avec le kit ambassadeur
        try {
            Mail::to($user->email)->send(new PsWelcomeMail($user, $ambassadeur));
        } catch (\Throwable $e) {
            // Ne pas bloquer l'inscription si l'email échoue
            \Illuminate\Support\Facades\Log::warning('PsWelcomeMail failed: ' . $e->getMessage());
        }

        return redirect()->route('presence.ambassadeurs')
            ->with('success', '✦ Bienvenue dans le Réseau des Ambassadeurs Pause Souffle ! Votre lien unique est prêt. Un email de bienvenue avec votre kit vous a été envoyé.');
    }

    // =========================================================
    // TRACKING — /ps/{code} — Cookie 90 jours
    // =========================================================

    public function track(Request $request, string $code)
    {
        $ambassadeur = $this->psService->resolveCode($code);

        if (!$ambassadeur) {
            return redirect()->route('presence.parcours');
        }

        // Cookie dédié PS — n'interfère pas avec affiliate_code JunsPro
        Cookie::queue('ps_ambassador_code', $code, 60 * 24 * 90);
        Session::put('ps_ambassador_code', $code);

        // Tracker le clic (IP hashée, RGPD)
        $this->psService->recordClick(
            $ambassadeur,
            $request->ip(),
            $request->headers->get('referer')
        );

        return redirect()->route('presence.parcours')
            ->with('success', 'Vous avez été invité par un Ambassadeur Pause Souffle — bienvenue dans l\'Univers Présence.');
    }

    // =========================================================
    // PAGE RESSOURCES AMBASSADEUR (auth requis + profil actif)
    // =========================================================

    public function ressources(Request $request)
    {
        $misc = $this->miscController;

        // MODE PREVIEW (local uniquement) — ?preview=1
        if ($request->get('preview') === '1' && config('app.env') === 'local') {
            $fakeUser            = new \App\Models\User(['name' => 'Younes Preview', 'email' => 'preview@pausesouffle.fr']);
            $fakeAmbassadeur     = new PsAmbassadeur(['code' => 'ps_preview7', 'status' => 'active', 'tier' => 'partenaire']);
            $fakeAmbassadeur->id = 0;
            return view('frontend.affiliate.pause-ambassadeur-ressources', [
                'breadcrumb'  => $misc->getBreadcrumb(),
                'language'    => $misc->getLanguage(),
                'user'        => $fakeUser,
                'ambassadeur' => $fakeAmbassadeur,
            ]);
        }

        $user        = Auth::guard('web')->user();
        $ambassadeur = PsAmbassadeur::where('user_id', $user->id)
            ->where('status', 'active')
            ->first();

        if (!$ambassadeur) {
            return redirect()->route('presence.ambassadeurs')
                ->with('error', 'Accès réservé aux Ambassadeurs Pause Souffle actifs.');
        }

        return view('frontend.affiliate.pause-ambassadeur-ressources', [
            'breadcrumb'  => $misc->getBreadcrumb(),
            'language'    => $misc->getLanguage(),
            'user'        => $user,
            'ambassadeur' => $ambassadeur,
        ]);
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

        $ambassadeur = PsAmbassadeur::where('user_id', $user->id)->first();

        if (!$ambassadeur) {
            return response()->json(['success' => false, 'message' => 'Profil ambassadeur introuvable.'], 404);
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

        $ambassadeur->update([
            'account_holder' => $request->account_holder,
            'iban'           => strtoupper(str_replace(' ', '', $request->iban)),
            'bic'            => strtoupper($request->bic),
            'bank_name'      => $request->bank_name,
        ]);

        return response()->json(['success' => true, 'message' => 'Coordonnées bancaires enregistrées.']);
    }

    // =========================================================
    // API — Envoi des 3 invitations directes
    // =========================================================

    public function sendInvitations(Request $request)
    {
        $user = Auth::guard('web')->user();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Non authentifié.'], 401);
        }

        $ambassadeur = PsAmbassadeur::where('user_id', $user->id)
            ->where('status', 'active')
            ->first();

        if (!$ambassadeur) {
            return response()->json(['success' => false, 'message' => 'Profil ambassadeur introuvable.'], 403);
        }

        // Rate limit : 3 envois max par heure par ambassadeur
        $rateLimitKey = 'ps-invitations:' . $user->id;
        if (RateLimiter::tooManyAttempts($rateLimitKey, 3)) {
            return response()->json([
                'success' => false,
                'message' => 'Vous avez déjà envoyé vos invitations. Réessayez dans ' . RateLimiter::availableIn($rateLimitKey) . ' secondes.',
            ], 429);
        }

        $validated = $request->validate([
            'contacts'            => 'required|array|min:1|max:3',
            'contacts.*.email'    => 'required_with:contacts.*.name|nullable|email|max:255',
            'contacts.*.name'     => 'nullable|string|max:100',
            'message'             => 'nullable|string|max:1000',
        ]);

        $contacts = collect($validated['contacts'])->filter(fn($c) => !empty($c['email']));
        if ($contacts->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Aucun contact valide.'], 422);
        }

        $senderFirstName = $user->first_name
            ?? explode(' ', trim($user->name ?? ''))[0]
            ?? 'Un ami';

        $personalMessage = $validated['message']
            ?? "J'ai découvert quelque chose qui m'a vraiment aidé à retrouver de la clarté. Ça s'appelle Pause Souffle.";

        $ambassadorLink = url('/ps/' . $ambassadeur->code);
        $sent = 0;

        foreach ($contacts as $contact) {
            $recipientName = $contact['name'] ?? 'vous';
            try {
                Mail::to($contact['email'])
                    ->queue(new PsShareInviteMail(
                        recipientFirstName: $recipientName,
                        senderFirstName:    $senderFirstName,
                        senderMessage:      $personalMessage,
                        ambassadorLink:     $ambassadorLink,
                    ));
                $sent++;
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::warning('Erreur envoi invitation PS', [
                    'email' => $contact['email'],
                    'error' => $e->getMessage(),
                ]);
            }
        }

        RateLimiter::hit($rateLimitKey, 3600);

        return response()->json([
            'success' => true,
            'sent'    => $sent,
            'message' => "{$sent} invitation(s) envoyée(s) avec succès.",
        ]);
    }
}
