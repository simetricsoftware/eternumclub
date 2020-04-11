<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePost extends FormRequest
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
             'title'          => 'required|min:5|max:500',
             'slug'           => "nullable|min:5|max:500|unique:posts,slug,{$this->post->id}",
             'content'        => 'required',
             'category_id'    => 'required',
             'status'         => 'required',
             'tags'           => 'nullable'
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
