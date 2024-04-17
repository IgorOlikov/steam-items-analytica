<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       return [
           'id' => $this->product_id,
           'quantity' => $this->quantity,
           'image' => $this->whenLoaded('image', $this->image->url),
           'price' => $this->whenLoaded('product', $this->product->price)
       ];
    }
}
