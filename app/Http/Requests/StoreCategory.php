<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreCategory extends FormRequest
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
            'title' => 'required|min:5|max:500',
            'slug'  => 'nullable|min:5|max:500'
        ];
    }

    protected function prepareForValidation() {
        if (!$this->slug) {
            $this->merge([
                'slug' => Str::slug($this->title)
            ]);
        }
    }
}
