<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class FormationEnrollment extends Resource
{
    public static $model = \App\Models\FormationEnrollment::class;

    public static $title = 'id';

    public static string $group = 'Formation';

    public static $search = [
        'id', 'attestation_code', 'stripe_payment_intent',
    ];

    public static function label(): string
    {
        return 'Inscriptions Formation';
    }

    public static function singularLabel(): string
    {
        return 'Inscription';
    }

    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Utilisateur', 'user', User::class)
                ->searchable()
                ->sortable(),

            Badge::make('Statut', 'status')
                ->map([
                    'pending'   => 'warning',
                    'active'    => 'info',
                    'completed' => 'success',
                    'cancelled' => 'danger',
                ]),

            Number::make('Montant payé', 'amount_paid')
                ->step(0.01)
                ->displayUsing(fn ($v) => number_format($v, 2, ',', ' ') . ' €')
                ->sortable(),

            Text::make('Stripe PI', 'stripe_payment_intent')
                ->hideFromIndex()
                ->copyable(),

            Text::make('Code attestation', 'attestation_code')
                ->nullable()
                ->copyable(),

            DateTime::make('Inscrit le', 'enrolled_at')
                ->sortable(),

            DateTime::make('Certifié le', 'attestation_issued_at')
                ->nullable()
                ->sortable(),

            HasMany::make('Progression modules', 'moduleProgress', FormationModuleProgress::class),
        ];
    }

    public function filters(NovaRequest $request): array
    {
        return [];
    }
}
