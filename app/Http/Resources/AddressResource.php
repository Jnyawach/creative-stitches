<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'address'=>$this->address_1,
            'city'=>$this->city,
            'zip'=>$this->zip,
            'user_id'=>$this->user_id,
            'country_id'=>$this->country_id,
            'country'=>new CountryResource($this->country)
        ];
    }
}
