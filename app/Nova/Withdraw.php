<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class Withdraw extends Resource
{
    public static $model = \App\Models\Withdraw::class;

    public static $title = 'withdraw_id';

    public static $search = [
        'withdraw_id', 'seller_id', 'status', 'amount',
    ];

    public static function label()
    {
        return 'Retraits';
    }

    public static function singularLabel()
    {
        return 'Retrait';
    }

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('ID Vendeur', 'seller_id')
                ->nullable()
                ->sortable(),

            Text::make('ID Retrait', 'withdraw_id')
                ->required()
                ->sortable()
                ->rules('required', 'max:255'),

            BelongsTo::make('Méthode de paiement', 'method', WithdrawPaymentMethod::class)
                ->nullable()
                ->searchable()
                ->sortable(),

            Number::make('Montant', 'amount')
                ->required()
                ->step(0.01)
                ->min(0)
                ->sortable()
                ->displayUsing(function ($value) {
                    return $value ? number_format($value, 2, ',', ' ') . ' €' : '0,00 €';
                }),

            Number::make('Montant payable', 'payable_amount')
                ->readonly()
                ->step(0.01)
                ->help('Montant après déduction des frais')
                ->displayUsing(function ($value) {
                    return $value ? number_format($value, 2, ',', ' ') . ' €' : '0,00 €';
                }),

            Number::make('Total des frais', 'total_charge')
                ->readonly()
                ->step(0.01)
                ->hideFromIndex()
                ->displayUsing(function ($value) {
                    return $value ? number_format($value, 2, ',', ' ') . ' €' : '0,00 €';
                }),

            Text::make('Référence additionnelle', 'additional_reference')
                ->nullable()
                ->hideFromIndex(),

            KeyValue::make('Champs', 'feilds')
                ->nullable()
                ->hideFromIndex()
                ->help('Informations supplémentaires de la méthode de retrait'),

            Badge::make('Statut', 'status')
                ->map([
                    'approved' => 'success',
                    'pending' => 'warning',
                    'rejected' => 'danger',
                    'completed' => 'info',
                ])
                ->sortable()
                ->displayUsing(function ($value) {
                    return match($value) {
                        'approved' => 'Approuvé',
                        'pending' => 'En attente',
                        'rejected' => 'Rejeté',
                        'completed' => 'Complété',
                        default => $value ?? 'En attente',
                    };
                }),

            DateTime::make('Créé le', 'created_at')
                ->sortable()
                ->readonly()
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            DateTime::make('Mis à jour le', 'updated_at')
                ->sortable()
                ->readonly()
                ->hideWhenCreating()
                ->hideWhenUpdating(),
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


