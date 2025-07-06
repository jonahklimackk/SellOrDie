<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Resource;

class Credit extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Credit::class;

    /**
     * The single value that should be used to represent the resource.
     *
     * @var string
     */
    public static $title = 'id';

    public static $search = [
        'id', 'type', 'description',
    ];

    /**
     * Get the fields displayed by the resource.
     */
    public function fields(Request $request): array
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('User')
                ->sortable()
                ->searchable(),

            Select::make('Type')
                ->options([
                    'direct_commission' => 'Direct Commission',
                    'ad_view'           => 'Ad View',
                    // add other types here as needed
                ])
                ->displayUsingLabels()
                ->sortable(),

            Number::make('Amount')
                ->sortable(),
                

            Textarea::make('Description')
                ->alwaysShow()
                ->rows(3),

            DateTime::make('Created At')
                ->onlyOnDetail()
                ->sortable(),

            DateTime::make('Updated At')
                ->onlyOnDetail(),
        ];
    }
}
