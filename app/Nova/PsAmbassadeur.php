<?php

namespace App\Nova;

use App\Models\PsAmbassadeur as PsAmbassadeurModel;
use App\Nova\Actions\PsActivateAmbassadeur;
use App\Nova\Actions\PsSuspendAmbassadeur;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class PsAmbassadeur extends Resource
{
    public static $model = PsAmbassadeurModel::class;

    public static $title = 'code';

    public static string $group = 'Pause Souffle';

    public static $search = [
        'id', 'code',
    ];

    public static function label(): string
    {
        return 'Ambassadeurs PS';
    }

    public static function singularLabel(): string
    {
        return 'Ambassadeur PS';
    }

    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Utilisateur', 'user', User::class)
                ->searchable()
                ->sortable(),

            Text::make('Code affilié', 'code')
                ->copyable()
                ->sortable(),

            Badge::make('Statut', 'status')
                ->map([
                    'active'    => 'success',
                    'pending'   => 'warning',
                    'suspended' => 'danger',
                ])
                ->labels([
                    'active'    => 'Actif',
                    'pending'   => 'En attente',
                    'suspended' => 'Suspendu',
                ]),

            Select::make('Tier', 'tier')
                ->options([
                    'standard'    => '✦ Standard',
                    'partenaire'  => '✦✦ Partenaire',
                    'ambassadeur' => '✦✦✦ Ambassadeur',
                ])
                ->sortable()
                ->displayUsingLabels(),

            Number::make('Total gagné (€)', 'total_earned')
                ->step(0.01)
                ->displayUsing(fn ($v) => number_format((float)$v, 2, ',', ' ') . ' €')
                ->sortable(),

            Number::make('En attente (€)', 'pending_payout')
                ->step(0.01)
                ->displayUsing(fn ($v) => number_format((float)$v, 2, ',', ' ') . ' €')
                ->sortable(),

            Number::make('Payé (€)', 'paid_out')
                ->step(0.01)
                ->displayUsing(fn ($v) => number_format((float)$v, 2, ',', ' ') . ' €')
                ->onlyOnDetail(),

            Text::make('IBAN', 'iban')
                ->nullable()
                ->hideFromIndex(),

            Text::make('BIC', 'bic')
                ->nullable()
                ->hideFromIndex(),

            Text::make('Titulaire compte', 'account_holder')
                ->nullable()
                ->hideFromIndex(),

            Text::make('Banque', 'bank_name')
                ->nullable()
                ->hideFromIndex(),

            Textarea::make('Notes internes', 'notes')
                ->nullable()
                ->hideFromIndex(),

            Text::make('Téléphone', 'phone')
                ->nullable()
                ->hideFromIndex(),

            Textarea::make('Motivation', 'motivation')
                ->nullable()
                ->hideFromIndex()
                ->help('Réponse à la question « Pourquoi souhaitez-vous devenir ambassadeur ? »'),

            DateTime::make('Activé le', 'activated_at')
                ->nullable()
                ->sortable(),

            DateTime::make('Créé le', 'created_at')
                ->sortable()
                ->onlyOnDetail(),

            HasMany::make('Conversions', 'conversions', PsConversion::class),
        ];
    }

    public function actions(NovaRequest $request): array
    {
        return [
            new PsActivateAmbassadeur,
            new PsSuspendAmbassadeur,
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
}
