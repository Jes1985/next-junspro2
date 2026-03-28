<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\MentorshipSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Price;

class MentorshipSubscriptionController extends Controller
{
    /**
     * Page de présentation des plans d'abonnement mentorat.
     */
    public function index(Request $request)
    {
        $plans = $this->buildPlans();

        $activeSubscription = null;
        if ($user = Auth::guard('web')->user()) {
            $activeSubscription = MentorshipSubscription::where('user_id', $user->id)
                ->where('status', 'active')
                ->latest('id')
                ->first();
        }

        return view('frontend.mentorship.subscription', compact('plans', 'activeSubscription'));
    }

    /**
     * Démarre la session Stripe Checkout pour un plan donné.
     */
    public function subscribe(Request $request)
    {
        $request->validate([
            'plan_key' => 'required|in:cycle_1,cycle_2,cycle_4',
        ]);

        $user    = Auth::guard('web')->user();
        $planKey = $request->plan_key;
        $priceId = config("mentorship.stripe_prices.{$planKey}");

        if (! $priceId) {
            return back()->withErrors(['error' => "Le prix Stripe pour ce plan n'est pas encore configuré. Contactez le support."]);
        }

        // Idempotence : empêcher une double souscription active
        $existing = MentorshipSubscription::where('user_id', $user->id)
            ->whereIn('status', ['active', 'pending'])
            ->latest('id')
            ->first();

        if ($existing && $existing->status === 'active') {
            return redirect()->route('mentorship.subscription.index')
                ->with('info', 'Vous avez déjà un abonnement mentorat actif.');
        }

        // Réutiliser un pending si session Stripe encore ouverte
        if ($existing && $existing->stripe_checkout_session_id) {
            try {
                Stripe::setApiKey(config('services.stripe.secret'));
                $stripeSession = StripeSession::retrieve($existing->stripe_checkout_session_id);
                if ($stripeSession->status === 'open') {
                    return redirect($stripeSession->url);
                }
            } catch (\Exception) {
                // session expirée, on en crée une nouvelle
            }
        }

        // Créer l'enregistrement en base avec statut pending
        $sub = MentorshipSubscription::create([
            'user_id'  => $user->id,
            'plan_key' => $planKey,
            'status'   => 'pending',
        ]);

        try {
            Stripe::setApiKey(config('services.stripe.secret'));

            $planPrice = config("mentorship.plan_prices.{$planKey}");

            $session = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price'    => $priceId,
                    'quantity' => 1,
                ]],
                'mode'        => 'subscription',
                'success_url' => route('mentorship.subscription.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url'  => route('mentorship.subscription.cancel'),
                'customer_email' => $user->email_address ?? null,
                'metadata' => [
                    'type'           => 'mentorship_subscription',
                    'mentorship_sub_id' => $sub->id,
                    'plan_key'       => $planKey,
                    'user_id'        => $user->id,
                ],
            ]);

            $sub->update(['stripe_checkout_session_id' => $session->id]);

            Log::info('Mentorship Stripe session created', [
                'session_id' => $session->id,
                'plan_key'   => $planKey,
                'user_id'    => $user->id,
            ]);

            return redirect($session->url);

        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $sub->delete();
            Log::error('Mentorship Stripe error', ['error' => $e->getMessage(), 'plan_key' => $planKey]);

            $msg = str_contains($e->getMessage(), 'No such price')
                ? 'Prix Stripe introuvable. Veuillez contacter le support.'
                : 'Erreur Stripe : ' . $e->getMessage();

            return back()->withErrors(['error' => $msg]);
        } catch (\Exception $e) {
            $sub->delete();
            Log::error('Mentorship subscription checkout error', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Une erreur est survenue. Veuillez réessayer.']);
        }
    }

    /**
     * Page de confirmation après paiement réussi.
     */
    public function success(Request $request)
    {
        $user = Auth::guard('web')->user();

        $subscription = MentorshipSubscription::where('user_id', $user->id)
            ->whereIn('status', ['active', 'pending'])
            ->latest('id')
            ->first();

        return view('frontend.mentorship.subscription-success', compact('subscription'));
    }

    /**
     * Page d'annulation du checkout Stripe.
     */
    public function cancel(Request $request)
    {
        // Nettoyer le pending si l'utilisateur annule
        if ($user = Auth::guard('web')->user()) {
            MentorshipSubscription::where('user_id', $user->id)
                ->where('status', 'pending')
                ->delete();
        }

        return redirect()->route('mentorship.subscription.index')
            ->with('info', 'Souscription annulée. Vous pouvez recommencer quand vous voulez.');
    }

    /**
     * Annuler l'abonnement actif depuis le tableau de bord.
     */
    public function cancelSubscription(Request $request)
    {
        $user = Auth::guard('web')->user();

        $sub = MentorshipSubscription::where('user_id', $user->id)
            ->where('status', 'active')
            ->latest('id')
            ->firstOrFail();

        // Annuler sur Stripe (fin de période en cours, pas immédiat)
        if ($sub->stripe_subscription_id) {
            try {
                Stripe::setApiKey(config('services.stripe.secret'));
                \Stripe\Subscription::update($sub->stripe_subscription_id, [
                    'cancel_at_period_end' => true,
                ]);
            } catch (\Exception $e) {
                Log::error('Mentorship cancel Stripe error', ['error' => $e->getMessage()]);
            }
        }

        $sub->update([
            'cancelled_at' => now(),
            'status'       => 'cancelled',
        ]);

        return back()->with('success', 'Votre abonnement mentorat a été annulé. Vous conservez l\'accès jusqu\'à la fin du cycle en cours.');
    }

    // ─── Helpers ─────────────────────────────────────────────────────────────

    private function buildPlans(): array
    {
        $plans = [];
        foreach (['cycle_1', 'cycle_2', 'cycle_4'] as $key) {
            $plans[] = [
                'key'         => $key,
                'name'        => config("mentorship.plan_names.{$key}"),
                'description' => config("mentorship.plan_descriptions.{$key}"),
                'price'       => config("mentorship.plan_prices.{$key}"),
                'cycles'      => config("mentorship.plan_cycles.{$key}"),
                'savings'     => config("mentorship.plan_savings.{$key}"),
                'features'    => config("mentorship.plan_features.{$key}"),
                'popular'     => config('mentorship.popular_plan') === $key,
            ];
        }
        return $plans;
    }
}
