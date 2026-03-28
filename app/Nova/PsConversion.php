<?php

namespace App\Nova;

use App\Models\PsConversion as PsConversionModel;
use App\Nova\Actions\PsValidateConversionManually;
use App\Nova\Actions\PsCancelConversion;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class PsConversion extends Resource
{
    public static $model = PsConversionModel::class;

    public static $title = 'id';

    public static string $group = 'Pause Souffle';

    public static $search = [
        'id', 'stripe_payment_intent',
    ];

    public static function label(): string
    {
        return 'Conversions PS';
    }

    public static function singularLabel(): string
    {
        return 'Conversion PS';
    }

    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Ambassadeur', 'ambassadeur', PsAmbassadeur::class)
                ->sortable(),

            BelongsTo::make('Filleul', 'referredUser', User::class)
                ->nullable()
                ->hideFromIndex(),

            Select::make('Produit', 'product_type')
                ->options(PsConversionModel::PRODUCT_LABELS)
                ->displayUsingLabels()
                ->sortable(),

            Badge::make('Statut', 'status')
                ->map([
                    'pending'   => 'warning',
                    'validated' => 'info',
                    'paid'      => 'success',
                    'cancelled' => 'danger',
                ])
                ->labels([
                    'pending'   => 'En attente',
                    'validated' => 'Validée',
                    'paid'      => 'Payée',
                    'cancelled' => 'Annulée',
                ]),

            Number::make('Vente (€)', 'sale_amount')
                ->step(0.01)
                ->displayUsing(fn ($v) => number_format((float)$v, 2, ',', ' ') . ' €')
                ->sortable(),

            Number::make('Taux (%)', 'commission_rate')
                ->step(0.01)
                ->displayUsing(fn ($v) => number_format((float)$v, 2, ',', ' ') . ' %')
                ->hideFromIndex(),

            Number::make('Commission (€)', 'commission_amount')
                ->step(0.01)
                ->displayUsing(fn ($v) => number_format((float)$v, 2, ',', ' ') . ' €')
                ->sortable(),

            Text::make('Stripe PI', 'stripe_payment_intent')
                ->nullable()
                ->copyable()
                ->hideFromIndex(),

            Textarea::make('Notes', 'notes')
                ->nullable()
                ->hideFromIndex(),

            DateTime::make('Validée le', 'validated_at')
                ->nullable()
                ->sortable(),

            DateTime::make('Payée le', 'paid_at')
                ->nullable()
                ->hideFromIndex(),

            DateTime::make('Créée le', 'created_at')
                ->sortable(),
        ];
    }

    public function actions(NovaRequest $request): array
    {
        return [
            new PsValidateConversionManually,
            new PsCancelConversion,
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
