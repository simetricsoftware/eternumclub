<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'          => 'required|string|max:255',
            'lastname'      => 'required|string|max:255',
            'email'         => "required|string|email|max:255|unique:users,email,{$this->user->id}",
            'role'          => 'required|exists:roles,name',
            'permissions'   => 'sometimes|nullable'
        ];

        if($this->get('password'))
            $rules = array_merge($rules, ['password' => 'min:6|max:180']);

        return $rules;
    }

    public function prepareForValidation() {
        if(!$this->has('permissions')) {
            $this->merge([
                'permissions' => []
            ]);
        }
    }
}
