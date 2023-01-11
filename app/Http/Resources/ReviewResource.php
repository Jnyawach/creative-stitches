<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'created_at'=>$this->created_at,
            'user_id'=>$this->user_id,
            'product_id'=>$this->product_id,
            'rating'=>$this->rating,
            'comment'=>$this->comment,
            'product'=>new ProductResource($this->whenLoaded('product')),
            'user'=>new UserResource($this->whenLoaded('user'))
        ];
    }
}
