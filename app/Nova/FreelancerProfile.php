<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class FreelancerProfile extends Resource
{
    public static $model = \App\Models\FreelancerProfile::class;

    public static $title = 'id';

    public static $search = [
        'id', 'bio',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('User', 'user', User::class)
                ->required()
                ->searchable(),

            Number::make('Tarif horaire', 'hourly_rate')
                ->required()
                ->min(3)
                ->max(200)
                ->step(0.01)
                ->help('Entre 3€ et 200€'),

            Number::make('Score de fiabilité', 'reliability_score')
                ->required()
                ->min(0)
                ->max(100)
                ->default(100),

            Select::make('Plan bien-être', 'wellness_plan')
                ->options([
                    'none' => 'Aucun',
                    'essentiel' => 'Essentiel',
                    'premium' => 'Premium',
                ])
                ->default('none'),

            Textarea::make('Bio', 'bio')
                ->nullable(),

            Text::make('Compétences', 'skills')
                ->nullable()
                ->help('JSON array'),

            Text::make('Langues', 'languages')
                ->nullable()
                ->help('JSON array'),

            Text::make('Fuseau horaire', 'timezone')
                ->default('Europe/Paris'),

            Boolean::make('Vérifié', 'is_verified')
                ->default(false),
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

