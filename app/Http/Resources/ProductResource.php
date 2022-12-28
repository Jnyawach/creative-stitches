<?php

namespace App\Http\Resources;

use App\Models\Embroidery;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'price'=>$this->price,
            'sku'=>$this->sku,
            'mpn'=>$this->mpn,
            'category_id'=>$this->category_id,
            'size_id'=>$this->size_id,
            'status'=>$this->status,
            'keywords'=>$this->keywords,
            'description'=>$this->description,
            'meta_description'=>$this->meta_description,
            'total_stitches'=>$this->total_stitches,
            'design_size_inches'=>$this->design_size_inches,
            'design_size_mm'=>$this->design_size_mm,
            'category'=>new CategoryResource($this->whenLoaded('category')),
            'size'=>new SizeResource($this->whenLoaded('size')),
            'embroideries'=>EmbroideryResource::collection($this->whenLoaded('embroideries')),
            'colorChart'=>$this->getFirstMediaUrl('colorChart'),
            'mainImage'=>[
                'full_image'=>$this->getFirstMediaUrl('mainImage'),
                'thumb'=>$this->getFirstMediaUrl('mainImage','mainImage-thumb'),
                'icon'=>$this->getFirstMediaUrl('mainImage','mainImage-icon')
            ],
            'secondImage'=>[
                'full_image'=>$this->getFirstMediaUrl('secondImage'),
                'thumb'=>$this->getFirstMediaUrl('secondImage','secondImage-thumb'),
                'icon'=>$this->getFirstMediaUrl('secondImage','secondImage-icon')
            ],
            'thirdImage'=>[
                'full_image'=>$this->getFirstMediaUrl('thirdImage'),
                'thumb'=>$this->getFirstMediaUrl('thirdImage','thirdImage-thumb'),
                'icon'=>$this->getFirstMediaUrl('thirdImage','thirdImage-icon')
            ],
            'fourthImage'=>[
                'full_image'=>$this->getFirstMediaUrl('fourthImage'),
                'thumb'=>$this->getFirstMediaUrl('fourthImage','fourthImage-thumb'),
                'icon'=>$this->getFirstMediaUrl('fourthImage','fourthImage-icon')
            ]

        ];
    }
}
