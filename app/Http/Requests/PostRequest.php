<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title'         => 'required|max:100',
            'image'         => request()->method == 'POST' ? 'required|image|max:2048' : 'image|max:2048',
            'content'       => 'required',
            'category'      => 'required|max:100',
            'publish_at'    => 'required|date_format:Y-m-d H:i:s',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'title'     => 'Title',
            'image'     => 'Image',
            'content'   => 'Content',
            'category'  => 'Category',
            'publish_at' => 'Publish At',
        ];
    }
}
