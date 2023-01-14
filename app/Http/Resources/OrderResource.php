<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'order_code'=>$this->order_code,
            'amount'=>$this->amount,
            'user_id'=>$this->user_id,
            'created_at'=>$this->created_at,
            'products'=>ProductResource::collection($this->whenLoaded('products')),
            'payment'=>new PaymentResource($this->whenLoaded('payment')),
            'user'=>new UserResource($this->whenLoaded('user')),
        ];
    }
}
