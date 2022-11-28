<?php

namespace App\Http\Resources;

class ProductCollection extends PaginatedCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [

            // Here we transform any item in paginated items to a resource

            'data' => $this->collection->transform(function ($product) {
                return new ProductResource($product);
            }),

            'pagination' => $this->pagination,
        ];
    }
}
