<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Traits\ApiResponse;

class Post extends JsonResource
{
    use ApiResponse;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'title'     => $this->title,
            'slug'      => $this->slug,
            'content'   => $this->content,
            'category'  => Category::make($this->whenLoaded('category')),
            'image'     => $this->image_url,
            'votes'     => [
                'user_vote_type'    => $this->when($this->whenLoaded('votes'), Vote::make($this->votes->first())),
                'likes'             => $this->likes,
                'dislikes'          => $this->dislikes,
            ],
            'tags'      => $this->when($this->tags, Tag::collection($this->tags))
        ];
    }

    public function with($request) {
        return $this->succesResponse();
    }
}
