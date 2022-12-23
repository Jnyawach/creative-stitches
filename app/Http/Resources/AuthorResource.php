<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
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
            'name'=>$this->first_name,
            'last_name'=>$this->last_name,
            'profile'=>$this->profile_link,
            'avatar'=> $this->getFirstMediaUrl('profile','profile-icon'),
        ];
    }
}
