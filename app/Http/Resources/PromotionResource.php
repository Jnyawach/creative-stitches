<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PromotionResource extends JsonResource
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
            'name'=>$this->name,
            'slug'=>$this->slug,
            'discount'=>$this->discount,
            'status'=>$this->status,
            'title'=>$this->title,
            'description'=>$this->description,
            'photo'=>$this->getFirstMediaUrl('photo'),
            'products'=>ProductResource::collection($this->whenLoaded('products'))

        ];
    }
}
