<?php

namespace App\Nova;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;
use Laravel\Nova\Resource;

class InvoiceLine extends Resource
{
    public static $model = \App\Models\InvoiceLine::class;

    public static $title = 'id';

    public static $search = [
        'id',
        'description',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Facture', 'invoice', Invoice::class)->searchable(),

            Text::make('Description', 'description')->nullable(),

            Number::make('Heures', 'hours')->step(0.25),
            Number::make('Base', 'base_amount')->step(0.01),
            Number::make('Client', 'client_amount')->step(0.01),
            Number::make('Commission', 'commission_amount')->step(0.01),
            Number::make('Frais client', 'client_fee_amount')->step(0.01),
            Number::make('Net freelance', 'freelancer_net_amount')->step(0.01),
            Number::make('Plateforme', 'platform_total_amount')->step(0.01),
        ];
    }
}

