<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class Reward extends Resource
{
    public static $model = \App\Models\Reward::class;

    public static $title = 'id';

    public static $search = [
        'id',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Client', 'client', ClientProfile::class)
                ->required()
                ->searchable(),

            Select::make('Seuil atteint', 'threshold_reached')
                ->options([
                    '501' => '501€',
                    '1001' => '1001€',
                    '5001' => '5001€',
                ])
                ->required(),

            Number::make('Nombre de séances', 'sessions_count')
                ->required()
                ->min(1)
                ->max(4)
                ->help('1, 2 ou 4 séances'),

            Select::make('Statut', 'status')
                ->options([
                    'pending' => 'En attente',
                    'claimed' => 'Réclamée',
                    'completed' => 'Complétée',
                ])
                ->default('pending'),

            Text::make('Lien Calendly', 'calendly_link')
                ->nullable(),
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

