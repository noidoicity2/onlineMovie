<?php

namespace App\Http\Requests\Movie;

use Illuminate\Foundation\Http\FormRequest;

class AddMovieRequest extends FormRequest
{
    /**
     * @var mixed
     */
    private $img;

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
            'name'          =>    'required|max:50|min:2|unique:category',
            'slug'        =>      'max:50',
            'description'   =>      'max:1000|required',
            'img' => [
                'required',


            ],



        ];
    }
}
