<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class ClientProfile extends Resource
{
    public static $model = \App\Models\ClientProfile::class;

    public static $title = 'id';

    public static $search = [
        'id', 'company_name',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('User', 'user', User::class)
                ->required()
                ->searchable(),

            Text::make('Nom de l\'entreprise', 'company_name')
                ->nullable(),

            Number::make('Total dépensé', 'total_spent')
                ->default(0)
                ->step(0.01)
                ->readonly(),
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

