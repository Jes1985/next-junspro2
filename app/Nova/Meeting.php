<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class Meeting extends Resource
{
    public static $model = \App\Models\Meeting::class;

    public static $title = 'id';

    public static $search = [
        'provider', 'url',
    ];

    public static function label()
    {
        return 'Réunions';
    }

    public static function singularLabel()
    {
        return 'Réunion';
    }

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Session de travail', 'workSession', WorkSession::class)
                ->required()
                ->searchable()
                ->sortable(),

            Select::make('Fournisseur', 'provider')
                ->options([
                    'zoom' => 'Zoom',
                    'jitsi' => 'Jitsi',
                    'google_meet' => 'Google Meet',
                ])
                ->required()
                ->sortable()
                ->displayUsing(function ($value) {
                    return match($value) {
                        'zoom' => 'Zoom',
                        'jitsi' => 'Jitsi',
                        'google_meet' => 'Google Meet',
                        default => $value,
                    };
                }),

            URL::make('URL de la réunion', 'url')
                ->required()
                ->rules('required', 'url')
                ->help('Lien d\'accès à la réunion vidéo'),

            Number::make('Durée (minutes)', 'duration_minutes')
                ->min(0)
                ->step(1)
                ->nullable()
                ->sortable()
                ->displayUsing(function ($value) {
                    return $value ? $value . ' min' : '-';
                }),
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

