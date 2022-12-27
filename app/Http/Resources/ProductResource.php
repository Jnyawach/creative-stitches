<?php

namespace App\Http\Resources;

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
            'status'=>$this->status,
            'keyword'=>$this->keywords,
            'meta_description'=>$this->meta_keywords,
            'total_stitches'=>$this->total_stitches,
            'design_size_inches'=>$this->design_size_inches,
            'design_size_mm'=>$this->design_size_mm,
            'category'=>new CategoryResource($this->whenLoaded('category')),
            'size'=>new SizeResource($this->whenLoaded('size')),
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
