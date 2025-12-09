<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class AuditLog extends Resource
{
    public static $model = \App\Models\AuditLog::class;

    public static $title = 'id';

    public static $search = [
        'id', 'action_type', 'entity_type',
    ];

    public static $group = 'Junspro V2';

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('User', 'user', User::class)
                ->searchable()
                ->sortable(),

            Text::make('Action Type', 'action_type')
                ->sortable()
                ->rules('required', 'string', 'max:255'),

            Text::make('Entity Type', 'entity_type')
                ->sortable()
                ->rules('required', 'string', 'max:255'),

            Text::make('Entity ID', 'entity_id')
                ->sortable()
                ->rules('required', 'integer'),

            Code::make('Metadata', 'metadata')
                ->json()
                ->readonly(),

            DateTime::make('Created At', 'created_at')
                ->sortable()
                ->readonly(),
        ];
    }

    public function filters(NovaRequest $request)
    {
        return [];
    }
}
