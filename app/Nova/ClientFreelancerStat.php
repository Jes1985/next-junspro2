<?php

namespace App\Nova;

use App\Nova\ClientProfile;
use App\Nova\FreelancerProfile;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class ClientFreelancerStat extends Resource
{
    public static $model = \App\Models\ClientFreelancerStat::class;

    public static $title = 'id';

    public static $search = [
        'id',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Client', 'client', ClientProfile::class)->searchable(),
            BelongsTo::make('Freelance', 'freelancer', FreelancerProfile::class)->searchable(),

            Number::make('Total base (€)', 'total_base_amount')->step(0.01)->displayUsing(fn ($v) => number_format($v, 2, ',', ' ')),
            Number::make('Total client (€)', 'total_client_amount')->step(0.01)->displayUsing(fn ($v) => number_format($v, 2, ',', ' ')),
            Number::make('Taux commission', 'current_commission_rate')
                ->step(0.01)
                ->displayUsing(fn ($v) => ($v * 100) . ' %'),
        ];
    }
}

