<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class Ads extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Ads>
     */
    public static $model = \App\Models\Ads::class;

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
        'user_id',
        'team_id',
        'headline',
        'body',
        'url',
        'status',
        'category',
        'random_opponent',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array<int, \Laravel\Nova\Fields\Field>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('User')
            ->sortable(),
            // Text::make('headline')
            // ->sortable(),
            // // ->rules('required', 'max:255'),

            Number::make('team_id')
            ->sortable(),

            Text::make('headline')->displayUsing(function ($text) {
                if (strlen($text) > 30) {
                    return substr($text, 0, 30) . '...';
                }
                return $text;
            })->sortable(),

            Text::make('url')->displayUsing(function ($text) {
                if (strlen($text) > 30) {
                    return substr($text, 0, 30) . '...';
                }
                return $text;
            }),           


            Trix::make('body')->displayUsing(function ($text) {
                if (strlen($text) > 30) {
                    return substr($text, 0, 30) . '...';
                }
                return $text;
            }),     

            // Trix::make('body')
            // ->showOnIndex()
            // ->fullWidth()
            // ->alwaysShow(),  

            // Text::make('Url')
            // ->showOnIndex()
            // ->rules('required', 'url'),

            Text::make('status')
            ->sortable()
            // ->rules('required', 'max:20'),            
        ];
    }

    /**
     * Get the cards available for the resource.
     *
     * @return array<int, \Laravel\Nova\Card>
     */
    public function cards(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array<int, \Laravel\Nova\Filters\Filter>
     */
    public function filters(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @return array<int, \Laravel\Nova\Lenses\Lens>
     */
    public function lenses(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array<int, \Laravel\Nova\Actions\Action>
     */
    public function actions(NovaRequest $request): array
    {
        return [];
    }
}
