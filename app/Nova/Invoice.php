<?php

namespace App\Nova;

use App\Nova\ClientProfile;
use App\Nova\FreelancerProfile;
use App\Nova\Subscription;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class Invoice extends Resource
{
    public static $model = \App\Models\Invoice::class;

    public static $title = 'id';

    public static $search = [
        'id',
        'payment_intent_id',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Client', 'client', ClientProfile::class)->searchable(),
            BelongsTo::make('Freelance', 'freelancer', FreelancerProfile::class)->searchable(),
            BelongsTo::make('Abonnement', 'subscription', Subscription::class)->nullable(),

            Text::make('Payment Intent', 'payment_intent_id')->hideFromIndex(),
            Text::make('Devise', 'currency')->sortable(),

            Number::make('Base total', 'amount_base_total')->step(0.01),
            Number::make('Client total', 'amount_client_total')->step(0.01),
            Number::make('Commission totale', 'platform_commission_total')->step(0.01),
            Number::make('Frais client totaux', 'platform_client_fee_total')->step(0.01),
            Number::make('Net freelance total', 'freelancer_net_total')->step(0.01),

            Number::make('Taux utilisé', 'commission_rate_used')
                ->displayUsing(fn ($v) => $v ? ($v * 100) . ' %' : null),

            DateTime::make('Créé le', 'created_at')->onlyOnDetail(),

            HasMany::make('Lignes', 'lines', InvoiceLine::class),
        ];
    }
}

