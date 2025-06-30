<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Panel;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Controllers\ResourceIndexController;

class Referral extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Referral::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'campaign',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  \$request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('User', 'user', User::class)
                ->sortable()
                ->searchable(),

            BelongsTo::make('Referrer', 'referrer', User::class)
                ->sortable()
                ->searchable(),

            Text::make('Campaign')
                ->sortable()
                ->nullable(),

            DateTime::make('Created At')
                ->onlyOnIndex(),

            DateTime::make('Created At', 'created_at')
                ->onlyOnDetail(),

            DateTime::make('Updated At')
                ->onlyOnDetail(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  \$request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  IlluminateHttpRequest  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  \$request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  \$request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
