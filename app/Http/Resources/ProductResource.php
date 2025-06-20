<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CategoryResource;
use Carbon\Carbon;


class ProductResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'image' => $this->image,
            'expiration_date' => $this->expiration_date ? Carbon::parse($this->expiration_date)->format('d/m/Y') : null,
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
        ];
    }
}
