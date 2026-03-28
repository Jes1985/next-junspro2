<?php

namespace App\Nova\Actions;

use App\Models\PsConversion;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Http\Requests\NovaRequest;

class PsValidateConversionManually extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Valider manuellement';

    public function handle(NovaRequest $request, Collection $models): void
    {
        foreach ($models as $conversion) {
            /** @var PsConversion $conversion */
            if ($conversion->status !== 'pending') continue;

            DB::transaction(function () use ($conversion) {
                $conversion->update([
                    'status'       => 'validated',
                    'validated_at' => now(),
                ]);

                $ambassadeur = $conversion->ambassadeur;
                $ambassadeur->decrement('pending_payout', $conversion->commission_amount);
                $ambassadeur->increment('total_earned', $conversion->commission_amount);
            });
        }
    }

    public function authorizedToRun(NovaRequest $request, $model): bool
    {
        return true;
    }
}
