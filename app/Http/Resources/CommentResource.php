<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
          'user_id'=>$this->user->id,
          'user_name'=>$this->user->name,
          'news_id'=>$this->news_id,
          'news_title'=>$this->news->title,
          'news_slug'=>$this->news->slug,
          'comment'=>$this->comment,
          'created_at'=> $this->created_at,
          'updated_at'=> $this->updated_at
        ];
    }
}
