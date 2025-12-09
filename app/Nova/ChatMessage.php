<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class ChatMessage extends Resource
{
    public static $model = \App\Models\ChatMessage::class;

    public static $title = 'id';

    public static $search = [
        'id', 'message',
    ];

    public static $group = 'Junspro V2';

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Sender', 'sender', User::class)
                ->searchable()
                ->sortable(),

            BelongsTo::make('Receiver', 'receiver', User::class)
                ->searchable()
                ->sortable(),

            BelongsTo::make('Subscription', 'subscription', Subscription::class)
                ->nullable()
                ->searchable(),

            Textarea::make('Message', 'message')
                ->rules('required', 'string')
                ->alwaysShow(),

            Boolean::make('Is Read', 'is_read')
                ->sortable(),

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
