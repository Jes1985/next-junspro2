<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class PaymentInvoice extends Resource
{
    public static $model = \App\Models\PaymentInvoice::class;

    public static $title = 'InvoiceId';

    public static $search = [
        'InvoiceId', 'order_id', 'client_id', 'TransactionId', 'PaymentId',
    ];

    public static function label()
    {
        return 'Factures de paiement';
    }

    public static function singularLabel()
    {
        return 'Facture de paiement';
    }

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('ID Commande', 'order_id')
                ->nullable()
                ->sortable(),

            Text::make('ID Client', 'client_id')
                ->nullable()
                ->sortable(),

            Text::make('ID Facture', 'InvoiceId')
                ->required()
                ->sortable()
                ->rules('required', 'max:255'),

            Badge::make('Statut facture', 'InvoiceStatus')
                ->map([
                    'Paid' => 'success',
                    'Pending' => 'warning',
                    'Failed' => 'danger',
                    'Cancelled' => 'info',
                ])
                ->sortable(),

            Number::make('Valeur facture', 'InvoiceValue')
                ->required()
                ->step(0.01)
                ->min(0)
                ->sortable()
                ->displayUsing(function ($value) {
                    return $value ? number_format($value, 2, ',', ' ') : '0,00';
                }),

            Text::make('Devise', 'Currency')
                ->default('EUR')
                ->sortable(),

            Text::make('Valeur affichée', 'InvoiceDisplayValue')
                ->nullable()
                ->hideFromIndex(),

            Text::make('ID Transaction', 'TransactionId')
                ->nullable()
                ->sortable(),

            Badge::make('Statut transaction', 'TransactionStatus')
                ->map([
                    'Captured' => 'success',
                    'Pending' => 'warning',
                    'Failed' => 'danger',
                    'Voided' => 'info',
                ])
                ->nullable()
                ->hideFromIndex(),

            Select::make('Passerelle de paiement', 'PaymentGateway')
                ->options([
                    'stripe' => 'Stripe',
                    'paypal' => 'PayPal',
                    'mollie' => 'Mollie',
                    'razorpay' => 'Razorpay',
                    'myfatoorah' => 'MyFatoorah',
                ])
                ->nullable()
                ->sortable(),

            Text::make('ID Paiement', 'PaymentId')
                ->nullable()
                ->hideFromIndex(),

            Text::make('Numéro de carte', 'CardNumber')
                ->nullable()
                ->hideFromIndex()
                ->readonly(),

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


