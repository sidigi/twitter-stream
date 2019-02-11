<?php

namespace App\Http\Requests\Content;

use Illuminate\Foundation\Http\FormRequest;

class CreateContentRequest extends FormRequest
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
            'type' => 'required|in:image,video',
            'date_from' => 'required|date|before:date_to',
            'date_to' => 'required|date|after:date_from',
            'image' => 'required_if:type,image|image|mimes:jpeg,png,jpg,gif,svg',
            'url' => 'required_if:type,video|url',
        ];
    }
}
