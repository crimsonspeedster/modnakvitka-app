<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductPreviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->translation?->title,
            'slug' => $this->slug?->slug,
            'status' => $this->status,
            'price' => $this->price,
            'sale_price' => $this->sale_price,
            'is_on_sale' => $this->is_on_sale,
            'sku' => $this->sku,
            'categories' => $this->categories
                ->map(fn($category) => [
                    'id' => $category->id,
                    'slug' => $category->slug?->slug,
                    'title' => $category->translation?->title,
                ])
                ->filter()
                ->values(),
        ];
    }
}
