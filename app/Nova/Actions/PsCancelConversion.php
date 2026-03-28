<?php

namespace App\Nova\Actions;

use App\Models\PsConversion;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Http\Requests\NovaRequest;

class PsCancelConversion extends Action
{
    use InteractsWithQueue, Queueable;

    public $name    = 'Annuler la conversion';
    public $destructive = true;

    public function handle(NovaRequest $request, Collection $models): void
    {
        foreach ($models as $conversion) {
            /** @var PsConversion $conversion */
            if (!in_array($conversion->status, ['pending', 'validated'])) continue;

            $ambassadeur = $conversion->ambassadeur;

            if ($conversion->status === 'pending') {
                $ambassadeur->decrement('pending_payout', $conversion->commission_amount);
            } else {
                $ambassadeur->decrement('total_earned', $conversion->commission_amount);
            }

            $conversion->update(['status' => 'cancelled']);
        }
    }

    public function authorizedToRun(NovaRequest $request, $model): bool
    {
        return true;
    }
}
