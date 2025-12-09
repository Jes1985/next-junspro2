<?php

namespace App\Jobs;

use App\Models\NotificationLog;
use App\Models\Subscription;
use App\Models\WorkSession;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ProcessSubscriptionReminders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Rappel livraisons hebdo freelances
        $this->remindFreelancersAboutDeliveries();

        // Rappel validation livraisons clients
        $this->remindClientsAboutValidation();
    }

    /**
     * Rappeler aux freelances de faire leurs livraisons hebdomadaires
     */
    protected function remindFreelancersAboutDeliveries(): void
    {
        $activeSubscriptions = Subscription::where('status', 'active')
            ->with(['freelancer.user', 'workSessions'])
            ->get();

        foreach ($activeSubscriptions as $subscription) {
            // Vérifier si aucune WorkSession depuis 7 jours
            $lastSession = WorkSession::where('subscription_id', $subscription->id)
                ->where('status', 'delivered')
                ->orderBy('start_at', 'desc')
                ->first();

            if (!$lastSession || $lastSession->start_at->lt(Carbon::now()->subDays(7))) {
                // Notifier le freelance
                $freelancerUser = $subscription->freelancer->user ?? null;
                if ($freelancerUser) {
                    NotificationLog::create([
                        'user_id' => $freelancerUser->id,
                        'channel' => 'email',
                        'type' => 'delivery_reminder',
                        'content' => json_encode([
                            'subscription_id' => $subscription->id,
                            'client_name' => $subscription->client->user->name ?? 'Client',
                            'message' => 'Vous n\'avez pas enregistré de session depuis 7 jours.',
                        ]),
                        'sent_at' => now(),
                    ]);
                }

                Log::info('Reminder sent to freelancer for weekly delivery', [
                    'freelancer_id' => $subscription->freelancer_id,
                    'subscription_id' => $subscription->id,
                ]);
            }
        }
    }

    /**
     * Rappeler aux clients de valider les livraisons
     */
    protected function remindClientsAboutValidation(): void
    {
        $deliveredSessions = WorkSession::where('status', 'delivered')
            ->where('start_at', '>=', Carbon::now()->subWeeks(2))
            ->with(['subscription.client.user'])
            ->get();

        foreach ($deliveredSessions as $session) {
            // Si livré depuis > 7 jours sans validation
            if ($session->start_at->lt(Carbon::now()->subDays(7))) {
                $clientUser = $session->subscription->client->user ?? null;
                if ($clientUser) {
                    NotificationLog::create([
                        'user_id' => $clientUser->id,
                        'channel' => 'email',
                        'type' => 'validation_reminder',
                        'content' => json_encode([
                            'work_session_id' => $session->id,
                            'subscription_id' => $session->subscription_id,
                            'message' => 'Une livraison attend votre validation depuis plus de 7 jours.',
                        ]),
                        'sent_at' => now(),
                    ]);
                }

                Log::info('Reminder sent to client to validate delivery', [
                    'client_id' => $session->subscription->client_id,
                    'work_session_id' => $session->id,
                ]);
            }
        }
    }
}
