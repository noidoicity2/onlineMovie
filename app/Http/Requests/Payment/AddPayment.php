<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class AddPayment extends FormRequest
{
    /**
     * @var mixed
     */
    private $name;
    /**
     * @var mixed
     */
    private $description;

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
            'name'          =>    'required|max:50|min:2|unique:Payment_Method',

            'description'   =>      'required',
            'img' => [
                'required',


            ],



        ];
    }
}
