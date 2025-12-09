<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class NotificationLog extends Resource
{
    public static $model = \App\Models\NotificationLog::class;

    public static $title = 'id';

    public static $search = [
        'id', 'type', 'channel',
    ];

    public static $group = 'Junspro V2';

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('User', 'user', User::class)
                ->searchable()
                ->sortable(),

            Select::make('Channel', 'channel')
                ->options([
                    'email' => 'Email',
                    'sms' => 'SMS',
                    'push' => 'Push Notification',
                    'in_app' => 'In-App',
                ])
                ->sortable()
                ->rules('required'),

            Text::make('Type', 'type')
                ->sortable()
                ->rules('required', 'string', 'max:255'),

            Code::make('Content', 'content')
                ->json()
                ->readonly(),

            DateTime::make('Sent At', 'sent_at')
                ->sortable()
                ->rules('required'),
        ];
    }

    public function filters(NovaRequest $request)
    {
        return [];
    }
}
