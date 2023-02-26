<?php

namespace App\Http\Requests;

use App\Models\Hash;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateHashRequest extends FormRequest
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
            'hash' => [ 'required', 'string', Rule::unique(Hash::class, 'hash')->ignore($this->id), ],
            'file' => 'sometimes|required|image',
        ];
    }
}
