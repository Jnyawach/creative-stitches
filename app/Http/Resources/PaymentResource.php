<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'sub_total'=>$this->sub_total,
            'total'=>$this->total,
            'user_id'=>$this->user_id,
            'order_id'=>$this->order_id,
            'user'=>new UserResource($this->whenLoaded('user')),
            'order'=>new OrderResource($this->whenLoaded('order'))
        ];
    }
}
