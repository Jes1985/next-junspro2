<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Http\Requests\NovaRequest;

class FormationModuleProgress extends Resource
{
    public static $model = \App\Models\FormationModuleProgress::class;

    public static $title = 'id';

    public static string $group = 'Formation';

    public static $displayInNavigation = false;

    public static $search = ['id'];

    public static function label(): string
    {
        return 'Progression modules';
    }

    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Inscription', 'enrollment', FormationEnrollment::class),

            BelongsTo::make('Module', 'module', FormationModule::class),

            Badge::make('Statut', 'status')
                ->map([
                    'locked'      => 'danger',
                    'available'   => 'warning',
                    'in_progress' => 'info',
                    'completed'   => 'success',
                ]),

            Number::make('Complétion %', 'completion_pct')
                ->min(0)->max(100)
                ->displayUsing(fn ($v) => $v . ' %'),

            DateTime::make('Démarré le', 'started_at')->nullable(),

            DateTime::make('Terminé le', 'completed_at')->nullable()->sortable(),
        ];
    }
}
