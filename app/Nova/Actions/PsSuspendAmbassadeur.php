<?php

namespace App\Nova\Actions;

use App\Models\PsAmbassadeur;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Http\Requests\NovaRequest;

class PsSuspendAmbassadeur extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Suspendre';

    public $destructive = true;

    public function handle(NovaRequest $request, Collection $models): void
    {
        foreach ($models as $model) {
            /** @var PsAmbassadeur $model */
            $model->update(['status' => 'suspended']);
        }
    }

    public function authorizedToRun(NovaRequest $request, $model): bool
    {
        return true;
    }
}
