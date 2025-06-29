<?php

namespace App\Nova;

use Laravel\Nova\Resource;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;

class AffiliateSale extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\AffiliateSale::class;

    /**
     * The single value that should be used to represent the resource.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searchable.
     *
     * @var array
     */
    public static $search = [
        'id',
        'campaign',
        'product',
    ];

    /**
     * Get the fields displayed by the resource.
     */
    public function fields(Request $request): array
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Referrer', 'referrer', User::class)
                ->sortable()
                ->searchable(),

            BelongsTo::make('Buyer', 'buyer', User::class)
                ->sortable()
                ->searchable(),

            Text::make('Campaign')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Product')
                ->sortable()
                ->rules('nullable', 'max:255'),

            Currency::make('Amount')
                ->currency('USD')
                ->sortable()
                ->rules('required'),

            Currency::make('Commission')
                ->currency('USD')
                ->sortable()
                ->rules('required'),                

            DateTime::make('Created At')
                ->onlyOnDetail()
                ->sortable(),

            DateTime::make('Updated At')
                ->onlyOnDetail(),
        ];
    }
}
