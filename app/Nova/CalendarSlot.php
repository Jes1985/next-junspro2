<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class CalendarSlot extends Resource
{
    public static $model = \App\Models\CalendarSlot::class;

    public static $title = 'id';

    public static $search = [
        'freelancer_id', 'weekday', 'hour',
    ];

    public static function label()
    {
        return 'Créneaux calendrier';
    }

    public static function singularLabel()
    {
        return 'Créneau calendrier';
    }

    public function fields(NovaRequest $request)
    {
        $weekdays = [
            0 => 'Dimanche',
            1 => 'Lundi',
            2 => 'Mardi',
            3 => 'Mercredi',
            4 => 'Jeudi',
            5 => 'Vendredi',
            6 => 'Samedi',
        ];

        return [
            ID::make()->sortable(),

            BelongsTo::make('Freelancer', 'freelancer', FreelancerProfile::class)
                ->required()
                ->searchable()
                ->sortable(),

            Select::make('Jour de la semaine', 'weekday')
                ->options($weekdays)
                ->required()
                ->sortable()
                ->displayUsing(function ($value) use ($weekdays) {
                    return $weekdays[$value] ?? $value;
                }),

            Number::make('Heure', 'hour')
                ->required()
                ->min(0)
                ->max(23)
                ->step(1)
                ->sortable()
                ->help('Heure au format 24h (0-23)')
                ->displayUsing(function ($value) {
                    return $value ? str_pad($value, 2, '0', STR_PAD_LEFT) . 'h00' : '-';
                }),

            Boolean::make('Disponible', 'is_available')
                ->sortable()
                ->default(true),
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

