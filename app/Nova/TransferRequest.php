<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class TransferRequest extends Resource
{
    public static $model = \App\Models\TransferRequest::class;

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

            BelongsTo::make('Ancien Freelance', 'oldFreelancer', FreelancerProfile::class)
                ->required()
                ->searchable(),

            BelongsTo::make('Nouveau Freelance', 'newFreelancer', FreelancerProfile::class)
                ->required()
                ->searchable(),

            BelongsTo::make('Abonnement', 'subscription', Subscription::class)
                ->required()
                ->searchable(),

            Number::make('Heures transférées', 'hours_transferred')
                ->readonly(),

            Textarea::make('Raison', 'reason')
                ->nullable(),

            Select::make('Statut', 'status')
                ->options([
                    'pending' => 'En attente',
                    'approved' => 'Approuvé',
                    'rejected' => 'Rejeté',
                ])
                ->default('pending'),
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

