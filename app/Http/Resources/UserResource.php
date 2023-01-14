<?php

namespace App\Http\Resources;

use App\Models\Wishlist;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'last_name'=>$this->last_name,
            'email'=>$this->email,
            'address'=>new AddressResource($this->whenLoaded('address')),
            'wishlist'=>WishlistResource::collection($this->whenLoaded('wishlists')),
            'orders'=>OrderResource::collection($this->whenLoaded('orders')),
            'payments'=>PaymentResource::collection($this->whenLoaded('payments')),


        ];
    }
}
