<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StorePost extends FormRequest
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
          'title'       => 'required|min:5|max:500',
          'slug'        => 'nullable|min:5|max:500|unique:posts',
          'content'     => 'required',
          'category_id' => 'required',
          'status'      => 'required',
          'tags'        => 'nullable',
          'image'       => 'required|mimes:jpeg,jpg,png|max:10240' //10 Mb
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
