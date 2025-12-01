<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class OnlineGateway extends Resource
{
    public static $model = \App\Models\PaymentGateway\OnlineGateway::class;

    public static $title = 'name';

    public static $search = [
        'name', 'keyword',
    ];

    public static function label()
    {
        return 'Passerelles de paiement en ligne';
    }

    public static function singularLabel()
    {
        return 'Passerelle de paiement en ligne';
    }

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Nom', 'name')
                ->required()
                ->sortable()
                ->rules('required', 'max:255')
                ->help('Nom de la passerelle (ex: Stripe, PayPal)'),

            Text::make('Mot-clé', 'keyword')
                ->required()
                ->sortable()
                ->rules('required', 'max:255')
                ->help('Identifiant unique pour la passerelle (ex: stripe, paypal)'),

            KeyValue::make('Informations', 'information')
                ->nullable()
                ->help('Configuration de la passerelle. Pour Stripe: utilisez "key", "secret", "webhook_secret". Pour PayPal: utilisez "client_id", "client_secret", "sandbox_status". Les noms doivent être exacts (en minuscules).'),

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
                ->help('Active ou désactive cette passerelle de paiement'),
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

