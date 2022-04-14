<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
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
            "title" => "required|string|max:30",
            "year" => "required|string|max:4",
            "length" => "required|string|max:11",
            "country_id" => "required|exists:countries,id",
            "director_id" => "required|exists:artists,id",
//            "poster" => "required"
        ];
    }
}
