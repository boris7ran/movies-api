<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomMovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', new DateAndTitleUnique()],
            'duration' => 'required | integer | between:1,500',
            'director' => 'required',
            'releaseDate' => 'required',
            'imageUrl' => 'url'
        ];
    }
}
