<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class Rebooking extends Resource
{
    public static $model = \App\Models\Rebooking::class;

    public static $title = 'id';

    public static $search = [
        'reason', 'work_session_id',
    ];

    public static function label()
    {
        return 'Reprogrammations';
    }

    public static function singularLabel()
    {
        return 'Reprogrammation';
    }

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Session de travail', 'workSession', WorkSession::class)
                ->required()
                ->searchable()
                ->sortable(),

            DateTime::make('Ancienne date/heure', 'old_start_at')
                ->required()
                ->sortable()
                ->readonly()
                ->hideWhenCreating(),

            DateTime::make('Nouvelle date/heure', 'new_start_at')
                ->required()
                ->sortable()
                ->help('Nouvelle date et heure souhaitée pour la session'),

            BelongsTo::make('Demandé par', 'freelancer', FreelancerProfile::class)
                ->nullable()
                ->searchable()
                ->sortable(),

            Textarea::make('Raison', 'reason')
                ->rows(3)
                ->nullable()
                ->help('Raison de la demande de reprogrammation'),

            Badge::make('Approuvé', 'approved')
                ->map([
                    true => 'success',
                    false => 'warning',
                    null => 'info',
                ])
                ->sortable()
                ->displayUsing(function ($value) {
                    if ($value === null) {
                        return 'En attente';
                    }
                    return $value ? 'Approuvé' : 'Refusé';
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

