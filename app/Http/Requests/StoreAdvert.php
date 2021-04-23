<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdvert extends FormRequest
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
            //
            'title' => ['required', 'min:2', 'max:255'],
            'date' => ['required', 'date'],
            'author' => ['required'],
            'advert_description' => ['required'],
            'zip_code' => ['required', 'min:4', 'max:6'],
            'image' => ['mimes:jpeg,bmp,png|max:2000'],
        ];
    }
}
