<?php

namespace App\Http\Resources;

use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
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
      'id' => $this->id,
      'title' => $this->title,
      'slug' => $this->slug,
      'body' => $this->body,
      'image' => asset(url("storage"). "/" . $this->images),
      'created_at' => $this->created_at,
      'comments' => CommentResource::collection($this->comment),
    ];
  }

  // public function with($request)
  // {
  //   return [
  //     'meta' => [
  //       'success' => ,
  //     ],
  //   ];
  // }
}
