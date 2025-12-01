<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class WorkSession extends Resource
{
    public static $model = \App\Models\WorkSession::class;

    public static $title = 'id';

    public static $search = [
        'id',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Abonnement', 'subscription', Subscription::class)
                ->required()
                ->searchable(),

            DateTime::make('Début', 'start_at')
                ->required(),

            DateTime::make('Fin', 'end_at')
                ->required(),

            Number::make('Durée (minutes)', 'duration_minutes')
                ->default(60)
                ->readonly(),

            Boolean::make('Visio', 'is_meeting')
                ->default(false),

            Select::make('Vitesse de livraison', 'delivery_speed')
                ->options([
                    'standard' => 'Standard',
                    'express_24h' => 'Express 24h',
                    'express_48h' => 'Express 48h',
                    'express_72h' => 'Express 72h',
                ])
                ->default('standard'),

            DateTime::make('Deadline', 'deadline_at')
                ->nullable()
                ->help('Utilisé si Express'),

            Textarea::make('Rapport', 'report_text')
                ->nullable(),

            Number::make('Nombre de reprogrammations', 'rebook_count')
                ->default(0)
                ->readonly(),

            Select::make('Statut', 'status')
                ->options([
                    'scheduled' => 'Planifiée',
                    'completed' => 'Complétée',
                    'late' => 'En retard',
                    'cancelled' => 'Annulée',
                ])
                ->default('scheduled'),
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

