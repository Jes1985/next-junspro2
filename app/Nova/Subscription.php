<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class Subscription extends Resource
{
    public static $model = \App\Models\Subscription::class;

    public static $title = 'id';

    public static $search = [
        'id', 'stripe_subscription_id',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Client', 'client', ClientProfile::class)
                ->required()
                ->searchable(),

            BelongsTo::make('Freelance', 'freelancer', FreelancerProfile::class)
                ->required()
                ->searchable(),

            Number::make('Heures/semaine', 'hours_per_week')
                ->required()
                ->min(1)
                ->max(8)
                ->help('Valeurs: 1, 2, 3, 4, 5, 8'),

            Number::make('Heures totales/mois', 'hours_total_month')
                ->readonly(),

            Number::make('Heures restantes', 'hours_remaining')
                ->readonly(),

            Number::make('Prix de base', 'price_base')
                ->readonly()
                ->step(0.01),

            Select::make('Mode de livraison', 'delivery_mode')
                ->options([
                    'standard' => 'Standard',
                    'express_24h' => 'Express 24h (+30%)',
                    'express_48h' => 'Express 48h (+20%)',
                    'express_72h' => 'Express 72h (+10%)',
                ])
                ->default('standard'),

            Select::make('Statut', 'status')
                ->options([
                    'pending' => 'En attente',
                    'active' => 'Actif',
                    'paused' => 'En pause',
                    'cancelled' => 'Annulé',
                ])
                ->default('pending'),

            Text::make('Stripe Subscription ID', 'stripe_subscription_id')
                ->nullable(),

            DateTime::make('Prochaine facturation', 'next_billing_at')
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

