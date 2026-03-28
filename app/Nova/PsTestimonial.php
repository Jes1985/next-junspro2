<?php

namespace App\Nova;

use App\Models\PsTestimonial as PsTestimonialModel;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class PsTestimonial extends Resource
{
    public static $model = PsTestimonialModel::class;

    public static $title = 'author_name';

    public static string $group = 'Pause Souffle';

    public static $search = [
        'id', 'author_name', 'author_role', 'content',
    ];

    public static function label(): string
    {
        return 'Témoignages PS';
    }

    public static function singularLabel(): string
    {
        return 'Témoignage PS';
    }

    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),

            Text::make('Auteur', 'author_name')
                ->rules('required', 'max:100')
                ->sortable(),

            Text::make('Rôle / Ville', 'author_role')
                ->nullable()
                ->help('Ex: "Coach bien-être, Paris" ou "Participante au Parcours"'),

            Textarea::make('Témoignage', 'content')
                ->rules('required')
                ->rows(4)
                ->alwaysShow(),

            Text::make('Initiale avatar', 'avatar_initial')
                ->nullable()
                ->help('Une lettre affichée dans le cercle avatar (ex: "S" pour Sophie)'),

            Select::make('Mise en avant', 'highlight')
                ->options([
                    'standard' => 'Standard',
                    'featured' => 'Mis en avant',
                ])
                ->default('standard')
                ->displayUsingLabels(),

            Number::make('Ordre d\'affichage', 'sort_order')
                ->default(0)
                ->help('Plus le chiffre est bas, plus le témoignage apparaît en premier'),

            Boolean::make('Publié', 'is_published')
                ->sortable(),
        ];
    }

    public function filters(NovaRequest $request): array
    {
        return [];
    }

    public function lenses(NovaRequest $request): array
    {
        return [];
    }

    public function actions(NovaRequest $request): array
    {
        return [];
    }
}
