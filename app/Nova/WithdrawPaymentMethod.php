<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class WithdrawPaymentMethod extends Resource
{
    public static $model = \App\Models\WithdrawPaymentMethod::class;

    public static $title = 'name';

    public static $search = [
        'name',
    ];

    public static function label()
    {
        return 'Méthodes de retrait';
    }

    public static function singularLabel()
    {
        return 'Méthode de retrait';
    }

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Nom', 'name')
                ->required()
                ->sortable()
                ->rules('required', 'max:255')
                ->help('Nom de la méthode de retrait (ex: Virement bancaire, PayPal, Stripe)'),

            Number::make('Limite minimum', 'min_limit')
                ->required()
                ->step(0.01)
                ->min(0)
                ->sortable()
                ->help('Montant minimum pour un retrait')
                ->displayUsing(function ($value) {
                    return $value ? number_format($value, 2, ',', ' ') . ' €' : '0,00 €';
                }),

            Number::make('Limite maximum', 'max_limit')
                ->required()
                ->step(0.01)
                ->min(0)
                ->sortable()
                ->help('Montant maximum pour un retrait')
                ->displayUsing(function ($value) {
                    return $value ? number_format($value, 2, ',', ' ') . ' €' : '0,00 €';
                }),

            Number::make('Frais fixes', 'fixed_charge')
                ->nullable()
                ->step(0.01)
                ->min(0)
                ->help('Frais fixes en euros')
                ->displayUsing(function ($value) {
                    return $value ? number_format($value, 2, ',', ' ') . ' €' : '0,00 €';
                }),

            Number::make('Frais en pourcentage', 'percentage_charge')
                ->nullable()
                ->step(0.01)
                ->min(0)
                ->max(100)
                ->help('Frais en pourcentage (ex: 2.5 pour 2.5%)')
                ->displayUsing(function ($value) {
                    return $value ? number_format($value, 2, ',', ' ') . ' %' : '0,00 %';
                }),

            Badge::make('Statut', 'status')
                ->map([
                    1 => 'success',
                    0 => 'danger',
                ])
                ->sortable()
                ->displayUsing(function ($value) {
                    return $value == 1 ? 'Actif' : 'Inactif';
                }),

            Boolean::make('Actif', 'status')
                ->sortable()
                ->help('Active ou désactive cette méthode de retrait'),
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


