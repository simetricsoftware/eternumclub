<?php

namespace App\Http\Requests;

use App\Rules\UniqueEmailByEvent;
use App\Rules\UniquePhoneByEvent;
use Illuminate\Foundation\Http\FormRequest;

class RegisterVoucher extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email'       => [ 'required', 'email', new UniqueEmailByEvent($this->event) ],
            'name'        => 'required|string',
            'phone'       => [ 'required', 'string', new UniquePhoneByEvent($this->event) ],
            'voucher'     => 'required|file',
            'sex'         => 'required|in:M,F',
            'is-ready'    => 'required|boolean',
            'instagram'   => 'required|string',
        ];
    }
}
