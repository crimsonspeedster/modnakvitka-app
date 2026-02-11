<?php

namespace App\Nova;

use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\MorphOne;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Product extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Product>
     */
    public static $model = \App\Models\Product::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'sku'
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

            Text::make('Title')
                ->onlyOnIndex(),

            Text::make('SKU')
                ->sortable()
                ->rules('max:255', 'unique:products,sku,{{resourceId}}')
                ->fillUsing(function ($request, $model, $attribute, $requestAttribute) {
                    if ($request->$requestAttribute) {
                        $model->$attribute = $request->$requestAttribute;
                    } else {
                        if (!$model->exists) {
                            $model->save();
                        }

                        $model->$attribute = $model->id;
                    }
                }),

            Select::make('Status')
                ->options([
                    'draft' => 'Draft',
                    'published' => 'Published',
                ])
                ->displayUsingLabels()
                ->sortable()
                ->rules('required'),

            Currency::make('Price')
                ->currency('UAH')
                ->sortable()
                ->rules('required', 'numeric', 'min:0'),

            Currency::make('Price on sale', 'sale_price')
                ->currency('UAH')
                ->sortable()
                ->rules('numeric', 'min:0')
                ->default(0),

            Boolean::make('Is on sale?', 'is_on_sale')
                ->default(false),

            BelongsToMany::make('Categories', 'categories', ProductCategory::class),

            HasMany::make('Translations', 'translations', ProductTranslations::class),

            MorphOne::make('Seo'),

            MorphMany::make('Slugs'),
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
