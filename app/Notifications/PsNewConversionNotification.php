<?php

namespace App\Notifications;

use App\Models\PsAmbassadeur;
use App\Models\PsConversion;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Notification envoyée à l'ambassadeur quand une nouvelle vente est enregistrée.
 * Déclenchée depuis PsAmbassadeurService::recordConversion()
 */
class PsNewConversionNotification extends Notification
{
    use Queueable;

    public function __construct(
        public readonly PsConversion  $conversion,
        public readonly PsAmbassadeur $ambassadeur
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $product       = PsConversion::PRODUCT_LABELS[$this->conversion->product_type] ?? $this->conversion->product_type;
        $commission    = number_format($this->conversion->commission_amount, 2, ',', ' ');
        $pending       = number_format((float) $this->ambassadeur->pending_payout, 2, ',', ' ');
        $trackingLink  = url('/ps/' . $this->ambassadeur->code);
        $ressourcesUrl = route('ps.ressources');

        return (new MailMessage)
            ->subject("✦ Nouvelle vente — Commission {$commission} € en attente")
            ->view('emails.ps-new-conversion', [
                'notifiable'    => $notifiable,
                'conversion'    => $this->conversion,
                'ambassadeur'   => $this->ambassadeur,
                'product'       => $product,
                'commission'    => $commission,
                'pending'       => $pending,
                'trackingLink'  => $trackingLink,
                'ressourcesUrl' => $ressourcesUrl,
            ]);
    }
}
