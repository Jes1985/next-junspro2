<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Http\Requests\NovaRequest;

class FormationModule extends Resource
{
    public static $model = \App\Models\FormationModule::class;

    public static $title = 'title';

    public static string $group = 'Formation';

    public static $search = [
        'id', 'slug', 'title',
    ];

    public static function label(): string
    {
        return 'Modules Formation';
    }

    public static function singularLabel(): string
    {
        return 'Module';
    }

    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),

            Number::make('Ordre', 'order')->sortable()->min(1)->max(6),

            Text::make('Slug', 'slug')->readonly(),

            Text::make('Titre', 'title')->sortable()->rules('required', 'max:120'),

            Text::make('Semaine', 'week_label'),

            Text::make('Description', 'description')
                ->nullable()
                ->hideFromIndex(),

            Boolean::make('Actif', 'is_active'),

            KeyValue::make('Activités', 'activities')
                ->keyLabel('Clé')
                ->valueLabel('Valeur')
                ->nullable()
                ->hideFromIndex(),

            HasMany::make('Progressions', 'progress', FormationModuleProgress::class),
        ];
    }
}
