<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class Mission extends Resource
{
    public static $model = \App\Models\Mission::class;

    public static $title = 'client_nom';

    public static $search = [
        'client_nom', 'client_email', 'description_mission', 'statut',
    ];

    public static function label()
    {
        return 'Missions';
    }

    public static function singularLabel()
    {
        return 'Mission';
    }

    public function fields(NovaRequest $request)
    {
        return [
            ID::make('ID Mission', 'id_mission')->sortable(),

            Text::make('Nom du client', 'client_nom')
                ->required()
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email du client', 'client_email')
                ->required()
                ->sortable()
                ->rules('required', 'email', 'max:255'),

            Text::make('Téléphone', 'client_telephone')
                ->rules('nullable', 'max:20'),

            Textarea::make('Description de la mission', 'description_mission')
                ->rows(4)
                ->alwaysShow(),

            Select::make('Offre', 'offre')
                ->options([
                    'Mise en relation' => 'Mise en relation',
                    'Accompagnement' => 'Accompagnement',
                ])
                ->required()
                ->sortable(),

            Number::make('Budget', 'budget')
                ->required()
                ->step(0.01)
                ->min(0)
                ->sortable()
                ->displayUsing(function ($value) {
                    return $value ? number_format($value, 2, ',', ' ') . ' €' : '-';
                }),

            Select::make('Bonus', 'bonus')
                ->options([
                    'Aucun' => 'Aucun',
                    'Vitalite' => 'Vitalité',
                    'Serenite' => 'Sérénité',
                    'Equilibre' => 'Équilibre',
                ])
                ->sortable()
                ->displayUsing(function ($value) {
                    return match($value) {
                        'Vitalite' => 'Vitalité',
                        'Serenite' => 'Sérénité',
                        'Equilibre' => 'Équilibre',
                        default => $value ?? 'Aucun',
                    };
                }),

            Badge::make('Statut', 'statut')
                ->map([
                    'en_attente' => 'warning',
                    'en_cours' => 'info',
                    'terminee' => 'success',
                    'annulee' => 'danger',
                ])
                ->sortable(),

            URL::make('Lien Calendly', 'calendly_link')
                ->nullable()
                ->hideFromIndex(),

            URL::make('Lien Zoom', 'zoom_link')
                ->nullable()
                ->hideFromIndex(),

            KeyValue::make('Freelances proposés', 'freelance_propose')
                ->nullable()
                ->hideFromIndex(),

            File::make('Fichier joint', 'fichier_joint')
                ->nullable()
                ->disk('public')
                ->path('missions')
                ->hideFromIndex(),

            Text::make('ID Paiement Stripe', 'stripe_payment_id')
                ->nullable()
                ->hideFromIndex()
                ->readonly(),

            Text::make('ID Événement Calendly', 'calendly_event_id')
                ->nullable()
                ->hideFromIndex()
                ->readonly(),

            Text::make('ID Réunion Zoom', 'zoom_meeting_id')
                ->nullable()
                ->hideFromIndex()
                ->readonly(),

            DateTime::make('Date de soumission', 'date_soumission')
                ->sortable()
                ->readonly()
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            DateTime::make('Date de RDV', 'date_rdv')
                ->nullable()
                ->hideFromIndex(),
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

