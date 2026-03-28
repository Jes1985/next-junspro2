<?php

namespace App\Nova\Actions;

use App\Models\PsAmbassadeur;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Http\Requests\NovaRequest;

class PsActivateAmbassadeur extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Activer';

    public function handle(NovaRequest $request, Collection $models): void
    {
        foreach ($models as $model) {
            /** @var PsAmbassadeur $model */
            $model->update([
                'status'       => 'active',
                'activated_at' => $model->activated_at ?? now(),
            ]);
        }
    }

    public function authorizedToRun(NovaRequest $request, $model): bool
    {
        return true;
    }
}
