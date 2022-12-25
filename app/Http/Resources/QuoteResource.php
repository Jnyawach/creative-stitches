<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuoteResource extends JsonResource
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
            'updated_at'=>$this->updated_at,
            'name'=>$this->first_name,
            'last_name'=>$this->last_name,
            'email'=>$this->email,
            'cellphone'=>$this->cellphone,
            'description'=>$this->description,
            'attachment'=>$this->getFirstMediaUrl('attachment'),
            'status'=>$this->status,
            'user'=>new AdminResource($this->user)
        ];
    }
}
