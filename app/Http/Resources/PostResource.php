<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'title'=>$this->title,
            'slug'=>$this->slug,
            'summary'=>$this->summary,
            'content'=>$this->content,
            'author'=>$this->author,
            'status'=>$this->status,
            'tags'=>$this->tags,
            'credit'=>$this->credit,
            'postIcon'=> $this->getFirstMediaUrl('blogImage','blog-icon'),
            'postImage'=>$this->getFirstMediaUrl('blogImage')
        ];
    }
}
