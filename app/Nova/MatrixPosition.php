<?php

namespace App\Nova;

use Laravel\Nova\Resource;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\DateTime;

class MatrixPosition extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\MatrixPosition>
     */
    public static $model = \App\Models\MatrixPosition::class;

    /**
     * The single value that should be used to represent the resource.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searchable.
     *
     * @var array<int,string>
     */
    public static $search = [
        'id',
        'position_index',
        'depth',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<int,\Laravel\Nova\Fields\Field>
     */
    public function fields(Request $request): array
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('User')
                ->sortable()
                ->searchable()
                ->rules('required'),

            BelongsTo::make('Parent Position', 'parent', self::class)
                ->nullable()
                ->sortable()
                ->help('The parent node in the binary matrix'),

            Number::make('Position Index')
                ->sortable()
                ->rules('required', 'integer', 'min:1', 'max:2')
                ->help('Slot index under its parent (1 or 2)'), // binary width

            Number::make('Depth')
                ->sortable()
                ->rules('required', 'integer', 'min:0')
                ->help('Level in the matrix tree (root is 0)'),

            DateTime::make('Created At')
                ->onlyOnDetail()
                ->sortable(),

            DateTime::make('Updated At')
                ->onlyOnDetail()
                ->sortable(),
        ];
    }
}
