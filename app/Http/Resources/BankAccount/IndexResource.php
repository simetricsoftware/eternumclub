<?php

namespace App\Http\Resources\BankAccount;

use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
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
            'identification_number' => $this->identification_number,
            'name' => $this->name,
            'bank' => $this->bank,
            'account_number' => $this->account_number,
            'account_type' => $this->account_type,
            'email' => $this->email,
        ];
    }
}
