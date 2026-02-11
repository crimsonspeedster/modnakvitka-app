<?php

namespace App\Nova;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Email;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Order extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Order>
     */
    public static $model = \App\Models\Order::class;

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

            Email::make('Email'),

            Currency::make('Total')
                ->currency('UAH')
                ->default(1)
                ->rules('required'),

            Select::make('Delivery Type')
                ->default('local_pickup')
                ->rules('required')
                ->displayUsingLabels()
                ->options([
                    'local_pickup' => 'Local Pickup',
                    'courier' => 'Courier',
                ]),

            Boolean::make('Recipient knowing address?', 'is_recipient_address_knowing')
                ->default(false),

            Select::make('City')
                ->displayUsingLabels()
                ->options([
                    'kyiv' => 'Kyiv',
                    'kyiv_region' => 'Kyiv region',
                ]),

            Text::make('Coupon'),

            Select::make('Status')
                ->options([
                    'pending_payment' => 'Pending Payment',
                    'processing' => 'Processing',
                    'completed' => 'Completed',
                    'canceled' => 'Canceled',
                ])
                ->displayUsingLabels()
                ->default('pending_payment')
                ->rules('required'),

            Text::make('Customer name')
                ->rules('required'),

            Text::make('Customer phone')
                ->rules('required'),

            Text::make('Recipient name')
                ->rules('required'),

            Text::make('Recipient phone')
                ->rules('required'),

            Date::make('Delivery date')
                ->rules('required', 'date'),

            Text::make('Delivery time')
                ->rules('required'),

            Textarea::make('Delivery address'),

            Textarea::make('Postcard', 'text_in_postcard'),

            HasMany::make('Order Items', 'items', OrderItems::class),
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
