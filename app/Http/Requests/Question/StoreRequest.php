<?php

namespace App\Http\Requests\Question;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        return [
            'questions' => 'nullable|array',
            'questions.*.type' => 'required|in:radio,multiple,open,dropdown',
            'questions.*.statement' => 'required|string',
            'questions.*.options' => 'sometimes|required|array|min:1',
            'questions.*.options.*' => 'required|string',
        ];
    }
}
