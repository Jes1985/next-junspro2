<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class OfflineGateway extends Resource
{
    public static $model = \App\Models\PaymentGateway\OfflineGateway::class;

    public static $title = 'name';

    public static $search = [
        'name', 'short_description',
    ];

    public static function label()
    {
        return 'Passerelles de paiement hors ligne';
    }

    public static function singularLabel()
    {
        return 'Passerelle de paiement hors ligne';
    }

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Nom', 'name')
                ->required()
                ->sortable()
                ->rules('required', 'max:255')
                ->help('Nom de la méthode de paiement (ex: Virement bancaire, Chèque)'),

            Textarea::make('Description courte', 'short_description')
                ->nullable()
                ->rows(2)
                ->help('Brève description de la méthode de paiement'),

            Textarea::make('Instructions', 'instructions')
                ->nullable()
                ->rows(5)
                ->alwaysShow()
                ->help('Instructions pour le client sur comment effectuer le paiement'),

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
                ->help('Active ou désactive cette méthode de paiement'),

            Boolean::make('Autoriser pièce jointe', 'has_attachment')
                ->nullable()
                ->help('Permet au client d\'uploader une preuve de paiement'),

            Number::make('Numéro de série', 'serial_number')
                ->nullable()
                ->min(0)
                ->step(1)
                ->sortable()
                ->help('Ordre d\'affichage dans la liste'),
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


