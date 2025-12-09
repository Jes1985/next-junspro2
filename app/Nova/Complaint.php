<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class Complaint extends Resource
{
    public static $model = \App\Models\Complaint::class;

    public static $title = 'id';

    public static $search = [
        'id', 'reason', 'status',
    ];

    public static $group = 'Junspro V2';

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Client', 'client', ClientProfile::class)
                ->searchable()
                ->sortable(),

            BelongsTo::make('Freelancer', 'freelancer', FreelancerProfile::class)
                ->searchable()
                ->sortable(),

            BelongsTo::make('Subscription', 'subscription', Subscription::class)
                ->searchable()
                ->sortable(),

            BelongsTo::make('Work Session', 'workSession', WorkSession::class)
                ->nullable()
                ->searchable(),

            Textarea::make('Reason', 'reason')
                ->rules('required', 'string')
                ->alwaysShow(),

            Select::make('Status', 'status')
                ->options([
                    'pending' => 'Pending',
                    'in_review' => 'In Review',
                    'resolved' => 'Resolved',
                    'rejected' => 'Rejected',
                ])
                ->sortable()
                ->rules('required'),

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
