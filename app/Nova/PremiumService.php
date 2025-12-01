<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class PremiumService extends Resource
{
    public static $model = \App\Models\PremiumService::class;

    public static $title = 'id';

    public static $search = [
        'id', 'type',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Select::make('Type de propriétaire', 'owner_type')
                ->options([
                    'client' => 'Client',
                    'freelance' => 'Freelance',
                ])
                ->required(),

            Number::make('ID Propriétaire', 'owner_id')
                ->required(),

            Select::make('Type de service', 'type')
                ->options([
                    'matchdirect' => 'MatchDirect™',
                    'concierge' => 'Conciergerie',
                    'audit' => 'Audit Express',
                    'pack_confiance_plus' => 'Pack Confiance+',
                    'boost' => 'Boost visibilité',
                    'premium_position' => 'Position Premium',
                    'verification' => 'Vérification',
                    'coaching' => 'Coaching',
                    'plan_pro' => 'Plan Pro',
                ])
                ->required(),

            Number::make('Prix', 'price')
                ->required()
                ->step(0.01),

            DateTime::make('Début', 'start_at')
                ->required(),

            DateTime::make('Fin', 'end_at')
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

