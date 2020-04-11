<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->full_name,
            'role'          => [
                'name'          => $this->roles->first()->name,
                'permissions'   => $this->roles->first()->permissions
            ],
            'permissions'   => $this->permissions
        ];
    }
}
