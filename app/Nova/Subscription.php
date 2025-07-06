<?php

namespace App\Nova;

use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Http\Requests\NovaRequest;

class Subscription extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Subscription::class;

    /**
     * The single value that should be used to represent the resource.
     *
     * @var string
     */
    public static $title = 'stripe_id';

    /**
     * The columns that should be searchable.
     *
     * @var array
     */
    public static $search = [
        'id',
        'stripe_id',
        'stripe_status',
        'type',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('User')
                ->sortable()
                ->searchable(),

            Text::make('Type')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Stripe ID', 'stripe_id')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Stripe Status', 'stripe_status')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Stripe Price', 'stripe_price')
                ->sortable()
                ->hideFromIndex(),

            Number::make('Quantity')
                ->sortable()
                ->rules('nullable', 'integer', 'min:1'),

            DateTime::make('Trial Ends At', 'trial_ends_at')
                ->sortable()
                ->hideFromIndex(),

            DateTime::make('Ends At', 'ends_at')
                ->sortable()
                ->hideFromIndex(),

            DateTime::make('Created At', 'created_at')
                ->onlyOnIndex()
                ->sortable(),

            DateTime::make('Updated At', 'updated_at')
                ->onlyOnDetail()
                ->sortable(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
