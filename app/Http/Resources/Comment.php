<?php

namespace App\Http\Resources;

use App\Traits\ApiResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class Comment extends JsonResource
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
        if($request->user('api')){

        }
        return [
            'id'        => $this->id,
            'content'   => $this->content,
            'votes'     => [
                'user_vote_type'    => $this->when($request->user('api'), Vote::make($this->votes->first())),
                'likes'             => $this->likes,
                'dislikes'          => $this->dislikes,
            ],
            'user'      => User::make($this->user),
            'ago'       => $this->updated_at->toDateTimeString()
        ];
    }

    public function with($request) {
        return $this->succesResponse();
    }
}
