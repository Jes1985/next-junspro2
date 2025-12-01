<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class Transaction extends Resource
{
    public static $model = \App\Models\Transaction::class;

    public static $title = 'transcation_id';

    public static $search = [
        'transcation_id', 'order_id', 'payment_method', 'payment_status',
    ];

    public static function label()
    {
        return 'Transactions';
    }

    public static function singularLabel()
    {
        return 'Transaction';
    }

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('ID Transaction', 'transcation_id')
                ->required()
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('ID Commande', 'order_id')
                ->nullable()
                ->sortable(),

            Select::make('Type de transaction', 'transcation_type')
                ->options([
                    'deposit' => 'Dépôt',
                    'withdraw' => 'Retrait',
                    'refund' => 'Remboursement',
                    'purchase' => 'Achat',
                    'commission' => 'Commission',
                ])
                ->required()
                ->sortable(),

            BelongsTo::make('Utilisateur', 'user', User::class)
                ->nullable()
                ->searchable()
                ->sortable(),

            Text::make('Vendeur ID', 'seller_id')
                ->nullable()
                ->hideFromIndex(),

            Badge::make('Statut de paiement', 'payment_status')
                ->map([
                    'completed' => 'success',
                    'pending' => 'warning',
                    'failed' => 'danger',
                    'cancelled' => 'info',
                ])
                ->sortable(),

            Select::make('Méthode de paiement', 'payment_method')
                ->options(function () {
                    return \App\Models\WithdrawPaymentMethod::pluck('name', 'id')->toArray();
                })
                ->nullable()
                ->searchable()
                ->sortable(),

            Number::make('Montant total', 'grand_total')
                ->required()
                ->step(0.01)
                ->min(0)
                ->sortable()
                ->displayUsing(function ($value) {
                    return $value ? number_format($value, 2, ',', ' ') . ' €' : '0,00 €';
                }),

            Number::make('Taxe', 'tax')
                ->nullable()
                ->step(0.01)
                ->min(0)
                ->displayUsing(function ($value) {
                    return $value ? number_format($value, 2, ',', ' ') . ' €' : '0,00 €';
                }),

            Number::make('Solde avant', 'pre_balance')
                ->nullable()
                ->step(0.01)
                ->readonly()
                ->hideFromIndex(),

            Number::make('Solde après', 'after_balance')
                ->nullable()
                ->step(0.01)
                ->readonly()
                ->hideFromIndex(),

            Select::make('Type de passerelle', 'gateway_type')
                ->options([
                    'online' => 'En ligne',
                    'offline' => 'Hors ligne',
                    'stripe' => 'Stripe',
                    'paypal' => 'PayPal',
                    'bank' => 'Virement bancaire',
                ])
                ->nullable()
                ->sortable(),

            Text::make('Symbole devise', 'currency_symbol')
                ->default('€')
                ->hideFromIndex(),

            Text::make('Position symbole', 'currency_symbol_position')
                ->options([
                    'left' => 'Gauche',
                    'right' => 'Droite',
                ])
                ->default('right')
                ->hideFromIndex(),

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


