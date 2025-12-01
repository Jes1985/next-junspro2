<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class WellnessPlan extends Resource
{
    public static $model = \App\Models\WellnessPlan::class;

    public static $title = 'id';

    public static $search = [
        'id', 'name',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Select::make('Nom', 'name')
                ->options([
                    'essentiel' => 'Essentiel',
                    'premium' => 'Premium',
                ])
                ->required(),

            Number::make('Prix mensuel', 'price_monthly')
                ->required()
                ->step(0.01),

            Number::make('Séances par mois', 'sessions_per_month')
                ->required()
                ->min(1),
        ];
    }

    public function cards(NovaRequest $request)
    {
        return [];
    }

    public function filters(NovaRequest $request)
    {
        return [];
    }

    public function lenses(NovaRequest $request)
    {
        return [];
    }

    public function actions(NovaRequest $request)
    {
        return [];
    }
}

