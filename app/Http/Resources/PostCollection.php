<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Traits\ApiResponse;

class PostCollection extends ResourceCollection
{
    use ApiResponse;
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection, //Rellenado del recurso Resources\Post
        ];
    }

    public function with($request) {
        return [
            $this->succesResponse(),
            'meta' => [
                'category' => $request->category ? $request->category : 'all'
            ]
        ];
    }
}
