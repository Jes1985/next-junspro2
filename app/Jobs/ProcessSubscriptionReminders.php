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
            ->with(['freelancer.user'])
            ->get();

        foreach ($activeSubscriptions as $subscription) {
            // Vérifier si aucune WorkSession depuis 7 jours
            $lastSession = WorkSession::where('subscription_id', $subscription->id)
                ->orderByDesc('work_date')
                ->first();

            if (!$lastSession || $lastSession->work_date < now()->subDays(7)) {
                // Notifier le freelance
                $freelancerUser = $subscription->freelancer->user ?? null;
                if ($freelancerUser) {
                    NotificationLog::create([
                        'user_id' => $freelancerUser->id,
                        'channel' => 'email',
                        'type' => 'reminder_weekly_delivery',
                        'content' => json_encode([
                            'subscription_id' => $subscription->id,
                            'client_name' => $subscription->client->user->name ?? 'N/A',
                            'hours_per_week' => $subscription->hours_per_week,
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
        $pendingSessions = WorkSession::where('status', 'delivered')
            ->where('created_at', '<', now()->subDays(7))
            ->with(['subscription.client.user'])
            ->get();

        foreach ($pendingSessions as $session) {
            // Notifier le client
            $clientUser = $session->subscription->client->user ?? null;
            if ($clientUser) {
                NotificationLog::create([
                    'user_id' => $clientUser->id,
                    'channel' => 'email',
                    'type' => 'reminder_validate_delivery',
                    'content' => json_encode([
                        'work_session_id' => $session->id,
                        'subscription_id' => $session->subscription_id,
                        'freelancer_name' => $session->subscription->freelancer->user->name ?? 'N/A',
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

